<body class="register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href="<?php echo base_url();?>">
				<b><?php echo get('app_name');?></b>
			</a>
		</div>

		<div class="register-box-body">
			<p class="login-box-msg">
				<?php echo _e("Thank for having chosen Eracik to host your project. Here is the installation wizard.");?><br>
				<?php echo _e("This wizard has 2 more pages : ");?>
			</p>
			<ul class="list-group list-group-unbordered text-center">
                <li class="list-group-item">
					<b><?php echo _e("Database configuration.");?></b>
                </li>
                <li class="list-group-item">
					<b><?php echo _e("Site configuration.");?></b>
                </li>
			</ul>
			<p class="login-box-msg">
				<?php echo _e("If you're ready, let's go !!!");?>
			</p>
			<br>
			<p class="text-center">
				<a href="<?php echo site_url(array( 'do-setup', 'database' )) . (riake('lang', $_GET) ? '?lang=' . $_GET[ 'lang' ] : '');?>" class="text-center btn btn-primary">
					<?php _e('Define Database configuration');?>
				</a>
			</p>
		</div>
	</div>
	
	<?php echo $this->events->do_action( 'common_footer' );?>
</body>
</html>