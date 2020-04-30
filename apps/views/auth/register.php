<body>
	<div class="container-fluid">
		<div class="row no-gutter">
			<!-- The image half -->
			<div class="col-md-6 d-none d-md-flex bg-image" style="background-image: url('<?=img_url()?>left.jpg');"></div>

			<!-- The content half -->
			<div class="col-md-6 bg-light">
				<div class="login d-flex align-items-center py-5">

					<!-- Demo content-->
					<div class="container">
						<div class="row">
							<div class="col-lg-10 col-xl-7 mx-auto">
								<h3 class="display-4">
								<?php
								echo $this->events->apply_filters( 'signin_logo', get('core_signature') );
								?>
								</h3>
								<p class="text-muted mb-4"><?php _e('Sign up to');?></p>
								<small><?php echo validation_errors( '<div class="alert alert-danger">', '</div>');?></small>
								
								<small><?php echo $this->notice->output_notice();?></small>
								
								<form method="post">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<?php echo $this->events->apply_filters('displays_registration_fields', '');?>

									<div class="text-center d-flex justify-content-between mt-4">
										<a href="<?php echo site_url(array('auth', 'recovery' )) ; ?>">
											<?php _e('I Lost My Password'); ?>
										</a> <br>
										<a href="<?php echo site_url(array( 'login' )); ?>" class="text-center">
											<?php _e('Sign In'); ?>
										</a> 
									</div>
								</form>
							</div>
						</div>
					</div><!-- End -->

				</div>
			</div><!-- End -->

		</div>
	</div>
	
	<?php echo $this->events->do_action( 'auth_footer' );?>
</body>
</html>
