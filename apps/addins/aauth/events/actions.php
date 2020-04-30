<?php

class aauth_action extends Eracik_Module
{
    public function __construct()
    {
        parent::__construct();
        $this->events->add_action('do_register_user', array( $this, 'register_user' ));
        $this->events->add_action('do_send_recovery', array( $this, 'change_auth_settings' ));
        $this->events->add_action('do_send_recovery', array( $this, 'recovery_email' ));
        $this->events->add_action('do_login', array( $this, '_do_login' ));
        $this->events->add_action('do_reset_user', array( $this, 'do_reset_user' ), 10, 2);
        $this->events->add_action('do_verify_user', array( $this, 'do_verify_user' ), 10, 2);
    }

	// --------------------------------------------------------------------

    public function do_verify_user($user_id, $ver_code)
    {
        $user    =    $this->users->auth->get_user($user_id);
        if ($user) {
            if ($this->users->auth->verify_user($user_id, $ver_code)) {
                redirect(array( 'login?notice=account-activated' ));
            }
            redirect(array( 'login?notice=error-occured' ));
        }
        redirect(array( 'login?notice=unknow-user' ));
    }

	// --------------------------------------------------------------------

    public function do_reset_user($user_id, $ver_code)
    {
        $user    =    $this->users->auth->get_user($user_id);
        if ($user) {
            if ($this->users->auth->reset_password($user_id, $ver_code)) {
                redirect(array( 'login?notice=new-password-created' ));
            }
            redirect(array( 'login?notice=error-occured' ));
        }
        redirect(array( 'login?notice=unknow-user' ));
    }

	// --------------------------------------------------------------------

    public function register_user()
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

	// --------------------------------------------------------------------

    public function recovery_email()
    {
        // Send Recovery
        if ($this->users->auth->user_exsist_by_email($this->input->post('user_email'))) {
            $this->users->auth->remind_password($this->input->post('user_email'));
            redirect(array( 'login?notice=recovery-email-send' ));
        }
        $this->notice->push_notice($this->lang->line('unknow-user'));
    }

	// --------------------------------------------------------------------

    /**
     * Change Auth Class Email Settings
     *
     * @return : void
    **/

    public function change_auth_settings()
    {
        $auth                       =    &$this->users->auth->config_vars;
        $auth[ 'email' ]            =    'racikproject@gmail.com';
        $auth[ 'name' ]             =    get('core_signature');
    }

	// --------------------------------------------------------------------

    /**
     * Log user in
     *
    **/

    public function _do_login()
    {
        // Apply filter before login
        $fields_namespace = $this->Login_Model->get_fields_namespace();
        
        $exec = $this->users->login($fields_namespace);

        $this->events->add_filter('Do_login_notice', function () use ($exec) {
            return $exec;
        });
    }
}
new aauth_action;
