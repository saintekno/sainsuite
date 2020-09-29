<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $this->events->do_action('load_frontend', $this->load->view( 'frontend/'.theme().'/home') );
	}
}