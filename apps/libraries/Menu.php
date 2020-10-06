<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu 
{
    public static $setting_menus_core = array();
    public static $report_menus_core = array();
    public static $apps_menus_core = array();
    public static $toolbar_menus_core = array();
    public static $system_menus_core = array();

    /**
     * Add Menu
     */
    public static function add_setting_menu($namespace, $config)
    {
        self::$setting_menus_core[ $namespace ][] = $config;
    }

    public static function add_report_menu($namespace, $config)
    {
        self::$report_menus_core[ $namespace ][] = $config;
    }

    public static function add_apps_menu($namespace)
    {
        self::$apps_menus_core[] = $namespace;
    }

    public static function add_system_menu($namespace)
    {
        self::$system_menus_core[] = $namespace;
    }

    public static function add_toolbar_menu($namespace)
    {
        self::$toolbar_menus_core[] = $namespace;
    }

    /**
     * Load Menu
     */
    public static function load_setting_menu()
    {
        self::load_menu('setting', self::$setting_menus_core);
    }

    public static function load_report_menu()
    {
        self::load_menu('report', self::$report_menus_core);
    }

    public static function load_menu($section, $core_menus)
    {
        if ($core_menus) : ?>
        <li class="menu-section m-0">
            <h4 class="menu-text text-light"><?php _e($section);?></h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>
        <?php endif;
        
        foreach ($core_menus as $menu_namespace => $current_menu) {
            $custom_ul_style = '';
            $attr = '';
            // Preloop, to check if this menu has an  active child
            $parent_notice_count = 0;  // for displaying notice nbr count @since 1.4
            foreach ($current_menu as $_menu) 
            {
                $parent_notice_count += riake('notices_nbr', $_menu);
                if (riake('href', $_menu) == current_url() && is_array($current_menu) && count($current_menu) > 1) 
                {
                    $custom_ul_style = 'menu-item-open menu-item-here';
                    $attr = 'data-menu-toggle="hover"'; 
                }
                else if (riake('href', $_menu) == current_url()) {
                    $custom_ul_style = 'menu-item-active';
                    $attr = '';
                }
            }
            $class = is_array($current_menu) && count($current_menu) > 1 ? 'menu-item-submenu' : '';
            
            $loop_index = 0;
            ?>
            <li class="menu-item <?php echo $class . ' ' . $custom_ul_style;?>" <?php echo $attr;?>>
            <?php
            $custom_style = '';
            foreach ($current_menu as $menu) 
            {
                if ($class != '') 
                {
                    $custom_style = (riake('href', $menu) == current_url()) ? 'menu-item-active' : '';
                    // First child, set a default page and first sub-menu.
                    if ($loop_index == 0) : ?>
                        <a href="javascript:void(0)" class="menu-link menu-toggle"> 
                            <span class="svg-icon menu-icon">
                            <?php include asset_path().riake('icon', $menu, 'svg/tambah.svg');?>
                            </span>
                            <span class="menu-text"><?php echo riake('title', $menu);?></span>
                            <i class="menu-arrow"></i>
                            <?php if ($parent_notice_count > 0):?>
                            <small class="label pull-right bg-yellow"><?php echo $parent_notice_count;?></small>
                            <?php endif;?>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            
                            <ul class="menu-subnav">
                                <?php if ( @$menu[ 'disable' ] == null ) : // is used to disable menu title showed as first submenu.?>
                                <li class="menu-item <?php echo $custom_style;?>" aria-haspopup="true"> 
                                    <a href="<?php echo @$menu[ 'route' ] ? site_url( 'admin' . implode('/', $menu[ 'route' ] ) ) : @$menu[ 'href' ];?>" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text"><?php echo @$menu[ 'title'];?></span>
                                        <?php if ( @$menu[ 'notices_nbr' ] == true):?>
                                        <small class="label pull-right bg-yellow"><?php echo $menu[ 'notices_nbr' ];?></small>
                                        <?php endif;?>                 
                                    </a> 
                                </li>	
                                <?php endif;?>
                    <!-- // after the first child, all are included as sub-menu -->
                    <?php else : ?>
                        <li class="menu-item <?php echo $custom_style;?>" aria-haspopup="true"> 
                            <a href="<?php echo @$menu[ 'route' ] ? site_url( 'admin' . implode('/', $menu[ 'route' ] ) ) : @$menu[ 'href' ];?>" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span>
                                </i>
                                <span class="menu-text"><?php echo riake('title', $menu);?></span>
                                <?php if( @$menu[ 'notices_nbr' ] ):?>
                                 <small class="label pull-right bg-yellow"><?php echo riake('notices_nbr', $menu);?></small>
                                <?php endif;?>
                            </a> 
                        </li>	
                    <?php endif;
                    
                    if ($loop_index == (count($current_menu) - 1)) {
                        echo '</ul></div>';
                    }
                } 
                else { 
                    ?>
                    <a href="<?php echo riake('href', $menu, '#');?>" class="menu-link btn btn-hover-dark"> 
                        <span class="svg-icon menu-icon">
                        <?php include asset_path().riake('icon', $menu, 'svg/Library.svg');?>
                        </span>
                        <span class="menu-text"><?php echo riake('title', $menu);?></span> 
                        <?php if( @$menu[ 'notices_nbr' ] ):?>
                            <small class="label pull-right bg-yellow"><?php echo riake('notices_nbr', $menu);?></small>
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

    public static function load_apps_menu()
    {
        if (self::$apps_menus_core) :
            foreach (self::$apps_menus_core as $menu_namespace => $current_menu) { 
                $custom_style = (riake('href', $current_menu) == current_url()) ? 'active' : '';
                ?>
                <!--begin::Item-->
                <a href="<?php echo riake('href', $current_menu);?>" class="list-item hoverable p-2 mb-2 d-block <?php echo $custom_style;?>">
                    <div class="d-flex align-items-center">

                        <div class="symbol symbol-40 mr-4">
                            <span class="symbol-label">
                                <img src="<?php echo asset_url(riake('icon', $current_menu));?>" />
                            </span>
                        </div>

                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <span class="text-light font-size-h6 mb-0"><?php echo riake('title', $current_menu);?></span>
                        </div>
                    </div>
                </a>
                <?php
            }
        else : ?>
            <a href="<?php echo site_url('admin/addons');?>" class="list-item list-border d-block p-2 mb-2">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40 mr-4">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g id="Stockholm-icons-/-Navigation-/-Plus" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="Rectangle-185" fill="#000000" x="4" y="11" width="16" height="2" rx="1"></rect>
                                    <rect id="Rectangle-185-Copy" fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"></rect>
                                </g>
                            </svg>
                        </span>
                    </div>

                    <div class="d-flex flex-column flex-grow-1 mr-2">
                        <span class="font-size-h6 mb-0">Install AddOns</span>
                    </div>
                </div>
            </a>
        <?php endif;
    }

    public static function load_system_menu()
    {
        foreach (self::$system_menus_core as $menu_namespace => $current_menu) { 
            ?>
            <!--begin::Item-->
            <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?php echo riake('title', $current_menu); ?>">
                <a href="<?php echo riake('href', $current_menu); ?>" class="nav-link btn btn-icon btn-clean btn-lg">
                    <span class="svg-icon svg-icon-xl">
                    <?php include asset_path().riake('icon', $current_menu);?>
                    </span>
                </a>
            </li>
            <?php
        }
    }

    public static function load_toolbar_menu()
    {
        foreach (self::$toolbar_menus_core as $menu_namespace => $current_menu) { 
            ?>
            <a href="<?php echo riake('href', $current_menu); ?>" class="btn <?php echo riake('button', $current_menu); ?> font-weight-bolder btn-sm mr-2">
                <i class="ki ki-plus icon-1x p-0"></i>
                <span class="d-none d-md-inline"><?php echo riake('title', $current_menu); ?></span> 
            </a>
            <?php
        }
    }
}