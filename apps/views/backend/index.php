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
    
    <title><?php echo HTML::get_title();?></title>
    
    <?php $this->events->do_action( 'common_header' );?>
</HEAD>
<BODY id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed subheader-fixed aside-secondary-enabled page-loading">

    <?php include('_header-mobile.php'); ?>

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            <?php include '_aside.php';?>
            
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php include('_subheader.php'); ?>

                    <div class="d-flex flex-column-fluid">
                        <?php if (function_exists('validation_errors')) {
                            if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo strip_tags(validation_errors())?>
                                </div>
                            <?php endif; ?>
                        <?php } ?>
                        
                        <?php echo $page_name; ?>
                    </div>

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