<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

$migration_files = dirname( __FILE__ ) . '/migrate/';
$files = [];
if ($handle = opendir( $migration_files )) 
{
    while (false !== ($entry = readdir($handle))) 
    {
        if ($entry != "." && $entry != "..") 
        {
			$base_name = basename( $migration_files . $entry );
			$files[ substr( $base_name, 0, strlen( $base_name ) - 4 ) ] = $migration_files . $entry;
		}
	}
	closedir($handle);
}

return $files;