<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class Polatan
{
	/**
	 * The CodeIgniter object variable
	 * @access public
	 * @var object
	 */
    public $CI;
    
    public $cols = array(
        1 => array(),
        2 => array(),
        3 => array(),
        4 => array(),
    );

    private static $page_name;
    private static $page_title = 'Untitled Page';
    private static $page_description;
    
	/**
	 * Constructor
	 */
	public function __construct() {
		// get main CI object
        $this->CI = & get_instance();
    }

    /**
     * Set Page
     *
     * @access : public
     * @param : string
     * @return : void
    **/
    public static function set_page($page)
    {
        self::$page_name = $page;
    }
    
    /**
     * 	Get Page
     * @access : public
     * @return : string
    **/
    public static function get_page()
    {
        return self::$page_name;
    }

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

    /**
     * Set cols width
     *
     * col_id should be between 1 and 4. Every cols are loaded even if they width is not set
     * @access : public
     * @param : int cold id
     * @param : int width
     * @return : void
    **/
    public function col_width($col_id, $width)
    {
        if (in_array($col_id, array( 1, 2, 3, 4 ))) {
            $this->cols[ $col_id ][ 'width' ] = $width;
        }
    }

    /**
     * 	Get GUI cols
     *	@access		:	Public
     *	@returns	:	Array
    **/
    public function get_cols()
    {
        return $this->cols;
    }

    /**
     * Get Col
     *
     * @param int Col Id
     * @return bool
    **/
    public function get_col($col_id)
    {
        return riake($col_id, $this->cols);
    }

    /**
     * Set cols width
     *
     * col_id should be between 1 and 4. Every cols are loaded even if they width is not set
     * @access : public
     * @param : int cold id
     * @param : int width
     * @return : void
    **/
    public function add_col($col, $col_id)
    {
        if (in_array($col_id, array( 1, 2, 3, 4 ))) {
            $this->cols[ $col_id ] = $col;
        }
    }
    
    /**
     * Add Meta to gui
     *
     * @access public
     * @param string/array namespace, config array
     * @param string meta title
     * @param string meta type
     * @param int col id
     * @return void
    **/
    public function add_meta($namespace, $title = 'Unamed', $type = 'default', $col_id = 1)
    {
        if (in_array($col_id, array( 1, 2, 3, 4 ))) 
        {
            if (is_array($namespace)) {
                $rnamespace = riake('namespace', $namespace);
                $col_id     = riake('col_id', $namespace);
                $title      = riake('title', $namespace);
                $type       = riake('type', $namespace);

                foreach ($namespace as $key => $value) {
                    $this->cols[ $col_id ][ 'metas' ][ $rnamespace ][ $key ] = $value;
                }
            } else {
                $this->cols[ $col_id ][ 'metas' ][ $namespace ] = array(
                    'namespace' => $namespace,
                    'type'      => $type,
                    'title'     => $title
                );
            }
        }
    }

    /**
     * Add Item
     * Add item meta box
     *
     * @param Array Config
     * @param String meta namespace
     * @param int Col id
     * @return void
    **/
    public function add_item($config, $metanamespace, $col_id)
    {
        if (in_array($col_id, array( 1, 2, 3, 4 )) && riake('type', $config)) {
            $this->cols[ $col_id ][ 'metas' ][ $metanamespace ][ 'items' ][] = $config;
        }
    }

    /**
     * Output
     * Output GUI content
     * @return void
    **/
    public function output()
    {
        $this->CI->load->backend_view('index');
    }
}
