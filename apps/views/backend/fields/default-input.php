<div class="form-group row">
    <?php if (riake('cols', $_item)) :?>
        <?php foreach (force_array(riake('cols', $_item)) as $col) : ?>
        <div class="col-<?php echo count(riake('cols', $_item, 1)) * 3 ;?>">
            <label class="font-size-lg text-dark font-weight-bold"><?php echo riake('label', $col);?>:</label>
            <input class="form-control" <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
                type="<?php echo $type;?>" 
                name="<?php echo riake('name', $col);?>" 
                placeholder="<?php echo riake('placeholder', $col);?>"
                value="<?php echo strip_tags( xss_clean( $value ) );?>"/>
            <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
        </div>
        <?php endforeach; ?>
    <?php else :?>
    <div class="col-12">
        <label class="font-size-lg text-dark font-weight-bold"><?php echo riake('label', $_item);?>:</label>
        <input class="form-control" <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
            type="<?php echo $type;?>" 
            name="<?php echo riake('name', $_item);?>" 
            placeholder="<?php echo riake('placeholder', $_item);?>"
            value="<?php echo strip_tags( xss_clean( $value ) );?>"/>
        <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
    </div>
    <?php endif;?>
</div>