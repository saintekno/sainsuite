<!--begin: Selected Rows Group Action Form-->
<div class="mb-5 collapse" id="kt_datatable_group_action_form">
    <div class="d-flex align-items-center">
        <div class="font-weight-bold text-danger mr-3">
            Selected <span id="kt_datatable_selected_records">0</span> records:
        </div>

        <button class="btn btn-sm btn-danger mr-2" type="button"
            id="delete_all">
            Delete All
        </button>
    </div>
</div>
<!--end: Selected Rows Group Action Form-->

<!--begin::Datatable-->
<?php if ( count( force_array( riake('tbody', $_item ) ) ) > 0) :?>
<table id="kt_datatable">
<?php else : ?>
<table class="table table-head-custom table-vertical-center">
<?php endif;?>
    <thead>
        <tr class="text-uppercase">
            <?php foreach (force_array(riake('thead', $_item)) as $index => $_col) : ?>
            <th><?php echo $_col;?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
    <?php if ( count( force_array( riake('tbody', $_item ) ) ) > 0) :?>
        <?php foreach( force_array( riake( 'tbody', $_item ) ) as $index => $_row) : ?>
        <tr style="border-bottom: 1px solid #EBEDF3">
            <?php foreach( force_array( $_row ) as $_unique_col) : ?>
            <td><?php echo $_unique_col;?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
    <?php else : ?>
        <tr>
            <td class="text-center" colspan="<?php echo count( force_array( riake('thead', $_item ) ) );?>">
                <img class="w-150px mb-5" src="<?php echo asset_url('svg/not_found.svg'); ?>"/>
                <br>
                <span class="text-uppercase font-weight-bold text-muted">WELL, THIS IS A BIT AWKWARD.</span> <br>
                <span>This space doesn't have a homepage so there's nothing to display here.</span>
            </td>
        </tr>
    <?php endif;?>
    </tbody>
</table>
<!--end::Datatable-->