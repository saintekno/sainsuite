
<div class="d-flex align-items-center justify-content-center">
	<!-- Card -->
	<div class="card my-7" style="width: 460px; max-width: 100%;">
		<!-- Card Body -->
		<div class="card-body p-4 p-lg-7">
			<h2 class="text-center mb-4"><?php echo lang('us_login'); ?></h2>

			<?php echo Template::message(); ?>

			<?php if (validation_errors()) : ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert alert-error fade in">
					<a data-dismiss="alert" class="close">&times;</a>
						<?php echo validation_errors(); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<!-- Sign in Form -->
			<?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
				<!-- Email -->
				<div class="form-group <?php echo iif( form_error('login') , 'error') ;?>">
					<label for="login_value"><?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('rp_username') .'/'. lang('rp_email') : ucwords($this->settings_lib->item('auth.login_type')) ?></label>
					<input class="form-control" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('rp_username') .'/'. lang('rp_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>">
				</div>
				<!-- End Email -->

				<!-- Password -->
				<div class="form-group <?php echo iif( form_error('password') , 'error') ;?>">
					<label for="password"><?php echo lang('rp_password'); ?></label>
					<input class="form-control" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('rp_password'); ?>">
				</div>
				<!-- End Password -->

				<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
				<div class="d-flex align-items-center justify-content-between my-4">
					<!-- Remember -->
					<div class="custom-control custom-checkbox">
						<input name="remember_me" id="remember_me" value="1" tabindex="3" class="custom-control-input" type="checkbox">
						<label class="custom-control-label text-dark" for="remember_me"><?php echo lang('us_remember_note'); ?></label>
					</div>
					<!-- End Remember -->

					<?php echo anchor('/forgot_password', lang('us_forgot_your_password'), 'class="font-weight-semi-bold"'); ?>
				</div>
				<?php endif; ?>

				<button type="submit" name="log-me-in" tabindex="5" class="btn btn-block btn-wide btn-primary text-uppercase"><?php e(lang('us_let_me_in')); ?></button>

				<?php if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
					<!-- // show for Email Activation (1) only -->
					<!-- Activation Block -->
					<p style="text-align: left" class="well">
						<?php echo lang('rp_login_activate_title'); ?><br />
						<?php
						$activate_str = str_replace('[ACCOUNT_ACTIVATE_URL]',anchor('/activate', lang('rp_activate')),lang('rp_login_activate_email'));
						$activate_str = str_replace('[ACTIVATE_RESEND_URL]',anchor('/resend_activation', lang('rp_activate_resend')),$activate_str);
						echo $activate_str; 
						?>
					</p>
				<?php endif; ?>
				
				<p class="text-center mb-0">
					Don’t have an account?
					<?php
					$site_open = $this->settings_lib->item('auth.allow_register');
					if ( $site_open ) : 
					echo anchor(REGISTER_URL, lang('us_sign_up'), 'class="font-weight-semi-bold"');
					endif; 
					?>
				</p>
			</form>
			<!-- End Sign in Form -->
		</div>
		<!-- End Card Body -->
	</div>
	<!-- End Card -->
</div>