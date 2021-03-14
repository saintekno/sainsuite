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

//multiple image upload with resize option
function do_upload($photo) 
{        
    $CI	=&	get_instance();           
    $config['upload_path']  = upload_path();
    $config['allowed_types']= 'gif|jpg|png|jpeg';
    $config['max_size']     = '20000';
    $config['max_width']    = '20000';
    $config['max_height']   = '20000';

    $CI->load->library('upload', $config);                
    
    if ($CI->upload->do_upload($photo)) {
        $data       = $CI->upload->data(); 
        /* PATH */
        $source             = upload_path().$data['file_name'] ;
        $destination_thumb  = upload_path()."thumbnail/" ;
        $destination_medium = upload_path()."medium/" ;
        $destination_big    = upload_path()."big/" ;
        if (!is_dir($destination_thumb)) {
            mkdir($destination_thumb);
            mkdir($destination_medium);
            mkdir($destination_big);
        }

        // Permission Configuration
        chmod($source, 0777) ;

        /* Resizing Processing */
        // Configuration Of Image Manipulation :: Static
        $CI->load->library('image_lib') ;
        $img['image_library'] = 'GD2';
        $img['create_thumb']  = TRUE;
        $img['maintain_ratio']= TRUE;

        /// Limit Width Resize
        $limit_big   = 2000 ;
        $limit_medium    = 400 ;
        $limit_thumb    = 100 ;

        // Size Image Limit was using (LIMIT TOP)
        $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

        // Percentase Resize
        if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
            $percent_big = $limit_big/$limit_use ;
            $percent_medium  = $limit_medium/$limit_use ;
            $percent_thumb  = $limit_thumb/$limit_use ;
        }

        //// Making THUMBNAIL ///////
        $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
        $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

        // Configuration Of Image Manipulation :: Dynamic
        $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
        $img['quality']      = '99%' ;
        $img['source_image'] = $source ;
        $img['new_image']    = $destination_thumb ;

        $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
        // Do Resizing
        $CI->image_lib->initialize($img);
        $CI->image_lib->resize();
        $CI->image_lib->clear() ;                 

        //// Making MEDIUM ///////
        $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
        $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

        // Configuration Of Image Manipulation :: Dynamic
        $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
        $img['quality']      = '99%' ;
        $img['source_image'] = $source ;
        $img['new_image']    = $destination_medium ;

        $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
        // Do Resizing
        $CI->image_lib->initialize($img);
        $CI->image_lib->resize();
        $CI->image_lib->clear() ;               

        ////// Making BIG /////////////
        $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
        $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

        // Configuration Of Image Manipulation :: Dynamic
        $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
        $img['quality']      = '99%' ;
        $img['source_image'] = $source ;
        $img['new_image']    = $destination_big ;

        $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
        // Do Resizing
        $CI->image_lib->initialize($img);
        $CI->image_lib->resize();
        $CI->image_lib->clear() ;

        $data_image = array(
            'thumb' => 'thumbnail/'.$thumb_nail,
            'medium' => 'medium/'.$medium,
            'big' => 'big/'.$album_picture
        );

        unlink($source) ;   
        return $data_image;   

    }
    else {
        return FALSE ;
    }
   
}

// image upload function with resize option
function upload_image($max_size)
{
    $CI	=&	get_instance();           
        
    // set upload path
    $config['upload_path']  = upload_path();
    $config['allowed_types']= 'gif|jpg|png|jpeg';
    $config['max_size']     = '92000';
    $config['max_width']    = '92000';
    $config['max_height']   = '92000';

    $CI->load->library('upload', $config);

    if ($CI->upload->do_upload("photo")) {

        $data = $CI->upload->data();

        // set upload path
        $source             = upload_path().$data['file_name'] ;
        $destination_thumb  = upload_path()."thumbnail/" ;
        $destination_medium = upload_path()."medium/" ;
        if (!is_dir($destination_thumb)) {
            mkdir($destination_thumb);
            mkdir($destination_medium);
        }

        // Permission Configuration
        chmod($source, 0777) ;

        /* Resizing Processing */
        // Configuration Of Image Manipulation :: Static
        $CI->load->library('image_lib') ;
        $img['image_library'] = 'GD2';
        $img['create_thumb']  = TRUE;
        $img['maintain_ratio']= TRUE;

        /// Limit Width Resize
        $limit_medium   = $max_size ;
        $limit_thumb    = 150;

        // Size Image Limit was using (LIMIT TOP)
        $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

        // Percentase Resize
        if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
            $percent_medium = $limit_medium/$limit_use ;
            $percent_thumb  = $limit_thumb/$limit_use ;
        }

        //// Making THUMBNAIL ///////
        $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
        $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

        // Configuration Of Image Manipulation :: Dynamic
        $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
        $img['quality']      = ' 100%' ;
        $img['source_image'] = $source ;
        $img['new_image']    = $destination_thumb ;

        $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
        // Do Resizing
        $CI->image_lib->initialize($img);
        $CI->image_lib->resize();
        $CI->image_lib->clear() ;

        ////// Making MEDIUM /////////////
        $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
        $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

        // Configuration Of Image Manipulation :: Dynamic
        $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
        $img['quality']      = '100%' ;
        $img['source_image'] = $source ;
        $img['new_image']    = $destination_medium ;

        $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
        // Do Resizing
        $CI->image_lib->initialize($img);
        $CI->image_lib->resize();
        $CI->image_lib->clear() ;

        // set upload path
        $images = 'medium/'.$mid;
        $thumb  = 'thumbnail/'.$thumb_nail;

        unlink($source);
        return array(
            'images' => $images,
            'thumb' => $thumb
        );
    }
    else {
        echo "Failed! to upload image" ;
    }
        
}