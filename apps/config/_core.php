<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Reserved Controller
|--------------------------------------------------------------------------
|
| Set reserved controller for the app.
|
*/

// Reserved Controllers
$config[ 'reserved_controllers' ]               = array( 'dashboard' , 'login', 'logout' , 'register' , 'do-setup', 'oauth' );
$config[ 'controllers_requiring_installation' ] = array( 'dashboard' , 'login' , 'logout' , 'register', 'oauth' );
$config[ 'controllers_requiring_login' ]        = array( 'dashboard' , 'logout', 'oauth' );
$config[ 'controllers_requiring_logout' ]       = array( 'login' , 'register' );
$config[ 'default_logout_route' ]               = '/dashboard/';
$config[ 'default_login_route' ]                = '/login/';

// For Auth Class (Email Purpose)
$config[ 'route_for_verification' ] = '/auth/verify/';
$config[ 'route_for_reset' ]        = '/auth/reset/';
$config[ 'default_user_names' ]     = 'Boed';
$config[ 'username_login' ]         = true;

// Core ID
$config[ 'core_app_name' ]    = 'eracik';
$config[ 'core_version' ]     = '2.1.0';                              // core id
$config[ 'core_signature' ]   = 'eracik. ' . $config[ 'core_version' ];  // core id
$config[ 'database_version' ] = '1.0';

// Text Domain 
$config[ 'site_language' ] = 'en_US';
$config[ 'text_domain' ]   = array(
    'eracik' => APPPATH . 'language'
);
$config[ 'supported_languages' ] = array(
    'en_US' => 'English',
    'id_ID' => 'Indonesia',
);

// Update
$config[ 'force_major_updates' ] = true;

// access module
$config[ 'hide_modules' ] = false;

// Site Time Zone
$config[ 'site_timezone' ] = [
    'Asia/Beirut'        => '(UTC+02:00) Asia &mdash; Beirut',
    'Asia/Damascus'      => '(UTC+02:00) Asia &mdash; Damascus',
    'Asia/Gaza'          => '(UTC+02:00) Asia &mdash; Gaza',
    'Asia/Hebron'        => '(UTC+02:00) Asia &mdash; Hebron',
    'Asia/Jerusalem'     => '(UTC+02:00) Asia &mdash; Jerusalem',
    'Asia/Nicosia'       => '(UTC+02:00) Asia &mdash; Nicosia',
    'Asia/Aden'          => '(UTC+03:00) Asia &mdash; Aden',
    'Asia/Amman'         => '(UTC+03:00) Asia &mdash; Amman',
    'Asia/Baghdad'       => '(UTC+03:00) Asia &mdash; Baghdad',
    'Asia/Bahrain'       => '(UTC+03:00) Asia &mdash; Bahrain',
    'Asia/Kuwait'        => '(UTC+03:00) Asia &mdash; Kuwait',
    'Asia/Qatar'         => '(UTC+03:00) Asia &mdash; Qatar',
    'Asia/Riyadh'        => '(UTC+03:00) Asia &mdash; Riyadh',
    'Asia/Tehran'        => '(UTC+03:30) Asia &mdash; Tehran',
    'Asia/Baku'          => '(UTC+04:00) Asia &mdash; Baku',
    'Asia/Dubai'         => '(UTC+04:00) Asia &mdash; Dubai',
    'Asia/Muscat'        => '(UTC+04:00) Asia &mdash; Muscat',
    'Asia/Tbilisi'       => '(UTC+04:00) Asia &mdash; Tbilisi',
    'Asia/Yerevan'       => '(UTC+04:00) Asia &mdash; Yerevan',
    'Asia/Kabul'         => '(UTC+04:30) Asia &mdash; Kabul',
    'Asia/Aqtau'         => '(UTC+05:00) Asia &mdash; Aqtau',
    'Asia/Aqtobe'        => '(UTC+05:00) Asia &mdash; Aqtobe',
    'Asia/Ashgabat'      => '(UTC+05:00) Asia &mdash; Ashgabat',
    'Asia/Dushanbe'      => '(UTC+05:00) Asia &mdash; Dushanbe',
    'Asia/Karachi'       => '(UTC+05:00) Asia &mdash; Karachi',
    'Asia/Oral'          => '(UTC+05:00) Asia &mdash; Oral',
    'Asia/Samarkand'     => '(UTC+05:00) Asia &mdash; Samarkand',
    'Asia/Tashkent'      => '(UTC+05:00) Asia &mdash; Tashkent',
    'Asia/Colombo'       => '(UTC+05:30) Asia &mdash; Colombo',
    'Asia/Kolkata'       => '(UTC+05:30) Asia &mdash; Kolkata',
    'Asia/Kathmandu'     => '(UTC+05:45) Asia &mdash; Kathmandu',
    'Asia/Almaty'        => '(UTC+06:00) Asia &mdash; Almaty',
    'Asia/Bishkek'       => '(UTC+06:00) Asia &mdash; Bishkek',
    'Asia/Dhaka'         => '(UTC+06:00) Asia &mdash; Dhaka',
    'Asia/Qyzylorda'     => '(UTC+06:00) Asia &mdash; Qyzylorda',
    'Asia/Thimphu'       => '(UTC+06:00) Asia &mdash; Thimphu',
    'Asia/Yekaterinburg' => '(UTC+06:00) Asia &mdash; Yekaterinburg',
    'Asia/Rangoon'       => '(UTC+06:30) Asia &mdash; Rangoon',
    'Asia/Bangkok'       => '(UTC+07:00) Asia &mdash; Bangkok',
    'Asia/Ho_Chi_Minh'   => '(UTC+07:00) Asia &mdash; Ho Chi Minh',
    'Asia/Hovd'          => '(UTC+07:00) Asia &mdash; Hovd',
    'Asia/Jakarta'       => '(UTC+07:00) Asia &mdash; Jakarta',
    'Asia/Novokuznetsk'  => '(UTC+07:00) Asia &mdash; Novokuznetsk',
    'Asia/Novosibirsk'   => '(UTC+07:00) Asia &mdash; Novosibirsk',
    'Asia/Omsk'          => '(UTC+07:00) Asia &mdash; Omsk',
    'Asia/Phnom_Penh'    => '(UTC+07:00) Asia &mdash; Phnom Penh',
    'Asia/Pontianak'     => '(UTC+07:00) Asia &mdash; Pontianak',
    'Asia/Vientiane'     => '(UTC+07:00) Asia &mdash; Vientiane',
    'Asia/Brunei'        => '(UTC+08:00) Asia &mdash; Brunei',
    'Asia/Choibalsan'    => '(UTC+08:00) Asia &mdash; Choibalsan',
    'Asia/Chongqing'     => '(UTC+08:00) Asia &mdash; Chongqing',
    'Asia/Harbin'        => '(UTC+08:00) Asia &mdash; Harbin',
    'Asia/Hong_Kong'     => '(UTC+08:00) Asia &mdash; Hong Kong',
    'Asia/Kashgar'       => '(UTC+08:00) Asia &mdash; Kashgar',
    'Asia/Krasnoyarsk'   => '(UTC+08:00) Asia &mdash; Krasnoyarsk',
    'Asia/Kuala_Lumpur'  => '(UTC+08:00) Asia &mdash; Kuala Lumpur',
    'Asia/Kuching'       => '(UTC+08:00) Asia &mdash; Kuching',
    'Asia/Macau'         => '(UTC+08:00) Asia &mdash; Macau',
    'Asia/Makassar'      => '(UTC+08:00) Asia &mdash; Makassar',
    'Asia/Manila'        => '(UTC+08:00) Asia &mdash; Manila',
    'Asia/Shanghai'      => '(UTC+08:00) Asia &mdash; Shanghai',
    'Asia/Singapore'     => '(UTC+08:00) Asia &mdash; Singapore',
    'Asia/Taipei'        => '(UTC+08:00) Asia &mdash; Taipei',
    'Asia/Ulaanbaatar'   => '(UTC+08:00) Asia &mdash; Ulaanbaatar',
    'Asia/Urumqi'        => '(UTC+08:00) Asia &mdash; Urumqi',
    'Asia/Dili'          => '(UTC+09:00) Asia &mdash; Dili',
    'Asia/Irkutsk'       => '(UTC+09:00) Asia &mdash; Irkutsk',
    'Asia/Jayapura'      => '(UTC+09:00) Asia &mdash; Jayapura',
    'Asia/Pyongyang'     => '(UTC+09:00) Asia &mdash; Pyongyang',
    'Asia/Seoul'         => '(UTC+09:00) Asia &mdash; Seoul',
    'Asia/Tokyo'         => '(UTC+09:00) Asia &mdash; Tokyo',
];