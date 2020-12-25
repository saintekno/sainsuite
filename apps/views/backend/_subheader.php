<div class="subheader py-2 subheader-<?php echo $this->events->apply_filters('ui_subheader_body', 'solid d-none') ;?>" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        <div class="d-flex align-items-center flex-wrap mr-2">
            <h3 class="page-title font-weight-bold my-1 mr-3">
                <?php echo str_replace('&mdash; ' . get('signature'), '', Polatan::get_title());?> 
            </h3>

            <ul class="d-none d-md-flex breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <?php echo (isset($breadcrumbs)) ? $breadcrumbs : ''; ?>
            </ul>
        </div>

        <div class="d-flex align-items-center toolbar_menu">
            <?php echo $this->events->apply_filters('ui_subheader_search', ''); ?>

            <?php 
            foreach ($this->events->apply_filters('toolbar_menu', []) as $namespace) {
                Menu::add_toolbar_menu($namespace);
            }; 
            Menu::load_toolbar_menu();
            ?>
        </div>
    </div>
</div>

<?php if (function_exists('validation_errors')) {
    if (validation_errors()) : ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <?php echo strip_tags(validation_errors())?>
        </div>
    </div>
    <?php endif; ?>
<?php } ?>
<?php if ($this->notice->output_notice(true)):?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <?php echo $this->notice->output_notice();?>
        </div>
    </div>
<?php endif;?>
<?php if (notice_from_url() != ""):?>
    <div class="container">
        <div class="alert alert-success" role="alert">
            <?php echo notice_from_url();?>
        </div>
    </div>
<?php endif;?>