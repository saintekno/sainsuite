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

class usersApiController extends MY_Addon
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($group_par = false)
	{
        $users = ($u = $this->aauth->list_users($group_par)) ? $u : [];

        return response()->json($users);
	}
}