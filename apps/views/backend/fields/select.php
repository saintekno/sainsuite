<?php
$select_ = @$_item[ 'data' ] != null;
?>

<div class="form-group row">
    <?php if (riake('cols', $_item)) :
        foreach (force_array(riake('cols', $_item)) as $col) : 
        $count_cols = count(riake('cols', $_item));
        $select_ = @$col[ 'data' ] != null;
        ?>
        <div class="col-<?php echo ($count_cols * 3) * 12 / ($count_cols * 3) / $count_cols ;?>">
            <label class="font-size-lg font-weight-bold" for="<?php echo riake('label', $col);?>"><?php echo riake('label', $col);?></label>
            <select class="form-control <?php echo ($type == 'multiple') ? 'selectpicker' : ''; ?> <?php echo riake('strings', $col);?>" 
                <?php echo $multiple; ?> 
                <?php echo riake('disabled', $col) === true ? 'disabled="disabled"' : '';?>
                <?php echo riake('required', $col) === true ? 'required' : '';?>
                <?php echo ($type == 'multiple') ? 'data-live-search="true"' : ''; ?>
                id="<?php echo riake('id', $col);?>" 
                name="<?php echo riake('name', $col);?>" 
                title="<?php echo riake('label', $col);?>">
                <?php
                foreach (force_array(riake('options', $col)) as $value => $text) {
                    // Only when action is not changed (which send request to dashboard/options/set), Gui_saver is supported.
                    if (riake('gui_saver', $meta) === true  && in_array(riake('action', riake('form', $meta)), array( null, false ))) {
                        // control check
                        $selected = $db_value == $value ? 'selected="selected"' : '';
                    } else {
                        if (! is_array($active = riake('active', $col))) {
                            // control check
                            $selected = $active == $value ? 'selected="selected"' : '';
                        } else {
                            $selected = in_array($value, $active) ? 'selected="selected"' : '';
                        }
                    }
                    ?>
                    <option <?php echo $selected;?><?php echo set_select(riake('name', $col), $value, False); ?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                    <?php
                }
                ?>
            </select>
            <span class="form-text text-muted"><?php echo $description;?></span>
        </div>
        <?php endforeach; ?>
    <?php else :?>
    <div class="col-12">
        <label class="font-size-lg font-weight-bold" for="<?php echo $label; ?>"><?php echo $label; ?></label>
        <select class="form-control <?php echo ($type == 'multiple') ? 'selectpicker' : ''; ?> <?php echo riake('strings', $_item);?>"
            <?php echo $multiple; ?> 
            <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
            <?php echo $required === true ? 'required' : '';?>
            <?php echo ($type == 'multiple') ? 'data-live-search="true"' : ''; ?>
            id="<?php echo $id; ?>" 
            name="<?php echo $name;?>"
            title="<?php echo $label;?>">
            <?php
            foreach (force_array(riake('options', $_item)) as $value => $text) {
                // Only when action is not changed (which send request to dashboard/options/set), Gui_saver is supported.
                if (riake('gui_saver', $meta) === true  && in_array(riake('action', riake('form', $meta)), array( null, false ))) {
                    // control check
                    $selected = $db_value == $value ? 'selected="selected"' : '';
                } else {
                    if (! is_array($active = riake('active', $_item))) {
                        // control check
                        $selected = $active == $value ? 'selected="selected"' : '';
                    } else {
                        $selected = in_array($value, $active) ? 'selected="selected"' : '';
                    }
                }
                ?>
                <option <?php echo $selected;?><?php echo set_select($name, $value, False); ?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                <?php
            }
            ?>
        </select>
        <span class="form-text text-muted"><?php echo $description;?></span>
    </div>
    <?php endif;?>
</div>

<?php if ($type == 'multiple' && $select_) : ?>
<script>
var KTBootstrapSelect = function () {

    // Private functions
    var selects = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker();
    }

    return {
        // public functions
        init: function() {
            selects();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapSelect.init();
});

//AJAX REQUEST TO GET SELECTED PRODUCT
$.ajax({
    url: "<?php echo riake('url', $_item);?>",
    method: "POST",
    data :{<?php echo riake('data', $_item) ;?>},
    cache:false,
    success : function(data){
        var item=data;
        var val1=item.replace('[','');
        var val2=val1.replace(']','');
        var values=val2;
        $.each(values.split(","), function(i,e){
            var d=e.replace('"','');
            var k=d.replace('"','');
            $(".strings option[value='" + k + "']").prop("selected", true).trigger('change');
            $(".strings").selectpicker('refresh');
        });
    }
});
</script>
<?php endif; ?>