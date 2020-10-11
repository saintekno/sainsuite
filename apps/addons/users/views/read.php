<?php

$complete_users = array();
// adding user to complete_users array
foreach ($users as $user) {
    $complete_users[] = array(
        '<a href="' . site_url(array( 'admin', 'users', 'edit', $user->user_id )) . '" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">' . $user->username . '</a>' ,
        $user->definition,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'),
        '<a onclick="return confirm( \'' . _s( 'Would you like to delete this account ?', 'aauth' ) . '\' )" 
            href="' . site_url(array( 'admin', 'users', 'delete', $user->user_id )) . '"
            class="btn btn-icon btn-light btn-hover-danger btn-sm"><i class="fas fa-trash-alt"></i></a>' ,
    );
}

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'namespace'  => 'user-list',
    'title'      => __('List', 'aauth'),
    'pagination' => array( true ),
    'col_id'     => 1,
));

$this->polatan->add_item(array(
    'type'  => 'table',
    'thead' => array( __('Username', 'aauth'), __('Role', 'aauth'), __('Email', 'aauth'),  __('Activity', 'aauth'), __( 'Status' , 'aauth'), __('Actions', 'aauth') ),
    'tbody' => $complete_users
), 'user-list', 1);

// Adding user list

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $pagination
), 'user-list', 1);

$this->polatan->output();