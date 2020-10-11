<!--begin::Aside-->
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">

    <!--begin::Primary-->
	<div class="aside-primary d-flex flex-column align-items-center flex-row-auto">

        <!--begin::Brand-->
		<div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-3 py-lg-5 my-5">

            <!--begin::Logo-->
            <a href="<?php echo site_url('admin'); ?>">
                <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'dashboard_logo_small', upload_url().'system/logo-light-sm.png' ); ?>" class="max-h-40px" />
            </a>

            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
            <!--end::Aside Toggle-->
        </div>

        <!--begin::Nav Wrapper-->
		<div class="aside-nav d-flex flex-column align-items-center flex-column-fluid py-5 scroll scroll-pull">

            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist" id="myTab">

                <!--begin::Item-->
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Application">
					<a href="app" class="nav-link btn btn-icon btn-aside btn-lg active" data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
						<span class="svg-icon svg-icon-light svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>

                <?php Menu::load_system_menu(); ?>
                
                <!--begin::Item-->
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Settings">
					<a href="settings" class="nav-link btn btn-icon btn-aside btn-lg" data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
						<span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"/>
								<path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M12,16 C14.209139,16 16,14.209139 16,12 C16,9.790861 14.209139,8 12,8 C9.790861,8 8,9.790861 8,12 C8,14.209139 9.790861,16 12,16 Z" fill="#000000"/>
								<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="1"/>
							</g>
						</svg><!--end::Svg Icon--></span>
					</a>
				</li>
            </ul>

            <!--end::Nav-->
        </div>

        <!--begin::Footer-->
		<div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">

            <a href="https://github.com/saintekno/sainsuite" target="_blank" class="btn btn-icon btn-hover-transparent-light btn-aside btn-lg" aria-expanded="false"
                data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php _e('github');?>">
                <i class="fab fa-github"></i>
            </a>

			<a href="<?php echo site_url('admin/addons'); ?>" class="btn btn-icon btn-aside btn-lg mb-1 position-relative" onclick="myAside()" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php _e('addons');?>">
				<span class="svg-icon svg-icon-light svg-icon-xxl"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24"></polygon>
							<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
							<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
						</g>
					</svg><!--end::Svg Icon-->
				</span>
			</a>

            <div class="dropdown">
                <a href="#" class="btn btn-icon btn-aside btn-lg" data-toggle="dropdown" data-offset="0px,0px" aria-expanded="false">
                    <img class="w-30px rounded" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
                </a>
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-left">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <li class="navi-section text-uppercase">
                        <?php echo $this->user_model->current->username;?>    
                        </li>

                        <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>

                        <!--begin::Item-->
                        <li class="navi-item font-size-xs">
                            <a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url('logout' ) . '?redirect=' . urlencode(current_url())));?>" class="navi-link pb-0">
                                <span class="navi-text"><?php _e('Sign Out');?></span>
                            </a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
        </div>
    </div>

    <!--begin::Secondary-->
	<div class="aside-secondary d-flex flex-row-fluid">

        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">

            <!--begin::Tab Content-->
            <div class="tab-content">

                <h3 class="p-3 p-lg-5 my-5 my-lg-7 text-light"><?php echo $this->options_model->get('site_name');?></h3>

                <div class="tab-pane p-3 px-lg-5 fade show active" id="kt_aside_tab_1">

                    <!--begin::List-->
                    <div class="list list-hover">
                        <?php Menu::load_apps_menu(); ?>
                    </div>
                </div>

                <!--begin::Tab Pane-->
                <div class="tab-pane p-3 px-lg-5 py-lg-5 fade" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav pt-0">
                                <?php Menu::load_setting_menu();  ?>
                            </ul>
                            <ul class="menu-nav">
                                <?php Menu::load_report_menu();  ?>
                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                </div>

            </div>

            <!--end::Tab Content-->
        </div>

        <!--end::Workspace-->
    </div>

</div>

<script>
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});

function myAside() {
    localStorage.removeItem('activeTab');
}
</script>