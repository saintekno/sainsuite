<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
?>

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