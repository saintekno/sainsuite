<!--begin::Title-->
<div class="pb-5 pb-lg-15">
    <h3 class="font-weight-bolder font-size-h2 font-size-h1-lg">Forgotten Password ?</h3>
    <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
</div>
<!--end::Title-->

<form method="post" id="kt_login_singin_form" autocomplete="off" class="form required-form">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <!--begin::Form group-->
    <div class="form-group fv-plugins-icon-container">
        <input class="form-control form-control-solid h-auto font-size-h5 p-6 border-0 rounded-lg font-size-h6" type="email" placeholder="Email" name="user_email" required>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="row form-group d-flex flex-wrap">
        <div class="btn-group col">
            <button type="submit" onclick="checkRequiredFields()" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Submit</button>
            <a href="<?php echo site_url(array( 'login' ));?>" id="kt_login_forgot_cancel" class="btn btn-light-primary btn-hover-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
        </div>
    </div>
    <!--end::Form group-->
</form>
