<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class Users_Filters extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter('load_user_profile', array( $this, 'load_user_profile' ));
        $this->events->add_filter('load_user_pass', array( $this, 'load_user_pass' ));
        $this->events->add_filter('load_users_advanced', array( $this, 'load_users_advanced' ));

        $this->events->add_filter('custom_user_meta', array( $this, 'custom_user_meta' ), 10, 1);
        $this->events->add_filter('apps_logo', array( $this, 'apps_logo' ), 5, 1);
        $this->events->add_filter('dashboard_skin_class', array( $this, 'dashboard_skin_class' ), 5, 1);
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_avatar_src', function () {
            return User::get_user_image_url(User::id());
        });
    }
    
    /**
    * Adds custom fields for user creation and edit
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    public function load_user_profile($config)
    {
        $json_vars = (! empty($config['user'])) ? $this->aauth->get_user_var( 'meta', $config['user']->id ) : null;
        $meta = ($json_vars) ? json_decode($json_vars) : null;
        
        $filed[] = array(
            'type' => 'text',
            'required'  => true,
            'cols' => array(
                [
                    'label'    => __('User Name', 'aauth'),
                    'name'     => 'username',
                    (! empty($config['user'])) ? 'disabled' : '' => true,
                    'value'    => (empty($config['user'])) 
                        ? set_value('username')
                        : set_value('username', $config['user']->username) 
                ],
                [
                    'label'    => __('User Email', 'aauth'),
                    'name'     => 'user_email',
                    (! empty($config['user'])) ? 'disabled' : '' => true,
                    'value'    => (empty($config['user'])) 
                        ? set_value('user_email')
                        : set_value('user_email', $config['user']->email) 
                ]
            )
        );
        $filed[] = array(
            'type' => 'text',
            'cols' => array(
                [
                    'name'  => 'firstname',
                    'label' => __('First Name', 'aauth'),
                    'value' => (empty($meta->firstname)) 
                        ? set_value('firstname') 
                        : set_value('firstname', $meta->firstname),
                ],
                [
                    'name'  => 'lastname',
                    'label' => __('Last Name', 'aauth'),
                    'value' => (empty($meta->lastname)) 
                        ? set_value('lastname') 
                        : set_value('lastname', $meta->lastname),
                ]
            )
        );
        
        if ($config['page'] != 'profile') :
            $groups_array = array();
            foreach ( force_array($config['groups']) as $group) {
                $groups_array[ $group->id ] = $group->definition != null ? $group->definition : $group->name;
            }
            $filed[] = array(
                'type' => 'select',
                'cols' => array(
                    [
                        'name'  => 'user_status',
                        'label' => __('User Status', 'aauth'),
                        'options' => array(
                            'default' => __( 'Default', 'aauth'),
                            '0'       => __( 'Active' , 'aauth'),
                            '1'       => __( 'Unactive' , 'aauth')
                        ),
                        'active' => (empty($config['user'])) 
                            ? ''
                            : $config['user']->banned 
                    ],
                    [
                        'label'   => __('Add to a group', 'aauth'),
                        'name'    => 'userprivilege',
                        'disabled' => ($groups_array) 
                            ? false 
                            : true,
                        'options' => $groups_array,
                        'active'  => (empty($config['user_group'])) 
                            ? null
                            : $config['user_group']->group_id 
                    ]
                )
            );
        endif;

        return $filed;
    }
    
    public function load_user_pass($config)
    {
        if ( $this->events->apply_filters('show_old_pass', true) && $config['page'] == 'profile' ) {
            $filed[] = array(
                'type'  => 'password',
                'label' => __('Old Password', 'aauth'),
                'name'  => 'old_pass',
            );
        }
        if ( ! empty($config['user']) && $config['page'] != 'profile' ) {
            $filed[] = array(
                'type'  => 'password',
                'label' => __('Old Password', 'aauth'),
                'name'  => 'old_pass',
            );
        }
        $filed[] = array(
            'type'  => 'password',
            'required'  => (! empty($config['user']) && $config['page'] != 'profile') ? false : true,
            'cols' => array(
                [
                    'label' => __('New Password', 'aauth'),
                    'name'  => 'password'
                ],
                [
                    'label' => __('Confirm New', 'aauth'),
                    'name'  => 'confirm'
                ]
            )
        );

        return $filed;
    }
    
    public function load_users_advanced($config)
    {
        $json_vars = (! empty($config['user'])) ? $this->aauth->get_user_var( 'meta', $config['user']->id ) : null;
        $meta = ($json_vars) ? json_decode($json_vars) : null;
        
        $filed[] = array(
            'type' => 'text',
            'name'  => 'phone',
            'label' => __('Phone'),
            'value' => (empty($meta->phone)) 
                ? set_value('phone') 
                : set_value('phone', $meta->phone),
        );
        $filed[] = array(
            'type' => 'textarea',
            'name'  => 'address',
            'label' => __('Address'),
            'value' => (empty($meta->address)) 
                ? set_value('address') 
                : set_value('address', $meta->address),
        );
        $filed[] = array(
            'type'  => 'input-image',
            'wrapper'  => 'user',
            'accept' => '.png, .jpg, .jpeg',
            'label' => __('user_image'),
            'name'  => 'user_image',
            'id'  => 'user_image',
            'value' => (empty($config['user'])) 
                ? ''
                : $config['user']->id
        );
        $filed[] = array(
            'type' => 'dom',
            'content' => $this->addon_view( 'users', 'profile/mode', compact( 'config' ), true )
        );

        return $filed;
    }
    
    /**
    * Adds custom meta for user
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function custom_user_meta($fields)
    {
        $item = array(
            'phone' => '',
            'address' => '',
            'firstname' => '',
            'lastname' => '',
            'theme-skin' => '',
        );
        foreach (force_array($item) as $k => $d) {
            // Perbarui data 
            if ( $this->input->post($k) !== null) {
                $fields[ $k ] = ($fname = $this->input->post($k)) ? $fname : '';
            }
        }
        return $fields;
    }

    public function apps_logo()
    {
        global $User_Options;
        if ($this->aauth->is_loggedin() && isset($User_Options['meta'])) 
        {
            if (riake('theme-skin', $User_Options['meta']) == null) {
                $logo = 'logo-dark.png';
            } 
            elseif (riake('theme-skin', $User_Options['meta']) == 'skin-light') {
                $logo = 'logo-dark.png';
            }
            else {
                $logo = 'logo-light.png';
            }
        } else {
            $logo = 'logo-dark.png';
        }
        return upload_url('system/'.$logo);
    }

    /**
     * Get dashboard sidebar for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_body_class()
    {
        global $User_Options;        
        // get user sidebar status
        $class = ($sidebar = riake('dashboard-sidebar', $User_Options)) ? $sidebar : 'aside-minimize';
        return $class;
    }

    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/
    public function dashboard_skin_class($class)
    {
        global $User_Options;
        $meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';
        // skin is defined by default
        $class = ($db_skin = riake('theme-skin', $meta)) ? $db_skin : 'skin-light';
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
        global $User_Options;
        $meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';
        $name = riake('firstname', $meta);
        $last = riake('lastname', $meta);
        $full = trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }
}
new Users_Filters;