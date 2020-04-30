<?php

class Modules
{
    private static $modules;

    private static $addins;
    
    private static $actives = array();

    private static $config_module = 'module.json';

    private static $manifest_module = 'manifest.json';

    private static $allowed_app_folders = array( 'controllers' );

    public function __construct()
    {
        get_instance()->load->library('Filer');
    }

	// --------------------------------------------------------------------

    /**
     * Load Modules
     */

    public static function load($module_path, $deepness = 0, $type = 'default' )
    {
        if ($deepness < 2) 
        { 
            // avoid multi-folder parsing
            $dir    = opendir($module_path);
            $config = array();

            // Looping currend folder
            while (false !== ($file = readdir($dir))) {
                if (substr($file, -11) === self::$config_module) {
                    $config = json_decode(file_get_contents($module_path . '/' . $file), true);
                } elseif (is_dir($module_path . '/' . $file) && ! in_array($file, array( '.', '..' ))) {
                    self::load($module_path . '/' .$file, $deepness + 1, $type ); // Only top folder are parsed
                }
            }

            // Adding Valid init file to module array
            // only namespace is required for a module to be valid
            if (isset($config[ 'application' ][ 'namespace' ])) {
                $namespace = strtolower($config[ 'application' ][ 'namespace' ]);
                // Saving details
				if( $type == 'addins' ) {
                	self::$addins[ $namespace ]     =    $config;
				} else {
					self::$modules[ $namespace ]        =    $config;
				}
                // Edit main file path
                if (isset($config[ 'application' ][ 'main' ])) {
					if( $type == 'addins' ) {
						self::$addins[ $namespace ][ 'application' ][ 'main' ]    =    $module_path . '/' .  self::$addins[ $namespace ][ 'application' ][ 'main' ];
					} else {
						self::$modules[ $namespace ][ 'application' ][ 'main' ]    =    $module_path . '/' .  self::$modules[ $namespace ][ 'application' ][ 'main' ];
					}
                }

				if( $type == 'addins' ) {
					self::$addins[ $namespace ][ 'application' ][ 'namespace' ]    =    strtolower(self::$addins[ $namespace ][ 'application' ][ 'namespace' ]);
				} else {
					self::$modules[ $namespace ][ 'application' ][ 'namespace' ]    =    strtolower(self::$modules[ $namespace ][ 'application' ][ 'namespace' ]);
                }
            }

            // Check for language directory
            /**
             * Module namespace is used as text domain
            **/
            if (isset($config[ 'application' ][ 'language' ])) {
                if (is_dir(APPPATH . 'modules/' . $namespace . '/' . $config[ 'application' ][ 'language' ])) {
                    $text_domain    =    get_instance()->config->item('text_domain');
                    $text_domain[ $namespace ]     =    APPPATH . 'modules/' . $namespace . '/' . $config[ 'application' ][ 'language' ];
                    get_instance()->config->set_item('text_domain', $text_domain);
                }
            }

            if (isset($config[ 'application' ][ 'language' ])) {
                if (is_dir(APPPATH . 'addins/' . $namespace . '/' . $config[ 'application' ][ 'language' ])) {
                    $text_domain    =    get_instance()->config->item('text_domain');
                    $text_domain[ $namespace ]     =    APPPATH . 'addins/' . $namespace . '/' . $config[ 'application' ][ 'language' ];
                    get_instance()->config->set_item('text_domain', $text_domain);
                }
            }
        }
    }

	// --------------------------------------------------------------------

    /**
     * Get
     *
     * Get a module using namespace provided as unique parameter
     */
    public static function get($namespace = null, $type = 'default' )
    {
        if ($namespace == null) 
        {
            return ( $type == 'addins' ) ? self::$addins : self::$modules;
        }

        if( $type == 'addins' ) 
        {
			return isset(self::$addins[ $namespace ]) ? self::$addins[ $namespace ] : false; // if module exists
        } 
        else 
        {
			return isset(self::$modules[ $namespace ]) ? self::$modules[ $namespace ] : false; // if module exists
		}
    }

	// --------------------------------------------------------------------

    /**
     * Init
     *
     * Init module or modules using defined filters and parameter
     */
    public static function init($filter, $module_namespace = null, $type = 'default')
    {
        global $Options;

        if ($module_namespace != null) 
        {
            $modules = ( $type == 'addins' ) ? self::get( $module_namespace, 'addins' ) : self::get( $module_namespace );

            if ( isset($modules[ 'application' ][ 'main' ])
                && is_file($init_file = $modules[ 'application' ][ 'main' ])
                && $filter === 'unique'
            ) {
                Modules::includesIncFiles( $modules );
                include_once($init_file);
                return; // after special init return;
            }
        } 
        else 
        {
            $modules = ( $type == 'addins' ) ? self::get( null, 'addins' ) : self::get();
        }

		$modules_array = array();

        foreach ( ( array ) $modules as $module) 
        {
            $init_file = $module[ 'application' ][ 'main' ];

            // Load every module when on install mode
            if ( ! isset($module[ 'application' ][ 'main' ])
                && ! is_file($init_file)
            ) { 
                return;
            }
            
            // if a main file isset
            if ( $filter === 'all' ) 
            {
                Modules::includesIncFiles( $module );
                include_once($init_file);
            } 
            else if ( $filter === 'actives' ) 
            {
                // print_array( $module );
                if (!isset($actives_modules)) 
                {
                    $actives_modules = ( array ) @$Options[ 'actives_modules' ];
                }

                if (in_array(strtolower($module[ 'application' ][ 'namespace' ]), $actives_modules)) 
                {
                    self::$actives[] = $module[ 'application' ][ 'namespace' ];
                    // Check compatibility and other stuffs
                    Modules::includesIncFiles( $module );
                    include_once($init_file);
                }
            }
        }
    }

	// --------------------------------------------------------------------

    public static function includesIncFiles( $module )
    {
        /**
         * auto include all from inc folder
         * for an autoloading and a better looking code
         */
         if ( ! empty( $module[ 'application' ][ 'includes' ] ) ) {
            $autoIncludes   =   explode( ',', $module[ 'application' ][ 'includes' ] );
            foreach( $autoIncludes as $folder ) {
                $path   =   MODULESPATH . $module[ 'application' ][ 'namespace' ] . "/$folder/";
                $files  =   glob( $path . '/*.php');

                foreach( $files as $filename) {
                    include_once( $filename );
                }
            }
        }
    }

	// --------------------------------------------------------------------

    /**
     * Is Active
     *
     * Checks whether a module is active
     */
    public static function is_active($module_namespace, $fresh = false)
    {
        global $Options;

        if ($fresh === true) 
        {
            $activated_modules = @$Options[ 'actives_modules' ];
        } 
        else 
        {
            $activated_modules = self::$actives;
        }

        if ( in_array( $module_namespace, ( array ) $activated_modules, true ) ) 
        {
            return true;
        }
        return false;
    }

	// --------------------------------------------------------------------

    /**
     *  Check dependency
     *  Checks whether a plugin dependency is installed. Otherwise that module is disabled
     * 
     *  Cek module dependency sudah terinstall, jika belum maka module di disable
     */
    public static function checkDependency( $module_namespace )
    {
        $module = self::get( $module_namespace );

        if( isset( $module[ 'application' ][ 'dependencies' ] ) && count( @$module[ 'application' ][ 'dependencies' ] ) > 0 ) 
        {
            $dependencies_data = $module[ 'application' ][ 'dependencies' ];
            if( is_array( @$dependencies_data[ 'module' ] ) ) 
            {
                $keys = array_keys( @$dependencies_data[ 'module' ] );
                
                if( in_array( $keys[0], array( '@value' ) , true ) ) 
                {
                    $dependencies = array( $dependencies_data[ 'module' ] );
                } 
                else 
                {
                    $dependencies = $dependencies_data[ 'module' ];
                }

                foreach( $dependencies as $dependency ) 
                {
                    if( ! self::is_active( $dependency[ '@attributes' ][ 'namespace' ], true ) ) 
                    {
                        get_instance()->notice->push_notice(
                            Do_info(
                                sprintf(
                                    __( '<strong>%s</strong> has been disabled. This module require <strong>%s</strong> to work properly.'),
                                    $module[ 'application' ][ 'name' ],
                                    $dependency[ '@value' ]
                                )
                            )
                        );
                        self::disable( $module[ 'application'][ 'namespace' ] );
                    }
                }
            }             
        }
    }

	// --------------------------------------------------------------------

    /**
     *  Run dependency checker
     *  @return void
     * 
     *  Jalankan dependency
     */
    public static function runDependency()
    {
        global $Options;

        $modules = self::get();
        foreach( $modules as $module ) 
        {
            if( in_array( $module[ 'application' ][ 'namespace' ], ( array ) @$Options[ 'actives_modules' ] ) ) 
            {
                self::checkDependency( $module[ 'application' ][ 'namespace' ] );
            }
        }
    }

	// --------------------------------------------------------------------

    /**
     * Enable
     *
     * Enable a module using namespace provided
     */
    public static function enable($module_namespace)
    {
        global $Options; // get Global Options

        // Get Module
        $module = self::get($module_namespace);
        if ($module) 
        {
            $activated_modules = ( array ) @$Options[ 'actives_modules' ];
            if (! in_array($module_namespace, force_array($activated_modules))) 
            {
                $activated_modules[] = $module_namespace;
                get_instance()->options->set('actives_modules', $activated_modules, true);
                $Options[ 'actives_modules' ] = $activated_modules;
            }
        }
        // if module doesn't exists
        return false;
    }

    // --------------------------------------------------------------------

    /**
    * Disable
    *
    * Disable module using namespace provided as unique parameter
    */
    public static function disable($module_namespace)
    {
        global $Options;

        $activated_modules = @$Options[ 'actives_modules' ];
        if ( in_array( $module_namespace, $activated_modules ) ) 
        {
            $key = array_search( $module_namespace, $activated_modules );
            unset( $activated_modules[ $key ] );
            $Options[ 'actives_modules' ] = $activated_modules;
            get_instance()->options->set( 'actives_modules', $activated_modules, true);
        }
    }

	// --------------------------------------------------------------------

    /**
     * Install
     *
     * Install a module from a $_FILE provided
     */
    public static function install( $file_name, $asFile = true )
    {
        $config[ 'allowed_types' ] = 'zip';
        $config[ 'upload_path' ]   = APPPATH . '/' . 'temp' . '/';
        $config[ 'max_size' ]      = 50000;

        get_instance()->load->library('upload', $config);

        if (! get_instance()->upload->do_upload($file_name)) 
        {
            get_instance()->notice->push_notice(get_instance()->lang->line('fetch-from-upload'));
        } 
        else 
        {
            $data = array( 'upload_data' => get_instance()->upload->data() );
            return self::__treatZipFile( $data );           
        }
    }

	// --------------------------------------------------------------------

    /**
     * Uninstall
     *
     * Uninstall a module using namespace provided
     */
    public static function uninstall($module_namespace)
    {
        // Disable first
        self::disable($module_namespace);

        $module        = self::get($module_namespace);
        $modulepath    = MODULESPATH . $module_namespace;
        $manifest_file = $modulepath . '/' . self::$manifest_module;

        if (is_file($manifest_file)) 
        {
            $manifest_array = json_decode(file_get_contents($manifest_file), true);
            // removing file
            foreach ($manifest_array as $file) 
            {
                if (is_file($file)):
                    unlink($file);
                endif;
            }
        }

        // Drop Module Folder
        Filer::drop($modulepath);

        // Drop Assets Folder
        if (is_dir($module_assets_folder = FCPATH . 'modules' . '/' . $module_namespace)) {
            Filer::drop($module_assets_folder);
        }
    }

	// --------------------------------------------------------------------

    /**
     * Scan
     *
     * Extract an module with all his dependency
     */
    public static function extract($module_namespace)
    {
        $module = self::get($module_namespace);
        if ($module) 
        {
            get_instance()->load->library('zip');
            get_instance()->load->helper('security');

            $module_temp_folder_name = do_hash($module_namespace);
            $module_installed_dir    = MODULESPATH  . $module_namespace . '/';

            // creating temp folder
            $temp_folder = APPPATH . 'temp' . '/' . $module_temp_folder_name;
            if (!is_dir($temp_folder)) 
            {
                mkdir($temp_folder);
            }

            // check manifest
            if (is_file($manifest = $module_installed_dir . self::$manifest_module)) 
            {
                $manifest_content = file_get_contents($manifest);
                $manifest_array   = json_decode($manifest_content);

                //var_dump( $manifest_content );
                // manifest is valid
                if (is_array($manifest_array)) 
                {
                    // var_dump( $manifest_array );
                    // moving manifest file to temp folder
                    foreach (self::$allowed_app_folders as $reserved_folder) 
                    {
                        foreach ($manifest_array as $file) 
                        {
                            //var_dump( $path_id_separator = APPPATH . $reserved_folder );
                            if (strstr($file, $path_id_separator = APPPATH . $reserved_folder)) 
                            {
                                // we found a a file
                                $path_splited = explode($path_id_separator, $file);
                                //var_dump( $path_splited );
                                Filer::file_copy(
                                    APPPATH . $reserved_folder . $path_splited[1],
                                    $temp_folder . '/' . $reserved_folder . $path_splited[1]
                                );
                            }
                        }
                    }
                }
            }

            $assets_path = FCPATH . 'modules' . '/' . $module_namespace;
            // Copy Assets to
            if (is_dir($assets_path)) 
            {
                // create assets folder
                if (!is_dir($temp_folder . '/' . 'assets')) 
                {
                    mkdir($temp_folder . '/' . 'assets');
                }

                Filer::copy($assets_path, $temp_folder . '/' . 'assets');
            }

            // move module file to temp folder
            Filer::copy($module_installed_dir, $temp_folder);

            // read temp folder and download it
            get_instance()->zip->read_dir(APPPATH . 'temp/' . $module_temp_folder_name . '/', false);

            // delete temp folder
            Filer::drop($temp_folder);

            get_instance()->zip->download($module_namespace . '-' . $module[ 'application' ][ 'version' ]);
        }
    }

	// --------------------------------------------------------------------

    /**
     * Get Migration Files
    **/
    public static function migration_files( $namespace, $from, $to )
    {
        $saved_files = [];
        
        if( $from == null || $to == null ) 
        {
            return $saved_files;
        }

        if( ! is_file( MODULESPATH . $namespace . '/migrate.php' ) ) 
        {
            return $saved_files;
        }

        $migration_files = include( MODULESPATH . $namespace . '/migrate.php' );

        foreach( $migration_files as $version => $_file ) 
        {         
            if( version_compare( $version, $from, '>' ) && version_compare( $version, $to, '<=' ) ) 
            {
                $saved_files[ $version ][] = $_file;
            }
        }

        return $saved_files;
    }

	// --------------------------------------------------------------------

    /**
     * Treat Zip File
     */
    public static function __treatZipFile( $data )
    {
        $extraction_temp_path = self::__unzip( $data );
        $config_temp_path = $extraction_temp_path . '/' . self::$config_module;

        // Look for module.json file to read config
        if (file_exists($config_temp_path)) 
        {
            // If module.json file has at least a namespace parameter
            $module_array = json_decode(file_get_contents($config_temp_path), true);
            if (isset($module_array[ 'application' ][ 'namespace' ])) 
            {
                $module_namespace = $module_array[ 'application' ][ 'namespace' ];
                $old_module = self::get($module_namespace);

                // if module with a same namespace already exists
                if ($old_module) 
                {
                    if (isset($old_module[ 'application' ][ 'version' ])) 
                    {
                        $old_version = $old_module[ 'application' ][ 'version' ];
                        $new_version = $module_array[ 'application' ][ 'version' ];

                        if (version_compare($new_version, $old_version, '>')) 
                        {
                            $module_global_manifest = self::__parse_path($extraction_temp_path);

                            if (is_array($module_global_manifest)) 
                            {
                                // Remove the old module. No SQL uninstall queries will be triggered.
                                self::uninstall( $module_array[ 'application' ][ 'namespace' ] );

                                // Install the new version
                                $response = self::__move_to_module_dir($module_array, $module_global_manifest[0], $module_global_manifest[1], $data);
                                // if is file
                                $migrate_file = MODULESPATH . $module_array[ 'application' ][ 'namespace' ] . '/migrate.php';
                                // Delete temp file
                                Filer::drop($extraction_temp_path);

                                // Enable back the module
                                self::enable($module_array[ 'application' ][ 'namespace' ]);

                                if ($response !== true) {
                                    return $response;
                                } 
                                else 
                                {
                                    if (is_file($migrate_file)) 
                                    {
                                        return array(
                                            'namespace' => $module_array[ 'application' ][ 'namespace' ],
                                            'from'      => $old_module[ 'application' ][ 'version' ],
                                            'msg'       => 'module-updated-migrate-required'
                                        );
                                    }

                                    // If Migration is not require then we enable back the module
                                    Modules::enable( $module_array[ 'application' ][ 'namespace' ] );

                                    // Return details
                                    return array(
                                        'namespace' => $module_array[ 'application' ][ 'namespace' ],
                                        'from'      => $old_module[ 'application' ][ 'version' ],
                                        'msg'       => 'module-updated'
                                    );
                                }
                            }

                            // If it's not an array, return the error code.
                            return $module_global_manifest;
                        }

                        // Delete temp file
                        Filer::drop($extraction_temp_path);
                        return 'old-version-cannot-be-installed';
                    }

                    /**
                     * Update is done only when module has valid version number
                     * Update is done only when new module version is higher than the old version
                    **/

                    // Delete temp file
                    Filer::drop($extraction_temp_path);
                    return 'unable-to-update';
                }
                // if module does'nt exists
                else {
                    $module_global_manifest = self::__parse_path($extraction_temp_path);
                    
                    // print_array($module_global_manifest);
                    if (is_array($module_global_manifest)) 
                    {
                        $response = self::__move_to_module_dir($module_array, $module_global_manifest[0], $module_global_manifest[1], $data, true);

                        // Delete temp file
                        Filer::drop($extraction_temp_path);

                        if ($response !== true) {
                            return $response;
                        } 
                        else {
                            return array(
                                'namespace' => $module_array[ 'application' ][ 'namespace' ],
                                'msg'       => 'module-installed'
                            );
                        }
                    }
                    // If it's not an array, return the error code.
                    return $module_global_manifest;
                }
            }

            // Delete temp file
            Filer::drop($extraction_temp_path);
            return 'incorrect-config-file';
        }

        // Delete temp file
        Filer::drop($extraction_temp_path);
        return 'config-file-not-found';
    }

	// --------------------------------------------------------------------

    /**
     * Unzip
     *
     * Unzip an Uploaded Module
     */
    public static function __unzip($upload_details)
    {
        $extraction_path = $upload_details[ 'upload_data' ][ 'file_path' ] . $upload_details[ 'upload_data' ][ 'raw_name' ] ;
        
        // If temp path does'nt exists
        if (! is_dir($extraction_path)): mkdir($extraction_path);
        endif;

        get_instance()->load->library('unzip');

        get_instance()->unzip->extract(
            $upload_details[ 'upload_data' ][ 'full_path' ],
            $extraction_path
        );

        get_instance()->unzip->close();
        // delete zip file

        if (is_file($upload_details[ 'upload_data' ][ 'full_path' ])): unlink($upload_details[ 'upload_data' ][ 'full_path' ]);
        endif;

        // Fix module installed from Github
        if (! file_exists($extraction_path . '/' . self::$config_module)) 
        {
            $temp_dir = opendir($extraction_path);

            while (false !== ($file = readdir($temp_dir))) 
            {
                if (! in_array($file, array( '.', '..' ))) 
                {
                    $fileRawName = str_replace( '.', '_', $file );
                    // if within this folder a config file exists
                    if (file_exists($extraction_path . '/' . $file . '/' . self::$config_module)) 
                    {
                        Filer::copy($extraction_path . '/' . $file, $extraction_path); // moving folder to the top parent folder
                        Filer::drop($extraction_path . '/' . $file);
                    }
                }
            }
        }

        return $extraction_path;
    }

	// --------------------------------------------------------------------

    /**
     * Parse Path
     *
     * Parse Path to register manifest files [for intenal use]
     */
    public static function __parse_path($path)
    {
        $manifest = array();
        $module_manifest = array();
        if ($dir = opendir($path)) 
        {
            while (false !== ($file = readdir($dir))) 
            {
                if (! in_array($file, array( '.', '..' ), true)) 
                {
                    // Set sub dir path
                    $sub_dir_path = $path;
                    
                    // If a correct folder is found
                    if (in_array($file, self::$allowed_app_folders) && is_dir($path . '/' . $file)) 
                    {
                        // check manifest
                        if (is_file($json = $sub_dir_path . '/' . self::$manifest_module)) 
                        {
                            $manifest_content = file_get_contents($json);
                            $manifest_array   = json_decode($manifest_content);
                        }

                        // manifest is valid
                        if (! empty($manifest_array) && is_array($manifest_array)) 
                        // if (false)
                        {
                            $module_manifest = array_merge($module_manifest, self::__scan($sub_dir_path . '/' . $file));

                            foreach (self::$allowed_app_folders as $reserved_folder) 
                            {
                                foreach ($manifest_array as $data) 
                                {
                                    // we found a a data
                                    $path_id_separator = APPPATH . $reserved_folder;
                                    $path_splited = explode($path_id_separator, $data);
                                    $file_manifest = $sub_dir_path .'/'. $reserved_folder . $path_splited[1];

                                    if (strstr($data, $path_id_separator)) {
                                        $manifest[] = $file_manifest;
                                    }

                                    if (($key = array_search($file_manifest, $module_manifest)) !== false) {
                                        unset($module_manifest[$key]);
                                    }
                                }
                            }
                        }
                        else {
                            // print_array(self::__scan($sub_dir_path . '/' . $file));
                            $manifest = array_merge($manifest, self::__scan($sub_dir_path . '/' . $file));
                        }
                    }
                    // for other file and folder, they are included in module dir
                    else 
                    {
                        $module_manifest[] = $sub_dir_path . '/' . $file;
                    }
                }
            }
            closedir($dir);
            // print_array(array( $module_manifest , $manifest ));

            // When everything seems to be alright
            return array( $module_manifest , $manifest );
        }
        return 'extraction-path-not-found';
    }

	// --------------------------------------------------------------------

    /**
     * Scan
     *
     * Scan folder and returns content as array
     */
    public static function __scan($folder)
    {
        $files_array = array();
        if (is_dir($folder)) 
        {
            $folder_res = opendir($folder);
            while (false !== ($file = readdir($folder_res))) 
            {
                if (! in_array($file, array( '.', '..' ))) 
                {
                    if (is_dir($folder . '/' . $file)) 
                    {
                        $files_array = array_merge($files_array, self::__scan($folder . '/' . $file));
                    } 
                    else 
                    {
                        $files_array[] = $folder . '/' . $file;
                    }
                }
            }

            closedir($folder_res);
            return $files_array;
        }

        return false;
    }

	// --------------------------------------------------------------------

    /**
     * Mode To Module Dir
     *
     * Move module temp fil to valid module folder [for internal use only]
     */
    public static function __move_to_module_dir($module_array, $global_manifest, $manifest, $extraction_data, $conflict_checker = false)
    {
        $module_namespace = $module_array[ 'application' ][ 'namespace' ]; // module namespace
        
        if ($conflict_checker === true) 
        {
            // Check first
            foreach ($manifest as $_manifest_file) 
            {
                // removing raw_name from old manifest to ease copy
                $relative_path_to_file = explode($extraction_data[ 'upload_data' ][ 'raw_name' ] . '/', $_manifest_file);
                $_manifest_file        = APPPATH . $relative_path_to_file[1];

                if (file_exists($_manifest_file)) : return array(
                    'msg'   => 'file-conflict',
                    'extra' => urlencode($_manifest_file)
                );
                endif;
            }
        }

        get_instance()->load->helper('file');
        $folder_to_lower = strtolower($module_namespace);
        $module_dir_path = MODULESPATH . $folder_to_lower;

        // Creating module folder within
        if (! is_dir($module_dir_path)) 
        {
            mkdir($module_dir_path, 0777, true);
        }

        // moving global manifest
        foreach ($global_manifest as $_manifest) 
        {
            // creating folder if it does'nt exists
            if (! is_file($_manifest)) 
            {
                $dir_name = basename($_manifest);
                Filer::copy($_manifest, $module_dir_path . '/' . $dir_name);
            } 
            else 
            {
                $file_name = basename($_manifest);
                foreach (self::$allowed_app_folders as $reserved_folder) 
                {
                    // removing raw_name from old manifest to ease copy
                    $relative_path_to_file = explode($extraction_data[ 'upload_data' ][ 'raw_name' ] . '/', $_manifest);
                    if (strstr($_manifest, $path_id_separator = $extraction_data[ 'upload_data' ][ 'raw_name' ] . '/'. $reserved_folder)) 
                    {
                        Filer::file_copy($_manifest,  $module_dir_path .'/'. $relative_path_to_file[1]);
                    }
                    else {
                        write_file($module_dir_path . '/' . $file_name, file_get_contents($_manifest));
                    }
                }
            }
        }
        
        // moving manifest to system folder
        $relative_json_manifest = array();
        foreach ($manifest as $_manifest) 
        {
            // removing raw_name from old manifest to ease copy
            $relative_path_to_file = explode($extraction_data[ 'upload_data' ][ 'raw_name' ] . '/', $_manifest);

            if (! is_file($_manifest)) 
            {
                $dir_name = basename($_manifest);
                Filer::copy($_manifest, $relative_path_to_file[1]);
            } 
            else 
            {
                // write file on the new folder
                Filer::file_copy($_manifest,  APPPATH . $relative_path_to_file[1]);
                // relative json manifest
                $relative_json_manifest[] = APPPATH . $relative_path_to_file[1];
            }
        }

        // Creating Manifest
        file_put_contents($module_dir_path . '/' . self::$manifest_module, json_encode($relative_json_manifest));

        // move module assets to public directory within a folder with namespace as name
        if (is_dir($module_dir_path . '/' . 'assets')) 
        {
            if (is_dir(FCPATH . 'modules' . '/' . $module_namespace)) 
            { 
                // checks if module folder exists on public folder
                Filer::drop(FCPATH . 'modules' . '/' . $module_namespace);
            }

            mkdir(FCPATH  . 'modules' . '/' . $module_namespace); // creating module folder within
            Filer::extractor($module_dir_path . '/' . 'assets', FCPATH . 'modules' . '/' . $module_namespace);
        }

        return true;
    }
}
