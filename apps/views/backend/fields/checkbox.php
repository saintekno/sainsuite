<div class="checkbox-inline">
    <label class="checkbox">
        <input type="checkbox"
            <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
            <?php echo ($active == $value) ? 'checked="checked"' : '';?> 
            name="<?php echo $name;?>"
            value="<?php echo strip_tags( xss_clean( $value ) );?>"/>
        <span></span>
        <?php echo $label;?>
    </label>
</div>
<p class="help-block"><?php echo $description;?></p>