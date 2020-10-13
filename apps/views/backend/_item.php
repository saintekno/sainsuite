<?php
$saver_enabled = riake('gui_saver', $meta);

foreach (force_array(riake('items', $meta)) as $_item) {
    $name           =    @$_item[ 'name' ];
    $id             =    @$_item[ 'id' ];
    $type           =    @$_item[ 'type' ];
    $placeholder    =    @$_item[ 'placeholder' ];
    $value          =    @$_item[ 'value' ];
    $icon           =    @$_item[ 'icon' ];
    $label          =    @$_item[ 'label' ];
    $rows           =    @$_item[ 'rows' ];
    $disabled       =    @$_item[ 'disabled' ];
    $description    =    @$_item[ 'description' ];
    $active         =    @$_item[ 'active' ];

    // fetch option from dashboard
    if ($saver_enabled && ! in_array($type, array( 'html-list', 'dom', 'file-input', 'html-error', 'table', 'buttons' ))) 
    {
        $value = strip_tags( xss_clean( ($db_value = $this->options_model->get($name)) ? $db_value : $value ) );
    }
    
    if (in_array($type, array( 'text', 'password', 'email', 'tel' ))) 
    { 
        include( dirname( __FILE__ ) . '/fields/default-input.php' );
    }
    elseif (in_array($type, array( 'select', 'multiple' ))) 
    {
        $multiple = $type == 'multiple' ? $type : '';
        include( dirname( __FILE__ ) . '/fields/select.php' );
    }
    elseif ($type == 'table') 
    {
        include( dirname( __FILE__ ) . '/fields/table.php' );                            
    }
    elseif ( $type == 'file-input') 
    {
        include( dirname( __FILE__ ) . '/fields/file-input.php' );               
    }
    elseif ($type == 'dom') 
    {
        echo riake('content', $_item);
    }
}