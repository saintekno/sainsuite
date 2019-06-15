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
 * Content context controller
 *
 * The controller which displays the homepage of the Content context.
 *
 */
class Content extends Admin_Controller
{


	/**
	 * Controller constructor sets the Title and Permissions
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		Template::set('toolbar_title', 'Content');

		$this->auth->restrict('Site.Content.View');
	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Displays the initial page of the Content context
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set_view('admin/content/index');
		Template::render();
	}//end index()

	//--------------------------------------------------------------------


}//end class