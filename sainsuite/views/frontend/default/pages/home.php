<?php
defined('BASEPATH') OR exit('No direct script access allowed');
global $Options;
?>

<!-- Stat main -->
<main>
    <!-- Start banner_cotact_one -->
    <section class="demo__charity banner_cotact_one banner_cotact_three">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="banner_title_inner margin-b-5">
                        <h1 class="c-dark">
                            Hi, 🖐 we are <span class="c-orange-red"><?php echo get('app_name') ;?></span>
                        </h1>
                        <p class="c-gray">
                            Drop by for a cup of coffe ☕
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="information_content">
                                <div class="link_item">
                                <a href="tel:(+62) 822 6920 4668">
                                    <i class="tio call"></i>
                                    (+62) 822 6920 4668
                                </a>
                                </div>

                                <div class="link_item selecr_mark">
                                <a href="mailto:sainteknoid@mail.com">
                                    <i class="tio email"></i>
                                    sainteknoid@mail.com
                                </a>
                                </div>

                                <div class="link_item">
                                <p class="d-flex">
                                    <i class="tio checkmark_circle"></i>
                                    Copyright &copy; <?php echo date('Y');?>.
                                    <?php echo $this->events->apply_filters('dashboard_footer_right', ( $copyright = riake('copyright', $Options)) ? $copyright : sprintf( __( 'Version %s' ), get('version') ) );?>
                                </p>
                                </div>

                            </div>
                            <div class="cc_socialmedia">
                                <a href="https://github.com/saintekno">
                                    <i class="tio github"></i>
                                </a>
                                <a href="https://www.facebook.com/saintekno.id/">
                                    <i class="tio facebook_square"></i>
                                </a>
                                <a href="https://www.instagram.com/saintekno/">
                                    <i class="tio instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shape_circle">
                <div></div>
                <div></div>
            </div>
        </div>
    </section>
    <!-- End. Banner -->
</main>