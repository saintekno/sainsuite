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
class Admin_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->events->add_action( 'load_dashboard_homes', [ $this, 'load_dashboard_homes' ] );
        $this->events->add_action( 'load_abouts', [ $this, 'load_abouts' ] );

        $this->events->add_action('load_dashboard', array( $this, 'set_help_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_setting_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_app_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_system_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'set_sidebar_menu' ));
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
    public function set_setting_menu()
    {
        $setting_menu['settings'][ 'system' ][] = array(
            'title' => __('System'),
            'icon'  => 'svg/Settings-2.svg',
            'href'  => site_url('admin/settings'),
            'permission' => 'read.options'
        );

        $setting_menu['appearance'][ 'themes' ][] = array(
            'title' => __('Themes'),
            'icon'  => 'svg/Bucket.svg',
            'href'  => site_url('admin/themes')
        );
        
        $setting_menu['appearance'][ 'addons' ][] = array(
            'title' => __('Addons'),
            'icon'  => 'svg/Puzzle.svg',
            'href'  => site_url('admin/addons'),
            'permission' => 'toggle.addons'
        );

        // $setting_menu['tools'][ 'backup' ][] = array(
        //     'title' => __('Backup DB'),
        //     'icon'  => 'svg/Commode2.svg',
        //     'href'  => '#'
        // );

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
            'href'  => site_url(['admin', 'doc']),
            'title' => __('Documentation'),
        );
        
        $setting_menu['help'][] = array(
            'title' => __('Github'),
            'target'  => '_blank',
            'href'  => 'https://github.com/saintekno/sainsuite',
        );

        $setting_menu['help'][] = array(
            'title' => __('API'),
            'href'  => site_url(['admin', 'api'])
        );
        $setting_menu['Information'][] = array(
            'href'  => site_url(['admin', 'blog']),
            'title' => __('Blog'),
        );

        $setting_menu['Legal'][] = array(
            'title' => __('Term of service'),
            'href'  => site_url(['admin', 'tos'])
        );
        
        $setting_menu['Legal'][] = array(
            'href'  => site_url(['admin', 'policy']),
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
    public function set_sidebar_menu()
    {
        foreach ($this->events->apply_filters('sidebar_menu', []) as $namespace) {
            Menu::add_sidebar_menu($namespace);
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
     * Dashboard UI
     *
     * @return void
     */
    public function load_dashboard_homes()
    {
        Polatan::set_title(sprintf(__('Dashboard &mdash; %s'), get('signature')));
        $this->polatan->output();
    }

    /**
     * Dashboard UI
     *
     * @return void
     */
    public function load_abouts()
    {
        $this->load->library('markdown');
        Polatan::set_title(sprintf(__('About &mdash; %s'), get('signature')));
        // Can user access addons ?
        $data = array();
        $data['check'] = (! User::control('manage.core') ) ? false : $this->update_model->check();
        $this->load->backend_view( 'about/index', $data );
    }
}
