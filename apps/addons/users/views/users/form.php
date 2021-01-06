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

$this->polatan->col_width(1, 2);

$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'users',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Submit User', 'aauth')
        )
    ),
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'     => 'text',
    'required'  => true,
    'cols' => array(
        [
            'label'    => __('User Name', 'aauth'),
            'name'     => 'username',
            (isset($user)) ? 'disabled' : '' => true,
            'value'    => (isset($user)) 
                ? set_value('username', $user->username) 
                : set_value('username'),
        ],
        [
            'label' => __('User Email', 'aauth'),
            'name'  => 'user_email',
            (isset($user)) ? 'disabled' : '' => true,
            'value'    => (isset($user)) 
                ? set_value('user_email', $user->email) 
                : set_value('user_email'),
        ]
    )
), 'users', 1);

(isset($user))  
    ? $this->polatan->add_item(array(
            'type'  => 'password',
            'label' => __('Old Password', 'aauth'),
            'name'  => 'old_pass',
        ), 'users', 1) : '';

$this->polatan->add_item(array(
    'type'  => 'password',
    'required'  => (isset($user)) ? false : true,
    'cols' => array(
        [
            'label' => __('New Password', 'aauth'),
            'name'  => 'password',
        ],
        [
            'label' => __('Confirm New', 'aauth'),
            'name'  => 'confirm',
        ]
    )
), 'users', 1);

$this->polatan->add_item(array(
    'type'    => 'select',
    'name'    => 'user_status',
    'label'   => __('User Status', 'aauth'),
    'options' => array(
        'default' => __( 'Default', 'aauth'),
        '0'       => __( 'Active' , 'aauth'),
        '1'       => __( 'Unactive' , 'aauth')
    ),
    'active' => (isset($user)) 
        ? $user->banned 
        : ''
), 'users',1 );

$groups_array = array();
foreach ($groups as $group) {
    $groups_array[ $group->id ] = $group->definition != null ? $group->definition : $group->name;
}
$this->polatan->add_item(array(
    'type'    => 'select',
    'label'   => __('Add to a group', 'aauth'),
    'name'    => 'userprivilege',
    'disabled' => ($groups_array) ? false : true,
    'options' => $groups_array,
    'active'  => (isset($user_group)) ? $user_group->group_id : null
), 'users', 1);

$this->events->do_action('load_users_custom_fields', array(
    'meta_namespace' => 'users',
    'col_id'         => 1,
    'gui'            => $this->polatan,
    'user_id'        => (isset($user)) ? $user->id : null 
));

$this->polatan->output();