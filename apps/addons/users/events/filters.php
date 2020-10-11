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
        $this->events->add_filter('custom_user_meta', array( $this, 'custom_user_meta' ), 10, 1);
    }
    
    /**
    * Adds custom meta for user
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function custom_user_meta($fields)
    {
        $fields[ 'first-name' ] = ($fname = $this->input->post('first-name')) ? $fname : '';
        $fields[ 'last-name' ] = ($lname = $this->input->post('last-name')) ? $lname : '';
        $fields[ 'theme-skin' ] = ($skin = $this->input->post('theme-skin')) ? $skin : 'skin-blue';
        return $fields;
    }
}
new Users_Filters;