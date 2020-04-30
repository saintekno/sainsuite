<div class="form-group">
    <label><?php echo $label;
        ?></label>
    <textarea <?php echo $disabled === true ? 'disabled="disabled"' : '';?> class="form-control" rows="3"
        placeholder="<?php echo $placeholder;?>" name="<?php echo $name;?>"><?php echo strip_tags( xss_clean( $value ) );?></textarea>
    <p><?php echo xss_clean($description);?></p>
</div>