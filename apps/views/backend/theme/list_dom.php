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
            <div class="col-12 col-sm-6 col-md-4">
                <!--begin::Card-->
                <div class="card card-custom overlay gutter-b">
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

                                    <?php if ( User::control('delete.themes')) : ?>
                                    <a href="#" class="btn btn-sm btn-danger ml-2 btn-shadow font-weight-bolder text-uppercase my-1"
                                        data-head="<?php _e( 'Would you like to delete this addon?');?>"
                                        data-url="<?php echo site_url(array( 'admin', 'themes', 'remove', $theme_namespace )); ?>"
                                        onclick="deleteConfirmation(this)">
                                        <i class="fa fa-trash p-0"></i>
                                    </a>
                                    <?php endif;?>

                                <?php endif; ?>
                                
                                <?php if ($this->aauth->is_admin()):?>
                                    <a href="<?php echo site_url(array( 'admin', 'themes', 'extract', $theme_namespace ));?>" 
                                        class="btn btn-sm btn-secondary ml-2 btn-shadow font-weight-bolder text-uppercase my-1 webdev_mode d-none">
                                        <i class="fa fa-archive p-0"></i> 
                                    </a>
                                <?php endif; ?>
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
    id="kt_theme_frontend" role="dialog" data-backdrop="false">
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
                                    <label class="custom-file-label overflow-hidden" for="customFile">Choose file</label>
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