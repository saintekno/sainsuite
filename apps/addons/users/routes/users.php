<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersHomeController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // Asidebar
        $this->events->add_filter( 'aside_menu', function( $final ) {
			$final[] = array(
				'title' => __('Users'),
				'href' => site_url([ 'admin', 'users' ])
			);
			$final[] = array(
				'title' => __('Permission'),
				'href' => site_url([ 'admin', 'users', 'permissions' ])
			);
			return $final;
        });
    }

    public function create()
    {
        if (! User::can('create.users')) {
            return show_error( __( 'Access denied. You\'re not allowed to see this page.', 'aauth' ) );
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
            
            if ($exec == 'user-created') 
            {
                $user_id = $this->aauth->get_user_id( $this->input->post( 'user_email' ) );
                $user    = $this->aauth->get_user( $user_id );
                
                redirect(array( 'admin', 'users?notice=' . $exec ));
                exit;
            }

            if (is_string($exec)) {
                $this->notice->push_notice($this->lang->line($exec));
            }
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Return to the list'),
				'icon'    => 'ki-plus',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s', 'users'), get('signature')));
        
        // Data
		$data['groups'] = $this->aauth->list_groups();
        $this->load->addon_view( 'users', 'create', $data );
    }

    public function read( $index = 1 )
    {
        if (
            ! User::can('edit.users') &&
            ! User::can('delete.users') &&
            ! User::can('create.users')
        ) {
            return show_error( __( 'Access denied. You\'re not allowed to see this page.', 'users' ) );
		}

        // Pagination
        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
		$config_vars = $this->config->item('pagination');
        $config_vars['base_url'] = site_url(array( 'admin', 'users' )) . '/';
        $config_vars['total_rows'] = $this->aauth_model->count_users();
        $config_vars['per_page'] = 2;
        $this->pagination->initialize($config_vars);

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Add A user'),
				'icon'    => 'ki-plus',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users', 'create' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s', 'users'), get('signature')));
        
        // Data
        $index = empty( $index ) ? 1 : $index;
		$data['pagination'] = $this->pagination->create_links();
        $data['users'] = $this->aauth->list_users( false, $config_vars['per_page'], ( intval( $index ) - 1 ) * $config_vars['per_page'], true);
        $this->load->addon_view( 'users', 'read', $data );
    }

    /**
     * Edit user
     * @param int user id
     * @return void
     */
    public function update( $index )
    {
        // if current user matches user id
        if ($this->aauth->get_user_id() == $index) {
            redirect(array( 'admin', 'users', 'profile' ));
        }

        if (! User::can('edit.users')) {
            return show_error( __( 'Access denied. You\'re not allowed to edit users', 'aauth' ) );
        }
        
        // User Goup
        $user = $this->aauth->get_user($index);
        if (! $user) {
            return show_error( __( 'Unknow user. The use you attempted to edit has not been found.', 'aauth' ) );
        }
        
        $user_group = farray($this->aauth->get_user_groups($user->id));
        $groups = $this->aauth->list_groups();
        $user_group = farray($this->aauth->get_user_groups($index));

        // validation rules
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', __( 'User Email', 'aauth'), 'required|valid_email');
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
                $this->input->post( 'confirm' ),
                $mode   =   'edit',
                $this->input->post( 'user_status' )
            );

            $custom_fields = $this->events->apply_filters('custom_user_meta', array());
            foreach ( force_array($custom_fields) as $key => $value) {
                $this->aauth->set_user_var($key, strip_tags( xss_clean( $value ) ), $index);
            } 

            $this->session->set_flashdata('flash_message', $this->lang->line('user-updated'));
            redirect(current_url(), 'refresh');
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Return to the list'),
				'icon'    => 'ki-plus',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Users &mdash; %s', 'users'), get('signature')));
        
        // Data
		$data['groups'] = $groups;
		$data['user'] = $user;
		$data['user_group'] = $user_group;
        $this->load->addon_view( 'users', 'update', $data );
    }

    /**
     * Delete users
     * @return redirect
     */

    public function delete( $index )
    {
        if (! User::can('delete.users')) {
            return show_error( __( 'Access denied. You\'re not allowed to see this page.', 'aauth' ) );
        }

        $user = $this->aauth->get_user($index);

        if( User::id() == $user->id ) {
            redirect( array( 'admin', 'users?notice=cant-delete-yourself' ) );
        }

        if ($user) {
            $this->user_model->delete($index);
            redirect(array( 'admin', 'users?notice=user-deleted' ));
        }

        return show_error( __( 'Access denied. You\'re not allowed to see this page.', 'aauth' ) );
    }
    
    public function permissions()
    {		
		Polatan::set_title(__( 'Profile', 'users' ));
        
        $data['page_name'] = $this->load->addon_view( 'users', 'home', null, true );
		$this->load->view('backend/index', $data);
    }
}
