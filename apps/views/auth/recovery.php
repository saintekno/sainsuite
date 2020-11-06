<form method="post" autocomplete="off">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    
    <?php echo __('Please provide your user email in order to get recovery email' ); ?>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><?php _e('User email or Pseudo' ); ?></span>
        <input type="text" class="form-control" placeholder="<?php _e('User email or Pseudo' ); ?>" aria-describedby="basic-addon1" name="user_email">
        <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php _e('Get recovery Email' ); ?></button>
        </span>
    </div>
</form>
<!-- // Should checks whether a login page is enabled -->
<a class="btn btn-primary" href="<?php echo site_url(array( 'sign-in' ));?>"><?php _e('Sign In');?></a>
<!-- // Should checks whether a registration is enabled -->
<a class="btn btn-default" href="<?php echo site_url(array( 'sign-up' ));?>" class="text-center"><?php _e('Sign Up');?></a>
