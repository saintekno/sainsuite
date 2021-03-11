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
        'name'   => __('Back to the list'),
        'icon'    => 'ki ki-long-arrow-back',
        'attr_anchor'  => 'class="btn btn-light btn-sm font-weight-bolder"',
        'slug'    => [ 'admin', 'group' ]
    );
    return $final;
});

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id'    => 1,
    'class'     => 'col-12',
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
    'type' => 'card',
));


/**
 * Item
 */
if( $this->aauth->is_admin() ):

$this->polatan->add_item(array(
    [
        'type'     => 'text',
        'class'     => 'col-6',
        'label' => __('Name'),
        'name'  => 'name',
        'value'    => (isset($group)) 
            ? set_value('name', $group->name) 
            : set_value('name'),
    ],
    [
        'type'     => 'text',
        'class'     => 'col-6',
        'label' => __('Definition'),
        'name'  => 'definition',
        'value'    => (isset($group)) 
            ? set_value('definition', $group->definition) 
            : set_value('definition'),
    ]
), 'group');

else :

$groups_array = array();
foreach (force_array($this->aauth->list_groups(true)) as $gr) 
{
    $groups_array[ $gr->id ] = $gr->name;
    if ( ! $group_groups = $this->aauth->get_subgroups()) : continue;
    endif;
    
    foreach (force_array($group_groups) as $item)
    {
        $name_group = $this->aauth->get_group_name($item->subgroup_id);
        if (in_array($name_group, $groups_array)) {
            if (in_array($gr->name, $groups_array)) {
                unset( $groups_array[ $gr->id ] );
            }
        }
    }
}

$this->polatan->add_item(array(
    'type'     => 'select',
    'class'     => 'col-6',
    'label'    => __('Name group', 'aauth'),
    'disabled' => ($groups_array) ? false : true,
    'name'     => 'name',
    'options'  => $groups_array,
), 'group');

endif;

$this->polatan->output();