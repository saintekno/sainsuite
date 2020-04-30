<?php
class UsersController extends Eracik_Module
{
    /**
     * Create user
     * 
     */
    public function create()
    {
        if (! User::can('create_users')) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
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
            $exec = $this->users->create(
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('username'),
                $this->input->post('userprivilege'),
                $this->input->post( 'user_status' )
            );

            if ($exec == 'user-created') {
                redirect(array( 'dashboard', 'users?notice=' . $exec ));
                exit;
            }

            if (is_string($exec)) {
                $this->notice->push_notice($this->lang->line($exec));
            }
        }

        // selecting groups
        $groups = $this->users->auth->list_groups();

        $this->events->add_filter( 'gui_page_title', function( $filter ) {
            $filter =  '<section class="content-header">
                <h1 class="no-margin">
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '<small></small>
                    <a class="btn btn-primary btn-sm pull-right ng-binding" href="' . site_url([ 'dashboard', 'users' ] ) . '">' . __( 'Return to the list', 'aauth' ) . '</a>
                </h1> </section>';
            return $filter;
        });

        $this->load->addin_view( 'aauth', 'users/create', array(
            'groups' => $groups
        ));
    }

    // --------------------------------------------------------------------
    
    /**
     * List users
     * @return response
     */
    public function read( $index = 1 )
    {
        if (
            ! User::can('edit_users') &&
            ! User::can('delete_users') &&
            ! User::can('create_users')
        ) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }

        $this->load->library('pagination');

        $index                      = empty( $index ) ? 1 : $index;
        $config['base_url']         = site_url(array( 'dashboard', 'users' )) . '/';
        $config['total_rows']       = $this->users->auth->count_users();
        $config['per_page']         = 20;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open']    = '<ul class="pagination" style="margin: 10px">';
        $config['full_tag_close']   = '</ul>';
        $config['next_tag_open']    = $config['prev_tag_open']  = $config['num_tag_open']  = '<li>';
        $config['next_tag_close']   = $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</li></li>';
        $config['num_links']        = $config['total_rows'];

        $this->pagination->initialize($config);

        $users = $this->users->auth->list_users( false, ( intval( $index ) - 1 ) * $config['per_page'], $config['per_page'], true);

        $this->events->add_filter( 'gui_page_title', function( $filter ) 
        {
            $filter = '<section class="content-header">
                <h2 class="no-margin">
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '
                    <small><a class="btn btn-primary btn-sm pull-right ng-binding" href="' . site_url([ 'dashboard', 'users', 'create' ] ) . '">' . __( 'Add A user', 'aauth' ) . '</a></small>
                </h2> </section>';
            return $filter;
        });

        $this->load->addin_view( 'aauth', 'users/body', array(
            'users'      => $users,
            'pagination' => $this->pagination->create_links()
        ));
    }

    // --------------------------------------------------------------------
    
    /**
     * Edit user
     * @param int user id
     * @return void
     */
    public function update( $index )
    {
        // if current user matches user id
        if ($this->users->auth->get_user_id() == $index) {
            redirect(array( 'dashboard', 'users', 'profile' ));
        }

        if (! User::can('edit_users')) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }
        
        // User Goup
        $user = $this->users->auth->get_user($index);
        if (! $user) {
            return show_error( __( 'Unknow user. The use you attempted to edit has not been found.', 'aauth' ) );
        }
        
        $user_group = farray($this->users->auth->get_user_groups($user->id));
        $groups     = $this->users->auth->list_groups();
        $user_group = farray($this->users->auth->get_user_groups($index));

        // validation rules
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', __( 'User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('password', __( 'Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __( 'Confirm', 'aauth'), 'matches[password]');
        $this->form_validation->set_rules('userprivilege', __('User Privilege', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action('user_creation_rules');

        if ($this->form_validation->run()) 
        {
            $exec = $this->users->edit(
                $index,
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                $user_group,
                $this->input->post( 'confirm' ),
                $mode = 'edit',
                $this->input->post( 'user_status' )
            );

            $custom_fields = $this->events->apply_filters('custom_user_meta', array());
    
            foreach ( force_array($custom_fields) as $key => $value) {
                $this->options->set($key, strip_tags( xss_clean( $value ) ), true, $index, $app = 'users');
            } 

            $this->notice->push_notice($this->lang->line('user-updated'));
        }

        $this->events->add_filter( 'gui_page_title', function( $filter ) {
            $filter = '<section class="content-header">
                <h1 class="no-margin">
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '<small></small>
                    <a class="btn btn-primary btn-sm pull-right ng-binding" href="' . site_url([ 'dashboard', 'users' ] ) . '">' . __( 'Return to the list', 'aauth' ) . '</a>
                </h1></section>';
            return $filter;
        });

        $this->load->addin_view( 'aauth', 'users/edit', array(
            'groups'     => $groups,
            'user'       => $user,
            'user_group' => $user_group
        ));
    }

	// --------------------------------------------------------------------

    /**
     * Delete users
     * @return redirect
     */

    public function delete( $index )
    {
        if (! User::can('delete_users')) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }

        $user = $this->users->auth->get_user($index);

        if( User::id() == $user->id ) {
            redirect( array( 'dashboard', 'users?notice=cant-delete-yourself' ) );
        }

        if ($user) {
            $this->users->delete($index);
            redirect(array( 'dashboard', 'users?notice=user-deleted' ));
        }

        redirect(array( 'dashboard' . '?notice=access-denied-page' ));
    }

	// --------------------------------------------------------------------

    /**
     * Open use profile
     * @return void
     */
    public function profile()
    {
        if (! User::can('edit_profile')) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
        $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'matches[password]');

        // Launch events for user profiles edition rules
        $this->events->do_action('user_profile_rules');

        if ($this->form_validation->run()) 
        {
            $exec = $this->users->edit(
                $this->users->auth->get_user_id(),
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                null, // user Privilege can't be editer through profile dash
                $this->input->post('old_pass'),
                'profile'
            );

            $custom_fields = $this->events->apply_filters('custom_user_meta', array());
    
            foreach (force_array($custom_fields) as $key => $value) {
                $this->options->set($key, strip_tags( xss_clean( $value ) ), $autoload = true, $this->users->auth->get_user_id(), $app = 'users');
            }            
            
            $this->users->refresh_user_meta();
            $this->notice->push_notice_array($exec);
        }

        $this->load->addin_library( 'oauth', 'oauthLibrary' );

        $data = array();
        $data[ 'apps' ] = $this->oauthlibrary->getUserApp( User::id() );

        $this->load->addin_view( 'aauth', 'users/profile', $data );
    }
}