<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
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

/**
 * Heading 1
 */
$filed_heading1[] = array(
    'permission'  => 'manage.core',
    'type'  => 'text',
    'required'  => true,
    'label' => __('Site Name'),
    'name'  => 'site_name',
    'value' => set_value('site_name', $this->options_model->get('site_name')),
    'description' => 'Enter your site name'
);
$filed_heading1[] = array(
    'permission'  => 'manage.core',
    'type'  => 'textarea',
    'label' => __('Site Description'),
    'name'  => 'site_description',
    'value' => set_value('site_description', $this->options_model->get('site_description')),
    'description' => 'Enter your site description'
);
$filed_heading1[] = array(
    'type'    => 'select',
    'name'    => 'site_timezone',
    'label'   => __('Timezone'),
    'options' => $this->config->item('site_timezone'),
    'active'  => $this->options_model->get('site_timezone')
);
$filed_heading1[] = array(
    'type'    => 'select',
    'name'    => 'site_language',
    'label'   => __('Language'),
    'options' => $this->config->item('supported_languages'),
    'active'  => $this->options_model->get('site_language')
);
$items_heading1 = $filed_heading1;

/**
 * Heading 2
 */

$filed_heading2[] = array(
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
$items_heading2 = $this->events->apply_filters('load_advance_setting', $filed_heading2);

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
                'items' => $items_heading1
            )
        ],
        [
            'id' => 'heading2',
            'permission'  => 'manage.core',
            'heading'=> __('Advanced Settings'),
            'description' => 'Advanced settings, open register user',
            'body' => array(
                'items' => $items_heading2
            )
        ]
    )
), 'settings', 1);

$this->polatan->output();