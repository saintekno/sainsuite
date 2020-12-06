<div class="accordion accordion-light accordion-toggle-arrow" id="accordionExample2">
    <div class="card">
    <?php 
    $loop_index = 0;
    foreach (force_array(riake('accordion', $_item)) as $index => $_row) : ?>
		<div class="card-header">
			<div class="card-title" data-toggle="collapse" data-target="#<?php echo $_row['id'];?>">
                <?php echo $_row['heading'];?>
            </div>
            <p class="text-muted"><?php echo riake('description', $_row);?></p>
		</div>
		<div id="<?php echo $_row['id'];?>" class="collapse <?php echo ($loop_index == 0) ? 'show' : '';?>" data-parent="#accordionExample2">
			<div class="card-body">            
            <?php echo $this->load->backend_view('_item', array(
                'meta' => $_row['body']
            ), true);?>
			</div>
		</div>
    <?php 
    $loop_index++; // increment loop_index
    endforeach;?>
	</div>
</div>