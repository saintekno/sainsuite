<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package     Racik
 * @copyright   Copyright (c) 2019
 * @version     1.0.0
 * @link        https://github.com/boedwinangun/racik
 * @filesource
 */

class Home extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();

		// Load Helper
		$this->load->helper('application');
		
		// Load Lang
		$this->lang->load('application');

		// Load Library
		$this->load->library('template');
		$this->load->library('assets');
		$this->load->library('events');

		// Check Installed
        $this->load->library('installer/setupinstaller');
		if (! $this->setupinstaller->is_installed()) 
		{
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}

	//--------------------------------------------------------------------

	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded.
	 * 
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
        // load class Auth
        if (! class_exists('Auth', false)) 
        {
            $this->load->library('users/auth');
		}
		
		if (class_exists('Auth')) 
		{
			// Load our current logged in user for convenience
			if ($this->auth->is_logged_in()) 
			{
				$this->current_user = clone $this->auth->user();

				// get user image
				$this->current_user->user_img = gravatar_link(
					$this->current_user->email, 
					22, 
					$this->current_user->email, 
					"{$this->current_user->email} Profile"
				);

				// if the user has a language setting then use it
				if (isset($this->current_user->language)) 
				{
					$this->config->set_item('language', $this->current_user->language);
				}
			} 
			else 
			{
				$this->current_user = null;
			}
			
			Template::set('current_user', $this->current_user);
		}
	}

	//--------------------------------------------------------------------

	/**
	 * Displays the homepage
	 *
	 * @return void
	 */
	public function index()
	{
		$this->set_current_user();

		Template::render();
	}
}
