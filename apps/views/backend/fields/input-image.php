<div class="image-input image-input-empty image-input-outline mb-5" id="<?php echo riake('id', $_item);?>" style="background-image: url(<?php echo User::get_gravatar(false);?>)">
	<div class="image-input-wrapper" style="background-image: url(<?php echo (riake('value', $_item)) ? User::get_user_image_url(riake('value', $_item)) : '';?>)"></div>

	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="<?php _e('Change avatar');?>">
		<i class="fa fa-pen icon-sm text-muted"></i>
		<input type="file" name="<?php echo riake('name', $_item);?>" accept="<?php echo riake('accept', $_item);?>"/>
		<input type="hidden" name="<?php echo riake('name', $_item);?>_remove"/>
	</label>

	<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="<?php _e('Cancel avatar');?>">
		<i class="ki ki-bold-close icon-xs text-muted"></i>
	</span>

	<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="<?php _e('Remove avatar');?>">
		<i class="ki ki-bold-close icon-xs text-muted"></i>
	</span>
</div>

<script>
var avatar = new KTImageInput('<?php echo riake('id', $_item);?>');
avatar.on('cancel', function(imageInput) {});
avatar.on('change', function(imageInput) {});
avatar.on('remove', function(imageInput) {});
</script>