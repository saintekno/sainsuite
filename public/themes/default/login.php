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
    <link rel="stylesheet" href="<?=css_path()?>/themify-icons.css">
    
    <?php
    // <!-- Theme Styles -->
    Assets::add_css('theme.css');
    echo Assets::css();
    ?>
</head>
<body>
    <!-- Main -->
    <main class="d-flex flex-column u-hero u-hero--end mnh-100vh" style="background-image: url(<?=img_path().'/bg-1.png'?>);">
        <div class="container py-11 my-auto">
            <p><a href="<?php echo site_url(); ?>">&larr; <?php echo lang('us_back_to') ?></a></p>
            
            <?php
            echo isset($content) ? $content : Template::content();
            ?>    
        </div>

        <!-- Footer -->
        <footer class="u-footer">
            <div class="container">
                <div class="d-md-flex align-items-md-center text-center text-md-left text-muted">
                    <!-- Copyright -->
                    <span class="text-muted ml-auto">&copy; 2019 <a class="text-muted" href="#" target="_blank">Racik <?php echo RACIK_VERSION; ?></a>.</span>
                    <!-- End Copyright -->
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </main>
    <!-- End Main -->
</body>
</html>