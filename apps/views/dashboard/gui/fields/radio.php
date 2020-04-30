<div class="form-group">
    <?php
        foreach (force_array(riake('options', $_item)) as $radio_item) {
            if ($saver_enabled) {
                // control check
                $checked    =    $db_value == riake('value', $radio_item) ? 'checked="checked"' : '';
            } else {
                // control check
                $checked    =    riake('active', $_item) == riake('value', $radio_item) ? 'checked="checked"' : '';
            }
            // exception of repeat
            ?>
    <div class="radio">
        <label>
            <input <?php echo $disabled === true ? 'disabled="disabled"' : '';?> type="radio"
                name="<?php echo riake('name', $radio_item);?>" id="optionsRadios1"
                value="<?php echo strip_tags( xss_clean( riake('value', $radio_item) ) );?>" <?php echo $checked;
            ?> />
            <?php echo riake('description', $radio_item);?>
        </label>
        <p class="help-block"><?php echo $description;?></p>
    </div>
    <?php
        }
        ?>
</div>