<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class UsersProfileController extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter( 'aside_menu', array( new Users_Menu, '_aside_menu' ));
    }
    
    public function index($param1 = '')
    {		
        if ( ! User::control('edit.profile') ) {
            $this->session->set_flashdata('error_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }
        
        $this->events->add_filter('ui_subheader_body', function () { 
            return 'transparent';
        });

        $this->events->add_filter('gui_before_cols', function () { 
            return '<button class="btn btn-primary mb-2 btn-lg btn-block d-lg-none" id="kt_subheader_mobile_toggle"> <i class="flaticon-menu-2"></i> Block level Menu</button>';
        });
        
        Polatan::set_title(__( 'My Profile' ));
        
        // BreadCrumb
        $this->breadcrumb->add( User::get()->username, '#');
        $data['breadcrumbs'] = $this->breadcrumb->render();

        $data[ 'apps' ] = '';

        $this->load->library('form_validation');
        if ($param1 == 'change_password') 
        {
            if ( $this->events->apply_filters('show_old_pass', true) ) {
                $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'required|min_length[6]');
            }
            $this->form_validation->set_rules('password', __('Password', 'aauth'), 'required|min_length[6]');
            $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'required|matches[password]');
    
            if ($this->form_validation->run()) 
            {
                $exec = $this->user_model->change_password(
                    $this->aauth->get_user_id(),
                    $this->input->post('password'),
                    $this->input->post('old_pass')
                );   
    
                if ($exec == 'password_updated') {
                    $this->session->set_flashdata('flash_message', $this->lang->line($exec));
                }
                else {
                    $this->session->set_flashdata('error_message', $this->lang->line($exec));
                }
                
                $this->user_model->refresh_user_meta();
                redirect(current_url(), 'refresh');
            }
        }
        else {
            // load custom rules
            $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
            $this->events->do_action( 'user_modification_rules', User::id(), User::get() );

            if ($this->form_validation->run()) {
                $exec = $this->user_model->edit(
                    'profile',
                    $this->aauth->get_user_id(),
                    $this->input->post('user_email')
                );   
                
                $this->user_model->refresh_user_meta();
                $this->session->set_flashdata('flash_message', $this->lang->line($exec));
                redirect(current_url(), 'refresh');
            }
        }

        $this->addon_view( 'users', 'profile/read', $data );
    }
}
