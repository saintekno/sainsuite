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
class UsersHomeController extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter( 'aside_menu', array( new Users_Menu, '_aside_menu' ));
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
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
		}

        // Pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
		$config_vars = $this->config->item('pagination');
        $config_vars['base_url'] = site_url(array( 'admin', 'users' )) . '/';
        $config_vars['total_rows'] = User::count_users();
        $config_vars['per_page'] = 10;
        $config_vars['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config_vars);

        // Toolbar
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
        
        // Data
        $index = empty( $index ) ? 1 : $index;
        $user_group = $this->aauth->get_user_groups();
        $data['pagination'] = $this->pagination->create_links();
        if ($user_group[0]->name == $this->aauth->config_vars['admin_group']) {
            $data['users'] = $this->aauth->list_users( false, $config_vars['per_page'], ( intval( $index ) - 1 ) * $config_vars['per_page'], true);
        }
        else {
            $data['users'] = $this->aauth->list_users( $this->aauth->config_vars['member_group'], $config_vars['per_page'], ( intval( $index ) - 1 ) * $config_vars['per_page'], true);
        }

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
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', __('User Name', 'aauth'), 'required|min_length[5]');
        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'required|matches[password]');
        $this->form_validation->set_rules('userprivilege', __('User Privilege', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action('user_creation_rules');

        if ($this->form_validation->run()) 
        {
            $exec = $this->user_model->create(
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('username'),
                $this->input->post('userprivilege'),
                $this->input->post('user_status' )
            );
            
            if ($exec == 'created') 
            {
                redirect(array( 'admin', 'users?notice=' . $exec ));
                exit;
            }
            else {
                $this->notice->push_notice_array($exec);
                // redirect(current_url(), 'refresh');
            }
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s'), get('signature')));
        
        // Data
		$data['groups'] = $this->aauth->list_groups();
        $this->addon_view( 'users', 'users/form', $data );
    }

    /**
     * Edit user
     * @param int user id
     * @return void
     */
    public function edit( $index )
    {
        // if current user matches user id
        if ($this->aauth->get_user_id() == $index) {
            redirect(array( 'admin', 'users', 'profile' ));
        }

        if (! User::control('edit.users')) {
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }
        
        // User Goup
        $user = $this->aauth->get_user($index);
        if (! $user) {
            $this->session->set_flashdata('info_message', __( 'Unknow user. The use you attempted to edit has not been found.' ));
            redirect(site_url('admin/page404'));
        }
        
        $user_group = farray($this->aauth->get_user_groups($user->id));
        $groups = $this->aauth->list_groups();
        $user_group = farray($this->aauth->get_user_groups($index));

        // validation rules
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', __( 'User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('password', __( 'Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __( 'Confirm', 'aauth'), 'matches[password]');
        $this->form_validation->set_rules('userprivilege', __('User Privilege', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action( 'user_modification_rules', $index, $user );

        if ($this->form_validation->run()) {

            $exec =  $this->user_model->edit(
                $index,
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                $user_group,
                $this->input->post( 'old_pass' ),
                'edit',
                $this->input->post( 'user_status' )
            );

            $this->session->set_flashdata('flash_message', $this->lang->line('updated'));
            redirect(current_url(), 'refresh');
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s'), get('signature')));
        
        // Data
		$data['groups'] = $groups;
		$data['user'] = $user;
		$data['user_group'] = $user_group;
        $this->addon_view( 'users', 'users/form', $data );
    }

    /**
     * Delete user
     * @return redirect
     */

    public function delete( $index, $redirect = 'users' )
    {
        if (! User::control('delete.users')) {
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        $user = $this->aauth->get_user($index);

        if( User::id() == $user->id ) {
            redirect( array( 'admin', 'users?notice=cant-delete-yourself' ) );
        }

        if ($user) {
            $this->aauth->delete_user($index);
            redirect(array( 'admin', $redirect.'?notice=deleted' ));
        }
    }
}
