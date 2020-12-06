<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class MY_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
    }

	// --------------------------------------------------------------------

    /**
     * Addon View
     *
     * @param string addon namespace
     * @param string path
     * @param array var
     * @param bool return of no
     * @return string/object
    **/

    public function addon_view($addon_namespace, $view, $vars = array(), $return = false)
    {
        $view = str_replace( '.', '/', $view );
        return $this->_ci_load(array( 
            '_ci_view' => '../addons/' . $addon_namespace . '/views/' . $view, 
            '_ci_vars' => $this->_ci_prepare_view_vars($vars), 
            '_ci_return' => $return));
    }

	// --------------------------------------------------------------------

    /**
     * Backend View
     *
     * @param string path
     * @param array var
     * @param bool return of no
     * @return string/object
    **/

    public function backend_view( $view, $vars = array(), $return = false)
    {
        return $this->_ci_load(array( 
            '_ci_view' => get_instance()->config->item('backend_path') . theme_backend() . $view, 
            '_ci_vars' => $this->_ci_prepare_view_vars($vars), 
            '_ci_return' => $return));
    }

	// --------------------------------------------------------------------

    /**
     * Frontend View
     *
     * @param string path
     * @param array var
     * @param bool return of no
     * @return string/object
    **/

    public function frontend_view($view, $vars = array(), $return = false)
    {
        return $this->_ci_load(array( 
            '_ci_view' => get_instance()->config->item('frontend_path') . theme_frontend() . $view, 
            '_ci_vars' => $this->_ci_prepare_view_vars($vars), 
            '_ci_return' => $return));
    }
}
