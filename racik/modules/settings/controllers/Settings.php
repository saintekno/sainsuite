<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * An open source project to allow developers to Starter Web App of CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.2
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Settings Module
 *
 * Allows the user to management the preferences for the site.
 * 
 */
class Settings extends Admin_Controller
{
    private $permissionDevView = 'Site.Developer.View';
    private $permissionView    = 'Racik.Settings.View';
    private $permissionManage  = 'Racik.Settings.Manage';

    /**
     * Sets up the permissions and loads required classes
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Restrict access - View and Manage.
        $this->auth->restrict($this->permissionView);
        $this->auth->restrict($this->permissionManage);

        $this->lang->load('settings');
        if (! class_exists('settings_lib', false)) {
            $this->load->library('settings/settings_lib');
        }

        Assets::add_module_js('settings', 'js/settings.js');

        Template::set('toolbar_title', 'Site Settings');
    }

    /**
     * Display a form with various site settings including site name and
     * registration settings
     *
     * @return void
     */
    public function index()
    {
        $this->load->config('extended_settings');
        $extended_settings = config_item('extended_settings_fields');

        if (isset($_POST['save'])) {
            if ($this->saveSettings($extended_settings)) {
                Template::set_message(lang('settings_saved_success'), 'success');
            } else {
                Template::set_message(lang('settings_error_success'), 'error');
                $settingsError = $this->settings_lib->getError();
                if ($settingsError) {
                    Template::set_message($settingsError, 'error');
                }
            }
            redirect(SITE_AREA . '/settings/settings');
        }

        // Read the current settings
        $settings = $this->settings_lib->find_all();

        // Get the available languages
        $this->load->helper('translate/languages');

        Template::set_view('settings/settings/index');

        Template::set('extended_settings', $extended_settings);
        Template::set('languages', list_languages());
        Template::set('selected_languages', unserialize($settings['site.languages']));
        Template::set('settings', $settings);
        Template::set('showDeveloperTab', $this->auth->has_permission($this->permissionDevView));

        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Perform form validation and save the settings to the database
     *
     * @param array $extended_settings An optional array of settings stored in the
     * extended_settings config file.
     *
     * @return boolean False on error, true when settings are successfully saved.
     */
    private function saveSettings($extended_settings = array())
    {
        $this->form_validation->set_rules('title', 'lang:rp_site_name', 'required|trim');
        $this->form_validation->set_rules('system_email', 'lang:rp_site_email', 'required|trim|valid_email');
        $this->form_validation->set_rules('offline_reason', 'lang:settings_offline_reason', 'trim');
        $this->form_validation->set_rules('list_limit', 'lang:settings_list_limit', 'required|trim|numeric');
        $this->form_validation->set_rules('password_min_length', 'lang:rp_password_length', 'required|trim|numeric');
        $this->form_validation->set_rules('password_force_numbers', 'lang:rp_password_force_numbers', 'trim|numeric');
        $this->form_validation->set_rules('password_force_symbols', 'lang:rp_password_force_symbols', 'trim|numeric');
        $this->form_validation->set_rules('password_force_mixed_case', 'lang:rp_password_force_mixed_case', 'trim|numeric');
        $this->form_validation->set_rules('password_show_labels', 'lang:rp_password_show_labels', 'trim|numeric');
        $this->form_validation->set_rules('languages[]', 'lang:rp_language', 'required|trim');

        // Setup the validation rules for any extended settings
        $extended_data = array();
        foreach ($extended_settings as $field) {
            if (empty($field['permission']) || has_permission($field['permission'])) {
                $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);
                $extended_data["ext.{$field['name']}"] = $this->input->post($field['name']);
            }
        }

        if ($this->form_validation->run() === false) {
            return false;
        }

        $data = array(
            array('name' => 'site.title', 'value' => $this->input->post('title')),
            array('name' => 'site.system_email', 'value' => $this->input->post('system_email')),
            array('name' => 'site.status', 'value' => $this->input->post('status')),
            array('name' => 'site.offline_reason', 'value' => $this->input->post('offline_reason')),
            array('name' => 'site.list_limit', 'value' => $this->input->post('list_limit')),

            array('name' => 'auth.allow_register', 'value' => $this->input->post('allow_register') ? 1 : 0),
            array('name' => 'auth.user_activation_method', 'value' => $this->input->post('user_activation_method') ?: 0),
            array('name' => 'auth.login_type', 'value' => $this->input->post('login_type')),
            array('name' => 'auth.use_usernames', 'value' => $this->input->post('use_usernames') ?: 0),
            array('name' => 'auth.allow_remember', 'value' => $this->input->post('allow_remember') ? 1 : 0),
            array('name' => 'auth.remember_length', 'value' => (int) $this->input->post('remember_length')),
            array('name' => 'auth.use_extended_profile', 'value' => $this->input->post('use_ext_profile') ? 1 : 0),
            array('name' => 'auth.allow_name_change', 'value' => $this->input->post('allow_name_change') ? 1 : 0),
            array('name' => 'auth.name_change_frequency', 'value' => $this->input->post('name_change_frequency')),
            array('name' => 'auth.name_change_limit', 'value' => $this->input->post('name_change_limit')),
            array('name' => 'auth.password_min_length', 'value' => $this->input->post('password_min_length')),
            array('name' => 'auth.password_force_numbers', 'value' => $this->input->post('password_force_numbers') ? 1 : 0),
            array('name' => 'auth.password_force_symbols', 'value' => $this->input->post('password_force_symbols') ? 1 : 0),
            array('name' => 'auth.password_force_mixed_case', 'value' => $this->input->post('password_force_mixed_case') ? 1 : 0),
            array('name' => 'auth.password_show_labels', 'value' => $this->input->post('password_show_labels') ? 1 : 0),
            array('name' => 'password_iterations', 'value' => $this->input->post('password_iterations')),

            array('name' => 'site.show_profiler', 'value' => $this->input->post('show_profiler') ? 1 : 0),
            array('name' => 'site.show_front_profiler', 'value' => $this->input->post('show_front_profiler') ? 1 : 0),
            array(
                'name'  => 'site.languages',
                'value' => $this->input->post('languages') != '' ? serialize($this->input->post('languages')) : ''
            ),
        );

        log_activity(
            $this->auth->user_id(),
            lang('rp_act_settings_saved') . ': ' . $this->input->ip_address(),
            'core'
        );

        // Save the settings to the DB.
        $updated = $this->settings_lib->update_batch($data);

        // If the update was successful and there are extended settings to save...
        if ($updated && ! empty($extended_data)) {
            // Save them.
            $updated = $this->saveExtendedSettings($extended_data);
        }

        return $updated;
    }

    /**
     * Save the extended settings.
     *
     * @param array $extended_data An array of settings to save.
     *
     * @return boolean/integer An inserted id or true if all settings saved successfully,
     * else false.
     */
    private function saveExtendedSettings($extended_data)
    {
        if (empty($extended_data) || ! is_array($extended_data)) {
            return false;
        }

        $result = true;
        foreach ($extended_data as $key => $value) {
            $setting = $this->settings_lib->set($key, $value);
            if ($setting === false) {
                // Continue attempting to save extended settings, but return false
                // even if only one setting failed to save.
                $result = false;
            }
        }

        return $result;
    }
}
/* end /Racik/modules/settings/controllers/settings.php */
