<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * An open source project to allow developers to Starter Web App of CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.2
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

$config['module_config'] = array(
    'author'      => 'Racik',
    'description' => 'Queues emails to be sent in bursts throughout the day.',
    'name'        => 'lang:rp_menu_emailer',
    'version'     => '0.7.3',
    'menus'       => array(
        'settings' => 'emailer/settings/menu',
    ),
);
