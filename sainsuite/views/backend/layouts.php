<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<HTML>
<!-- begin::Head -->
<HEAD>
    <!-- begin::Meta -->
    <?php $this->load->backend_view( 'partials/metas.php' );?>
    <!-- end::Meta -->
    <!-- begin::Layout Themes -->
    <?php $this->events->do_action( 'do_dashboard_header' );?>
    <!--end::Layout Themes-->
</HEAD>
<!-- end::Head -->
<!-- begin::Body -->
<BODY id="kt_body" 
    class="header-mobile-fixed aside-enabled aside-fixed aside-minimize subheader-enabled subheader-transparent 
    <?php echo xss_clean($this->events->apply_filters('fill_skin_class', 'skin-dark'));?>" 
    <?php echo xss_clean($this->events->apply_filters('fill_body_attrs', 'ng-app="SainSuite"'));?>>
    <!-- begin::Main -->
    <!-- beign::Header Mobile -->
    <?php include('partials/header-mobile.php'); ?>
    <!-- end::Header Mobile -->
    <div class="d-flex flex-column flex-root">
        <!-- begin::Page -->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <?php include('partials/aside.php');?>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid min-vh-100 wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <?php include('partials/header.php'); ?>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <?php include('partials/subheader.php'); ?>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <?php include('partials/content.php'); ?>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <?php include('partials/footer.php'); ?>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!-- end::Page -->
    </div>
    <!-- end::Main -->
    <!-- begin::Modal -->
    <?php include('partials/modal.php'); ?>
    <!-- end::Modal -->
    <!-- begin::offcanvas -->
    <?php include('partials/offcanvas.php'); ?>
    <!-- end::offcanvas -->
    <!--begin::Scrolltop-->
    <?php include('partials/scrolltop.php'); ?>
    <!--end::Scrolltop-->
    <!-- begin::Layout Themes -->
    <?php $this->events->do_action( 'do_dashboard_footer' );?>
    <!--end::Layout Themes-->
</BODY>
<!--end::Body-->
</HTML>