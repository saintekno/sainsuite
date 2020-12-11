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
class Users_Install extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        $this->events->add_action('after_db_setup', [ $this, 'enable_addon' ] );
        $this->events->add_action('settings_tables', array( $this, 'settings_tables' ));
        $this->events->add_action('settings_final_config', array( $this, 'permissions' ));
        $this->events->add_action('settings_final_config', array( $this, 'final_config' ));
        $this->events->add_action('settings_setup', array( $this, 'registration_rules' ));
    }
    
    public function registration_rules()
    {
        $this->form_validation->set_rules('username', 'User Name', 'required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm', 'matches[password]');
    }

    public function enable_addon()
    {
        MY_Addon::enable('users');

        // Defaut options_model
        $this->options_model->set('users_installed', true, 'users');
    }
    
    public function settings_tables($config)
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
            `user_id` VARCHAR(100) NOT NULL,
            PRIMARY KEY (`perm_id`,`user_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth PMS
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_pms`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_pms` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `sender_id` VARCHAR(100) NOT NULL,
            `receiver_id` VARCHAR(100) NOT NULL,
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
            `id` VARCHAR(100) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `pass` VARCHAR(64) NOT NULL,
            `username` VARCHAR(100) NULL DEFAULT NULL,
            `banned` TINYINT(1) NULL DEFAULT '0',
            `last_login` DATETIME NULL DEFAULT NULL,
            `last_activity` DATETIME NULL DEFAULT NULL,
            `date_created` DATETIME NULL DEFAULT NULL,
            `forgot_exp` TEXT NULL,
            `remember_time` DATETIME NULL DEFAULT NULL,
            `remember_exp` TEXT NULL,
            `verification_code` TEXT NULL,
            `totp_secret` VARCHAR(16) NULL DEFAULT NULL,
            `ip_address` TEXT NULL,
            PRIMARY KEY (`id`)
          ) COLLATE='utf8_general_ci' ENGINE=InnoDB ; ");
        
        // User Auth Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_user_to_group`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_user_to_group` (
            `user_id` VARCHAR(100) NOT NULL,
            `group_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`user_id`,`group_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
        // Auth User Variable
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_user_variables`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_user_variables` (
            `user_id` VARCHAR(100) NOT NULL,
            `data_key` VARCHAR(100) NOT NULL,
            `value` TEXT NULL,
            INDEX `user_id_index` (`user_id`)
          ) COLLATE='utf8_general_ci' ENGINE=InnoDB ;");
        
        // Auth Group to Group
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}aauth_group_to_group`;");
        $this->db->query("CREATE TABLE `{$database_prefix}aauth_group_to_group` (
            `group_id` int(11) unsigned NOT NULL,
            `user_id` varchar(100) NOT NULL,
            `subgroup_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`group_id`,`user_id`,`subgroup_id`)
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
    public function permissions()
    {
        // Only create if group does'nt exists (it's optional)
        // Creating admin Group
        $this->aauth->create_group('admin', 'Admin Group');
        $this->aauth->create_group('member', 'member Group');
        $this->aauth->create_group('user', 'User Group');

        /**
         * Creating default permissions
        **/
        // Core Permission
        $this->aauth->create_perm('manage.core', 'Manage Core');
        $this->aauth->create_perm('manage.setting', 'Manage Setting');

        // Options Permissions
        $this->aauth->create_perm('create.options', 'Create Options');
        $this->aauth->create_perm('edit.options', 'Edit Options');
        $this->aauth->create_perm('read.options', 'Read Options');

        // Addons Permissions
        $this->aauth->create_perm('read.addons', 'Read Addons');
        $this->aauth->create_perm('create.addons', 'Create Addons');
        $this->aauth->create_perm('install.addons', 'Install Addons');
        $this->aauth->create_perm('update.addons', 'Update Addons');
        $this->aauth->create_perm('delete.addons', 'Delete Addons');
        $this->aauth->create_perm('toggle.addons', 'Enable/Disable Addons');
        $this->aauth->create_perm('extract.addons', 'Extract Addons');

        // Themes Permissions
        $this->aauth->create_perm('read.themes', 'Read themes');
        $this->aauth->create_perm('install.themes', 'Install themes');
        $this->aauth->create_perm('delete.themes', 'Delete themes');
        $this->aauth->create_perm('toggle.themes', 'Enable/Disable themes');
        $this->aauth->create_perm('extract.themes', 'Extract themes');

        // Users Permissions
        $this->aauth->create_perm('read.users', 'Read Users');
        $this->aauth->create_perm('create.users', 'Create Users');
        $this->aauth->create_perm('edit.users', 'Edit Users');
        $this->aauth->create_perm('delete.users', 'Delete Users');

        // Group Permissions
        $this->aauth->create_perm('read.group', 'Read Group');
        $this->aauth->create_perm('create.group', 'Create Group');
        $this->aauth->create_perm('edit.group', 'Edit Group');
        $this->aauth->create_perm('delete.group', 'Delete Group');

        // Profile Permission
        $this->aauth->create_perm('edit.profile', 'Create Options');

        /**
         * Assign Permission to Groups
        **/
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

        $this->aauth->allow_group('member', 'read.themes');
        $this->aauth->allow_group('member', 'install.themes');
        $this->aauth->allow_group('member', 'delete.themes');
        $this->aauth->allow_group('member', 'toggle.themes');
        $this->aauth->allow_group('member', 'extract.themes');

        $this->aauth->allow_group('member', 'read.users');
        $this->aauth->allow_group('member', 'create.users');
        
        $this->aauth->allow_group('member', 'edit.profile');

        $this->aauth->allow_group('member', 'manage.menu');

        // Users
        $this->aauth->allow_group('user', 'edit.profile');
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
        
        if ($create_user != 'created') {
            $this->events->add_filter('validating_setup', $this->notice->push_notice_array($this->aauth->get_errors_array()));
        }
    }
}
new Users_Install;