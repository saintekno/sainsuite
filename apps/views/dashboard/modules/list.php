<?php

$this->Gui->set_title(sprintf(__('Module List &mdash; %s'), get('core_signature')));

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'col_id'    => 1,
    'type'      => 'unwrapped',
    'namespace' => 'module_list'
));

$this->Gui->add_item(array(
    'type'      => 'dom',
    'content'   => $this->load->view('dashboard/modules/list-dom', array(), true),
), 'module_list', 1);

$this->Gui->output();