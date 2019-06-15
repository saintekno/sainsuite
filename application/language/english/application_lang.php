<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.1
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Application language file (English)
 *
 * Localization strings
 *
 * @package Application\Language\English
 */

//------------------------------------------------------------------------------
// ! GENERAL SETTINGS
//------------------------------------------------------------------------------
$lang['rp_site_name'] = 'Site Name';
$lang['rp_site_email'] = 'Site Email';
$lang['rp_site_email_help'] = 'The administrator contact email address. Additionally, if the Emailer System Email setting is not configured, system-generated emails may be sent from this address.';
$lang['rp_site_status'] = 'Site Status';
$lang['rp_online'] = 'Online';
$lang['rp_offline'] = 'Offline';
$lang['rp_top_number'] = 'Items <em>per</em> page:';
$lang['rp_top_number_help'] = 'When viewing reports, how many items should be listed at a time?';
$lang['rp_home'] = 'Home';
$lang['rp_site_information'] = 'Site Information';
$lang['rp_timezone'] = 'Timezone';
$lang['rp_language'] = 'Language';
$lang['rp_language_help'] = 'Choose the languages available to the user.';

//------------------------------------------------------------------------------
// ! AUTH SETTINGS
//------------------------------------------------------------------------------
$lang['rp_security'] = 'Security';
$lang['rp_login_type'] = 'Login Type';
$lang['rp_login_type_email'] = 'Email Only';
$lang['rp_login_type_username'] = 'Username Only';
$lang['rp_allow_register'] = 'Allow User Registrations?';
$lang['rp_login_type_both'] = 'Email or Username';
$lang['rp_use_usernames'] = 'User display across racik:';
$lang['rp_use_own_name'] = 'Use Own Name';
$lang['rp_allow_remember'] = 'Allow \'Remember Me\'?';
$lang['rp_remember_time'] = 'Remember Users For';
$lang['rp_week'] = 'Week';
$lang['rp_weeks'] = 'Weeks';
$lang['rp_days'] = 'Days';
$lang['rp_username'] = 'Username';
$lang['rp_password'] = 'Password';
$lang['rp_password_confirm'] = 'Password (again)';
$lang['rp_display_name'] = 'Display Name';

//------------------------------------------------------------------------------
// ! CRUD SETTINGS
//------------------------------------------------------------------------------
$lang['rp_home_page'] = 'Home Page';
$lang['rp_pages'] = 'Pages';
$lang['rp_enable_rte'] = 'Enable RTE for pages?';
$lang['rp_rte_type'] = 'RTE Type';
$lang['rp_searchable_default'] = 'Searchable by default?';
$lang['rp_cacheable_default'] = 'Cacheable by default?';
$lang['rp_track_hits'] = 'Track Page Hits?';

$lang['rp_action_save'] = 'Save';
$lang['rp_action_delete'] = 'Delete';
$lang['rp_action_edit'] = 'Edit';
$lang['rp_action_undo'] = 'Undo';
$lang['rp_action_cancel'] = 'Cancel';
$lang['rp_action_download'] = 'Download';
$lang['rp_action_preview'] = 'Preview';
$lang['rp_action_search'] = 'Search';
$lang['rp_action_purge'] = 'Purge';
$lang['rp_action_restore'] = 'Restore';
$lang['rp_action_show'] = 'Show';
$lang['rp_action_login'] = 'Sign In';
$lang['rp_action_logout'] = 'Sign Out';
$lang['rp_actions'] = 'Actions';
$lang['rp_clear'] = 'Clear';
$lang['rp_action_list'] = 'List';
$lang['rp_action_create'] = 'Create';
$lang['rp_action_ban'] = 'Ban';

//------------------------------------------------------------------------------
// ! SETTINGS LIB
//------------------------------------------------------------------------------
$lang['rp_ext_profile_show'] = 'Does User accounts have extended profile?';
$lang['rp_ext_profile_info'] = 'Check "Extended Profiles" to have extra profile meta-data available option(wip), omiting some default racik fields (eg: address).';

$lang['rp_yes'] = 'Yes';
$lang['rp_no'] = 'No';
$lang['rp_none'] = 'None';
$lang['rp_id'] = 'ID';

$lang['rp_or'] = 'or';
$lang['rp_size'] = 'Size';
$lang['rp_files'] = 'Files';
$lang['rp_file'] = 'File';

$lang['rp_with_selected'] = 'With selected';

$lang['rp_env_dev'] = 'Development';
$lang['rp_env_test'] = 'Testing';
$lang['rp_env_prod'] = 'Production';

$lang['rp_show_profiler'] = 'Show Admin Profiler?';
$lang['rp_show_front_profiler'] = 'Show Front End Profiler?';

$lang['rp_cache_not_writable'] = 'The application cache folder is not writable';

$lang['rp_password_strength'] = 'Password Strength Settings';
$lang['rp_password_length_help'] = 'Minimum password length e.g. 8';
$lang['rp_password_force_numbers'] = 'Should password force numbers?';
$lang['rp_password_force_symbols'] = 'Should password force symbols?';
$lang['rp_password_force_mixed_case'] = 'Should password force mixed case?';
$lang['rp_password_show_labels'] = 'Display password validation labels';
$lang['rp_password_iterations_note'] = 'Higher values increase the security and the time taken to hash the passwords.<br/>See the <a href="http://www.openwall.com/phpass/" target="blank">phpass page</a> for more information. If in doubt, leave at 8.';

//------------------------------------------------------------------------------
// ! USER/PROFILE
//------------------------------------------------------------------------------
$lang['rp_user'] = 'User';
$lang['rp_users'] = 'Users';
$lang['rp_description'] = 'Description';
$lang['rp_email'] = 'Email';
$lang['rp_user_settings'] = 'My Profile';
$lang['rp_select_state'] = 'Select State';
$lang['rp_select_no_state'] = 'No State Available';

//------------------------------------------------------------------------------
// !
//------------------------------------------------------------------------------
$lang['rp_both'] = 'both';
$lang['rp_go_back'] = 'Go Back';
$lang['rp_new'] = 'New';
$lang['rp_required_note'] = 'Required fields are in <b>bold</b>.';
$lang['rp_form_label_required'] = '<span class="required">*</span>';

//------------------------------------------------------------------------------
// rp_Model
//------------------------------------------------------------------------------
$lang['rp_model_db_error'] = 'DB Error: %s';
$lang['rp_model_no_data'] = 'No data available.';
$lang['rp_model_invalid_id'] = 'Invalid ID passed to model.';
$lang['rp_model_no_table'] = 'Model has unspecified database table.';
$lang['rp_model_fetch_error'] = 'Not enough information to fetch field.';
$lang['rp_model_count_error'] = 'Not enough information to count results.';
$lang['rp_model_unique_error'] = 'Not enough information to check uniqueness.';
$lang['rp_model_find_error'] = 'Not enough information to find by.';

//------------------------------------------------------------------------------
// Contexts
//------------------------------------------------------------------------------
$lang['rp_no_contexts'] = 'The contexts array is not properly setup. Check your application config file.';
$lang['rp_context_content'] = 'Content';
$lang['rp_context_reports'] = 'Reports';
$lang['rp_context_settings'] = 'Settings';
$lang['rp_context_developer'] = 'Developer';

//------------------------------------------------------------------------------
// Activities
//------------------------------------------------------------------------------
$lang['rp_act_settings_saved'] = 'App settings saved from';
$lang['rp_unauthorized_attempt'] = 'unsuccessfully attempted to access a page which required the following permission "%s" from ';

$lang['rp_keyboard_shortcuts'] = 'Available keyboard shortcuts:';
$lang['rp_keyboard_shortcuts_none'] = 'There are no keyboard shortcuts assigned.';
$lang['rp_keyboard_shortcuts_edit'] = 'Update the keyboard shortcuts';

//------------------------------------------------------------------------------
// Common
//------------------------------------------------------------------------------
$lang['rp_question_mark'] = '?';
$lang['rp_language_direction'] = 'ltr';
$lang['rp_name'] = 'Name';
$lang['rp_status'] = 'Status';

//------------------------------------------------------------------------------
// Login
//------------------------------------------------------------------------------
$lang['rp_action_register'] = 'Sign Up';
$lang['rp_forgot_password'] = 'Forgot your password?';
$lang['rp_remember_me'] = 'Remember me';

//------------------------------------------------------------------------------
// Password Help Fields to be used as a warning on register
//------------------------------------------------------------------------------
$lang['rp_password_number_required_help'] = 'Password must contain at least 1 number.';
$lang['rp_password_caps_required_help'] = 'Password must contain at least 1 capital letter.';
$lang['rp_password_symbols_required_help'] = 'Password must contain at least 1 symbol.';

$lang['rp_password_min_length_help'] = 'Password must be at least %s characters long.';
$lang['rp_password_length'] = 'Password Length';

//------------------------------------------------------------------------------
// Activation
//------------------------------------------------------------------------------
$lang['rp_activate_method'] = 'Activation Method';
$lang['rp_activate_none'] = 'None';
$lang['rp_activate_email'] = 'Email';
$lang['rp_activate_admin'] = 'Admin';
$lang['rp_activate'] = 'Activate';
$lang['rp_activate_resend'] = 'Resend Activation';

$lang['rp_reg_complete_error'] = 'An error occurred completing your registration. Please try again or contact the site administrator for help.';
$lang['rp_reg_activate_email'] = 'An email containing your activation code has been sent to [EMAIL].';
$lang['rp_reg_activate_admin'] = 'You will be notified when the site administrator has approved your membership.';
$lang['rp_reg_activate_none'] = 'Please login to begin using the site.';
$lang['rp_user_not_active'] = 'User account is not active.';
$lang['rp_login_activate_title'] = 'Need to activate your account?';
$lang['rp_login_activate_email'] = '<b>Have an activation code to enter to activate your membership?</b> Enter it on the [ACCOUNT_ACTIVATE_URL] page.<br /><br />    <b>Need your code again?</b> Request it again on the [ACTIVATE_RESEND_URL] page.';

//------------------------------------------------------------------------------
// Profiler Template
//------------------------------------------------------------------------------
$lang['rp_profiler_box_benchmarks'] = 'Benchmarks';
$lang['rp_profiler_box_console'] = 'Console';
$lang['rp_profiler_box_files'] = 'Files';
$lang['rp_profiler_box_memory'] = 'Memory Usage';
$lang['rp_profiler_box_queries'] = 'Queries';
$lang['rp_profiler_box_session'] = 'Session User Data';

$lang['rp_profiler_menu_console'] = 'Console';
$lang['rp_profiler_menu_files'] = 'Files';
$lang['rp_profiler_menu_memory'] = 'Memory Used';
$lang['rp_profiler_menu_memory_mb'] = 'MB';
$lang['rp_profiler_menu_queries'] = 'Queries';
$lang['rp_profiler_menu_queries_db'] = 'Database';
$lang['rp_profiler_menu_time'] = 'Load Time';
$lang['rp_profiler_menu_time_ms'] = 'ms';
$lang['rp_profiler_menu_time_s'] = 's';
$lang['rp_profiler_menu_vars'] = '<span>vars</span> &amp; Config';

$lang['rp_profiler_true'] = 'true';
$lang['rp_profiler_false'] = 'false';

//------------------------------------------------------------------------------
// Form Validation
//------------------------------------------------------------------------------
$lang['rp_form_allowed_types'] = '%s must contain one of the allowed selections.';
$lang['rp_form_allowed_types_none'] = 'Configuration Error: No valid types available for the %s field.';
$lang['rp_form_alpha_extra'] = 'The %s field may only contain alpha-numeric characters, spaces, periods, underscores, and dashes.';
$lang['rp_form_matches_pattern'] = 'The %s field does not match the required pattern.';
$lang['rp_form_max_file_size'] = 'The file in %s field must not exceed {max_size}';
$lang['rp_form_one_of'] = '%s must contain one of the available selections.';
$lang['rp_form_one_of_none'] = 'Configuration Error: No valid values available for the %s field.';
$lang['rp_form_unique'] = 'The value in &quot;%s&quot; is already being used.';
$lang['rp_form_valid_password'] = 'The %s field must be at least {min_length} characters long.';
$lang['rp_form_valid_password_nums'] = '%s must contain at least 1 number.';
$lang['rp_form_valid_password_syms'] = '%s must contain at least 1 punctuation mark.';
$lang['rp_form_valid_password_mixed_1'] = '%s must contain at least 1 uppercase characters.';
$lang['rp_form_valid_password_mixed_2'] = '%s must contain at least 1 lowercase characters.';

$lang['rp_form_valid_url'] = '%s must contain a valid URL.';

//------------------------------------------------------------------------------
// Menu Strings - feel free to add your own custom modules here
// if you want to localize your menus
//------------------------------------------------------------------------------
$lang['rp_menu_activities'] = 'Activities';
$lang['rp_menu_code_builder'] = 'Code Builder';
$lang['rp_menu_db_tools'] = 'Database Tools';
$lang['rp_menu_db_maintenance'] = 'Maintenance';
$lang['rp_menu_db_backup'] = 'Backups';
$lang['rp_menu_emailer'] = 'Email Queue';
$lang['rp_menu_email_settings'] = 'Settings';
$lang['rp_menu_email_template'] = 'Template';
$lang['rp_menu_email_queue'] = 'View Queue';
$lang['rp_menu_kb_shortcuts'] = 'Keyboard Shortcuts';
$lang['rp_menu_logs'] = 'Logs';
$lang['rp_menu_migrations'] = 'Migrations';
$lang['rp_menu_permissions'] = 'Permissions';
$lang['rp_menu_queue'] = 'Queue';
$lang['rp_menu_roles'] = 'Roles';
$lang['rp_menu_settings'] = 'Settings';
$lang['rp_menu_sysinfo'] = 'System Information';
$lang['rp_menu_template'] = 'Template';
$lang['rp_menu_translate'] = 'Translate';
$lang['rp_menu_users'] = 'Users';

//------------------------------------------------------------------------------
// Anything that doesn't follow the 'rp_*' convention:
//------------------------------------------------------------------------------
$lang['log_intro'] = 'These are your log messages';

//------------------------------------------------------------------------------
// User Meta examples
//------------------------------------------------------------------------------
$lang['user_meta_street_name'] = 'Street Name';
$lang['user_meta_type'] = 'Type';
$lang['user_meta_country'] = 'Country';
$lang['user_meta_state'] = 'State';

//------------------------------------------------------------------------------
// Migrations lib
//------------------------------------------------------------------------------
$lang['no_migrations_found'] = 'No migration files were found';
$lang['multiple_migrations_version'] = 'Multiple migrations version: %d';
$lang['multiple_migrations_name'] = 'Multiple migrations name: %s';
$lang['migration_class_doesnt_exist'] = 'Migration class does not exist: %s';
$lang['wrong_migration_interface'] = 'Wrong migration interface: %s';
$lang['invalid_migration_filename'] = 'Wrong migration filename: %s - %s';

//------------------------------------------------------------------------------
// Blog
//------------------------------------------------------------------------------
$lang['blog_post'] = 'Blog';