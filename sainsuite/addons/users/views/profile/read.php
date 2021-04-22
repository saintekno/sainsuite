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

// load field for user_profile
$this->polatan->add_col(array(
    'class' => 'p-10 p-lg-0 flex-row-auto offcanvas-mobile w-200px',
    'id'=> 'kt_profile_aside',
), 1);

$this->polatan->add_meta(array(
    'col_id'    => 1,
    'class'     => 'col-12',
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

// load field for user_profile
$this->polatan->add_col(array(
    'class' => 'flex-row-fluid ml-lg-5',
), 2);

// load field for user_profile
$this->polatan->add_meta(array(
    'col_id' => 2,
    'class'     => 'col-12',
    'namespace' => 'user_profile',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/profile')
    ),
));
$user_profile[] = array(
    'id' => 1,
    'class' => 'card-header-light',
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
);
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => $user_profile
), 'user_profile', 2);

// =============================================================================== 

// load field for user_pass
$this->polatan->add_meta(array(
    'col_id' => 2,
    'class'     => 'col-12',
    'namespace' => 'user_pass',
    'gui_saver' => true,
    'type' => 'card',
    'form' => array(
        'action' => site_url('admin/profile/change_password')
    ),
));
$user_pass[] = array(
    'id' => 2,
    'class' => 'card-header-light',
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
);
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => $user_pass
), 'user_pass', 2);

// =============================================================================== 

$this->polatan->output();