<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center kt_datatable"
        <?php echo ( count( force_array( riake('tbody', $_item ) ) ) > 0) ? 'id="datatable"' : '';?>>
        <thead>
            <tr class="text-uppercase">
                <?php foreach (force_array(riake('thead', $_item)) as $index => $_col) : ?>
                <th style="<?php echo $width = riake($index, riake('width', $_item)) ? 'width:' . $width . ';' : '';?>"><?php echo $_col;?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
        <?php if ( count( force_array( riake('tbody', $_item ) ) ) > 0) :?>
            <?php foreach( force_array( riake( 'tbody', $_item ) ) as $index => $_row) : ?>
            <tr>
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
</div>
<!--end::Table-->

<script>
var KTDatatablesBasicBasic = function() {

var initTable1 = function() {
    var table = $('#datatable');

    // begin first table
    table.DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
};

return {

    //main function to initiate the module
    init: function() {
        initTable1();
    },

};

}();

jQuery(document).ready(function() {
    KTDatatablesBasicBasic.init();
});
</script>