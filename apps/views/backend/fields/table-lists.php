<?php if ( count( force_array( riake('tbody', $_item ) ) ) > 0) : ?>
<?php foreach( force_array( riake( 'tbody', $_item ) ) as $index) : ?>
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-body">
        <!--begin::Top-->
        <div class="d-flex">
            <!--begin::Pic-->
            <?php echo $index[0]; ?>
            <!--end::Pic-->

            <!--begin: Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <!--begin::User-->
                    <div class="mr-3">
                        <!--begin::Name-->
                        <?php echo $index[1];?> <i class="flaticon2-correct text-success icon-md ml-2"></i>
                        <!--end::Name-->

                        <!--begin::Contacts-->
                        <?php echo $index[2];?>
                        <!--end::Contacts-->
                    </div>
                    <!--begin::User-->

                    <!--begin::Actions-->
                    <div class="my-lg-0 my-1">
                        <?php echo $index['action'];?>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Top-->
    </div>
</div>
<!--end::Card-->
<?php endforeach;?>
<?php endif;?>