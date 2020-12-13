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
class GroupsHomeController extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter( 'header_menu', array( new Users_Menu, '_header_menu' ));
    }

    /**
     * Index group
     * @return void
     */
    public function index()
    {
        if ( ! User::control('read.group') ) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
		}

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
            $final[] = array(
                'title'   => __('Add A group'),
                'icon'    => 'ki ki-plus',
                'button'  => 'btn-light-primary',
                'href'    => site_url([ 'admin', 'group', 'add' ]),
                'permission' => 'create.group'
            );
            return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home'), site_url('admin'));
        $this->breadcrumb->add(__('Group'), site_url('admin/group'));
        
        $data['breadcrumbs'] = $this->breadcrumb->render();
        $data['groups'] = $this->aauth->list_groups();
        $this->addon_view( 'users', 'group/read', $data );
    }

    /**
     * Add group
     * @return void
     */
    public function add()
    {
        if (! User::control('create.group')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'group' ])
			);
			return $final;
        });

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        if( $this->aauth->is_admin() ):
            $this->form_validation->set_rules('definition', 'Group Definition', 'required');
        endif;
        if ($this->form_validation->run()) 
        { 
            $exec = $this->aauth->create_group(
                $this->input->post('name'),
                $this->input->post('definition')
            );

            if ($exec) {
                redirect(array( 'admin', 'group?notice=created'));
            } 
            
            $this->notice->push_notice_array($this->aauth->get_infos_array());
        }
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home'), site_url('admin'));
        $this->breadcrumb->add(__('Group'), site_url('admin/group'));
        $this->breadcrumb->add(__('Add New'), site_url('admin/group/add'));
        
        $data['breadcrumbs'] = $this->breadcrumb->render();
        $this->addon_view( 'users', 'group/form', $data );
    }

    /**
     * Edit group
     * @param int group id
     * @return void
     */
    public function edit( $index = "" )
    {
        if (! User::control('edit.group')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'group' ])
			);
			return $final;
        });

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        $this->form_validation->set_rules('definition', 'Group Definition', 'required');
        if ($this->form_validation->run()) 
        { 
            $exec = $this->aauth->update_group(
                $index,
                $this->input->post('name'),
                $this->input->post('definition')
            );

            if ($exec) {
                $this->session->set_flashdata('flash_message', $this->lang->line('updated'));
                redirect(current_url(), 'refresh');
            } 
            
            $this->notice->push_notice_array($this->aauth->get_errors_array());
        }
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home'), site_url('admin'));
        $this->breadcrumb->add(__('Group'), site_url('admin/group'));
        $this->breadcrumb->add(__('Edit'), site_url('admin/group/edit'));
        
        $data['breadcrumbs'] = $this->breadcrumb->render();
        $data['group'] = $this->aauth->get_group($index);
        $this->addon_view( 'users', 'group/form', $data );
    }

    /**
     * Delete group
     * @param int group id
     * @return redirect
     */
    public function delete( $index )
    {
        if (! User::control('delete.group')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        $exec = $this->aauth->delete_group($index);
        redirect(array( 'admin', 'users', 'group?notice=deleted'));
    }

    /**
     * Delete user
     * @return redirect
     */

    public function multidelete()
    {
        if (! User::control('delete.group')) {
            $this->session->set_flashdata('info_message', __( 'Access denied. Youre not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        $ids = $this->input->post('ids');

        foreach($ids as $id){
            $this->aauth->delete_group($id);
        }

        echo 1;
        exit;
    }
}