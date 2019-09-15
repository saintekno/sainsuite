<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.0
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Activities
 * Display user activity
 */
class Activities extends Admin_Controller
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

        $this->lang->load('activities/activities');
		$this->load->model('activities/activity_model');
	}
    
    //------------------------------------------------------------------------------

	/**
	 * Display the Activities for a module
	 *
	 * @param string $module Name of the module
	 * @param int    $limit  The number of activities to return
	 *
	 * @return string Displays the activities
	 */
	public function activity_list($module = null, $limit = 25)
	{
        $this->auth->restrict('Activities.Module.View');

		if (empty($module)) {
			log_message('debug', lang('activities_list_no_module'));
			return;
		}

		$this->activity_model->order_by('created_on', 'desc')
                             ->limit($limit, 0);

		$this->load->view(
            'activity_list',
            array('activities' => $this->activity_model->find_by_module($module))
        );
	}
}