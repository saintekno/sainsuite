<?php

foreach (force_array(riake('items', $meta)) as $_item) 
{
    if( @$_item[ 'permission' ] != null && ! User::control( $_item[ 'permission' ] ) ) {
        continue;
    }

    $name           =    @$_item[ 'name' ];
    $id             =    @$_item[ 'id' ];
    $class          =    @$_item[ 'class' ];
    $type           =    @$_item[ 'type' ];
    $placeholder    =    @$_item[ 'placeholder' ];
    $value          =    @$_item[ 'value' ];
    $icon           =    @$_item[ 'icon' ];
    $label          =    @$_item[ 'label' ];
    $rows           =    @$_item[ 'rows' ];
    $disabled       =    @$_item[ 'disabled' ];
    $required       =    @$_item[ 'required' ];
    $readonly       =    @$_item[ 'readonly' ];
    $description    =    @$_item[ 'description' ];
    $active         =    @$_item[ 'active' ];
    
    if (in_array($type, array( 'text', 'password', 'email', 'tel' ))) 
    { 
        include( dirname( __FILE__ ) . '/fields/input-default.php' );
    }
    elseif ( $type == 'input-file') 
    {
        include( dirname( __FILE__ ) . '/fields/input-file.php' );               
    }
    elseif ( $type == 'input-image') 
    {
        include( dirname( __FILE__ ) . '/fields/input-image.php' );               
    }
    elseif ( $type == 'textarea') 
    {
        include( dirname( __FILE__ ) . '/fields/textarea.php' );               
    }
    elseif ($type == 'table-datatable') 
    {
        include( dirname( __FILE__ ) . '/fields/table-datatable.php' );                            
    }
    elseif ($type == 'table-lists') 
    {
        include( dirname( __FILE__ ) . '/fields/table-lists.php' );                            
    }
    elseif ( $type == 'accordions') 
    {
        include( dirname( __FILE__ ) . '/fields/accordions.php' );               
    }
    elseif ( $type == 'search') 
    {
        include( dirname( __FILE__ ) . '/fields/search.php' );                
    }
    elseif ( $type == 'separator') 
    {
        echo '<div class="separator separator-dashed my-8"></div>';               
    }
    elseif (in_array($type, array( 'select', 'multiple' ))) 
    {
        $multiple = $type == 'multiple' ? $type : '';
        include( dirname( __FILE__ ) . '/fields/select.php' );
    }
    elseif ($type == 'dom') 
    {
        echo riake('content', $_item);
    }
}