<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

use Pecee\SimpleRouter\SimpleRouter as Route;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class Admin extends MY_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->library('menu');
        $this->load->model('admin_model');
        $this->load->model('update_model');

        // Loading Admin Menu
        $this->events->do_action( 'load_dashboard' );

        $this->_dashboard_assets();
        $this->events->add_action( 'common_footer', function(){
            $this->load->view('backend/script');
        });
    }
    
    /**
     * Assets login
     */
    public function _dashboard_assets()
    {
        $this->enqueue->css_namespace( 'common_header' );
        $this->enqueue->addon_css('datatables', 'datatables.bundle');
        
        $this->enqueue->js_namespace( 'common_footer' );
        $this->enqueue->js('angular.min', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/');
		$this->enqueue->js('underscore-min', 'https://cdn.jsdelivr.net/npm/underscore@1.11.0/');
		$this->enqueue->js('heartcode-canvasloader-min', 'https://cdn.jsdelivr.net/canvasloader-ui/0.9/');
        $this->enqueue->addon_js('datatables', 'datatables.bundle');
    }

	// --------------------------------------------------------------------

    /**
     * Rmap Controller
     *
     * @param [type] $page
     * @param array $params
     * @return void
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

            $Routes->error(function($request, \Exception $exception) {
                if($exception instanceof NotFoundHttpException && $exception->getCode() == 404) {
                    $this->session->set_flashdata('error_message', $exception->getMessage());
                    redirect(site_url('admin/page404'));
                }
            });
            
            // Start Route
            $Routes->start();
        }
    }

	// --------------------------------------------------------------------

    /**
     * Index
     *
     * @return void
     */
	public function index()
	{
        Polatan::set_title(sprintf(__('Dashboard &mdash; %s'), get('signature')));

        if (! empty($this->events->has_filter('load_dashboard_home'))) :
            $this->events->do_action('load_dashboard_home');
        else :
            $this->polatan->output();
        endif;
	}

    // --------------------------------------------------------------------
    
    /**
     * Addons
     *
     * @param string $page
     * @param [type] $arg2
     * @param [type] $arg3
     * @param [type] $arg4
     * @param [type] $arg5
     * @return void
     */
    public function addons($page = 'list', $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {        
        if ($page === 'list') 
        {
            // Can user access.addons ?
            if (! User::control('read.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            Polatan::set_title(sprintf(__('Addons List &mdash; %s'), get('signature')));
            $this->load->view( 'backend/addons/list' );
        }
        elseif ($page === 'install_zip') 
        {
            // Can user access.addons ?
            if (! User::control('install.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

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
        }
        elseif ($page === 'enable') 
        {
            // Can user access.addons ?
            if (! User::control('toggle.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            Addons::enable($arg2);

            Addons::init('unique', $arg2);

            $this->events->do_action('do_enable_addon', $arg2);

            redirect(array( 'admin', 'addons?notice=' . $this->events->apply_filters('addon_activation_status', 'addon-enabled') ));
        }
        elseif ($page === 'disable') 
        {
            // Can user access.addons ?
            if (! User::control('toggle.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

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
            // Can user access.addons ?
            if (! User::control('delete.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            Addons::init('unique', $arg2);
            
            $this->events->do_action('do_remove_addon', $arg2);

            Addons::uninstall($arg2);

            redirect(array( 'admin', 'addons?notice=addon-removed' ));
        }
        elseif ($page === 'extract') 
        {
            // Can user access.addons ?
            if (! User::control('extract.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            Addons::extract($arg2);

            $this->events->do_action('do_extract_addon', $arg2);
        }
        elseif ($page == 'migrate') 
        {
            // Can user access.addons ?
            if (! User::control('update.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

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

            Polatan::set_title(sprintf(__('Migration &mdash; %s'), get('signature')));
            $this->load->view( 'backend/addons/migrate');
        }
        elseif ($page == 'exec') 
        {
            // Can user access.addons ?
            if (! User::control('install.addons')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

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
    
    /**
     * Themes
     *
     * @param string $page
     * @param [type] $arg2
     * @param [type] $arg3
     * @param [type] $arg4
     * @param [type] $arg5
     * @return void
     */
    public function themes($page = 'list', $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        if ($page === 'list') 
        {
            // Can user access.addons ?
            if (! User::control('install.addons') ||
                ! User::control('update.addons') ||
                ! User::control('delete.addons') ||
                ! User::control('toggle.addons')
            ) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            Polatan::set_title(sprintf(__('Themes List &mdash; %s'), get('signature')));
            $this->polatan->output();
            // $this->load->view( 'backend/theme/index' );
        }
        elseif ($page === 'install_zip') 
        {
            // 
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
            if (! User::control('edit.options')) {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
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
        elseif (in_array($mode, array( 'save_user_meta', 'merge_user_meta' ))) 
        {
            if (! User::control('edit.profile')) 
            {
                $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
                redirect(site_url('admin/page404'));
            }

            if ($this->input->post('gui_saver_expiration_time') >  gmt_to_local(time(), 'UTC')) 
            {
                $content = array();
                // loping post value
                foreach ($_POST as $key => $value) 
                {
                    if (! in_array($key, array( 'gui_saver_option_namespace', 'gui_saver_ref', 'gui_saver_expiration_time', 'gui_saver_use_namespace', 'user_id' ))) 
                    {
                        if ($mode == 'merge_user_meta' && is_array($value)) 
                        {
                            $options = $this->aauth->get_user_var($key);
                            $options = array_merge(force_array($options), $value);
                        }

                        // save only when it's not an array
                        if (! is_array($_POST[ $key ])) {
                            if ($this->input->post('gui_saver_use_namespace') === 'true') {
                                $content[ $key ] = ($mode == 'merge') ? $options : $this->input->post($key);
                            } 
                            else {
                                if ($mode == 'merge_user_meta' && is_array($value)) {
                                    $this->aauth->set_user_var($key, $options, $this->input->post('user_id'));
                                } else {
                                    $this->aauth->set_user_var($key, $this->input->post($key), $this->input->post('user_id'));
                                }
                            }
                        } 
                        else {
                            if ($this->input->post('gui_saver_use_namespace') === 'true') {
                                $content[ $key ] = ($mode == 'merge') ? $options : xss_clean($_POST[ $key ]);
                            } 
                            else {
                                if ($mode == 'merge_user_meta' && is_array($value)) {
                                    $this->aauth->set_user_var($key, $options, $this->input->post('user_id'));
                                } else {
                                    $this->aauth->set_user_var($key, xss_clean($_POST[ $key ]), $this->input->post('user_id'));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Load Setting Page
     * [New Permission Ready]
     * @return void
    **/
    public function settings()
    {
        // Can user access modules ?
        if (! User::control('create.options') &&
            ! User::control('read.options')
        ) {
            $this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
            redirect(site_url('admin/page404'));
        }

        Polatan::set_title(sprintf(__('Settings &mdash; %s'), get('signature')));
        $this->load->view( 'backend/settings/index');
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
        $this->events-> add_filter('gui_page_title', function () { // disabling header
            return;
        });

        if ($page === 'core') {
            Polatan::set_title(sprintf(__('Updating... &mdash; %s'), get('signature')));
            $data['release'] = $version;
            $data['update'] = $this->update_model->get($version);
            $this->load->view( 'backend/about/update', $data );
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
        elseif ($page === 'updated') {
            echo json_encode($this->update_model->install(4));
        } 
        else {
            $this->load->library('markdown');
            Polatan::set_title(sprintf(__('About &mdash; %s'), get('signature')));
            // Can user access modules ?
            $data['check'] = (! User::control('manage.core') ) ? false : $this->update_model->check();
            $this->load->view( 'backend/about/index', $data );
        }
    }

    // --------------------------------------------------------------------

    /**
     * page404 controller
     * [New Permission Ready]
     *
     * @access public
     */
    public function page404()
    {
        if ($this->session->flashdata('error_message') == ""):
            return redirect(site_url('admin'));
        endif;
        
        Polatan::set_title(sprintf(__('404 &mdash; %s'), get('signature')));
        Polatan::set_page('404');
        $this->polatan->output();
    }
}
