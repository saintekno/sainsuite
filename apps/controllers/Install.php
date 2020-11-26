<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class Install extends MY_Controller 
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $this->_install_assets();
    }
    
    public function _install_assets()
    {
        $this->enqueue->css_namespace( 'common_header' );
        $this->enqueue->css('login');
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

        $this->events->add_filter('install_current', function(){ return 'current'; });
        
		Polatan::set_title(sprintf(__('Welcome Page &mdash; %s'), get('app_name')));
        $data['page_name'] = 'install';
        $this->load->view('install/index', $data);
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

        $this->events->add_filter('install_current2', function(){ return 'current'; });

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
        $data['page_name'] = 'database';
        $this->load->view('install/index', $data);
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

        $this->events->add_filter('install_current3', function(){ return 'current'; });

        $this->events->do_action('settings_setup');
        $this->form_validation->set_rules('site_name', __('Site Name'), 'required');
        if ($this->form_validation->run()) 
        {
            $exec = $this->install_model->final_configuration();

            if ($exec == 'system-installed') 
            {                      
                // $data_about = file_get_contents(APPPATH . 'config/about.php');
                // $data_about = str_replace($this->config->item('app_name'), $this->input->post('site_name'), $data_about);
                // file_put_contents(APPPATH . 'config/about.php', $data_about);

                redirect('login?redirect=admin&notice=' . $exec . ( @$_GET[ 'lang' ] ? '&lang=' . $_GET[ 'lang' ] : '') );
            }

            $this->notice->push_notice_array($exec);
        }

        Polatan::set_title(sprintf(__('Site & Master account &mdash; %s'), get('core_signature')));
        $data['page_name'] = 'site';
        $this->load->view('install/index', $data);
    }
}
