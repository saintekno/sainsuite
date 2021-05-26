<form method="post" autocomplete="off" id="kt_login_singin_form" class="form required-form">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <!--begin::Form group-->
    <div class="form-group mb-4 fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6" 
            type="text" 
            placeholder="<?php _e('User Name' ); ?>" 
            name="username" 
            value="<?php echo set_value('username'); ?>" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mb-4 fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6" 
            type="email" 
            placeholder="<?php _e('Email' ); ?>" 
            name="email" 
            value="<?php echo set_value('email'); ?>" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mb-4 fv-plugins-icon-container">
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="form-password">
                <em class="passcode-icon icon-show icon fas fa-fingerprint"></em>
                <em class="passcode-icon icon-hide icon far fa-eye-slash"></em>
            </a>
            <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6"  
                type="password" 
                id="form-password"
                placeholder="<?php _e('Password' ); ?>"
                name="password" required />
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mb-4 fv-plugins-icon-container">
        <div class="form-control-wrap">
            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="form-confirm">
                <em class="passcode-icon icon-show icon fas fa-fingerprint"></em>
                <em class="passcode-icon icon-hide icon far fa-eye-slash"></em>
            </a>
            <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6"  
                type="password" 
                id="form-confirm"
                placeholder="<?php _e('Confirm' ); ?>"
                name="confirm" required />
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="row form-group d-flex flex-wrap">
        <div class="btn-group col">
            <button type="submit" onclick="checkRequiredFields()" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3"><?php _e('Sign Up' ); ?></button>
            <a href="<?php echo site_url(array( 'login' ));?>" id="kt_login_forgot_cancel" class="btn btn-light-primary btn-hover-light-primary font-weight-bolder font-size-h6 py-4 my-3">Cancel</a>
        </div>
    </div>
    <!--end::Form group-->
</form>