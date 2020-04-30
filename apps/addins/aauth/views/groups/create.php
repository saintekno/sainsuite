<?php

$this->Gui->set_title(sprintf(__('Create a new group &mdash; %s', 'aauth'), get('core_signature')));

$this->Gui->col_width(1, 3);

// Creating Meta
$this->Gui->add_meta(array(
    'type'      => 'box-default',
    'title'     => __('Create a new role', 'aauth'),
    'namespace' => 'create_role',
    'col_id'    => 1,
    'footer'    => array(
        'submit'    =>    array(
            'label' => __('Create the role', 'aauth')
        )
    ),
    'gui_saver' => true,
    'custom'    => array(
        'action' => null
    )
));

// Adding Fields
$this->Gui->add_item(array(
    'type'        => 'text',
    'name'        => 'role_name',
    'label'       => __('Role Name', 'aauth'),
    'placeholder' => __('Role Name', 'aauth')
), 'create_role', 1);

// Is it an admin group ?
$this->Gui->add_item(array(
    'type'    => 'select',
    'name'    => 'role_type',
    'options' => array(
        'public' => __('Public', 'aauth'),
        'admin'  => __('Admin', 'aauth')
    ),
    'label'       => __('Role Type', 'aauth'),
    'placeholder' => __('Role Type', 'aauth')
), 'create_role', 1);

$this->Gui->output();
