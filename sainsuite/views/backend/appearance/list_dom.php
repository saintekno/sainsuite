<!--begin::Container-->
<?php
global $Options;

$found = true;
$themes = $this->events->apply_filters('fill_folder_themes', Theme::get());
if ($themes) :
    $groups = array();
    foreach (force_array($themes) as $theme => $_theme) 
    {
        // group subarrays by a column value
        $groups[$_theme['group']][$theme] = $_theme;
    }

    foreach ($groups as $group => $groupx) 
    {
        echo '<h4 class="pt-3">'.$group.'</h4>';
        echo '<div class="row">';
        foreach ( $groupx as $_group ) 
        {            
            if (isset($_group[ 'theme' ][ 'namespace' ])) {
                $theme_namespace = $_group[ 'theme' ][ 'namespace' ];
                $theme_version = $_group[ 'theme' ][ 'version' ];
                ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-custom gutter-b card-stretch" data-card="true" data-card-tooltips="false">     
                        <div class="card-header min-h-20px d-flex align-items-center justify-content-between px-2 py-2">
                            <div class="text-dark m-0 text-hover-primary ml-2">
                                <span class="font-weight-bolder">
                                <?php echo isset($_group[ 'theme' ][ 'name' ]) ? $_group[ 'theme' ][ 'name' ] : __('themes');?>  
                                </span> | 
                                <?php echo 'v' . $theme_version;?>
                            </div>
                            <div>
                                <?php $this->events->do_action('do_menu_theme_header', $_group) ?>
                            </div>
                        </div>   
                        <div class="card-body bgi-no-repeat p-4 min-h-100px bg-secondary">
                            <p><?php echo $_group[ 'theme' ][ 'description' ];?></p>
                        </div> 
                        <div class="p-1 min-h-40px d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                            <?php if ($this->aauth->is_admin()):?>
                            <a href="<?php echo site_url(array( 'admin', 'appearance', 'extract', $theme_namespace ));?>" 
                                class="btn btn-icon btn-sm btn-light-info ml-1 webdev_mode d-none">
                                <i class="fas fa-download"></i> 
                            </a>
                            <?php endif; ?>

                            <?php if (! $_group[ 'theme' ][ 'readonly' ]) : ?>
                            <?php if (! Theme::is_active($theme_namespace, true)) : ?>
                            <a href="<?php echo site_url(array( 'admin', 'appearance', 'enable', $theme_namespace ));?>" 
                                class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase ml-2 my-1" data-action="enable">
                                <i class="fa fa-toggle-on"></i> active
                            </a>

                            <?php if ( User::control('delete.themes') && APPNAME == 'system') : ?>
                            <a href="#" class="btn btn-sm btn-danger font-weight-bolder text-uppercase ml-2 my-1"
                                data-head="<?php _e( 'Would you like to delete this theme?');?>"
                                data-url="<?php echo site_url(array( 'admin', 'appearance', 'remove', $theme_namespace )); ?>"
                                onclick="deleteConfirmation(this)">
                                <i class="fa fa-trash p-0"></i>
                            </a>
                            <?php endif;?>
                            <?php else : ?>
                            <span class="label label-xl label-primary label-inline ml-2 my-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Theme Active">
                                active
                            </span>
                            <?php endif; ?>
                            <?php endif; ?>
                            </div>

                            <div class="d-flex align-items-center">
                            <?php $this->events->do_action('do_menu_theme_footer', $_group) ?>
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
    <p>You have not created any themes.</p>
</div>';
endif;
?>
<!--end::Body-->