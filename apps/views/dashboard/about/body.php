<?php
        
$this->Gui->set_title(sprintf(__('About &mdash; %s'), get('core_signature')));

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'col_id'    => 1,
    'type'      => 'unwrapped',
    'namespace' => 'about'
));

$this->load->library('markdown');
if (file_exists('about.md')) {
    $about = file_get_contents('about.md');
} else {
    $about = '###About file is unavailable.';
}

$this->Gui->add_item(array(
    'type'    => 'dom',
    'content' => get_instance()->markdown->parse($about)
), 'about', 1);

$this->Gui->output();
