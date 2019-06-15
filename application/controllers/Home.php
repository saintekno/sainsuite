<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.1
 * @link      https://github.com/boedwinangun/racik
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

        $this->load->library('installer');
        if (! $this->installer->is_installed()) {
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available, since
        // we're not extending from a Racik controller
        // and it's not done for us.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}

	//--------------------------------------------------------------------

	/**
	 * Displays the homepage
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('users/auth');
		$this->set_current_user();

		Template::render();
	}

	//--------------------------------------------------------------------

	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded. By not requiring
	 * this to be executed and loaded for every command, we can speed up calls
	 * that don't need users at all, or rely on a different type of auth, like
	 * an API or cronjob.
	 *
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
		if (class_exists('Auth')) 
		{
			// Load our current logged in user for convenience
			if ($this->auth->is_logged_in()) 
			{
				$this->current_user = clone $this->auth->user();

				$this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

				// if the user has a language setting then use it
                if (isset($this->current_user->language)) {
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
}
