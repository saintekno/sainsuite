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

$this->polatan->add_col(array(
    'width' => 1,
    'class' => 'flex-row-auto offcanvas-mobile aside-profile',
    'id'=> 'kt_profile_aside',
), 1);

$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'profile',
    'type' => 'card'
));

$this->polatan->add_item( array(
    'type'    => 'dom',
    'content' => $this->addon_view( 'users', 'profile/avatar', array(), true )
), 'profile',  1 );

$this->polatan->add_item( array(
    'type'    => 'dom',
    'content' => $this->addon_view( 'users', 'profile/menu', array(), true )
), 'profile',  1 );


// =============================================================================== 
$this->polatan->add_col(array(
    'width' => 3,
    'class' => 'flex-row-fluid',
), 2);

// =============================================================================== 

// load field for user_profile
$this->polatan->add_meta(array(
    'col_id' => 2,
    'namespace' => 'user_profile',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/profile')
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 1,
            'heading'=> __('Personal Information'),
            'description' => 'Update your personal informaiton',
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_profile', array( 
                    array_merge(
                        ['user'=> User::get()], 
                        ['page'=> 'profile']
                    )
                 ))
            )
        ]
    )
), 'user_profile', 2);

// =============================================================================== 

// load field for user_pass
$this->polatan->add_meta(array(
    'col_id' => 2,
    'namespace' => 'user_pass',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/profile/change_password')
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 2,
            'heading'=> __('Change Password'),
            'description' => 'Change your account password',
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_pass', array( 
                    array_merge(
                        ['user'=> User::get()], 
                        ['page'=> 'profile']
                    )
                 ))
            )
        ]
    )
), 'user_pass', 2);

// =============================================================================== 

// load custom field for user creatin
$this->polatan->add_meta(array(
    'col_id' => 2,
    'namespace' => 'users_advanced',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/profile')
    ),
));
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 3,
            'heading'=> __('Advanced'),
            'description' => 'Perform advanced options',
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_users_advanced', array( 
                    array_merge(
                        ['user'=> User::get()], 
                        ['page'=> 'profile']
                    )
                 ))
            )
        ]
    )
), 'users_advanced', 2);

$this->polatan->output();