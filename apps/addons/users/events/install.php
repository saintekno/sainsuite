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
class Users_Install extends CI_model
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        $this->events->add_action('after_db_setup', [ $this, 'enable' ] );
        $this->events->add_action('settings_tables', array( $this, 'sql' ));
        $this->events->add_action('settings_tables', array( $this, 'settings_tables' ));
        $this->events->add_action('settings_final_config', array( $this, 'final_config' ));
        $this->events->add_action('settings_setup', array( $this, 'registration_rules' ));
    }
    
    public function registration_rules()
    {
        $this->form_validation->set_rules('username', __('User Name' ), 'required|min_length[5]');
        $this->form_validation->set_rules('email', __('Email' ), 'valid_email|required');
        $this->form_validation->set_rules('password', __('Password' ), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm' ), 'matches[password]');
    }

    public function enable()
    {
        Addons::enable('users');

        // Defaut options_model
        $this->options_model->set('users_installed', true, 'users');
    }

    /**
     * Final Config
     *
     * @return void
    **/
    public function final_config()
    {
        // Creating Master & Groups
        $create_user = $this->user_model->create_admin(
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
    
    /**
     * Set groupes
     *
     * @return void
    **/
    public function settings_tables()
    {
        // Only create if group does'nt exists (it's optional)
        // Creating admin Group
        $this->aauth->create_group('admin', __('Admin Group'));
        $this->aauth->create_group('member', __('member Group'));
        $this->aauth->create_group('user', __('User Group'));

        /**
         * Creating default permissions
        **/
        // Core Permission
        $this->aauth->create_perm('manage.core', __('Manage Core'));

        // Options Permissions
        $this->aauth->create_perm('create.options', __('Create Options'));
        $this->aauth->create_perm('edit.options', __('Edit Options'));
        $this->aauth->create_perm('read.options', __('Read Options'));

        // Addons Permissions
        $this->aauth->create_perm('read.addons', __('Read Addons'));
        $this->aauth->create_perm('install.addons', __('Install Addons'));
        $this->aauth->create_perm('update.addons', __('Update Addons'));
        $this->aauth->create_perm('delete.addons', __('Delete Addons'));
        $this->aauth->create_perm('toggle.addons', __('Enable/Disable Addons'));
        $this->aauth->create_perm('extract.addons', __('Extract Addons'));

        // Users Permissions
        $this->aauth->create_perm('read.users', __('Read Users'));
        $this->aauth->create_perm('create.users', __('Create Users'));
        $this->aauth->create_perm('edit.users', __('Edit Users'));
        $this->aauth->create_perm('delete.users', __('Delete Users'));

        // Profile Permission
        $this->aauth->create_perm('edit.profile', __('Create Options'));

        /**
         * Assign Permission to Groups
        **/
        // Administrators
        $this->aauth->allow_group('admin', 'manage.core');

        // Member
        $this->aauth->allow_group('member', 'create.options');
        $this->aauth->allow_group('member', 'edit.options');
        $this->aauth->allow_group('member', 'read.options');

        $this->aauth->allow_group('member', 'read.addons');
        $this->aauth->allow_group('member', 'install.addons');
        $this->aauth->allow_group('member', 'update.addons');
        $this->aauth->allow_group('member', 'delete.addons');
        $this->aauth->allow_group('member', 'toggle.addons');
        $this->aauth->allow_group('member', 'extract.addons');

        $this->aauth->allow_group('member', 'read.users');
        $this->aauth->allow_group('member', 'edit.profile');

        // Users
        $this->aauth->allow_group('user', 'edit.profile');
    }
}
new Users_Install;