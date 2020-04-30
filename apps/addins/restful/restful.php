<?php
class Restful extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action('Do_settings_tables', array( $this, 'sql' ));
        $this->events->add_action( 'Do_settings_final_config', [ $this, 'final_config' ] );
        $this->events->add_action('do_enable_module', array( $this, 'enable' ));
        $this->events->add_action('do_remove_module', array( $this, 'remove' ));
    }

    /**
     * Enable
    **/

    public function enable($module)
    {
        global $Options;
        if ($module == 'restful' && @$Options[ 'restful_installed' ] == null) {
            $this->sql();
            $this->options->set('restful_installed', true, true);
        }
    }

    public function remove($module)
    {
        if ($module == 'restful') {
            $this->db->query('DROP TABLE IF EXISTS `'.$this->db->dbprefix.'restapi_keys`;');
            $this->options->delete('restful_installed');
        }
    }

    /**
     * Keys table
    **/

    public function sql()
    {
        global $CurrentScreen;
        if ($CurrentScreen != 'dashboard') {
            // Enable Me
            Modules::enable('restful');
        }
        $this->db->query('
			CREATE TABLE IF NOT EXISTS `' . $this->db->dbprefix . 'restapi_keys` (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`key` VARCHAR(40) NOT NULL,
			`scopes` text,
			`app_name` VARCHAR(40) NOT NULL,
			`level` INT(2) NOT NULL,
			`ignore_limits` TINYINT(1) NOT NULL DEFAULT "0",
			`user` INT(11) NOT NULL,
			`date_created` DATETIME NOT NULL,
			`expire` datetime NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->load->addin_library( 'oauth', 'oauthLibrary' );
        $randomString        =    $this->oauthlibrary->generateKey();
        // Save Core Key
        $this->options->set('rest_key', $randomString, true);
    }

    public function final_config()
    {
        $this->db->insert('restapi_keys', array(
            'key'          =>    get_option( 'rest_key' ),
            'scopes'       =>    'core',
            'app_name'     =>    __('Eracik'),
            'user'         =>    0,
            'date_created' =>    date_now(),
            'expire'       =>    0
        ));
    }
}

new Restful;
