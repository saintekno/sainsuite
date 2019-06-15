<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.8
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

class MY_Cart extends CI_Cart 
{
    function __construct() {
        parent::__construct();

        // Remove limitations in product names
        $this->product_name_rules = '\d\D';
    }
}