<div id="kt_header_mobile" class="header-mobile">
    <a href="<?php echo site_url('admin'); ?>">
        <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'signin_logo_mobile', upload_url().'system/logo-light.png' ); ?>" class="logo-default max-h-30px" />
    </a>
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <a class="btn btn-icon btn-aside symbol symbol-25 symbol-circle" data-toggle="dropdown" data-target="user" data-offset="0px,0px" aria-expanded="false">
                <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>">
            </a>
            <!--begin::Dropdown-->
            <div id="user" class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-md dropdown-menu-left">
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