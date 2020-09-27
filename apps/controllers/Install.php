<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        // checks if eracik is not installed
        if ($this->install_model->is_installed()):
            redirect('welcome?notice=database-installed' );
        endif;

        $data['title'] = (sprintf(__('Welcome Page &mdash; %s'), get('app_name')));
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
        // checks if eracik is not installed
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

            $this->notice->push_notice($this->lang->line($exec));
        }

        $data['title'] = (sprintf(__('Database config &mdash; %s'), get('app_name')));
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
        // checks if eracik is not installed
        if (! $this->install_model->is_installed()):
            redirect('install' . ( $_GET[ 'lang' ] ? '?lang=' . $_GET[ 'lang' ] : '') );
        endif;

        $this->events->do_action('settings_setup');
        
        $this->form_validation->set_rules('site_name', __('Site Name'), 'required');

        if ($this->form_validation->run()) 
        {
            $exec = $this->install_model->final_configuration();

            if ($exec == 'eracik-installed') 
            {                      
                // $data_about = file_get_contents(APPPATH . 'config/about.php');
                // $data_about = str_replace($this->config->item('app_name'), $this->input->post('site_name'), $data_about);
                // file_put_contents(APPPATH . 'config/about.php', $data_about);

                redirect('login?redirect=admin/index&notice=' . $exec . ( @$_GET[ 'lang' ] ? '&lang=' . $_GET[ 'lang' ] : '') );
            }

            $this->notice->push_notice($this->lang->line($exec));
        }

        $data['title'] = (sprintf(__('Site & Master account &mdash; %s'), get('app_name')));
        $data['page_name'] = 'site';
        $this->load->view('install/index', $data);
    }
}
