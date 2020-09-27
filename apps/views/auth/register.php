<form method="post" autocomplete="off">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    
    <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="<?php _e('User Name' ); ?>" name="username" value="<?php echo set_value('username'); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="<?php _e('Email' ); ?>" name="email" value="<?php echo set_value('email'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="<?php _e('Password' );
            ?>" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="<?php _e('Confirm' ); ?>" name="confirm">
        <span class="glyphicon glyphicon-lock  form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
            </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><?php _e('Sign Up' );
            ?></button>
        </div><!-- /.col -->
    </div>
</form>
<!-- // May checks whether recovery is enabled -->
<a href="<?php echo site_url(array( 'sign-in', 'recovery' )) ;?>"><?php _e('I Lost My Password');?></a><br>
<!-- // may checks whether login if login is enabled -->
<a href="<?php echo site_url(array( 'sign-in' ));?>" class="text-center"><?php _e('I Already Have An Account');?></a><br>
