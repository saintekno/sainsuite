<div class="row">
    <div class="col-md-12">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                <?php echo __('Choose the addons zip file');?>
                </h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="extension_zip"/>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
							<div class="input-group-append">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fa fa-plus"></i>
                                    <?php echo __('Add the addons');?>
                                </button>
							</div>
						</div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>