<?php
global $Options;
?>
<form class="form" id="kt_login_singin_form" method="post" autocomplete="off">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <!--begin::Form group-->
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder text-dark"><?php _e('Email or User Name' ) ?></label>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="text" 
            id="form-username"
            name="username_or_email" 
            autocomplete="off" />
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group">
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder text-dark pt-5"><?php _e('Password' ) ?></label>

            <?php
            // Should checks whether a registration is enabled
            if (intval(riake('site_registration', $Options)) == true) : ?>
                <a href="<?php echo site_url('auth', 'recovery') ; ?>"
                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                    <?php _e('I Lost My Password'); ?>
                </a>
            <?php endif; ?>
        </div>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
            type="password" 
            id="form-password"
            name="password" 
            autocomplete="off" />
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
        if (intval(riake('site_registration', $Options)) == true) : ?>
        <button type="button"
            class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/social-icons/google.svg-->
                <svg
                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 20 20" fill="none">
                    <path
                        d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z"
                        fill="#4285F4" />
                    <path
                        d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z"
                        fill="#34A853" />
                    <path
                        d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z"
                        fill="#FBBC05" />
                    <path
                        d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z"
                        fill="#EB4335" />
                </svg>
                <!--end::Svg Icon-->
            </span> Sign in with Google
        </button>
        <?php endif; ?>
    </div>
    <!--end::Action-->
</form>
                      
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