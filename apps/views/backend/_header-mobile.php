<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>">
		<?php 
		global $User_Options;
		$meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';
		$logo = (riake('theme-skin', $meta) == 'skin-dark') ? 'logo-light.png' : 'logo-dark.png'; ?>
        <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo_mobile', upload_url().'system/'.$logo); ?>" class="logo-default max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
		<button class="btn p-0 ml-2 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
			<span></span>
		</button>

		<button class="btn btn-hover-icon-primary p-0 ml-5" id="kt_sidebar_mobile_toggle">
			<span class="svg-icon svg-icon-xl">
				<!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/Design/Substract.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<rect x="0" y="0" width="24" height="24"></rect>
						<path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"></path>
						<path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"></path>
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</button>
		
		<div class="dropdown">
			<!--begin::Toggle-->
            <a class="btn btn-icon btn-aside symbol symbol-30 symbol-circle ml-2" data-toggle="dropdown" data-offset="0px,0px" aria-expanded="false">
                <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
            </a>
			<!--end::Toggle-->

			<!--begin::Dropdown-->
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
				<!--begin::Header-->
				<div class="d-flex align-items-center p-8 rounded-top">
					<!--begin::Symbol-->
					<div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                        <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
					</div>
					<!--end::Symbol-->

					<!--begin::Text-->
					<div class="d-flex flex-column">
						<div class="m-0 flex-grow-1 mr-3 font-size-h5"><?php echo User::get()->username;?></div>
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
    </div>
</div>