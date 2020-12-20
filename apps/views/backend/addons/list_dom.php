<!--begin::Container-->
<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                
                <div class="col-12 col-sm-6 order-2 order-xxl-1 d-flex flex-wrap align-items-center">
                    <?php if ( User::control('create.addons')) : ?>
                    <div class="d-flex align-items-center mr-5 my-2">
                        <a href="#" class="btn btn-block btn-primary btn-lg font-weight-bold text-uppercase text-center" data-toggle="modal" data-target="#kt_inbox_compose">
                        <i class="ki ki-plus icon-1x"></i> AddOns
                        </a>
                    </div>       
                    <?php endif; ?>    
                    <div class="d-flex align-items-center mr-1 my-2">
                        <div class="input-group input-group-lg input-group-solid my-2">
                            <input type="text" class="form-control pl-4"
                                placeholder="Search..." />
                            <div class="input-group-append">
                                <span class="input-group-text pr-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24"
                                            version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    opacity="0.3" />
                                                <path
                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon--></span> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Toolbar-->

                <!--begin::Pagination-->
                <div class="col-12 col-sm-6 col-xxl-4 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
                    <!--begin::Arrow Buttons-->
                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip"
                        title="Previose page">
                        <i class="ki ki-bold-arrow-back icon-sm"></i>
                    </span>

                    <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip"
                        title="Next page">
                        <i class="ki ki-bold-arrow-next icon-sm"></i>
                    </span>
                    <!--end::Arrow Buttons-->

                    <!--begin::Sort Dropdown-->
                    <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                        <span class="btn btn-default btn-icon btn-sm"
                            data-toggle="dropdown">
                            <i class="flaticon2-console icon-1x"></i>
                        </span>
                        <div
                            class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                            <ul class="navi py-3">
                                <li class="navi-item">
                                    <a href="#" class="navi-link active">
                                        <span class="navi-text">Newest</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">Olders</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">Unread</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Sort Dropdown-->
                </div>
                <!--end::Pagination-->
            </div>
        </div>
    </div>
</div>

<!--begin::Body-->
<div class="row">
    <?php
    if ($addons) : 
        foreach (force_array($addons) as $_addon) 
        {
            if (isset($_addon[ 'application' ][ 'namespace' ])) 
            {
                global $Options;
                $addon_namespace = $_addon[ 'application' ][ 'namespace' ];
                $addon_version = $_addon[ 'application' ][ 'version' ];
                $last_version = riake('migration_' . $addon_namespace, $Options);
                ?>
                <div class="col-xl-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                                    <div class="symbol symbol-40 symbol-light-primary flex-shrink-0">
                                        <span class="symbol-label font-size-h4 font-weight-bold"><?php echo strtoupper(substr($_addon[ 'application' ][ 'name' ], 0, 1)) ?></span>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column mr-auto">
                                    <span class="text-dark text-hover-primary font-size-h4 font-weight-bolder mb-1">
                                        <?php echo isset($_addon[ 'application' ][ 'name' ]) ? $_addon[ 'application' ][ 'name' ] : __('Addons');?>   
                                    </span>
                                    <span class="text-muted font-weight-bold">
                                    <?php echo isset($_addon[ 'application' ][ 'description' ]) ? $_addon[ 'application' ][ 'description' ] : '';?>
                                    </span>
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar mb-auto">
                                    <a href="<?php echo site_url(['admin','addabout']); ?>"
                                        class="font-weight-bolder label label-xl label-light-success label-inline p-1 mb-1 min-w-45px">
                                        <?php echo 'v' . (isset($_addon[ 'application' ][ 'version' ]) ? $_addon[ 'application' ][ 'version' ] : 0.1);?>
                                    </a>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <?php if( !$_addon[ 'application' ][ 'readonly' ] || intval(riake('webdev_mode', $Options))) : ?>
                        <div class="card-footer d-flex align-items-center">
                        <?php else : ?>
                        <div>
                        <?php endif;?>
                            <div class="d-flex">
                                <?php if (MY_Addon::is_share($addon_namespace) && $this->aauth->is_admin()) {?>
                                <div class="d-flex align-items-center mr-7">
                                    <span class="label label-secondary label-inline font-weight-bolder text-primary mr-2">share in</span>
                                </div>
                                <?php } ?>
                            </div>

                            <?php 
                            global $Options;
                            if (intval(riake('webdev_mode', $Options)) == true && $this->aauth->is_admin()):?>
                            <a href="<?php echo site_url(array( 'admin', 'addons', 'extract', $addon_namespace ));?>" 
                            class="btn btn-success btn-sm text-uppercase font-weight-bolder mr-2 ml-sm-auto">
                                <span class="navi-icon"><i class="fas fa-archive"></i></span>
                                <span class="navi-text">
                                <?php _e('Extract');?>
                                </span>
                            </a>
                            <?php endif; ?>

                            <?php
                            $hasMigration = MY_Addon::migration_files( 
                                $addon_namespace, 
                                $last_version, 
                                $addon_version
                            );

                            if( $hasMigration && $this->aauth->is_admin()):?>
                            <a href="<?php echo site_url([ 'admin', 'addons', 'migrate', $addon_namespace, $last_version ]);?>"  
                                class="btn btn-light-success btn-sm text-uppercase font-weight-bolder mr-2 ml-2">
                                <span class="navi-icon">
                                <i class="fa fa-database"></i> 
                                </span>
                                <span class="navi-text">
                                <?php _e('Migrate');?>
                                </span>
                            </a>
                            <?php endif;?>

                            <?php if( !$_addon[ 'application' ][ 'readonly' ] ) : ?>
                                <?php if (isset($_addon[ 'application' ][ 'main' ])) { // if the addon has a main file, it can be activated
                                    if (! MY_Addon::is_active($addon_namespace, true)) {?>
                                        <a href="<?php echo site_url(array( 'admin', 'addons', 'enable', $addon_namespace ));?>" 
                                        class="btn btn-success btn-sm text-uppercase font-weight-bolder mr-2" data-action="enable">
                                            <i class="fa fa-toggle-on"></i> Enable
                                        </a>
                                        <?php
                                    } else {?>
                                        <a href="<?php echo site_url(array( 'admin', 'addons', 'disable', $addon_namespace ));?>" 
                                        class="btn btn-warning btn-sm text-uppercase font-weight-bolder mr-2" data-action="disable">
                                            <i class="fa fa-toggle-off"></i> Disable
                                        </a>
                                        <?php
                                    }
                                }?>

                                <?php $this->events->do_action('do_menu_addon', $addon_namespace) ?>

                                <a href="#" class="btn btn-light-danger font-weight-bold btn-sm"
                                    data-head="<?php _e( 'Would you like to delete this addon?');?>"
                                    data-url="<?php echo site_url(array( 'admin', 'addons', 'remove', $addon_namespace )); ?>"
                                    onclick="deleteConfirmation(this)">
                                    <i class="fa fa-trash p-0"></i>
                                </a>
                            <?php endif;?>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <?php
            }
        }
    else :
    ?>
    <div class="d-flex flex-column flex-center py-10">
        <p>You have not created any addons.</p>
    </div>
    <?php
    endif;
    ?>
</div>
<!--end::Body-->

<!--begin::Compose-->
<div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right"
    id="kt_inbox_compose" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="<?php echo site_url(['admin', 'addons', 'install_zip']);?>" method="POST" enctype="multipart/form-data">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                    <h5 class="font-weight-bold m-0"><?php echo __('Choose the addons zip file');?></h5>
                    <div class="d-flex ml-2">
                        <span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </span>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Footer-->
                <div class="row py-5 pl-8 pr-5 border-top">
                    <!--begin::Actions-->
                    <div class="col-12">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="extension_zip" required/>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fa fa-upload"></i>
                                        <?php echo __('Upload');?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>