<!--begin::Title-->
<div class="pb-5 pb-lg-10">
    <h3 class="font-weight-bolder font-size-h2 font-size-h1-lg"><?php _e('Sign Up');?></h3>
    
    <div class="text-muted font-weight-bold font-size-h4">
        <?php _e('I Already Have An Account');?>
        <a href="<?php echo site_url('login'); ?>" class="text-primary font-weight-bolder"><?php _e('Sign In'); ?></a>
    </div>
</div>
<!--begin::Title-->

<?php echo $this->events->apply_filters('fill_form_register', ''); ?>