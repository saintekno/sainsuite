<?php

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'users',
    'gui_saver' => false,
    'type' => 'card',
    'form' => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Submit User', 'aauth')
        )
    ),
));

$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => array(
        [
            'id' => 1,
            'heading'=> __('Personal Information'),
            'description' => 'Update your personal informaiton',
            'show' => true,
            'hide_footer' => true,
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_profile', array( 
                    array_merge(
                        ['user'=> (isset($user)) ? $user : null], 
                        ['groups'=> $groups], 
                        ['user_group'=> (isset($user_group)) ? $user_group : null], 
                        ['page'=> 'users']
                    )
                 ))
            )
        ],
        [
            'id' => 2,
            'heading'=> __('Change Password'),
            'description' => 'Change your account password',
            'show' => true,
            'hide_footer' => true,
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_user_pass', array( 
                    array_merge(
                        ['user'=> (isset($user)) ? $user : null], 
                        ['page'=> 'users'])
                 ))
            )
        ],
        [
            'id' => 3,
            'heading'=> __('Advanced'),
            'description' => 'Perform advanced options',
            'show' => true,
            'hide_footer' => true,
            'body' => array(
                'items' => $this->events->apply_filters_ref_array('load_users_advanced', array( 
                    array_merge(
                        ['user'=> (isset($user)) ? $user : null], 
                        ['page'=> 'users'])
                    ))
            )
        ]
    )
), 'users', 1);

$this->polatan->output();