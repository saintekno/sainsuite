<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Pecee\SimpleRouter\SimpleRouter as Route;

class Admin extends MY_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->library('menu');
        $this->load->model('admin_model');
        $this->load->model('update_model');

        // Load Assets/JS
        $this->_dashboard_assets();

        // Loading Admin Menu
        $this->events->do_action( 'load_dashboard' );
    }

	// --------------------------------------------------------------------
    
    public function _dashboard_assets()
    {
        $this->enqueue->css_namespace( 'common_footer' );
    }

	// --------------------------------------------------------------------

	public function index()
	{
        $this->events->add_filter('toolbar_menu', function ($menus)
        {
            $menus[] = array(
                    'title'   => __('Graphic Report'),
                    'icon'    => 'svg/Thunder-move.svg',
                    'button'   => 'btn-white btn-hover-primary',
                    'href'    => site_url('admin')
            );
            return $menus;
        } );

        Html::set_title(sprintf(__('Dashboard &mdash; %s'), get('signature')));
        $data['page_name'] = $this->events->apply_filters('dashboard_home', $this->load->view( 'backend/home', null, true ));
		$this->load->view('backend/index', $data);
	}

	// --------------------------------------------------------------------

    /**
     * Remap controller methods
     */
    public function _remap($page, $params = array())
    {
        global $Routes;

        if (method_exists($this, $page)) {
            return call_user_func_array(array( $this, $page ), $params);
        } 
        else {
            // Init Routes
            $Routes = new Route();

            // prefixed route
            $Routes->group([ 
                'prefix' => substr( request()->getHeader( 'script-name' ), 0, -10 ) . '/admin' 
            ], function() use ( $page, $Routes ) {

                $addons = Addons::get();
                
                foreach( force_array($addons) as $namespace => $addon ) 
                {
					if( Addons::is_active( $namespace ) ) 
					{
                        if( is_dir( $dir = ADDONSPATH . $namespace . '/routes/' ) ) {
                            foreach( glob( $dir . "*.php") as $filename) {
                                include_once( $filename );
                            }
                        }
            
                        if( is_file( ADDONSPATH . $namespace . '/routes.php' ) ) {
                            include_once( ADDONSPATH . $namespace . '/routes.php' );
                        }
                    }
                }
            });
    
            // Show Errors
            $Routes->error(function($request, \Exception $exception) {
                return show_error( sprintf( 
                    __( 'The request returned the following message : %s<br>Code : %s'  ),
                    $exception->getMessage(),
                    $exception->getCode()
                ), intval( $exception->getCode() ) );
            });
            
            // Start Route
            $Routes->start();
        }
    }

    // --------------------------------------------------------------------
    
    public function addons($page = 'list', $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        $this->events->add_filter('toolbar_menu', function ($finals)
        {
            $finals[] = array(
                'title'   => __('List'),
                'icon'    => 'svg/list.svg',
                'button'   => 'btn-white btn-hover-primary',
                'href'    => site_url(array( 'admin', 'addons' ))
            );
            $finals[] = array(
                'title'   => __('Upload a zip file'),
                'icon'    => 'svg/upload.svg',
                'button'   => 'btn-light-primary',
                'href'    => site_url(array( 'admin', 'addons', 'install_zip' ))
            );
            return $finals;
        } );

        if ($page === 'list') 
        {
            // Can user access.addons ?
            if (! User::can('install.addons') ||
                ! User::can('update.addons') ||
                ! User::can('delete.addons') ||
                ! User::can('toggle.addons')
            ) {
                return show_error( __( 'You\'re not allowed to see that page' ) );
            }

            Html::set_title(sprintf(__('Addons List &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/addons/list', null, true );
            $this->load->view('backend/index', $data);
        }
        elseif ($page === 'install_zip') 
        {
            if (isset($_FILES[ 'extension_zip' ])) 
            {
                $notice = Addons::install('extension_zip');
                // it means that addon has been installed
                if (is_array($notice)) 
                {
                    // Introducing Migrate
                    if (@$notice[ 'msg' ] == 'addon-updated-migrate-required') 
                    {
                        redirect(array( 'admin', 'addons', 'migrate', @$notice[ 'namespace' ], @$notice[ 'from' ] ));
                    } 
                    else {
                        if (! isset($notice[ 'extra' ])) { 
                            $this->options_model->set(
                                'migration_' . @$notice[ 'namespace' ], 
                                @$notice[ 'from' ], 
                                @$notice[ 'namespace' ]);
                        };
                        redirect(array( 'admin', 'addons', 'list?highlight=' . @$notice[ 'namespace' ] . '&notice=' . $notice[ 'msg' ] . (isset($notice[ 'extra' ]) ? '&extra=' . $notice[ 'extra' ] : '') . '#addon-' . $notice[ 'namespace' ] ));
                    }
                } 
                else {
                    $this->notice->push_notice($this->lang->line($notice));
                }
            }

            Html::set_title(sprintf(__('Add a new extension &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/addons/install', null, true );
            $this->load->view('backend/index', $data);
        }
        elseif ($page === 'enable') 
        {
            Addons::enable($arg2);

            Addons::init('unique', $arg2);

            $this->events->do_action('do_enable_addon', $arg2);

            redirect(array( 'admin', 'addons?notice=' . $this->events->apply_filters('addon_activation_status', 'addon-enabled') ));
        }
        elseif ($page === 'disable') 
        {
            Addons::disable($arg2);

            $this->events->do_action('do_disable_addon', $arg2);

            redirect(array( 'admin', 'addons?notice=' . $this->events->apply_filters('addon_disabling_status', 'addon-disabled') ));

        }
        elseif ($page === 'sync') 
        {
            Addons::sync($arg2);
            
            redirect(array( 'admin', 'addons?notice=addon-sync' ));
        }
        elseif ($page === 'remove') 
        {
            Addons::init('unique', $arg2);
            
            $this->events->do_action('do_remove_addon', $arg2);

            Addons::uninstall($arg2);

            redirect(array( 'admin', 'addons?notice=addon-removed' ));
        }
        elseif ($page === 'extract') 
        {
            Addons::extract($arg2);

            $this->events->do_action('do_extract_addon', $arg2);
        }
        elseif ($page == 'migrate') 
        {
            if ( $arg3 === null ) {
                $arg3 = get_option( 'migration_' . $arg2, '1.0', $arg2);
            }

            $addon = Addons::get($arg2);
            $migrate_file = ADDONSPATH . $addon[ 'application' ][ 'namespace' ] . '/migrate.php';

			if (! $addon) {
                redirect(array( 'admin', 'addon-not-found' ));
            }

            $data['migrate_file'] = $migrate_file;
            $data['migrate_data'] = json_encode( array_keys( Addons::migration_files( 
                $addon[ 'application'][ 'namespace' ], 
                $arg3, 
                $addon[ 'application'][ 'version' ] 
            ) ) );
            $data['addon'] = $addon;

            HTML::set_title(sprintf(__('Migration &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/addons/migrate', null, true );
            $this->load->view('backend/index', $data);
        }
        elseif ($page == 'exec') 
        {
            $addon = Addons::get($arg2);
            
            ob_start();
            $migration_array = include_once(ADDONSPATH . $addon[ 'application' ][ 'namespace' ] . '/migrate.php');

            // If currrent migration version exists
            if (@ $migration_array[ $arg4 ]) 
            {
                // if is file path, it's included
                if (is_string($migration_array[ $arg4 ]) && is_file($migration_array[ $arg4 ])) 
                {
                    // we asume this file exists
                    $result = @include_once($migration_array[ $arg4 ]);
                    if ( $result === false ) {
                        return;
                    }
                } 
                // if it's callable, it's called
                elseif (is_callable($migration_array[ $arg4 ])) {
                    $function = $migration_array[ $arg4 ];
                    $function($addon);
                } 
                else {
                    $content = false;
                }

                // When migrate is done the last version key is saved as previous migration version
                // Next migration will start from here
                $this->options_model->set( 
                    'migration_' . $addon[ 'application' ][ 'namespace' ], 
                    $arg4,
                    $addon[ 'application' ][ 'namespace' ]);
            }

            // Handling error
            $content = ob_get_clean();

            // If not error occured
            if (empty($content)) 
            {
                echo json_encode(array(
                    'status'  => 'success',
                    'message' => __('Migration done.')
                ));
            } 
            else { 
                if ($content === false) 
                {
                    echo json_encode(array(
                        'status'  => 'failed',
                        'message' => sprintf(__('File not found or incorrect executable provided.'))
                    ));
                } 
                else {
                    echo json_encode(array(
                        'status'  => 'failed',
                        'message' => sprintf(__('An error occured'))
                    ));
                }
            }
        }
    }

    // --------------------------------------------------------------------
    
    public function themes($page = 'list', $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        $this->events->add_filter('toolbar_menu', function ($finals)
        {
            $finals[] = array(
                'title'   => __('List'),
                'icon'    => 'svg/list.svg',
                'button'   => 'btn-white btn-hover-primary',
                'href'    => site_url(array( 'admin', 'themes' ))
            );
            $finals[] = array(
                'title'   => __('Upload a zip file'),
                'icon'    => 'svg/upload.svg',
                'button'   => 'btn-light-primary',
                'href'    => site_url(array( 'admin', 'themes', 'install_zip' ))
            );
            return $finals;
        } );

        if ($page === 'list') 
        {
            // Can user access.addons ?
            if (! User::can('install.addons') ||
                ! User::can('update.addons') ||
                ! User::can('delete.addons') ||
                ! User::can('toggle.addons')
            ) {
                return show_error( __( 'You\'re not allowed to see that page' ) );
            }

            Html::set_title(sprintf(__('Themes List &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/home', null, true );
            $this->load->view('backend/index', $data);
        }
        elseif ($page === 'install_zip') 
        {
            Html::set_title(sprintf(__('Add a new themes &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/home', null, true );
            $this->load->view('backend/index', $data);
        }
        elseif ($page === 'enable') 
        {
            Addons::enable($arg2);

            Addons::init('unique', $arg2);

            $this->events->do_action('do_enable_addon', $arg2);

            redirect(array( 'admin', 'addons?notice=' . $this->events->apply_filters('addon_activation_status', 'addon-enabled') ));
        }
        elseif ($page === 'disable') 
        {
            Addons::disable($arg2);

            $this->events->do_action('do_disable_addon', $arg2);

            redirect(array( 'admin', 'addons?notice=' . $this->events->apply_filters('addon_disabling_status', 'addon-disabled') ));

        }
        elseif ($page === 'remove') 
        {
            Addons::init('unique', $arg2);
            
            $this->events->do_action('do_remove_addon', $arg2);

            Addons::uninstall($arg2);

            redirect(array( 'admin', 'addons?notice=addon-removed' ));
        }
        elseif ($page === 'extract') 
        {
            Addons::extract($arg2);

            $this->events->do_action('do_extract_addon', $arg2);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Options Management ocntroller
     * [New Permission Ready]
     *
     * @access public
     */

    public function options($mode = 'list')
    {
        if (in_array($mode, array( 'save', 'merge' ))) 
        {
            // Can user extract modules ?
            if (! User::can('create.options')) {
                return show_error( __( 'You\'re not allowed to see that page' ) );
            }

            if (! $this->input->post('gui_saver_ref') && ! $this->input->post('gui_json')) {
                // if JSON mode is enabled redirect is disabled
                redirect(array( 'admin', 'options' ));
            }

            if ($this->input->post('gui_saver_expiration_time') > gmt_to_local(time(), 'UTC')) 
            {
                // loping post value
                global $Options;
                foreach ($_POST as $key => $value) {
                    if (! in_array($key, array( 'gui_saver_ref', 'gui_saver_expiration_time' ))) {
                        $this->options_model->set(
                            $key, 
                            $this->input->post($key)
                        );
                    }
                };

                $ref = @$_SERVER[ 'HTTP_REFERER' ] === null ? $this->input->post('gui_saver_ref') : $_SERVER[ 'HTTP_REFERER' ];
                $hasQuery = strpos( $ref, '?' );
                redirect( $ref . ( $hasQuery === false ? '?' : '&' ) . 'notice=option-saved');
            }
        } 
    }

    // --------------------------------------------------------------------

    /**
     * Load Tendoo Setting Page
     * [New Permission Ready]
     * @return void
    **/

    public function settings()
    {
        // Can user access modules ?
        if (! User::can('create.options') &&
            ! User::can('edit.options') &&
            ! User::can('delete.options')
        ) {
            return show_error( __( 'You\'re not allowed to see that page' ) );
        }

        Html::set_title(sprintf(__('Settings &mdash; %s'), get('signature')));
        $data['page_name'] = $this->load->view( 'backend/settings', null, true );
		$this->load->view('backend/index', $data);
    }

    // --------------------------------------------------------------------

    /**
     * About controller
     * [New Permission Ready]
     *
     * @access public
     */

    public function about($page = 'home',  $version = null)
    {
        if (! User::can('manage.core')) {
            return show_error( __( 'You\'re not allowed to see that page' ) );
        }

        $this->events-> add_filter('gui_page_title', function () { // disabling header
            return;
        });


        if ($page === 'core') {
            Html::set_title(sprintf(__('Updating... &mdash; %s'), get('signature')));
            $data['page_name'] = $this->load->view( 'backend/update/core', array(
                'release' => $version
            ), true );
            $this->load->view('backend/index', $data);
        } 
        elseif ($page === 'download') {
            echo json_encode($this->update_model->install(1, $version));
        } 
        elseif ($page === 'extract') {
            echo json_encode($this->update_model->install(2));
        } 
        elseif ($page === 'install') {
            echo json_encode($this->update_model->install(3));
        } 
        else {
            Html::set_title(sprintf(__('About &mdash; %s'), get('signature')));
            $data['check'] = $this->update_model->check();
            $data['page_name'] = $this->load->view( 'backend/about', $data, true );
            $this->load->view('backend/index', $data);
        }
    }
}
