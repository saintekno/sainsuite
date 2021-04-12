<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<HTML>
<HEAD>
    <?php $this->load->backend_view( 'partials/metas.php' );?>
    
    <?php $this->events->do_action( 'dashboard_header' );?>
</HEAD>
<BODY id="kt_body <?php echo APPNAME; ?>" 
    class="header-mobile-fixed aside-enabled aside-fixed aside-minimize subheader-enabled subheader-transparent <?php echo xss_clean($this->events->apply_filters('dashboard_skin_class', 'skin-'.APPNAME));?>" 
    <?php echo xss_clean($this->events->apply_filters('dashboard_body_attrs', 'ng-app="SainSuite"'));?>>

    <?php include('partials/header-mobile.php'); ?>

    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-row flex-column-fluid page">

            <?php include('partials/aside.php');?>
            
            <div class="d-flex flex-column flex-row-fluid min-vh-100 wrapper" id="kt_wrapper">
                
                <?php include('partials/header.php'); ?>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php include('partials/subheader.php'); ?>
                        
                    <?php include('partials/content.php'); ?>

                </div>

                <?php include('partials/footer.php'); ?>

            </div>

        </div>
        
    </div>

    <?php include('partials/modal.php'); ?>

    <?php include('partials/scrolltop.php'); ?>

    <?php $this->events->do_action( 'dashboard_footer' );?>
</BODY>
</HTML>