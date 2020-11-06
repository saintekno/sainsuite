<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupsHomeController extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read()
    {
        $this->polatan->output();
    }
}