<div id="kt_header" class="header flex-column header-fixed">
    <!--begin::Top-->
    <div class="header-top d-flex">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Left-->
            <div class="d-none d-lg-flex align-items-center mr-3">
                <!--begin::Logo-->
                <div class="header-logo d-flex mr-5">
                    <?php echo $this->events->apply_filters( 'apps_logo_sm', ''); ?>
                </div>
                <!--end::Logo-->

                <!--begin::Desktop Search-->
                <div class="quick-search quick-search-inline ml-4 w-500px" id="kt_quick_search_inline">
                    <!--begin::Form-->
                    <form method="get" class="quick-search-form">
                        <div class="input-group rounded bg-dark">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon--></span> </span>
                            </div>

                            <input type="text" class="form-control h-45px" placeholder="Search..." />

                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="quick-search-close ki ki-close icon-sm"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->

                    <!--begin::Search Toggle-->
                    <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
                    <!--end::Search Toggle-->

                    <!--begin::Dropdown-->
                    <div
                        class="dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up">
                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350"
                            data-mobile-height="200">
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Desktop Search-->
            </div>
            <!--end::Left-->

            <!--begin::Topbar-->
            <div class="topbar">

                <!--begin::Quick Actions-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        <div class="btn btn-icon btn-aside btn-dropdown btn-lg mr-1">
                            <span class="svg-icon svg-icon-2x mr-0"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Communication\Dial-numbers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="4" y="10" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="10" y="4" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="10" y="10" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="16" y="4" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="16" y="10" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="4" y="16" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="10" y="16" width="4" height="4" rx="2"/>
                                    <rect fill="#000000" x="16" y="16" width="4" height="4" rx="2"/>
                                </g>
                            </svg><!--end::Svg Icon--></span> </div>
                    </div>
                    <!--end::Toggle-->

                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                        <!--begin:Header-->
                        <div class="d-flex flex-column flex-center py-10 bg-dark-o-5 rounded-top bg-light">
                            <h4 class="text-dark font-weight-bold">
                                Quick Actions
                            </h4>
                        </div>
                        <!--end:Header-->

                        <!--begin:Nav-->
                        <div class="row row-paddingless">
                            <!--begin:Item-->
                            <div class="col-6">
                                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Euro.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon--></span> <span
                                        class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Accounting</span>
                                    <span class="d-block text-dark-50 font-size-lg">eCommerce</span>
                                </a>
                            </div>
                            <!--end:Item-->

                            <!--begin:Item-->
                            <div class="col-6">
                                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-attachment.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon--></span> <span
                                        class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Administration</span>
                                    <span class="d-block text-dark-50 font-size-lg">Console</span>
                                </a>
                            </div>
                            <!--end:Item-->

                            <!--begin:Item-->
                            <div class="col-6">
                                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right">
                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon--></span> <span
                                        class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Projects</span>
                                    <span class="d-block text-dark-50 font-size-lg">Pending Tasks</span>
                                </a>
                            </div>
                            <!--end:Item-->
                        </div>
                        <!--end:Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Quick Actions-->

                <!--begin::Chat-->
                <div class="topbar-item mr-1">
                    <div class="btn btn-icon btn-aside btn-lg pulse pulse-info"
                        data-toggle="modal" data-target="#kt_chat_modal">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                        fill="#000000" />
                                    <path
                                        d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> 
                        <span class="pulse-ring"></span>
                    </div>
                </div>
                <!--end::Chat-->

                <!--begin::User-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                        <div class="btn btn-icon w-auto d-flex align-items-center btn-lg pl-2 btn-dropdown">
                            <div class="d-flex flex-column text-right pr-3">
                                <span class="opacity-50 font-weight-bold font-size-sm d-none d-md-inline"><?php echo User::get()->username;?></span>
                                <span class="font-weight-bolder font-size-sm d-none d-md-inline"><?php echo User::get_user_groups()[0]->definition;?></span>
                            </div>
                            <span class="symbol symbol-35">
                                <span class="symbol-label font-size-h5 font-weight-bold">
                                    <?php echo strtoupper(substr(User::get()->username, 0, 1));?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <!--end::Toggle-->

                    <!--begin::Dropdown-->
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                        <!--begin::Header-->
                        <div class="d-flex align-items-center p-8 rounded-top">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                                <img src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" />
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">
                                <?php echo User::get()->email;?>
                            </div>
                            <!--end::Text-->
                        </div>
                        <div class="separator separator-solid"></div>
                        <!--end::Header-->

                        <!--begin::Nav-->
                        <div class="navi navi-spacer-x-0 pt-5">
                            <div class="px-8">
                                <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>
                            </div>

                            <!--begin::Footer-->
                            <div class="navi-separator mt-3"></div>
                            <div class="navi-footer px-8 py-5">
                                <a href="javascript:void(0)" target="_blank"
                                    class="font-weight-bold text-muted">Upgrade Plan</a>
                                <a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url('logout' ) . '?redirect=' . urlencode(current_url())));?>" target="_blank"
                                    class="btn btn-light-primary font-weight-bold">
                                    <?php _e('Sign Out');?>
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::User-->
                
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Top-->

    <!--begin::Bottom-->
    <div class="header-bottom d-none">
        <div class="container flex-wrap flex-sm-nowrap">
            <div class="navheader-nav nav flex-grow-1">
                <?php 
                foreach ($this->events->apply_filters('header_menu', []) as $namespace) {
                    Menu::add_header_menu($namespace);
                }; 
                Menu::load_header_menu();
                ?>
            </div>
        </div>
    </div>
    <!--end::Bottom-->
</div>
<!--end::Header-->