<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu
{
    public static $admin_menus_core = array();
    public static function add_admin_menu_core($namespace, $config)
    {
        self::$admin_menus_core[ $namespace ][] = $config;
    }
    
    /**
     * Load Menus
     * 
     * @return void
    **/
    
    public static function load()
    {
        $core_menus = self::$admin_menus_core;

        foreach ($core_menus as $menu_namespace => $current_menu) 
        {
            // check if the first menu can be shown
            if( @$current_menu[0][ 'permission' ] != null ) {
                if( ! User::can( $current_menu[0][ 'permission' ] ) ) {
                    continue;
                }
            }

            /**
             * if the user don't have access to all the permisisons
             */
            if( @$current_menu[0][ 'some-permissions' ] && ! User::canSome( @$current_menu[0][ 'some-permissions' ] ) ) {
                continue;
            }

            $parent_status = '';
            $parent_open   = '';
            $child_status  = '';

            // Preloop, to check if this menu has an  active child
            // for displaying notice nbr count @since 1.4
            $parent_notice_count= 0; 

            foreach ($current_menu as $_menu) 
            {
                $parent_notice_count += riake('notices_nbr', $_menu);
                if (riake('href', $_menu) == current_url() ) 
                {
                    $parent_status = 'active';
                    $parent_open   = 'menu-open';
                }
            }
            $class      = is_array($current_menu) && count($current_menu) > 1 ? 'treeview' : '';
            $loop_index = 0;
            ?>
            <li class="<?php echo $parent_status . ' ' . $class . ' ' . $parent_open . ' namespace-' . $menu_namespace ;?>">
            <?php
            foreach ($current_menu as $menu) 
            {
                // var_dump( riake('href', $menu) );
                // If has more than one child
                $child_status = (riake('href', $menu) == current_url()) ? 'active' : '';
                
                // var_dump( $loop_index );
                if ($class != '') 
                {
                    if ($loop_index == 0) {
                        // First child, set a default page and first sub-menu.
                        ?>
                        <a href="javascript:void(0)"> 
                            <i class="<?php echo riake('icon', $menu, 'fa fa-star');?>"></i> 
                            <span><?php echo riake('title', $menu);?></span>
                            <span class="pull-right-container">
                                <?php if ($parent_notice_count > 0):?>
                                <span class="label label-primary pull-right"><?php echo $parent_notice_count;?></span>
                                <?php else:?>
                                <i class="fa fa-angle-left pull-right"></i>
                                <?php endif;?>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ( @$menu[ 'disable' ] == null ) : // is used to disable menu title showed as first submenu.?>
                            <li class="<?php echo $child_status;?>"> 
                                <a href="<?php echo @$menu[ 'route' ] ? site_url( 'dashboard' . implode('/', $menu[ 'route' ] ) ) : @$menu[ 'href' ];?>">
                                    <i class="fa fa-circle-o"></i>
                                    <span><?php echo @$menu[ 'title'];?></span>
                                    <?php if ( @$menu[ 'notices_nbr' ] == true):?>
                                    <span class="pull-right-container">
                                        <span class="label pull-right bg-green"><?php echo $menu[ 'notices_nbr' ];?></span>
                                    </span>
                                    <?php endif;?> 
                                </a> 
                            </li>	
                            <?php endif;
                    } else {
                        if( $loop_index > 0 ) 
                        {
                            // check if the first menu can be shown
                            if( @$current_menu[$loop_index][ 'permission' ] != null ) 
                            {
                                if( ! User::can( $current_menu[$loop_index][ 'permission' ] ) ) 
                                {
                                    if ($loop_index == (count($current_menu) - 1)) 
                                    {
                                        echo '</ul>';
                                    }

                                    $loop_index++;
                                    continue;
                                }
                            }

                            if( @$current_menu[ $loop_index ][ 'some-permissions' ] && ! User::canSome( @$current_menu[ $loop_index ][ 'some-permissions' ] ) ) 
                            {
                                if ( $loop_index == ( count( $current_menu ) - 1 ) ) {
                                    echo '</ul>';
                                }

                                $loop_index++;
                                continue;
                            }
                        }
                        // after the first child, all are included as sub-menu
                        ?>
                        <li class="<?php echo $child_status;?>"> 
                            <a href="<?php echo @$menu[ 'route' ] ? site_url( 'dashboard' . implode('/', $menu[ 'route' ] ) ) : @$menu[ 'href' ];?>">
                                <i class="fa fa-circle-o"></i>
                                <span><?php echo riake('title', $menu);?></span>
                                <?php if( @$menu[ 'notices_nbr' ] ):?>
                                <span class="pull-right-container">
                                    <span class="label pull-right bg-green"><?php echo riake('notices_nbr', $menu);?></span>
                                </span>
                                <?php endif;?> 
                            </a> 
                        </li>
                        <?php
                    }
                    
                    if ($loop_index == (count($current_menu) - 1)) 
                    {
                        echo '</ul>';
                    }
                } 
                else 
                { 
                    ?>
                    <a href="<?php echo riake('href', $menu, '#');?>"> 
                        <i class="<?php echo riake('icon', $menu, 'fa fa-star');?>"></i> 
                        <span><?php echo riake('title', $menu);?> </span>
                        <?php if( @$menu[ 'notices_nbr' ] ):?>
                        <span class="pull-right-container">
                            <span class="label pull-right bg-green"><?php echo riake('notices_nbr', $menu);?></span>
                        </span>
                        <?php endif;?>
                    </a>
                    <?php	
                }
                $loop_index++; // increment loop_index
            }
            ?>
            </li>
            <?php
        }
    }
}
