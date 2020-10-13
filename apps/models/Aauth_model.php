<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aauth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('aauth');
        $this->load->model('user_model');
        
        if (get_instance()->install_model->is_installed())  {
            $this->load->library('user');
        }

        // Instalation
        $this->events->add_action('settings_tables', array( $this, 'sql' ));
        $this->events->add_action('settings_tables', array( $this, 'settings_tables' ));
        $this->events->add_action('settings_final_config', array( $this, 'final_config' ));
        $this->events->add_action('settings_setup', array( $this, 'registration_rules' ));
        $this->events->add_action('registration_rules', array( $this, 'registration_rules' ));
        
        // action
        $this->events->add_action('app_init', array($this, 'check_login'));
        
        // Filter
        $this->events->add_filter('signin_logo', array( $this, 'signin_logo' ));
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_avatar_src', function () {
            return User::get_gravatar_url();
        });
    }

    /**
    * Count Users
    *
    * @return int
    **/
    public function count_users($include_banneds = false)
    {
        // banneds
        if (! $include_banneds) {
            $this->aauth->aauth_db->where('banned != ', 1);
        }
        return $this->aauth->aauth_db->count_all($this->aauth->config_vars[ 'users' ]);
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
        // skin is defined by default
        $class = ($db_skin = $this->user_model->get_meta('theme-skin')) ? $db_skin : $class; // weird ??? lol

        unset($db_skin);

        // get user sidebar status
        $sidebar = $this->user_model->get_meta('dashboard-sidebar');
        if ($sidebar == true) {
            $class .= ' ' . $sidebar;
        } 
        else {
            $class .= ' sidebar-expanded';
        }
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
        $name    =    $this->user_model->get_meta('first-name');
        $last    =    $this->user_model->get_meta('last-name');
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }
    
    public function registration_rules()
    {
        $this->form_validation->set_rules('username', __('User Name' ), 'required|min_length[5]');
        $this->form_validation->set_rules('email', __('Email' ), 'valid_email|required');
        $this->form_validation->set_rules('password', __('Password' ), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm' ), 'matches[password]');
    }

    /**
     * go login
     *
     * @return redirect route login
     */
    public function check_login()
    {
        if (in_array($this->uri->segment(1), $this->config->item('admin_route'))) 
        {
            if (! $this->aauth->is_loggedin() || ! $this->aauth->get_user()) {
                redirect($this->config->item('login_route') . '?notice=login-required&redirect=' . urlencode(current_url()) );
            }
        }
    }
    
    /**
     * Set groupes
     *
     * @return void
    **/
    
    public function settings_tables()
    {
        $this->user_model->create_default_groups();
        $this->user_model->create_permissions();
    }
    
    /**
     * Final config
    **/
    public function final_config()
    {
        // Creating Master & Groups
        $create_user = $this->user_model->create_master(
            $this->input->post('email'),
            $this->input->post('password'),
            $this->input->post('username')
        );
        
        if ($create_user != 'user-created') {
            $this->events->add_filter('validating_setup', array( $this, 'preparing_errors' ));
        }
    }
    
    public function preparing_errors()
    {
        if (is_array($this->aauth->errors)) {
            foreach ($this->aauth->errors as $error) {
                $this->notice->push_notice($error);
            }
        }
    }
    
    public function sql($config)
    {
        extract($config);

        // Creatin Auth Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_groups`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_groups` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100),
            `definition` text,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;");
        
        // Creating Auth Permission
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_perms`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_perms` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100),
            `definition` text,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Creating Permission to Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_perm_to_group`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_perm_to_group` (
            `perm_id` int(11) unsigned NOT NULL,
            `group_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`perm_id`,`group_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth Permission to User
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_perm_to_user`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_perm_to_user` (
            `perm_id` int(11) unsigned NOT NULL,
            `user_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`perm_id`,`user_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth PMS
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_pms`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_pms` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `sender_id` int(11) unsigned NOT NULL,
            `receiver_id` int(11) unsigned NOT NULL,
            `title` varchar(255) NOT NULL,
            `message` text,
            `date_sent` datetime DEFAULT NULL,
            `date_read` datetime DEFAULT NULL,
            `pm_deleted_sender` int(1) DEFAULT NULL,
            `pm_deleted_receiver` int(1) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth User Table
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_users`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_users` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `email` varchar(100) COLLATE utf8_general_ci NOT NULL,
            `pass` varchar(64) COLLATE utf8_general_ci NOT NULL,
            `username` varchar(100) COLLATE utf8_general_ci,
            `banned` tinyint(1) DEFAULT '0',
            `last_login` datetime DEFAULT NULL,
            `last_activity` datetime DEFAULT NULL,
            `date_created` datetime DEFAULT NULL,
            `forgot_exp` text COLLATE utf8_general_ci,
            `remember_time` datetime DEFAULT NULL,
            `remember_exp` text COLLATE utf8_general_ci,
            `verification_code` text COLLATE utf8_general_ci,
            `totp_secret` varchar(16) COLLATE utf8_general_ci DEFAULT NULL,
            `ip_address` text COLLATE utf8_general_ci,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
        
        // User Auth Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_user_to_group`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_user_to_group` (
            `user_id` int(11) unsigned NOT NULL,
            `group_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`user_id`,`group_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth User Variable
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_user_variables`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_user_variables` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) unsigned NOT NULL,
            `data_key` varchar(100) NOT NULL,
            `value` text,
            PRIMARY KEY (`id`),
            KEY `user_id_index` (`user_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth Group to Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_group_to_group`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_group_to_group` (
            `group_id` int(11) unsigned NOT NULL,
            `subgroup_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`group_id`,`subgroup_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth Attempts
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_login_attempts`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_login_attempts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `ip_address` varchar(39) DEFAULT '0',
            `timestamp` datetime DEFAULT NULL,
            `login_attempts` tinyint(2) DEFAULT '0',
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    }
}
