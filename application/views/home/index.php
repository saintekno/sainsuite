<div class="title m-b-md">
	Welcome to <?php e(class_exists('Settings_lib') ? settings_item('site.title') : 'Racik'); ?>
</div>

<p class="lead">Jumpstart your CodeIgniter applications and save yourself 100s of hours of development time.<br/>That means you make more money.</p>
<p>"Otakku hanyalah penerima sinyal di alam semesta ini. Ada sebuah pusat dimana "kita" memperoleh pengetahuan, kekuatan dan inspirasi" - <em>Nikola Tesla</em></p>

<?php if (isset($current_user->email)) : ?>
	<a href="<?php echo site_url(SITE_AREA) ?>" class="btn btn-large btn-success">Go to the Admin area</a>
<?php endif;?>