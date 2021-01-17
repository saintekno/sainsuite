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
class Users_Action extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_action('load_users_custom_fields', array( $this, 'load_users_custom_fields' ));
        $this->events->add_action('registration_rules', array( $this, 'registration_rules' ));
        $this->events->add_action('app_init', array($this, 'check_login'));
    }
    
    /**
    * Adds custom fields for user creation and edit
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    public function load_users_custom_fields($config)
    {
        // $this->polatan->add_item([
        //     'type' => 'separator',
        // ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        $json_vars = $this->aauth->get_user_var( 'meta', $config[ 'user_id' ] );
        $meta = json_decode($json_vars);

        $this->polatan->add_item([
            'type' => 'text',
            'cols' => array(
                [
                    'name'  => 'firstname',
                    'label' => __('First Name', 'aauth'),
                    'value' => ($json_vars == null) 
                        ? set_value('firstname') 
                        : set_value('firstname', $meta->firstname),
                ],
                [
                    'name'  => 'lastname',
                    'label' => __('Last Name', 'aauth'),
                    'value' => ($json_vars == null)
                        ? set_value('lastname') 
                        : set_value('lastname', $meta->lastname),
                ]
            )
        ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        $this->polatan->add_item([
            'type' => 'text',
            'name'  => 'phone',
            'label' => __('Phone'),
            'value' => ($json_vars == null) 
                ? set_value('phone') 
                : set_value('phone', $meta->phone),
        ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        $this->polatan->add_item([
            'type' => 'textarea',
            'name'  => 'address',
            'label' => __('Address'),
            'value' => ($json_vars == null) 
                ? set_value('address') 
                : set_value('address', $meta->address),
        ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        $this->polatan->add_item( array(
            'type'  => 'input-image',
            'wrapper'  => 'user',
            'accept' => '.png, .jpg, .jpeg',
            'label' => __('user_image'),
            'name'  => 'user_image',
            'id'  => 'user_image',
            'value' => ($config[ 'user_id' ] != null) ? $config[ 'user_id' ] : '',
        ), $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        riake( 'gui', $config )->add_item(array(
            'type' => 'dom',
            'content' => $this->addon_view( 'users', 'profile/mode', compact( 'config' ), true )
        ), $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        unset( $config );
    }
    
    public function registration_rules()
    {
        $this->form_validation->set_rules('username', __('User Name' ), 'required|min_length[5]');
        $this->form_validation->set_rules('email', __('Email' ), 'valid_email|required');
        $this->form_validation->set_rules('password', __('Password' ), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm' ), 'matches[password]');
    }

    /**
     * go login
     *
     * @return redirect route login
     */
    public function check_login()
    {
        if (in_array($this->uri->segment(1), $this->config->item('admin_route'))) 
        {
            if (! $this->aauth->is_loggedin() || ! $this->aauth->get_user()) {
                redirect($this->config->item('login_route') . '?notice=login-required&redirect=' . urlencode(current_url()) );
            }
        }
    }
}
new Users_Action;