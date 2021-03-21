<div class="form-group row <?php echo riake('row_class', $_item);?>" id="<?php echo riake('row_id', $_item);?>">
    <?php
    $form = (count($_item) <= 3) ? force_array($_item) : array($_item);
    foreach ( $form as $col) : 
        $col_type = @$col[ 'type' ];
        ?>
        <div class="<?php echo riake('class', $col);?>">
            <?php if ( $col_type == 'checkbox') : ?>
                <div class="checkbox-inline">
                    <label class="checkbox">
                        <input type="checkbox"
                            <?php echo riake('disabled', $col) === true ? 'disabled="disabled"' : '';?>
                            <?php echo (riake('active', $col) == riake('value', $col)) ? 'checked="checked"' : '';?> 
                            name="<?php echo riake('name', $col);?>"
                            value="<?php echo strip_tags( xss_clean( riake('value', $col) ) );?>"/>
                        <span></span>
                        <?php echo riake('label', $col);?>
                    </label>
                </div>

            <?php else : ?>

                <label class="font-size-lg font-weight-bold">
                    <?php echo riake('label', $col);?>:
                    <?php echo riake('required', $col) === true ? '<span class="text-danger">*</span>' : '';?>
                </label>
                
                <?php if (riake('append', $col)) :?>
                <div class="input-group">
                <?php endif; ?>

                    <?php 
                    if (in_array( $col_type, array( 'select', 'multiple' ))) : 
                        include( dirname( __FILE__ ) . '/select.php' );  ?>

                    <?php elseif ( $col_type == 'textarea') : ?>
                    <textarea <?php echo riake('disabled', $col) === true ? 'disabled="disabled"' : '';?> 
                        class="form-control" 
                        id="<?php echo riake('id', $col);?>"
                        rows="3"
                        placeholder="<?php echo riake('placeholder', $col);?>" 
                        name="<?php echo riake('name', $col);?>"><?php echo strip_tags( xss_clean( riake('value', $col) ) );?></textarea>

                    <?php else : ?>
                    <input class="form-control <?php echo riake('widget', $col);?>" 
                        <?php echo riake('disabled', $col) === true ? 'disabled="disabled"' : '';?>
                        <?php echo riake('required', $col) === true ? 'required' : '';?>
                        <?php echo riake('readonly', $col) === true ? 'readonly' : '';?>
                        <?php echo riake('attr', $col);?>
                        <?php echo (riake('accept', $col)) ? 'accept="'.riake('accept', $col).'"' : ''?>
                        type="<?php echo riake('type', $col);?>" 
                        id="<?php echo riake('id', $col);?>" 
                        name="<?php echo riake('name', $col);?>" 
                        placeholder="<?php echo riake('placeholder', $col);?>"
                        value="<?php echo riake('value', $col);?>" />
                    <?php endif; ?>
                    
                <?php if (riake('append', $col)) :?>
                <div class="input-group-append">
                    <span class="input-group-text"><?php echo riake('append', $col);?></span>
                </div></div>
                <?php endif; ?>

            <?php endif; ?>

            <span class="form-text text-muted"><?php echo xss_clean( riake('description', $col));?></span>
        </div>
    <?php endforeach; ?>
</div>