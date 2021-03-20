<?php
defined('BASEPATH') or exit('No direct script access allowed');
global $Options;
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Add Scale for mobile devices, -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="<?php echo riake('site_description', $Options); ?>" />
<meta name="keywords" content="<?php echo riake('site_keywords', $Options); ?>" />
<meta name="author" content="<?php echo $this->aauth->config_vars['name']; ?>" />
<meta name="email" content="<?php echo $this->aauth->config_vars['email']; ?>" />
<meta name="website" content="<?php echo site_url(); ?>" />
<meta name="Version" content="<?php echo get('version'); ?>" />

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<link rel="canonical" href="http://saintekno.id" />

<!-- favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo upload_url(($favicon = riake('favicon', $Options)) ? $favicon : 'system/favicon.png'); ?>">

<!-- Site Title -->
<title><?php echo Polatan::get_title(); ?></title>