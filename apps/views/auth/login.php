<?php
global $Options;
?>
    
<!--begin::Title-->
<div class="pb-5 pb-lg-10">
    <h3 class="font-weight-bolder font-size-h2 font-size-h1-lg"><?php _e('Sign In');?></h3>
    
    <?php
    // Should checks whether a registration is enabled
    if (intval(riake('site_registration', $Options)) == true) : ?>
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
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder "><?php _e('Email or User Name' ) ?></label>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="text" 
            id="form-username"
            name="username_or_email" />
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group">
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder pt-5"><?php _e('Password' ) ?></label>

            <?php
            // Should checks whether a registration is enabled
            if (intval(riake('site_registration', $Options)) == true) : ?>
                <a href="<?php echo site_url(['recovery']) ; ?>"
                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                    <?php _e('I Lost My Password'); ?>
                </a>
            <?php endif; ?>
        </div>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="password" 
            id="form-password"
            name="password" />
    </div>
    <!--end::Form group-->

    <!-- <div class="custom-control custom-checkbox mb-3">
        <input id="customCheck1" name="keep_connected" type="checkbox" class="custom-control-input">
        <label for="customCheck1" class="custom-control-label"><?php _e('Remember me' ) ?></label>
    </div> -->

    <!--begin::Action-->
    <div class="pb-lg-0 pb-5">
        <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3"><?php _e('Sign In' ) ?></button>
        <?php
        // Should checks whether a registration is enabled
        if (intval(riake('site_registration', $Options)) == true) : 
            $this->events->do_action( 'oauth_button');
        endif; 
        ?>
    </div>
    <!--end::Action-->
</form>

<?php
// Should checks whether a registration is enabled
if (intval(riake('demo_mode', $Options)) == true) : ?>              
<hr>
<h5 class="box-title mt-5">Demo account login credentials</h5>
<div class="d-block py-2">
    <div class="btn-group btn-group-sm">
        <a href="javascript:;" data-email="demohrd@gmail.com" data-password="111111" type="button" class="btn bt-sm btn-outline-secondary copy-login"><i class="fa fa-clipboard"></i> Admin</a>
    </div>
</div>
<script>
    $('.copy-login').click(function () {
        var email = $(this).data('email');
        var password = $(this).data('password');
        $('#form-username').val(email);
        $('#form-password').val(password);
    })
</script>
<?php endif; ?>