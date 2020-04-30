<?php

class aauth_fields extends CI_model
{
    public function __construct()
    {
        $this->events->add_filter('installation_fields', array( $this, '_installation_fields' ), 10, 1);
        // add action to display login fields
        $this->events->add_action('display_login_fields', array( $this, '_display_login_fields' ));
        $this->events->add_action('load_users_custom_fields', array( $this, '_load_users_custom_fields' ));
        $this->events->add_filter('displays_registration_fields', array( $this, '_displays_registration_fields' ));
        $this->events->add_action('displays_public_errors', array( $this, '_displays_public_errors' ));
        $this->events->add_action('displays_dashboard_errors', array( $this, '_displays_dashboard_errors' ));
        $this->events->add_filter('custom_user_meta', array( $this, '_custom_user_meta' ), 10, 1);
        $this->events->add_filter('recovery_fields', array( $this, '_recovery_fields' ));
    }

	// --------------------------------------------------------------------

    public function _installation_fields($fields)
    {
        ob_start();
        ?>
        <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="<?php _e('User Name', 'aauth');
        ?>" name="username" value="<?php echo set_value('username');
        ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="<?php _e('Email', 'aauth');
        ?>" name="email" value="<?php echo set_value('email');
        ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="<?php _e('Password', 'aauth');
        ?>" name="password" value="<?php echo set_value('password');
        ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="<?php _e('Password confirm', 'aauth');
        ?>" name="confirm" value="<?php echo set_value('confirm');
        ?>">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <?php
        return $fields    .=    ob_get_clean();
    }

	// --------------------------------------------------------------------

    public function _display_login_fields()
    {
        // default login fields
        $this->config->set_item('signin_fields', array(
            'pseudo' =>
                '<div class="form-group mb-3">
                    <input id="inputEmail" type="text" placeholder="' . __('Email or User Name', 'aauth') .'" name="username_or_email" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                </div>',
            'password' =>
                '<div class="form-group mb-3">
                    <input id="inputPassword" type="password" placeholder="' . __('Password', 'aauth') .'" required="" name="password" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                </div>',
            'submit' =>
                '<div class="custom-control custom-checkbox mb-3">
                    <input id="customCheck1" name="keep_connected" type="checkbox" class="custom-control-input">
                    <label for="customCheck1" class="custom-control-label">' . __('Remember me', 'aauth') . '</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">' . __('Sign In', 'aauth') .'</button>'
        ));
    }

	// --------------------------------------------------------------------

    public function _displays_public_errors()
    {
        $errors = $this->users->auth->get_errors_array();
        if ($errors) 
        {
            foreach ($errors as $error) {
                echo Do_error($error);
            }
        }
    }

	// --------------------------------------------------------------------

    public function _recovery_fields()
    {
        ob_start();
        ?>
        <small><?php echo Do_info(__('Please provide your user email in order to get recovery email', 'aauth'));?></small>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3"><i class='fa fa-envelope'></i></span>
            </div>
            <input type="text" class="form-control" placeholder="<?php _e('User email', 'aauth');?>" aria-describedby="basic-addon1" name="user_email">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><?php _e('Recovery', 'aauth'); ?></button>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

	// --------------------------------------------------------------------

    public function _displays_registration_fields($fields)
    {
        return $fields .= $this->load->addin_view( 'aauth', 'users/registration-fields', compact( 'fields' ), true );
    }
    
	// --------------------------------------------------------------------

    /**
    * Adds custom fields for user creation and edit
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function _load_users_custom_fields($config)
    {
        if ( $config[ 'mode' ] === 'edit' ) 
        {
            $this->Gui->add_item([
                'type'        => 'text',
                'name'        => 'first-name',
                'label' => __('First Name', 'aauth'),
                'placeholder' => __('First Name', 'aauth'),
                'icon'        => 'users',
                'value'       => $this->options->get( 'first-name', $config[ 'user_id' ] ),
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);
    
            $this->Gui->add_item([
                'type'        => 'text',
                'name'        => 'last-name',
                'label' => __('Last Name', 'aauth'),
                'placeholder' => __('Last Name', 'aauth'),
                'icon'        => 'users',
                'value'       => $this->options->get( 'last-name', $config[ 'user_id' ] ),
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);  

            $skin = $this->options->get( 'theme-skin', $config[ 'user_id' ]);
        } 
        else 
        {
            $this->Gui->add_item([
                'type'        => 'text',
                'name'        => 'first-name',
                'label' => __('First Name', 'aauth'),
                'placeholder' => __('First Name', 'aauth'),
                'icon'        => 'users',
                'user_id'     => @$config[ 'user_id' ],
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);
    
            $this->Gui->add_item([
                'type'        => 'text',
                'name'        => 'last-name',
                'label' => __('Last Name', 'aauth'),
                'placeholder' => __('Last Name', 'aauth'),
                'icon'        => 'users',
                'user_id'     => @$config[ 'user_id' ],
            ], $config[ 'meta_namespace' ], $config[ 'col_id' ]);  
        }              
        
        $dom = $this->load->addin_view( 'aauth', 'users/custom-fields', compact( 'config' ), true );

        riake( 'gui', $config )->add_item(array(
            'type'    => 'dom',
            'content' => $dom
        ), $config[ 'meta_namespace' ], $config[ 'col_id' ]);

        unset( $skin, $config, $dom );
    }
    
	// --------------------------------------------------------------------

    /**
    * Displays Error on Dashboard Page
    **/
    
    public function _displays_dashboard_errors()
    {
        $errors = $this->users->auth->get_errors_array();
        if ( $errors ) 
        {
            foreach ($errors as $error) {
                echo Do_error($error);
            }
        }
    }

	// --------------------------------------------------------------------
    
    /**
    * Adds custom meta for user
    *
    * @access : public
    * @param : Array
    * @return : Array
    **/
    
    public function _custom_user_meta($fields)
    {
        $fields[ 'first-name' ] = ($fname = $this->input->post('first-name')) ? $fname : '';
        $fields[ 'last-name' ]  = ($lname = $this->input->post('last-name')) ? $lname : '';
        $fields[ 'theme-skin' ] = ($skin  = $this->input->post('theme-skin')) ? $skin : 'skin-blue';
        return $fields;
    }
}
new aauth_fields;