<?php
defined('BASEPATH') or exit('No direct script access allowed');
global $Options;
?>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="on" http-equiv="cleartype"/>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo riake('site_description', $Options); ?>" />
<meta name="keywords" content="<?php echo riake('site_keywords', $Options); ?>" />
<meta name="author" content="<?php echo theme_config('author');?>" />
<meta name="email" content="<?php echo theme_config('email');?>" />
<meta name="website" content="<?php echo site_url();?>" />
<meta name="Version" content="<?php echo theme_config('version');?>" />

<meta property="og:url" content="<?php echo site_url();?>">
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo riake('site_title', $Options); ?>">
<meta property="og:description" content="<?php echo riake('site_description', $Options); ?>">
<meta property="og:image" content="<?=fasset_url();?>preview.jpg" />
<meta name="og:image" content="<?=fasset_url();?>preview.jpg" />

<meta name="twitter:title" content="<?php echo riake('site_title', $Options); ?>" />
<meta name="twitter:description" content="<?php echo riake('site_description', $Options); ?>" />
<meta property="twitter:image" content="<?=fasset_url();?>preview.jpg" />
<meta content="true" name="HandheldFriendly"/>
<meta content="320" name="MobileOptimized"/>
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta content="black-translucent" name="apple-mobile-web-app-status-bar-style"/>
<meta content="telephone=no" name="format-detection"/>
<meta content="address=no" name="format-detection"/>

<link rel="icon" size="16x16" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="icon" size="96x96" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="icon" size="32x32" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="icon" size="192x192" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="apple-touch-icon" size="16x16" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="apple-touch-icon" size="96x96" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="apple-touch-icon" size="32x32" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>
<link rel="apple-touch-icon" size="192x192" type="image/png" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>"/>

<!-- favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>">
<link rel="canonical" href="<?php echo site_url();?>">
    
<!-- Site Title -->
<title><?php echo $Options['site_name']; ?> - <?php echo $Options['site_title']; ?></title>