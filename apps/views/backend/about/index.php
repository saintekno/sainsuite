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

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'about',
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->view('backend/about/index_dom', array(
        'check' => $check
    ), true )
), 'about', 1);

$this->polatan->output();