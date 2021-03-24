<div class="accordion accordion-light accordion-toggle-arrow" id="accordion">

<?php foreach (riake('accordion', $_item) as $index => $_row) : 
    if( @$_row[ 'permission' ] != null && ! User::control( $_row[ 'permission' ] ) ) {
        continue;
    } 
    ?>
    <div class="card">
        <div class="card-header <?php echo riake('class', $_row);?>" id="heading<?php echo $_row['id'];?>" data-toggle="collapse" data-target="#collapse<?php echo $_row['id'];?>">
            <div class="card-title pb-0 d-flex flex-column align-items-start">
                <h4><?php echo riake('heading', $_row);?></h4>
            </div>
            <p><?php echo riake('description', $_row);?></p>
        </div>

		<div id="collapse<?php echo $_row['id'];?>" class="collapse <?php echo (riake('show', $_row)) ? 'show' : ''; ?>" data-parent="#accordion">
			<div class="card-body py-3">            
                <?php echo $this->load->backend_view('elements/_init', array( 'meta' => $_row['body'] ), true);?>

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