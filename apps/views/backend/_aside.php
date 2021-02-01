<!--begin::Aside-->
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">

    <!--begin::Primary-->
	<div class="aside-primary d-flex flex-column align-items-center flex-row-auto">

        <!--begin::Brand-->
		<div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5">

            <!--begin::Logo-->
            <a href="<?php echo site_url('admin'); ?>">
                <div id="sain-spinner" class="position-absolute"></div>
                <img alt="<?php echo get('app_name');?>" src="<?php echo upload_url().'system/logo-light-sm.png'; ?>" class="max-h-40px" />
            </a>

            <!--begin::Aside Toggle-->
            <span class="aside-toggle d-none btn btn-icon btn-light shadow-sm border mt-n2" id="kt_aside_toggle">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
            <!--end::Aside Toggle-->
        </div>

        <!--begin::Nav Wrapper-->
		<div class="aside-nav d-flex flex-column align-items-center flex-column-fluid scroll scroll-pull">

            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist" id="myTab">

                <!--begin::Item-->
                <?php if ( User::control('manage.menu') && Menu::$apps_menus_core ) : ?>
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Application">
					<a class="nav-link btn btn-icon btn-aside" data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
						<span class="svg-icon svg-icon-xl">
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
                <?php endif; ?>
                
                <?php if ( User::control('manage.menu') && Menu::$setting_menus_core ) : ?>
                <!--begin::Item-->
				<li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Tools">
					<a class="nav-link btn btn-icon btn-aside" data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
						<span class="svg-icon svg-icon-xl">
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
                <?php endif;?>

                <?php Menu::load_system_menu(); ?>
            </ul>

            <!--end::Nav-->
        </div>

        <!--begin::Footer-->
		<div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-7">
            <a href="<?php echo site_url();?>" class="btn btn-icon btn-aside symbol symbol-30 symbol-circle mb-1" 
                data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Frontend"
                aria-expanded="false">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
            </a>

            <div class="dropdown" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Help Center">
                <div class="btn btn-icon btn-aside symbol symbol-30 symbol-circle mb-1" data-toggle="dropdown" data-target="help" data-offset="0px,0px" aria-expanded="false">
                    <span class="svg-icon svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                <path d="M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z" fill="#000000"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                </div>
                <!--begin::Dropdown-->
                <div id="help" class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-left">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <?php Menu::load_help_menu();  ?>
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>

            <div class="dropdown">
                <?php 
                global $User_Options;
                $meta = (isset($User_Options['meta'])) ? $User_Options['meta'] : '';?>
                <div class="btn btn-icon btn-aside symbol symbol-30 symbol-circle d-none d-lg-flex" data-toggle="dropdown" data-target="user" data-offset="0px,0px" aria-expanded="false">
                    <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
                    <i class="symbol-badge bg-success mt-3 mr-3 <?php echo (riake('theme-skin', $meta) == 'skin-dark') ? 'border-dark' : '';?>"></i>
                </div>
                <!--begin::Dropdown-->
                <div id="user" class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-lg dropdown-menu-left">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <li class="navi-section">
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold font-size-h5 ">
                                    <?php echo User::get()->username;?>
                                </span>
                                <span class="navi-text text-muted text-hover-primary mt-1">
                                    <?php echo User::get()->email;?>
                                </span>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>

                        <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>

                        <!--begin::Item-->
                        <li class="navi-item font-size-xs">
                            <a href="<?php echo xss_clean( site_url('logout' ) . '?redirect=' . urlencode(current_url()) );?>" class="navi-link hoverable mb-0">
                                <div class="symbol symbol-40 bg-light mr-3">
                                    <div class="symbol-label bg-hover-white">
                                        <span class="svg-icon svg-icon-md svg-icon-success">
                                        <i class="fas fa-sign-out-alt text-success"></i>
                                        </span>
                                    </div>
                                </div>
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
        <div class="aside-workspace scroll scroll-push">

            <!--begin::Tab Content-->
            <div class="tab-content">

                <div class="tab-title px-4 pt-5">
                    <h2 class="menu-text pl-4 pt-5 pb-6 font-weight-light font-size-h2">
                        <?php
                        $title = $this->options_model->get('site_name');
                        $pecah = explode(" ", $title);
                        $jml = count($pecah);

                        if ($jml > 2) {
                            for ($i=0; $i<=$jml-1; $i++){
                                $title[$i] = strtoupper(substr($pecah[$i], 0, 1));
                                echo $title[$i];
                            }
                        } else {
                            echo $title;
                        }
                        ?>
                    </h2>
				</div>

                <div class="tab-pane px-4 pb-3 fade" id="kt_aside_tab_1">
                    <!--begin::List-->
                    <div class="list list-hover">
                        <?php Menu::load_apps_menu(); ?>
                    </div>
                </div>

                <!--begin::Tab Pane-->
                <div class="tab-pane px-4 pb-3 fade" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav pt-0">
                                <?php Menu::load_setting_menu();  ?>
                            </ul>
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