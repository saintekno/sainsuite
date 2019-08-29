<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Authentication
Route::any(LOGIN_URL, 'users/login', array('as' => 'login'));
Route::any(REGISTER_URL, 'users/register', array('as' => 'register'));
Route::block('users/login');
Route::block('users/register');

Route::any('logout', 'users/logout');
Route::any('forgot_password', 'users/forgot_password');
Route::any('reset_password/(:any)/(:any)', 'users/reset_password/$1/$2');

// Activation
Route::any('activate', 'users/activate');
Route::any('activate/(:any)', 'users/activate/$1');
Route::any('resend_activation', 'users/resend_activation');

// Installation
Route::any('install', 'installer/index');
Route::any('install/do_install', 'installer/do_install');

// Contexts
Route::prefix(SITE_AREA, function(){
    Route::context('content', array('home' => SITE_AREA .'/content/index'));
    Route::context('reports', array('home' => SITE_AREA .'/reports/index'));
    Route::context('developer');
    Route::context('settings');
});

$route = Route::map($route);