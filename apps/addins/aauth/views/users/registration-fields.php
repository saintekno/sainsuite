<div class="form-group mb-3">
    <input type="text" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="<?php _e('User Name', 'aauth'); ?>" name="username" value="<?php echo set_value('username'); ?>">
</div>
<div class="form-group mb-3">
    <input type="email" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="<?php _e('Email', 'aauth'); ?>" name="email" value="<?php echo set_value('email'); ?>">
</div>
<div class="form-group mb-3">
    <input type="password" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="<?php _e('Password', 'aauth'); ?>" name="password">
</div>
<div class="form-group mb-3">
    <input type="password" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="<?php _e('Confirm', 'aauth'); ?>" name="confirm">
</div>
<button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm"><?php echo _e('Sign In', 'aauth') ?></button>