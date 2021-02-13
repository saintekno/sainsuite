<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>" class="header-logo d-flex">
		<?php echo $this->events->apply_filters( 'apps_logo_sm', ''); ?>
    </a>
	
    <div class="d-flex align-items-center">
		<?php if($this->events->has_filter('load_sidebar')) : ?>
		<button class="btn btn-icon btn-clean p-0" id="kt_sidebar_mobile_toggle">
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
		<?php endif; ?>

		<button class="btn btn-clean p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
			<span></span>
		</button>
		
		<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
			<i class="ki ki-bold-more-hor icon-2x"></i> 
		</button>
    </div>
</div>