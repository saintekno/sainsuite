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
class Group_model extends CI_Model
{
    protected $table_name = 'group';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * add addkit
     * @return
     */
    public function add()
    {
        return 'created';
    }

    /**
     * edit addkit
     * @param int addkit id
     * @return
     */
    public function edit($id)
    {
        return 'updated';
    }

    /**
     * Delete addkit
     * @param int addkit id
     * @return
     */
    public function delete($id)
    {
        return 'deleted';
    }
}
