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
        $user->user_id,
        $user->username ,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'),
        '<a href="' . site_url(array( 'admin', 'users', 'edit', $user->user_id )) . '" 
            class="btn btn-icon btn-light btn-hover-primary btn-sm btn-edit"><i class="fas fa-pen"></i></a>
        <button class="btn btn-icon btn-light btn-hover-danger btn-sm btn-delete"
            data-head=\'' . _s( 'Would you like to delete this account?', 'aauth' ) . '\'
            data-url=\'' . site_url(array( 'admin', 'users', 'delete', $user->user_id )) . '\'
            onclick="deleteConfirmation(this)"><i class="fas fa-trash-alt"></i></button>' ,
            
    );
}

/**
 * Col Width
 */
$this->polatan->col_width(1, 4);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'users',
    'pagination' => array( true ),
    'col_id'     => 1,
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'table-default',
    'thead' => array( 
        __('Checkall'), 
        __('Username'), 
        __('Email'),  
        __('Activity'), 
        __('Status' ), 
        __('Actions') 
    ),
    'tbody' => $complete_users,
), 'users', 1);

/**
 * pagination
 */
$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $pagination
), 'users', 1);

/**
 * Script
 */
$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'users', 'users/script');
});

$this->polatan->output();