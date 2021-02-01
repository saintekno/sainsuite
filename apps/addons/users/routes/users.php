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
class UsersHomeController extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter( 'header_menu', array( new Users_Menu, '_header_menu' ));
    }

    /**
     * read users
     *
     * @param integer $index
     * @return void
     */
    public function index( $index = 1 )
    {
        if ( ! User::control('read.users') ) {
            $this->session->set_flashdata('info_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
		}

        // Toolbar
        $this->events->add_filter('ui_subheader_search', function () { // disabling header
            $groups = $this->aauth->list_groups();
            $option = '<option value="">All</option>';
            foreach ( $groups as $gr ) {
                $option .= '<option value="'.strtolower($gr->name).'">'.$gr->definition.'</option>';
            }
            return '
            <div class="d-flex align-items-center mr-2">
                <select class="form-control form-control-sm"
                    id="kt_datatable_search_group">
                    '.$option.'
                </select>
            </div>
            <div class="d-flex align-items-center mr-2">
                <select class="form-control form-control-sm"
                    id="kt_datatable_search_status">
                    <option value="">All</option>
                    <option value="0">Active</option>
                    <option value="1">Unactive</option>
                </select>
            </div>
            <div class="input-icon">
                <input type="text" class="form-control form-control-sm" placeholder="Search..." id="search_query" />
                <span><i class="flaticon2-search-1 text-muted"></i></span>
            </div>';
        });
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
                $final[] = array(
                    'title'   => __('Add A user'),
                    'icon'    => 'ki ki-plus',
                    'button'  => 'btn-light-primary',
                    'href'    => site_url([ 'admin', 'users', 'add' ]),
                    'permission' => 'create.users'
                );
            return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home'), site_url('admin'));
        $this->breadcrumb->add(__('Users'), site_url('admin/users'));
        $data['breadcrumbs'] = $this->breadcrumb->render();

        // Data
        $list_users = ($this->aauth->is_admin()) ? $this->aauth->list_users(false, [], false, false, true) : $this->aauth->list_users();
        $data['users'] = json_encode( $list_users );
        $this->addon_view( 'users', 'users/read', $data );
    }

    /**
     * Add user
     *
     * @return void
     */
    public function add()
    {
        if (! User::control('create.users')) {
            $this->session->set_flashdata('info_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home') , site_url('admin'));
        $this->breadcrumb->add(__('Users') , site_url('admin/users'));
        $this->breadcrumb->add(__('Add New') , site_url('admin/users/add'));
        $data['breadcrumbs'] = $this->breadcrumb->render();

        // Data
        $data['groups'] = $this->aauth->list_groups();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', __('User Name', 'aauth'), 'required|min_length[5]');
        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'required|matches[password]');
        $this->form_validation->set_rules('group', __('Group', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action('user_creation_rules');

        if ($this->form_validation->run()) 
        {
            $exec = $this->user_model->create(
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('username'),
                $this->input->post('group'),
                $this->input->post('user_status' )
            );
            
            if ($exec == 'created') 
            {
                redirect(array( 'admin', 'users?notice=' . $exec ));
                exit;
            }

            $this->notice->push_notice_array($this->aauth->get_errors_array());
        }

        $this->addon_view( 'users', 'users/form', $data );
    }

    /**
     * Edit user
     * @param int user id
     * @return void
     */
    public function edit($index, $param1 = '' )
    {
        // if current user matches user id
        if ($this->aauth->get_user_id() == $index) {
            redirect(array( 'admin', 'profile' ));
        }

        if (! User::control('edit.users')) {
            $this->session->set_flashdata('info_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }
        
        // User Goup
        $user = $this->aauth->get_user($index);
        if (! $user) {
            $this->session->set_flashdata('info_message', __( 'Unknow user. The use you attempted to edit has not been found.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });

        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home') , site_url('admin'));
        $this->breadcrumb->add(__('Users') , site_url('admin/users'));
        $this->breadcrumb->add(__('Edit') , site_url('admin/users/edit'));
        $data['breadcrumbs'] = $this->breadcrumb->render();

        // Data
		$data['user'] = $user;
		$data['groups'] = $this->aauth->list_groups();
		$data['user_group'] = farray($this->aauth->get_user_groups($user->id));

        // validation rules
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
                    $index,
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
            $this->events->do_action( 'user_modification_rules', $index, $user );

            if ($this->form_validation->run()) {
                $exec =  $this->user_model->edit(
                    'edit',
                    $index,
                    $this->input->post('user_email'),
                    $this->input->post('group'),
                    $this->input->post('user_status' )
                );
    
                $this->session->set_flashdata('flash_message', $this->lang->line('updated'));
                redirect(current_url(), 'refresh');
            }
        }

        $this->addon_view( 'users', 'users/form_edit', $data );
    }

    /**
     * Delete user
     * @return redirect
     */

    public function delete( $index = null, $redirect = 'users' )
    {
        if (! User::control('delete.users')) {
            $this->session->set_flashdata('info_message', __( 'Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        if ( $index == null ) 
        {
            $ids = $this->input->post('ids');
    
            foreach($ids as $id){
                $this->aauth->delete_user($id);
            }
    
            echo 1;
            exit;
        }
        else {
            $user = $this->aauth->get_user($index);
    
            if ( empty($user) ) :
                redirect(array( 'admin', $redirect.'?notice=unknow-user' ));
            endif;
    
            if( User::id() == $user->id ) : 
                redirect( array( 'admin', 'users?notice=cant-delete-yourself' ) );
            endif;
    
            $this->aauth->delete_user($index);
            redirect(array( 'admin', $redirect.'?notice=deleted' ));
        }
    }
}
