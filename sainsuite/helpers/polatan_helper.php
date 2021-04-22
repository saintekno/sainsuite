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
    $theme_frontend = get_instance()->events->apply_filters('fill_theme_frontend', riake( 'theme_frontend', options() ));
    return $theme_frontend . '/';
}

// --------------------------------------------------------------------

function theme_backend()
{
    $theme_backend = get_instance()->events->apply_filters('fill_theme_backend', riake( 'theme_backend', options() ));
    return ($theme_backend) ? $theme_backend . '/' : '';
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