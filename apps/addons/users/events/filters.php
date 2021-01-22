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
class Users_Filters extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
        
        $this->events->add_filter('custom_user_meta', array( $this, 'custom_user_meta' ), 10, 1);
        $this->events->add_filter('apps_logo', array( $this, 'apps_logo' ), 5, 1);
        $this->events->add_filter('dashboard_skin_class', array( $this, 'dashboard_skin_class' ), 5, 1);
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_avatar_src', function () {
            return User::get_user_image_url(User::id());
        });
    }
    
    /**
    * Adds custom meta for user
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function custom_user_meta($fields)
    {
        $fields[ 'phone' ] = ($fname = $this->input->post('phone')) ? $fname : '';
        $fields[ 'address' ] = ($fname = $this->input->post('address')) ? $fname : '';
        $fields[ 'firstname' ] = ($fname = $this->input->post('firstname')) ? $fname : '';
        $fields[ 'lastname' ] = ($lname = $this->input->post('lastname')) ? $lname : '';
        $fields[ 'theme-skin' ] = ($skin = $this->input->post('theme-skin')) ? $skin : '';
        return $fields;
    }

    public function apps_logo()
    {
        global $User_Options;
        if ($this->aauth->is_loggedin() && isset($User_Options['meta'])) 
        {
            if (riake('theme-skin', $User_Options['meta']) == null) {
                $logo = 'logo-dark.png';
            } 
            elseif (riake('theme-skin', $User_Options['meta']) == 'skin-light') {
                $logo = 'logo-dark.png';
            }
            else {
                $logo = 'logo-light.png';
            }
        } else {
            $logo = 'logo-dark.png';
        }
        return upload_url('system/'.$logo);
    }

    /**
     * Get dashboard sidebar for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_body_class()
    {
        global $User_Options;        
        // get user sidebar status
        $class = ($sidebar = riake('dashboard-sidebar', $User_Options)) ? $sidebar : 'aside-minimize';
        return $class;
    }

    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_skin_class($class)
    {
        global $User_Options;
        $meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';
        // skin is defined by default
        $class = ($db_skin = riake('theme-skin', $meta)) ? $db_skin : 'skin-light';
        return $class;
    }

    /**
     * Perform Change over Auth emails config
     *
     * @access : public
     * @param : string user names
     * @return : string
    **/

    public function user_menu_name($user_name)
    {
        global $User_Options;
        $meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';
        $name = riake('firstname', $meta);
        $last = riake('lastname', $meta);
        $full = trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }
}
new Users_Filters;