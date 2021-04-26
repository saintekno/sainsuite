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

// Toolbar
if ( User::control('manage.core') ) : 
$this->events->add_filter('toolbar_filter', function ($filter) { 
    $filter[] = '<div class="row d-flex align-items-center">';
    if ($this->aauth->is_admin()):
    $filter[] = '
    <div class="col-auto col-sm-auto mb-1 mb-sm-0">
        <span class="switch switch-primary">
            <label data-toggle="tooltip" title="Developer mode">
                <input type="checkbox" '.$this->events->apply_filters('dashboard_dev_class', '').' id="dev_mode">
                <span></span>
            </label>
        </span>
    </div>';
    $filter[] = '
    <div class="col-auto col-sm-auto mb-1 mb-sm-0">
        <button class="btn btn-light-primary font-weight-bolder" 
            onclick="composeModal(\''.site_url(['admin', 'addons', 'install_zip']).'\', \''.__('Choose the addons zip file').'\')" >
            '.__('Add AddOns').'
        </button>
    </div>';
    endif;
    $filter[] = '</div>';

    return $filter;
});
endif;

$this->polatan->add_meta(array(
    'col_id' => 1,
    'class'     => 'col-12',
    'namespace' => 'addons'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->backend_view('addons/list_dom', array(), true )
), 'addons', 1);

$this->polatan->output();