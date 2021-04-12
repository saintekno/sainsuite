<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

// --------------------------------------------------------------------

function theme_frontend()
{
    global $Options, $App_Options;
    $app_theme = riake('theme_frontend', $App_Options);
    return (! $app_theme ) ? @$Options[ 'theme_frontend' ] . '/' : $app_theme . '/' ;
}

// --------------------------------------------------------------------

function theme_backend()
{
    global $Options, $App_Options;
    $app_theme = riake('theme_backend', $App_Options);
    return (! $app_theme ) ? (($back = @$Options[ 'theme_backend' ]) ? $back.'/' : '') : $app_theme . '/' ;
}

// --------------------------------------------------------------------

// This function helps us to decode the theme configuration json file and return that array to us
function theme_config($key = "")
{
    $themeConfigs = [];
    if (file_exists(FRONTENDPATH.theme_frontend().'theme.json')) {
        $themeConfigs = file_get_contents(FRONTENDPATH.theme_frontend().'theme.json');
        $themeConfigs = json_decode($themeConfigs, true);
        if ($key != "") {
            if (array_key_exists($key, $themeConfigs['theme'])) {
                return $themeConfigs['theme'][$key];
            } else {
                return false;
            }
        }else {
            return $themeConfigs['theme'];
        }
    } else {
        return false;
    }
}