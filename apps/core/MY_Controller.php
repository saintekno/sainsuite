<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load Global Lang lines
        $this->lang->load_lines(APPPATH . '/language/*.php');
        
        // Load Addons
        Addons::load(ADDONSPATH);

        // if is installed, setup is always loaded
        if ( $this->install_model->is_installed() ) 
        {
            // load new connection
            @$this->load->database(); 

            // Load Language
            $this->load->model('options_model');
            $this->load->model('aauth_model');

            //init active addons
            Addons::init('actives'); 
            
            // language is set on dashboard
            $this->options_model->defineLanguage();

            // add events
            $this->events->do_action('app_init');
        }
        // Only for controller requiring installation
        elseif ($this->uri->segment(1) === 'install' && $this->uri->segment(2) === 'database') 
        {
			$this->events->add_action('before_db_setup', function () {
				// this hook let modules being called during tendoo installation
				// Only when site name is being defined
				Addons::init('all');
            });
        }
        
        // Checks system status
        if ( in_array(
                $this->uri->segment(1), 
                $this->config->item('reserved_controllers')
            ) || 
            $this->uri->segment(1) === null
        ) {
            // there are some section which need to be installed. Before getting there, controller checks if for those
            // section is installed. If segment(1) returns null, it means the current section is index. Even for index,
            // installation is required
            if ( 
                ( 
                    in_array(
                        $this->uri->segment(1), 
                        $this->config->item('controllers_requiring_installation')
                    ) || $this->uri->segment(1) === null
                ) && ! $this->install_model->is_installed()
            ) {
                redirect('install');
            }

            // Load Assets/JS
            $this->_load_assets();

            // Add Common content
            $this->events->add_action( 'common_header', [ $this, '_common_header' ] );
            $this->events->add_action( 'common_footer', [ $this, '_common_footer' ] );
        }
    }

    public function _common_header()
    {
        $this->enqueue->load_css( 'common_header' );
        $this->enqueue->load_js( 'common_header' );
    }

    public function _common_footer()
    {
        $this->enqueue->load_js( 'common_footer' );
        $this->load->view('scripts');
    }

    /**
     * Load Assets (css & JS)
     */
    public function _load_assets()
    {
        /**
         * 	Enqueueing Js
        **/
        $css_libraries = $this->events->apply_filters( 'default_css_libraries', array(
            'plugins.bundle',
            'style.bundle',
        ));
        
        if ( is_array( $css_libraries ) ) 
        {
            $this->enqueue->css_namespace( 'common_header' );
            foreach ($css_libraries as $value) 
            {
                $this->enqueue->css($value);
            }
        }

        /**
         * 	Enqueueing Js
        **/
        $js_libraries = $this->events->apply_filters( 'default_js_libraries', array(
            'app.settings',
            'plugins.bundle',
            'scripts.bundle',
        ));
        
        if ( is_array( $js_libraries ) ) 
        {
            $this->enqueue->js_namespace( 'common_footer' );
            foreach ($js_libraries as $value) 
            {
                $this->enqueue->js($value);
            }
        }
    }
}