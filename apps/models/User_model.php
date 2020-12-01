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
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        if ($this->aauth->is_loggedin() && $this->install_model->is_installed()) {
            $this->refresh_user_meta();
        } 
    }

    /**
     * Refresh User Meta
     * @return void
    **/

    public function refresh_user_meta()
    {
        global $User_Options;
        $User_Options = $this->get();
    }

    public function get()
    {
        // fetch data
        $user_option = $this->aauth->get_user_vars($this->aauth->get_user_id());

        $key_value = array();
        foreach (force_array($user_option) as $_option) 
        {
            $value = riake('value', $_option);
            $value = is_array($array = json_decode($value, true)) ? $array : $value; // converting array to JSON
            $value = in_array($value, array( 'true', 'false' )) ? $value === 'true' ? true : false : $value;  // Converting Bool to string

            $key_value[ riake('data_key', $_option) ] = $value;
        }
        return $key_value;
    }

    /**
     * Login
     * @param string
     * @return string
    **/

    public function login()
    {
        $this->aauth->login(
            $this->input->post( 'username_or_email' ),
            $this->input->post( 'password'),
            $this->input->post( 'keep_connected' ) != null ? true : false
        );

        if ( $this->aauth->is_loggedin()) {
            return 'user-logged-in';
        }

        return false;
    }

    /**
     * 	Create user with default privilege
     *
     * @access: public
     * @param : string email
     * @param : string password
     * @param : string name
     * @return: bool
    **/

    public function create($email, $password, $username, $group_par, $require_validation = 1)
    {
        $this->aauth->create_user($email, $password, $username);

        // bind user to a speciifc group
        $user_id = $this->aauth->get_user_id($email);

        if(! is_numeric($group_par)) {
            if (! $this->aauth->get_group($group_par)) {
                $this->aauth->create_group($group_par, ucwords($group_par.' group'));
            }
        }

        // Adding to a group
        // refresh group
        $this->aauth->add_member($user_id, $group_par);

        // User Status
        if ($require_validation == 0) {
            $user = $this->aauth->get_user($user_id);
            if( $user ) {
                $this->aauth->verify_user($user_id, $user->verification_code);
            }
        }

        // add custom user vars
        $custom_vars = $this->events->apply_filters('custom_user_vars', []);
        $this->aauth->set_user_var('meta', json_encode($custom_vars), $user_id);

        // add custom user fields
        $custom_fields = $this->events->apply_filters('custom_user_meta', array());
        foreach (force_array($custom_fields) as $key => $value) {
            $this->aauth->set_user_var($key, $value, $user_id);
        }

        User::upload_user_image($user_id);

        if ($user_id) {
            return 'created';
        }
    }

    /***
     * Edit user
     *
     * @access: public
     * @param
    **/

    public function edit($user_id, $email, $password, $group_id, $user_group, $old_password = null, $mode = 'edit', $user_status = '0')
    {
        $return = 'updated';
        // old password has been defined
        if ($old_password != null) 
        {
            // get user using old password
            $query = $this->aauth->get_user($user_id);
			$_password = ($this->aauth->config_vars['use_password_hash'] ? $old_password : $this->aauth->hash_password($old_password, $user_id));
            // if password is correct
			if ($this->aauth->verify_password($_password, $query->pass)) {
                $this->aauth->update_user($user_id, $email, $password);
            } 
            else {
                return 'old-pass-incorrect';
            }
        }

        if ($mode == 'profile') 
        {
            // Change user password and email
            $this->aauth->update_user($user_id, $email, $password);
        }

        // This prevent editing privilege on profile dash
        if ($mode == 'edit') {
            // remove member
            $this->aauth->remove_member($user_id, $user_group->group_id);

            // refresh group
            $this->aauth->add_member($user_id, $group_id);

            // Change user password and email
            $this->aauth->update_user($user_id, $email, $password);

            // User Status
            $user = $this->aauth->get_user($user_id);
            if ($user_status == '0') {
                $this->aauth->verify_user($user_id, $user->verification_code);
            } 
            else if( $user_status == '1' ){
                $this->aauth->ban_user($user_id);
            }
        }

        // add custom user vars
        $custom_vars = $this->events->apply_filters('custom_user_vars', []);
        $this->aauth->set_user_var('meta', json_encode($custom_vars), $user_id);

        $custom_fields = $this->events->apply_filters('custom_user_meta', array());
        foreach ( force_array($custom_fields) as $key => $value) {
            $this->aauth->set_user_var($key, strip_tags( $value ), $user_id);
        } 

        User::upload_user_image($user_id);

        return $return;
    }

    /**
     * Creae Master User
     * @param string Email
     * @param string password
     * @param string user name
     * @return string
    **/

    public function create_admin($email, $password, $username)
    {
        // Create user
        if ($this->aauth->create_user($email, $password, $username)) 
        {
            // Add user to a group
            // We assume 1 is the index of the first user
            $admin_id = $this->aauth->get_user_id($email);

            // assign user to one of the admin group
            $this->aauth->add_member($admin_id, 'admin'); 
            
            // Send Verification
            $this->aauth->send_verification($admin_id);
            
            return 'created';
        }
        return 'unexpected-error';
    }
}
