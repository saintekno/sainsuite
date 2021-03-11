<?php

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
        'name'   => __('Add A group'),
        'icon'    => 'ki ki-plus',
        'attr_anchor'  => 'class="btn btn-light-primary btn-sm font-weight-bolder"',
        'slug'    => [ 'admin', 'group', 'add' ],
        'permission' => 'create.group'
    );
    return $final;
});

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'group',
    'col_id' => 1,
    'class'     => 'col-12',
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'table-datatable',
    'data' => json_decode($groups),
), 'group');

/**
 * Script
 */
$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'users', 'group/datatable');
});

$this->polatan->output();