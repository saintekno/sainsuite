<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Users_Menu extends CI_model
{
    public function __construct()
    {
		parent::__construct();
		$this->events->add_filter( 'system_menu', array( $this, 'system_menu' ));
        $this->events->add_filter( 'after_user_card', array( $this, 'after_user_card' ));
        
        if ((activate_menu('users') || activate_menu('permission')) 
            && $this->uri->segment(3) != 'profile'
            && User::control('read.users')) {
            $this->events->add_filter( 'aside_menu', array( $this, '_aside_menu' ));
        }
    }

	public function _aside_menu($final) {
        $final[] = array(
            'title' => __('Users'),
            'href' => site_url([ 'admin', 'users' ]),
            'icon' => 'la la-user',
            'permission' => 'read.users'
        );
        if (User::control('read.group')) 
        {
            $final[] = array(
                'title' => __('Group'),
                'href' => site_url([ 'admin', 'users', 'group' ]),
                'icon' => 'la la-user-friends',
                'permission' => 'read.users'
            );
        }
        if( Addons::is_active( 'permission' ) ) 
        {
            $final[] = array(
                'title' => __('Permission'),
                'href' => site_url([ 'admin', 'permission' ]),
                'icon' => 'la la-user-check',
                'permission' => 'manage.core'
            );
        }
        return $final;
	}

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function system_menu($system)
    {
        if ( User::control('read.users') ) {
            $system[] = array(
                'title' => __('Users', 'aauth'),
                'icon'  => 'svg/Group.svg',
                'href'  => site_url('admin/users'),
            );
        };

        return $system;
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function after_user_card()
    {
        return '
        <li class="navi-item active font-size-xs">
            <a href="'. xss_clean(site_url(array( 'admin', 'users', 'profile' ) ) ).'" class="navi-link">
                <span class="navi-text">'.__('Personal Settings').'</span>
            </a>
        </li>';
    }
}
new Users_Menu;