<?php global $Options;?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Add Scale for mobile devices, @since 3.0.7 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="canonical" href="http://saintekno.id/" />
    <meta content="saintekno" name="author" />
    <meta name="description" content="Updates and statistics" />
    <title><?php echo HTML::get_title();?></title>
    <link rel="shortcut icon" href="<?php echo base_url('uploads/system/favicon.png');?>">

    <?php $this->events->do_action('common_header');?>
</head>
<body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">
    
    <?php include('_header-mobile.php'); ?>

    <div class="d-flex flex-column flex-root">

        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <?php include '_aside.php';?>
            
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php include('_page-title.php'); ?>

                    <div class="d-flex flex-column-fluid">
                        <div class="container">
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

                </div>

                <?php include('_footer.php'); ?>

            </div>

        </div>
        <!--end::Page-->
    </div>

    <?php $this->events->do_action( 'common_footer' );?>

    <?php include('_scrolltop.php'); ?>
    <?php include('_modal.php'); ?>
</body>
</html>