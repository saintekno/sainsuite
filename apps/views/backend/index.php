<!doctype html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <!-- Add Scale for mobile devices, -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="http://saintekno.id" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>   
    <link rel="shortcut icon" href="<?php echo base_url('uploads/system/favicon.png');?>">
    
    <title><?php echo Polatan::get_title();?></title>
    
    <?php $this->events->do_action( 'common_header' );?>
</HEAD>
<BODY id="kt_body" 
    class="header-mobile-fixed aside-enabled aside-fixed subheader-fixed aside-secondary-enabled aside-minimize page-loading" 
    <?php echo xss_clean($this->events->apply_filters('dashboard_body_attrs', 'ng-app="SainSuite"'));?>>

    <?php include('_header-mobile.php'); ?>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            <?php include('_aside.php');?>
            
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                
                <?php include('_header.php'); ?>

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php include('_subheader.php'); ?>

                    <?php if (function_exists('validation_errors')) {
                        if (validation_errors()) : ?>
                        <div class="container">
                            <div class="alert alert-danger" role="alert">
                                <?php echo strip_tags(validation_errors())?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php } ?>
                        
                    <?php include('_content.php'); ?>

                </div>

                <?php include('_footer.php'); ?>

            </div>

        </div>
    </div>

    <?php include('_scrolltop.php'); ?>
    <?php include('_modal.php'); ?>
    <?php $this->events->do_action( 'common_footer' );?>
</BODY>
</HTML>