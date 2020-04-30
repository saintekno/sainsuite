<?php

$saver_enabled = riake('gui_saver', $meta);
$autoload      = riake('autoload', $meta);

// If Using namespace is enabled
if ($saver_enabled && riake('use_namespace', $meta)) {
    $form_option = $this->options->get(riake('namespace', $meta));
}

foreach (force_array(riake('items', $meta)) as $_item) 
{
    $name        = @$_item[ 'name' ];
    $type        = @$_item[ 'type' ];
    $placeholder = @$_item[ 'placeholder' ];
    $value       = @$_item[ 'value' ];
    $icon        = @$_item[ 'icon' ];
    $label       = @$_item[ 'label' ];
    $rows        = @$_item[ 'rows' ];
    $disabled    = @$_item[ 'disabled' ];
    $description = @$_item[ 'description' ];
    $active      = @$_item[ 'active' ];
    
    if ($saver_enabled && ! in_array($type, array( 'html-list', 'dom', 'file-input', 'html-error', 'table', 'buttons' ))) 
    {
        // if namespace is used
        if (riake('use_namespace', $meta) === true) 
        {
            $value = strip_tags( xss_clean( ($db_value = riake($name, $form_option)) ? $db_value : $value ) );
        } 
        elseif (@$meta[ 'autoload' ] == true) 
        {
            // To avoid fetching from global cols,
            $_item[ 'user_id' ] = @$_item[ 'user_id' ] == null ? 0 : $_item[ 'user_id' ];
            if (@$_item[ 'user_id' ] != null) 
            {
                $value = strip_tags( xss_clean( ($db_value = $this->options->get($name, $_item[ 'user_id' ])) ? $db_value : $value ) );
            } 
            else 
            {
                $value = strip_tags( xss_clean( ($db_value = $this->options->get($name)) ? $db_value : $value ) );
            }
        }
    }
    
    if (in_array($type, array( 'text', 'password', 'email', 'tel' ))) 
    {
        include( dirname( __FILE__ ) . '/fields/input.php' );
    } 
    elseif ($type == 'textarea') 
    {
        include( dirname( __FILE__ ) . '/fields/textarea.php' );                
    } 
    elseif ($type == 'editor') 
    {
        global $editor_time_called;
        $editor_time_called = ($editor_time_called == null) ? 0 : $editor_time_called;
        $editor_time_called++;
        include( dirname( __FILE__ ) . '/fields/editor.php' );
    } 
    elseif ($type == 'checkbox') 
    {
        if ($saver_enabled) {
            $checked = $db_value == $value ? 'checked="checked"' : '';
        } else {
            $checked = $active == $value ? 'checked="checked"' : '';
        }        
        include( dirname( __FILE__ ) . '/fields/checkbox.php' );       
    } 
    elseif ( $type == 'radio') 
    {
        include( dirname( __FILE__ ) . '/fields/radio.php' );               
    } 
    elseif ( $type == 'file-input') 
    {
        include( dirname( __FILE__ ) . '/fields/file-input.php' );               
    }
    elseif (in_array($type, array( 'select', 'multiple' ))) 
    {
        $multiple = $type == 'multiple' ? $type : '';
        include( dirname( __FILE__ ) . '/fields/select.php' );
    } 
    elseif ($type == 'html-list') 
    {
        include( dirname( __FILE__ ) . '/fields/html-list.php' );
    } 
    elseif ($type == 'dom') 
    {
        echo riake('content', $_item);
    } 
    elseif ($type == 'html-error') 
    {
        include( dirname( __FILE__ ) . '/fields/html-error.php' );
    } 
    elseif ($type == 'table') 
    {
        include( dirname( __FILE__ ) . '/fields/table.php' );                            
    } 
    elseif ($type == 'buttons') 
    {
        $value         = force_array(riake('value', $_item));
        $buttons_types = force_array(riake('buttons_types', $_item, 'submit'));
        $name          = force_array(riake('name', $_item));
        $classes       = force_array(riake('classes', $_item, 'btn-primary'));
        $attrs_string  = force_array(riake('attrs_string', $_item, ''));
        include( dirname( __FILE__ ) . '/fields/buttons.php' ); 
    }
}