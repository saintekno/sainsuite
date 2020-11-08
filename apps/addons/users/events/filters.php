<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class Users_Filters extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        
        // $this->events->add_filter( 'signin_logo', [ $this->filters, 'signin_logo' ] );
        // $this->events->add_filter( 'dashboard_footer_right', [ $this->filters, 'dashboard_footer_right' ] );
        // $this->events->add_filter( 'dashboard_footer_text', [ $this->filters, 'dashboard_footer_text' ] );
        $this->events->add_filter('custom_user_meta', array( $this, 'custom_user_meta' ), 10, 1);
        $this->events->add_filter('signin_logo', array( $this, 'signin_logo' ));
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_avatar_src', function () {
            return User::get_gravatar_url();
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
        $fields[ 'first-name' ] = ($fname = $this->input->post('first-name')) ? $fname : '';
        $fields[ 'last-name' ] = ($lname = $this->input->post('last-name')) ? $lname : '';
        $fields[ 'theme-skin' ] = ($skin = $this->input->post('theme-skin')) ? $skin : 'skin-blue';
        return $fields;
    }

    public function signin_logo()
    {
        return upload_url().'system/logo-dark.png';
    }

    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_body_class($class)
    {
        global $User_Options;
        $class = '';
        // skin is defined by default
        // $class .= ($db_skin = riake('theme-skin', $User_Options)) ? $db_skin : $class;
        
        // get user sidebar status
        $class .= ($sidebar = riake('dashboard-sidebar', $User_Options)) ? $sidebar : 'aside-minimize';
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
        $name    =    riake('first-name', $User_Options);
        $last    =    riake('last-name', $User_Options);
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }
}
new Users_Filters;