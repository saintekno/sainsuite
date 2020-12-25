<script>
    <?php 
    global $Options;
    $webdev_mode = intval(riake('webdev_mode', $Options));
    ?>
    if ( <?php echo $webdev_mode ?> ) {
        $('.webdev_mode').removeClass('d-none');
    }

    $("input[name=webdev_mode]").on("click", function() {
        if($(this).is(":checked")){
            $('.webdev_mode').removeClass('d-none');
            toastr.success('Developer Mode Active');
        }
        else if($(this).is(":not(:checked)")){
            $('.webdev_mode').addClass('d-none');
            toastr.success('Developer Mode Unactive');
        }

        var checkStatus = this.checked ? 1 : 0;
        var url = $('#web_mode').attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: {webdev_mode: checkStatus}
        });
    });
</script>