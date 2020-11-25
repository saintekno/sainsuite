<?php

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

$this->polatan->col_width(1, 2);
$this->polatan->col_width(2, 2);

$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'user_profile',
    'gui_saver' => true,
    'form'      => array(
        'action' => null
    ),
    'footer'    =>    array(
        'submit'    =>    array(
            'label' => __('Edit User')
        )
    ),
    'type' => 'card'
));

// User name

$this->polatan->add_item(array(
    'type'     => 'text',
    'cols'  => array(
        [
            'label'    => __('User Name', 'aauth'),
            'name'     => 'username',
            'disabled' => true,
            'value'    => set_value('username', User::get()->username) 
        ],
        [
            'label' => __('User Email', 'aauth'),
            'name'  => 'user_email',
            'value'    => set_value('user_email', User::get()->email) 
        ]
    )
), 'user_profile', 1);

// user password

$this->polatan->add_item(array(
    'type'  => 'password',
    'label' => __('Old Password', 'aauth'),
    'name'  => 'old_pass',
), 'user_profile', 1);

$this->polatan->add_item(array(
    'type'  => 'password',
    'cols'  => array(
        [
            'label' => __('New Password', 'aauth'),
            'name'  => 'password',
        ],
        [
            'label' => __('Confirm New', 'aauth'),
            'name'  => 'confirm',
        ]
    )
), 'user_profile', 1);

// load custom field for user creatin

$this->events->do_action('load_users_custom_fields', array(
    'meta_namespace' => 'user_profile',
    'col_id'         => 1,
    'gui'            => $this->polatan,
    'user_id'        => User::get()->id
));

// Connected Apps
$this->polatan->add_meta(array(
    'col_id'    => 2,
    'title'     => __( 'Connected Applications' , 'aauth'),
    'namespace' => 'user_apps',
    'gui_saver' => false,
    'form'      => array(
        'action' => null
    )
));

$this->polatan->add_item( array(
    'type'    => 'dom',
    'content' => $this->addon_view( 'users', 'app-list', array(
        'apps' => $apps
    ), true )
), 'user_apps',  2 );

$this->polatan->output();