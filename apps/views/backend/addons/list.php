<div class="row">
<?php
global $Options;
$addons = Addons::get();
if ($addons) :
foreach (force_array($addons) as $_addon) 
{
    if (isset($_addon[ 'application' ][ 'namespace' ])) 
    {
        $addon_namespace = $_addon[ 'application' ][ 'namespace' ];
        $addon_version = $_addon[ 'application' ][ 'version' ];
        $last_version = get_option( 'migration_' . $addon_namespace );
        ?>
        <!--begin::Col-->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div data-namespace="<?php echo $_addon[ 'application' ][ 'namespace' ];?>" 
                    data-name="<?php echo $_addon[ 'application' ][ 'name' ];?>" 
                    class="card-body pt-4 <?php echo (riake('highlight', $_GET) == $_addon[ 'application' ][ 'namespace' ]) ? 'box-primary' : '' ;?> "
                    id="#module-<?php echo $_addon[ 'application' ][ 'namespace' ];?>" <?php if (! Addons::is_active($addon_namespace, true)):?>  <?php endif;?>>
                   
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end">
                        <?php if (intval(riake('webdev_mode', $Options)) == true):?>
                        <div class="dropdown dropdown-inline" data-toggle="tooltip"
                            title="<?php echo __( 'Options' );?>" data-placement="left">
                            <a href="#"
                                class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <?php if( !$_addon[ 'application' ][ 'readonly' ] ) : ?>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-header font-weight-bold py-4">
                                        <span class="font-size-lg">Choose Label:</span>
                                        <i class="flaticon2-information icon-md text-muted"
                                            data-toggle="tooltip" data-placement="right"
                                            title="Click to learn more..."></i>
                                    </li>
                                    <li class="navi-separator mb-3 opacity-70"></li>
                                    <li class="navi-item">
                                        <a href="<?php echo site_url(array( 'admin', 'addons', 'extract', $addon_namespace ));?>" class="navi-link">
                                            <span class="navi-icon"><i class="flaticon2-rocket-1"></i></span>
                                            <span class="navi-text">
                                            <?php _e('Extract');?>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="navi-separator mt-3 opacity-70"></li>
                                    <li class="navi-item">
                                        <a href="<?php echo site_url(array( 'admin', 'addons', 'sync', $addon_namespace ));?>" class="navi-link">
                                            <span class="navi-icon"><i class="flaticon2-writing"></i></span>
                                            <span class="navi-text">
                                            <?php _e('Sync');?>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>
                    </div>
                    
                    <!--begin::User-->
                    <div class="d-flex align-items-center mb-7">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-4">
                            <span class="svg-icon svg-icon-3x svg-icon-primary m-0"> 
                            <?php include asset_path().'svg/Puzzle.svg';?>
                            </span>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
                            <?php echo isset($_addon[ 'application' ][ 'name' ]) ? $_addon[ 'application' ][ 'name' ] : __('Addons');?>    
                            </a>
                            <span class="text-muted font-weight-bold">
                            <?php echo 'v' . (isset($_addon[ 'application' ][ 'version' ]) ? $_addon[ 'application' ][ 'version' ] : 0.1);?>
                            </span>
                        </div>
                        <!--end::Title-->
                    </div>

                    <p class="mb-7">
                    <?php echo isset($_addon[ 'application' ][ 'description' ]) ? $_addon[ 'application' ][ 'description' ] : '';?>
                    </p>

                    <?php
                    if (isset($_addon[ 'application' ][ 'main' ])) { // if the module has a main file, it can be activated
                        if (! Addons::is_active($addon_namespace, true)) {?>
                            <a href="<?php echo site_url(array( 'admin', 'addons', 'enable', $addon_namespace ));?>" 
                            class="btn btn-sm btn-light-success font-weight-bolder text-uppercase my-1" data-action="enable">
                                <i class="fa fa-toggle-on"></i> Enable
                            </a>
                            <?php
                        } else {?>
                            <a href="<?php echo site_url(array( 'admin', 'addons', 'disable', $addon_namespace ));?>" 
                            class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase my-1" data-action="disable">
                                <i class="fa fa-toggle-off"></i> Disable
                            </a>
                            <?php
                        }
                    }?>

                    <?php if( !$_addon[ 'application' ][ 'readonly' ] ) : ?>
                    <a href="<?php echo site_url(array( 'admin', 'addons', 'remove', $addon_namespace ));?>"
                        class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase" data-action="uninstall">
                        <i class="fa fa-trash"></i>
                        <?php _e('Remove');?>
                    </a>
                    <?php endif; ?>
                    
                    <?php
                    $hasMigration = Addons::migration_files( 
                        $addon_namespace, 
                        $last_version, 
                        $addon_version
                    );

                    if( $hasMigration ):?>
                    <a href="<?php echo site_url([ 'admin', 'addons', 'migrate', $addon_namespace, $last_version ]);?>" 
                        class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase"><i class="fa fa-database"></i> Migrate</a>
                    <?php endif;?>
                </div>
                <!--end::Body-->
            </div>
            <!--end:: Card-->
        </div>
        <?php
    }
}
else :
?>
<div class="offset-md-3 col-md-6">
    <span class="svg-icon svg-icon-full">
        <?php include asset_path().'svg/mascot.svg';?>
    </span>
</div>
<?php
endif;
?>
</div>