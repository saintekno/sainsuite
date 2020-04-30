<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eracik_Module extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	// --------------------------------------------------------------------

    public function module_view( $namespace, $view, $params, $return )
    {
        return $this->load->module_view( $namespace, $view, $params, $return );
    }
}
