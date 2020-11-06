<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center kt_datatable"
        id="kt_advance_table_widget_2">
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
                <td>data empty</td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<!--end::Table-->