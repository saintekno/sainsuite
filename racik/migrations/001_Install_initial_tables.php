<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Install the initial tables:
 *	Email Queue
 *	Login Attempts
 *	Users
 *  user_meta
 *	User Cookies
 */
class Migration_Install_initial_tables extends Migration
{
	/****************************************************************
	 * Table Names
	 */
	/**
	 * @var string The name of the Email Queue table
	 */
	private $email_table = 'email_queue';

	/**
	 * @var string The name of the Login Attempts table
	 */
	private $login_table = 'login_attempts';

    /**
     * @var string Name of the Activities table
     */
    private $activities_table = 'activities';

	/**
	 * @var string The name of the Users table
	 */
	private $users_table = 'users';

	/**
	 * @var string The name of the users meta table
	 */
	private $meta_table = 'user_meta';

	/**
	 * @var string The name of the User Cookies table
	 */
	private $cookies_table = 'user_cookies';

	/****************************************************************
	 * Field Definitions
	 */
	/**
	 * @var array Fields for the Email table
	 */
	private $email_fields = array(
		'id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
            'null' => false,
		),
		'to_email' => array(
			'type' => 'VARCHAR',
			'constraint' => 254,
            'null' => false,
		),
		'subject' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
            'null' => false,
		),
		'message' => array(
			'type' => 'TEXT',
            'null' => false,
		),
		'alt_message' => array(
			'type' => 'TEXT',
			'null' => true,
		),
		'max_attempts' => array(
			'type' => 'INT',
			'constraint' => 11,
			'default' => 3,
            'null' => false,
		),
		'attempts' => array(
			'type' => 'INT',
			'constraint' => 11,
			'default' => 0,
            'null' => false,
		),
		'success' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => 0,
            'null' => false,
		),
		'date_published' => array(
			'type' => 'DATETIME',
			'null' => true,
		),
		'last_attempt' => array(
			'type' => 'DATETIME',
			'null' => true,
		),
		'date_sent' => array(
			'type' => 'DATETIME',
			'null' => true,
		),
		'csv_attachment' => array(
			'type' => 'TEXT',
			'null' => TRUE
		),
	);

	/**
	 * @var array Fields for the Login table
	 */
	private $login_fields = array(
		'id' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
			'auto_increment' => true,
            'null' => false,
		),
		'ip_address' => array(
			'type' => 'VARCHAR',
			'constraint' => 45,
            'null' => false,
		),
		'login' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
            'null' => false,
		),
        /* This will probably cause an error outside MySQL and may not
         * be cross-database compatible for reasons other than
         * CURRENT_TIMESTAMP
         */
		'time TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	);

	/**
	 * @var array Fields for the Activities table
	 */
	private $activities_fields = array(
		'activity_id' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
			'auto_increment' => true,
            'null' => false,
		),
		'user_id' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
            'unsigned'   => true,
			'default' => 0,
            'null' => false,
		),
		'activity' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
            'null' => false,
		),
		'module' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
            'null' => false,
		),
		'created_on' => array(
			'type' => 'DATETIME',
            'null' => false,
		),
        'deleted' => array(
            'type' => 'TINYINT',
            'constraint' => 12,
            'default' => 0,
            'null' => false,
        ),
	);

	/**
	 * @var array Fields for the users table
	 */
	private $users_fields = array(
		'id' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
			'unsigned' => true,
			'auto_increment' => true,
            'null' => false,
		),
		'role_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'default' => 4,
            'null' => false,
		),
		'first_name' => array(
			'type' => 'VARCHAR',
			'constraint' => 20,
			'null' => true,
		),
		'last_name' => array(
			'type' => 'VARCHAR',
			'constraint' => 20,
			'null' => true,
		),
		'email' => array(
			'type' => 'VARCHAR',
			'constraint' => 254,
            'null' => false,
		),
		'username' => array(
			'type' => 'VARCHAR',
			'constraint' => 30,
			'default' => '',
            'null' => false,
		),
		'password_hash' => array(
			'type' => 'VARCHAR',
			'constraint' => 40,
            'null' => false,
		),
		'reset_hash' => array(
			'type' => 'VARCHAR',
			'constraint' => 40,
			'null' => true,
		),
		'reset_by' => array(
			'type' => 'INT',
			'constraint' => 10,
			'null' => true,
		),
		'salt' => array(
			'type' => 'VARCHAR',
			'constraint' => 7,
            'null' => false,
		),
		'last_login' => array(
			'type' => 'DATETIME',
			'default' => '0000-00-00 00:00:00',
            'null' => false,
		),
		'last_ip' => array(
			'type' => 'VARCHAR',
			'constraint' => 45,
			'default' => '',
            'null' => false,
		),
		'created_on' => array(
			'type' => 'DATETIME',
			'default' => '0000-00-00 00:00:00',
            'null' => false,
		),
		'street_1' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => true,
		),
		'street_2' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => true,
		),
		'city' => array(
			'type' => 'VARCHAR',
			'constraint' => 40,
			'null' => true,
		),
		'country_iso' => array(
			'type' => 'CHAR',
			'constraint' => 2,
			'default' => 'US',
            'null' => false,
		),
		'state_code' => array(
			'type'			=> 'CHAR',
			'constraint'	=> 4,
			'default'		=> NULL,
			'null'			=> true,
		),
		'zipcode' => array(
			'type' => 'VARCHAR',
			'constraint' => 20,
			'null' => true,
		),
		'deleted' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => 0,
            'null' => false,
		),
		'banned' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => 0,
			'null' => false,
		),
		'ban_message' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => true,
		),
		'display_name'	=> array(
			'type'			=> 'varchar',
			'constraint'	=> 255,
			'default'		=> '',
			'null'			=> true,
		),
		'display_name_changed'	=> array(
			'type'			=> 'date',
			'null'			=> true,
		),
		'timezone' => array(
			'type'			=> 'varchar',
			'constraint'	=> 40,
			'default'		=> 'Asia/Jakarta',
			'null'			=> false,
		),
		'language' => array(
			'type'			=> 'varchar',
			'constraint'	=> 20,
			'default'		=> 'english',
			'null'			=> false,
		),
	);

	/**
	 * @var array The fields for the Meta table
	 */
	private $meta_fields = array(
		'meta_id'	=> array(
			'type'				=> 'INT',
			'constraint'		=> 20,
			'unsigned'			=> true,
			'auto_increment'	=> true,
			'null'				=> false,
		),
		'user_id'	=> array(
			'type'				=> 'bigint',
			'constraint'		=> 20,
			'unsigned'			=> true,
			'default'			=> 0,
			'null'				=> false,
		),
		'meta_key'	=> array(
			'type'				=> 'varchar',
			'constraint'		=> 255,
			'default'			=> '',
			'null'				=> false,
		),
		'meta_value' => array(
			'type'				=> 'text',
			'null'				=> true,
		)
	);

	/**
	 * @var array Fields for the Cookies table
	 */
	private $cookies_fields = array(
		'user_id' => array(
			'type' => 'BIGINT',
			'constraint' => 20,
			'unsigned'   => true,
            'null' => false,
		),
		'token' => array(
			'type' => 'VARCHAR',
			'constraint' => 128,
            'null' => false,
		),
		'created_on' => array(
			'type' => 'DATETIME',
            'null' => false,
		),
	);

	/****************************************************************
	 * Migration methods
	 */
	/**
	 * Install this migration
	 */
	public function up()
	{
		// Email Queue
        if ( ! $this->db->table_exists($this->email_table))
        {
            $this->dbforge->add_field($this->email_fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table($this->email_table);
        }

		// Login Attempts
        if ( ! $this->db->table_exists($this->login_table))
        {
            $this->dbforge->add_field($this->login_fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table($this->login_table);
        }
		
		// Activity Table
		if ( ! $this->db->table_exists($this->activities_table))
		{
			$this->dbforge->add_field($this->activities_fields);
			$this->dbforge->add_key('activity_id', true);
			$this->dbforge->create_table($this->activities_table);
		}

		// Users
        if ( ! $this->db->table_exists($this->users_table))
        {
            $this->dbforge->add_field($this->users_fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->add_key('email');
            $this->dbforge->create_table($this->users_table);
		}
		
		// User Meta
		if ( ! $this->db->table_exists($this->meta_table))
		{
			$this->dbforge->add_field($this->meta_fields);
			$this->dbforge->add_key('meta_id', TRUE);
			$this->dbforge->create_table($this->meta_table);
		}

		// User Cookies
        if ( ! $this->db->table_exists($this->cookies_table))
        {
            $this->dbforge->add_field($this->cookies_fields);
            $this->dbforge->add_key('token');
            $this->dbforge->create_table($this->cookies_table);
        }
	}

	/**
	 * Uninstall this migration
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->email_table);
		$this->dbforge->drop_table($this->login_table);
		$this->dbforge->drop_table($this->activities_table);
		$this->dbforge->drop_table($this->users_table);
		$this->dbforge->drop_table($this->meta_table);
		$this->dbforge->drop_table($this->cookies_table);
	}
}