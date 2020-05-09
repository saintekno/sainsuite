<body class="<?php echo xss_clean($this->events->apply_filters('dashboard_body_class', 'skin-blue'));?> sidebar-mini" <?php echo xss_clean($this->events->apply_filters('dashboard_body_attrs', 'ng-app="eracikApp"'));?>>
    <?php echo $this->events->do_action( 'before_body_content' );?>
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container-fluid">
                    <div class="header-content">
                        <div class="navbar-header-custom">
                            <a href="<?php echo site_url(array( 'dashboard' ));?>" class="navbar-brand"><?php echo xss_clean($this->events->apply_filters('dashboard_logo_long', $this->config->item('Do_logo_long')));?></a>
                            <?php
                            // Module
                            if ( ( 
                                    User::can('install_modules') ||
                                    User::can('update_modules') ||
                                    User::can('extract_modules') ||
                                    User::can('delete_modules') ||
                                    User::can('toggle_modules')
                                ) && ! $this->config->item( 'hide_modules' )
                            ) {
                                ?>
                                <ul class="nav navbar-nav navbar-sub-nav">
                                    <li><a href="<?=site_url(array( 'dashboard', 'modules' ))?>"><i class="fa fa-puzzle-piece"></i> <span class="hidden-xs" style="font-size: 12px"><?=__('Modules')?></span></a></li>
                                </ul>
                                <?php
                            }
                            // Setting
                            if (
                                User::can('create_options') ||
                                User::can('read_options') ||
                                User::can('edit_options') ||
                                User::can('delete_options')
                             ) {
                                ?>
                                <ul class="nav navbar-nav navbar-sub-nav">
                                    <li><a href="<?=site_url(array( 'dashboard', 'settings' ))?>"><i class="fa fa-cogs"></i> <span class="hidden-xs" style="font-size: 12px"><?=__('Settings')?></span></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                            <?php echo $this->events->apply_filters( 'Do_spinner', '<div class="pull-left" style="margin: 10px 10px 0 0; width:10px" id="spinner"></div>' );?>
                        </div>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <?php 
                                // <!-- Messages: style can be found in dropdown.less-->
                                $this->events->do_action('display_admin_header_menu');

                                // Fetch notices from filter "ui_notices".
                                $ui_notices = $this->events->apply_filters('ui_notices', array());
                                $this->notice->push_notice_ui($ui_notices);

                                // Fetch declared notices
                                $notices     = $this->notice->get_notices();
                                $notices_nbr = count($notices);
                                ?>
                                <!-- Notifications Dropdown Menu -->
                                <li class="dropdown notifications-menu"> 
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                        <i class="fa fa-bell"></i>
                                        <i class="fa fa-angle-down"></i>
                                        <?php if ($notices_nbr > 0):?>
                                        <span class="label label-warning"><?php echo $notices_nbr;?></span>
                                        <?php endif;?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header"><?php echo sprintf(__('You have %s notices'), count($notices));?></li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                            <?php foreach ($notices as $notice):
                                                if ( isset($notice[ 'icon' ])) {
                                                    $notice_icon = @$notice[ 'icon' ];
                                                } 
                                                else {
                                                    switch ( @$notice[ 'type' ]) {
                                                        case 'success' : $notice_icon = 'thumbs-up'; break;
                                                        case 'warning' : $notice_icon = 'warning'; break;
                                                        default : $notice_icon = 'info-circle'; break;
                                                    }
                                                }?>
                                                <li>
                                                    <a href="<?php echo xss_clean( @$notice[ 'href' ]);?>">
                                                        <i class="fas fa-<?php echo xss_clean($notice_icon);?>"></i> 
                                                        <?php echo xss_clean( @$notice[ 'message' ] );?>
                                                        <small class="pull-right remove_ui_notice"
                                                            data-prefix="<?php echo @$notice[ 'prefix' ];?>"
                                                            data-namespace="<?php echo @$notice[ 'namespace' ];?>">
                                                            <i class="fa fa-remove"></i>
                                                        </small>
                                                    </a>
                                                </li>
                                            <?php endforeach;?>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <script type="text/javascript">
                                $( document ).ready( function(){
                                    $( '.remove_ui_notice' ).bind( 'click', function(e){
                                        $this       = $( this );
                                        var url     = '<?php echo site_url( array( 'rest', 'core', 'app_cache', 'clear' ) );?>/' + $( this ).attr( 'data-namespace' ) + '/' + $( this ).attr( 'data-prefix' );
                                        $.ajax({
                                            url     : url,
                                            method  : 'DELETE',
                                            success : function(){
                                                $this.closest( 'li' ).fadeOut( 500, function(){
                                                    $(this).remove();
                                                });
                                            }
                                        })
                                        return false;
                                    })
                                })
                                </script>

                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu"> 
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="user-image" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>"/>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img class="img-circle" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>"/>
                                            <p><?php echo xss_clean($this->events->apply_filters('user_menu_card_header', $this->config->item('default_user_names')));?></p>
                                        </li>
                                        <!-- Menu Body -->
                                        <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo xss_clean($this->events->apply_filters('user_header_profile_link', '#'));?>" class="btn btn-default btn-flat"><?php _e('Profile');?></a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo xss_clean($this->events->apply_filters('user_header_sign_out_link', site_url(array( 'logout' )) . '?redirect=' . urlencode(current_url())));?>" class="btn btn-default btn-flat"><?php _e('Sign Out');?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="navbar-toggler" style="color:#fff">
                            <i class="fa fa-ellipsis-h"></i>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
