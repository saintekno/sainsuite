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

// Toolbar
$this->events->add_filter( 'toolbar_nav', function( $final ) {
    $final[] = array(
        'id' => 1,
        'name' => __('Add themes'),
        'icon' => 'ki ki-plus',
        'slug' => 'javascript:void(0)',
        'attr_anchor' => 'class="btn btn-light-primary btn-sm font-weight-bolder" data-toggle="modal" data-target="#kt_theme_frontend"',
        'permission' => 'install.themes'
    );
    return $final;
});

$this->events->add_filter('toolbar_filter', function ($filter) { 
    if ($this->aauth->is_admin()):
    $filter[] = '
    <span class="switch switch-primary mr-2">
        <label data-toggle="tooltip" title="Developer mode">
            <input type="checkbox" '.$this->events->apply_filters('dashboard_dev_class', '').' id="dev_mode">
            <span></span>
        </label>
    </span>';
    endif;

    return $filter;
});

$this->polatan->add_meta(array(
    'col_id' => 1,
    'class'     => 'col-12',
    'namespace' => 'theme'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->backend_view('appearance/list_dom', array(), true )
), 'theme', 1);

$this->events->do_action('header_menu_themes');

$this->polatan->output();