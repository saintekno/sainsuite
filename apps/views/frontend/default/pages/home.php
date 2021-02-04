<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Navbar STart -->
<?php $this->load->frontend_view('partials/navbar.php');?>
<!-- Navbar End -->

<!-- Hero Start -->
<section class="bg-marketing d-table w-100" id="home">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-7 col-md-7 text-center">
                <img src="<?=base_url();?>assets/frontend/<?=theme_frontend();?>images/dash.png" class="img-fluid" style="max-height: 400px" alt="">

                <div class="title-heading mt-0 mt-md-5 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <h1 class="heading"><?php echo $this->options_model->get('site_name');?></h1>
                    <p class="text-muted">
                        <small><?php echo date('Y') ?></small> &copy;
                        <?php echo $this->events->apply_filters( 'dashboard_footer_right', sprintf( __( '%s %s' ), get( 'app_name' ), get('version') ) );?>
                        <a class="d-block text-secondary" href="http://saintekno.id/">
                            <?php echo $this->events->apply_filters('dashboard_footer_text', sprintf( __( '%s' ), __( 'Powered by SainTekno' ) ) );?>
                        </a>
                    </p>
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container--> 
</section><!--end section-->
<!-- Hero End -->