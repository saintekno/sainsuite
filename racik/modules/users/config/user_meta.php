<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * An open source project to allow developers to Starter Web App of CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.2
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

//------------------------------------------------------------------------------
// User Meta Fields Config - These are just examples of various options
// The following examples show how to use regular inputs, select boxes,
// state and country select boxes.
//------------------------------------------------------------------------------

$config['user_meta_fields'] =  array(

	array(
		'name'   => 'state',
		'label'   => lang('user_meta_state'),
        'rules'         => 'trim|max_length[3]',
		'form_detail' => array(
			'type' => 'state_select',
			'settings' => array(
				'name'		=> 'state',
				'id'		=> 'state',
                'maxlength' => '3',
				'class'		=> 'span1'
			),
		),
	),
	array(
		'name'   => 'country',
		'label'   => lang('user_meta_country'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'country_select',
			'settings' => array(
				'name'		=> 'country',
				'id'		=> 'country',
				'maxlength'	=> '100',
				'class'		=> 'span6'
			),
		),
	),
);