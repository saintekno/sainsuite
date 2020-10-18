<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action('load_dashboard', array( $this, 'set_help_menu' ));
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
        $setting_menu['system'][ 'about' ][] = array(
            'href'  => site_url('admin/about'),
            'icon'  => 'svg/Bookmark.svg',
            'title' => __('About'),
        );
        
        if (User::can('manage.core')) {
            $setting_menu['system'][ 'settings' ][] = array(
                'title' => __('Settings'),
                'icon'  => 'svg/Settings-2.svg',
                'href'  => site_url('admin/settings'),
            );
        }

        $setting_menu['system'][ 'themes' ][] = array(
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
    public function set_help_menu()
    {
        $setting_menu['help'][] = array(
            'href'  => site_url(),
            'title' => __('Documentation'),
        );
        
        $setting_menu['help'][] = array(
            'title' => __('Github'),
            'target'  => '_blank',
            'href'  => 'https://github.com/saintekno/sainsuite',
        );

        $setting_menu['help'][] = array(
            'title' => __('API'),
            'href'  => site_url()
        );
        $setting_menu['Information'][] = array(
            'href'  => site_url(),
            'title' => __('Blog'),
        );

        $setting_menu['Legal'][] = array(
            'title' => __('Term of service'),
            'href'  => site_url()
        );
        $setting_menu['Legal'][] = array(
            'href'  => site_url(),
            'title' => __('Privacy policy'),
        );
        
        foreach ($this->events->apply_filters('help_menu', $setting_menu) as $namespace => $menus) {
            foreach ($menus as $menu) {
                Menu::add_help_menu($namespace, $menu);
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
