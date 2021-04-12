<!--begin::Container-->
<?php
global $Options;

$found = true;
if ($themes = Theme::get()) :
    echo '<div class="row">';
    foreach (force_array($themes) as $_theme) {
        if (isset($_theme[ 'theme' ][ 'namespace' ]) 
            && $_theme[ 'theme' ][ 'package' ] == APPNAME
            || APPNAME == 'system'
        ) {
            $theme_namespace = $_theme[ 'theme' ][ 'namespace' ];
            $theme_version = $_theme[ 'theme' ][ 'version' ];
            ?>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-custom gutter-b card-stretch" data-card="true" data-card-tooltips="false">     
                    <div class="card-header min-h-20px d-flex align-items-center justify-content-between px-2 py-2">
                        <div class="card-title font-weight-bolder text-dark m-0 text-hover-primary ml-2">
                            <?php echo isset($_theme[ 'theme' ][ 'name' ]) ? $_theme[ 'theme' ][ 'name' ] : __('themes');?>  
                        </div>
                        <div>
                            <span class="btn btn-sm btn-light-primary font-weight-bold" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Toggle Card">
                                <?php echo 'v' . $theme_version;?>
                            </span>
                        </div>
                    </div>   
                    <div class="card-body bgi-no-repeat p-2 min-h-150px" style="background-color: #4AB58E; background-position: center center; background-size: 100% auto; background-image: url(<?php echo fasset_url('preview.jpg')?>)">
                    </div> 
                    <div class="card-header border-0 min-h-20px d-flex align-items-center justify-content-start px-2 py-2">
                        <a href="<?php echo site_url(array( 'admin', 'theme', 'setting', $theme_namespace));?>" 
                            class="btn btn-sm btn-icon btn-light btn-hover-dark font-weight-bold mr-2">
                            <i class="fas fa-cog p-0"></i>
                        </a>
                        <?php if (Theme::is_active($theme_namespace, true)) : ?>
                        <span class="font-weight-bold" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Toggle Card">
                            active
                        </span>
                        <?php endif; ?>
                        <?php if (! Theme::is_active($theme_namespace, true)) : ?>
                            <a href="<?php echo site_url(array( 'admin', 'appearance', 'enable', $theme_namespace ));?>" 
                                class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase my-1" data-action="enable">
                                <i class="fa fa-toggle-on"></i> active
                            </a>

                            <?php if ( User::control('delete.themes') && APPNAME == 'system') : ?>
                            <a href="#" class="btn btn-sm btn-danger ml-2 font-weight-bolder text-uppercase my-1"
                                data-head="<?php _e( 'Would you like to delete this addon?');?>"
                                data-url="<?php echo site_url(array( 'admin', 'appearance', 'remove', $theme_namespace )); ?>"
                                onclick="deleteConfirmation(this)">
                                <i class="fa fa-trash p-0"></i>
                            </a>
                            <?php endif;?>

                        <?php endif; ?>
                        
                        <?php if ($this->aauth->is_admin()):?>
                            <a href="<?php echo site_url(array( 'admin', 'appearance', 'extract', $theme_namespace ));?>" 
                                class="btn btn-sm btn-warning ml-2 font-weight-bolder text-uppercase my-1 webdev_mode d-none">
                                <i class="fa fa-archive p-0"></i> 
                            </a>
                        <?php endif; ?>
                    </div>   
                </div>
            </div>
            <?php
        }
        else {
            $found = false;
        }
    }
    echo '</div>';
else :
    $found = false;
endif;

if(! $found) :
echo '
<div class="d-flex flex-column flex-center py-10">
    <p>You have not created any themes.</p>
</div>';
endif;
?>
<!--end::Body-->