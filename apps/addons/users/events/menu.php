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
    }

	public function _aside_menu($menu) {
        $menu[] = array(
            'title' => __('Users'),
            'href' => site_url([ 'admin', 'users' ]),
            'icon' => 'la la-user',
            'permission' => 'read.users'
        );
        $menu[] = array(
            'title' => __('Group'),
            'href' => site_url([ 'admin', 'users', 'group' ]),
            'icon' => 'la la-user-friends',
            'permission' => 'read.group'
        );

        foreach ($this->events->apply_filters('aside_menu_users', $menu) as $namespace) {
            Menu::add_aside_menu($namespace);
        }; 
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
        <li class="navi-item active font-size-xs">
            <a href="'. xss_clean(site_url(array( 'admin', 'users', 'profile' ) ) ).'" class="navi-link">
                <span class="navi-text">'.__('Personal Settings').'</span>
            </a>
        </li>';
    }
}
new Users_Menu;