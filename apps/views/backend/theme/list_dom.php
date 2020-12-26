<!--begin::Container-->
<?php
global $Options;
?>

<div class="row">
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header border-0 align-items-center flex-wrap py-2 h-auto">
                
                <div class="col-12 col-sm-6 order-2 order-xxl-1 d-md-flex align-items-center">
                    <div class="d-flex flex-wrap align-items-center mr-md-5 my-2">
                        <a href="#" class="btn btn-block btn-primary btn-lg font-weight-bold text-uppercase text-center" data-toggle="modal" data-target="#kt_inbox_compose">
                            <i class="ki ki-plus icon-1x"></i> themes
                        </a>
                    </div>
                    <div class="d-flex align-items-center mr-md-1 my-2">
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
                    
                    <?php if ($this->aauth->is_admin()):?>
                    <label class="col-form-label mr-2">Developer mode</label>

                    <form class="form mr-5" 
                        id="web_mode"
                        action="<?php echo site_url(array( 'admin', 'options', 'ajax' ));?>" 
                        method="post"> 
                        <div class="row">
                            <div class="col-3">
                                <span class="switch switch-outline switch-icon switch-primary">
                                    <label>
                                        <input type="checkbox" 
                                            <?php echo (intval(riake('webdev_mode', $Options))) ? 'checked="checked"' : '';?> 
                                            name="webdev_mode">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>

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
                                        <span class="navi-text">Free</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">Premium</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Sort Dropdown-->
                </div>
                <!--end::Pagination-->
            </div>
            <!--end::Header-->
        </div>
    </div>
</div>

<!--begin::Body-->
<?php    
if ($themes = Theme::get()) : ?>
    <div class="row">
    <?php foreach (force_array($themes) as $_theme) {
        if (isset($_theme[ 'theme' ][ 'namespace' ])) 
        {
            $theme_namespace = $_theme[ 'theme' ][ 'namespace' ];
            $theme_version = $_theme[ 'theme' ][ 'version' ];
            ?>
            <div class="col-4">
                <!--begin::Card-->
                <div class="card card-custom overlay">
                    <div class="card-body p-0">
                        <div class="overlay-wrapper max-h-200px overflow-hidden">
                            <img src="<?php echo base_url('assets/frontend/'.$_theme[ 'theme' ][ 'namespace' ].'/preview.jpg')?>" alt=""
                                class="w-100 rounded" />
                        </div>
                        <div class="d-flex flex-column flex-center bg-white-o-5 py-5">
                            <span class=""font-weight-bolder font-size-lg mb-2">
                                <?php echo isset($_theme[ 'theme' ][ 'name' ]) ? $_theme[ 'theme' ][ 'name' ] : __('themes');?>   
                                <?php if (Theme::is_active($theme_namespace, true)) : ?>
                                <span class="font-weight-bolder label label-light-success label-inline p-1">
                                    Active
                                </span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="overlay-layer m-5 rounded align-items-start justify-content-center">
                            <div class="d-flex flex-grow-1 flex-center bg-white-o-5 py-5">
                                <?php if (! Theme::is_active($theme_namespace, true)) : ?>
                                <a href="<?php echo site_url(array( 'admin', 'themes', 'enable', $theme_namespace ));?>" 
                                    class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase my-1" data-action="enable">
                                    <i class="fa fa-toggle-on"></i> active
                                </a>
                                <a href="<?php echo site_url(array( 'admin', 'themes', 'remove', $theme_namespace ));?>" 
                                    class="btn btn-sm btn-danger ml-2 btn-shadow font-weight-bolder text-uppercase my-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo site_url(array( 'admin', 'themes', 'extract', $theme_namespace ));?>" 
                                    class="btn btn-sm btn-secondary ml-2 btn-shadow font-weight-bolder text-uppercase my-1 webdev_mode d-none">
                                    <i class="fa fa-archive p-0"></i> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <?php
        }
    }
    ?>
    </div>
<?php
else :
?>
<div class="d-flex flex-column flex-center py-10">
    <p>You have not created any themes.</p>
</div>
<?php
endif;
?>
<!--end::Body-->

<!--begin::Compose-->
<div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right"
    id="kt_inbox_compose" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="<?php echo site_url('admin/themes/install_zip');?>" method="POST" enctype="multipart/form-data">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
                    <h5 class="font-weight-bold m-0"><?php echo __('Choose the themes zip file');?></h5>
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