<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.1
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

// string[] Folders the installer checks for write access.
$config['writable_folders'] = array(
    'application/cache',
    'application/logs',
    'application/config',
    'application/archives',
    'application/db/backups',
    'public/assets/cache',
);

// string[] Files the installer checks for write access.
$config['writable_files'] = array(
    'application/config/application.php',
    'application/config/'.ENVIRONMENT.'/database.php',
);
