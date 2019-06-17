<!DOCTYPE html>
<html lang="en">
<head>
    <title>Documentation - <?php e($this->settings_lib->item('site.title')); ?></title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    
    <?php
    // <!-- CSS Implementing Plugins -->
    Assets::add_css('fontawesome-all.min.css');
    Assets::add_css('jquery.mCustomScrollbar.css');
    Assets::add_css('jquery-ui.min.css');
    Assets::add_css('prism.css');
    
    // <!-- CSS Template -->
    Assets::add_css('theme.css');
    Assets::add_css('screens.css');
    echo Assets::css();
    ?>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="duik-header">
        <nav class="navbar navbar-dark fixed-top bg-primary flex-nowrap p-0">
            <a class="navbar-brand bg-md-primary-darker col-md-3 col-xl-2 mr-0 py-3" href="#">Documentation</a>

            <!-- Header Search -->
            <?php echo form_open( site_url('docs/search'), 'class="col form-inline input-group-sm"'); ?>
                <input class="js-search form-control form-control-sm w-100" type="text" name="search_terms" placeholder="<?php echo lang('docs_search_for') ?>">
            </form>
            <!-- End Header Search -->

            <!-- Header Links -->
            <ul class="navbar-nav duik-header__nav small text-nowrap flex-row px-3 ml-0 ml-sm-3">
                <?php if (config_item('docs.show_app_docs')) :?>
                <li class="nav-item <?php echo check_segment(2, 'application', true) ?>">
                    <a class="nav-link" href="<?php echo site_url('docs/application'); ?>"><i class="fa fa-desktop mr-sm-1"></i> <span class="d-none d-lg-inline-block"><?php echo lang('docs_title_application') ?></span></a>
                </li>
                <?php endif; ?>

                <?php if (config_item('docs.show_dev_docs')) : ?>
                <li class="nav-item ml-4 <?php echo check_segment(2, 'developer', true) ?>">
                    <a class="nav-link" href="<?php echo site_url('docs/developer'); ?>"><i class="fa fa-desktop mr-sm-1"></i> <span class="d-none d-lg-inline-block"><?php echo lang('docs_title_racik') ?></span></a>
                </li>
                <?php endif; ?>
            </ul>
            <!-- End Header Links -->
        </nav>
    </header>
    <!-- End Header -->

    <!-- Content Area -->
    <div class="container-fluid">
        <div class="row">
            <?php echo Template::message(); ?>

            <!-- Sidebar -->
            <nav class="col-md-3 col-xl-2 bg-light duik-sidebar navbar-expand-md">
                <div class="d-flex d-md-none justify-content-between mb-5">
                    <!-- Sidebar Search -->
                    <?php echo form_open( site_url('docs/search'), 'class="col form-inline input-group-sm"'); ?>
                        <input class="js-search form-control form-control-sm w-100" type="text" name="search_terms" placeholder="<?php echo lang('docs_search_for') ?>">
                    </form>
                    <!-- End Sidebar Search -->

                    <!-- Responsive Toggle Button -->
                    <button class="btn btn-link pl-0" type="button" data-toggle="collapse" data-target="#sidebar-nav" aria-controls="sidebar-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false">
                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/>
                        </svg>
                    </button>
                    <!-- End Responsive Toggle Button -->
                </div>

                <!-- Sidebar Nav -->
                <div class="collapse navbar-collapse" id="sidebar-nav">
                    <div class="js-scrollbar duik-sidebar-sticky">
                        <?php if (isset($sidebar)) : ?>
                            <?php echo $sidebar; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- End Sidebar Nav -->
            </nav>
            <!-- End Sidebar -->
            
            <main class="ml-md-auto col-md-9 col-xl-10 px-4 pt-0 pt-md-11">
                <div class="row pt-3">
                    <!-- Content -->
                    <div class="col-xl-10 order-xl-1 duik-content border-bottom">
                        <?php echo Template::content(); ?>
                    </div>
                    <!-- End Content -->
                </div>

                <!-- Footer -->
                <footer class="small py-4">
                    <div class="row">
                        <!-- Copyright -->
                        <div class="col-md-6 text-center text-dark text-md-left mb-3 mb-md-0">
                        &copy; 2019 <a class="text-dark" href="#">Racik</a>.
                        </div>
                        <!-- End Copyright -->

                        <!-- Social Icons -->
                        <div class="col-md-6 col-xl-4 align-self-center">
                        <ul class="list-inline text-center text-md-right mb-0">
                            <li class="list-inline-item mx-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Github">
                            <a class="text-dark" target="_blank" href="https://github.com/boedwinangun/racik/">
                                <i class="fab fa-github"></i>
                            </a>
                            </li>
                        </ul>
                        </div>
                        <!-- End Social Icons -->
                    </div>
                </footer>
                <!-- End Footer -->
            </main>
        </div>
    </div>

    <!-- Go to Top -->
    <a class="js-go-to duik-go-to" href="javascript:;">
    <span class="fa fa-arrow-up duik-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <?php 
    // <!-- JS Global Compulsory -->
    Assets::add_js('jquery.min.js');
    Assets::add_js('jquery-migrate.min.js');
    Assets::add_js('popper.min.js');
    Assets::add_js('bootstrap.min.js');

    // <!-- JS Implementing Plugins -->
    Assets::add_js('jquery.mCustomScrollbar.concat.min.js');
    Assets::add_js('jquery-ui.core.min.js');
    Assets::add_js('menu.js');
    Assets::add_js('mouse.js');
    Assets::add_js('jquery.autocomplete.js');
    Assets::add_js('prism.js');
    
    // <!-- JS -->
    Assets::add_js('main.js');
    Assets::add_js('autocomplete.js');
    Assets::add_js('custom-scrollbar.js');
    echo Assets::js(); 
    ?>
</body>
</html>