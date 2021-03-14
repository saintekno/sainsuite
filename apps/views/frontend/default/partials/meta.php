<?php
defined('BASEPATH') OR exit('No direct script access allowed');
global $Options;
?>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<meta name="description" content="<?php echo $Options['site_description'];?>" />
<meta name="keywords" content="<?php echo $Options['site_keywords'];?>" />
<meta name="author" content="<?php echo theme_config('author');?>" />

<meta name="email" content="<?php echo theme_config('email');?>" />
<meta name="website" content="<?php echo site_url();?>" />
<meta name="Version" content="<?php echo theme_config('version');?>" />

<!-- Site Title -->
<title><?php echo $Options['site_name']; ?> - <?php echo $Options['site_title']; ?></title>

<!-- favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('uploads/system/'.(!empty($Options['favicon']) ? $Options['favicon'] : 'favicon.png'));?>">
