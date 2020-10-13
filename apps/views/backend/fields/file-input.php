<div class="form-group">
    <label class="font-size-lg text-dark font-weight-bold"><?php echo $label; ?></label>
    <div class="custom-file">
        <input <?php echo $disabled === true ? 'readonly="readonly"' : '';?> type="file" class="custom-file-input" id="<?php echo $id;?>" name="<?php echo $name;?>">
        <label class="custom-file-label" for="<?php echo $id;?>"><?php echo $description;?></label>
    </div>
</div>