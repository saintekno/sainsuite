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
        
        global $Options;
        if( $this->aauth->is_admin() ):
        $system[] = array(
            'title' => __('Reset'),
            'icon'  => 'svg/Time-schedule.svg',
            'href'  => site_url('admin/addons/enable/reset'),
            'permission' => 'read.users'
        );
        endif;

        return $system;
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function after_user_card()
    {
        return '
        <a href="'. xss_clean(site_url(array( 'admin', 'profile' ) ) ).'" class="navi-item hoverable ">
            <div class="navi-link">
                <div class="symbol symbol-40 bg-light mr-3">
                    <div class="symbol-label bg-hover-white">
                        <span class="svg-icon svg-icon-md svg-icon-success">
                        <i class="flaticon-user text-success"></i>
                        </span>
                    </div>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                    '.__('Personal Settings').'
                    </div>
                    <div class="text-muted">
                        Account settings and more
                    </div>
                </div>
            </div>
        </a>';
    }
}
new Users_Menu;