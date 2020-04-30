<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->Gui->col_width(1, 3);

// Creating Meta
$this->Gui->add_meta(array(
    'type'      => 'box-default',
    'title'     => __('Edit a role', 'aauth'),
    'namespace' => 'create_role',
    'col_id'    => 1,
    'footer'    => array(
        'submit'    =>    array(
            'label' => __('Edit the role', 'aauth')
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
    'placeholder' => __('Role Name', 'aauth'),
    'value'       => $groups
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
    'placeholder' => __('Role Type', 'aauth'),
    'active'      => $this->users->auth->is_public_group($groups) ? 'public' : 'admin'
), 'create_role', 1);

$this->Gui->output();
