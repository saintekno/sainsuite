<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Eracik_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->addin_model('aauth', 'Login_Model');
        
        // Load CSS and JS
        $this->events->add_action( 'auth_header', array( $this, '_auth_header' ), 1 );
        $this->events->add_action( 'auth_footer', array( $this, '_auth_footer' ), 1 );
    }

	// --------------------------------------------------------------------
    
    /**
     *  Dashboard header
     *  @param void
     *  @return void
    **/
    public function _auth_header()
    {
        $this->enqueue->css_namespace( 'auth_header' );
        $this->enqueue->css('bootstrap.min');
        $this->enqueue->asset_css('assets/font-awesome/css/font-awesome.min');
        $this->enqueue->css('login');

        // Show assets header
        $this->enqueue->load_css( 'auth_header' );
    }

	// --------------------------------------------------------------------

    /**
     *  Dashboard Footer
     *  @param void
     *  @return void
    **/
    public function _auth_footer()
    {
        $this->enqueue->js_namespace( 'auth_footer' );
        $this->enqueue->asset_js('assets/jquery/jquery.min');
        $this->enqueue->js('bootstrap.bundle.min');

        // Show asset footer
        $this->enqueue->load_js( 'auth_footer' );
    }

	// --------------------------------------------------------------------
    
    /**
     * Sign In index page
     *
     *	Displays login page
     * 	@return : void
    **/
    
    public function index()
    {
        if ($this->users->is_connected() || User::get()) 
        {
            redirect(array( $this->config->item('default_logout_route') ));
        }

        $this->events->do_action('set_login_rules');
        
        // in order to let validation return true
        $this->form_validation->set_rules('submit_button', __('Submit button'), 'alpha_dash');
		
        if ($this->form_validation->run()) 
        {
            // Log User After Applying Filters
            $this->events->do_action( 'do_login' );
            $exec = $this->events->apply_filters('Do_login_notice', 'user-logged-in');
            if ($exec == 'user-logged-in') 
            {
                if (riake('redirect', $_GET)) 
                {
                    redirect(urldecode(riake('redirect', $_GET)));
                } 
                else 
                {
                    $url = $this->events->apply_filters( 'login_redirection', site_url( array( 'dashboard' ) ) );
                    redirect( $url );
                }
            }
            $this->notice->push_notice($this->lang->line($exec));
        }
		
        // load login fields
        $this->config->set_item('signin_fields', $this->events->apply_filters('signin_fields', $this->config->item('signin_fields')));
        
        Html::set_title(sprintf(__('Sign In &mdash; %s'), get('app_name')));
        $this->load->view('auth/header');
        $this->load->view('auth/login');
    }

	// --------------------------------------------------------------------
    
    /**
     * 	Recovery Method
     *	
     *	Allow user to get reset email for his account
     *
     *	@return void
    **/
    
    public function recovery()
    {
        $this->form_validation->set_rules('user_email', __('User Email'), 'required|valid_email');
        if ($this->form_validation->run()) {
            /**
             * Actions to be run before sending recovery email
             * It can allow use to edit email
            **/
            $this->events->do_action('do_send_recovery');
        }
        Html::set_title(sprintf(__('Recover Password &mdash; %s'), get('app_name')));
        $this->load->view('auth/header');
        $this->load->view('auth/recovery');
    }
    
    /**
     * 	Reset
     * 	
     *	Checks a verification code an send a new password to user email
     *
     * 	@access : public
     *	@param : int user_id
     * 	@param : string verfication code
     * 	@return : void
     * 
    **/

    public function register()
    {
        $this->events->do_action('registration_rules');

        if ($this->form_validation->run()) {
            $this->events->do_action('do_register_user');
        }

        Html::set_title(sprintf(__('Sign Up &mdash; %s'), get('app_name')));

        $this->load->view('auth/header');
        $this->load->view('auth/register');
    }
    
    /**
     * 	Reset
     * 	
     *	Checks a verification code an send a new password to user email
     *
     * 	@access : public
     *	@param : int user_id
     * 	@param : string verfication code
     * 	@return : void
     * 
    **/
    public function logout()
    {
        // doing log_user_out
        $this->events->do_action('log_user_out');
    }
    
    /**
     * 	Reset
     * 	
     *	Checks a verification code an send a new password to user email
     *
     * 	@access : public
     *	@param : int user_id
     * 	@param : string verfication code
     * 	@return : void
     * 
    **/
    
    public function reset($user_id, $ver_code)
    {
        $this->events->do_action('do_reset_user', $user_id, $ver_code);
    }
    
    /**
     * Verify
     * 
     * 	Verify actvaton code for specifc user
     *
     *	@access : public
     *	@param : int user_id
     *	@param : string verification code
     *	@status	: untested
    **/
    
    public function verify($user_id, $ver_code)
    {
        $this->events->do_action('do_verify_user', $user_id, $ver_code);
    }
}
