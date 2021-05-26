<?php
defined('BASEPATH') OR exit('No direct script access allowed');
global $Options;
$App_Options = options(APPNAME);
?>

<div class="flex-column justify-content-lg-start text-white d-none d-lg-flex px-40">
    <h2 class="m-0 font-weight-boldest display5 display1-lg">
        <?php echo riake('site_name', $App_Options, 'We Got A<br> Surprise<br> For You');?>.
    </h2>
    <h4 class="m-0 font-weight-boldest display5">
        <?php echo riake('site_title', $App_Options, 'sainsuite');?>.
    </h4>
    <small class="lead mb-20"><?php echo riake('site_description', $App_Options, 'To Grow Your Business');?></small>

    <p class="flex-column justify-content-end d-flex">
        <span class="opacity-50 font-weight-bold font-size-sm">
        Jika Anda butuh bantuan, silahkan Kontak Kami
        </span>
        <span class="font-size-md">
        Telp. - HP. <?php echo riake('admin_contact', $App_Options, '(+62) 822 2069 4668'); ?> <br>
        <?php echo riake('admin_email', $App_Options, 'sainteknoid@gmail.com'); ?>
        </span>
    </p>
    
    <p class="text-1 opacity-80 pt-4 mt-2">
    <?php echo $this->events->apply_filters( 'dashboard_footer_right', ( $copyright = riake('copyright', options())) ? sprintf( __( 'Copyright © %s %s.' ), date('Y'), $copyright ).' All rights reserved' : sprintf( __( 'Version %s' ), get('version') ) );?>
    </p>
</div>