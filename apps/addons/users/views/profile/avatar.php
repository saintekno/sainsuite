<?php global $User_Options;?>

<!--begin::User-->
<div class="d-flex align-items-center">
    <div class="symbol symbol-60 mr-5 align-self-start align-self-xxl-center">
        <div class="symbol-label"
            style="background-image:url('<?php echo User::get_user_image_url(User::get()->id);?>')">
        </div>
    </div>
    <div>
        <div class="font-weight-bolder font-size-h5  text-hover-primary">
            <?php echo User::get()->username;?>
        </div>
        <div class="text-muted">
            <?php echo User::get_user_groups()[0]->definition;?>
        </div>

        <?php echo $this->events->apply_filters('check_day', '');?>
    </div>
</div>
<!--end::User-->

<!--begin::Contact-->
<div class="pt-9">
    <?php echo $this->events->apply_filters('fill_member', '');?>
    
    <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="font-weight-bold mr-2">Email:</span>
        <span class="text-muted text-hover-primary text-right"><?php echo User::get()->email;?></span>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="font-weight-bold mr-2">Phone:</span>
        <span class="text-muted text-right"><?php echo (isset($User_Options['meta']) && $User_Options['meta']['phone'] != 0) ? $User_Options['meta']['phone'] : '-';?></span>
    </div>
    <div class="d-flex align-items-first justify-content-between">
        <span class="font-weight-bold mr-2">Address:</span>
        <span class="text-muted text-right"><?php echo (isset($User_Options['meta']) && $User_Options['meta']['address'] != 0) ? $User_Options['meta']['address'] : '-';?></span>
    </div>
</div>
<!--end::Contact-->