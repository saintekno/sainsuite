<?php

/**
 * Col Width
 */
$this->polatan->col_width(1, 4);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'create_user',
    'form' => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Create User', 'aauth')
        )
        ),
    'type' => 'card'
));

/**
 * Item
 */
// User name
$this->polatan->add_item(array(
    'type'  => 'text',
    'label' => __('User Name', 'aauth'),
    'name'  => 'username',
), 'create_user', 1);

// User email
$this->polatan->add_item(array(
    'type'  => 'text',
    'label' => __('User Email', 'aauth'),
    'name'  => 'user_email',
), 'create_user', 1);

// user password
$this->polatan->add_item(array(
    'type'  => 'password',
    'cols' => array(
        [
            'label' => __('Password', 'aauth'),
            'name'  => 'password'
        ],
        [
            'label' => __('Confirm', 'aauth'),
            'name'  => 'confirm',
        ]
    )
), 'create_user', 1);

$this->polatan->add_item(array(
    'type'    => 'select',
    'name'    => 'user_status',
    'label'   => __('User Status', 'aauth'),
    'options' => array(
        'default' => __( 'Default', 'aauth'),
        '0'       => __( 'Active' , 'aauth'),
        '1'       => __( 'Unactive' , 'aauth')
    )
), 'create_user',1 );

// add to a group
$groups_array = array();
foreach ($groups as $group) {
    $groups_array[ $group->id ] = $group->definition != null ? $group->definition : $group->name;
}
$this->polatan->add_item(array(
    'type'    => 'select',
    'label'   => __('Add to a group', 'aauth'),
    'name'    => 'userprivilege',
    'options' => $groups_array
), 'create_user', 1);

// load custom field for user creatin
$this->events->do_action('load_users_custom_fields', array(
    'mode'           => 'create',
    'meta_namespace' => 'create_user',
    'col_id'         => 1,
    'gui'            => $this->polatan,
    'user_id'        => null,
));

$this->polatan->output();
