<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function error_required_field() {
        toastr.error("<?php _e('please_fill_all_the_required_fields'); ?>");
    }

    function checkRequiredFields() {
        var pass = 1;
        $('form.required-form').find('input, select').each(function(){
            if($(this).prop('required')){
                if ($(this).val() === "") {
                    pass = 0;
                }
            }
        });

        if (pass === 1) {
            $('form.required-form').submit();
        }else {
            error_required_field();
        }
    }

    <?php if ($this->session->flashdata('info_message') != ""):?>
        toastr.info('<?php echo $this->session->flashdata("info_message");?>');
    <?php endif;?>

    <?php if ($this->session->flashdata('error_message') != ""):?>
        toastr.error('<?php echo $this->session->flashdata("error_message");?>');
    <?php endif;?>

    <?php if ($this->session->flashdata('flash_message') != ""):?>
        toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
    <?php endif;?>
</script>