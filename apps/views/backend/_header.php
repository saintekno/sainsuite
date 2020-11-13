<!--begin::Header-->
<div id="kt_header" class="header header-fixed d-none">
    <div class="container flex-wrap flex-sm-nowrap">
        <div class="navheader-nav nav flex-grow-1">
            <?php 
            foreach ($this->events->apply_filters('aside_menu', []) as $namespace) {
                Menu::add_aside_menu($namespace);
            }; 
            Menu::load_aside_menu();
            ?>
        </div>
    </div>
</div>
<!--end::Header-->