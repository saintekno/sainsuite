<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_Filters extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        
        // $this->events->add_filter( 'signin_logo', [ $this->filters, 'signin_logo' ] );
        // $this->events->add_filter( 'dashboard_footer_right', [ $this->filters, 'dashboard_footer_right' ] );
        // $this->events->add_filter( 'dashboard_footer_text', [ $this->filters, 'dashboard_footer_text' ] );
    }
}
new Users_Filters;