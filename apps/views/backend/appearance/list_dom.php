<!--begin::Container-->
<?php
global $Options;

if ($themes = Theme::get()) :
    echo '<div class="row">';
    foreach (force_array($themes) as $_theme) {
        if (isset($_theme[ 'theme' ][ 'namespace' ])) 
        {
            $theme_namespace = $_theme[ 'theme' ][ 'namespace' ];
            $theme_version = $_theme[ 'theme' ][ 'version' ];
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <!--begin::Card-->
                <div class="card card-custom overlay gutter-b">
                    <div class="card-body p-0">
                        <div class="overlay-wrapper max-h-200px overflow-hidden">
                            <img src="<?php echo base_url('assets/frontend/'.$_theme[ 'theme' ][ 'namespace' ].'/preview.jpg')?>" alt="" class="w-100 rounded" />
                        </div>
                        <div class="d-flex flex-column flex-center bg-white-o-5 py-5">
                            <span class="font-weight-bolder font-size-lg mb-2">
                                <?php echo isset($_theme[ 'theme' ][ 'name' ]) ? $_theme[ 'theme' ][ 'name' ] : __('themes');?>   
                                <?php if (Theme::is_active($theme_namespace, true)) : ?>
                                <span class="font-weight-bolder label label-light-success label-inline p-1">
                                    Active
                                </span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="overlay-layer rounded align-items-start justify-content-center">
                            <div class="d-flex flex-grow-1 flex-center bg-white-o-5 py-5">
                                <?php if (! Theme::is_active($theme_namespace, true)) : ?>
                                    <a href="<?php echo site_url(array( 'admin', 'appearance', 'enable', $theme_namespace ));?>" 
                                        class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase my-1" data-action="enable">
                                        <i class="fa fa-toggle-on"></i> active
                                    </a>

                                    <?php if ( User::control('delete.themes')) : ?>
                                    <a href="#" class="btn btn-sm btn-danger ml-2 btn-shadow font-weight-bolder text-uppercase my-1"
                                        data-head="<?php _e( 'Would you like to delete this addon?');?>"
                                        data-url="<?php echo site_url(array( 'admin', 'appearance', 'remove', $theme_namespace )); ?>"
                                        onclick="deleteConfirmation(this)">
                                        <i class="fa fa-trash p-0"></i>
                                    </a>
                                    <?php endif;?>

                                <?php endif; ?>
                                
                                <?php if ($this->aauth->is_admin()):?>
                                    <a href="<?php echo site_url(array( 'admin', 'appearance', 'extract', $theme_namespace ));?>" 
                                        class="btn btn-sm btn-light ml-2 btn-shadow font-weight-bolder text-uppercase my-1 webdev_mode d-none">
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
    echo '</div>';
else :
echo '
<div class="d-flex flex-column flex-center py-10">
    <p>You have not created any themes.</p>
</div>';
endif;
?>
<!--end::Body-->