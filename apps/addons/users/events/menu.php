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
class Users_Menu extends MY_Addon
{
    public function __construct()
    {
		parent::__construct();
		$this->events->add_filter( 'system_menu', array( $this, 'system_menu' ));
        $this->events->add_filter( 'after_user_card', array( $this, 'after_user_card' ));
    }

	public function _header_menu($menu) {
        $menu[] = array(
            'title' => __('Users'),
            'href' => site_url([ 'admin', 'users' ]),
            'icon' => 'la la-user',
            'permission' => 'read.users'
        );
        $menu[] = array(
            'title' => __('Group'),
            'href' => site_url([ 'admin', 'group' ]),
            'icon' => 'la la-user-friends',
            'permission' => 'read.group'
        );

        $header_menu = $this->events->apply_filters('header_menu_users', $menu);
        
        return $header_menu;
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
    public function system_menu($system)
    {
        $system[] = array(
            'title' => __('Users', 'aauth'),
            'icon'  => 'svg/Group.svg',
            'href'  => site_url('admin/users'),
            'permission' => 'read.users'
        );

        return $system;
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function after_user_card()
    {
        return '
        <a href="'. xss_clean(site_url(array( 'admin', 'users', 'profile' ) ) ).'"
            class="navi-item px-8">
            <div class="navi-link">
                <div class="navi-icon mr-2">
                    <i class="flaticon2-calendar-3 text-success"></i>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                    '.__('Personal Settings').'
                    </div>
                    <div class="text-muted">
                        Account settings and more
                        <span class="label label-light-danger label-inline font-weight-bold">update</span>
                    </div>
                </div>
            </div>
        </a>';
    }
}
new Users_Menu;