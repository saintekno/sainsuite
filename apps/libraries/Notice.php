<?php
class Notice
{
    /**
     * Notice class
     *
     * Save and enqueue notifications within a big array 
     * which can be outputed using "parse_notice" method.
    **/
    
    private $notice;
    
    public function __construct()
    {
        $this->notice = [];
    }
    
    /**
     * Push notification to Notice Array
     * 
     * @param Array
     * @return void
    **/
    
    public function push_notice($e)
    {
        $this->notice[]    =    $e;
    }
    
    /**
     * Push Notice notice into
     *
     *
    **/
    
    public function push_notice_array($notice_array)
    {
        if (is_array($notice_array)) {
            foreach (force_array($notice_array) as $notice) {
                $this->push_notice(get_instance()->lang->line($notice));
            }
        } else {
            $this->push_notice(get_instance()->lang->line($notice_array));
        }
    }
    
    /**
     * Output a notice
     * 
     * @param bool whether to return or not notices
     * @return void/bool
    **/
    
    public function output_notice($return = false)
    {
        if (is_array($this->notice)) {
            $final        =    '';
            foreach ($this->notice as $n) {
                if ($return == false) {
                    if (is_callable($n)) {
                        $n();
                    } else {
                        echo $n;
                    };
                } else {
                    if (is_callable($n)) {
                        ob_start();
                        $n();
                        $final    .=    ob_get_clean();
                    } else {
                        $final    .=    $n;
                    };
                }
            }
            return $final;
        } else {
            return $this->notice;
        }
    }
    
    /**
     * Return notice array
     * 
     * @return array
    **/
    
    public function get_notice_array()
    {
        return $this->notice;
    }
    
    /**
     * Push notice to UI array
     *
     * @access public
     * @param string message
     * @param string type
     * @returns bool
    **/

    public static function push_notice_ui( $message, $namespace = null, $type = 'info', $icon = false, $href= '#', $prefix = '' )
    {
        if (is_array($message) && count($message) > 0) {
            foreach ($message as $_message) {
                if( @$_message[ 'namespace' ] != null ) {
                    self::push_notice_ui(
                        @$_message[ 'message' ],
                        @$_message[ 'namespace' ],
                        @$_message[ 'type' ],
                        @$_message[ 'icon' ],
                        @$_message[ 'href' ],
                        @$_message[ 'prefix' ]
                    );
                }
            }
        } elseif ( is_string( $message ) ) {

            $Cache      =   new CI_Cache( array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => 'Do_notices_' ) );

            /**
             * Only Save notice when it's not cached
            **/

            if( ! $Cache->get( $namespace ) ) {
                if( $namespace != null ) {
                    $Cache->save( $namespace, array(
                        'message'   =>  $message,
                        'namespace' =>  $namespace,
                        'type'      =>  $type,
                        'icon'      =>  $icon,
                        'href'      =>  $href,
                        'prefix'    =>  $prefix
                    ) );
                }
            }
        }
    }

    /**
     * Get notices
    **/

    public static function get_notices()
    {
        $Cache_data =   array();
        $Cache      =   get_prefixed_cache( 'Do_notices_' );
        foreach( $Cache as $_Cache ) {
            $Cache_data[]   =   ( array ) @$_Cache[ 'data' ];
        }
        return $Cache_data;
    }
}
