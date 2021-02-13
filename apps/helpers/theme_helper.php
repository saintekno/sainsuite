<?php  if (! defined('BASEPATH')) {
     exit('No direct script access allowed');
 }

/**
 * Sekati CodeIgniter Asset Helper
 *
 * @package		Sekati
 * @author		Jason M Horwitz
 * @copyright	Copyright (c) 2013, Sekati LLC.
 * @license		http://www.opensource.org/licenses/mit-license.php
 * @link		http://sekati.com
 * @version		v1.2.7
 * @filesource
 */

// --------------------------------------------------------------------

function theme_frontend()
{
    $CI =& get_instance();
    $CI->load->model('options_model');
    return $CI->options_model->get('theme_frontend') . '/' ;
}

// --------------------------------------------------------------------

function theme_backend()
{
    $CI =& get_instance();
    $CI->load->model('options_model');
    if (! $CI->options_model->get('theme_backend') ) : return '';
    endif;

    return $CI->options_model->get('theme_backend') . '/' ;
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