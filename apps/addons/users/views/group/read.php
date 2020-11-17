<?php

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

$complete_group = array();
// adding group to complete_group array
foreach ($groups as $row) {
    $complete_group[] = array(
        $row->name ,
        $row->definition ,
        '<a href="' . site_url(array( 'admin', 'users', 'group', 'edit', $row->id )) . '" 
            class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="fas fa-pen"></i></a>
        <a onclick="return confirm( \'' . _s( 'Would you like to delete this account ?', 'aauth' ) . '\' )" 
            href="' . site_url(array( 'admin', 'users', 'group', 'delete', $row->id )) . '"
            class="btn btn-icon btn-light btn-hover-danger btn-sm"><i class="fas fa-trash-alt"></i></a>' ,
    );
}

/**
 * Col Width
 */
$this->polatan->col_width(1, 4);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'group-list',
    'col_id' => 1,
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'table',
    'thead' => array(
        'Name',
        'Definition',
        'Action'
    ),
    'tbody' => $complete_group
), 'group-list', 1);

$this->polatan->output();