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

/**
 * Extended Settings Fields Config.
 *
 * The following examples show how to use regular inputs, select boxes, and
 * state/country select boxes.
 *
 * Note: the name field is limited to 26 characters.
 * 
 */
$config['extended_settings_fields'] = array(
    array(
        'name'        => 'street_name',
        'label'       => lang('user_meta_street_name'),
        'rules'       => 'trim|max_length[100]',
        'form_detail' => array(
            'type'     => 'input',
            'settings' => array(
                'name'      => 'street_name',
                'id'        => 'street_name',
                'maxlength' => '100',
                'class'     => 'span6',
            ),
        ),
        'permission'  => 'Site.Settings.View',
    ),
    array(
        'name'        => 'country',
        'label'       => lang('user_meta_country'),
        'rules'       => 'required|trim|max_length[100]',
        'form_detail' => array(
            'type'     => 'country_select',
            'settings' => array(
                'name'      => 'country',
                'id'        => 'country',
                'maxlength' => '100',
                'class'     => 'span6'
            ),
        ),
    ),
    array(
        'name'        => 'state',
        'label'       => lang('user_meta_state'),
        'rules'       => 'trim|max_length[2]',
        'form_detail' => array(
            'type'     => 'state_select',
            'settings' => array(
                'name'      => 'state',
                'id'        => 'state',
                'maxlength' => '2',
                'class'     => 'span1'
            ),
        ),
        'permission'  => 'Site.Content.View',
    ),
    array(
        'name'        => 'type',
        'label'       => lang('user_meta_type'),
        'rules'       => 'required',
        'form_detail' => array(
            'type'     => 'dropdown',
            'settings' => array(
                'name'   => 'type',
                'id'     => 'type',
                'class'  => 'span6',
            ),
            'options'  =>  array(
                'small'  => 'Small Shirt',
                'med'    => 'Medium Shirt',
                'large'  => 'Large Shirt',
                'xlarge' => 'Extra Large Shirt',
              ),
        ),
    ),
);
