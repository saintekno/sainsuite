<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile header-mobile-fixed ">

	<!--begin::Logo-->
	<a href="<?php echo site_url('admin'); ?>" class="header-logo d-flex">
		<img alt="Logo" src="<?php echo $this->events->apply_filters( 'apps_logo', 'light'); ?>" class="max-h-30px" />
	</a>

	<!--end::Logo-->

	<!--begin::Toolbar-->
	<div class="d-flex align-items-center">
		<!--begin::User-->
		<div class="dropdown">
			<!--begin::Toggle-->
			<a class="symbol symbol-users-mobile" data-toggle="dropdown" data-target="user" data-offset="0px,0px">
				<span class="symbol-label font-size-h5 font-weight-bold"><?php echo strtoupper(substr(User::get()->username, 0, 2));?></span>
			</a>
			<!--end::Toggle-->

			<!--begin::Dropdown-->
			<div id="user" class="dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
				<!--begin::Header-->
				<ul class="navi">
					<li class="navi-section py-0">
						<div class="d-flex align-items-center">
							<i class="flaticon-user icon-5x mr-5"></i>
							<div class="d-flex flex-column">
								<div class="font-weight-bold font-size-h3 text-dark-75"><?php echo User::get()->username;?></div>
								<div class="text-muted"><?php echo User::get()->email;?></div>
								<div class="navi">
									<a href="<?php echo site_url([ 'admin', 'profile' ]); ?>" class="navi-item">
									<?php echo __('View Profile') ;?>
									</a>
								</div>
							</div>
						</div>
					</li>
					<li class="navi-separator"></li>

					<?php echo $this->menus_model->usercard_nav(); ?>
				</ul>
				<div class="navi-footer py-5 mx-5 d-flex justify-content-between">
					<a href="#" target="_blank" class="btn btn-clean font-weight-bold">Upgrade Plan</a>
					<a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url('logout' ) . '?redirect=' . urlencode(current_url())));?>" 
						class="btn btn-light-danger font-weight-bold">
						<?php _e('Sign Out');?>
					</a>
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Dropdown-->
		</div>
		<!--end::User-->

		<button class="btn btn-icon btn-clean ml-2" id="kt_aside_mobile_toggle">
			<i class="icon-lg ki ki-bold-more-ver"></i>
		</button>
	</div>

	<!--end::Toolbar-->
</div>

<!--end::Header Mobile-->