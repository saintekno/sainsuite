<?php

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

// User name

$this->polatan->add_item(array(
    'type'     => 'text',
    'label'    => __('User Name', 'aauth'),
    'name'     => 'username',
    'disabled' => true,
    'value'    => $this->user_model->current->username
), 'user_profile', 1);

// User email

$this->polatan->add_item(array(
    'type'  => 'text',
    'label' => __('User Email', 'aauth'),
    'name'  => 'user_email',
    'value' => $this->user_model->current->email
), 'user_profile', 1);

// user password

$this->polatan->add_item(array(
    'type'  => 'password',
    'label' => __('Old Password', 'aauth'),
    'name'  => 'old_pass',
), 'user_profile', 1);

$this->polatan->add_item(array(
    'type'  => 'password',
    'label' => __('New Password', 'aauth'),
    'name'  => 'password',
), 'user_profile', 1);

// user password config

$this->polatan->add_item(array(
    'type'  => 'password',
    'label' => __('Confirm New', 'aauth'),
    'name'  => 'confirm',
), 'user_profile', 1);

// load custom field for user creatin

$this->events->do_action('load_users_custom_fields', array(
    'mode'           => 'profile',
    'groups'         => array(),
    'meta_namespace' => 'user_profile',
    'col_id'         => 1,
    'gui'            => $this->polatan,
    'user_id'        => $this->user_model->current->id
));

$this->polatan->add_item( array(
    'type'    => 'dom',
    'content' => $this->load->addon_view( 'users', 'app-list', array(
        'apps' => $apps
    ), true )
), 'user_apps',  2 );

$this->polatan->output();