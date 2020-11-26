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

global $Routes;

$Routes->get( 'users/{page_id?}', 'UsersHomeController@index' )->where([ 'page_id' => '[0-9]+' ]);
$Routes->match([ 'get', 'post' ], 'users/add', 'UsersHomeController@add' );
$Routes->match([ 'get', 'post' ], 'users/edit/{id}', 'UsersHomeController@edit' );
$Routes->match([ 'get', 'post' ], 'users/delete/{id}/{redirect?}', 'UsersHomeController@delete' );
$Routes->match([ 'get', 'post' ], 'users/multidelete', 'UsersHomeController@multidelete' );

$Routes->match([ 'get', 'post' ], 'users/profile', 'UsersProfileController@index' );

$Routes->match([ 'get', 'post' ], 'users/group', 'GroupsHomeController@index' );
$Routes->match([ 'get', 'post' ], 'users/group/add', 'GroupsHomeController@add' );
$Routes->match([ 'get', 'post' ], 'users/group/delete/{id}', 'GroupsHomeController@delete' );
$Routes->match([ 'get', 'post' ], 'users/group/edit/{id}', 'GroupsHomeController@edit' );
$Routes->match([ 'get', 'post' ], 'users/group/multidelete', 'GroupsHomeController@multidelete' );