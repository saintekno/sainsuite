<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - <?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Racik');
    ?></title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    
    <!-- Components Vendor Styles -->
    <link rel="stylesheet" href="<?=css_path()?>themify-icons.css">
    <link rel="stylesheet" href="<?=css_path()?>fontawesome-all.min.css">
    
    <?php
    // <!-- Theme Styles -->
    Assets::add_css('install.css');
    echo Assets::css();
    ?>
</head>
<body>
    
    <?php
    echo isset($content) ? $content : Template::content();
    ?> 

    <!-- Footer -->
    <footer class="u-footer my-3">
        <div class="container">
            <div class="d-md-flex align-items-md-center text-center text-md-left text-muted">
                <!-- Copyright -->
                <span class="text-muted mx-auto">&copy; 2019 <a class="text-muted" href="#" target="_blank">Racik v<?php echo RACIK_VERSION; ?></a>.</span>
                <!-- End Copyright -->
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- JS Global Compulsory -->
    <script src="<?=js_path()?>jquery.min.js"></script>
    <script src="<?=js_path()?>jquery-migrate.min.js"></script>
    <script src="<?=js_path()?>popper.min.js"></script>
    <script src="<?=js_path()?>bootstrap.min.js"></script>
</body>
</html>