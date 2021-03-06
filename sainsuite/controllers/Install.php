<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class Install extends MY_Controller 
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        // checks if SainSuite is not installed
        if ($this->install_model->is_installed()):
            redirect('welcome?notice=database-installed' );
        endif;

		Polatan::set_title(sprintf(__('Welcome Page &mdash; %s'), get('app_name')));
        $data['pages'] = 'install';
        $data['subpages'] = 'install';
        $this->load->backend_view('layouts_aside', $data );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function database()
    {
        // checks if SainSuite is not installed
        if ($this->install_model->is_installed()):
            redirect('welcome');
        endif;

        $this->form_validation->set_rules('_ht_name', __('Host Name'), 'required');
        $this->form_validation->set_rules('_uz_name', __('User Name'), 'required');
        $this->form_validation->set_rules('_db_name', __('Database Name'), 'required');
        $this->form_validation->set_rules('_db_driv', __('Database Driver'), 'required');
        $this->form_validation->set_rules('_db_pref', __('Database Prefix'), 'required');

        if ($this->form_validation->run()) 
        {
            $exec = $this->install_model->installation(
                $this->input->post('_ht_name'),
                $this->input->post('_uz_name'),
                $this->input->post('_uz_pwd'),
                $this->input->post('_db_name'),
                $this->input->post('_db_driv'),
                $this->input->post('_db_pref')
            );

            if ($exec == 'database-installed') 
            {
                redirect('install/site?notice=' . $exec . (riake('lang', $_GET) ? '&lang=' . $_GET[ 'lang' ] : '') );
            }

            $this->notice->push_notice_array($exec);
        }

		Polatan::set_title(sprintf(__('Database config &mdash; %s'), get('app_name')));
        $data['pages'] = 'install';
        $data['subpages'] = 'database';
        $this->load->backend_view('layouts_aside', $data );
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function site()
    {
        // checks if SainSuite is not installed
        if (! $this->install_model->is_installed()):
            redirect('install');
        endif;

        $this->events->do_action('do_settings_setup');
        $this->form_validation->set_rules('site_name', __('Site Name'), 'required');
        if ($this->form_validation->run()) 
        {
            $exec = $this->install_model->final_configuration();

            if ($exec == 'system-installed') 
            {                      
                redirect('login?redirect=admin&notice=' . $exec . ( @$_GET[ 'lang' ] ? '&lang=' . $_GET[ 'lang' ] : '') );
            }

            $this->notice->push_notice_array($this->aauth->get_errors_array());
        }

        Polatan::set_title(sprintf(__('Site & Master account &mdash; %s'), get('core_signature')));
        $data['pages'] = 'install';
        $data['subpages'] = 'site';
        $this->load->backend_view('layouts_aside', $data );
    }
}
