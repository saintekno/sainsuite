<?php 
echo theme_view('header');
echo theme_view('_sitenav');
?>

<!-- Content -->
<div class="flex-center position-ref full-height">          
<div class="content">

<?php
echo Template::message();
echo isset($content) ? $content : Template::content();
?>

<?php echo theme_view('footer'); ?>