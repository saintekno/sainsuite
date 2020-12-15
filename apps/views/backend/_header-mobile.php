<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>">
        <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo_mobile', upload_url().'system/logo-light.png' ); ?>" class="logo-default max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
		<div class="dropdown">
			<!--begin::Toggle-->
            <a class="btn btn-icon btn-aside symbol symbol-25 symbol-circle" data-toggle="dropdown" data-target="user" data-offset="0px,0px" aria-expanded="false">
                <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
            </a>
			<!--end::Toggle-->

			<!--begin::Dropdown-->
			<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
				<!--begin::Header-->
				<div class="d-flex align-items-center p-8 rounded-top">
					<!--begin::Symbol-->
					<div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                        <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
					</div>
					<!--end::Symbol-->

					<!--begin::Text-->
					<div class="d-flex flex-column">
						<div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5"><?php echo User::get()->username;?></div>
						<div class="text-muted mt-1">
							<?php echo User::get_user_groups()[0]->definition;?>
						</div>
						<span class="navi-text text-muted text-hover-primary mt-1">
							<?php echo User::get()->email;?>
						</span>
					</div>
					<!--end::Text-->
				</div>
				<!--end::Header-->

				<div class="separator separator-solid"></div>

				<!--begin::Nav-->
				<div class="navi navi-spacer-x-0 pt-5">

					<div class="px-8">
						<?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>
					</div>

					<!--begin::Footer-->
					<div class="navi-separator mt-3"></div>
					<div class="navi-footer px-8 py-5">
						<a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url('logout' ) . '?redirect=' . urlencode(current_url())));?>" class="btn btn-light-primary font-weight-bold"><?php _e('Sign Out');?></a>
						<a href="#" class="btn btn-clean font-weight-bold">Upgrade Plan</a>
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Dropdown-->
		</div>
		<!--end::User-->

        <button class="btn p-0 ml-5 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
    </div>
</div>