<?php

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'about',
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->view('backend/about/index_dom', array(
        'check' => $check
    ), true )
), 'about', 1);

$this->polatan->output();