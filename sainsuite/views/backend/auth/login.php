<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$App_Options = options(APPNAME);
?>
    
<div class="login-form">
    <!--begin::Title-->
    <div class="pb-5">
        <h3 class="font-weight-bolder font-size-h2 font-size-h1-lg"><?php _e('Sign In');?></h3>
        
        <?php
        // Should checks whether a registration is enabled
        if (intval(riake('site_registration', $App_Options)) == true) : ?>
            <div class="text-muted font-weight-bold font-size-h4">
                <?php _e('New Here?');?>
                <a href="<?php echo site_url('register'); ?>" class="text-primary font-weight-bolder"><?php _e('Create Account'); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <!--begin::Title-->

    <form class="form" id="kt_login_singin_form" method="post" autocomplete="off">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <!--begin::Form group-->
        <div class="form-group mb-4 fv-plugins-icon-container">
            <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6"
                type="text" 
                id="form-username"
                placeholder="<?php _e('Email or User Name' ); ?>"
                name="username_or_email" />
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
                    name="password" />
            </div>
        </div>
        <!--end::Form group-->
        
        <?php if (isset($captcha_image)) : ?>
        <div class="form-group mb-4 fv-plugins-icon-container">
            <div class="form-control-wrap">
                <span class="form-icon form-icon-right" style="right: 67px;">
                    <?php echo $captcha_image ?>
                </span>
                <input class="form-control form-control-solid h-auto font-size-h5 border-0 p-4 font-size-h6"
                    type="captcha"  
                    name="captcha" 
                    id="captcha" 
                    placeholder="<?php _e('Security Code' ); ?>"
                    autocomplete="off"> 
            </div>
        </div> 
        <?php endif; ?>
        
        <?php if (intval(riake('site_registration', $App_Options)) == true) : ?>
        <div class="form-group mb-4 fv-plugins-icon-container">
            <a href="<?php echo site_url(['recovery']) ; ?>"
                class="text-primary font-size-h6 font-weight-bolder text-hover-primary">
                <?php _e('I Lost My Password !'); ?>
            </a>
        </div> 
        <?php endif; ?>

        <!-- <div class="custom-control custom-checkbox mb-3">
            <input id="customCheck1" name="keep_connected" type="checkbox" class="custom-control-input">
            <label for="customCheck1" class="custom-control-label"><?php _e('Remember me' ) ?></label>
        </div> -->

        <!--begin::Action-->
        <div class="pb-lg-0 pb-5">
            <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 btn-block"><?php _e('Sign In' ) ?></button>
            <?php
            // Should checks whether a registration is enabled
            if (intval(riake('site_registration', $App_Options)) == true) : 
                $this->events->do_action( 'do_oauth_button');
            endif; 
            ?>
        </div>
        <!--end::Action-->
    </form>

    <?php
    // Should checks whether a registration is enabled
    if (intval(riake('demo_mode', $App_Options)) == true) : 
    $this->events->apply_filters('demo_account', '');
    endif; ?>
</div>