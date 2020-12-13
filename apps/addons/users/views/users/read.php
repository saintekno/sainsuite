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

$this->load->helper('calendar');
$complete_users = array();
$edit_group     = '';
$hapus_group    = '';
// adding user to complete_users array
foreach ($users as $user) {
    if ( User::control('edit.group')) {
        $edit_group = '<a href="' . site_url(array( 'admin', 'users', 'edit', $user->user_id )) . '" 
                class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="fas fa-pen"></i></a>';
    }
    if ( User::control('delete.group')) {
        $hapus_group = '<button class="btn btn-icon btn-light btn-hover-danger btn-sm"
                data-head=\'' . _s( 'Would you like to delete this account?', 'aauth' ) . '\'
                data-url=\'' . site_url(array( 'admin', 'users', 'delete', $user->user_id )) . '\'
                onclick="deleteConfirmation(this)"><i class="fas fa-trash-alt"></i></button>';
    }
    $complete_users[] = array(
        $user->user_id,
        '<div class="d-flex align-items-center">
            <div class="symbol symbol-40 symbol-light-primary flex-shrink-0">
                <span class="symbol-label font-size-h4 font-weight-bold">' . strtoupper(substr($user->username, 0, 1)) . '</span>
            </div>
        </div>',
        $user->username ,
        $user->email ,
        $user->last_login,
        $user->last_activity,
        get_range_time($user->last_login, $user->last_activity),
        $user->banned   ==  1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'),
        $edit_group.' '.$hapus_group
            
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
        __('Avatar'), 
        __('Username'), 
        __('Email'),  
        __('Login'), 
        __('Activity'), 
        __('Durasi'), 
        __('Status' ), 
        __('Actions') 
    ),
    'tbody' => $complete_users,
), 'users', 1);

/**
 * Script
 */
$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'users', 'users/script');
});

$this->polatan->output();