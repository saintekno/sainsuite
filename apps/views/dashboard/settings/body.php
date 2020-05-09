<?php

$this->Gui->set_title(sprintf(__('Settings &mdash; %s'), get('core_signature')));

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'type'      => 'box',
    'title'     => __('General Settings'),
    'namespace' => 'general-settings',
    'col_id'    => 1,                        
    'gui_saver' => true,                     
    'footer'    => array(
        'submit'    => array(
            'label' => __('Save Settings')
        )
    ),
    'use_namespace' => false
));

$this->Gui->add_item(array(
    'type'        => 'text',
    'name'        => 'site_name',
    'label'       => __('Site Name'),
    'placeholder' => __('Enter your site name')
), 'general-settings', 1);

$this->Gui->add_item(array(
    'type'        => 'textarea',
    'name'        => 'site_description',
    'label'       => __('Site Description'),
    'placeholder' => __('Enter your site description')
), 'general-settings', 1);

$this->Gui->add_item(array(
    'type'        => 'select',
    'name'        => 'site_timezone',
    'label'       => __('Timezone'),
    'placeholder' => __('Enter your site timezone'),
    'options'     => $this->config->item('site_timezone')
), 'general-settings', 1);

// @since 4.0.5
$this->Gui->add_item(array(
    'type'        => 'select',
    'name'        => 'site_language',
    'label'       => __('Language'),
    'placeholder' => __('Choose a language'),
    'options'     => $this->config->item('supported_languages')
), 'general-settings', 1);

$this->events->do_action('register_general_settings_fields');

/**
 * Advanced Settings
 */

$this->Gui->col_width(2, 4);

$this->Gui->add_meta(array(
    'type'      => 'box',
    'title'     => __('Advanced Settings'),
    'namespace' => 'advanced-settings',
    'col_id'    => 2,                         
    'gui_saver' => true,                      
    'footer'    => array(
        'submit'    =>    array(
            'label' => __('Save Advanced')
        ),
    ),
    'use_namespace' => false
));

$this->Gui->add_item(array(
    'type'        => 'select',
    'name'        => 'site_registration',
    'label'       => __('Open registration'),
    'placeholder' => __('Open Registration ?'),
    'options'     => array(
        0 => __('No'),
        1 => __('Yes')
    )
), 'advanced-settings', 2);

$this->Gui->add_item(array(
    'type'    => 'select',
    'name'    => 'require_validation',
    'label'   => __('Require validation'),
    'options' => array(
        0 => __('No'),
        1 => __('Yes')
    ),
    'description' => __( 'Each new account will have to check the verification email in order to validate their account.' )
), 'advanced-settings', 2);

$this->Gui->add_item(array(
    'type'        => 'select',
    'name'        => 'webdev_mode',
    'label'       => __('Enable Developer mode ?'),
    'placeholder' => __('Enable developer mode'),
    'description' => __('Tools like module package will be enabled.'),
    'options'     => array(
        0 => __('No'),
        1 => __('Yes')
    )
), 'advanced-settings', 2);

$this->Gui->output();
