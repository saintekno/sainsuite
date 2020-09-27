<div class="row">
    <div class="col-12">
        <h1><?php echo sprintf( __( 'You\'re using <b>%s</b> %s' ), get( 'app_name' ), get('str_version') );?></h1>
        
        <?php if ($check) : ?>
        <h4><?php echo sprintf(__('%s : %s is available'), get('app_name'), riake('title', $check[0])); ?></h4>
        <p><?php echo riake('content', $check[0]); ?></p>
        <a class="btn btn-primary" href="<?php echo site_url(array( 'admin', 'about', 'core', riake('id', $check[0]) )); ?>">
            <?php _e('Click Here to Update'); ?>
        </a>
        <?php else : ?>
        <h4><?php _e("up to date"); ?></h4>
        <?php endif; ?>
    </div>
</div>