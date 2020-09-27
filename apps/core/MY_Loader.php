<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
    }

	// --------------------------------------------------------------------

    /**
     * Module View
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
        return $this->_ci_load(array( '_ci_view' => '../addons/' . $addon_namespace . '/views/' . $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }
}
