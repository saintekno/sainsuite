<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Install tables:
 *	Permissions
 *  Role permissions
 *	Roles
 */

class Migration_Add_Permissions extends Migration
{
	/****************************************************************
	 * Table Names
	 */
	/**
	 * @var string The name of the Permissions table
	 */
	private $permissions_table = 'permissions';

	/**
	 * @var string The name of the Role Permissions table
	 */
    private $role_permissions_table = 'role_permissions';

	/**
	 * @var string The name of the Roles table
	 */
	private $roles_table = 'roles';

	/****************************************************************
	 * Field Definitions
	 */
	/**
	 * @var array Fields for the Permissions table
	 */
	private $permission_fields = array(
        'permission_id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => true,
            'null' => false,
        ),
        'name' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => false,
        ),
        'description' => array(
            'type' =>'VARCHAR',
            'constraint' => 100,
            'null' => false,
        ),
        'status' => array(
            'type' => "ENUM('active','inactive','deleted')",
            'default' => 'active',
            'null' => false,
        ),
	);

    /**
     * @var array Fields for the role_permissions table
     */
    private $role_permissions_fields = array(
        'role_id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ),
        'permission_id' => array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => false,
        ),
    );

	/**
	 * @var array Fields for the roles table
	 */
	private $roles_fields = array(
		'role_id' => array(
			'type' => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
            'null' => false,
		),
		'role_name' => array(
			'type' => 'VARCHAR',
			'constraint' => 60,
            'null' => false,
		),
		'description' => array(
			'type' => 'VARCHAR',
			'constraint' => 255,
			'null' => true,
		),
		'default' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => 0,
            'null' => false,
		),
		'can_delete' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => 1,
            'null' => false,
		),
		'login_destination'	=> array(
			'type'			=> 'VARCHAR',
			'constraint'	=> 255,
			'default'		=> '',
			'null'			=> false,
		),
		'deleted'	=> array(
			'type'			=> 'INT',
			'constraint'	=> 1,
			'default'		=> 0,
			'null'			=> false,
		),
    );

	/****************************************************************
	 * Data to Insert
	 */
	/**
	 * @var array Default Permissions
	 */
	private $permissions_data = array(
		array(
			'name' => 'Site.Signin.Offline',
			'description' => 'Allow users to login to the site when the site is offline',
		),
		array(
			'name' => 'Site.Content.View',
			'description' => 'Allow users to view the Content Context',
		),
		array(
			'name' => 'Site.Reports.View',
			'description' => 'Allow users to view the Reports Context',
		),
		array(
			'name' => 'Site.Settings.View',
			'description' => 'Allow users to view the Settings Context',
		),
		array(
			'name' => 'Site.Developer.View',
			'description' => 'Allow users to view the Developer Context',
		),
		array(
			'name' => 'Racik.Roles.Manage',
			'description' => 'Allow users to manage the user Roles',
		),
		array(
			'name' => 'Racik.Roles.Delete',
			'description' => 'Allow users to delete user Roles',
		),
		array(
			'name' => 'Racik.Users.Manage',
			'description' => 'Allow users to manage the site Users',
		),
		array(
			'name' => 'Racik.Users.View',
			'description' => 'Allow users access to the User Settings',
		),
		array(
			'name' => 'Racik.Users.Add',
			'description' => 'Allow users to add new Users',
		),
		array(
			'name' => 'Racik.Database.Manage',
			'description' => 'Allow users to manage the Database settings',
		),
		array(
			'name' => 'Racik.Emailer.View',
			'description' => 'Allow users access to the Emailer settings',
		),
		array(
			'name' => 'Racik.Emailer.Manage',
			'description' => 'Allow users to manage the Emailer settings',
		),
		array(
			'name' => 'Racik.Logs.View',
			'description' => 'Allow users access to the Log details',
		),
		array(
			'name' => 'Racik.Logs.Manage',
			'description' => 'Allow users to manage the Log files',
		),
		array(
			'name' => 'Racik.Roles.Add',
			'description' => 'To add New Roles',
		),
		array(
			'name' => 'Racik.Activities.View',
			'description' => 'To view the Activities menu.',
		),
		array(
			'name' => 'Racik.Database.View',
			'description' => 'To view the Database menu.',
		),
		array(
			'name' => 'Racik.Migrations.View',
			'description' => 'To view the Migrations menu.',
		),
		array(
			'name' => 'Racik.Builder.View',
			'description' => 'To view the Builder menu.',
		),
		array(
			'name' => 'Racik.Roles.View',
			'description' => 'To view the Roles menu.',
		),
		array(
			'name' => 'Racik.Sysinfo.View',
			'description' => 'To view the System Information page.',
		),
		array(
			'name' => 'Racik.Translate.Manage',
			'description' => 'To manage the Language Translation.',
		),
		array(
			'name' => 'Racik.Translate.View',
			'description' => 'To view the Language Translate menu.',
		),
		array(
			'name' => 'Racik.Display.View',
			'description' => 'To view the UI/Keyboard Shortcut menu.',
		),
		array(
			'name' => 'Racik.Display.Manage',
			'description' => 'Manage the Racik UI settings.',
		),
		array(
			'name' => 'Racik.Permissions.View',
			'description' => 'Allow access to view the Permissions menu unders Settings Context.',
		),
		array(
			'name' => 'Racik.Permissions.Manage',
			'description' => 'Allow access to manage the Permissions in the system.',
		),
	);

	/**
	 * @var array Default Roles
	 */
	private $roles_data = array(
		array(
			'role_name' => 'Administrator',
			'description' => 'Has full control over every aspect of the site.',
			'default' => 0,
			'can_delete' => 0,
		),
		array(
			'role_name' => 'Editor',
			'description' => 'Can handle day-to-day management, but does not have full power.',
			'default' => 0,
			'can_delete' => 1,
		),
		array(
			'role_name' => 'User',
			'description' => 'This is the default user with access to login.',
			'default' => 1,
			'can_delete' => 0,
		),
		array(
			'role_name' => 'Developer',
			'description' => 'Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',
			'default' => 0,
			'can_delete' => 1,
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
		// Permissions
        if ( ! $this->db->table_exists($this->permissions_table))
        {
            $this->dbforge->add_field($this->permission_fields);
            $this->dbforge->add_key('permission_id', true);
            $this->dbforge->create_table($this->permissions_table);
            $this->db->insert_batch($this->permissions_table, $this->permissions_data);
        }

		// Role Permissions
        if ( ! $this->db->table_exists($this->role_permissions_table))
        {
            $this->dbforge->add_field($this->role_permissions_fields);
			$this->dbforge->add_key('role_id', true);
			$this->dbforge->add_key('permission_id', true);
			$this->dbforge->create_table($this->role_permissions_table);
			
			// Add administrators to module permissions.
			$assign_role = array('1');
			if (class_exists('CI_Session', false)) {
				if ($this->session->userdata('role_id')) {
					$assign_role[] = $this->session->userdata('role_id');
				}
			}
	
			$permission_names = array();
			foreach ($this->permissions_data as $permission) {
				$permission_names[] = $permission['name'];
			}

			$permissions = $this->db->select('permission_id')
									->where_in('name', $permission_names)
									->get($this->permissions_table)
									->result();
	
			if (! empty($permissions) && is_array($permissions)) {
				$permissions_data = array();
				foreach ($permissions as $perm) {
					foreach ($assign_role as $roleId) {
						$permissions_data[] = array(
							'role_id'       => $roleId,
							'permission_id' => $perm->permission_id,
						);
					}
				}
	
				if (! empty($permissions_data)) {
					$this->db->insert_batch($this->role_permissions_table, $permissions_data);
				}
			}
        }

		// Roles
        if ( ! $this->db->table_exists($this->roles_table))
        {
            $this->dbforge->add_field($this->roles_fields);
            $this->dbforge->add_key('role_id', true);
            $this->dbforge->create_table($this->roles_table);

            $this->db->insert_batch($this->roles_table, $this->roles_data);
            $this->db->where('role_id', 5)->delete($this->roles_table);
        }
	}

	/**
	 * Uninstall this migration
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->permissions_table);
        $this->dbforge->drop_table($this->role_permissions_table);
		$this->dbforge->drop_table($this->roles_table);
	}
}