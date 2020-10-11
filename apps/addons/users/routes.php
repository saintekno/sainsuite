<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $Routes;

$Routes->get( 'users/{page_id?}', 'UsersHomeController@read' )
->where([ 'page_id' => '[0-9]+' ]);

$Routes->match([ 'get', 'post' ], 'users/create', 'UsersHomeController@create' );
$Routes->match([ 'get', 'post' ], 'users/delete/{id}', 'UsersHomeController@delete' );
$Routes->match([ 'get', 'post' ], 'users/edit/{id}', 'UsersHomeController@update' );

$Routes->match([ 'get', 'post' ], 'users/profile', 'UsersProfileController@index' );

$Routes->match([ 'get', 'post' ], 'users/groups', 'UsersHomeController@groups' );