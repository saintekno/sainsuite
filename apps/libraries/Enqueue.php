<?php 
defined('BASEPATH') or exit('No direct script access allowed');

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
class Enqueue
{
    public $scripts = array();

    public $styles = array();

    private $_namespace = 'default';

    /**
     *  CSS Namespace
    **/
    public function css_namespace( $namespace )
    {
        if( @$this->css[ $namespace ] == null ) 
        {
            $this->css[ $namespace ] = array();
        }
        $this->_namespace = $namespace;
    }

    /**
     * Enqueue CSS
     *
     * Enqueue CSS to global queue
     */
    public function css($style, $path = null)
    {
        $CI =& get_instance();
        $this->styles[ $this->_namespace ][ basename( $style ) ] = ($path === null)
            ? base_url() . $CI->config->item('asset_path') . $CI->config->item('backend_path') . theme_backend() . $CI->config->item('css_path') . $style
            : $path . $style;
    }

    /**
     * Output CSS
     *
     * output css
     */
    public function load_css( $namespace = 'default' )
    {
        if( @$this->styles[ $namespace ] ) 
        {
            foreach ( $this->styles[ $namespace ] as $style) 
            {
                echo '<link rel="stylesheet" href="' . $style . '.css" />'."\n";
            }
        }
    }

    /**
     *  JS Namespace
    **/
    public function js_namespace( $namespace )
    {
        if( @$this->js[ $namespace ] == null ) {
            $this->js[ $namespace ] = array();
        }
        $this->_namespace = $namespace;
    }

    /**
     * Enqueue JS
     *
     * Enqueue js to global queue
     */
    public function js( $script, $path = null)
    {
        $CI =& get_instance();
        $this->scripts[ $this->_namespace ][ basename( $script ) ] = ($path === null)
            ? base_url() . $CI->config->item('asset_path') . $CI->config->item('backend_path') . theme_backend() . $CI->config->item('js_path') . $script
            : $path . $script;
    }

    /**
     * Output JS
     *
     * output js
     */
    public function load_js( $namespace = 'default' )
    {
        if( @$this->scripts[ $namespace ] ) 
        {
            foreach ( $this->scripts[ $namespace ] as $script) 
            {
                echo '<script src="' . $script . '.js"></script>'."\n";
            }
        }
    }

    /**
     * addon CSS
    **/
    public function addon_css( $addon_namespace, $style ) 
    {
        return $this->css( $style, addon_url( $addon_namespace ) );
    }

    /**
     * addon JS
    **/
    public function addon_js( $addon_namespace, $style )
    {
        return $this->js( $style, addon_url( $addon_namespace ) );
    }
}
