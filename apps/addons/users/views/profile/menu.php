<!--begin::Nav-->
<?php 
foreach ($this->events->apply_filters('aside_menu', []) as $namespace) {
    Menu::add_aside_menu($namespace);
}; 
Menu::load_aside_menu();
?>
<!--end::Nav-->