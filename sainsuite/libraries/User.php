<?php

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
class User
{

    /**
     * Checks whether a user is connected
     * @access public
     * @return bool
    **/

    public static function is_loggedin()
    {
        return get_instance()->aauth->is_loggedin();
    }

    public static function id()
    {
        $user = get_instance()->aauth->get_user_id();
        return $user ? $user : 0;
    }

    public static function get($user_par = false)
    {
        return get_instance()->aauth->get_user($user_par);
    }

    public static function get_user_group($user_par = false)
    {
        return get_instance()->aauth->get_user_group($user_par);
    }

    public static function in_group($group_name)
    {
        return get_instance()->aauth->is_member($group_name);
    }

    public static function control( $perm_par = false )
    {
        return get_instance()->aauth->control($perm_par);
    }

    /**
     * Get user avatar SRC
     * @return string
    **/

    public static function get_user_image_url($user_id = 0)
    {
        if ($picture = riake('picture', (array) get_instance()->aauth->get_user($user_id)))
            return $picture;
        elseif (file_exists(upload_path().'user_image/'.$user_id.'.jpg'))
            return upload_url().'user_image/'.$user_id.'.jpg';
        else
            $current_user = get_instance()->aauth->get_user($user_id);
            return self::get_gravatar($current_user->email, 90);
    }

    /**
     * Get use avatar
     * @param string email
     * @param int width
     * @param string
     * @param string
     * @param bool
     * @param array atts
     * @return string avatar src/image tag
    **/

    public static function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http") . '://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";

        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }

    public static function upload_user_image($user_id) 
    {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") 
        {
            $destination_user = upload_path()."user_image/" ;
            if (!is_dir($destination_user)) {
                mkdir($destination_user);
            }
            Filer::file_copy($_FILES['user_image']['tmp_name'], $destination_user.$user_id.'.jpg');
        }
    }
}
