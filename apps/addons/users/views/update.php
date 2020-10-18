<?php

$this->polatan->col_width(1, 2);

$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'edit_user',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Edit User', 'aauth')
        )
    ),
    'type' => 'card'
));

// User name

$this->polatan->add_item(array(
    'type'     => 'text',
    'label'    => __('User Name', 'aauth'),
    'name'     => 'username',
    'disabled' => true,
    'value'    => $user->username
), 'edit_user', 1);

// User email

$this->polatan->add_item(array(
    'type'  => 'text',
    'label' => __('User Email', 'aauth'),
    'name'  => 'user_email',
    'value' => $user->email
), 'edit_user', 1);

// user password

$this->polatan->add_item(array(
    'type'  => 'password',
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
), 'edit_user', 1);

// add to a group
$groups_array = array();
foreach ($groups as $group) {
    $groups_array[ $group->id ] = $group->definition != null ? $group->definition : $group->name;
}
$this->polatan->add_item(array(
    'type'    => 'select',
    'label'   => __('Add to a group', 'aauth'),
    'name'    => 'userprivilege',
    'options' => $groups_array,
    'active'  => is_object($user_group) ? $user_group->group_id : null
), 'edit_user', 1);

$this->polatan->add_item(array(
    'type'    => 'select',
    'name'    => 'user_status',
    'label'   => __('User Status', 'aauth'),
    'options' => array(
        'default' => __( 'Default', 'aauth'),
        '0'       => __( 'Active' , 'aauth'),
        '1'       => __( 'Unactive' , 'aauth')
    ),
    'active' => $user->banned
), 'edit_user',1 );

// load custom field for user creatin

$this->events->do_action('load_users_custom_fields', array(
    'mode'           => 'edit',
    'groups'         => $groups_array,
    'meta_namespace' => 'edit_user',
    'col_id'         => 1,
    'gui'            => $this->polatan,
    'user_id'        => $user->id
));

$this->polatan->output();