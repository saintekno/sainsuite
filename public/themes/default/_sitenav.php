<div class="row">
    <div class="container">
        <ul class="nav nav-pills pull-right">
            <li <?php echo check_class('home'); ?>><a href="<?php echo site_url(); ?>"><?php e(lang('rp_home')); ?></a></li>
            <li <?php echo check_class('blog'); ?>><a href="<?php echo site_url('blog'); ?>"><?php e(lang('blog_post')); ?></a></li>
            <?php if (empty($current_user)) : ?>
            <li><a href="<?php echo site_url(LOGIN_URL); ?>">Sign In</a></li>
            <?php else : ?>
            <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('users/profile'); ?>"><?php e(lang('rp_user_settings')); ?></a></li>
            <li><a href="<?php echo site_url('logout'); ?>"><?php e(lang('rp_action_logout')); ?></a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>