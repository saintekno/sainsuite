<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller']   = 'Frontend';
$route['404_override']         = 'Frontend';
$route['translate_uri_dashes'] = true;

// Slugs.
// must match reserved controllers and controllers requiring installation
$route[ 'login' ]    = 'auth';
$route[ 'register' ] = 'auth/register';
$route[ 'logout' ]   = 'auth/logout';
$route[ 'do-setup' ] = 'do-setup';
$route[ 'api/(.+)' ] = 'api/index/$1';
