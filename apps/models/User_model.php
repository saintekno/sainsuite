<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $user_options = array();  // empty meta

    public function __construct()
    {
        parent::__construct();

        if ($this->aauth->is_loggedin()) {
            $this->refresh_user_meta();
        } 
        else {
            // Autologin user
            if ($user_id = $this->input->cookie('user', true)) {
                $this->aauth->login_fast($user_id);
                $this->refresh_user_meta();
            }
        }
    }

    /**
     * Refresh User Meta
     * @return void
    **/

    public function refresh_user_meta()
    {
        global $User_Options;
        $User_Options = $this->user_options = $this->aauth->get_user_var(null, $this->aauth->get_user_id());
        $this->current = $this->aauth->get_user();
    }

    /**
     * Get user Meta
     *
     * @return mixed
    **/

    public function get_meta($key = null)
    {
        if ($key != null) {
            return riake($key, $this->user_options);
        } else {
            return $this->user_options;
        }
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
        return 'fetch-error-from-auth';
    }

    /**
     * Checks if a master user exists
     *
     * @return: bool
    **/

    public function master_exists()
    {
        $masters = $this->aauth->list_users('master');
        if ($masters) {
            return true;
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

    public function create($email, $password, $username, $group_par, $user_status = '1')
    {
        $user_creation_status = $this->aauth->create_user($email, $password, $username);
        if (! $user_creation_status) {
            return false;
        }

        // bind user to a speciifc group
        $user_id = $this->aauth->get_user_id($email);
        // Send Verification
        $this->aauth->send_verification($user_id);

        // Adding to a group
        // refresh group
        $this->aauth->add_member($user_id, $group_par);

        // User Status
        if ($user_status == '0') {
            $user = $this->aauth->get_user($user_id);
            if( $user ) {
                $this->aauth->verify_user($user_id, $user->verification_code);
            }
        }

        // add custom user fields
        $custom_fields = $this->events->apply_filters('custom_user_meta', array());
        foreach (force_array($custom_fields) as $key => $value) {
            $this->aauth->set_user_var($key, $value, $user_id);
        }

        return 'user-created';
    }

    /***
     * Edit user
     *
     * @access: public
     * @param
    **/

    public function edit($user_id, $email, $password, $group_id, $user_group, $old_password = null, $mode = 'edit', $user_status = '0')
    {
        $return = 'user-updated';
        // old password has been defined
        if ($old_password != null && $mode == 'profile') 
        {
            // get user using old password
            $query = $this->db->where('id', $user_id)->where('pass', $this->aauth->hash_password($old_password, $user_id))->get('aauth_users');
            // if password is correct
            if ( ! empty(  $query->result_array() ) ) {
                $return = [ $this->aauth->update_user($user_id, $email, $password) ];
            } 
            else {
                return 'old-pass-incorrect';
            }

            if ( $password === $old_password ): 
                return 'pass-change-error';
            endif;
        }

        // This prevent editing privilege on profile dash
        if ($mode == 'edit') {
            // var_dump( $user_group );
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

        return $return;
    }

    /**
     * Delete specified user with his meta
     *
     * @access: public
     * @param : array
     * @return: bool
    **/

    public function delete($user_id)
    {
        // delete options
        $this->aauth->unset_user_var(null, $user_id);
        // remove front auth class
        return $this->aauth->delete_user($user_id);
    }

    /**
     * Creae Master User
     * @param string Email
     * @param string password
     * @param string user name
     * @return string
    **/

    public function create_master($email, $password, $username)
    {
        // Create user
        if ($this->aauth->create_user($email, $password, $username)) 
        {
            // Add user to a group
            // We assume 1 is the index of the first user
            $master_id = $this->aauth->get_user_id($email);

            // assign user to one of the admin group
            $this->aauth->add_member($master_id, 'master'); 
            
            // Send Verification
            $this->aauth->send_verification($master_id);
            
            // Activate Master
            $user = $this->aauth->get_user($master_id);
            $this->aauth->verify_user($master_id, $user->verification_code);
            
            return 'user-created';
        }
        return 'unexpected-error';
    }

    // Should be called by only
    /**
     * Create default Group
     *
     * @return void
    **/

    public function create_default_groups()
    {
        // Only create if group does'nt exists (it's optional)
        // Creating admin Group
        if (! $group = $this->aauth->get_group_id('master')) {
            $this->aauth->create_group('master', __('Master Group'));
        }

        // Creating admin Group
        if (! $group = $this->aauth->get_group_id('admin')) {
            $this->aauth->create_group('admin', __('Admin Group'));
        }

        // Create user
        if (! $group = $this->aauth->get_group_id('users')) {
            $this->aauth->create_group('user', __('User Group'));
        }
    }

    /**
     * Create default permission
     *
     * @return void
    **/

    public function create_permissions()
    {
        /**
         * Creating default permissions
        **/

        // Core Permission
        $this->aauth->create_perm('manage.core', __('Manage Core'));

        // Options Permissions
        $this->aauth->create_perm('create.options', __('Create Options'));
        $this->aauth->create_perm('edit.options', __('Edit Options'));
        $this->aauth->create_perm('read.options', __('Read Options'));
        $this->aauth->create_perm('delete.options', __('Delete Options'));

        // Addons Permissions
        $this->aauth->create_perm('install.addons', __('Install Addons'));
        $this->aauth->create_perm('update.addons', __('Update Addons'));
        $this->aauth->create_perm('delete.addons', __('Delete Addons'));
        $this->aauth->create_perm('toggle.addons', __('Enable/Disable Addons'));
        $this->aauth->create_perm('extract.addons', __('Extract Addons'));

        // Users Permissions
        $this->aauth->create_perm('create.users', __('Create Users'));
        $this->aauth->create_perm('edit.users', __('Edit Users'));
        $this->aauth->create_perm('delete.users', __('Delete Users'));

        // Profile Permission
        $this->aauth->create_perm('edit.profile', __('Create Options'));

        /**
         * Assign Permission to Groups
        **/

        // Master
        $this->aauth->allow_group('master', 'manage.core');

        $this->aauth->allow_group('master', 'create.options');
        $this->aauth->allow_group('master', 'edit.options');
        $this->aauth->allow_group('master', 'delete.options');
        $this->aauth->allow_group('master', 'read.options');

        $this->aauth->allow_group('master', 'install.addons');
        $this->aauth->allow_group('master', 'update.addons');
        $this->aauth->allow_group('master', 'delete.addons');
        $this->aauth->allow_group('master', 'toggle.addons');
        $this->aauth->allow_group('master', 'extract.addons');

        $this->aauth->allow_group('master', 'create.users');
        $this->aauth->allow_group('master', 'edit.users');
        $this->aauth->allow_group('master', 'delete.users');

        $this->aauth->allow_group('master', 'edit.profile');

        // Administrators
        $this->aauth->allow_group('admin', 'create.options');
        $this->aauth->allow_group('admin', 'edit.options');
        $this->aauth->allow_group('admin', 'delete.options');
        $this->aauth->allow_group('admin', 'read.options');

        $this->aauth->allow_group('admin', 'install.addons');
        $this->aauth->allow_group('admin', 'update.addons');
        $this->aauth->allow_group('admin', 'delete.addons');
        $this->aauth->allow_group('admin', 'toggle.addons');
        $this->aauth->allow_group('admin', 'extract.addons');

        $this->aauth->allow_group('admin', 'edit.profile');

        // Users
        $this->aauth->allow_group('user', 'edit.profile');
    }
}
