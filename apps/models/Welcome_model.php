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
class Welcome_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action( 'load_frontend_home', [ $this, 'load_frontend_home' ]  );
    }

    /**
     * Front UI
     *
     * @return void
     */
    public function load_frontend_home()
    {
        $this->load->frontend_view( 'home' );
    }
}
