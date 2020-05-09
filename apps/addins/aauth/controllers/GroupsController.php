<?php
class GroupsController extends Eracik_Module
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

        $this->events-> add_filter('gui_page_title', function () { 
            // disabling header
            return;
        });
        $data['msg'] = 'maintenance mode';

        $this->load->view( 'dashboard/error/custom', $data);
    }

    // --------------------------------------------------------------------
    
    /**
     * List users
     * @return response
     */
    public function read( $index = 1 )
    {
        if (
            ! User::can('create_users') &&
            ! User::can('edit_users') &&
            ! User::can('delete_users')
        ) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }

        $this->events->add_filter( 'gui_page_title', function( $filter ) 
        {
            $filter = '<h1 class="no-margin">
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '
                    <small><a class="btn btn-primary btn-sm eright ng-binding" href="' . site_url([ 'dashboard', 'groups', 'create' ] ) . '">' . __( 'Add A group', 'aauth' ) . '</a></small>
                </h1>';
            return $filter;
        });

        $groups = $this->users->auth->list_groups();

        $this->load->addin_view( 'aauth', 'groups/body', array(
            'groups' => $groups
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
        if (! User::can('edit_users')) {
            redirect(array( 'dashboard' . '?notice=access-denied-page' ));
        }
        
        $this->load->library('form_validation');

        $groups = $this->users->auth->get_group_name($index);
        
        $this->events-> add_filter('gui_page_title', function () { 
            // disabling header
            return;
        });

        // $this->load->addin_view( 'aauth', 'groups/edit', array(
        //     'groups' => $groups
        // ));

        $data['msg'] = 'maintenance mode';

        $this->load->view( 'dashboard/error/custom', $data);
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

        $groups = $this->users->auth->get_group($index);

        if ($groups) {
            Group::delete_group($index);
            redirect(array( 'dashboard', 'groups?notice=group-deleted' ));
        }

        redirect(array( 'dashboard' . '?notice=access-denied-page' ));
    }
}