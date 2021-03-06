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
class Resets_Addons extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
        
        $this->lang->load_lines(dirname(__FILE__) . '/language/*.php');
    }
}
new Resets_Addons;

include_once(dirname(__FILE__) . '/events/install.php');