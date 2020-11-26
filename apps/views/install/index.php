<!doctype html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <!-- Add Scale for mobile devices, -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="http://saintekno.id" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>   
    <link rel="shortcut icon" href="<?php echo base_url('uploads/system/favicon.png');?>">
    
    <title><?php echo Polatan::get_title();?></title>
    
    <?php $this->events->do_action( 'common_header' );?>
</HEAD>
<BODY>
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
            <!--begin::Content-->
            <div class="login-container d-flex flex-center flex-row flex-row-fluid order-2 order-lg-1 flex-row-fluid bg-white py-lg-0 pb-lg-0 pt-15 pb-12">
                <!--begin::Container-->
                <div class="login-content login-content-signup d-flex flex-column">
                    <!--begin::Aside Top-->
                    <div class="d-flex flex-column-auto flex-column px-10">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav pt-5 pt-lg-15 pb-10">
                            <!--begin::Wizard Steps-->
                            <div class="wizard-steps d-flex flex-column flex-sm-row">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step"
                                    data-wizard-state="<?php echo $this->events->apply_filters('install_current', '');?>">
                                    <div class="wizard-wrapper pr-7">
                                        <div class="wizard-icon">
                                            <i class="wizard-check ki ki-check"></i>
                                            <span class="wizard-number">1</span>
                                        </div>
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <?php echo _e("installation");?>
                                            </h3>
                                            <div class="wizard-desc">
                                            <?php echo _e("wizard");?>
                                            </div>
                                        </div>
                                        <span class="svg-icon pl-6">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) "
                                                        x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                    <path
                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->

                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step"
                                data-wizard-state="<?php echo $this->events->apply_filters('install_current2', '');?>">
                                    <div class="wizard-wrapper pr-7">
                                        <div class="wizard-icon">
                                            <i class="wizard-check ki ki-check"></i>
                                            <span class="wizard-number">2</span>
                                        </div>
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <?php echo _e("Database.");?>
                                            </h3>
                                            <div class="wizard-desc">
                                            <?php echo _e("Configuration.");?>
                                            </div>
                                        </div>
                                        <span class="svg-icon pl-6">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) "
                                                        x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                    <path
                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) " />
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->

                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step"
                                data-wizard-state="<?php echo $this->events->apply_filters('install_current3', '');?>">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-icon">
                                            <i class="wizard-check ki ki-check"></i>
                                            <span class="wizard-number">3</span>
                                        </div>
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <?php echo _e("Site.");?>
                                            </h3>
                                            <div class="wizard-desc">
                                            <?php echo _e("Configuration.");?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                            </div>
                            <!--end::Wizard Steps-->
                        </div>
                        <!--end: Wizard Nav-->
                    </div>

                    <div class="login-form">
                        <?php if (function_exists('validation_errors')) {
                            if (validation_errors()) : ?>
                            <div class="px-10">
                                <div class="alert alert-danger" role="alert">
                                    <?php echo strip_tags(validation_errors())?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php } ?>
                        <?php if ($this->notice->output_notice(true)):?>
                            <div class="px-10">
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->notice->output_notice();?>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if (notice_from_url() != ""):?>
                            <div class="px-10">
                                <div class="alert alert-success" role="alert">
                                    <?php echo notice_from_url();?>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php include $page_name.'.php'; ?>
                    </div>
                </div>
                <!--begin::Content-->
            </div>
            <!--begin::Content-->

            <!--begin::Aside-->
            <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
                <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom"
                    style="background-image: url(<?php echo asset_url('svg/login.svg');?>);">
                    <!--begin::Aside title-->
                    <h3 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">
                        We Got<br />
                        A Surprise<br />
                        For You
                    </h3>
                    <!--end::Aside title-->
                </div>
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    
    <?php echo $this->events->do_action( 'common_footer' );?>
</BODY>
</HTML>