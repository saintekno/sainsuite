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

$this->polatan->add_meta(array(
    'col_id' => 1,
    'class'     => 'col-12',
    'namespace' => 'settings',
    'gui_saver' => true,
    'type' => 'card'
));

/**
 * Heading 1
 */
$filed_heading1[] = array(
    [
        'permission'  => 'manage.core',
        'type'  => 'text',
        'class'  => 'col-12 col-lg-6',
        'required'  => true,
        'label' => __('Site Name'),
        'name'  => 'site_name',
        'value' => set_value('site_name', $this->options_model->get('site_name')),
        'description' => 'Enter your site name'
    ],
    [
        'permission'  => 'manage.core',
        'type'  => 'text',
        'class'  => 'col-12 col-lg-6',
        'label' => __('Site Title'),
        'name'  => 'site_title',
        'value' => set_value('site_title', $this->options_model->get('site_title')),
        'description' => 'Enter your site title'
    ]
);
$filed_heading1[] = array(
    [
        'permission'  => 'manage.core',
        'type'  => 'textarea',
        'class'  => 'col-12 col-lg-6',
        'label' => __('Site Description'),
        'name'  => 'site_description',
        'value' => set_value('site_description', $this->options_model->get('site_description')),
        'description' => 'Enter your site description'
    ],
    [
        'permission'  => 'manage.core',
        'type'  => 'textarea',
        'class'  => 'col-12 col-lg-6',
        'label' => __('Site Keywords'),
        'name'  => 'site_keywords',
        'value' => set_value('site_keywords', $this->options_model->get('site_keywords')),
        'description' => 'Enter your site keywords'
    ]
);
$filed_heading1[] = array(
    [
        'type'    => 'select',
        'name'    => 'site_timezone',
        'class'  => 'col-12 col-lg-6',
        'label'   => __('Timezone'),
        'options' => $this->config->item('site_timezone'),
        'active'  => $this->options_model->get('site_timezone')
    ],
    [
        'type'    => 'select',
        'name'    => 'site_language',
        'class'  => 'col-12 col-lg-6',
        'label'   => __('Language'),
        'options' => $this->config->item('supported_languages'),
        'active'  => $this->options_model->get('site_language')
    ]
);
$items_heading1 = $this->events->apply_filters('load_general_setting', $filed_heading1);

/**
 * Heading 2
 */
$filed_heading2[] = array(
    [
        'permission'  => 'manage.core',
        'type'    => 'select',
        'class'  => 'col-12 col-lg-6',
        'name'    => 'demo_mode',
        'label'   => __('Enable Demo ?'),
        'active'  => $this->options_model->get('demo_mode'),
        'options' => array(
            0 => __('No'),
            1 => __('Yes')
        ),
    ],
    [
        'permission'  => 'manage.core',
        'type'    => 'select',
        'class'  => 'col-12 col-lg-6',
        'name'    => 'enable_frontend',
        'label'   => __('Enable Frontend ?'),
        'active'  => $this->options_model->get('enable_frontend'),
        'options' => array(
            0 => __('No'),
            1 => __('Yes')
        ),
    ]
);
$items_heading2 = $this->events->apply_filters('load_advance_setting', $filed_heading2);

/**
 * Items
 */
$item[] = array(
    'id' => 1,
    'heading'=> __('General Settings'),
    'description' => 'Update your site name, description, language, and visibility..',
    'body' => array(
        'items' => $items_heading1
    )
);
$item[] = array(
    'id' => 2,
    'permission'  => 'manage.core',
    'heading'=> __('Advanced Settings'),
    'description' => 'Advanced settings, open register user',
    'body' => array(
        'items' => $items_heading2
    )
);
$items = $this->events->apply_filters('load_items_setting', $item);

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'accordions',
    'accordion' => $items
), 'settings', 1);

$this->polatan->output();