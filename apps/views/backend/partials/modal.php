<!-- (Large Modal)-->
<div class="modal fade" id="large-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                ....
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                ....
            </div>
        </div>
    </div>
</div>

<!-- Scrollable modal -->
<div class="modal fade" id="scrollable-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" data-scroll="true" data-height="300">
                ....
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><?php _e("close"); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Info Alert Modal -->
<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="ki ki-outline-info icon-5x text-info"></i>
                    <h4 class="mt-2"><?php _e("heads_up"); ?>!</h4>
                    <p class="mt-3"><?php _e("are_you_sure"); ?>?</p>
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal"><?php _e("cancel"); ?></button>
                    <a href="#" id="update_link" class="btn btn-danger font-weight-bold"><?php _e("continue"); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirm_modal(delete_url)
    {
        $('#alert-modal').modal('show');
        document.getElementById('update_link').setAttribute('href' , delete_url);
    }

    function showAjaxModal(url, header)
    {
        // SHOWING AJAX PRELOADER IMAGE
        $('#scrollable-modal .modal-body').html('<i class="ki ki-plus"></i>');
        $('#scrollable-modal .modal-title').html('...');
        // LOADING THE AJAX MODAL
        $('#scrollable-modal').modal('show');

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                $('#scrollable-modal .modal-body').html(response);
                $('#scrollable-modal .modal-title').html(header);
            }
        });
    }

    function showLargeModal(url, header)
    {
        // SHOWING AJAX PRELOADER IMAGE
        $('#large-modal .modal-body').html('<i class="ki ki-plus"></i>');
        $('#large-modal .modal-title').html('...');
        // LOADING THE AJAX MODAL
        $('#large-modal').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                $('#large-modal .modal-body').html(response);
                $('#large-modal .modal-title').html(header);
            }
        });
    }

    function showModal(url, header)
    {
        // SHOWING AJAX PRELOADER IMAGE
        $('#showModal-modal .modal-body').html('<i class="ki ki-plus"></i>');
        $('#showModal-modal .modal-title').html('...');
        // LOADING THE AJAX MODAL
        $('#showModal-modal').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                $('#showModal-modal .modal-body').html(response);
                $('#showModal-modal .modal-title').html(header);
            }
        });
    }
</script>
