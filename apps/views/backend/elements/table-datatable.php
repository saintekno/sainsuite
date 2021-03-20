<?php if ( riake('data', $_item) && User::control('delete.group')) : ?>
<!--begin: Selected Rows Group Action Form-->
<div class="mb-5 collapse" id="kt_datatable_group_action_form">
    <div class="d-flex align-items-center">
        <div class="font-weight-bold text-danger mr-3">
            Selected <span id="kt_datatable_selected_records">0</span> records:
        </div>

        <button class="btn btn-sm btn-danger mr-2" type="button" onclick="deleteConfirmation(this)">
            Delete All
        </button>
    </div>
</div>
<!--end: Selected Rows Group Action Form-->
<?php endif; ?>

<!--begin::Datatable-->
<div id="kt_datatable" class="datatable datatable-bordered datatable-head-custom">
<?php if(! riake('data', $_item)) : ?>
    <div class="text-center p-10">
        <img class="w-150px mb-5" src="<?php echo img_url().'svg/not_found.svg'; ?>"/>
        <br>
        <span class="text-uppercase font-weight-bold text-muted">WELL, THIS IS A BIT AWKWARD.</span> <br>
        <span>This space doesn't have a homepage so there's nothing to display here.</span>
    </div>
<?php else: ?>
    <div class="d-flex">
    </div>
<?php endif; ?>
</div>
<!--end::Datatable-->