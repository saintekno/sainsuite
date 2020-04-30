<?php

$this->Gui->set_title(sprintf(__('Add a new extension &mdash; %s'), get('core_signature')));

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'col_id'    => 1,
    'title'     => __('Add new extension using ZIP file'),
    'type'      => 'box-default',
    'namespace' => 'installer_box',
    'footer'    => array(
        'submit' => array(
            'label' => __('Add the extension')
        )
    ),
    'custom'  => array(
        'action' => ''
    ),
    'gui_saver' => true
));

$this->Gui->add_item(array(
    'type'  => 'file-input',
    'label' => __('Choose the extension zip file'),
    'name'  => 'extension_zip'
), 'installer_box', 1);

$this->Gui->output();
