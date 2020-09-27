<!--begin::Aside-->
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">

    <!--begin::Primary-->
    <div class="aside-primary bg-dark d-flex flex-column align-items-center flex-row-auto">

        <!--begin::Brand-->
        <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5 py-lg-7">

            <!--begin::Logo-->
            <a href="<?php echo site_url('admin'); ?>">
                <img alt="<?php echo get('app_name');?>" src="<?php echo $this->events->apply_filters( 'dashboard_logo_small', upload_url().'system/logo-light-sm.png' ); ?>" class="max-h-40px" />
            </a>

            <!--end::Logo-->
        </div>

        <!--end::Brand-->

        <!--begin::Nav Wrapper-->
        <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid py-5 scroll scroll-pull">

            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist">

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php _e('Apps');?>">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg active" data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
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

                <?php Menu::load_system_menu(); ?>
                
                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php _e('Settings');?>">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg" data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
                        <span class="svg-icon svg-icon-xl">
                        <?php include asset_path().'svg/Brush.svg';?>
                        </span>
                    </a>
                </li>
            </ul>

            <!--end::Nav-->
        </div>

        <!--end::Nav Wrapper-->

        <!--begin::Footer-->
        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">

            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>

            <a href="<?php echo site_url('admin/addons'); ?>" class="btn btn-icon btn-clean btn-lg mb-1" data-toggle="tooltip" data-placement="right" title="<?php _e('addons');?>">
                <span class="svg-icon svg-icon-xl"> 
                <?php include asset_path().'svg/addons.svg';?>
                </span>
            </a>

            <div class="dropdown" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="User Profile">
                <a href="#" class="btn btn-icon btn-clean btn-lg" data-toggle="dropdown" data-offset="0px,0px">
                    <span class="symbol symbol-30 symbol-lg-40">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <!--<span class="symbol-label font-size-h5 font-weight-bold">S</span>-->
                    </span>
                </a>
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-lg dropdown-menu-left">
                    <div class="d-flex align-items-center px-5 py-5">
                        <div class="symbol symbol-100 mr-5">
                            <div class="symbol-label" style="background-image:url('<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>')"></div>
                            <i class="symbol-badge bg-success"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                            <?php echo $this->users->current->username;?>    
                            </a>
                            <div class="navi mt-2">
                                <a href="#" class="navi-item">
                                    <span class="navi-link p-0 pb-2">
                                        <span class="navi-icon mr-1">
                                            <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <?php include asset_path().'svg/mail.svg';?>
                                            </span>
                                        </span>
                                        <span class="navi-text text-muted text-hover-primary"><?php echo $this->users->current->email;?></span>
                                    </span>
                                </a>
                                <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>
                                
                                <a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url('logout' ) . '?redirect=' . urlencode(current_url())));?>" class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5 mb-2"><?php _e('Sign Out');?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
        </div>

        <!--end::Footer-->
    </div>

    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid border-right">

        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">

            <!--begin::Tab Content-->
            <div class="tab-content">

                <!--begin::Tab Pane-->
                <div class="tab-pane p-3 px-lg-7 py-lg-5 fade show active" id="kt_aside_tab_1">
                    <!--end::Form-->
                    <h3 class="p-2 p-lg-3"><?php echo $this->options_model->get('site_name');?></h3>
                    <!--begin::Form-->
                    <form class="p-2 p-lg-3 my-1 my-lg-3">
                        <div class="d-flex">
                            <div class="input-icon h-40px">
                                <input type="text" class="form-control form-control-lg form-control-solid h-40px" placeholder="Search..." id="generalSearch" />
                                <span>
                                    <span class="svg-icon svg-icon-lg">

                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>

                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                            </div>
                            <div class="dropdown" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                <a href="#" class="btn btn-icon btn-default btn-hover-primary ml-2 h-40px w-40px flex-shrink-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="svg-icon svg-icon-lg">

                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                            </g>
                                        </svg>

                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">

                                    <!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/dropdowns/dropdown-4","page":"index"}]/-->

                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover py-5">
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-drop"></i>
                                                </span>
                                                <span class="navi-text">New Group</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-list-3"></i>
                                                </span>
                                                <span class="navi-text">Contacts</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="flaticon2-bell-2"></i>
                                                </span>
                                                <span class="navi-text">Calls</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!--end::Navigation-->

                                    <!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/dropdowns/dropdown-4","page":"index"}]/-->
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--begin::List-->
                    <div class="list list-hover">
                        <?php Menu::load_apps_menu(); ?>
                    </div>
                </div>

                <!--begin::Tab Pane-->
                <div class="tab-pane fade" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-5 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav pt-2">
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