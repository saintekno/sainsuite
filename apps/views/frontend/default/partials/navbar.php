<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a class="logo" href="<?=site_url();?>">
                <img src="<?php echo base_url('uploads/system/logo-dark.png');?>" height="35" alt="">
            </a>
        </div>                      
        <div class="buy-button">
            <?php if (User::is_loggedin()) : ?>
            <a href="<?=site_url('admin')?>" class="btn btn-primary">
                <img class="img-fluid avatar avatar-ex-sm mr-2 rounded-circle user-image" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>"/>
                <span class="hidden-xs"><?php echo xss_clean($this->events->apply_filters('user_menu_name', $this->config->item('default_user_names')));?></span> 
            </a> 
            <?php else : ?>
            <a href="<?=site_url('login')?>" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div><!--end login button-->
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>
        
        <div id="navigation">
            <!-- Navigation Menu-->   
            <ul class="navigation-menu">
                <li><a href="javascript:void(0)">Documentation</a></li>
                <li><a href="javascript:void(0)">Changelog</a></li>
                <li><a href="javascript:void(0)">Addons</a></li>
            </ul><!--end navigation menu-->
            <div class="buy-menu-btn d-none">
                <?php if (User::is_loggedin()) : ?>
                <a href="<?=site_url('admin')?>" class="btn btn-primary">
                    <img class="img-fluid avatar avatar-ex-sm mr-2 rounded-circle user-image" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>"/>
                    <span><?php echo xss_clean($this->events->apply_filters('user_menu_name', $this->config->item('default_user_names')));?></span> 
                </a> 
                <?php else : ?>
                <a href="<?=site_url('login')?>" class="btn btn-primary">Login</a>
                <?php endif; ?>
            </div><!--end login button-->
        </div><!--end navigation-->
    </div><!--end container-->
</header><!--end header-->