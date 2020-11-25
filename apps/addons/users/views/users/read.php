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

$complete_users = array();
// adding user to complete_users array
foreach ($users as $user) {
    $complete_users[] = array(
        $user->username ,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'),
        '<a href="' . site_url(array( 'admin', 'users', 'edit', $user->user_id )) . '" 
            class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="fas fa-pen"></i></a>
        <button class="btn btn-icon btn-light btn-hover-danger btn-sm"
            data-head=\'' . _s( 'Would you like to delete this account ?', 'aauth' ) . '\'
            data-url=\'' . site_url(array( 'admin', 'users', 'delete', $user->user_id )) . '\'
            onclick="deleteConfirmation(this)"><i class="fas fa-trash-alt"></i></button>' ,
            
    );
}

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'namespace'  => 'user-list',
    'pagination' => array( true ),
    'col_id'     => 1,
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'  => 'table-default',
    'thead' => array( 
        __('Username', 'aauth'), 
        __('Email', 'aauth'),  
        __('Activity', 'aauth'), 
        __('Status' , 'aauth'), 
        __('Actions', 'aauth') 
    ),
    'tbody' => $complete_users
), 'user-list', 1);

// Adding user list

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $pagination
), 'user-list', 1);

$this->polatan->output();