<?php

// System
$lang[ 'database-installed' ] = Do_success(__('Database has been installed.'));
$lang[ 'database-not-found' ] = Do_error(__('Eracik can\'t access to the database.'));
$lang[ 'unable-to-connect' ] = Do_error(__('Eracik cannot connect to your database host.'));
$lang[ 'error-occured' ] = Do_error(__('An error occured.'));
$lang[ 'unexpected-error' ] = Do_error(__('An unexpected error occured.'));
$lang[ 'access-denied' ] = Do_error(__('Access Denied.'));
$lang[ 'option-saved' ] = Do_success(__('Option was successfully saved.'));
$lang[ 'unable-to-find-item' ] = Do_error( __( 'Unable to find this item. It may have been deleted or moved.' ) );

// Login page
$lang[ 'signin-notice-message' ] = __('Sign in to start your session');
$lang[ 'recovery-notice-message' ] = __('Please enter your email addresse. A recovery email will be send to you.');
$lang[ 'user-logged-in' ] = Do_success(__('You logged in successfully.'));
$lang[ 'wrong-password-or-credentials' ] = Do_error(__('Wrong Password or User Name'));
$lang[ 'login-required' ] = Do_info(__('Login is required.'));

// Registration
$lang[ 'username-used' ] = Do_error(__('Username is already used by another user.'));
$lang[ 'email-used' ] = Do_error(__('This email is already used.'));
$lang[ 'email-already-taken' ] = Do_error(__('This email seems to be already taken.'));
$lang[ 'username-already-taken' ] = Do_error(__('This username seems to be already taken.'));
$lang[ 'user-created' ] = Do_success(__('The user has been successfully created.'));
$lang[ 'account-activated' ] = Do_success(__('Your Account has been activated. Please Sign-in'));

// Recovery
$lang[ 'unknow-email' ] = Do_error(__('Unknow email address'));
$lang[ 'recovery-email-send' ] = Do_success(__('The recovery email has been send. Please check your email, open the recovery email and follow the instructions.'));

// Logout
$lang[ 'logout-required' ] = Do_info(__('You must logout first to access that page.'));

// General
$lang[ 'new-password-created' ]  = Do_success(__('A new password has been created for your account. Check your email to get it.'));
$lang[ 'module-enabled' ] = Do_success(__('The module has been enabled.'));
$lang[ 'module-disabled' ] = Do_success(__('The module has been disabled.'));
$lang[ 'module-removed' ] = Do_success(__('The module has been removed.'));
$lang[ 'module-extracted' ] = Do_success(__('The module has been extracted.'));
$lang[ 'module-updated' ] = Do_success(__('The module has been updated.'));
$lang[ 'unable-to-update' ] = Do_error(__('An error occured during update.'));
$lang[ 'config-file-not-found' ] = Do_error(__('Config file hasn\'t been found. This file is not a valid module. Installation aborded !!!'));
$lang[ 'old-version-cannot-be-installed' ] = Do_error(__('The version installed is already up to date.'));
$lang[ 'migration-not-required' ] = Do_info(__('A migration is not required or has already been done.'));

// Extension
$lang[ 'fetch-from-upload' ] = function () 
{
    $error = array('error' =>get_instance()->upload->display_errors());
    foreach ($error as $type => $_error) 
    {
        if ($type == 'error') 
        {
            echo Do_error(strip_tags($_error));
        } 
        else 
        {
            echo Do_info(strip_tags($_error));
        }
    }
};

