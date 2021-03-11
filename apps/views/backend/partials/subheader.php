<!--begin::Subheader-->
<div class="subheader subheader-transparent d-none" id="kt_subheader">
    <div class="container">
        <div class="subheader-wrap py-4 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">  
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <?php if ($this->events->apply_filters('kt_subheader_mobile_toggle', '')) : ?>
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <?php endif; ?>

                <!--begin::Page Title-->
                <h3 class="page-title font-weight-bold mt-2 mb-2 mr-5"> 
                <?php echo str_replace('&mdash; ' . get('signature'), '', Polatan::get_title());?>
                </h3>
                <!--end::Page Title-->

                <!--begin::Breadcrumb-->
                <?php if(isset($breadcrumbs)) { echo $this->menus_model->breadcrumb_nav($breadcrumbs); } ?>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center toolbar_menu">
            <?php 
            foreach ($this->events->apply_filters('toolbar_filter', []) as $key => $value) {
                echo $value;
            }; ?>
            <?php echo $this->menus_model->toolbar_nav();?>
            </div>
            <!--end::Toolbar-->
        </div>  
    </div>
</div>
