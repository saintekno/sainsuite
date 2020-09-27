<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice
{
    private $notice;

    /**
     * Notice class
     *
     * Save and enqueue notifications within a big array 
     * which can be outputed using "parse_notice" method.
    **/
    
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
        $this->notice[] = $e;
    }
    
    /**
     * Output a notice
     * 
     * @param bool whether to return or not notices
     * @return void/bool
    **/
    
    public function output_notice($return = false)
    {
        if (is_array($this->notice)) 
        {
            $final = '';
            foreach ($this->notice as $n) 
            {
                if ($return == false) {
                    if (is_callable($n)) {
                        $n();
                    } else {
                        echo $n;
                    };
                } 
                else {
                    if (is_callable($n)) {
                        ob_start();
                        $n();
                        $final .= ob_get_clean();
                    } else {
                        $final .= $n;
                    };
                }
            }
            return $final;
        } 
        else {
            return $this->notice;
        }
    }
}
