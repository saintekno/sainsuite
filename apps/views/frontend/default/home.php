<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo get('app_name') ; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url('uploads/system/favicon.png');?>">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,600,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 90vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-family: 'Montserrat Alternates', sans-serif;
                font-size: 2.5rem !important;
                font-weight: 600;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            @media (min-width: 768px) {
                .title {
                    font-size: 5rem !important;
                }
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .user-image {
                float: left;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                margin-right: -10px;
                margin-top: -6px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <?php if (User::is_loggedin()) : ?>
                <a href="<?=site_url('admin')?>" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="img-circle user-image" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?php echo $this->events->apply_filters('user_menu_card_avatar_src', '');?>"/>
                    <span class="hidden-xs"><?php echo xss_clean($this->events->apply_filters('user_menu_name', $this->config->item('default_user_names')));?></span> 
                </a> 
                <?php else : ?>
                <a href="<?=site_url('login')?>">Login</a>
                <?php endif; ?>
            </div>

            <div class="content">
                <div class="title m-b-md">
                <?php echo $this->options_model->get('site_name');?>
                </div>

                <span class="subtitle">
                    <small><?php echo date('Y') ?></small> &copy;
                    <?php echo $this->events->apply_filters( 'dashboard_footer_right', sprintf( __( '%s %s' ), get( 'app_name' ), get('version') ) );?>
                </span>
                <div class="links">
                    <a href="http://saintekno.id/">Powered by SainTekno</a>
                </div>
            </div>
        </div>
    </body>
</html>