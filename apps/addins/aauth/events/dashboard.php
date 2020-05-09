<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aauth_dashboard extends CI_model
{
    public function __construct()
    {
        $this->events->add_filter('admin_menus', array( $this, 'menu' ), 25 );
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        // Change user name in the user menu
        $this->events->add_filter('before_dashboard_menu', array( $this, 'before_dashboard_menu' ));
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_header', array( $this, 'user_menu_header' ));
        $this->events->add_filter('Do_object_user_id', array( $this, 'user_id' ));
        $this->events->add_filter('user_header_profile_link', array( $this, 'user_profile_link' ));
    }
    public function user_profile_link($link)
    {
        return site_url(array( 'dashboard', 'users', 'profile' ));
    }
    public function user_id($user_id)
    {
        if ($user_id == 'false') {
            return User::id();
        }
    }
    public function before_dashboard_menu()
    {
        if (cek_online()) {
            $avatar = User::get_gravatar_url();
        } else {
            $avatar = img_url() . 'user1.jpg';
        }
        ob_start();
        ?>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$avatar?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->events->apply_filters('user_menu_name', $this->config->item('default_user_names')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function menu($menus)
    {
        $menus[ 'users' ] = array(
            array(
                'title'   => __('Users', 'aauth'),
                'icon'    => 'fa fa-users',
                'href'    => site_url('dashboard/users'),
                'disable' => true
            )
        );

        /**
         * Checks whether a user can manage user
        **/
        if (
            User::can('create_users') ||
            User::can('edit_users') ||
            User::can('delete_users')
        ) {
            $menus[ 'users' ] = array(
                array(
                    'icon'    => 'fa fa-users',
                    'title'   => __('Users', 'aauth'),
                    'disable' => true
                )
            );
            $menus[ 'users' ][] = array(
                'title' => __('Users List', 'aauth'),
                'href'  => site_url('dashboard/users'),
            );
            $menus[ 'users' ][] = array(
                'title' => __('Create a new User', 'aauth'),
                'href'  => site_url('dashboard/users/create')
            );

            $menus[ 'roles' ] = array(
                array(
                    'title' => __('Groups', 'aauth'),
                    'icon'  => 'fa fa-shield',
                    'href'  => site_url('dashboard/groups')
                )
            );
        }

        $menus[ 'users' ][] = array(
            'title' => __('My profile', 'aauth'),
            'href'  => site_url('dashboard/users/profile')
        );

        return $menus;
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
        $name    =    $this->users->get_meta('first-name');
        $last    =    $this->users->get_meta('last-name');
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }

    /**
     * Perform Change over Auth emails config
     *
     * @access : public
     * @param : string user names
     * @return : string
    **/

    public function user_menu_header($user_name)
    {
        $name    =    $this->users->get_meta('first-name');
        $last    =    $this->users->get_meta('last-name');
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
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
        $class = ($db_skin = $this->users->get_meta('theme-skin')) ? $db_skin : $class; // weird ??? lol

        unset($db_skin);

        // get user sidebar status
        $sidebar = $this->users->get_meta('dashboard-sidebar');
        if ($sidebar == true) {
            $class .= ' ' . $sidebar;
        } else {
            $class .= ' sidebar-collapse';
        }
        return $class;
    }
}
new aauth_dashboard;
