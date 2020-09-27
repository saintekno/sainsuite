<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// --------------------------------------------------------------------

function theme()
{
    global $Options;
    if (! Addons::is_active(@$Options[ 'site_theme' ], true)) : return 'default';
    endif;

    return @$Options[ 'site_theme' ] ;
}

// --------------------------------------------------------------------

// This function helps us to decode the theme configuration json file and return that array to us
if ( ! function_exists('themeConfiguration'))
{
    function themeConfiguration($theme, $key = "")
    {
        $themeConfigs = [];
        if (file_exists(get_instance()->config->item('asset_path').get_instance()->config->item('theme_path').$theme.'/config/theme-config.json')) {
            $themeConfigs = file_get_contents(get_instance()->config->item('asset_path').get_instance()->config->item('theme_path').$theme.'/config/theme-config.json');
            $themeConfigs = json_decode($themeConfigs, true);
            if ($key != "") {
                if (array_key_exists($key, $themeConfigs)) {
                    return $themeConfigs[$key];
                } else {
                    return false;
                }
            }else {
                return $themeConfigs;
            }
        } else {
            return false;
        }
    }
}

/**
 * Output array details
 * @access public
 * @param Array
 * @param Bool
 * @return String
**/

function print_array($array, $return = false)
{
    ob_start();
    echo '<pre>';
    print_r($array, $return);
    echo '</pre>';
    return $return ? ob_get_clean() : null;
}

/**
 * date_now()
 * Returns current date considering settings
**/

function date_now( $format = DATE_W3C )
{
    return date( $format, date_timestamp());
}

// --------------------------------------------------------------------

/**
 * Date Timestamp
 * Returns a UNIX Timestamp based on Current site settings
**/

function date_timestamp()
{
    global $Options;

    // while using options from CI_Controller interface
    if ($Options == null) 
    {
        $query = get_instance()->db->where('key', 'site_timezone')->get('options');
        $result = $query->result_array();
        $Options[ 'site_timezone' ] = @$result[0][ 'key' ];
    }

    return now( @$Options[ 'site_timezone' ] );
}

// --------------------------------------------------------------------

function slugify($text) 
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

// --------------------------------------------------------------------

/**
 *  Get Options
 *  @param string option key
 *  @return string/int/array
**/

function get_option( $key = null, $default = null ) 
{
    global $Options;
    if( $key != null ) 
    {
        if( empty( @$Options[ $key ] ) ) 
        {
            return $default;
        }
        return $Options[ $key ];
    }
    return $Options;
}

// --------------------------------------------------------------------

/**
 * Set Options
 * @param string key
 * @param var value
 * @return void
**/

function set_option( $key, $value ) 
{
    return get_instance()->options_model->set( $key, $value );
}

// --------------------------------------------------------------------

/**
 * Output message from URL
 *
 * @param String (error code)
 * @return String (Html result)
**/
if (!function_exists('notice_from_url')) 
{
    function notice_from_url()
    {
        $notice = '';
        if (isset($_GET['notice'])) {
            $notice = get_instance()->lang->line($_GET['notice']);
        }
        return $notice;
    }
}

// --------------------------------------------------------------------

/**
 * Returns if array key exists. If not, return false if $default is not set or return $default instead
 */
if (! function_exists('riake')) 
{
    function riake($key, $subject, $default = false)
    {
        if (is_array($subject)) {
            return array_key_exists($key, $subject) ? $subject[ $key ] : $default;
        }
        return $default;
    }
}

// --------------------------------------------------------------------

function farray($array)
{
    return riake(0, $array, false);
}

// --------------------------------------------------------------------
 
/**
 * Force a var to be an array.
 *
 * @param Var
 * @return Array
**/
function force_array($array)
{
    if (is_array($array)) {
        return $array;
    }
    return array();
}

/**
 * Pluck an array of values from an array. (Only for PHP 5.3+)
 *
 * @param  $array - data
 * @param  $key - value you want to pluck from array
 *
 * @return plucked array only with key data
 */
function array_pluck($array, $key) {
    return array_map(function($v) use ($key)	{
        return is_object($v) ? $v->$key : $v[$key];
    }, $array);
}

/*
 * Inserts a new key/value before the key in the array.
 *
 * @param $key
 * The key to insert before.
 * @param $array
 * An array to insert in to.
 * @param $new_key
 * The key to insert.
 * @param $new_value
 * An value to insert.
 *
 * @return
 * The new array if the key exists, FALSE otherwise.
 *
 * @see array_insert_after()
 */
function array_insert_before($key, $array, $new_key, $new_value)
{
    if (array_key_exists($key, $array)) {
        $new = array();
        foreach ($array as $k => $value) {
            if ($k === $key) {
                $new[$new_key] = $new_value;
            }
            $new[$k] = $value;
        }
        return $new;
    }
    return $array;
}

// --------------------------------------------------------------------

/**
 * get recupère des informations sur le système.
 */
if (! function_exists('get')) 
{
    function get($key) // add to doc
    {
        $vers = explode('-', get_instance()->config->item('version'));
        switch ($key) {
            case "str_version" :
                return $vers[0].' '.$vers[1];
            break;
            case "version" :
                return $vers[0];
            break;
            case "signature" :
                return get_instance()->config->item('signature');
            break;
            case 'app_name':
                return get_instance()->config->item('app_name');
            break;
        }
    }
}

// --------------------------------------------------------------------

if (! function_exists('translate')) 
{
    // Alias of "translate"
    function __($code, $templating = 'core')
    {
        return translate($code, $templating);
    }

    // Alias of __, but echo instead
    function _e($code, $templating = 'core')
    {
        echo __($code, $templating);
    }

    // Echo Translation filtered with addslashes
    function _s($code, $templating = 'core' )
    {
        return addslashes(__($code, $templating));
    }

    /**
     * Get translated text
    **/
    function translate($code, $textdomain = 'core')
    {
        $instance = get_instance();
        global $Options, $LangFileHandler, $PoParsed;

        $text_domains = $instance->config->item('text_domain');

        if (in_array($textdomain, array_keys($text_domains))) 
        {
            // $module = Modules::get( $text_domain );
            $lang_file = $text_domains[ $textdomain ] . '/' . $instance->config->item('site_language') . '.po';

            if (is_file($lang_file)) 
            {
                if (! isset($LangFileHandler[ $textdomain ])) 
                {
                    $LangFileHandler[ $textdomain ] = new Sepia\PoParser\SourceHandler\FileSystem($lang_file);
                    $PoParsed[ $textdomain ] = new Sepia\PoParser\Parser($LangFileHandler[ $textdomain ]);
                    $PoParsed[ $textdomain ]->parse();
                    $PoParsed[ $textdomain ]->AllEntries = $PoParsed[ $textdomain ]->entries();

                    foreach ($PoParsed[ $textdomain ]->AllEntries as $key => $entry) 
                    {
                        $newKey = str_replace('<##EOL##>', '', $key);
                        if ($key !== $newKey) 
                        {
                            $PoParsed[ $textdomain ]->AllEntries[ $newKey ] = $entry;
                            unset($PoParsed[ $textdomain ]->AllEntries[ $key ]); //unset key
                        }
                    }
                }

                return implode('', riake('msgstr', riake($code, $PoParsed[ $textdomain ]->AllEntries, array( 'msgstr' => array( $code ) ))));
            }
        }
        return $code;
    }
}