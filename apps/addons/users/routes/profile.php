<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class UsersProfileController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {		
        if (! User::control('edit.profile')) {
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            return redirect(site_url('admin'));
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
            
            $this->user_model->refresh_user_meta();
            $this->notice->push_notice_array($exec);
        }
        
		Polatan::set_title(__( 'My Profile', 'users' ));
        
        $data[ 'apps' ] = '';
        $this->load->addon_view( 'users', 'profile', $data );
    }
}
