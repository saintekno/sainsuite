<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action('load_dashboard', array( $this, 'set_report_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_setting_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_app_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_toolbar_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_system_menu' ));
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_setting_menu()
    {
        $setting_menu[ 'about' ][] = array(
            'href'  => site_url('admin/about'),
            'icon'  => 'svg/Bookmark.svg',
            'title' => __('About'),
        );
        
        if (User::can('manage.core')) {
            $setting_menu[ 'system' ][] = array(
                'title' => __('System'),
                'icon'  => 'svg/Settings-2.svg',
                'href'  => site_url('admin/settings')
            );
        }

        $setting_menu[ 'theme' ][] = array(
            'title' => __('Themes'),
            'icon'  => 'svg/Layout-left-panel-1.svg',
            'href'  => site_url('admin/themes')
        );

        foreach ($this->events->apply_filters('setting_menu', $setting_menu) as $namespace => $menus) {
            foreach ($menus as $menu) {
                Menu::add_setting_menu($namespace, $menu);
            }
        }
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_report_menu()
    {
        foreach ($this->events->apply_filters('report_menu', []) as $namespace => $menus) {
            foreach ($menus as $menu) {
                Menu::add_report_menu($namespace, $menu);
            }
        }
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_app_menu()
    {
        foreach ($this->events->apply_filters('apps_menu', []) as $namespace) {
            Menu::add_apps_menu($namespace);
        }
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_system_menu()
    {
        foreach ($this->events->apply_filters('system_menu', []) as $namespace) {
            Menu::add_system_menu($namespace);
        }
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_toolbar_menu()
    {
        foreach ($this->events->apply_filters('toolbar_menu', []) as $namespace) {
            Menu::add_toolbar_menu($namespace);
        };
    }
}
