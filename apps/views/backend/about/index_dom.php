<?php
defined('BASEPATH') OR exit('No direct script access allowed');
global $Options;
?>

<!--begin::Section-->
<div class="row">
    <div class="col-lg-8">
        
        <h3 class="font-weight-bold mb-10 text-dark">
            <img alt="<?php echo get('app_name');?>" src="<?php echo upload_url().'system/logo-dark.png'; ?>" class="max-h-40px" />
        </h3>
        <div class="font-weight-nromal font-size-lg mb-6">
            <p class="lead">
            <?php echo get( 'app_name' ) .' '. __("is up to date"); ?> <br>
            <?php echo sprintf( __( 'Version <b>%s</b> (Official build)' ), get('version') );?>
            </p>
            
            <?php if ($check) : ?>
            <h6 class="font-weight-bold mb-0 text-dark"><?php echo sprintf(__('%s : %s is available'), get('app_name'), riake('title', $check[0])); ?></h6>
            <p><?php echo $this->markdown->parse(riake('content', $check[0])); ?></p>
            
            <a class="btn btn-primary" href="<?php echo site_url(array( 'admin', 'about', 'core', riake('version', $check[0]) )); ?>">
            <?php _e('Click Here to Update'); ?>
            </a>
            <?php endif; ?>
            
            <?php if (riake('site_title', $Options)) : ?>
            <p class="flex-column justify-content-end d-flex">
                <span class="opacity-50 font-weight-bold font-size-sm"><?php echo get('app_name');?> for</span>
                <span class="font-size-md"><?php echo riake('site_title', $Options);?></span>
            </p>
            <?php endif; ?>

            <p class="mt-10"><?php echo $this->events->apply_filters('dashboard_footer_text', sprintf( __( 'Copyright © %s %s. All rights reserved.' ), date('Y'), $this->aauth->config_vars['name'] ) );?></p>
        </div>
    </div>
</div>
<!--end::Section-->