<!--begin::Aside-->
<div class="aside d-flex" id="kt_aside">
	<!--begin::Primary-->
	<div class="aside-primary d-flex flex-column align-items-center flex-row-auto">
		<!--begin::Brand-->
		<div class="aside-brand flex-column align-items-center flex-column-auto py-3">
			<!--begin::Logo-->
            <a href="<?php echo site_url('admin'); ?>" class="aside-logo">
				<div id="sain-spinner" class="position-absolute"></div>
                <img alt="<?php echo get('app_name');?>" src="<?php echo upload_url('system/logo-sm.png', base_url()); ?>" class="max-h-40px" />
			</a>
			<!--end::Logo-->

			<!--begin::Aside Toggle-->
			<span class="aside-toggle btn btn-icon btn-white btn-hover-primary border d-none" id="kt_aside_toggle">
				<i class="icon-sm flaticon2-back"></i>
			</span>
			<!--end::Aside Toggle-->
		</div>
		<!--end::Brand-->

		<!--begin::Nav Wrapper-->
		<div class="aside-nav d-flex flex-column align-items-center flex-column-fluid py-3 scroll scroll-pull">

			<!--begin::Nav-->
			<ul class="nav flex-column" role="tablist">

				<!--begin::Item-->
				<li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Application">
					<a href="app" class="nav-link btn btn-icon btn-clean btn-lg d-none" data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
						<i class="icon-2x flaticon-squares-4"></i>
					</a>
				</li>

				<?php echo $this->menus_model->aside_nav(); ?>
				<!--end::Item-->
			</ul>

			<!--end::Nav-->
		</div>

		<!--end::Nav Wrapper-->

		<!--begin::Footer-->
		<div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-3">
			
			<?php echo $this->menus_model->asidefooter_nav(); ?>

			<div class="dropdown dropup">
				<a class="btn btn-icon btn-clean btn-lg mb-2" data-toggle="dropdown" data-target="help" data-offset="0px,0px" aria-expanded="false">
					<i class="icon-2x flaticon-questions-circular-button"></i>
				</a>
				<!--begin::Dropdown-->
				<div id="help" class="dropdown-menu dropdown-menu-sm">
					<!--begin::Nav-->
					<?php echo $this->menus_model->infocenter_nav(); ?>
					<!--end::Nav-->
				</div>
				<!--end::Dropdown-->
			</div>
			
			<div class="aside-users d-none d-lg-flex">
				<div class="dropdown dropup">
					<a class="symbol symbol-users" data-toggle="dropdown" data-target="user" data-offset="0px,0px" aria-expanded="false">
						<img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
					</a>
					<!--begin::Dropdown-->
					<div id="user" class="dropdown-menu dropdown-menu-lg">
						<!--begin::Nav-->
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
						<div class="navi-footer py-3 mx-5 d-flex justify-content-between">
							<a href="<?php echo xss_clean( site_url('logout' ) . '?redirect=' . urlencode(current_url()) );?>" class="btn btn-light-danger btn-sm font-weight-bold"><?php _e('Sign Out');?></a>
							<a href="#" target="_blank" class="btn btn-clean btn-sm font-weight-bold">Upgrade Plan</a>
						</div>
						<!--end::Nav-->
					</div>
					<!--end::Dropdown-->
				</div>
			</div>
		</div>
		<!--end::Footer-->
	</div>
	<!--end::Primary-->

	<!--begin::Secondary-->
	<div class="aside-secondary d-flex flex-column">
		<!--end::Form-->
		<div class="tab-title mb-3">
			<div class="aside-brand border-bottom border-bottom-secondary">
				<!--begin::Logo-->
				<a href="<?php echo site_url(); ?>" class="d-flex mr-5">
					<img alt="Logo" src="<?php echo $this->events->apply_filters( 'apps_logo', ''); ?>" class="max-h-40px" />
				</a>
				<!--end::Logo-->
			</div>
		</div>

		<?php echo $this->menus_model->create_nav(); ?>

		<!--begin::Workspace-->
		<div class="aside-workspace scroll scroll-push">
			<!--begin::Tab Content-->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="kt_aside_tab_1">
					<!--begin::Aside Menu-->
					<div class="aside-menu-wrapper flex-column-fluid px-3" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu min-h-lg-700px" data-menu-vertical="1" data-menu-scroll="1">
							<!--begin::Menu Nav-->
							<?php echo $this->menus_model->menu_nav(); ?>
							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div>
					<!--end::Aside Menu-->
				</div>
			</div>
		</div>
		<!--end::Tab Content-->
	</div>
	<!--end::Secondary-->
</div>

<!--end::Aside-->