<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
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

    function notify(message) {
        toastr.info(message);
    }

    function success_notify(message) {
        toastr.success(message);
    }

    function error_notify(message) {
        toastr.error(message);
    }

    function error_required_field() {
        toastr.error("<?php _e('please_fill_all_the_required_fields'); ?>");
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

    <?php if (notice_from_url()):?>
        toastr.success('<?php echo notice_from_url();?>');
    <?php endif;?>

    <?php if ($this->notice->output_notice()):?>
        toastr.success('<?php echo $this->notice->output_notice();?>');
    <?php endif;?>
</script>