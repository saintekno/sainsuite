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
        if (riake('enable_frontend', $Options) && intval(riake('enable_frontend', $Options)) == false) {
            redirect($this->config->item('login_route') . '?notice=redirect=' . urlencode(current_url()) );
        }
	}

	public function index()
	{
        $data = $this->events->apply_filters('load_website_index', []);
        $data['pages'] = 'home';
        $this->load->frontend_view( 'layouts', $data );
	}

    // not found page
    public function error_404()
    {
        $this->load->frontend_view( 'layouts_404' );
    }
}
