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
class Admin_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();   
          
        $this->events->add_filter( 'dashboard_dev_class', array( $this, 'dashboard_dev_class' ) );
        $this->events->add_filter( 'dashboard_skin_class', array( $this, 'dashboard_skin_class' ), 5, 1);

        // Load CSS and JS
        $this->events->add_action( 'dashboard_header', array( $this, '_dashboard_header' ), 1 );
        $this->events->add_action( 'dashboard_footer', array( $this, '_dashboard_footer' ), 1 );
    }

    /**
     *  Dashboard header
     *  @param void
     *  @return void
    **/

    public function _dashboard_header()
    {
        $this->enqueue->css_namespace( 'dashboard_header' );
        $this->enqueue->css('plugins.bundle');
        $this->enqueue->css('style.bundle');
        $this->enqueue->css('datatables.bundle');
        $this->enqueue->css('skin/all');
        $this->enqueue->load_css( 'dashboard_header' );

        $this->load->backend_view('settings.js.php');
        $this->enqueue->js_namespace( 'dashboard_header' );
        $this->enqueue->js('plugins.bundle');
        $this->enqueue->js('scripts.bundle');
        $this->enqueue->load_js( 'dashboard_header' );
    }

    /**
     *  Dashboard Footer
     *  @param void
     *  @return void
    **/

    public function _dashboard_footer()
    {
        $this->enqueue->js_namespace( 'dashboard_footer' );
        $this->enqueue->js('angular.min', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/');
		$this->enqueue->js('underscore-min', 'https://cdn.jsdelivr.net/npm/underscore@1.11.0/');
		$this->enqueue->js('heartcode-canvasloader-min', 'https://cdn.jsdelivr.net/canvasloader-ui/0.9/');
        $this->enqueue->js('datatables.bundle');
        $this->enqueue->load_js( 'dashboard_footer' );
        $this->load->backend_view('scripts.js.php');
    }

    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_skin_class($class)
    {
        global $User_Options;
        // skin is defined by default
        $class = ($db_skin = riake('theme-skin', $User_Options)) ? ((in_array($db_skin, ['skin-light', 'skin-dark'])) ? $db_skin : $class) : $class;
        return $class;
    }

    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_dev_class($class)
    {
        // skin is defined by default
        $class = (riake('webdev_mode', options(APPNAME))) ? 'checked="checked"' : '';
        return $class;
    }
}
