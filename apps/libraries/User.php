<?php
/**
 * An easy way to access Auth and User_model methods
**/
class User
{
    private static $groups_permissions;

    public function __construct()
    {
        $groups = get_instance()->aauth->list_groups();
        foreach (force_array($groups) as $group) 
        {
            $permissions = get_instance()->aauth->list_group_perms($group->id);
            foreach (force_array($permissions) as $permission) {
                self::$groups_permissions[ $group->name ][] = $permission->name;
            }
        }
    }

    /**
     * Checks whether a user is connected
     * @access public
     * @return bool
    **/

    public static function is_connected()
    {
        return get_instance()->aauth->is_loggedin();
    }

    public static function get($user_par = false)
    {
        return get_instance()->aauth->get_user($user_par);
    }

    /**
     * Pseudo
     * retreive user pseudo
     *
     * @access public
     * @param int (optional)
     * @return string
    **/

    public static function pseudo($id = false)
    {
        $user = get_instance()->aauth->get_user($id);
        return $user ? $user->username: __('N/A');
    }

    /**
     * Id
     * return current user id
     *
     * @access public
     * @return int
    **/

    public static function id()
    {
        $user = get_instance()->aauth->get_user();
        return $user ? $user->id: 0;
    }

    // Permission

    /**
     * Checks whether a user is granted for a permission
     * @access public
     * @return boolean
    **/

    public static function can($permission)
    {
        $group = get_instance()->aauth->get_user_groups();

        if ( in_array( $permission, self::$groups_permissions[ $group[0]->name ])) {
            return true;
        }
        return false;
    }

    public static function canDo()
    {
        $group = get_instance()->aauth->get_user_groups();
        return self::$groups_permissions[ $group[0]->name ];
    }

    /**
     * determine if the current logged 
     * users can access to some permissions
     * @param array string of permissions
     * @return boolean;
     */
    public static function canSome( $permission )
    {
        $group = get_instance()->aauth->get_user_groups();
        
        if( is_array( $permission ) ) {
            return 
            count( 
                array_intersect( 
                    $permission, self::$groups_permissions[ $group[0]->name ]
                ) 
            ) > 0 ;
        }
        return false;
    }

    /**
     * User cannot 
     * @alias User::can
     */

    public static function cannot($permission)
    {
        return ! self::can( $permission );
    }

    /**
     * Create User Permission
     *
     * @param string permission
     * @param string definition
     * @return bool
    **/

    public static function create_permission($permission, $definition, $is_admin = false, $description = '')
    {
        return get_instance()->aauth->create_perm($permission, $definition, $is_admin, $description);
    }

    /**
     * Delete User Permission
     *
     * @param int user id,
     * @return bool
    **/

    public static function delete_permission($permission)
    {
        return get_instance()->aauth->delete_perm($permission);
    }

    /**
     * Update User Permission
     *
     * @param int user id,
     * @param string name
     * @param string definition
     * @return bool
    **/

    public static function update_permission($perm_id, $name, $definition = '', $is_admin = false, $description = '')
    {
        return get_instance()->aauth->update_perm($perm_id, $name, $definition, $is_admin, $description);
    }

    /**
     * In Group
     *
     * Check whether a user belong to a specific group
     *
     * @access public
     * @param string
     * @return bool
    **/

    public static function in_group($group_name)
    {
        return get_instance()->aauth->is_member($group_name);
    }

    /**
     * Get user avatar SRC
     * @return string
    **/

    public static function get_gravatar_url()
    {
        $current_user = self::get();
        return self::get_gravatar($current_user->email, 90);
    }

    /**
     * Get use avatar
     * @param string email
     * @param int width
     * @param string
     * @param string
     * @param bool
     * @param array atts
     * @return string avatar src/image tag
    **/

    public static function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http") . '://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";

        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
