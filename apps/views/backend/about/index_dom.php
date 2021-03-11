<!--begin::Section-->
<div class="row">
    <div class="col-lg-8">
        
        <h3 class="font-weight-bold mb-10 text-dark">
            <img alt="<?php echo get('app_name');?>" src="<?php echo upload_url().'system/logo-dark.png'; ?>" class="max-h-40px" />
        </h3>
        <div class="font-weight-nromal font-size-lg mb-6">
            <?php if ($check) : ?>
            <h6><?php echo sprintf(__('%s : %s is available'), get('app_name'), riake('title', $check[0])); ?></h6>
            <p><?php echo $this->markdown->parse(riake('content', $check[0])); ?></p>
            
            <a class="btn btn-primary" href="<?php echo site_url(array( 'admin', 'about', 'core', riake('version', $check[0]) )); ?>">
                <?php _e('Click Here to Update'); ?>
            </a>
            <?php else : ?>
            <p>
            <?php echo get( 'app_name' ) .' '. __("is up to date"); ?> <br>
            <?php echo sprintf( __( 'Version <b>%s</b> (Official build)' ), get('version') );?>
            </p>
            <?php endif; ?>

            <p><?php echo get('app_name');?> <br>
            © <?php echo date('Y'); ?> Saintekno. All rights reserved.</p>
        </div>
    </div>
</div>
<!--end::Section-->