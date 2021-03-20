<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<HTML>

<HEAD>
    <?php $this->load->backend_view('partials/metas.php'); ?>

    <?php
    // Enqueueing header
    $this->enqueue->css_namespace('header');
    $this->enqueue->css('plugins.bundle');
    $this->enqueue->css('style.bundle');
    $this->enqueue->css('login');
    $this->enqueue->css('wizard');
    $this->enqueue->load_css('header');

    // Enqueueing header
    $this->enqueue->js_namespace('header');
    $this->enqueue->js('plugins.bundle');
    $this->enqueue->js('scripts.bundle');
    $this->enqueue->load_js('header');
    ?>
</HEAD>

<BODY>
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
            <!--begin::Content-->
            <div
                class="login-container d-flex flex-center flex-row flex-row-fluid order-2 order-lg-1 bg-white py-10 px-10">
                <!--begin::Container-->
                <div class="login-content d-flex flex-column">
                    <!--begin::Logo-->
                    <div class="login-logo pb-xl-10 pb-5">
                        <a href="<?php echo site_url(); ?>">
                            <img alt="<?php echo get('app_name'); ?>" src="<?php echo $this->events->apply_filters('apps_logo', ''); ?>" class="max-h-50px" />
                        </a>
                    </div>

                    <?php if (function_exists('validation_errors') && validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo strip_tags(validation_errors()) ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->notice->output_notice(true)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->notice->output_notice(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if (notice_from_url() != "") : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo notice_from_url(); ?>
                    </div>
                    <?php endif; ?>

                    <?php $this->load->backend_view('auth/' . $pages . '.php'); ?>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--begin::Content-->

            <!--begin::Aside-->
            <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
                <div
                    class="login-conteiner d-flex flex-center flex-row flex-row-fluid bgi-no-repeat bgi-position-x-right bgi-position-y-bottom">
                    <?php echo $this->events->apply_filters('apps_contact', ''); ?>
                </div>
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->

    <?php
    // Enqueueing footer
    $this->enqueue->js_namespace('footer');
    $this->enqueue->js('settings');
    $this->enqueue->js('login');
    $this->enqueue->load_js('footer');
    ?>
    <script>
    // cek nav aside secondary
    if ($("#kt_login_signup_form").length) {
        $('#kt_login .login-content').addClass('login-content-signup');
    }
    </script>
</BODY>

</HTML>