<div class="form-group">
    <label><?php echo $label;
                    ?></label>
    <select <?php echo $multiple;
                    ?> <?php echo $disabled === true ? 'disabled="disabled"' : '';
                    ?> class="form-control" name="<?php echo $name;
                    ?>">
        <?php
                    foreach (force_array(riake('options', $_item)) as $value    =>    $text) {
                        // Only when action is not changed (which send request to dashboard/options/set), Gui_saver is supported.
                        if ($saver_enabled === true  && in_array(riake('action', riake('custom', $meta)), array( null, false ))) {
                            // control check
                            $selected    =    $db_value == $value ? 'selected="selected"' : '';
                        } else {
                            if (! is_array($active = riake('active', $_item))) {
                                // control check
                                $selected    =    $active == $value ? 'selected="selected"' : '';
                            } else {
                                $selected  = in_array($value, $active) ? 'selected="selected"' : '';
                            }
                        }
                        ?>
        <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>">
            <?php echo $text;?></option>
        <?php
                        
                    }
                    ?>
    </select>
    <p class="help-block"><?php echo $description;?></p>
</div>