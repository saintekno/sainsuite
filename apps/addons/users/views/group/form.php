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
    'namespace' => 'group',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Submit Group', 'aauth')
        )
    ),
    'type' => 'card'
));


/**
 * Item
 */
if( $this->aauth->is_admin() ):

$this->polatan->add_item(array(
    'type'     => 'text',
    'cols' => array(
        [
            'label' => __('Name'),
            'name'  => 'name',
            'value'    => (isset($group)) 
                ? set_value('name', $group->name) 
                : set_value('name'),
        ],
        [
            'label' => __('Definition'),
            'name'  => 'definition',
            'value'    => (isset($group)) 
                ? set_value('definition', $group->definition) 
                : set_value('definition'),
        ]
    )
), 'group', 1);

else :

$groups_array = array();
foreach ($groups as $gr) {
    $groups_array[ $gr->id ] = $gr->definition != null ? $gr->definition : $gr->name;
}
$this->polatan->add_item(array(
    'type'    => 'select',
    'label'   => __('Name group', 'aauth'),
    'name'    => 'name',
    'options' => $groups_array,
    'active'  => (isset($group)) ? $group->id : null
), 'group', 1);

endif;

$this->polatan->output();