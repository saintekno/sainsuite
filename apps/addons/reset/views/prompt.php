<script>
var Resets = function() {
    var askReset = function() {
        Swal.fire({
            title: '<?php echo _s( 'Confirm Your Action', 'reset' );?>',
            type: 'info',
            html: `<?php echo _s( 'While it\'s enabled, <br> we to delete all your data.', 'reset');?>`,
            showCancelButton: true
        }).then(function(result) {
            if ( result.value ) {
                document.location = '<?php echo current_url() . '?reset-process=confirm';?>';
            } else {
                askDisableModule();
            }
        });
    }

    var askDisableModule = function() {
        Swal.fire({
            title: '<?php echo _s( 'Disable Reset On Active', 'reset' );?>',
            type: 'info',
            html: `<?php echo _s( 'You don\'t wish to reset right now ?', 'reset');?>`,
        }).then(function(result) {
            if ( result.value ) {
                document.location = '<?php echo site_url( 'admin/addons/disable/reset' );?>';
                return false;
            } else {
                askReset();
            }
        });
    }

    return {
        init: function() {
            askReset();
        },
    };
}();

jQuery(document).ready(function() {
    Resets.init();
});
</script>