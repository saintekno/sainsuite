<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['404_override']         = 'welcome';
$route['default_controller']   = 'welcome';
$route['translate_uri_dashes'] = FALSE;

$route[ 'login' ]    = 'auth';
$route[ 'logout' ]   = 'auth/logout';
$route[ 'register' ] = 'auth/register';