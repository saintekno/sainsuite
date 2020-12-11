<?php
global $User_Options;
if (isset($User_Options['meta'])) {
    $skin = ($User_Options['meta']['theme-skin'] == 'skin-light') ? 'skin-light' : 'skin-dark';
} else {
    $skin = 'skin-light';
}
?>
<div class="separator separator-dashed my-8"></div>
<label class="font-size-lg text-dark font-weight-bold"><?php _e('Select a Mode'); ?></label>
<ul class="list-unstyled clearfix theme-selector">
    <li style="float:left; width: 24%; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-dark"
            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-dark' ? 'active' : ''; ?>">
            <div>
                <span style="display:block; width: 20%; float: left; height: 7px; background: #222d32;"></span>
                <span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
            </div>
            <div>
                <span style="display:block; width: 20%; float: left; height: 50px; background: #222d32;"></span>
                <span style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7;"></span>
            </div>
        </a>
        <p class="text-center mt-2 m-0"><?php _e('Dark'); ?></p>
    </li>
    <li style="float:left; width: 24%; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-light"
            style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-light' ? 'active' : ''; ?>">
            <div>
                <span style="display:block; width: 20%; float: left; height: 7px; background: #f9fafc;"></span>
                <span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
            </div>
            <div>
                <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc;"></span>
                <span style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7;"></span>
            </div>
        </a>
        <p class="text-center mt-2 m-0" style="font-size: 12px"><?php _e('Light'); ?></p>
    </li>
</ul>
<input type="hidden" name="theme-skin" value="<?php echo $skin;?>" />

<style>
    .theme-selector li a.active {
        opacity: 1 !important;
        box-shadow: 0px 0px 0px 5px #3c8dbc !important;
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