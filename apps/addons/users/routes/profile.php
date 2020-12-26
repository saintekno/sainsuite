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

        $this->events->add_filter( 'aside_menu', array( new Users_Menu, '_aside_menu' ));
    }
    
    public function index()
    {		
        if ( ! User::control('edit.profile') ) {
            $this->session->set_flashdata('error_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }
        
        $this->events->add_filter('ui_subheader_body', function () { 
            return 'transparent';
        });

        $this->events->add_filter('gui_before_cols', function () { 
            return '<button class="btn btn-secondary mb-2 btn-lg btn-block d-lg-none" id="kt_subheader_mobile_toggle"> <i class="flaticon-menu-2"></i> Block level Menu</button>';
        });

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
        if ( $this->events->apply_filters('show_old_pass', true) ) {
            $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        }
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
        
        // BreadCrumb
        $this->breadcrumb->add( User::get()->username, '#');
        
        $data[ 'apps' ] = '';
        $data['breadcrumbs'] = $this->breadcrumb->render();
        $this->addon_view( 'users', 'profile/read', $data );
    }
}
