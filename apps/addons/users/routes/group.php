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
class GroupsHomeController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
                'href'    => site_url([ 'admin', 'users', 'group', 'add' ]),
                'permission' => 'create.group'
            );
            return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        $data['groups'] = $this->aauth->list_groups();
        $this->load->addon_view( 'users', 'group/read', $data );
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
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users', 'group' ])
			);
			return $final;
        });

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'Group Name', 'required');
        $this->form_validation->set_rules('definition', 'Group Definition', 'required');
        if ($this->form_validation->run()) 
        { 
            $exec = $this->aauth->create_group(
                $this->input->post('name'),
                $this->input->post('definition')
            );

            if ($exec) {
                redirect(array( 'admin', 'users', 'group?notice=group-created'));
            } else {
                $this->notice->push_notice_array($this->aauth->get_infos_array());
            }
        }
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        $this->load->addon_view( 'users', 'group/add' );
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
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'users', 'group' ])
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
                $this->session->set_flashdata('flash_message', $this->lang->line('group-updated'));
                redirect(current_url(), 'refresh');
            } else {
                $this->notice->push_notice_array($this->lang->line('unexpected-error'));
            }
        }
        
        // Title
		Polatan::set_title(sprintf(__('Group &mdash; %s', 'group'), get('signature')));
        
        $data['group'] = $this->aauth->get_group($index);
        $this->load->addon_view( 'users', 'group/edit', $data );
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
        redirect(array( 'admin', 'users', 'group?notice=group-deleted'));
    }
}