<?php

class DashboardWidgets 
{
    private $widgets = [];

    public function __construct()
    {
        $this->events = get_instance()->events;
    }

    /**
     * Register Widgets
     * @param string widget namespace
     * @param array widget config
     * @return void
     */
    public function register( $namespace, $config )
    {
        $this->widgets[ $namespace ] = $config;
    }

    /**
     * Run
     * @return void
     */
    public function init()
    {
        if( $this->widgets ) 
        {
            foreach( $this->widgets as $namespace => $widgetConfig ) 
            {
                // check if the widget has yet been placed into one column
                // Lopping columns
                $widgets         = [];
                $widgetExists    = false;
                $widgetsToRemove = [
                    0   =>  [],
                    1   =>  [],
                    2   =>  []
                ];
    
                for( $i = 0; $i <= 2; $i++ ) 
                {
                    $widgets[ $i ] = get_option( $this->events->apply_filters( 'column_' . $i . '_widgets', 'column_' . $i . '_widgets' ), [] );
    
                    $widgetsNamespaces = [];
                    foreach( $widgets[ $i ] as $widget ) 
                    {
                        // var_dump( $widget );die;
                        // only save widget which still exists
                        if( in_array( $widget[ 'namespace' ], array_keys( $this->widgets ) ) ) {
                            $widgetsNamespaces[] = $widget[ 'namespace' ];
                        } 
                        else {
                            // remove widgets which aren't (no more) registered
                            $widgetsToRemove[ $i ][] = $widget[ 'namespace' ];
                        }                    
                    }
    
                    if( in_array( $namespace, $widgetsNamespaces ) ) {
                        $widgetExists = true;
                    }
                }
    
                // Remove widget from options.
                foreach( $widgetsToRemove as $index => $widgetsNamespaces ) 
                {
                    $columnWidgets = get_option( $option_name, [] );
                    $option_name   = $this->events->apply_filters( 'column_' . $index . '_widgets', 'column_' . $index . '_widgets' );
                    $canUpdate     = false;
                    
                    foreach( $columnWidgets as $widgetIndex => $widget ) 
                    {
                        if( in_array( $widget[ 'namespace' ], $widgetsNamespaces ) ) 
                        {
                            unset( $columnWidgets[ $widgetIndex ] );
                            $canUpdate = true;
                        }
                    }
    
                    // if the widget can be updated.
                    if( $canUpdate ) {
                        // save Index
                        set_option( $option_name, $columnWidgets );
                        // var_dump( get_option( $option_name ) );die;
                    }
                }
    
                // register widget if it doesn't exist
                if( ! $widgetExists ) 
                {
                    $defaults = [
                        'wrapper' => true,
                    ];
    
                    $widgetConfig[ 'namespace' ] =   $namespace;
                    $widgets[0][]                =   $newWidget;
                    $newWidget                   =   array_merge( $defaults, $widgetConfig );
                    
                    set_option(
                        $this->events->apply_filters( 'column_0_widgets', 'column_0_widgets' ),
                        $widgets[0]
                    );
                }
            }
        } 
        else {
            // Remove all widgets
            for( $i = 0; $i <= 2; $i++ ) {
                set_option( $this->events->apply_filters( 'column_' . $i . '_widgets', 'column_' . $i . '_widgets' ), [] );
            }
        }        
    }

    /**
     * Get all Widgets
     * @return array of all widgets
     */
    public function get()
    {
        return $this->widgets;
    }
}