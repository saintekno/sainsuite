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

        $this->events->add_filter('apps_logo', array( $this, 'apps_logo' ), 1, 1);
        $this->events->add_filter('apps_description', array( $this, 'apps_description' ), 5, 1);
        $this->events->add_filter('custom_user_vars', array( $this, 'custom_user_vars' ), 10, 1);
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
            [
                'label'    => __('User Name', 'aauth'),
                'class' => 'col-12 col-lg-6 col-md-6',
                'type' => 'text',
                'required'  => true,
                'name'     => 'username',
                'disabled' => (empty($config['user'])) ? '' : true,
                'required' => (empty($config['user'])) ? true : '',
                'value'    => (empty($config['user'])) 
                    ? set_value('username')
                    : set_value('username', $config['user']->username) 
            ],
            [
                'label'    => __('User Email', 'aauth'),
                'class' => 'col-12 col-lg-6 col-md-6',
                'name'     => 'user_email',
                'disabled' => (empty($config['user'])) ? '' : true,
                'required' => (empty($config['user'])) ? true : '',
                'value'    => (empty($config['user'])) 
                    ? set_value('user_email')
                    : set_value('user_email', $config['user']->email) 
            ]
        );
        $filed[] = array(
            [
                'name'  => 'firstname',
                'class' => 'col-12 col-lg-6 col-md-6',
                'type' => 'text',
                'label' => __('First Name', 'aauth'),
                'value' => (empty($meta->firstname)) 
                    ? set_value('firstname') 
                    : set_value('firstname', $meta->firstname),
            ],
            [
                'type' => 'text',
                'class' => 'col-12 col-lg-6 col-md-6',
                'name'  => 'lastname',
                'label' => __('Last Name', 'aauth'),
                'value' => (empty($meta->lastname)) 
                    ? set_value('lastname') 
                    : set_value('lastname', $meta->lastname),
            ]
        );
        
        if ($config['page'] != 'profile' && isset($config['groups'])) :
            $groups_array = array();
            foreach ( force_array($config['groups']) as $group) {
                $groups_array[ $group->id ] = $group->definition != null ? $group->definition : $group->name;
            }
            $filed[] = array(
                [
                    'type' => 'select',
                    'class' => 'col-12 col-lg-6 col-md-6',
                    'widget' => 'select2',
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
                    'type' => 'select',
                    'class'     => 'col-6',
                    'widget' => 'select2',
                    'label'   => __('Add to a group', 'aauth'),
                    'name'    => 'group',
                    'disabled' => ($groups_array) ? false : true,
                    'required'  => ($groups_array) ? true : false,
                    'options' => $groups_array,
                    'active'  => (empty($config['user_group'])) 
                        ? null
                        : $config['user_group']->group_id 
                ]
            );
        endif;

        return $filed;
    }
    
    public function load_user_pass($config)
    {
        if ( $this->events->apply_filters('show_old_pass', true) && $config['page'] == 'profile' ) {
            $filed[] = array(
                'type'  => 'password',
                'class' => 'col-12 col-lg-6 col-md-6',
                'label' => __('Old Password', 'aauth'),
                'name'  => 'old_pass',
            );
        }
        elseif ( ! empty($config['user']) && $config['page'] != 'profile' ) {
            $filed[] = array(
                'type'  => 'password',
                'class' => 'col-12 col-lg-6 col-md-6',
                'label' => __('Old Password', 'aauth'),
                'name'  => 'old_pass',
            );
        }
        $filed[] = array(
            [
                'type'  => 'password',
                'class' => 'col-12 col-lg-6 col-md-6',
                'required'  => (empty($config['user'])) ? true : '',
                'label' => __('New Password', 'aauth'),
                'name'  => 'password'
            ],
            [
                'type'  => 'password',
                'class' => 'col-12 col-lg-6 col-md-6',
                'required'  => (empty($config['user'])) ? true : '',
                'label' => __('Confirm New', 'aauth'),
                'name'  => 'confirm'
            ]
        );

        return $filed;
    }
    
    public function load_users_advanced($config)
    {
        $json_vars = (! empty($config['user'])) ? $this->aauth->get_user_var( 'meta', $config['user']->id ) : null;
        $meta = ($json_vars) ? json_decode($json_vars) : null;

        $filed[] = array(
            'type'  => 'input-image',
            'wrapper'  => 'user',
            'accept' => '.png, .jpg, .jpeg',
            'label' => __('user_image'),
            'name'  => 'user_image',
            'id'  => 'user_image',
            'description' => 'Allowed file types: png, jpg, jpeg.',
            'value' => (empty($config['user'])) 
                ? ''
                : $config['user']->id
        );

        global $Options;
        if ($config['page'] == 'profile' && intval(riake('demo_mode', $Options)) == false) :
        $filed[] = array(
            'type' => 'dom',
            'content' => $this->addon_view( 'users', 'profile/mode', compact( 'config' ), true )
        );
        endif;

        $filed = $this->events->apply_filters_ref_array('load_users_advanced_filed', array( 
            array_merge(
                $filed,
                ['user'=> $config['user']],
                ['page'=> $config['page']]
            )
        ));
        
        unset( $filed[ 'page' ] );
        unset( $filed[ 'user' ] );

        return $filed;
    }
    
    /**
    * Adds custom meta for user
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function custom_user_vars($fields)
    {
        $fields[ 'theme-skin' ] = ($skin = $this->input->post('theme-skin')) ? $skin : 'skin-dark';
        return $fields;
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
        $meta = riake('meta', $User_Options);
        $name = riake('firstname', $meta);
        $last = riake('lastname', $meta);
        $full = trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }

    public function apps_logo($config_logo = null)
    {
        global $User_Options;
        global $Options;
        if ( riake('theme-skin', $User_Options) == 'dark-mode'
            && $this->aauth->is_loggedin()
            || $config_logo == 'light') {
            $logo = ( $logo_new = riake('logo', $Options)) ? $logo_new : 'system/logo-light.png';
        } 
        else {
            $logo = ( $logo_new = riake('logo', $Options)) ? $logo_new : 'system/logo-dark.png';
        }

        if ($config_logo == 'sm') {
            $logo = ( $logo_new = riake('logo', $Options)) ? $logo_new : 'system/logo-sm.png';
        }

        return upload_url($logo);
    }

    public function apps_description($config_logo = null)
    {
        return $this->addon_view( 'users', 'contact', array(), true );
    }
}
new Users_Filters;