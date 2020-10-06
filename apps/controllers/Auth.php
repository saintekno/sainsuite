<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 */
class Auth extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');

        $this->_auth_assets();
    }
    
    /**
     * Assets login
     */
    public function _auth_assets()
    {
        $this->enqueue->css_namespace( 'common_header' );
        $this->enqueue->css('login');
        $this->enqueue->js_namespace( 'common_footer' );
        $this->enqueue->js('login');
    }

    /**
     * Index
     */
	public function index()
	{
        $this->form_validation->set_rules('username_or_email', __('Email or User Name' ), 'required|min_length[5]');
        $this->form_validation->set_rules('password', __('Password' ), 'required|min_length[6]');
        $this->form_validation->set_rules('submit_button', __('Submit button'), 'alpha_dash');
		
        // Log User After Applying Filters
        if ($this->form_validation->run()) 
        {
            $exec = $this->users->login();
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
            // $this->notice->push_notice($this->lang->line($exec));
        }
		
		Html::set_title(sprintf(__('Sign In &mdash; %s'), get('app_name')));
		$data['page_name'] = 'login';
		$this->load->view('auth/index', $data);
	}
    
    /**
     * Register
     */
    public function register()
    {
        $this->events->do_action('registration_rules');

        if ($this->form_validation->run()) 
        {
            global $Options;
            $exec = $this->users->create(
                $this->input->post('email'),
                $this->input->post('password'),
                $this->input->post('username'),
                'user',
                ( @$Options[ 'require_validation' ] == 1 ? 1 : 0 )
            );
    
            if ($exec === 'user-created') {
                redirect(array( 'login?notice=' . $exec ));
            }
        }
		
		Html::set_title(sprintf(__('Sign Up &mdash; %s'), get('app_name')));
		$data['page_name'] = 'register';
		$this->load->view('auth/index', $data);
    }
    
    /**
     * Logout
     */
    public function logout()
    {
        // doing log_user_out
        if ($this->aauth->logout() == null) {
            if (($redir = riake('redirect', $_GET)) != false) {
                redirect(array( 'login?redirect=' . urlencode($redir) ));
            } else {
                redirect(array( 'login' ));
            }
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
            if ($this->aauth->user_exist_by_email($this->input->post('user_email'))) 
            {
                $this->aauth->remind_password($this->input->post('user_email'));
                redirect(array( 'login?notice=recovery-email-send' ));
            }
            $this->notice->push_notice($this->lang->line('unknow-user'));
        }

        Html::set_title(sprintf(__('Recover Password &mdash; %s'), get('core_signature')));
        $data['page_name'] = 'recovery';
		$this->load->view('auth/index', $data);
    }
    
    /**
     * 	Reset
     *	Checks a verification code an send a new password to user email
     *
    **/
    public function reset_password($ver_code)
    {
        if ($this->aauth->reset_password($ver_code)) 
        {
            redirect(array( 'login?notice=new-password-created' ));
        }
        redirect(array( 'login?notice=error-occured' ));
    }
    
    /**
     * Verify actvaton code for specifc user
    **/
    public function verification($user_id, $ver_code)
    {
        $user = $this->aauth->get_user($user_id);
        if ($user) {
            if ($this->aauth->verify_user($user_id, $ver_code)) 
            {
                redirect(array( 'login?notice=account-activated' ));
            }
            redirect(array( 'login?notice=error-occured' ));
        }
        redirect(array( 'login?notice=unknow-user' ));
    }
}
