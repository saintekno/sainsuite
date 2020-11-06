<!--begin::Accordion-->
<div class="accordion accordion-light accordion-toggle-arrow"
    id="accordionExample2">
    <div class="card">
        <div class="card-header" id="headingOne2">
            <div class="card-title" data-toggle="collapse" data-target="#collapseOne2">
                <?php echo __('General Settings');?>
            </div>
            <p>Update your site name, description, language, and visibility..</p>
        </div>
        <div id="collapseOne2" class="collapse show" data-parent="#accordionExample2">
            <form class="form " action="<?php echo site_url(array( 'admin', 'options', 'save' ));?>" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="gui_saver_ref" value="<?php echo urlencode(current_url());?>" />
                <input type="hidden" name="gui_saver_expiration_time" value="<?php echo gmt_to_local(time(), 'UTC') + GUI_EXPIRE;?>" />
                <div class="box-body">
                    <div class="form-group">
                        <label><?php echo __('Site Name');?></label>
                        <input type="text" name="site_name" class="form-control" placeholder="<?php echo __('Enter your site name');?>" value="<?php echo $this->options_model->get('site_name');?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Site Description');?></label>
                        <textarea class="form-control" rows="3" placeholder="<?php echo __('Enter your site description');?>" name="site_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Timezone');?></label>
                        <select class="form-control" name="site_timezone">
                            <?php
                            foreach (force_array($this->config->item('site_timezone')) as $value => $text) {
                                $selected = $this->options_model->get('site_timezone') == $value ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                        <select class="form-control" name="site_language">
                            <?php
                            foreach (force_array($this->config->item('supported_languages')) as $value => $text) {
                                $selected = $this->options_model->get('site_language') == $value ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="help-block"></p>
                    </div>

                    <?php $this->events->do_action('register_general_settings_fields'); ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php echo __('Save Settings');?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
     
    <?php if ( User::control('manage.core') ) : ?>
    <div class="card">
        <div class="card-header" id="headingTwo2">
            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo2">
                <?php echo __('Advanced Settings');?>
            </div>
            <p>Advanced settings, open settings and developer mode.</p>
        </div>
        <div id="collapseTwo2" class="collapse" data-parent="#accordionExample2">
            <form ng-non-bindable="" class="form " id="" action="<?php echo site_url(array( 'admin', 'options', 'save' ));?>" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="gui_saver_ref" value="<?php echo urlencode(current_url());?>" />
                <input type="hidden" name="gui_saver_expiration_time" value="<?php echo gmt_to_local(time(), 'UTC') + GUI_EXPIRE;?>" />
                <div class="box-body">
                    <!-- <div class="form-group">
                        <label><?php echo __('Open registration');?></label>
                        <select class="form-control" name="site_registration">
                            <?php
                            $options = array(
                                0 => __('No'),
                                1 => __('Yes')
                            );
                            foreach (force_array($options) as $value => $text) {
                                $selected = $this->options_model->get('site_registration') == $value ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Require validation');?></label>
                        <select class="form-control" name="require_validation">
                            <?php
                            $options = array(
                                0 => __('No'),
                                1 => __('Yes')
                            );
                            foreach (force_array($options) as $value => $text) {
                                $selected = $this->options_model->get('require_validation') == $value ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="help-block"><?php echo __( 'Each new account will have to check the verification email in order to validate their account.' );?></p>
                    </div> -->
                    <div class="form-group">
                        <label><?php echo __('Enable Developer mode ?');?></label>
                        <select class="form-control" name="webdev_mode">
                            <?php
                            $options = array(
                                0 => __('No'),
                                1 => __('Yes')
                            );
                            foreach (force_array($options) as $value => $text) {
                                $selected = $this->options_model->get('webdev_mode') == $value ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $selected;?> value="<?php echo xss_clean( strip_tags( $value ) );?>"> <?php echo $text;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="help-block"><?php echo __('Tools like module package will be enabled.');?></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php echo __('Save Advanced');?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
<!--end::Accordion-->