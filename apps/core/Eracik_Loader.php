<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eracik_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
	}

	// --------------------------------------------------------------------
	
	/**
	 * Module Library Loader
	 *
	 * Loads and instantiates libraries.
	 * Designed to be called from application controllers.
	 *
	 * @param	mixed	$library	Library name
	 * @param	array	$params		Optional parameters to pass to the library class constructor
	 * @param	string	$object_name	An optional object name to assign to
	 * @return	object
	 */
	public function module_library($module_namespace, $library, $params = NULL, $object_name = NULL)
	{
		if (empty($library))
		{
			return $this;
		}
		elseif (is_array($library))
		{
			foreach ($library as $key => $value)
			{
				if (is_int($key))
				{
					$this->module_library($module_namespace, $value, $params);
				}
				else
				{
					$this->module_library($module_namespace, $key, $params, $value);
				}
			}

			return $this;
		}

		if ($params !== NULL && ! is_array($params))
		{
			$params = NULL;
		}

		$this->_ci_load_module_library($module_namespace, $library, $params, $object_name);
		return $this;
	}

	/**
	 * Addin Library Loader
	 *
	 * Loads and instantiates libraries.
	 * Designed to be called from application controllers.
	 *
	 * @param	mixed	$library	Library name
	 * @param	array	$params		Optional parameters to pass to the library class constructor
	 * @param	string	$object_name	An optional object name to assign to
	 * @return	object
	 */
	public function addin_library($addin_namespace, $library, $params = NULL, $object_name = NULL)
	{
		if (empty($library))
		{
			return $this;
		}
		elseif (is_array($library))
		{
			foreach ($library as $key => $value)
			{
				if (is_int($key))
				{
					$this->addin_library($addin_namespace, $value, $params);
				}
				else
				{
					$this->addin_library($addin_namespace, $key, $params, $value);
				}
			}

			return $this;
		}

		if ($params !== NULL && ! is_array($params))
		{
			$params = NULL;
		}

		$this->_ci_load_addin_library($addin_namespace, $library, $params, $object_name);
		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Module Model Loader
	 *
	 * Loads and instantiates models.
	 *
	 * @param	mixed	$model		Model name
	 * @param	string	$name		An optional object name to assign to
	 * @param	bool	$db_conn	An optional database connection configuration to initialize
	 * @return	object
	 */
	public function module_model($module_namespace, $model, $name = '', $db_conn = FALSE)
	{
		if (empty($model))
		{
			return $this;
		}
		elseif (is_array($model))
		{
			foreach ($model as $key => $value)
			{
				is_int($key) ? $this->module_model($module_namespace, $value, '', $db_conn) : $this->module_model($module_namespace, $key, $value, $db_conn);
			}

			return $this;
		}

		$path = '';

		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, ++$last_slash);

			// And the model name behind it
			$model = substr($model, $last_slash);
		}

		if (empty($name))
		{
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE))
		{
			return $this;
		}

		$CI =& get_instance();
		if (isset($CI->$name))
		{
			throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		if ($db_conn !== FALSE && ! class_exists('CI_DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}

			$this->database($db_conn, FALSE, TRUE);
		}

		// Note: All of the code under this condition used to be just:
		//
		//       load_class('Model', 'core');
		//
		//       However, load_class() instantiates classes
		//       to cache them for later use and that prevents
		//       MY_Model from being an abstract class and is
		//       sub-optimal otherwise anyway.
		if ( ! class_exists('CI_Model', FALSE))
		{
			$app_path = APPPATH.'core'.DIRECTORY_SEPARATOR;
			if (file_exists($app_path.'Model.php'))
			{
				require_once($app_path.'Model.php');
				if ( ! class_exists('CI_Model', FALSE))
				{
					throw new RuntimeException($app_path."Model.php exists, but doesn't declare class CI_Model");
				}

				log_message('info', 'CI_Model class loaded');
			}
			elseif ( ! class_exists('CI_Model', FALSE))
			{
				require_once(BASEPATH.'core'.DIRECTORY_SEPARATOR.'Model.php');
			}

			$class = config_item('subclass_prefix').'Model';
			if (file_exists($app_path.$class.'.php'))
			{
				require_once($app_path.$class.'.php');
				if ( ! class_exists($class, FALSE))
				{
					throw new RuntimeException($app_path.$class.".php exists, but doesn't declare class ".$class);
				}

				log_message('info', config_item('subclass_prefix').'Model class loaded');
			}
		}

		$model = ucfirst($model);
		if ( ! class_exists($model, FALSE))
		{
			$model_path = MODULESPATH. $module_namespace .'/models'.DIRECTORY_SEPARATOR;
			if ( ! file_exists($model_path.$model.'.php'))
			{
				return;
			}

			require_once($model_path.$model.'.php');
			if ( ! class_exists($model, FALSE))
			{
				throw new RuntimeException($model_path.$model.".php exists, but doesn't declare class ".$model);
			}

			if ( ! class_exists($model, FALSE))
			{
				throw new RuntimeException('Unable to locate the model you have specified: '.$model);
			}
		}
		elseif ( ! is_subclass_of($model, 'CI_Model'))
		{
			throw new RuntimeException("Class ".$model." already exists and doesn't extend CI_Model");
		}

		$this->_ci_models[] = $name;
		$model = new $model();
		$CI->$name = $model;
		log_message('info', 'Model "'.get_class($model).'" initialized');
		return $this;
	}

	/**
	 * Addin Model Loader
	 *
	 * Loads and instantiates models.
	 *
	 * @param	mixed	$model		Model name
	 * @param	string	$name		An optional object name to assign to
	 * @param	bool	$db_conn	An optional database connection configuration to initialize
	 * @return	object
	 */
	public function addin_model($addin_namespace, $model, $name = '', $db_conn = FALSE)
	{
		if (empty($model))
		{
			return $this;
		}
		elseif (is_array($model))
		{
			foreach ($model as $key => $value)
			{
				is_int($key) ? $this->addin_model($addin_namespace, $value, '', $db_conn) : $this->addin_model($addin_namespace, $key, $value, $db_conn);
			}

			return $this;
		}

		$path = '';

		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, ++$last_slash);

			// And the model name behind it
			$model = substr($model, $last_slash);
		}

		if (empty($name))
		{
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE))
		{
			return $this;
		}

		$CI =& get_instance();
		if (isset($CI->$name))
		{
			throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		if ($db_conn !== FALSE && ! class_exists('CI_DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}

			$this->database($db_conn, FALSE, TRUE);
		}

		// Note: All of the code under this condition used to be just:
		//
		//       load_class('Model', 'core');
		//
		//       However, load_class() instantiates classes
		//       to cache them for later use and that prevents
		//       MY_Model from being an abstract class and is
		//       sub-optimal otherwise anyway.
		if ( ! class_exists('CI_Model', FALSE))
		{
			$app_path = APPPATH.'core'.DIRECTORY_SEPARATOR;
			if (file_exists($app_path.'Model.php'))
			{
				require_once($app_path.'Model.php');
				if ( ! class_exists('CI_Model', FALSE))
				{
					throw new RuntimeException($app_path."Model.php exists, but doesn't declare class CI_Model");
				}

				log_message('info', 'CI_Model class loaded');
			}
			elseif ( ! class_exists('CI_Model', FALSE))
			{
				require_once(BASEPATH.'core'.DIRECTORY_SEPARATOR.'Model.php');
			}

			$class = config_item('subclass_prefix').'Model';
			if (file_exists($app_path.$class.'.php'))
			{
				require_once($app_path.$class.'.php');
				if ( ! class_exists($class, FALSE))
				{
					throw new RuntimeException($app_path.$class.".php exists, but doesn't declare class ".$class);
				}

				log_message('info', config_item('subclass_prefix').'Model class loaded');
			}
		}

		$model = ucfirst($model);
		if ( ! class_exists($model, FALSE))
		{
			$model_path = ADDINSPATH. $addin_namespace .'/models'.DIRECTORY_SEPARATOR;
			if ( ! file_exists($model_path.$model.'.php'))
			{
				return;
			}

			require_once($model_path.$model.'.php');
			if ( ! class_exists($model, FALSE))
			{
				throw new RuntimeException($model_path.$model.".php exists, but doesn't declare class ".$model);
			}

			if ( ! class_exists($model, FALSE))
			{
				throw new RuntimeException('Unable to locate the model you have specified: '.$model);
			}
		}
		elseif ( ! is_subclass_of($model, 'CI_Model'))
		{
			throw new RuntimeException("Class ".$model." already exists and doesn't extend CI_Model");
		}

		$this->_ci_models[] = $name;
		$model = new $model();
		$CI->$name = $model;
		log_message('info', 'Model "'.get_class($model).'" initialized');
		return $this;
	}

	// --------------------------------------------------------------------

    /**
     *  Module Include
     *  @param
     *  @return
    **/

    public function module_include($module_namespace, $view, $vars = array(), $return = false)
    {
        $view       =   str_replace( '.', '/', $view );
        return $this->_ci_load(array( '_ci_view' => '../modules/' . $module_namespace . '/inc/' . $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }

	// --------------------------------------------------------------------
	
	/**
	 * Module View Loader
	 *
	 * Loads "view" files.
	 *
	 * @param	string	$view	View name
	 * @param	array	$vars	An associative array of data
	 *				to be extracted for use in the view
	 * @param	bool	$return	Whether to return the view output
	 *				or leave it to the Output class
	 * @return	object|string
	 */
	public function module_view($module_namespace, $view, $vars = array(), $return = FALSE)
	{
        $view = str_replace( '.', '/', $view );
		return $this->_ci_load(array('_ci_view' => '../modules/' . $module_namespace . '/views/' . $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
	}

	/**
	 * Addin View Loader
	 *
	 * Loads "view" files.
	 *
	 * @param	string	$view	View name
	 * @param	array	$vars	An associative array of data
	 *				to be extracted for use in the view
	 * @param	bool	$return	Whether to return the view output
	 *				or leave it to the Output class
	 * @return	object|string
	 */
	public function addin_view($addin_namespace, $view, $vars = array(), $return = FALSE)
	{
        $view = str_replace( '.', '/', $view );
		return $this->_ci_load(array('_ci_view' => '../addins/' . $addin_namespace . '/views/' . $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
	}

	// --------------------------------------------------------------------

	/**
	 * Module Helper Loader
	 *
	 * @param	string|string[]	$helpers	Helper name(s)
	 * @return	object
	 */
	public function module_helper($module_namespace, $helpers = array())
	{
		is_array($helpers) OR $helpers = array($helpers);
		foreach ($helpers as &$helper)
		{
			$filename = basename($helper);
			$filepath = ($filename === $helper) ? '' : substr($helper, 0, strlen($helper) - strlen($filename));
			$filename = strtolower(preg_replace('#(_helper)?(\.php)?$#i', '', $filename)).'_helper';
			$helper   = $filepath.$filename;

			if (isset($this->_ci_helpers[$helper]))
			{
				continue;
			}

			// Is this a helper extension request?
			$ext_helper = config_item('subclass_prefix').$filename;
			$ext_loaded = FALSE;
			
            if (file_exists(MODULESPATH . $module_namespace . '/helpers/'.$ext_helper.'.php'))
            {
                include_once(MODULESPATH . $module_namespace . '/helpers/'.$ext_helper.'.php');
                $ext_loaded = TRUE;
            }

			// If we have loaded extensions - check if the base one is here
			if ($ext_loaded === TRUE)
			{
				$base_helper = BASEPATH.'helpers/'.$helper.'.php';
				if ( ! file_exists($base_helper))
				{
					show_error('Unable to load the requested file: helpers/'.$helper.'.php');
				}

				include_once($base_helper);
				$this->_ci_helpers[$helper] = TRUE;
				log_message('info', 'Helper loaded: '.$helper);
				continue;
			}

			// No extensions found ... try loading regular helpers and/or overrides
            if (file_exists(MODULESPATH . $module_namespace . '/helpers/'.$helper.'.php'))
            {
                include_once(MODULESPATH . $module_namespace . '/helpers/'.$helper.'.php');

                $this->_ci_helpers[$helper] = TRUE;
                log_message('info', 'Helper loaded: '.$helper);
                break;
            }

			// unable to load the helper
			if ( ! isset($this->_ci_helpers[$helper]))
			{
				show_error('Unable to load the requested file: helpers/'.$helper.'.php');
			}
		}

		return $this;
	}

	/**
	 * Addin Helper Loader
	 *
	 * @param	string|string[]	$helpers	Helper name(s)
	 * @return	object
	 */
	public function addin_helper($addin_namespace, $helpers = array())
	{
		is_array($helpers) OR $helpers = array($helpers);
		foreach ($helpers as &$helper)
		{
			$filename = basename($helper);
			$filepath = ($filename === $helper) ? '' : substr($helper, 0, strlen($helper) - strlen($filename));
			$filename = strtolower(preg_replace('#(_helper)?(\.php)?$#i', '', $filename)).'_helper';
			$helper   = $filepath.$filename;

			if (isset($this->_ci_helpers[$helper]))
			{
				continue;
			}

			// Is this a helper extension request?
			$ext_helper = config_item('subclass_prefix').$filename;
			$ext_loaded = FALSE;
			
            if (file_exists(ADDINSPATH . $addin_namespace . '/helpers/'.$ext_helper.'.php'))
            {
                include_once(ADDINSPATH . $addin_namespace . '/helpers/'.$ext_helper.'.php');
                $ext_loaded = TRUE;
            }

			// If we have loaded extensions - check if the base one is here
			if ($ext_loaded === TRUE)
			{
				$base_helper = BASEPATH.'helpers/'.$helper.'.php';
				if ( ! file_exists($base_helper))
				{
					show_error('Unable to load the requested file: helpers/'.$helper.'.php');
				}

				include_once($base_helper);
				$this->_ci_helpers[$helper] = TRUE;
				log_message('info', 'Helper loaded: '.$helper);
				continue;
			}

			// No extensions found ... try loading regular helpers and/or overrides
            if (file_exists(ADDINSPATH . $addin_namespace . '/helpers/'.$helper.'.php'))
            {
                include_once(ADDINSPATH . $addin_namespace . '/helpers/'.$helper.'.php');

                $this->_ci_helpers[$helper] = TRUE;
                log_message('info', 'Helper loaded: '.$helper);
                break;
            }

			// unable to load the helper
			if ( ! isset($this->_ci_helpers[$helper]))
			{
				show_error('Unable to load the requested file: helpers/'.$helper.'.php');
			}
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Module Config Loader
	 *
	 * Loads a config file (an alias for CI_Config::load()).
	 *
	 * @uses	CI_Config::load()
	 * @param	string	$file			Configuration file name
	 * @param	bool	$use_sections		Whether configuration values should be loaded into their own section
	 * @param	bool	$fail_gracefully	Whether to just return FALSE or display an error message
	 * @return	bool	TRUE if the file was loaded correctly or FALSE on failure
	 */
	public function module_config($module_namespace, $file, $use_sections = FALSE, $fail_gracefully = FALSE)
	{
        if( $file == '' ) {
            return get_instance()->config->load( '../modules/' . $module_namespace . '/config/' . $module_namespace, $use_sections, $fail_gracefully);
        }
        return get_instance()->config->load( '../modules/' . $module_namespace . '/config/' . $file, $use_sections, $fail_gracefully);
	}

	/**
	 * Addin Config Loader
	 *
	 * Loads a config file (an alias for CI_Config::load()).
	 *
	 * @uses	CI_Config::load()
	 * @param	string	$file			Configuration file name
	 * @param	bool	$use_sections		Whether configuration values should be loaded into their own section
	 * @param	bool	$fail_gracefully	Whether to just return FALSE or display an error message
	 * @return	bool	TRUE if the file was loaded correctly or FALSE on failure
	 */
	public function addin_config($addin_namespace, $file, $use_sections = FALSE, $fail_gracefully = FALSE)
	{
        if( $file == '' ) {
            return get_instance()->config->load( '../addins/' . $addin_namespace . '/config/' . $addin_namespace, $use_sections, $fail_gracefully);
        }
        return get_instance()->config->load( '../addins/' . $addin_namespace . '/config/' . $file, $use_sections, $fail_gracefully);
	}

	// --------------------------------------------------------------------

	/**
	 * Module Internal CI Library Loader
	 *
	 * @used-by	CI_Loader::library()
	 * @uses	CI_Loader::_ci_init_library()
	 *
	 * @param	string	$class		Class name to load
	 * @param	mixed	$params		Optional parameters to pass to the class constructor
	 * @param	string	$object_name	Optional object name to assign to
	 * @return	void
	 */
	protected function _ci_load_module_library($module_namespace, $class, $params = NULL, $object_name = NULL)
	{
		// Get the class name, and while we're at it trim any slashes.
		// The directory path can be included as part of the class name,
		// but we don't want a leading slash
		$class = str_replace('.php', '', trim($class, '/'));

		// Was the path included with the class name?
		// We look for a slash to determine this
		if (($last_slash = strrpos($class, '/')) !== FALSE)
		{
			// Extract the path
			$subdir = substr($class, 0, ++$last_slash);

			// Get the filename from the path
			$class = substr($class, $last_slash);
		}
		else
		{
			$subdir = '';
		}

		$class = ucfirst($class);

		// Is this a stock library? There are a few special conditions if so ...
		if (file_exists(BASEPATH.'libraries/'.$subdir.$class.'.php'))
		{
			return $this->_ci_load_stock_module_library($module_namespace, $class, $subdir, $params, $object_name);
		}

		// Safety: Was the class already loaded by a previous call?
		if (class_exists($class, FALSE))
		{
			$property = $object_name;
			if (empty($property))
			{
				$property = strtolower($class);
				isset($this->_ci_varmap[$property]) && $property = $this->_ci_varmap[$property];
			}

			$CI =& get_instance();
			if (isset($CI->$property))
			{
				log_message('debug', $class.' class already loaded. Second attempt ignored.');
				return;
			}

			return $this->_ci_init_library($class, '', $params, $object_name);
		}

		// Let's search for the requested library file and load it.
		$filepath = MODULESPATH . $module_namespace . '/libraries/'.$subdir.$class.'.php';
		// Does the file exist? No? Bummer...
		if ( ! file_exists($filepath))
		{
			return;
		}

		include_once($filepath);
		return $this->_ci_init_library($class, '', $params, $object_name);

		// One last attempt. Maybe the library is in a subdirectory, but it wasn't specified?
		if ($subdir === '')
		{
			return $this->_ci_load_module_library($module_namespace, $class.'/'.$class, $params, $object_name);
		}

		// If we got this far we were unable to find the requested class.
		log_message('error', 'Unable to load the requested class: '.$class);
		show_error('Unable to load the requested class: '.$class);
	}

	/**
	 * Addin Internal CI Library Loader
	 *
	 * @used-by	CI_Loader::library()
	 * @uses	CI_Loader::_ci_init_library()
	 *
	 * @param	string	$class		Class name to load
	 * @param	mixed	$params		Optional parameters to pass to the class constructor
	 * @param	string	$object_name	Optional object name to assign to
	 * @return	void
	 */
	protected function _ci_load_addin_library($addin_namespace, $class, $params = NULL, $object_name = NULL)
	{
		// Get the class name, and while we're at it trim any slashes.
		// The directory path can be included as part of the class name,
		// but we don't want a leading slash
		$class = str_replace('.php', '', trim($class, '/'));

		// Was the path included with the class name?
		// We look for a slash to determine this
		if (($last_slash = strrpos($class, '/')) !== FALSE)
		{
			// Extract the path
			$subdir = substr($class, 0, ++$last_slash);

			// Get the filename from the path
			$class = substr($class, $last_slash);
		}
		else
		{
			$subdir = '';
		}

		$class = ucfirst($class);

		// Is this a stock library? There are a few special conditions if so ...
		if (file_exists(BASEPATH.'libraries/'.$subdir.$class.'.php'))
		{
			return $this->_ci_load_stock_addin_library($addin_namespace, $class, $subdir, $params, $object_name);
		}

		// Safety: Was the class already loaded by a previous call?
		if (class_exists($class, FALSE))
		{
			$property = $object_name;
			if (empty($property))
			{
				$property = strtolower($class);
				isset($this->_ci_varmap[$property]) && $property = $this->_ci_varmap[$property];
			}

			$CI =& get_instance();
			if (isset($CI->$property))
			{
				log_message('debug', $class.' class already loaded. Second attempt ignored.');
				return;
			}

			return $this->_ci_init_library($class, '', $params, $object_name);
		}

		// Let's search for the requested library file and load it.
		$filepath = ADDINSPATH . $addin_namespace . '/libraries/'.$subdir.$class.'.php';
		// Does the file exist? No? Bummer...
		if ( ! file_exists($filepath))
		{
			return;
		}

		include_once($filepath);
		return $this->_ci_init_library($class, '', $params, $object_name);

		// One last attempt. Maybe the library is in a subdirectory, but it wasn't specified?
		if ($subdir === '')
		{
			return $this->_ci_load_addin_library($addin_namespace, $class.'/'.$class, $params, $object_name);
		}

		// If we got this far we were unable to find the requested class.
		log_message('error', 'Unable to load the requested class: '.$class);
		show_error('Unable to load the requested class: '.$class);
	}

	// --------------------------------------------------------------------

	/**
	 * Module Internal CI Stock Library Loader
	 *
	 * @used-by	CI_Loader::_ci_load_library()
	 * @uses	CI_Loader::_ci_init_library()
	 *
	 * @param	string	$library_name	Library name to load
	 * @param	string	$file_path	Path to the library filename, relative to libraries/
	 * @param	mixed	$params		Optional parameters to pass to the class constructor
	 * @param	string	$object_name	Optional object name to assign to
	 * @return	void
	 */
	protected function _ci_load_stock_module_library($module_namespace, $library_name, $file_path, $params, $object_name)
	{
		$prefix = 'CI_';

		if (class_exists($prefix.$library_name, FALSE))
		{
			if (class_exists(config_item('subclass_prefix').$library_name, FALSE))
			{
				$prefix = config_item('subclass_prefix');
			}

			$property = $object_name;
			if (empty($property))
			{
				$property = strtolower($library_name);
				isset($this->_ci_varmap[$property]) && $property = $this->_ci_varmap[$property];
			}

			$CI =& get_instance();
			if ( ! isset($CI->$property))
			{
				return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
			}

			log_message('debug', $library_name.' class already loaded. Second attempt ignored.');
			return;
		}

		$paths = array(MODULESPATH.$module_namespace, BASEPATH);
		array_pop($paths); // BASEPATH
		array_pop($paths); // APPPATH (needs to be the first path checked)
		array_unshift($paths, MODULESPATH.$module_namespace);

		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$library_name.'.php'))
			{
				// Override
				include_once($path);
				if (class_exists($prefix.$library_name, FALSE))
				{
					return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
				}

				log_message('debug', $path.' exists, but does not declare '.$prefix.$library_name);
			}
		}

		include_once(BASEPATH.'libraries/'.$file_path.$library_name.'.php');

		// Check for extensions
		$subclass = config_item('subclass_prefix').$library_name;
		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$subclass.'.php'))
			{
				include_once($path);
				if (class_exists($subclass, FALSE))
				{
					$prefix = config_item('subclass_prefix');
					break;
				}

				log_message('debug', $path.' exists, but does not declare '.$subclass);
			}
		}

		return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
	}

	/**
	 * Addin Internal CI Stock Library Loader
	 *
	 * @used-by	CI_Loader::_ci_load_library()
	 * @uses	CI_Loader::_ci_init_library()
	 *
	 * @param	string	$library_name	Library name to load
	 * @param	string	$file_path	Path to the library filename, relative to libraries/
	 * @param	mixed	$params		Optional parameters to pass to the class constructor
	 * @param	string	$object_name	Optional object name to assign to
	 * @return	void
	 */
	protected function _ci_load_stock_addin_library($addin_namespace, $library_name, $file_path, $params, $object_name)
	{
		$prefix = 'CI_';

		if (class_exists($prefix.$library_name, FALSE))
		{
			if (class_exists(config_item('subclass_prefix').$library_name, FALSE))
			{
				$prefix = config_item('subclass_prefix');
			}

			$property = $object_name;
			if (empty($property))
			{
				$property = strtolower($library_name);
				isset($this->_ci_varmap[$property]) && $property = $this->_ci_varmap[$property];
			}

			$CI =& get_instance();
			if ( ! isset($CI->$property))
			{
				return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
			}

			log_message('debug', $library_name.' class already loaded. Second attempt ignored.');
			return;
		}

		$paths = array(ADDINSPATH.addin_namespace, BASEPATH);
		array_pop($paths); // BASEPATH
		array_pop($paths); // APPPATH (needs to be the first path checked)
		array_unshift($paths, ADDINSPATH.addin_namespace);

		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$library_name.'.php'))
			{
				// Override
				include_once($path);
				if (class_exists($prefix.$library_name, FALSE))
				{
					return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
				}

				log_message('debug', $path.' exists, but does not declare '.$prefix.$library_name);
			}
		}

		include_once(BASEPATH.'libraries/'.$file_path.$library_name.'.php');

		// Check for extensions
		$subclass = config_item('subclass_prefix').$library_name;
		foreach ($paths as $path)
		{
			if (file_exists($path = $path.'libraries/'.$file_path.$subclass.'.php'))
			{
				include_once($path);
				if (class_exists($subclass, FALSE))
				{
					$prefix = config_item('subclass_prefix');
					break;
				}

				log_message('debug', $path.' exists, but does not declare '.$subclass);
			}
		}

		return $this->_ci_init_library($library_name, $prefix, $params, $object_name);
	}
}
