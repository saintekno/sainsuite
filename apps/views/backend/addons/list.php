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
        'name' => __('Add AddOns'),
        'icon' => 'ki ki-plus',
        'slug' => 'javascript:void(0)',
        'attr_anchor' => 'class="btn btn-light-primary btn-sm font-weight-bolder" data-toggle="modal" data-target="#kt_inbox_compose"',
        'permission' => 'install.addons'
    );
    return $final;
});

$this->events->add_filter('toolbar_filter', function ($filter) { 
    if ($this->aauth->is_admin()):
    global $Options;
    $check = (intval(riake('webdev_mode', $Options))) ? 'checked="checked"' : '';
    $filter[] = '
    <span class="switch switch-primary mr-2">
        <label data-toggle="tooltip" title="Developer mode">
            <input type="checkbox" '.$check.' id="dev_mode">
            <span></span>
        </label>
    </span>';
    endif;

    return $filter;
});

$this->polatan->add_meta(array(
    'col_id' => 1,
    'class'     => 'col-12',
    'namespace' => 'addons'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->backend_view('addons/list_dom', array(), true )
), 'addons', 1);

$this->polatan->output();