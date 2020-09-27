<form class="form" id="kt_login_singin_form" method="post" autocomplete="off">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    
    <!--begin::Title-->
    <div class="pb-5 pb-lg-15">
        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"><?php _e('Sign In');?></h3>
        <p class="text-muted mb-4"><?php echo $this->events->apply_filters('signin_notice_message', $this->lang->line('signin-notice-message'));?></p>
        
        <?php
        global $Options;
        // Should checks whether a registration is enabled
        if (intval(riake('site_registration', $Options)) == true) : ?>
            <div class="text-muted font-weight-bold font-size-h4">
                <?php _e('New Here?');?>
                <a href="<?php echo site_url('register'); ?>" class="text-primary font-weight-bolder"><?php _e('Sign Up'); ?></a>
            </div>
        <?php endif; ?>
        
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo strip_tags(validation_errors())?>
            </div>
        <?php endif; ?>
    </div>
    <!--begin::Title-->

    <!--begin::Form group-->
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder text-dark"><?php _e('Email or User Name' ) ?></label>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="text" name="username_or_email" autocomplete="off" />
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group">
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder text-dark pt-5"><?php _e('Password' ) ?></label>

            <?php
            global $Options;
            // Should checks whether a registration is enabled
            if (intval(riake('site_registration', $Options)) == true) : ?>
                <a href="<?php echo site_url('auth', 'recovery') ; ?>"
                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                    <?php _e('I Lost My Password'); ?>
                </a>
            <?php endif; ?>
        </div>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="password" name="password" autocomplete="off" />
    </div>
    <!--end::Form group-->

    <!-- <div class="custom-control custom-checkbox mb-3">
        <input id="customCheck1" name="keep_connected" type="checkbox" class="custom-control-input">
        <label for="customCheck1" class="custom-control-label"><?php _e('Remember me' ) ?></label>
    </div> -->

    <!--begin::Action-->
    <div class="pb-lg-0 pb-5">
        <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3"><?php _e('Sign In' ) ?></button>
    </div>
    <!--end::Action-->
</form>