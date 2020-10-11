<?php

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'settings',
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->view('backend/settings/index_dom', array(), true )
), 'settings', 1);

$this->polatan->output();