<?php 
global $Options;
if ($this->polatan->get_page() === '404') : ?>

<div class="d-flex flex-column-fluid flex-center" id="kt_home">
    <div class="d-flex flex-column justify-content-center align-items-center px-5 text-center">
        <?php if (riake('demo_mode', $Options)) : ?>
        <span class="svg-icon svg-icon-10x svg-icon-success">
            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Stockholm-icons-/-General-/-Shield-protected" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"></path>
                    <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" id="Combined-Shape" fill="#000000"></path>
                </g>
            </svg>
        </span>
        <h3 class="display-4 font-weight-bold mt-7 mb-2">This demo application</h3>
        <?php else : ?>
        <img class="w-150px" src="<?=img_url();?>svg/error-illustration.svg"/>
        <h3 class="display-4 font-weight-bold mt-7 mb-2">Oops! Why you’re here?</h3>
        <p class="font-weight-bold opacity-80">
        We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.
        </p>
        <?php endif; ?>
    </div>
</div>

<?php elseif (empty($this->polatan->get_cols())) :  ?>

<div class="d-flex flex-column-fluid flex-center" id="kt_home">
    <div class="d-flex flex-column justify-content-center align-items-center px-5 text-center">
        <img class="w-150px" src="<?=img_url();?>svg/empty-state.svg"/>
        <h3 class="display-4 mt-7 mb-2">Hello <span class="font-weight-bold">Buddy!</span> Let's get started</h3>
        <p class="font-weight-bold opacity-80">
        Get started building your personal projects, testing out ideas, and more in your spontaner workspace.
        </p>
    </div>
</div>

<?php else : ?>
    
<div class="d-flex flex-column-fluid" id="kt_data">
    <div class="container">
        
        <div class="<?php echo $this->events->apply_filters('kt_subheader_mobile_toggle_row', 'row');?>">
        <?php foreach (force_array($this->polatan->get_cols()) as $col_id => $col_data):?>
        <?php if (riake('class', $col_data)) : ?>
        <div class="<?php echo riake('class', $col_data);?>" id="<?php echo riake('id', $col_data);?>" style="<?php echo riake('style', $col_data);?>">
        <div class="row"> 
        <?php endif;?>

            <?php foreach (force_array(riake('metas', $col_data)) as $meta) : ?>
            <div class="<?php echo riake('class', $meta);?>" id="<?php echo riake('id', $meta);?>">
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

                <?php if (function_exists('validation_errors') && validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo strip_tags(validation_errors())?>
                </div>
                <?php endif; ?>

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
                    <div class="card card-custom <?php echo riake('card', $meta, 'card-px-0 border-0') ;?> gutter-b">
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

                        <div class="card-body p-0">
                            <?php echo $this->load->backend_view('elements/_init', array(
                                'namespace' => $namespace,
                                'meta' => $meta
                            ), true);?>
                        </div>

                        <?php if ($footer = riake('footer', $meta)) : ?>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="submit" onclick="checkRequiredFields()" name="submit" class="btn btn-primary mr-2" value="<?php echo ($footer == 'add') ? __('Save New') : __('Save changes');?>">
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <?php else : ?>

                    <?php echo $this->load->backend_view('elements/_init', array(
                        'namespace' => $namespace,
                        'meta' => $meta
                    ), true);?>
                    <?php endif; ?>

                <?php if (riake('gui_saver', $meta) || in_array($action, array( null, false ), true) ) :?>
                </form>
                <?php endif;?>
            </div>
            <?php endforeach;?>

        <?php if (riake('class', $col_data)) : ?>
        </div></div>
        <?php endif;?>
        <?php endforeach;?>
        </div>

    </div>
</div>

<?php endif;?>
