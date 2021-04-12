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
class GroupsHomeController extends MY_Addon
{
    private $breadcrumbs = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->events->add_filter( 'header_nav', array( new Users_Menu, '_header_nav' ));
    }

    private function breadcrumb($array = array())
    {
        $this->breadcrumbs[] = array(
            'id'     => 1,
            'name' => __('Home'), 
            'slug' => site_url('admin')
        );
        $this->breadcrumbs[] = array(
            'id'     => 2,
            'name' => __('Group'), 
            'slug' => site_url('admin/group')
        );
        ($array) ? $this->breadcrumbs[] = $array : '';
        return $this->breadcrumbs;
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
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        // BreadCrumb
        $data['breadcrumbs'] = $this->breadcrumb();
        
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        if( ! $this->events->has_filter('fill_list_users') ):
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
        $data['breadcrumbs'] = $this->breadcrumb(array(
            'id' => 2,
            'name' => __('Add New'), 
            'slug' => site_url('admin/group/add')
        ));

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

        // Submit
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        if( ! $this->events->has_filter('fill_list_users') ):
        $this->form_validation->set_rules('definition', 'Group Definition', 'required');
        endif;
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
        $data['breadcrumbs'] = $this->breadcrumb( array( 
            'id' => 3,
            'name' => __('Edit'), 
            'slug' => site_url('admin/group/edit') )
        );

        // Data
        $data['group'] = $this->aauth->get_group($index);
        
        $this->addon_view( 'users', 'group/form', $data );
    }

    /**
     * Delete group
     * @param int group id
     * @return redirect
     */
    public function delete( $index = null )
    {
        if (! User::control('delete.group')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Multi delete
        if ( $index == null ) 
        {
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->aauth->delete_group($id);
            }
        }
        else {
            $exec = $this->aauth->delete_group($index);

            if ($exec) {
                $this->session->set_flashdata('flash_message', __('deleted'));
            } else {
                $this->session->set_flashdata('flash_message', __('unexpected-error'));
            };
        }
    }
}