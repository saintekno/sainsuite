<div class="row equal">
    <?php
    global $Options;
    $modules = Modules::get();
    foreach (force_array($modules) as $_module) 
    {
        if (isset($_module[ 'application' ][ 'namespace' ])) 
        {
            $module_namespace = $_module[ 'application' ][ 'namespace' ];
            $module_version   = $_module[ 'application' ][ 'version' ];
            $last_version     = get_option( 'migration_' . $module_namespace );
            ?>
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6 box-wrap module">
                <div class="box box-solid <?php echo (riake('highlight', $_GET) == $_module[ 'application' ][ 'namespace' ] || Modules::is_active($module_namespace)) ? 'box-primary' : 'box-default' ;?>"
                    id="#module-<?php echo $_module[ 'application' ][ 'namespace' ];?>">
                    <div class="box-header with-border text-overflow">
                        <h3 class="box-title" style="line-height: 30px;">
                            <?php echo isset($_module[ 'application' ][ 'name' ]) ? $_module[ 'application' ][ 'name' ] : __('Eracik Extension');?>
                        </h3>
                        <sup>
                            <?php echo 'v' . (isset($_module[ 'application' ][ 'version' ]) ? $_module[ 'application' ][ 'version' ] : 0.1);?>
                        </sup>

                        <?php
                        $hasMigration = Modules::migration_files( 
                            $module_namespace, 
                            $last_version, 
                            $module_version
                        );

                        if( $hasMigration ):?>
                        <a href="<?php echo site_url([ 'dashboard', 'modules', 'migrate', $module_namespace, $last_version ]);?>" class="migrate-module pull-right btn btn-sm">
                            <i class="fa fa-database"></i>
                        </a>
                        <?php endif;?>
                    </div>
                    
                    <div class="box-body bg-gray-light text-overflow">
                        <small><?php echo isset($_module[ 'application' ][ 'description' ]) ? $_module[ 'application' ][ 'description' ] : '';?></small>
                    </div>

                    <div class="box-footer" <?php if (! Modules::is_active($module_namespace)):?> style="background:#F3F3F3;"<?php else: ?> style="background:#f0f0f0;" <?php endif;?>>
                        <div class="box-tools">
                            <?php
                            if (isset($_module[ 'application' ][ 'main' ])) 
                            { 
                                // if the module has a main file, it can be activated
                                if (! Modules::is_active($module_namespace)) { ?>
                                    <a href="<?php echo site_url(array( 'dashboard', 'modules', 'enable', $module_namespace ));?>"
                                        class="btn btn-sm btn-box-tool" data-action="enable">
                                        <i class="fa fa-toggle-off"></i> <span class="hidden-xs">Enable</span>
                                    </a>
                                    <?php
                                } 
                                else { ?>
                                    <a href="<?php echo site_url(array( 'dashboard', 'modules', 'disable', $module_namespace ));?>"
                                        class="btn btn-sm btn-box-tool" data-action="disable">
                                        <i class="fa fa-toggle-on text-blue"></i> <span class="hidden-xs">Disable</span>
                                    </a>
                                    <?php
                                }
                            }
                            ?>

                            <a href="<?php echo site_url(array( 'dashboard', 'modules', 'remove', $module_namespace ));?>"
                                class="btn btn-sm btn-box-tool text-red" data-action="uninstall">
                                <i class="fa fa-trash"></i>
                                <span class="hidden-xs"><?php _e('Remove');?></span>
                            </a>

                            <?php if (intval(riake('webdev_mode', $Options)) == true):?>
                                <a href="<?php echo site_url(array( 'dashboard', 'modules', 'extract', $module_namespace ));?>"
                                    class="btn btn-sm btn-box-tool text-green" data-action="extract">
                                    <i class="fa fa-get-pocket"></i>
                                    <span class="hidden-xs"><?php _e('Extract');?></span>
                                </a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>

<script>
    $(document).ready(function () {
        $('[data-action="uninstall"]').bind('click', function () {
            if (confirm(`<?php _e('Do you really want to delete this module ? ');?>`)) {
                return true;
            }
            return false;
        });

        $('.migrate-module').bind('click', function () {
            if (confirm(`<?php _e('Do you really want to make a migration ? You should always have a backup of the current system.');?>`)) {
                return true;
            }
            return false;
        });
    })
</script>