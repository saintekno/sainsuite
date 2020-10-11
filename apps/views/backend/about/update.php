<?php

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'col_id' => 1,
    'namespace' => 'update'
));

$this->polatan->add_item(array(
    'type'    => 'dom',
    'content' => $this->load->view('backend/about/update_dom', array(
        'release' => $release,
        'update' => $update,
    ), true )
), 'update', 1);

$this->polatan->output();