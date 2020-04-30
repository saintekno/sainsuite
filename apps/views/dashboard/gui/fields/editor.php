<div class="form-group">
    <label><?php echo $label;
        ?></label>
    <textarea id="editor-<?php echo $editor_time_called;?>"
        <?php echo $disabled === true ? 'disabled="disabled"' : '';?> class="form-control" rows="16"
        placeholder="<?php echo $placeholder;?>" name="<?php echo $name;?>"><?php echo strip_tags( xss_clean( $value ) );?></textarea>
</div>
<p><?php echo xss_clean($description);?></p><?php
