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
$this->events->add_filter( 'toolbar_menu', function( $final ) {
    if ( User::control('install.themes')) :
    $final[] = array(
        'title'   => __('Add themes'),
        'icon'    => 'ki ki-plus',
        'button'  => 'btn-light-primary',
        'attr'    => 'data-toggle="modal" data-target="#kt_theme_frontend"',
        'href'    => 'javascript:void(0)',
    );
    endif;

    return $final;
});

$this->events->add_filter('toolbar_filter', function () { 
    if ($this->aauth->is_admin()):
    global $Options;
    $check = (intval(riake('webdev_mode', $Options))) ? 'checked="checked"' : '';
    $filter[] = '
        <label class="col-form-label mr-2">Developer mode</label>
        <form class="form" 
            id="web_mode"
            action="'.site_url(array( 'admin', 'options', 'ajax' )).'" 
            method="post"> 
            <div class="row">
                <div class="col-3">
                    <span class="switch switch-primary">
                        <label>
                            <input type="checkbox" 
                                '.$check.' name="webdev_mode">
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
        </form>';
    endif;

    $filter[] = '
    <div class="dropdown" data-toggle="tooltip" title="Sort">
        <span class="btn btn-light-primary btn-icon btn-sm ml-2" data-toggle="dropdown">
            <i class="flaticon2-console icon-1x"></i>
        </span>
        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
            <ul class="navi py-3">
                <li class="navi-item">
                    <a href="#" class="navi-link active">
                        <span class="navi-text">Free</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="navi-text">Premium</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>';

    return $filter;
});

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'theme'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->backend_view('theme/list_dom', array(), true )
), 'theme', 1);

$this->events->add_action( 'dashboard_footer', function() {
    $this->load->backend_view( 'theme/list_script' );
});

$this->polatan->output();