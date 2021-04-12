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
		// Get all users / by group
		$users = ($u = $this->aauth->list_users($group_par)) ? $u : [];
		return response()->json($users, JSON_PRETTY_PRINT);
	}

	public function get_user($id = false)
	{
		// Get single users with param id
        if (isset($_GET['id'])) {
			$result = (array) User::get($_GET['id']);
		}
		else {
			$result = (array) User::get($id);
		}
		$array['picture'] = User::get_user_image_url($result['id']);
		$key = User::get_user_group($result['id']);
		$array['group'] = $key->name;

		$response = array_merge($array, $result);
		return response()->json($response, JSON_PRETTY_PRINT);
	}
}