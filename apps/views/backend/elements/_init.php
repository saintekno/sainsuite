<?php
foreach (force_array(riake('items', $meta)) as $_item) 
{
    if( @$_item[ 'permission' ] != null && ! User::control( $_item[ 'permission' ] ) ) {
        continue;
    }

    $type = @$_item[ 'type' ];
    
    if ( $type == 'input-image') 
    {
        include( dirname( __FILE__ ) . '/input-image.php' );               
    }
    elseif ($type == 'table-datatable') 
    {
        include( dirname( __FILE__ ) . '/table-datatable.php' );                            
    }
    elseif ($type == 'table-lists') 
    {
        include( dirname( __FILE__ ) . '/table-lists.php' );                            
    }
    elseif ( $type == 'accordions') 
    {
        include( dirname( __FILE__ ) . '/accordions.php' );               
    }
    elseif ( $type == 'search') 
    {
        include( dirname( __FILE__ ) . '/search.php' );                
    }
    elseif ( $type == 'separator') 
    {
        echo '<div class="separator separator-dashed my-8"></div>';               
    }
    elseif ($type == 'dom') 
    {
        echo riake('content', $_item);
    }
    else {
        include( dirname( __FILE__ ) . '/input-default.php' );
    }
}