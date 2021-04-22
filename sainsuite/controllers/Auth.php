<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
/**
 * Auth Controller
 */
class Auth extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Index
     */
	public function index()
	{
        if (User::is_loggedin()) : redirect($this->config->item('admin_route'));
        endif;

        $this->form_validation->set_rules('username_or_email', __('Email or User Name' ), 'required|min_length[5]');
        $this->form_validation->set_rules('password', __('Password' ), 'required|min_length[6]');
        
        if ($this->session->userdata('captcha')) :
        $this->form_validation->set_rules('captcha', __('Security Code'),  array('matches[captcha]', function($captcha){ 
            if ($captcha == $this->session->userdata('captcha')) {
                return true;
            } } )
        );
        endif;
		
        // Log User After Applying Filters
        if ($this->form_validation->run()) 
        {
            $exec = $this->user_model->login();
            if ($exec == 'user-logged-in') 
            {
                if (riake('redirect', $_GET)) {
                    redirect(urldecode(riake('redirect', $_GET)));
                } 
                else {
                    $url = $this->events->apply_filters( 'login_redirection', site_url( array( 'admin' ) ) );
                    redirect( $url );
                }
            }

            $this->notice->push_notice_array($this->aauth->get_errors_array());
        }

        Polatan::set_title(sprintf(__('Sign In &mdash; %s'), get('app_name')));

        // Do events
        $this->events->do_action('do_oauth_client');
        
		$data['pages'] = 'login';
        $data = $this->events->apply_filters('fill_user_login', $data);
        $this->load->backend_view('layouts_split', $data );
	}
    
    /**
     * Register
     */
    public function register()
    {
        if (intval(riake('site_registration', options(APPNAME))) == false) : 
            redirect(array( 'login' ));
        endif;

        if (User::is_loggedin()) : redirect($this->config->item('admin_route'));
        endif;
        
        $this->events->do_action('registration_rules');

        if ($this->form_validation->run()) 
        {
            global $Options;
            $exec = $this->user_model->create(
                $this->input->post('email'),
                $this->input->post('password'),
                $this->input->post('username'),
                'user',
                ( @$Options[ 'require_validation' ] == 1 ? 1 : 0 )
            );
    
            if ($exec == 'created') {
                redirect(array( 'login?notice=create-email-send'));
            }
            
            $this->notice->push_notice_array($this->aauth->get_errors_array());
        }
		
		Polatan::set_title(sprintf(__('Sign Up &mdash; %s'), get('app_name')));
		$data['pages'] = 'register';
        $this->load->backend_view('layouts_split', $data );
    }
    
    /**
     * Logout
     */
    public function logout()
    {
        // doing log_user_out
        if ($this->aauth->logout() == null) 
        {
            if (($redir = riake('redirect', $_GET)) == false) :
                redirect(array( 'login' ));
            endif;

            redirect(array( 'login?redirect=' . urlencode($redir) ));
        }
    }
    
    /**
     * 	Recovery Method
     *	Allow user to get reset email for his account
    **/
    public function recovery()
    {
        if (intval(riake('site_registration', options(APPNAME))) == false) : 
            redirect(array( 'login' ));
        endif;
        
        $this->form_validation->set_rules('user_email', __('User Email'), 'required|valid_email');
        if ($this->form_validation->run()) 
        {
            if ( ! $this->aauth->user_exist_by_email($this->input->post('user_email'))) :
                $this->notice->push_notice_array($this->aauth->get_errors_array());
            endif;

            if ( $this->aauth->remind_password($this->input->post('user_email')) ) :
                redirect(array( 'login?notice=recovery-email-send' ));
            endif;
        }

        Polatan::set_title(sprintf(__('Recover Password &mdash; %s'), get('app_name')));
        $data['pages'] = 'recovery';
        $this->load->backend_view('layouts_split', $data );
    }
    
    /**
     * 	Reset
     *	Checks a verification code an send a new password to user email
     *
    **/
    public function reset_password($ver_code)
    {
        if ( ! $this->aauth->reset_password($ver_code)) :
            redirect(array( 'login?notice=aauth_error_vercode_invalid' ));
        endif;

        redirect(array( 'login?notice=aauth_email_reset_new_password' ));
    }
    
    /**
     * Verify actvaton code for specifc user
    **/
    public function verification($user_id, $ver_code)
    {
        if ( ! User::get($user_id)) :
            redirect(array( 'login?notice=unknow-user' ));
        endif;

        if ( ! $this->aauth->verify_user($user_id, $ver_code)) :
            redirect(array( 'login?notice=error-occured' ));
        endif;

        redirect(array( 'login?notice=account-activated' ));
    }
}
