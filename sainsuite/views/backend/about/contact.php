<?php
defined('BASEPATH') OR exit('No direct script access allowed');
global $Options, $App_Options;
?>

<div class="flex-column justify-content-lg-start text-white d-none d-lg-flex px-40">
    <h2 class="m-0 font-weight-boldest display5 display1-lg">
        <?php echo ($start) ? 'We Got A<br> Surprise<br> For You' : riake('site_name', $App_Options);?>.
    </h2>
    <h4 class="m-0 font-weight-boldest display5">
        <?php echo ($start) ? get('app_name') : riake('site_title', $App_Options);?>.
    </h4>
    <small class="lead mb-20"><?php echo ($start) ? 'To Grow Your Business' : riake('site_description', $App_Options);?></small>

    <p class="flex-column justify-content-end d-flex">
        <span class="opacity-50 font-weight-bold font-size-sm">
        Jika Anda butuh bantuan, silahkan Kontak Kami
        </span>
        <span class="font-size-md">
        Telp. - HP. +62 822 6920 4668 <br>
        <?php echo $this->aauth->config_vars['email']; ?>
        </span>
    </p>
    
    <p class="text-1 opacity-80 pt-4 mt-2">
    <?php echo sprintf( __( 'Copyright © %s %s.' ), date('Y'), ($copy = riake('copyright', $Options)) ? $copy : $this->aauth->config_vars['name'].'. All rights reserved' );?>
    </p>
</div>