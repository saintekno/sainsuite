
<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">

	<!--begin::Container-->
	<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">

		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<a href="http://saintekno.id/" target="_blank" class="text-muted font-weight-bold text-hover-primary">
			<?php echo $this->events->apply_filters('dashboard_footer_text', sprintf(__('%s &copy; Powered by %s &mdash; %s seconds'), date('Y'), 'SainTekno', '{elapsed_time}') );?>
			</a>
		</div>


		<!--begin::Nav-->
		<div class="nav nav-dark order-1 order-md-2">
			<a href="<?php echo site_url('admin/about'); ?>" class="nav-link pr-3 pl-0">
			<?php echo $this->events->apply_filters( 'dashboard_footer_right', sprintf( __( 'You\'re using %s %s' ), get( 'app_name' ), get('str_version') ) );?>
			</a>
			<a href="#" class="nav-link p-0">
				<i class="fas fa-info-circle mr-2"></i>
				<?php _e('Help Center');?>
			</a>
		</div>

	</div>

</div>
