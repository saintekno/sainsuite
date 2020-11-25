<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

$config[ 'controllers_requiring_installation' ] = array( 'admin' , 'login' , 'recovery' , 'register' );
$config[ 'reserved_controllers' ] = array( 'admin' , 'login', 'recovery' , 'register' , 'install' );
$config[ 'admin_route' ] = array('admin');
$config[ 'login_route' ] = 'login';

/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
*/
$config[ 'site_language' ] = 'en_US';
$config[ 'text_domain' ] = array(
    'core' => APPPATH . 'language'
);
$config[ 'supported_languages' ] = array(
    'en_US' => 'English',
    'id_ID' => 'Indonesia',
);

/*
|--------------------------------------------------------------------------
| Core ID
|--------------------------------------------------------------------------
*/
$config[ 'app_name' ] = 'sainsuite';
$config[ 'version' ] = '3.6.0';
$config[ 'signature' ] = $config[ 'app_name' ] . ' ' . $config[ 'version' ];

/*
|--------------------------------------------------------------------------
| Custom Asset Paths
|--------------------------------------------------------------------------
*/
$config['asset_path']    = 'assets/';
$config['upload_path']   = 'uploads/';
$config['theme_path']    = 'themes/';
$config['addon_path']    = 'addons/';
$config['css_path']      = 'css/';
$config['js_path']       = 'js/';
$config['img_path']      = 'img/';

/*
|--------------------------------------------------------------------------
| Site Time Zone
|--------------------------------------------------------------------------
*/
date_default_timezone_set('Asia/Jakarta');
$config[ 'site_timezone' ] = [
    'Asia/Jakarta' => '(UTC+07:00) Asia &mdash; Jakarta',
];