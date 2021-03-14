<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<HTML class="no-js" lang="en">
<HEAD>
    <?php include('partials/meta.php');?>
    
    <!-- Bootstrap -->
    <link href="<?=fasset_url();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Main Css -->
    <link href="<?=fasset_url();?>css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
</HEAD>
<BODY class="body">
    <!-- Header STart -->
    <?php include('partials/header.php');?>
    
    <?php include('pages/'.$pages.'.php');?>

    <!-- javascript -->
    <script src="<?=fasset_url();?>js/jquery-3.5.1.min.js"></script>
    <script src="<?=fasset_url();?>js/bootstrap.bundle.min.js"></script>
    <script src="<?=fasset_url();?>js/feather.min.js"></script>
    <script src="<?=fasset_url();?>js/app.js"></script>
</BODY>
</HTML>