<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load Global Lang lines
        $this->lang->load_lines(APPPATH . '/language/*.php');
        
        // Load Addons
        include_once( APPPATH . 'core/MY_Addon.php' );
        MY_Addon::load( ADDONSPATH );

        // if is installed, setup is always loaded
        if ( $this->install_model->is_installed() ) 
        {
            // load new connection
            @$this->load->database(); 

            // Load Language
            $this->load->model('options_model');
            // language is set on dashboard
            $this->options_model->defineLanguage();

            //init active addons
            MY_Addon::init('unique', 'saas');
            MY_Addon::init('actives'); 

            // add events
            $this->events->do_action('app_init');
        }
        // Only for controller requiring installation
        elseif ($this->uri->segment(1) === 'install' && $this->uri->segment(2) === 'database') 
        {
			$this->events->add_action('before_db_setup', function () {
				// this hook let addons being called during installation
				// Only when site name is being defined
				MY_Addon::init('all');
            });
        }
        
        // Checks system status
        if ( 
            in_array( $this->uri->segment(1), $this->config->item('reserved_controllers') ) 
            || $this->uri->segment(1) === null
        ) {
            // there are some section which need to be installed. Before getting there, controller checks if for those
            // section is installed. If segment(1) returns null, it means the current section is index. Even for index,
            // installation is required
            if (( 
                    in_array( $this->uri->segment(1), $this->config->item('controllers_requiring_installation') ) 
                    || $this->uri->segment(1) === null
                ) 
                && ! $this->install_model->is_installed()
            ) {
                redirect('install');
            }

            // Add Common content
            $this->events->add_action( 'common_header', [ $this, '_common_header' ] );
            $this->events->add_action( 'common_footer', [ $this, '_common_footer' ] );
        }
    }

    public function _common_header()
    {
        // Enqueueing header
        $this->enqueue->css_namespace( 'common_header' );
        $this->enqueue->css('plugins.bundle');
        $this->enqueue->css('style.bundle');
        $this->enqueue->load_css( 'common_header' );

        $this->enqueue->js_namespace( 'common_header' );
        $this->enqueue->js('plugins.bundle');
        $this->enqueue->js('scripts.bundle');
        $this->enqueue->load_js( 'common_header' );
    }

    public function _common_footer()
    {
        // Enqueueing footer
        $this->enqueue->js_namespace( 'common_footer' );
        $this->enqueue->js('settings');
        $this->enqueue->load_js( 'common_footer' );
        $this->load->view('notify');
    }
}