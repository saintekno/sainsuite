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
class UsersProfileController extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {		
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
            $this->session->set_flashdata('flash_message', $this->lang->line($exec));
            redirect(current_url(), 'refresh');
        }
        
		Polatan::set_title(__( 'My Profile' ));
        
        $data[ 'apps' ] = '';
        $this->addon_view( 'users', 'profile', $data );
    }
}
