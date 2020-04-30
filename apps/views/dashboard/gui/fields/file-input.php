<div class="form-group">
    <label for="exampleInputFile"><?php echo $label;
        ?></label>
    <input <?php echo $disabled === true ? 'readonly="readonly"' : '';?> type="file" id="exampleInputFile"
        name="<?php echo $name;?>">
    <p class="help-block"><?php echo $description;?></p>
</div>