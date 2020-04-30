<div class="checkbox">
    <label>
        <input type="hidden" name="gui_delete_option_field[]" value="<?php echo $name;
        ?>" />
        <input <?php echo $disabled === true ? 'disabled="disabled"' : '';?> type="checkbox"
            value="<?php echo strip_tags( xss_clean( $value ) );?>" name="<?php echo $name;?>" <?php echo $checked;?> />
        <?php echo $label;?>
    </label>
    <p class="help-block"><?php echo $description;?></p>
</div>