<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.5
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Admin Home controller
 *
 * The base controller which handles visits to the admin area homepage in the app.
 */
class Home extends Admin_Controller
{
	/**
	 * Controller constructor sets the login restriction
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict();
	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Redirects the user to the Content context
	 *
	 * @return void
	 */
    public function index()
    {
        $this->load->model('roles/role_model');

        $user_role = $this->role_model->find($this->current_user->role_id);
        $default_context = ($user_role !== false && isset($user_role->default_context)) ? $user_role->default_context : '';
        redirect(SITE_AREA .'/'.(isset($default_context) && !empty($default_context) ? $default_context : 'content'));
    }//end index()

	//--------------------------------------------------------------------


}//end class