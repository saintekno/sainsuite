<?php

$complete_users = array();
// adding user to complete_users array
foreach ($users as $user) 
{
    $complete_users[] = array(
        $user->user_id ,
        '<a href="' . site_url(array( 'dashboard', 'users', 'edit', $user->user_id )) . '"><i class="fa fa-pencil"></i> ' . $user->user_name . '</a>' ,
        $user->group_name,
        $user->email ,
        $user->last_login,
        $user->banned == 1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'),
        '<a class="text-red" onclick="return confirm( \'' . _s( 'Would you like to delete this account ?', 'aauth' ) . '\' )" href="' . site_url(array( 'dashboard', 'users', 'delete', $user->user_id )) . '"><i class="fa fa-trash-o"></i> </a>' ,
    );
}

$this->Gui->set_title(sprintf(__('Users &mdash; %s', 'aauth'), get('core_signature')));

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'namespace'         => 'user-list',
    'title'             => __('List', 'aauth'),
    'pagination'        => array( true ),
    'col_id'            => 1,
    'type'              => 'box-default',
    'hide_body_wrapper' => true
));

$this->Gui->add_item(array(
    'type' => 'table',
    'cols' => array( __('Id', 'aauth'), __('Username', 'aauth'), __('Role', 'aauth'), __('Email', 'aauth'),  __('Activity', 'aauth'), __( 'Status' , 'aauth'), __('Actions', 'aauth') ),
    'rows' => $complete_users
), 'user-list', 1);

// Adding user list
$this->Gui->add_item(array(
    'type'    => 'dom',
    'content' => $pagination
), 'user-list', 1);

$this->Gui->output();
