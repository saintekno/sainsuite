<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <!-- Add Scale for mobile devices, -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- End Add Scale for mobile devices -->

    <title><?php echo $title;?></title>
    <link rel="favicon" href="<?php echo base_url().'favicon.ico' ?>">
    
    <?php $this->events->do_action( 'common_header' );?>
</head>

<body class="register-page">
    <?php include $page_name.'.php'; ?>
    
    <?php $this->events->do_action( 'common_footer' );?>
</body>
</html>