<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo get('app_name') ; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $this->options_model->get('site_description');?>" />
        <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
        <meta name="author" content="<?php echo theme_config('author');?>" />
        <meta name="email" content="<?php echo theme_config('email');?>" />
        <meta name="website" content="<?php echo site_url();?>" />
        <meta name="Version" content="<?php echo theme_config('version');?>" />
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('uploads/system/favicon.png');?>">
        <!-- Bootstrap -->
        <link href="<?=base_url();?>assets/frontend/<?=theme_frontend();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Main Css -->
        <link href="<?=base_url();?>assets/frontend/<?=theme_frontend();?>css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />

    </head>

<body>