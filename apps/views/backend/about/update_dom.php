<?php
if ($update === 'unknow-release') 
{
    ?>
    <h4><?php echo sprintf(__('Unknow Release : %s'), $release); ?></h4>
    <p><?php _e('Update has been aborded...!!!'); ?></p>
    <?php
} 
elseif ($update === 'old-release') 
{ 
    ?>
    <h4><?php echo sprintf(__('Old Release : %s'), $release); ?></h4>
    <p><?php _e('Update has been aborded...!!!'); ?></p>
    <?php
} 
else 
{
    ?>
    <script>
    $(document).ready( function() {
        function stage( int )
        {
            if( int == 1 ){
                $.ajax( '<?php echo site_url(array( 'admin', 'about', 'download', $update )); ?>',{
                    beforeSend: function(){
                        $('#update').append( '<div><?php _e('Downloading Zip file...'); ?></div>' );
                    },
                    success : function( data ){
                        if( typeof data.code != 'undefined' )
                        {
                            if( data.code != 'error-occured' ){
                                stage(2);
                            } else {
                                $('#update').append( '<div><?php _e('An error occured during download...'); ?></div>' );
                            }
                        }
                    },
                    dataType : 'json'
                });
            } 
            else if( int == 2 )
            {
                $.ajax( '<?php echo site_url(array( 'admin', 'about', 'extract' )); ?>',{
                    beforeSend: function(){
                        $('#update').append( '<div><?php _e('Extracting the new release...'); ?></div>' );
                    },
                    success: function( data ){
                        if( typeof data.code != 'undefined' )
                        {
                            if( data.code != 'error-occured' ){
                                stage(3);
                            } else {
                                $('#update').append( '<div><?php _e('An error occured during extraction...'); ?></div>' );
                            }
                        }
                    },
                    dataType : 'json'
                });
            } 
            else if( int == 3 )
            {
                $.ajax( '<?php echo site_url(array( 'admin', 'about', 'install' )); ?>',{
                    beforeSend: function(){
                        $('#update').append( '<div><?php _e('Installing the new release...'); ?></div>' );
                    },
                    success: function( data ){
                        if( typeof data.code != 'undefined' )
                        {
                            if( data.code != 'error-occured' ){
                                document.location = '<?php echo site_url(array( 'admin', 'about' )); ?>';
                            } else {
                                $('#update').append( '<div><?php _e('An error occured during extraction...'); ?></div>' );
                            }
                        }
                    },
                    dataType : 'json'
                });
            }
        }

        stage(1);
    });
    </script>

    <p id="update"></p>
    <?php
}
?>