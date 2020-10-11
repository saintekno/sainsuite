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
        <div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Content-->
            <div
                class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
                <!--begin::Wrapper-->
                <div class="login-content d-flex flex-column pt-lg-0 pt-12">
                    <!--begin::Logo-->
                    <a href="<?php echo site_url();?>" class="login-logo pb-xl-20 pb-15">
                    <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo', upload_url().'system/logo-light-sm.png' ); ?>" class="max-h-70px" />
                    </a>
                    <!--end::Logo-->

                    <!--begin::Signin-->
                    <div class="login-form">
					<?php include $page_name.'.php'; ?>
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--begin::Content-->

            <!--begin::Aside-->
            <div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
                <div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom"
                    style="background-image: url(<?php echo asset_url('svg/login.svg');?>);">
                    <!--begin::Aside title-->
                    <h3
                        class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">
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
	
    <script>
    <?php if ($errors = $this->aauth->get_errors_array()) :
        foreach ($errors as $error) : ?>
            toastr.error('<?php echo $error;?>');
        <?php endforeach ;
    endif; ?>
    </script>
    <?php echo $this->events->do_action( 'common_footer' );?>
</BODY>
</HTML>