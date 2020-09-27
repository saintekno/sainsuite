<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $Routes;

$Routes->get( 'users', 'UsersHomeController@index' );
$Routes->get( 'users/profile', 'UsersHomeController@profile' );