<table class="table table-striped" style="margin-bottom: 0">
    <tbody>
        <tr>
            <?php foreach (force_array(riake('cols', $_item)) as $index    =>    $_col) : ?>
            <th style="<?php echo $width =    riake($index, riake('width', $_item)) ? 'width:' . $width . ';' : '';?>">
                <?php echo $_col;?>
            </th>
            <?php endforeach ?>
        </tr>
        <?php if ( count( force_array( riake('rows', $_item ) ) ) > 0) :?>
            <?php foreach( force_array( riake( 'rows', $_item ) ) as $index => $_row) : ?>
            <tr>
                <?php foreach( force_array( $_row ) as $_unique_col) : ?>
                <td><?php echo $_unique_col;?></td>
                <?php endforeach;?>
            </tr>
            <?php endforeach;?>
        <?php else:?>
        <tr>
            <td colspan="<?php echo count(force_array(riake('cols', $_item)));?>">
                <?php echo __('Empty table');?>
            </td>
        </tr>
        <?php endif;?>
    </tbody>
</table>