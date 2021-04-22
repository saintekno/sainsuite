<!--begin::Container-->
<?php
global $Options;

$found = true;
$addons = $this->events->apply_filters('fill_folder_addons', MY_Addon::get());
if ($addons) : 
    $groups = array();
    foreach (force_array($addons) as $addon => $_addon) 
    {
        // group subarrays by a column value
        $groups[$_addon['group']][$addon] = $_addon;
    }

    foreach ($groups as $group => $groupx) 
    {
        echo '<h4 class="pt-3">'.$group.'</h4>';
        echo '<div class="row">';
        foreach ( $groupx as $_group ) 
        {            
            if (isset($_group[ 'application' ][ 'namespace' ])) {
                $addon_namespace = $_group[ 'application' ][ 'namespace' ];
                $addon_version = $_group[ 'application' ][ 'version' ];
                $last_version = riake('migration_' . $addon_namespace, $Options);
                ?>
                <div class="col-12 col-md-6 col-lg-3 col-xxl-3">
                    <div class="card card-custom gutter-b card-stretch" data-card="true" data-card-tooltips="false">     
                        <div class="card-header min-h-20px d-flex align-items-center justify-content-between px-2 py-2">
                            <div class="text-dark m-0 text-hover-primary ml-2">
                                <span class="font-weight-bolder">
                                <?php echo isset($_group[ 'application' ][ 'name' ]) ? $_group[ 'application' ][ 'name' ] : __('Addons');?>
                                </span> | 
                                <?php echo 'v' . (isset($_group[ 'application' ][ 'version' ]) ? $_group[ 'application' ][ 'version' ] : 0.1);?>
                            </div>
                            <div>
                                <?php $this->events->do_action('do_menu_addon_header', $_group) ?>
                            </div>
                        </div>   
                        <div class="card-body bgi-no-repeat p-4 min-h-100px bg-secondary">
                            <p><?php echo $_group[ 'application' ][ 'description' ];?></p>
                        </div> 
                        <div class="p-1 min-h-40px d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                            <?php if ($this->aauth->is_admin()): // Extrax ?>
                            <a href="<?php echo site_url(array( 'admin', 'addons', 'extract', $addon_namespace ));?>" class="btn btn-icon btn-circle btn-sm btn-light-info ml-1 webdev_mode d-none" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php _e('Extract');?>">
                                <i class="fas fa-download"></i>
                            </a>
                            <?php endif; ?>

                            <?php 
                            if (! $_group[ 'application' ][ 'readonly' ] && $_group[ 'application' ][ 'package' ] != 'addkit' ) :
                                
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

                            <?php if (! MY_Addon::is_active($addon_namespace, true)) {?>
                            <?php if ( $this->aauth->is_admin() && APPNAME == 'system') : ?>
                            <a href="#" class="btn btn-circle btn-icon btn-sm btn-light-danger ml-2" 
                                data-url="<?php echo site_url(array( 'admin', 'addons', 'remove', $addon_namespace )); ?>" 
                                data-head="<?php _e( 'Would you like to delete this addon?');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"
                                onclick="deleteConfirmation(this)">
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
                            <span class="switch switch-outline switch-icon switch-success ml-2" >
                                <label data-toggle="tooltip" data-placement="top" title="" data-original-title="Enable">
                                    <input type="checkbox" checked="checked" onclick="window.location.href='<?php echo site_url(array( 'admin', 'addons', 'disable', $addon_namespace ));?>'"/>
                                    <span></span>
                                </label>
                            </span>
                            <?php };?>
                            
                            <?php endif;?>
                            </div>

                            <div class="d-flex align-items-center">
                            <?php $this->events->do_action('do_menu_addon_footer', $_group) ?>
                            </div>
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
    }
else :
    $found = false;
endif;

if(! $found) :
echo '
<div class="d-flex flex-column flex-center py-10">
    <p>You have not created any addons.</p>
</div>';
endif;
?>