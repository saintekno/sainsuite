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
        
        $this->events->add_action('do_registration_rules', array( $this, 'do_registration_rules' ), 1);
        $this->events->add_action('do_app_init', array($this, 'check_login'));
    }
    
    public function do_registration_rules()
    {
        $this->form_validation->set_rules('username', __('User Name' ), 'required|min_length[5]|is_unique[aauth_users.username]');
        $this->form_validation->set_rules('email', __('Email' ), 'valid_email|required|is_unique[aauth_users.email]');
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
        if (in_array(strtolower($this->uri->segment(1)), $this->config->item('admin_route'))) 
        {
            if (! User::is_loggedin() || ! User::get()) {
                redirect($this->config->item('login_route') . '?notice=login-required&redirect=' . urlencode(current_url()) );
            }
        }
    }
}
new Users_Action;