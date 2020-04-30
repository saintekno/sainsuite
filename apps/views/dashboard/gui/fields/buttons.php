<div class="form-group">
    <div class="input-group">
        <?php foreach ($value as $_key => $_button) { ?>
        <input class="btn btn-sm <?php echo riake($_key, $classes, 'btn-primary');?>"
            <?php echo riake($_key, $attrs_string);?> type="<?php echo riake($_key, $buttons_types, 'submit');?>"
            name="<?php echo riake($_key, $name);?>" value="<?php echo $_button ;?>" style="margin-right:10px;">
        <?php  } ?>
    </div>
    <p class="help-block"><?php echo $description;?></p>
</div>