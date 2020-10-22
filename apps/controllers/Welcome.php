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
        if (! empty($this->events->has_filter('load_frontend'))) :
            $this->events->do_action('load_frontend');
        else :
            $this->load->view( 'frontend/'.theme().'/home' );
        endif;
	}
}
