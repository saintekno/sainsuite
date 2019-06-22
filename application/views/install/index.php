<!-- Main -->
<main class="d-flex flex-column u-hero u-hero--end mnh-100vh" style="background-image: url(<?=img_path().'/bg-1.png'?>);">

    <div class="container py-7 my-auto">
        <div class="d-flex align-items-center justify-content-center">
            <div style="width: 460px; max-width: 100%;">
            
                <?php echo lang('in_intro'); ?>

                <!-- Simple List Group -->
                <ul class="list-group">
                    <!-- List Group Item -->
                    <li class="list-group-item px-3">
                        <div class="media align-items-center">
                            <!-- Title -->
                            <div class="media-body">
                                <h6 class="font-weight-normal mb-1">
                                <?php echo lang('in_php_version') .' <b>'. $php_min_version ?>+</b>
                                </h6>
                            </div>
                            <!-- End Title -->

                            <!-- State -->
                            <?php echo $php_acceptable 
                            ? '<span class="badge badge-md badge-pill badge-success-soft ml-auto">'
                            : '<span class="badge badge-md badge-pill badge-error-soft ml-auto">'; 
                            ?>
                            <?php echo $php_version ?></span>
                            <!-- End State -->
                        </div>
                    </li>
                    <!-- End List Group Item -->
                    
                    <!-- List Group Item -->
                    <li class="list-group-item px-3">
                        <div class="media align-items-center">
                            <!-- Title -->
                            <div class="media-body">
                                <h6 class="font-weight-normal mb-1">
                                <?php echo lang('in_curl_enabled') ?>
                                </h6>
                            </div>
                            <!-- End Title -->

                            <!-- State -->
                            <?php echo $curl_enabled 
                            ? '<span class="badge badge-md badge-pill badge-success-soft ml-auto">'. lang('in_enabled') .'</span>' 
                            : '<span class="badge badge-md badge-pill badge-error-soft ml-auto">'. lang('in_disabled') .'</span>'; ?>
                            <!-- End State -->
                        </div>
                    </li>
                    <!-- End List Group Item -->
                </ul>
                <!-- End Simple List Group -->
                
                <h6 class="font-weight-normal mb-1 mt-5">
                <?php echo lang('in_folders') ?>
                </h6>
                <ul class="list-group">
                    
                    <?php foreach ($folders as $folder => $perm) :?>
                    <!-- List Group Item -->
                    <li class="list-group-item px-3">
                        <div class="media align-items-center">
                            <!-- Title -->
                            <div class="media-body">
                                <h6 class="font-weight-normal mb-1">
                                <?php echo $folder ?>
                                </h6>
                            </div>
                            <!-- End Title -->

                            <!-- State -->
                            <?php echo $perm 
                            ? '<span class="badge badge-md badge-pill badge-success-soft ml-auto">'. lang('in_writeable') .'</span>' 
                            : '<span class="badge badge-md badge-pill badge-error-soft ml-auto">'. lang('in_not_writeable') .'</span>'; ?>
                            <!-- End State -->
                        </div>
                    </li>
                    <!-- End List Group Item -->
                    <?php endforeach; ?>
                    
                    <?php foreach ($files as $file => $perm) :?>
                    <!-- List Group Item -->
                    <li class="list-group-item px-3">
                        <div class="media align-items-center">
                            <!-- Title -->
                            <div class="media-body">
                                <h6 class="font-weight-normal mb-1">
                                <?php echo $file ?>
                                </h6>
                            </div>
                            <!-- End Title -->

                            <!-- State -->
                            <?php echo $perm 
                            ? '<span class="badge badge-md badge-pill badge-success-soft ml-auto">'. lang('in_writeable') .'</span>' 
                            : '<span class="badge badge-md badge-pill badge-error-soft ml-auto">'. lang('in_not_writeable') .'</span>'; ?>
                            <!-- End State -->
                        </div>
                    </li>
                    <!-- End List Group Item -->
                    <?php endforeach; ?>
                </ul>

                <a href="<?=site_url('install/do_install')?>" class="btn btn-block btn-wide btn-primary text-uppercase mt-5">Next</a>

            </div>
        </div>
    </div>

</main>