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
class GroupsHomeController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read()
    {
        // Title
        Polatan::set_title(__('Groups'));
        $this->polatan->output();
    }
}