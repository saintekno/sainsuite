<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eracik_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // get system lang
        $this->load->library('html');
        $this->load->library('modules');
        $this->load->library('enqueue');
        $this->load->library('notice');

        // Include default library class
        include_once( APPPATH . 'core/Eracik_Module.php' );
        include_once( APPPATH . 'core/Eracik_Api.php' );
        include_once( APPPATH . 'third_party/PHP-po-parser-master/src/Sepia/InterfaceHandler.php');
        include_once( APPPATH . 'third_party/PHP-po-parser-master/src/Sepia/FileHandler.php');
        include_once( APPPATH . 'third_party/PHP-po-parser-master/src/Sepia/PoParser.php');
        include_once( APPPATH . 'third_party/PHP-po-parser-master/src/Sepia/StringHandler.php');
        
        // Load Global Lang lines
        $this->lang->load_lines(APPPATH . '/language/*.php');

        // Load Modules
		Modules::load( ADDINSPATH, 0, 'addins' );
        Modules::load( MODULESPATH );

        // Global Vars
        global $CurrentMethod, $CurrentScreen, $CurrentParams;

        $CurrentMethod = $this->uri->segment(2);
        $CurrentScreen = $this->uri->segment(1);
        $CurrentParams = $this->uri->segment_array();
        $CurrentParams = count($CurrentParams) > 2 ? array_slice($CurrentParams, 2) : array();

        // if is installed, setup is always loaded
        if ( $this->setup->is_installed() ) 
        {
            /**
             * Load Session, Database and Options
            **/
            $this->load->library('session');

            @$this->load->database(); // load new connection
            $this->load->model('options');

            // Delete expired api keys
            $this->load->addin_library( 'oauth', 'OauthLibrary' );
            $this->oauthlibrary->deleteExpiredKeys( now() );

            // Check dependencies
            Modules::runDependency();

            // Get Active Modules and load it
			Modules::init( 'all', null, 'addins' );
            Modules::init( 'actives' );

            $this->events->do_action('after_app_init');
        }

        // Only for controller requiring installation
        if ($this->uri->segment(1) === 'do-setup' 
            && $this->uri->segment(2) === 'database'
        ) {
			$this->events->add_action('before_db_setup', function () {
				// this hook let modules being called during eracik installation
				// Only when site name is being defined
				Modules::init('all', null, 'addins' );
				Modules::init('all');
            });
        }

        // Checks system status
        if (
            in_array(
                $this->uri->segment(1), 
                $this->config->item('reserved_controllers')
            ) || 
            $this->uri->segment(1) === null
        ) {
            // null for index page

            // there are some section which need eracik to be installed. Before getting there, eracik controller checks if for those
            // section eracik is installed. If segment(1) returns null, it means the current section is index. Even for index,
            // installation is required
            if ((   
                in_array(
                    $this->uri->segment(1), 
                    $this->config->item('controllers_requiring_installation')
                ) || 
                $this->uri->segment(1) === null
                ) && 
                ! $this->setup->is_installed()
            ) {
                redirect(array( 'do-setup' ));
            }

            // Add Common content
            $this->events->add_action( 'common_header', [ $this, '_common_header' ] );
            // Add Common content
            $this->events->add_action( 'common_footer', [ $this, '_common_footer' ] );
        }
    }

	// --------------------------------------------------------------------

    public function _common_header()
    {
        // loading assets for reserved controller
        $css_libraries = $this->events->apply_filters( 'default_css_libraries', array(
            'assets/bootstrap/css/bootstrap.min',
            'assets/font-awesome/css/font-awesome.min',
            'assets/sweetalert2/sweetalert2.min',
            'css/AdminLTE',
            'css/skins/_all-skins',
            'css/eracik.core',
            'css/toast'
        ) );

        if ( is_array( $css_libraries ) ) {
            $this->enqueue->css_namespace( 'common_header' );
            foreach ($css_libraries as $lib) {
                $this->enqueue->asset_css($lib);
            }
        }

        // Enqueueing Js
        $js_libraries = $this->events->apply_filters( 'default_js_libraries', array(
            'assets/jquery/jquery.min',
            'assets/bootstrap/js/bootstrap.min',
            'assets/sweetalert2/sweetalert2.min',
            'assets/icheck/icheck.min',
            'js/adminlte.min',
            'js/toast'
        ) );

        if ( is_array( $js_libraries ) ) {
            $this->enqueue->js_namespace( 'common_header' );
            foreach ($js_libraries as $lib) {
                $this->enqueue->asset_js($lib);
            }
        }

        $this->enqueue->load_css( 'common_header' );
        $this->enqueue->load_js( 'common_header' );
    }

	// --------------------------------------------------------------------

    public function _common_footer()
    {
        $this->enqueue->js_namespace( 'common_footer' );
        $this->enqueue->asset_js( 'assets/angular/angular.min' );

        $this->enqueue->load_js( 'common_footer' );
    }
}
