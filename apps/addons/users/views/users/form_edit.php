<?php

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

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'users',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/users/edit/'.$user->id)
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 1,
            'heading'=> __('Personal Information'),
            'description' => 'Update your personal informaiton',
            'show' => true,
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_profile', array( 
                    array_merge(
                        ['user'=> $user], 
                        ['groups'=> $groups], 
                        ['user_group'=> $user_group], 
                        ['page'=> 'users']
                    )
                 ))
            )
        ]
    )
), 'users', 1);

// =============================================================================== 

$this->polatan->col_width(2, 4);

// load field for user_pass
$this->polatan->add_meta(array(
    'col_id' => 2,
    'namespace' => 'user_pass',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/users/edit/'.$user->id.'/change_password')
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 2,
            'heading'=> __('Change Password'),
            'show' => true,
            'description' => 'Change your account password',
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_pass', array( 
                    array_merge(
                        ['user'=>$user], 
                        ['page'=> 'users']
                    )
                 ))
            )
        ]
    )
), 'user_pass', 2);

// =============================================================================== 

$this->polatan->col_width(3, 4);

// load custom field for user creatin
$this->polatan->add_meta(array(
    'col_id' => 3,
    'namespace' => 'users_advanced',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/users/edit/'.$user->id)
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 3,
            'heading'=> __('Advanced'),
            'show' => true,
            'description' => 'Perform advanced options',
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_users_advanced', array( 
                    array_merge(
                        ['user'=> $user], 
                        ['page'=> 'users']
                    )
                 ))
            )
        ]
    )
), 'users_advanced', 3);

$this->polatan->output();