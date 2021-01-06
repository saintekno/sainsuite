<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('welcome_model');
		
		if (! get_instance()->install_model->is_installed()) : 
			redirect('install');
		endif;
	}

	public function index()
	{
		$this->events->do_action(
			$this->events->apply_filters('load_frontend', 'load_frontend_home')
		);
	}
}
