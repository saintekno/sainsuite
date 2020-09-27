<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersHomeController extends CI_Model
{
    public function index()
    {
		Html::set_title(__( 'Users', 'users' ));
        
        $data['page_name'] = $this->load->view( 'backend/home', null, true );
		$this->load->view('backend/index', $data);
    }
    
    public function profile()
    {
		Html::set_title(__( 'Profile', 'users' ));
        
        $data['page_name'] = $this->load->view( 'backend/home', null, true );
		$this->load->view('backend/index', $data);
    }
}
