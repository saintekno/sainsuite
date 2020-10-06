<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>">
        <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo_mobile', upload_url().'system/logo-light.png' ); ?>" class="logo-default max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
    </div>
</div>