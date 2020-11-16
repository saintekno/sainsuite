
<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">

	<!--begin::Container-->
	<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">

		<!--begin::Copyright-->
		<div class="text-muted order-2 order-md-1">
			<?php _e( 'Thank you for using' );?>
			<a href="http://saintekno.id/" target="_blank" class="text-muted text-hover-primary font-weight-bold">
				<?php echo $this->events->apply_filters('dashboard_footer_text', sprintf( __( '%s' ), get( 'app_name' ) ) );?>
			</a>
		</div>

		<!--begin::Nav-->
		<div class="nav nav-dark order-1 order-md-2 text-muted"> 
			<?php echo date('Y');?> &copy; &nbsp;
			<a href="<?php echo site_url('admin/about'); ?>" class="nav-link p-0">
				<?php echo $this->events->apply_filters( 'dashboard_footer_right', sprintf( __( 'Version %s' ), get('version') ) );?>
			</a>
		</div>

	</div>

</div>
