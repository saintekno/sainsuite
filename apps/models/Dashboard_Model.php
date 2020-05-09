<?php

class Dashboard_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action('load_dashboard', array( $this, '__set_admin_menu' ));
        $this->events->add_action('load_dashboard', array( $this, 'before_session_starts' ));
        // $this->events->add_filter( 'dashboard_home_output', array( $this, '__home_output' ) );
    }

    public function before_session_starts()
    {
        $this->config->set_item('Do_logo_long', get('app_name'));
        $this->config->set_item('Do_logo_min', '<img id="eracik-logo" class="brand-image img-circle elevation-3" style="opacity: .8" src="' . img_url() . 'user1.jpg' . '" alt="logo">');
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     *
     * @return void
    **/

    public function __set_admin_menu()
    {
        // Dashboard
        $admin_menus[ 'dashboard' ][] = array(
            'href'  => site_url('dashboard'),
            'icon'  => 'fa fa-dashboard',
            'title' => __('Dashboard')
        );
        if (User::can('manage_core')) {
            $admin_menus[ 'dashboard' ][] = array(
                'href'        => site_url(array( 'dashboard', 'update' )),
                'title'       => __('Update Center'),
                'notices_nbr' => $this->events->apply_filters('update_center_notice_nbr', 0)
            );

            $admin_menus[ 'dashboard' ][] = array(
                'href'  => site_url(array( 'dashboard', 'about' )),
                'title' => __('About'),
            );
        }

        // Loop
        foreach (force_array($this->events->apply_filters('admin_menus', $admin_menus)) as $namespace => $menus) {
            foreach ($menus as $menu) {
                Menu::add_admin_menu_core($namespace, $menu);
            }
        }
    }
}
