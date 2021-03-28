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
        $this->form_validation->set_rules('captcha', __('captcha'),  array('matches[captcha]', function($captcha){ 
            $oldCaptcha = $this->session->userdata('captcha');
            if ($captcha == $oldCaptcha) {
                return true;
            } } )
        );
		
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

        // Add Captcha
		$this->load->helper('captcha');
        if (!is_dir(upload_path() . 'captcha/')) {
            mkdir(upload_path() . 'captcha/');
        }
        $captcha = create_captcha(array(
            'img_path'      => upload_path() . 'captcha/',
            'img_url'       => upload_url('captcha'),
            'font_path'     => asset_path() . 'css/fonts/captcha.ttf',
            'expiration'    => 600, //5 min
            'word_length'   => 4,
            'img_id'        => 'Imageid',

            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(21, 110, 231),
                'grid' => array(241, 243, 246)
            )
        ));
        $data['captcha_image'] = $captcha['image'];
        $this->session->set_userdata('captcha', $captcha['word']);

        // Do events
        $this->events->do_action('oauth_client');

        Polatan::set_title(sprintf(__('Sign In &mdash; %s'), get('app_name')));
        
		$data['pages'] = 'login';
        $this->load->backend_view('layouts_split', $data );
	}
    
    /**
     * Register
     */
    public function register()
    {
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
                'member',
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
        if ( ! $this->aauth->get_user($user_id)) :
            redirect(array( 'login?notice=unknow-user' ));
        endif;

        if ( ! $this->aauth->verify_user($user_id, $ver_code)) :
            redirect(array( 'login?notice=error-occured' ));
        endif;

        redirect(array( 'login?notice=account-activated' ));
    }
}
