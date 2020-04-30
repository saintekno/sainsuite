<?php
$skin = riake('user_id', $config) ? $this->options->get('theme-skin', riake('user_id', $config)) : '';
?>
<ul class="list-unstyled clearfix theme-selector">
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-blue"
            style="background: #1a3652; display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-blue' ? 'active' : '';?>">
        </a>
    </li>
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-black"
            style="background: #fff; display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="clearfix full-opacity-hover <?php echo $skin == 'skin-black' ? 'active' : '';?>">
        </a>
    </li>
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-purple"
            style="display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="bg-purple clearfix full-opacity-hover <?php echo $skin == 'skin-purple' ? 'active' : '';?>">
        </a>
    </li>
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-green"
            style="display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="bg-green clearfix full-opacity-hover <?php echo $skin == 'skin-green' ? 'active' : '';?>">
        </a>
    </li>
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-red"
            style="display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="bg-red clearfix full-opacity-hover <?php echo $skin == 'skin-red' ? 'active' : '';?>">
        </a>
    </li>
    <li style="float:left; padding: 5px;">
        <a href="javascript:void(0);" 
            data-skin="skin-yellow"
            style="display: block; width: 40px; height: 20px; border-radius: 25px; margin-bottom: 5px; opacity: 0.8; cursor: pointer; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
            class="bg-yellow clearfix full-opacity-hover <?php echo $skin == 'skin-yellow' ? 'active' : '';?>">
        </a>
    </li>
</ul>
<input type="hidden" name="theme-skin" value="<?php echo $skin;?>" />
<style>
    .theme-selector li a.active {
        opacity: 1 !important;
        box-shadow: 0px 0px 0px 5px #6dc9fe !important;
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
            // console.log( $(this).data( 'skin' ) );
        });
    })
</script>