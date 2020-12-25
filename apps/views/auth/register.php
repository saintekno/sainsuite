<?php
global $Options;
?>
    
<!--begin::Title-->
<div class="pb-5 pb-lg-10">
    <h3 class="font-weight-bolder font-size-h2 font-size-h1-lg"><?php _e('Sign Up');?></h3>
    
    <?php
    // Should checks whether a registration is enabled
    if (intval(riake('site_registration', $Options)) == true) : ?>
        <div class="text-muted font-weight-bold font-size-h4">
            <?php _e('I Already Have An Account');?>
            <a href="<?php echo site_url('login'); ?>" class="text-primary font-weight-bolder"><?php _e('Sign In'); ?></a>
        </div>
    <?php endif; ?>
</div>
<!--begin::Title-->

<form method="post" autocomplete="off" id="kt_login_singin_form" class="form required-form">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <!--begin::Form group-->
    <div class="form-group fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="text" placeholder="<?php _e('User Name' ); ?>" name="username" value="<?php echo set_value('username'); ?>" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="email" placeholder="<?php _e('Email' ); ?>" name="email" value="<?php echo set_value('email'); ?>" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="password" placeholder="<?php _e('Password' ); ?>" name="password" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="password" placeholder="<?php _e('Confirm' ); ?>" name="confirm" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group d-flex flex-wrap">
        <button type="submit" onclick="checkRequiredFields()" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"><?php _e('Sign Up' ); ?></button>
        <a href="<?php echo site_url(array( 'login' ));?>" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
    </div>
    <!--end::Form group-->
</form>
