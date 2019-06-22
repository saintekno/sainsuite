<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Racik');
    ?></title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Social tags -->
    <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <!-- // CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?=css_path().'fontawesome-all.min.css'?>">
    
    <?php
    // <!-- CSS Template -->
    Assets::add_css('theme.css');
    Assets::add_css('demo.css');
    echo Assets::css();
    ?>
</head>
<body>
    <!-- Main -->
    <main class="d-flex flex-column u-hero u-hero--end mnh-100vh" style="background-image: url(<?=img_path().'/promo.jpg'?>);">
        <!-- Header -->
        <header class="duik-header">
            <!-- Navbar -->
            <nav class="js-navbar-scroll navbar navbar-expand-lg navbar-dark bg-primary-md fixed-top flex-nowrap transition-bg-03s"
                data-onscroll-classes="bg-primary"
                data-offset-value="50">
            <div class="container">
                <a class="navbar-brand" href="<?=site_url()?>">
                <?php e(class_exists('Settings_lib') ? settings_item('site.title') : 'Racik'); ?>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse my-3 my-lg-0" id="navbarCollapse">
                <!-- Header Links -->
                <ul class="navbar-nav mr-lg-auto ml-lg-2 ml-xl-4">
                    <li class="js-scroll-nav nav-item mx-lg-1 mx-xl-2 mb-2 mb-lg-0 <?php echo check_class('home', true); ?>">
                    <a class="nav-link" href="<?=site_url()?>"><?php e(lang('rp_home'))?></a>
                    </li>
                    <li class="js-scroll-nav nav-item mx-lg-1 mx-xl-2 mb-2 mb-lg-0 <?php echo check_class('docs', true); ?>">
                    <a class="nav-link" href="<?=site_url('docs')?>">Documentation</a>
                    </li>
                </ul>
                <!-- End Header Links -->

                <!-- Header Links 2 -->
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item my-2 my-lg-0">
                        <ul class="list-inline">
                            <li class="list-inline-item mr-lg-0">
                            <a class="nav-link" target="_blank" href="https://github.com/boedwinangun/racik/">
                                <i class="fab fa-github"></i>
                            </a>
                            </li>
                            <li class="list-inline-item mr-lg-0">
                            <a class="nav-link" target="_blank" href="https://www.facebook.com/racikproject">
                                <i class="fab fa-facebook"></i>
                            </a>
                            </li>
                            <li class="list-inline-item mr-lg-0">
                            <a class="nav-link" target="_blank" href="https://www.instagram.com/racikproject">
                                <i class="fab fa-instagram"></i>
                            </a>
                            </li>
                            <li class="list-inline-item mr-lg-0">
                            <a class="nav-link" target="_blank" href="https://twitter.com/racikproject">
                                <i class="fab fa-twitter"></i>
                            </a>
                            </li>
                        </ul>
                    </li>
                    <?php if (empty($current_user)) : ?>
                    <li class="nav-item ml-lg-3 ml-xl-5 my-2 my-lg-0">
                    <a class="btn btn-sm btn-light text-primary" href="<?php echo site_url(LOGIN_URL); ?>">
                        Sign In
                    </a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item ml-lg-3 ml-xl-5 my-2 my-lg-0 <?php echo check_method('profile', true); ?>">
                    <a href="<?php echo site_url('users/profile'); ?>">
                        <?php e(lang('rp_user_settings')); ?>
                    </a>
                    </li>
                    <li class="nav-item ml-lg-3 ml-xl-5 my-2 my-lg-0">
                    <a class="btn btn-sm btn-light text-primary" href="<?php echo site_url('logout'); ?>">
                        <?php e(lang('rp_action_logout')); ?>
                    </a>
                    </li>
                    <li class="nav-item ml-lg-3 ml-xl-5 my-2 my-lg-0">
                    <a class="btn btn-sm btn-light text-primary" href="<?php echo site_url(SITE_AREA) ?>">
                        Go to the Admin area
                    </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <!-- End Header Links 2 -->
                </div>
            </div>
            </nav>
            <!-- End Navbar -->
        </header>
        <!-- End Header -->

        <?php
        echo isset($content) ? $content : Template::content();
        ?> 
    </main>


    <script src="<?=js_path().'jquery.min.js'?>"></script>
    <script src="<?=js_path().'jquery-migrate.min.js'?>"></script>
    <script src="<?=js_path().'popper.min.js'?>"></script>
    <script src="<?=js_path().'bootstrap.min.js'?>"></script>
</body>
</html>