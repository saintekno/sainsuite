<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersProfileController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {		
        if (! User::control('edit.profile')) {
            return show_error( __( 'Access denied. You\'re not allowed to see this page.', 'aauth' ) );
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
        $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'matches[password]');

        if ($this->form_validation->run()) {
            $exec = $this->user_model->edit(
                $this->aauth->get_user_id(),
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                null, // user Privilege can't be editer through profile dash
                $this->input->post('old_pass'),
                'profile'
            );

            $custom_fields = $this->events->apply_filters('custom_user_meta', array());
            foreach (force_array($custom_fields) as $key => $value) {
                $this->aauth->set_user_var($key, strip_tags( xss_clean( $value ) ), $this->aauth->get_user_id());
            }            
            
            $this->user_model->refresh_user_meta();
            $this->notice->push_notice_array($exec);
        }
        
		Polatan::set_title(__( 'My Profile', 'users' ));
        
        $data[ 'apps' ] = '';
        $this->load->addon_view( 'users', 'profile', $data );
    }
}
