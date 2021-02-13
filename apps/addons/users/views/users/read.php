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

$this->polatan->add_col(array(
    'width' => 4,
), 1);

$this->polatan->add_meta(array(
    'namespace'  => 'users',
    'col_id'     => 1,
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'  => 'table-datatable',
    'data' => json_decode($users),
), 'users', 1);

$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'users', 'users/datatable');
});

$this->polatan->output();