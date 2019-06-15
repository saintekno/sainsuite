<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.6
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

$config['module_config'] = array(
    'author'      => 'Racik',
    'description' => 'Provides tools for working with your database(s).',
    'version'     => '0.1.0',
    'menus'       => array(
        'developer' => 'database/developer/menu',
    ),
    'menu_topic'  => array(
        'developer' => 'lang:rp_menu_db_tools',
    ),
);
