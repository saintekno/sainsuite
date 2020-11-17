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

/**
 * Col Width
 */
$this->polatan->col_width(1, 2);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'edit_group',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Edit Group', 'aauth')
        )
    ),
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'     => 'text',
    'cols' => array(
        [
            'label' => __('Name'),
            'name'  => 'name',
            'value'    => $group->name
        ],
        [
            'label' => __('Definition'),
            'name'  => 'definition',
            'value'    => $group->definition
        ]
    )
), 'edit_group', 1);

$this->polatan->output();