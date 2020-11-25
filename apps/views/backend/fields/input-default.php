<div class="form-group row">
    <?php if (riake('cols', $_item)) :?>
        <?php 
        foreach (force_array(riake('cols', $_item)) as $col) : 
        $count_cols = count(riake('cols', $_item));
        ?>
        <div class="col-<?php echo ($count_cols * 3) * 12 / ($count_cols * 3) / $count_cols ;?>">
            <label class="font-size-lg text-dark font-weight-bold"><?php echo riake('label', $col);?>:</label>
            <input class="form-control 
                <?php echo riake('class', $col);?>" 
                <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
                <?php echo $required === true ? 'required' : '';?>
                type="<?php echo $type;?>" 
                id="<?php echo riake('id', $col);?>" 
                name="<?php echo riake('name', $col);?>" 
                placeholder="<?php echo riake('placeholder', $col);?>"
                value="<?php echo riake('value', $col);?>" />
            <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
        </div>
        <?php endforeach; ?>
    <?php else :?>
    <div class="col-12">
        <label class="font-size-lg text-dark font-weight-bold"><?php echo riake('label', $_item);?>:</label>
        <input class="form-control 
            <?php echo $class;?>" 
            <?php echo $disabled === true ? 'disabled="disabled"' : '';?>
            <?php echo $required === true ? 'required' : '';?>
            id="<?php echo $id;?>" 
            type="<?php echo $type;?>" 
            name="<?php echo riake('name', $_item);?>" 
            placeholder="<?php echo riake('placeholder', $_item);?>"
            value="<?php echo riake('value', $_item);?>" />
        <span class="form-text text-muted"><?php echo xss_clean($description);?></span>
    </div>
    <?php endif;?>
</div>

<?php if (riake('datepicker', $_item)) :?>
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
            setYearPicker()
            setDatePicker()
        }
    };
}();

jQuery(document).ready(function() {    
    KTBootstrapDatepicker.init();
});
</script>
<?php endif;?>