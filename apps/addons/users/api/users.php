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

	public function index($group_par = 'api')
	{
        $users = ($u = $this->aauth->list_users($group_par)) ? $u : [];

        return response()->json($users, JSON_PRETTY_PRINT);
	}

	public function get_user($user_id = false)
	{
		$result = (array) $this->aauth->get_user($user_id);
		$array['picture'] = User::get_user_image_url($result['id']);
		foreach ($this->aauth->get_user_groups($result['id']) as $key) {
			$array['group'] = $key->name;
		}

		$response = array_merge($array, $result);

		return response()->json($response);
	}
}