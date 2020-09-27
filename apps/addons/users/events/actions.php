<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_Action extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        
        // $this->events->add_action( 'load_dashboard', [ $this, 'load_dashboard' ] );
        // $this->events->add_action( 'load_frontend', [ $this, 'load_frontend' ]  );
    }
}
new Users_Action;