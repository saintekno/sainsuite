<?php if ($this->polatan->get_page() === '404') : ?>

<div class="d-flex flex-column-fluid flex-center">
    <div class="d-flex flex-column justify-content-center align-items-center px-5 text-center">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-row-fluid text-center">
            <h1 class="display-1 font-weight-boldest mb-12">Oops...</h1>
            <p class="display-4 font-weight-bold">
                Looks like something went wrong.
            </p>
            <p>
                <?php if ($this->session->flashdata('info_message') != ""):?>
                    <?php echo $this->session->flashdata("info_message");?></br>
                <?php endif;?>

                <?php if ($this->session->flashdata('error_message') != ""):?>
                    <?php echo $this->session->flashdata("error_message");?></br>
                <?php endif;?>

                <?php if ($this->session->flashdata('flash_message') != ""):?>
                    <?php echo $this->session->flashdata("flash_message");?></br>
                <?php endif;?>
            </p>
        </div>
        <!--end::Content-->
    </div>
</div>

<?php elseif (empty($this->polatan->get_col(1))) :  ?>

<div class="d-flex flex-column-fluid flex-center">
    <div class="d-flex flex-column justify-content-center align-items-center px-5 text-center">
        <img class="w-150px" src="<?php echo asset_url('svg/empty-state.svg'); ?>"/>
        <h3 class="display-4 font-weight-bold mt-7 mb-2">Welcome to <?php echo $this->options_model->get('site_name');?>! Let's get started</h3>
        <p class="font-weight-bold font-size-lg opacity-80">
        Get started building your personal projects, testing out ideas, and more in your spontaner workspace.
        </p>
    </div>
</div>

<?php else : ?>

<div class="container">
    
    <?php echo $this->events->apply_filters('gui_before_cols', '');?>

    <div class="row">
    <?php foreach (force_array($this->polatan->get_cols()) as $col_id => $col_data):?>
        <?php if( $col_data ):?>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-<?php echo ceil(riake('width', $col_data, 1) * 3) ;?> <?php echo riake('class', $col_data);?>" id="<?php echo riake('id', $col_data);?>">
                <?php foreach (force_array(riake('metas', $col_data)) as $meta) : ?>
                <?php
                // enable gui form saver
                $form_expire   = gmt_to_local(time(), 'UTC') + GUI_EXPIRE;
                $icon          = riake('icon', $meta, false);
                $ref           = urlencode(current_url());
                $id            = riake('id', riake('form', $meta));
                $class         = riake('classes', riake('form', $meta), 'required-form');
                $action        = riake('action', riake('form', $meta), site_url(array( 'admin', 'options', 'save' )));
                $method        = riake('method', riake('form', $meta), 'POST');
                $enctype       = riake('enctype', riake('form', $meta), 'multipart/form-data');
                $namespace     = riake('namespace', $meta);
                $use_namespace = riake('use_namespace', $meta, false);
                ?>

                <?php if ( riake('gui_saver', $meta)) :?>
                <form ng-non-bindable 
                    autocomplete="off"
                    class="form <?php echo $class;?>" 
                    id="<?php echo $id;?>"
                    action="<?php echo $action;?>" 
                    enctype="<?php echo $enctype;?>" 
                    method="<?php echo $method;?>">
                    <input type="hidden" name="gui_saver_user_id" value="<?php echo @$meta[ 'user_id' ];?>" />
                    <input type="hidden" name="gui_saver_ref" value="<?php echo $ref;?>" />
                    <input type="hidden" name="gui_saver_option_namespace" value="<?php echo riake('namespace', $meta);?>" />
                    <input type="hidden" name="gui_saver_expiration_time" value="<?php echo $form_expire;?>" />
                    <input type="hidden" name="gui_saver_use_namespace" value="<?php echo $use_namespace ? 'true' : 'false';?>" />
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <?php elseif (in_array($action, array( null, false ), true)) :?>
                <form ng-non-bindable 
                    autocomplete="off"
                    class="form <?php echo $class;?>" 
                    id="<?php echo $id;?>"
                    enctype="<?php echo $enctype;?>" 
                    method="<?php echo $method;?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <?php endif; ?>

                    <?php if (in_array($meta_type = riake('type', $meta), array( 'card' ))) : ?>

                    <div class="card card-custom gutter-b">
                        <?php if ($header = riake('header', $meta)) : ?>
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <?php if (riake('icon', $header)):?>
                                <span class="card-icon">
                                    <i class="flaticon2-line-chart text-primary"></i>
                                </span>
                                <?php endif;?>
                                <h3 class="card-label font-weight-bolder "><?php echo riake('title', $header);?></h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1"><?php echo riake('sub_title', $header);?></span>
                            </div>
                        </div>
                        <?php endif;?>

                        <div class="card-body">
                            <?php echo $this->load->backend_view('_item', array(
                                'namespace' => $namespace,
                                'meta' => $meta
                            ), true);?>
                        </div>

                        <?php if ($footer = riake('footer', $meta)) : ?>
                        <div class="card-footer">
                            <div class="row">
                                <?php if ($footer_submit = riake('submit', $footer)) :?>
                                <div class="col-lg-6">
                                    <input type="submit" onclick="checkRequiredFields()" name="submit" class="btn btn-primary mr-2" value="<?php echo riake('label', $footer_submit);?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    
                    <?php else : ?>
                    
                    <?php echo $this->load->backend_view('_item', array(
                        'namespace' => $namespace,
                        'meta' => $meta
                    ), true);?>
                    
                    <?php endif; ?>

                <?php if (riake('gui_saver', $meta) || in_array($action, array( null, false ), true) ) :?>
                </form>
                <?php endif;?>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    <?php endforeach;?>
    </div>

</div>

<?php endif;?>
