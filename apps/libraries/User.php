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
    /**
    * Count Users
    *
    * @return int
    **/
    public static function count_users($include_banneds = false)
    {
        // banneds
        if (! $include_banneds) {
            get_instance()->aauth->aauth_db->where('banned != ', 1);
        }
        return get_instance()->aauth->aauth_db->count_all(get_instance()->aauth->config_vars[ 'users' ]);
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

    public static function get_user_groups($user_par = false)
    {
        return get_instance()->aauth->get_user_groups($user_par);
    }

    public static function control( $perm_par = false )
    {
        return get_instance()->aauth->control($perm_par);
    }

    /**
     * Pseudo
     * retreive user pseudo
     *
     * @access public
     * @param int (optional)
     * @return string
    **/

    public static function pseudo($id = false)
    {
        $user = get_instance()->aauth->get_user($id);
        return $user ? $user->username: __('N/A');
    }

    /**
     * Get user avatar SRC
     * @return string
    **/

    public static function get_user_image_url($user_id = 0)
    {
        if (file_exists(upload_path().'user_image/'.$user_id.'.jpg'))
            return upload_url().'user_image/'.$user_id.'.jpg';
        else
            $current_user = get_instance()->aauth->get_user();
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

    public static function upload_user_image($user_id) {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
            $destination_user = upload_path()."user_image/" ;
            if (!is_dir($destination_user)) {
                mkdir($destination_user);
            }
            @move_uploaded_file($_FILES['user_image']['tmp_name'], $destination_user.$user_id.'.jpg');
        }
    }
}
