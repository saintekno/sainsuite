<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends Eracik_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $segments = $this->uri->segment_array();
        $this->events->do_action('load_frontend', $segments, $this->uri->uri_string() );
        $this->load->view('cover');
    }
}
