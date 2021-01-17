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

/**
 * Col Width
 */
$this->polatan->col_width(1, 4);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'users',
    'pagination' => array( true ),
    'col_id'     => 1,
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'table-datatable',
    'data' => $users,
), 'users', 1);

/**
 * Script
 */
$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'users', 'users/datatable');
});

$this->polatan->output();