<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>">
        <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo_mobile', upload_url().'system/logo-light.png' ); ?>" class="logo-default max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
        <?php 
        if (User::control('install.addons') ||
            User::control('update.addons') ||
            User::control('delete.addons') ||
            User::control('toggle.addons')
        ) : ?>
        <a href="<?php echo site_url('admin/addons'); ?>" class="btn p-0" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php _e('addons');?>">
            <span class="svg-icon svg-icon-3x m-0"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg><!--end::Svg Icon-->
            </span>
        </a>
        <?php endif; ?>
        <div class="dropdown">
            <a href="#" class="symbol symbol-30 symbol-circle btn p-0 ml-5" data-toggle="dropdown" aria-expanded="false" data-offset="0,5">
                <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
            </a>
            <!--begin::Dropdown-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-md dropdown-menu-left">
                <!--begin::Nav-->
                <ul class="navi navi-hover py-4">
                    <li class="navi-section">
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold font-size-h5 text-dark-75">
                                <?php echo User::get()->username;?>
                            </span>
                            <div class="text-muted mt-1">
                                <?php echo User::get_user_groups()[0]->definition;?>
                            </div>
                            <span class="navi-text text-muted text-hover-primary mt-1">
                                <?php echo User::get()->email;?>
                            </span>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>

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
        <button class="btn p-0 ml-5 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
    </div>
</div>