<?php
global $User_Options;
if (isset($User_Options['meta'])) {
    $skin = $User_Options['meta']['theme-skin'];
} else {
    $skin = 'skin-light';
}
?>
<div class="separator separator-dashed my-8"></div>
<label class="font-size-lg font-weight-bold"><?php _e('Select a Mode'); ?></label>
<ul class="list-unstyled clearfix theme-selector">
    <li style="float:left;">
        <a href="javascript:void(0);" 
            data-skin="skin-light"
            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-light' ? 'active' : ''; ?>">
            <span style="display:block; width: 50px; height: 24px; border-radius:5%; background: #f9fafc;"></span>
        </a>
        <p class="text-center mt-2 m-0" style="font-size: 12px"><?php _e('Light'); ?></p>
    </li>
    <li style="float:left; padding-left: 15px;">
        <a href="javascript:void(0);" 
            data-skin="skin-dark"
            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-dark' ? 'active' : ''; ?>">
            <span style="display:block; width: 50px; height: 24px; border-radius:5%; background: #222d32;"></span>
        </a>
        <p class="text-center mt-2 m-0"><?php _e('Dark'); ?></p>
    </li>
    <li style="float:left; padding-left: 15px;">
        <a href="javascript:void(0);" 
            data-skin="skin-tosca"
            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-tosca' ? 'active' : ''; ?>">
            <span style="display:block; width: 50px; height: 24px; border-radius:5%; background: #0387c4;"></span>
        </a>
        <p class="text-center mt-2 m-0" style="font-size: 12px"><?php _e('Tosca'); ?></p>
    </li>
</ul>
<input type="hidden" name="theme-skin" value="<?php echo $skin;?>" />

<style>
    .theme-selector li a.active {
        opacity: 1 !important;
        box-shadow: 0px 0px 0px 5px #69c7fd !important;
        border-radius: 5%;
    }
</style>
<script>
    $('.theme-selector li a').each(function () {
        $(this).bind('click', function () {
            // remove active status
            $('.theme-selector li a').each(function () {
                $(this).removeClass('active');
            });

            $(this).toggleClass('active');
            $('input[name="theme-skin"]').val($(this).data('skin'));
        });
    })
</script>