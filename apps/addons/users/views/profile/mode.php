<?php
global $User_Options;
if (riake('theme-skin', $User_Options) && !empty($User_Options['theme-skin'])) {
    $skin = $User_Options['theme-skin'];
} else {
    $skin = 'skin-light';
}
?>
<label class="font-size-lg"><?php _e('Mode'); ?></label>
<div class="radio-inline mb-11">
    <label class="radio radio-accent radio-info mr-0">
        <input type="radio" class="radio" name="color-mode" id="skin-tosca" />
        <span></span>
    </label>
    <label class="radio radio-accent radio-dark mr-0">
        <input type="radio" class="radio" name="color-mode" id="skin-dark" />
        <span></span>
    </label>

    <label class="radio radio-accent radio-secondary mr-0">
        <input type="radio" class="radio" name="color-mode" id="skin-light" />
        <span></span>
    </label>
</div>
<div class="separator separator-dashed my-8"></div>
<input type="hidden" name="theme-skin" value="<?php echo $skin;?>" />

<script>
    var skin = "<?php echo $skin;?>";
    $('#'+skin).prop("checked", true);
    
    $('input[name="color-mode"]').click(function () {
        $('input[name="theme-skin"]').val($(this).attr('id'));
    });
</script>