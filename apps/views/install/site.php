<div class="register-box">
	<div class="register-logo">
		<a href="<?php echo base_url();?>">
			<b><?php echo get('app_name');?></b>
		</a>
	</div>

	<div class="register-box-body">
		<p class="login-box-msg"><?php _e('Define site settings');?></p>
        
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo strip_tags(validation_errors())?>
            </div>
        <?php endif; ?>

		<form method="post">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="<?php _e('Site Name');?>" name="site_name" value="<?php echo set_value('site_name');?>">
			</div>
			<div class="input-group">
				<span class="input-group-btn">
					<span class="btn btn-default" type="submit"><i class="fa fa-language"></i></span>
				</span>
				<select type="text" class="form-control" name="lang">
					<?php
					foreach (get_instance()->config->item('supported_languages') as $key => $value)  : ?>
						<option <?php echo $key == riake('lang', $_GET) ? 'selected="selected"': ''; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="<?php _e('User Name' );?>" name="username" value="<?php echo set_value('username');?>">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="<?php _e('Email' ); ?>" name="email" value="<?php echo set_value('email'); ?>">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="<?php _e('Password' ); ?>" name="password" value="<?php echo set_value('password'); ?>">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="<?php _e('Password confirm' ); ?>" name="confirm" value="<?php echo set_value('confirm'); ?>">
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>
			
			<div class="row">
				<div class="col-md-12">   
					<button type="submit" class="btn btn-primary btn-block btn-flat">
						<?php _e('Continue to dashboard');?>
					</button>
				</div><!-- /.col -->
			</div>
		</form>        
	</div>
</div>