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

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'settings',
    'gui_saver' => true,
    'footer' => array(
        'submit' => array(
            'label' => __('Save Settings')
        )
    ),
    'type' => 'card'
));

$filed[] = array(
    'permission'  => 'manage.core',
    'type'    => 'select',
    'name'    => 'demo_mode',
    'label'   => __('Enable Demo ?'),
    'active'  => $this->options_model->get('demo_mode'),
    'options' => array(
        0 => __('No'),
        1 => __('Yes')
    ),
);
$filed[] = array(
    'permission'  => 'manage.core',
    'type'        => 'select',
    'name'        => 'webdev_mode',
    'label'       => __('Enable Developer mode ?'),
    'placeholder' => __('Enable developer mode'),
    'description' => __('Tools like module package will be enabled.'),
    'active'  => $this->options_model->get('webdev_mode'),
    'options'     => array(
        0 => __('No'),
        1 => __('Yes')
    )
);
$items = $this->events->apply_filters('load_advance_setting', $filed);

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'datepicker' => true,
    'accordion' => array(
        [
            'id' => 'heading1',
            'heading'=> __('General Settings'),
            'description' => 'Update your site name, description, language, and visibility..',
            'body' => array(
                'items' => array(
                    array(
                        'type'  => 'text',
                        'required'  => true,
                        'label' => __('Site Name'),
                        'name'  => 'site_name',
                        'value' => set_value('site_name', $this->options_model->get('site_name')),
                        'description' => 'Enter your site name'
                    ),
                    array(
                        'type'  => 'textarea',
                        'label' => __('Site Description'),
                        'name'  => 'site_description',
                        'value' => set_value('site_description', $this->options_model->get('site_description')),
                        'description' => 'Enter your site description'
                    ),
                    array(
                        'type'    => 'select',
                        'name'    => 'site_timezone',
                        'label'   => __('Timezone'),
                        'options' => $this->config->item('site_timezone'),
                        'active'  => $this->options_model->get('site_timezone')
                    ),
                    array(
                        'type'    => 'select',
                        'name'    => 'site_language',
                        'label'   => __('Language'),
                        'options' => $this->config->item('supported_languages'),
                        'active'  => $this->options_model->get('site_language')
                    )
                )
            )
        ],
        [
            'id' => 'heading2',
            'heading'=> __('Advanced Settings'),
            'description' => 'Advanced settings, open settings and developer mode',
            'body' => array(
                'items' => $items
            )
        ]
    )
), 'settings', 1);

$this->polatan->output();