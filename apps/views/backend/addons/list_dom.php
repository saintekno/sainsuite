<!--begin::Container-->
<?php
global $Options;

if ($addons) : 
    $group = array();
    foreach (force_array($addons) as $_addon) 
    {
        // group subarrays by a column value
        $group[$_addon['group']][] = $_addon;
    }

    foreach ($group as $group) 
    {
        echo '<h4 class="pt-3">'.$group[0]['group'].'</h4>
        <div class="row">';
        foreach ( $group as $_group ) 
        {
            if (isset($_group[ 'application' ][ 'namespace' ])) 
            {
                $addon_namespace = $_group[ 'application' ][ 'namespace' ];
                $addon_version = $_group[ 'application' ][ 'version' ];
                $last_version = riake('migration_' . $addon_namespace, $Options);
                ?>
                <div class="col-12 col-md-6 col-lg-6 col-xxl-4">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch" data-card="true" data-card-tooltips="false">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title m-0">
                                <span class="font-weight-bolder label label-xl label-light-success label-inline p-1 mr-2 min-w-45px">
                                <?php echo 'v' . (isset($_group[ 'application' ][ 'version' ]) ? $_group[ 'application' ][ 'version' ] : 0.1);?>
                                </span>
                                <a class="text-dark-75 font-weight-bolder font-size-h5" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Toggle Card">
                                <?php echo isset($_group[ 'application' ][ 'name' ]) ? $_group[ 'application' ][ 'name' ] : __('Addons');?>
                                </a>
                            </div>
                            <div class="card-toolbar <?php echo ( $_group[ 'application' ][ 'readonly' ]) ? 'webdev_mode d-none':'';?>">
                                
                                <?php
                                // Extrax
                                if ($this->aauth->is_admin()):?>
                                <a href="<?php echo site_url(array( 'admin', 'addons', 'extract', $addon_namespace ));?>" class="btn btn-icon btn-circle btn-sm btn-light-info ml-1 <?php echo ( !$_group[ 'application' ][ 'readonly' ]) ? 'webdev_mode d-none':'';?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php _e('Extract');?>">
                                    <i class="fas fa-download"></i>
                                </a>
                                <?php endif; ?>
    
                                <?php
                                // Migration
                                $hasMigration = MY_Addon::migration_files( 
                                    $addon_namespace, 
                                    $last_version, 
                                    $addon_version
                                );
                                if( $hasMigration && $this->aauth->is_admin()):?>
                                <a href="<?php echo site_url([ 'admin', 'addons', 'migrate', $addon_namespace, $last_version ]);?>" class="btn btn-icon btn-sm btn-light-dark ml-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php _e('Migrate');?>">
                                    <i class="fas fa-database"></i>
                                </a>
                                <?php endif;?>

                                <?php if( !$_group[ 'application' ][ 'readonly' ] ) : ?>
                                    <?php $this->events->do_action('do_menu_addon', $addon_namespace) ?>

                                    <?php if (! MY_Addon::is_active($addon_namespace, true)) {?>
                                        <?php if ( $this->aauth->is_admin()) : ?>
                                        <a href="#" class="btn btn-circle btn-icon btn-sm btn-light-danger ml-1" 
                                            data-url="<?php echo site_url(array( 'admin', 'addons', 'remove', $addon_namespace )); ?>" 
                                            data-head="<?php _e( 'Would you like to delete this addon?');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"
                                            onclick="KTSains.deleteConfirmation(this)">
                                            <i class="ki ki-close icon-nm"></i>
                                        </a>
                                        <?php endif;?>
                                        
                                        <span class="switch switch-outline switch-icon switch-success ml-2" >
                                            <label data-toggle="tooltip" data-placement="top" title="" data-original-title="Disable">
                                                <input type="checkbox" onclick="window.location.href='<?php echo site_url(array( 'admin', 'addons', 'enable', $addon_namespace ));?>'"/>
                                                <span></span>
                                            </label>
                                        </span>
                                        
                                    <?php } else {?>
                                        <?php if (! MY_Addon::is_share($addon_namespace) && $this->aauth->is_admin()) : ?>
                                        <span class="switch switch-outline switch-icon switch-success ml-2" >
                                            <label data-toggle="tooltip" data-placement="top" title="" data-original-title="Enable">
                                                <input type="checkbox" checked="checked" onclick="window.location.href='<?php echo site_url(array( 'admin', 'addons', 'disable', $addon_namespace ));?>'"/>
                                                <span></span>
                                            </label>
                                        </span>
                                        <?php elseif (! $this->aauth->is_admin()) : ?>
                                        <span class="switch switch-outline switch-icon switch-success ml-2" >
                                            <label data-toggle="tooltip" data-placement="top" title="" data-original-title="Enable">
                                                <input type="checkbox" checked="checked" onclick="window.location.href='<?php echo site_url(array( 'admin', 'addons', 'disable', $addon_namespace ));?>'"/>
                                                <span></span>
                                            </label>
                                        </span>
                                        <?php endif;?>
                                    <?php } ?>
        
                                <?php endif;?>
                                <!-- <a href="#" class="btn btn-icon btn-sm btn-light-dark ml-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Extract">
                                    <i class="fas fa-lock"></i>
                                </a> -->
                            </div>
                        </div>

                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="text-dark-50 line-height-lg">
                            <?php echo isset($_group[ 'application' ][ 'description' ]) ? $_group[ 'application' ][ 'description' ] : '';?>
                            </span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <?php
            }
        }
        echo '</div>';
    }
else :
?>
<div class="d-flex flex-column flex-center py-10">
    <p>You have not created any addons.</p>
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
            <form class="form" action="<?php echo site_url(['admin', 'addons', 'install_zip']);?>" method="POST" enctype="multipart/form-data">
                <!--begin::Header-->
                <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5">
                    <h5 class="font-weight-bold m-0"><?php echo __('Choose the addons zip file');?></h5>
                    <div class="d-flex ml-2">
                        <span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </span>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Footer-->
                <div class="row py-5 pl-8 pr-5">
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