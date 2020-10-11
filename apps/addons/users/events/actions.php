<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_Action extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        
        // $this->events->add_action( 'load_dashboard', [ $this, 'load_dashboard' ] );
        // $this->events->add_action( 'load_frontend', [ $this, 'load_frontend' ]  );
        $this->events->add_action('load_users_custom_fields', array( $this, 'user_custom_fields' ));
    }
    
    /**
    * Adds custom fields for user creation and edit
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function user_custom_fields($config)
    {
        if ( $config[ 'mode' ] === 'edit' ) {
            $this->polatan->add_item([
                'type'      =>      'text',
                'name'      =>      'first-name',
                'label'     =>      __('First Name', 'aauth'),
                'value'     =>      $this->aauth->get_user_var( 'first-name', $config[ 'user_id' ] ),
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);
    
            $this->polatan->add_item([
                'type'      =>      'text',
                'name'      =>      'last-name',
                'label'     =>      __('Last Name', 'aauth'),
                'value'     =>      $this->aauth->get_user_var( 'last-name', $config[ 'user_id' ] ),
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);  

            $skin = $this->aauth->get_user_var( 'theme-skin', $config[ 'user_id' ]);
        } 
        else {
            $this->polatan->add_item([
                'type'      =>      'text',
                'name'      =>      'first-name',
                'label'     =>      __('First Name', 'aauth'),
                'user_id'   =>      @$config[ 'user_id' ],
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);
    
            $this->polatan->add_item([
                'type'      =>      'text',
                'name'      =>      'last-name',
                'label'     =>      __('Last Name', 'aauth'),
                'user_id'   =>      @$config[ 'user_id' ],
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);  
        }              
        
        riake( 'gui', $config )->add_item(array(
            'type'        =>    'dom',
            'content'    =>   $this->load->addon_view( 'users', 'custom-fields', compact( 'config' ), true )
        ), $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        unset( $skin, $config );
    }
}
new Users_Action;