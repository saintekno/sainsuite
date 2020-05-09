<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Enqueue JavaScript and CSS Styles in CodeIgniter with a simple, lightweight library.
 */

class Enqueue
{
    public $scripts = array();

    public $styles = array();

    public $path_js = 'js/';

    public $path_css = 'css/';

    private $_css_namespace = 'default';

    private $_js_namespace = 'default';

    /**
     * Enqueue CSS
     *
     * Enqueue CSS to global queue
     */
    public function css($style, $path = null, $root = false)
    {
        if ($root == true) {
            $this->styles[ $this->_css_namespace ][ basename( $style ) ] = base_url() . $style;
        }
        else {
            $this->styles[ $this->_css_namespace ][ basename( $style ) ] = ($path === null) ? base_url() . $this->path_css . $style : $path . $style;
        }
    }

    /**
     * Enqueue JS
     *
     * Enqueue js to global queue
     */
    public function js($script, $path = null, $root = false)
    {
        if ($root == true) {
            $this->scripts[ $this->_js_namespace ][ basename( $script ) ] = base_url() . $script;
        }
        else {
            $this->scripts[ $this->_js_namespace ][ basename( $script ) ] = ($path === null) ? base_url() . $this->path_js . $script : $path . $script;
        }
    }

    /**
     *  CSS Namespace
    **/

    public function css_namespace( $namespace )
    {
        if( @$this->css[ $namespace ] == null ) 
        {
            $this->css[ $namespace ] = array();
        }
        $this->_css_namespace = $namespace;
    }

    /**
     *  Js Clear
    **/

    public function css_clear( $namespace = null )
    {
        $this->styles[ $namespace == null ? $this->_css_namespace : $namespace ] = [];
    }

    /**
     *  JS Namespace
    **/

    public function js_namespace( $namespace )
    {
        if( @$this->js[ $namespace ] == null ) 
        {
            $this->js[ $namespace ] = array();
        }
        $this->_js_namespace = $namespace;
    }

    /**
     *  Js Clear
    **/

    public function js_clear( $namespace = null )
    {
        $this->scripts[ $namespace == null ? $this->_js_namespace : $namespace ] = [];
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
     * Module CSS
    **/

    public function module_css( $module_namespace, $style ) 
    {
        return $this->css( $style, module_url( $module_namespace ) );
    }

    /**
     * Module JS
    **/

    public function module_js( $module_namespace, $script )
    {
        return $this->js( $script, module_url( $module_namespace ) );
    }
}
