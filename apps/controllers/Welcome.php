<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        if (! empty($this->events->has_filter('load_frontend'))) :
            $this->events->do_action('load_frontend');
        else :
            $this->load->view( 'frontend/'.theme().'/home' );
        endif;
	}
}
