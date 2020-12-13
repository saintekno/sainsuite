<div class="form-group">
    <label class="font-size-lg text-dark font-weight-bold" for="<?php echo $label; ?>"><?php echo $label; ?></label>
    <select <?php echo $multiple; ?> <?php echo $disabled === true ? 'disabled="disabled"' : ''; ?> 
        class="form-control <?php echo ($type == 'multiple') ? 'selectpicker' : ''; ?> <?php echo riake('strings', $_item);?>" 
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
            <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
            <?php
        }
        ?>
    </select>
    <span class="form-text text-muted"><?php echo $description;?></span>
</div>

<?php if ($type == 'multiple') : ?>
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
        var val1=item.replace("[","");
        var val2=val1.replace("]","");
        var values=val2;
        $.each(values.split(","), function(i,e){
            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
            $(".strings").selectpicker('refresh');

        });
    }
});
</script>
<?php endif; ?>