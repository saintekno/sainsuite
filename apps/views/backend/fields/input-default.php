<?php
$datepicker = riake('datepicker', $_item);
?>

<?php if (riake('cols', $_item)) : ?>
<div class="form-group row" id="<?php echo riake('row_id', $_item);?>">
    <?php
    foreach (force_array(riake('cols', $_item)) as $col) : 
    $count_cols = count(riake('cols', $_item));
    $datepicker = riake('datepicker', $col);
    ?>
    <div class="col-<?php echo ($count_cols * 3) * 12 / ($count_cols * 3) / $count_cols ;?>">
        <label class="font-size-lg font-weight-bold">
            <?php echo riake('label', $col);?>:
            <?php echo riake('required', $col) === true ? '<span class="text-danger">*</span>' : '';?>
        </label>
        
        <?php if (riake('append', $col)) :?>
        <div class="input-group">
        <?php endif; ?>

            <input class="form-control <?php echo riake('class', $col);?>" 
                <?php echo riake('disabled', $col) === true ? 'disabled="disabled"' : '';?>
                <?php echo riake('required', $col) === true ? 'required' : '';?>
                <?php echo riake('readonly', $col) === true ? 'readonly' : '';?>
                <?php echo riake('attr', $col);?>
                type="<?php echo $type;?>" 
                id="<?php echo riake('id', $col);?>" 
                name="<?php echo riake('name', $col);?>" 
                placeholder="<?php echo riake('placeholder', $col);?>"
                value="<?php echo riake('value', $col);?>" />
        
        <?php if (riake('append', $col)) :?>
            <div class="input-group-append"><span class="input-group-text"><?php echo riake('append', $col);?></span></div>
        </div>
        <?php endif; ?>
        <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
    </div>
    <?php endforeach; ?>
</div>
<?php else :?>
<div class="form-group row" id="<?php echo riake('row_id', $_item);?>">
    <div class="col-12">
        <label class="font-size-lg font-weight-bold">
            <?php echo riake('label', $_item);?>:
            <?php echo $required === true ? '<span class="text-danger">*</span>' : '';?>
        </label>
        
        <?php if (riake('append', $_item)) :?>
        <div class="input-group">
        <?php endif; ?>

            <input class="form-control <?php echo $class;?>" 
            <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
            <?php echo $required === true ? 'required' : '';?>
            <?php echo $readonly === true ? 'readonly' : '';?>
            <?php echo riake('attr', $_item);?>
            id="<?php echo $id;?>" 
            type="<?php echo $type;?>" 
            name="<?php echo riake('name', $_item);?>" 
            placeholder="<?php echo riake('placeholder', $_item);?>"
            value="<?php echo riake('value', $_item);?>" />
            
        <?php if (riake('append', $_item)) :?>
            <div class="input-group-append"><span class="input-group-text"><?php echo riake('append', $_item);?></span></div>
        </div>
        <?php endif; ?>
        <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
    </div>
</div>
<?php endif;?>

<?php if ($datepicker) :?>
<script>
var KTBootstrapDatepicker = function () {

    var setDatePicker = function (){
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
    }

    var setDateRangePicker = function (input1, input2){
        $(input1).datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
        }).on("change", function(){
            $(input2).val("").datepicker('setStartDate', $(this).val());
        }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});

        $(input2).datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            orientation: "bottom right"
        }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
    }

    var setYearPicker = function (){
        $(".yearpicker").datepicker({
            format: "yyyy",
            maxViewMode: "years",
            minViewMode: "years",
            todayHighlight: true,
            autoclose: true
        }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
    }

    return {
        // public functions
        init: function() {
            // minimum setup
            setDateRangePicker("#startdate", "#enddate"),
            setYearPicker(),
            setDatePicker()
        }
    };
}();

jQuery(document).ready(function() {    
    KTBootstrapDatepicker.init();
});
</script>
<?php endif;?>