<div class="accordion accordion-light accordion-toggle-arrow" id="accordion">
<?php 
foreach (force_array(riake('accordion', $_item)) as $index => $_row) : 
    if( @$_row[ 'permission' ] != null && ! User::control( $_row[ 'permission' ] ) ) {
        continue;
    } 
    ?>
    <div class="card">
		<div class="card-header mb-5" id="heading<?php echo $_row['id'];?>">
			<div class="card-title pb-0" data-toggle="collapse" data-target="#collapse<?php echo $_row['id'];?>">
                <?php echo $_row['heading'];?>
            </div>
            <p class="text-muted"><?php echo riake('description', $_row);?></p>
		</div>

		<div id="collapse<?php echo $_row['id'];?>" class="collapse <?php echo (riake('show', $_row)) ? 'show' : ''; ?>" data-parent="#accordion">
			<div class="card-body">            
                <?php echo $this->load->backend_view('_item', array(
                    'meta' => $_row['body']
                ), true);?>

                <?php if (riake('hide_footer', $_row) == false) : ?>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" onclick="checkRequiredFields()" name="submit" class="btn btn-primary mr-2" value="<?php echo __('Save changes');?>">
                    </div>
                </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
    <?php 
endforeach;?>
</div>