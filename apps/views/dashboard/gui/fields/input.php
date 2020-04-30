<?php if (riake('label', $_item)) : ?>

<div class="input-group" style="margin-bottom:5px;">
    <?php if(riake('icon', $_item)) : ?>
    <span class="input-group-addon"><i class="fa fa-<?php echo riake('icon', $_item);?>"></i></span>
    <?php else : ?>
    <span class="input-group-addon"><?php echo riake('label', $_item);?></span>
    <?php endif; ?>
    <input <?php echo $disabled === true ? 'readonly="readonly"' : '';?> 
        type="<?php echo $type;?>"
        name="<?php echo riake('name', $_item);?>" class="form-control"
        placeholder="<?php echo riake('placeholder', $_item);?>"
        <?php if(riake('type', $_item) == 'password') : ?>
        value="<?php echo strip_tags( xss_clean( $value) );?>">
        <?php else : ?>
        value="<?php echo strip_tags( xss_clean( set_value(riake('name', $_item), $value) ) );?>">
        <?php endif; ?>
</div>

<?php else : ?>

<input <?php echo $disabled === true ? 'readonly="readonly"' : '';?>
    type="<?php echo $type;?>"
    name="<?php echo riake('name', $_item);?>" class="form-control"
    placeholder="<?php echo riake('placeholder', $_item);?>" 
    value="<?php echo strip_tags( xss_clean( $value ) );?>">
    
<?php endif; ?>

<p><?php echo xss_clean($description);?></p>