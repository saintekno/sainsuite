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
        $this->events->add_filter('fill_form_register', array( $this, 'fill_form_register' ), 1, 1);
        $this->events->add_filter('fill_apps_contact', array( $this, 'fill_apps_contact' ), 5, 1);
        $this->events->add_filter('fields_user_vars', array( $this, 'fields_user_vars' ), 10, 1);
        $this->events->add_filter('user_menu_card_avatar_src', function () {
            return User::get_user_image_url(User::id());
        });
    }

    public function fill_form_register()
    {
        return $this->addon_view( 'users', 'auth/register', array(), true );
    }
    
    public function load_user_profile($config)
    {        
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

        $filed[] = array(
            [
                'label'    => __('User Name', 'aauth'),
                'class' => 'col-12 col-lg-6 col-md-6',
                'type' => 'text',
                'required'  => true,
                'name'     => 'username',
                'readonly' => (empty($config['user'])) ? '' : true,
                'required' => (empty($config['user'])) ? true : '',
                'value'    => (empty($config['user'])) 
                    ? set_value('username')
                    : set_value('username', $config['user']->username) 
            ],
            [
                'label'    => __('User Email', 'aauth'),
                'class' => 'col-12 col-lg-6 col-md-6',
                'name'     => 'user_email',
                'readonly' => (empty($config['user'])) ? '' : true,
                'required' => (empty($config['user'])) ? true : '',
                'value'    => (empty($config['user'])) 
                    ? set_value('user_email')
                    : set_value('user_email', $config['user']->email) 
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
                    'class' => 'col-12 col-lg-6 col-md-6',
                    'label'   => __('Add to a group', 'aauth'),
                    'name'    => 'group',
                    'readonly' => ($groups_array) ? false : true,
                    'required'  => ($groups_array) ? true : false,
                    'options' => $groups_array,
                    'active'  => (empty($config['user_group'])) 
                        ? null
                        : $config['user_group']->group_id 
                ]
            );
        endif;

        $filed = $this->events->apply_filters_ref_array('fill_user_profile', array( 
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
    
    public function load_user_pass($config)
    {
        $cek_id = (! empty($config['user'])) ? $config['user']->id : false;
        if ( $this->events->apply_filters('fill_old_password', $cek_id ) ) {
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
    
    public function fields_user_vars($fields)
    {
        $fields[ 'theme-skin' ] = ($skin = $this->input->post('theme-skin')) ? $skin : 'skin-'.APPNAME;
        return $fields;
    }

    public function apps_logo($config_logo = null)
    {
        $App_Options = options(APPNAME);

        $media = 'media/medium/';
        if ($config_logo == 'light') {
            $logo = ( $logo_new = riake('logo_light', $App_Options)) ? upload_url($media.$logo_new) : upload_url('system/logo-light.png', base_url());
        } 
        else {
            $logo = ( $logo_new = riake('logo', $App_Options)) ? upload_url($media.$logo_new) : upload_url('system/logo-dark.png', base_url());
        }

        if ($config_logo == 'sm') {
            $logo = ( $logo_new = riake('favicon', $App_Options)) ? upload_url($media.$logo_new) : upload_url('system/logo-sm.png', base_url());
        }

        return $logo;
    }

    public function fill_apps_contact()
    {
        return $this->load->backend_view( 'about/contact', [], true );
    }
}
new Users_Filters;