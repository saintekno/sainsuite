<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.2
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * The controller which handles installation of Racik.
 *
 * @package Racik\Controllers\Install
 */
class Install extends CI_Controller
{
    /** @var string The minimum PHP version required to use Racik. */
    protected $minVersionPhp = '5.4';

    /**
     * Initialize the installer.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Load the basics since Base_Controller is not used here.
        $this->lang->load('application');

        // Make sure the template library doesn't try to use sessions.
        $this->load->library('template');
        Template::setSessionUse(false);

        $this->load->library('assets');
        $this->load->library('events');

        $this->load->helper('application');

        // Disable hooks, since they may rely on an installed environment.
        get_instance()->hooks->enabled = false;

        // Load the Installer library.
        $this->lang->load('install');
        $this->load->library('installer');
    }

    /**
     * Get some basic information about the environment before installation.
     *
     * @return void
     */
    public function index()
    {
        if ($this->installer->is_installed()) {
            $this->load->library('users/auth');
            $this->load->library('settings/settings_lib');
        }

        $data = array();
        $data['curl_enabled']    = $this->installer->cURL_enabled();
        $data['files']           = $this->installer->check_files();
        $data['folders']         = $this->installer->check_folders();
        $data['php_acceptable']  = $this->installer->php_acceptable($this->minVersionPhp);
        $data['php_min_version'] = $this->minVersionPhp;
        $data['php_version']     = $this->installer->php_version;

        Template::set($data);
        Template::render('install');
    }

    /**
     * Handle the basic installation of the migrations into the database, if available,
     * and display the current status.
     *
     * @return void
     */
    public function do_install()
    {
        // Make sure the application is not installed already, otherwise attackers
        // could take advantage and recreate the admin account.
        if ($this->installer->is_installed()) {
            show_error('This application has already been installed. Cannot install again.');
        }

        // Does the database table even exist?
        if ($this->installer->db_settings_exist === false) {
            show_error(lang('in_need_db_settings'));
        }

        // If setup fails, it will return an error message.
        if ($this->installer->setup() === true) {
            define('RP_DID_INSTALL', true);
        }

        Template::render('install');
    }
}
