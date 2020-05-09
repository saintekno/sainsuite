<?php defined('BASEPATH') or exit('No direct script access allowed');

class Gui extends CI_Model
{
    public $cols = array(
        1 => array(),
        2 => array(),
        3 => array(),
        4 => array(),
    );

    private $created_page       = array();
    private $created_page_objet = array();

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Page title
     * @string Page Title
    **/

    public function set_title($title)
    {
        Html::set_title($title);
    }

    /**
     * New Gui
    **/
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
     * Add Meta to gui
     *
     * @access public
     * @param string/array namespace, config array
     * @param string meta title
     * @param string meta type
     * @param int col id
     * @return void
    **/

    public function add_meta($namespace, $title = 'Unamed', $type = 'box-default', $col_id = 1)
    {
        if (in_array($col_id, array( 1, 2, 3, 4 ))) {
            if (is_array($namespace)) 
            {
                $rnamespace = riake('namespace', $namespace);
                $col_id     = riake('col_id', $namespace);
                $title      = riake('title', $namespace);
                $type       = riake('type', $namespace);

                foreach ($namespace as $key => $value) {
                    $this->cols[ $col_id ][ 'metas' ][ $rnamespace ][ $key ] = $value;
                }
            } 
            else 
            {
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
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/navigation');
        $this->load->view('dashboard/aside');
        $this->load->view('dashboard/gui/body', array(
            'page_header' => $this->load->view('dashboard/gui/page-header', array(), true),
            'cols'        => $this->cols
        ));
        $this->load->view('dashboard/footer');
        $this->load->view('dashboard/aside-right');
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
     * Allow Gui customization.
     *
     * @access public
     * @param mixed
     * @return void
    **/

    public function config($config)
    {
        $this->config = $config;
    }
}
