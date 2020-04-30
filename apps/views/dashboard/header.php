<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    
    <!-- Add Scale for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- End Add Scale for mobile devices -->
    
    <title><?php echo Html::get_title();?></title>

    <?php 
    global $Options;
    // Load Rest Keys
    $this->load->addin_config('restful', '_rest'); 
    ?>

    <script type="text/javascript">
        var eracik = new Object;
        eracik.rest = {
            key  : '<?php echo $this->config->item('rest_key_name');?>',
            value: '<?php echo @$Options[ 'rest_key' ];?>'
        }
        eracik.site_url = '<?php echo site_url();?>';
        eracik.dashboard_url	= '<?php echo site_url(array( 'dashboard' ));?>';
        eracik.current_url =	'<?php echo current_url();?>';
        eracik.index_url = '<?php echo index_page();?>';
        eracik.form_expire =	'<?php echo gmt_to_local(time(), 'UTC') + GUI_EXPIRE;?>';
        eracik.user =	{
            id : '<?php echo $this->events->apply_filters('Do_object_user_id', 'false' );?>'
        }
        eracik.csrf_field_name =	'<?php echo $this->security->get_csrf_token_name();?>';
        eracik.csrf_field_value = '<?php echo $this->security->get_csrf_hash();?>';
        eracik.csrf_data = {
            '<?php echo $this->security->get_csrf_token_name();?>' : '<?php echo $this->security->get_csrf_hash();?>'
        };
        eracik.server_date = '<?php echo date_now( 'Y-m-d H:i:s' );?>';
        eracik.options =	new function(){
            var $this =	this;
            var save_slug;
            this.set = function( key, value, user_meta ) {
                if( typeof user_meta != 'undefined' ) {
                    save_slug =	'save_user_meta';
                } else {
                    save_slug =	'save';
                }
                value =	( typeof value == 'object' ) ? JSON.stringify( value ) : value
                var post_data =	_.object( [ key ], [ value ] );
                // Add CSRF Secure for POST Ajax
                eracik.options_data = _.extend( eracik.options_data, eracik.csrf_data );
                eracik.options_data = _.extend( eracik.options_data, post_data );

                $.ajax( '<?php echo site_url(array( 'dashboard', 'options' ));?>/'+save_slug, {
                    data : eracik.options_data,
                    type : 'POST',
                    beforeSend : function(){
                        if( _.isFunction( $this.beforeSend ) ) {
                            $this.beforeSend();
                        }
                    },
                    success : function( data ) {
                        if( _.isFunction( $this.success ) ) {
                            $this.success( data );
                        }
                    }
                });
            };
            this.merge = function( key, value, user_meta ) {
                if( typeof user_meta != 'undefined' ) {
                    save_slug =	'merge_user_meta';
                } else {
                    save_slug =	'merge';
                }
                var post_data = _.object( [ key ], [ value ] );
                eracik.options_data = _.extend( eracik.options_data, eracik.csrf_data );
                eracik.options_data = _.extend( eracik.options_data, post_data );
                $.ajax( '<?php echo site_url(array( 'dashboard', 'options' )); ?>/' + save_slug, {
                    data : eracik.options_data,
                    type : 'POST',
                    beforeSend : function(){
                        if( _.isFunction( $this.beforeSend ) ) {
                            $this.beforeSend();
                        }
                    },
                    success : function( data ) {
                        if( _.isFunction( $this.success ) ) {
                            $this.success( data );
                        }
                    }
                });
            };
            this.get = function( key, callback ) {
                var post_data = _.object( [ 'option_key' ], [ key ] );
                eracik.options_data = _.extend( eracik.options_data, eracik.csrf_data );
                eracik.options_data = _.extend( eracik.options_data, post_data );
                $.ajax( '<?php echo site_url(array( 'dashboard', 'options', 'get' ));?>', {
                    data :	eracik.options_data,
                    type :	'POST',
                    beforeSend : function(){
                        // $this.beforeSend();
                    },
                    success : function( data ){
                        if( _.isFunction( callback ) ) {
                            callback( data );
                        }
                    }
                });
            }
            this.beforeSend = function( callback ) {
                this.beforeSend	= callback;
                return this;
            };
            this.success = function( callback ) {
                this.success = callback
                return this;
            }
        }
    </script>

    <?php $this->events->do_action('dashboard_header');?>
</head>
