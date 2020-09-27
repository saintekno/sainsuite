<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_Menu extends CI_model
{
    public function __construct()
    {
		parent::__construct();
		$this->events->add_filter( 'system_menu', array( $this, 'system_menu' ));
		$this->events->add_filter( 'after_user_card', array( $this, 'after_user_card' ));
		// $this->events->add_filter( 'report_menu', array( $this, 'report_menu' ), 15);
		// $this->events->add_filter( 'setting_menu', array( $this, 'setting_menu' ), 15);
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function system_menu()
    {
        if (
            User::can('create.users') ||
            User::can('edit.users') ||
            User::can('delete.users')
        ) {
            $system[] = array(
                'title' => __('Users', 'aauth'),
                'icon'  => 'svg/users.svg',
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
        return '<a href="'. xss_clean(site_url(array( 'admin', 'users', 'profile' ) ) ).'" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5 mb-2">'.__('Profile').'</a>';
    }
}
new Users_Menu;