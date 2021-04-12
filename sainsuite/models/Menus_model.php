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
class Menus_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function usercard_nav()
    {
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('after_user_card', [])
        );

        $config["nav_tag_open"]   = '';
        $config["nav_tag_close"]  = '';
        $config["item_tag_open"]  = '<li class="navi-item">';
        $config["item_tag_close"] = '</li>';
        $config["item_anchor"]    = '<a class="navi-link" href="%s">%s</a>';
        $config["item_icon"]      = '<span class="navi-icon"><i class="%s"></i></span>';
        $config["item_label"]     = '<span class="navi-text">%s</span>';

        // call render in view
        return get_instance()->multimenu->render($config);
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function aside_nav()
    {
        $aside_nav[] = array(
            'id'     => 3,
            'parent' => null,
            'name'   => __('Notification'),
            'icon'   => 'icon-2x flaticon2-bell-4',
            'slug'   => 'admin/notification',
            'permission' => 'read.users',
            'order'  => 3,
        );
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('aside_nav', $aside_nav)
        );

        $config["item_tag_open"]  = '<li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="%s">';
        $config["item_tag_close"] = '</li>';
        $config["item_anchor"]    = '<a class="nav-link btn btn-icon btn-clean btn-lg" href="%s">%s</a>';
        $config["item_icon"]      = '<i class="%s"></i>';
        $config["item_label"]     = '<span class="d-none">%s</span>';

        // call render in view
        return get_instance()->multimenu->render($config);
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function asidefooter_nav()
    {
        $asidefooter_nav[] = array(
            'id'     => 3,
            'parent' => null,
            'name'   => __('Appearance'),
            'icon'   => 'icon-2x fas fa-palette',
            'slug'   => 'admin/appearance',
            'permission' => 'read.themes',
            'order'  => 3,
        );
        $asidefooter_nav[] = array(
            'id'     => 4,
            'parent' => null,
            'name'   => __('Addons'),
            'icon'   => 'icon-2x flaticon2-layers-1',
            'slug'   => 'admin/addons',
            'permission' => 'read.addons',
            'order'  => 4,
        );
        $asidefooter_nav[] = array(
            'id'     => 5,
            'parent' => null,
            'name'   => __('Setting'),
            'icon'   => 'icon-2x flaticon2-settings',
            'slug'   => 'admin/settings',
            'permission' => 'read.options',
            'order'  => 5,
        );
        if (APPNAME == 'system') : 
        $asidefooter_nav[] = array(
            'id'         => 6,
            'parent'     => null,
            'name'       => __('Reset', 'aauth'),
            'icon'       => 'icon-2x flaticon2-refresh-button',
            'slug'       => 'admin/reset',
            'permission' => 'read.users',
            'order'      => 6
        );
        endif;
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('asidefooter_nav', $asidefooter_nav)
        );

        $config["item_tag_open"]  = '<div data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="%s" aria-expanded="false">';
        $config["item_tag_close"] = '</div>';
        $config["item_anchor"]    = '<a class="btn btn-icon btn-clean btn-lg mb-2" href="%s">%s</a>';
        $config["item_icon"]      = '<i class="%s"></i>';
        $config["item_label"]     = '<span class="d-none">%s</span>';
        get_instance()->multimenu->initialize($config);

        // call render in view
        return get_instance()->multimenu->render();
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function infocenter_nav()
    {
        $infocenter_nav[] = array(
            'id'     => 11,
            'parent' => null,
            'name'   => __('Docs'),
            'slug'   => 'admin/doc',
            'order'  => 1
        );
        $infocenter_nav[] = array(
            'id'          => 12,
            'parent'      => null,
            'name'        => __('Github'),
            'slug'        => 'https://github.com/saintekno/sainsuite',
            'attr_anchor' => 'class="navi-link py-1" target="_blank"',
            'target'      => true,
            'order'       => 2
        );
        $infocenter_nav[] = array(
            'id'     => 3,
            'parent' => null,
            'name'   => __('API'),
            'slug'   => 'admin/api',
            'order'  => 3
        );
        $infocenter_nav[] = array(
            'id'     => 5,
            'parent' => null,
            'name'   => __('Terms'),
            'slug'   => 'admin/term',
            'order'  => 5
        );
        $infocenter_nav[] = array(
            'id'     => 6,
            'parent' => null,
            'name'   => __('Privacy'),
            'slug'   => 'admin/privacy',
            'order'  => 6
        );
        $infocenter_nav[] = array(
            'id'     => 7,
            'parent' => null,
            'name'   => __('About'),
            'slug'   => 'admin/about',
            'order'  => 7
        );
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('fill_infocenter_nav', $infocenter_nav)
        );

        $config["nav_tag_open"]   = '<ul class="navi py-4">';
        $config["nav_tag_close"]  = '</ul>';
        $config["item_tag_open"]  = '<li class="navi-item">';
        $config["item_tag_close"] = '</li>';
        $config["item_anchor"]    = '<a class="navi-link py-1" href="%s">%s</a>';
        $config["item_label"]     = '<span class="navi-text">%s</span>';
        $config["item_divider"]   = '<li class="navi-separator my-4"></li>';

        // call render in view
        return get_instance()->multimenu->render($config, ['admin/about', 'admin/term']);
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function header_nav()
    {
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('header_nav', [])
        );

        $config["nav_tag_open"]   = '<div class="navheader-nav nav flex-grow-1">';
        $config["nav_tag_close"]  = '</div>';
        $config["item_tag_open"]  = '';
        $config["item_tag_close"] = '';
        $config["item_anchor"]    = '<a class="nav-item" href="%s">%s</a>';
        $config["item_label"]     = '<span class="nav-label px-10"><span class="nav-title font-weight-bold font-size-h5">%s</span></span>';
        $config["item_divider"] = '';
        get_instance()->multimenu->initialize($config);

        // call render in view
        return get_instance()->multimenu->render();
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function create_nav()
    {
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('create_nav', [])
        );

        $config["nav_tag_open"]   = '<div class="px-3 pt-2 pb-5 border-bottom">';
        $config["nav_tag_close"]  = '</div>';
        $config["item_tag_open"]  = '';
        $config["item_tag_close"] = '';
        $config["item_icon"]      = '<i class="%s"></i>';
        $config["item_label"]     = '';
        $config["item_anchor"]    = '<a class="btn btn-block btn-primary font-weight-bold text-uppercase text-center py-4" href="%s">%s</a>';
        $config["item_divider"] = '';
        get_instance()->multimenu->initialize($config);

        if (empty($this->events->apply_filters('create_nav', []))) : return;
        endif;

        // call render in view
        if (User::control( $this->events->apply_filters('create_nav', [])[0]['permission'] )) :
        return get_instance()->multimenu->render();
        endif;
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function toolbar_nav()
    {
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('toolbar_nav', [])
        );

        $config["nav_tag_open"]   = '';
        $config["nav_tag_close"]  = '';
        $config["item_tag_open"]  = '';
        $config["item_tag_close"] = '';
        $config["item_icon"]      = '<i class="%s"></i>';
        $config["item_label"]     = '<span>%s</span>';
        $config["item_anchor"]    = '<a href="%s">%s</a>';
        $config["item_divider"] = '';
        get_instance()->multimenu->initialize($config);

        // call render in view
        return get_instance()->multimenu->render();
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function breadcrumb_nav($item = null)
    {
        if ($item == null) {
            return false;
        }

        get_instance()->multimenu->set_items($item);

        $config["nav_tag_open"]  = '<ul class="d-none d-md-flex breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 mr-4 font-size-sm">';
        $config["nav_tag_close"]  = '</ul>';
        $config["item_tag_open"] = '<li class="breadcrumb-item">';
        $config["item_tag_close"] = '</li>';
        $config["item_label"]    = '<span class="text-muted">%s</span>';
        $config["item_divider"] = '';

        // call render in view
        return get_instance()->multimenu->render($config);
    }

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
     **/
    public function menu_nav()
    {
        get_instance()->multimenu->set_items(
            $this->events->apply_filters('menu_nav', [])
        );

        $config["nav_tag_open"]       = '<ul class="menu-nav">';
        $config["nav_tag_close"]      = '';
        $config["parent_tag_open"]    = '<li class="menu-item menu-item-submenu">';
        $config["parent_anchor"]      = '<a class="menu-link menu-toggle" href="%s">%s</a>';
        $config["children_tag_open"]  = '<div class="menu-submenu"><ul class="menu-subnav">';
        $config["children_tag_close"] = '</ul></div>';
        $config["item_tag_open"]      = '<li class="menu-item">';
        $config["item_tag_close"]     = '</li>';
        $config["item_anchor"]        = '<a class="menu-link" href="%s">%s</a>';
        $config["item_icon"]          = '<i class="menu-icon %s"><span></span></i>';
        $config["item_label"]         = '<span class="menu-text">%s</span>';
        $config["item_arrow"]         = '<i class="menu-arrow"></i>';
        $config["item_divider"]       = '<li class="menu-section"><h4 class="menu-text">%s</h4></li>';

        // call render in view
        return get_instance()->multimenu->render($config, $this->events->apply_filters('menu_nav_divider', ['']));
    }
}