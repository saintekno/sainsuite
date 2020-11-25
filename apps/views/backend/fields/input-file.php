<div class="form-group">
    <label class="font-size-lg text-dark font-weight-bold"><?php echo $label; ?></label>
    <div class="custom-file">
        <input <?php echo $disabled === true ? 'readonly="readonly"' : '';?> 
            type="file" 
            class="custom-file-input" 
            id="<?php echo riake('id', $_item);?>" 
            name="<?php echo riake('name', $_item);?>"
            accept="<?php echo riake('accept', $_item);?>"  >
        <label class="custom-file-label" for="<?php echo riake('id', $_item);?>"><?php echo riake('description', $_item);?></label>
    </div>
</div>