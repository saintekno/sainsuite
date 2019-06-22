<section class="duik-promo bg-primary text-center">
    <div class="container duik-promo-container">
        <div class="d-flex justify-content-center mh-25rem py-11">
        <div class="align-self-center">
            <h1 class="text-white mb-2"><?php echo lang('in_complete_heading'); ?></h1>
            <div class="lead text-white-70"><?php echo lang('in_complete_intro'); ?></div>
        </div>
        </div>
    </div>

    <!-- SVG BG -->
    <svg class="position-absolute bottom-0 left-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 323" enable-background="new 0 0 1920 323" xml:space="preserve">
        <polygon fill="#ffffff" style="fill-opacity: .05;" points="-0.5,322.5 -0.5,121.5 658.3,212.3 "></polygon>
        <polygon fill="#ffffff" style="fill-opacity: .1;" points="-2,323 1920,323 1920,-1 "></polygon>
    </svg>
    <!-- End SVG BG -->
</section>

<!-- Icon Blocks -->
<div class="container z-index-2 position-relative">
    <section class="duik-icon-block duik-icon-block--pull2top rounded">
        <div class="row no-gutters">
            <div class="col-md border-bottom border-md-bottom-0">
                <div class="duik-icon-block__item">
                    <svg class="duik-icon-svg-primary duik-icon-svg-3x mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                    <h4 class="h5 mb-2">Account</h4>
                    <span><?php echo lang('in_email') ?>: <b>admin@racikproject.com</b></span><br>
                    <span><?php echo lang('in_password') ?>: <b>password</b></span>
                </div>
            </div>
            <div class="col-md border-md-left">
                <div class="duik-icon-block__item">
                    <i class="far fa-paper-plane fa-2x text-primary mb-4"></i>
                    <h4 class="h5 mb-2"><?php echo lang('in_complete_next') ?></h4>
                    <span><?php echo lang('in_complete_visit') ?> <a href="<?php echo site_url('admin') ?>"><?php echo lang('in_admin_area') ?></a></span><br>
                    <span><?php echo lang('in_complete_visit') ?> <a href="<?php echo site_url() ?>"><?php echo lang('in_site_front') ?></a></span>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Icon Blocks -->