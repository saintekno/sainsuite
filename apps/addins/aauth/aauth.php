<?php

class auth_class extends CI_model
{
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();

        // load language
        $this->lang->load_lines(dirname(__FILE__) . '/language/aauth_lang.php');

		// Load Model if is installed
        if ($this->setup->is_installed()) 
        {
            $this->load->addin_model('aauth', 'Users_Model', 'users');
        }

        // Events
        $this->events->add_action('after_app_init', array( $this, '_after_app_init' ));
        $this->events->add_action('is_connected' , array( $this , '_is_connected' ) );
        $this->events->add_action('log_user_out', array( $this, '_log_user_out' ));

        // Allow only admin user to access the dashboard
        $this->events->add_action('load_dashboard', array( $this, '_load_dashboard' ));

        $this->events->add_filter('user_id', array( $this, '_user_id' ));
        $this->events->add_filter('user_menu_card_avatar_src', array( $this, '_user_menu_card_avatar_src' ));
        $this->events->add_filter('user_menu_card_avatar_alt', function () {
            return User::pseudo();
        });
    }

    // -------------------------------------------------------------------------

    /**
     * user avatar
     */
    public function _user_menu_card_avatar_src()
    {
        if (cek_online()) {
            $avatar = User::get_gravatar_url();
        } else {
            $avatar = img_url() . 'user1.jpg';
        }
        return $avatar;
    }

    // -------------------------------------------------------------------------

    /**
     * user id
     */
    public function _user_id()
    {
        global $CurrentScreen;

        if ($this->users->is_connected() && $this->setup->is_installed() && ! in_array($CurrentScreen, array( 'do-setup', 'login', 'register' ))) 
        {
            return User::get()->id;
        }
        return 0;
    }

    // -------------------------------------------------------------------------

    /**
     * user log out
     */
    public function _log_user_out()
    {
        if ($this->users->logout() == null) 
        {
            if (($redir = riake('redirect', $_GET)) != false) 
            {
                redirect(array( 'login?redirect=' . urlencode($redir) ));
            } 
            else 
            {
                redirect(array( 'login' ));
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
     * user is connected
     */
    public function _is_connected()
    {
        if ($this->users->is_connected()) 
        {
            redirect(array( $this->config->item('default_logout_route') . '?notice=logout-required&redirect='  . urlencode(current_url()) ));
        }
    }

    // -------------------------------------------------------------------------

    /**
     * After options init
     */
    public function _after_app_init()
    {
        new User;

        // If there is no master user , redirect to master user creation if current controller isn't do-setup
        if (! $this->users->master_exists() && $this->uri->segment(1) !== 'do-setup') 
        {
            redirect(array( 'do-setup', 'site' ));
        }

        // force user to be connected for certain controller
        if (in_array($this->uri->segment(1), $this->config->item('controllers_requiring_login')) && $this->setup->is_installed()) 
        {
            if (! $this->users->is_connected() || ! User::get()) 
            {
                redirect(array( $this->config->item('default_login_route') . '?notice=login-required&redirect=' . urlencode(current_url()) ));
            }
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Check current use group access
     */
    public function _load_dashboard()
    {
        $Group = Group::get();
        if (! $Group[0]->is_admin) 
        {
            redirect(array( 'page_403' ));
        }
    }
}
new auth_class;

require(dirname(__FILE__) . '/libraries/User.php');
require(dirname(__FILE__) . '/libraries/Group.php');
require(dirname(__FILE__) . '/events/dashboard.php');
require(dirname(__FILE__) . '/events/setup.php');
require(dirname(__FILE__) . '/events/fields.php');
require(dirname(__FILE__) . '/events/actions.php');
require(dirname(__FILE__) . '/events/rules.php');
