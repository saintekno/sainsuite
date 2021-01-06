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
class Users_Addons extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
        
        $this->lang->load_lines(dirname(__FILE__) . '/language/*.php');

        $this->load->library('aauth');
        $this->load->library('user');
        
        $this->load->model('user_model');
    }
}
new Users_Addons;

include_once(dirname(__FILE__) . '/events/actions.php');
include_once(dirname(__FILE__) . '/events/install.php');
include_once(dirname(__FILE__) . '/events/filters.php');

if (get_instance()->install_model->is_installed()) {
    include_once(dirname(__FILE__) . '/events/menu.php');
}