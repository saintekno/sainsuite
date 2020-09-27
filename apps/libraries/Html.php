<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Html
{
    private static $page_title = 'Untitled Page';
    private static $page_description;
    
    /**
     * Set title
     *
     * Set page title
     *
     * @access : public
     * @param : string
     * @return : void
    **/
    
    public static function set_title($title)
    {
        self::$page_title = $title;
    }
    
    /**
     * 	Get Title
     * @access : public
     * @return : string
    **/
    
    public static function get_title()
    {
        return self::$page_title;
    }
    
    /**
     * Page Description
     * 
     * @access : public
     * @param : string page description
     * @return : void
    **/
    
    public static function set_description($description)
    {
        self::$page_description = $description;
    }
    
    /**
     * Get page description
     * 
     * @access : public
     * @return : string page description
    **/
    
    public static function get_description()
    {
        return self::$page_description;
    }
}
