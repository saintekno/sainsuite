<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Users_Menu extends MY_Addon
{
    public function __construct()
    {
		parent::__construct();
		
        $this->events->add_filter( 'aside_nav', array( $this, 'aside_nav' ));
    }

	public function _header_nav($menu) {
        $menu[] = array(
            'id' => 3,
            'name' => __('Users'),
            'slug' => [ 'admin', 'users' ],
            'order' => 3,
            'permission' => 'read.users'
        );
        $menu[] = array(
            'id' => 4,
            'name' => __('Group'),
            'slug' => [ 'admin', 'group' ],
            'order' => 4,
            'permission' => 'read.group'
        );

        $header_nav = $this->events->apply_filters('header_nav_users', $menu);
        
        return $header_nav;
	}

	public function _aside_menu($menu) {
        // $menu[] = array(
        //     'title' => __('Personal Information'),
        //     'href' => site_url(),
        //     'icon' => 'svg/Settings4.svg',
        // );
        // $menu[] = array(
        //     'title' => __('Account Information'),
        //     'href' => site_url(),
        //     'icon' => 'svg/Settings4.svg',
        // );
        // $menu[] = array(
        //     'title' => __('Change Password'),
        //     'href' => site_url(),
        //     'icon' => 'svg/Settings4.svg',
        // );

        $aside_menu = $this->events->apply_filters('aside_menu_users', $menu);
        
        return $aside_menu;
	}

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function aside_nav($menus)
    {
        $menus[] = array(
            'id' => 4,
            'parent'  => NULL,
            'name' => __('Users', 'aauth'),
            'icon' => 'icon-2x flaticon2-user-1',
            'slug'  => 'admin/users',
            'permission' => 'read.users',
            'order' => 4
        );
        $menus[] = array(
            'id' => 5,
            'parent'  => NULL,
            'name' => __('Inbox', 'aauth'),
            'icon' => 'icon-2x flaticon2-chat-1',
            'slug'  => 'admin/chat',
            'permission' => 'read.users',
            'order' => 5
        );

        return $menus;
    }
}
new Users_Menu;