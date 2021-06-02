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
        
        global $Options;
        if (! riake('enable_frontend', $Options)) {
            redirect($this->config->item('login_route') . '?redirect=' . urlencode(current_url()) );
        }
	}

	public function index()
	{
        $data['pages'] = 'home';
        $this->load->frontend_view( 'layouts', $this->events->apply_filters('fill_website_index', $data) );
	}

    // not found page
    public function error_404()
    {
        $data['pages'] = '404';
        $this->load->frontend_view( 'layouts', $this->events->apply_filters('fill_website_index', $data) );
    }
}
