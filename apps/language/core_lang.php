<?php
defined('BASEPATH') or exit('No direct script access allowed');

// System
$lang[ 'database-installed' ]  = __('Database has been installed');
$lang[ 'sainsuite-installed' ]    = __('System has been installed');
$lang[ 'database-not-found' ]  = __('SainSuite can\'t access to the database.');
$lang[ 'unable-to-connect' ]   = __('SainSuite cannot connect to your database host.');
$lang[ 'error-occured' ]       = __('An error occured.');
$lang[ 'unexpected-error' ]    = __('An unexpected error occured.');
$lang[ 'access-denied' ]       = __('Access Denied.');
$lang[ 'file-conflict' ]       = __('File Conflict.');
$lang[ 'option-saved' ]        = __('Option was successfully saved.');
$lang[ 'unable-to-find-item' ] = __('Unable to find this item. It may have been deleted or moved.' );

// Login page
$lang[ 'signin-notice-message' ]         = __('Sign in to start your session');
$lang[ 'recovery-notice-message' ]       = __('Please enter your email addresse. A recovery email will be send to you.');
$lang[ 'user-logged-in' ]                = __('You logged in successfully.');
$lang[ 'wrong-password-or-credentials' ] = __('Wrong Password or User Name');
$lang[ 'login-required' ]                = __('Login is required.');
$lang[ 'assets-builded' ]                = __( 'The assets files has been builded' );
$lang[ 'assets-published' ]              = __( 'The assets files has been published' );
// Registration
$lang[ 'username-used' ]          = __('Username is already used by another user.');
$lang[ 'email-used' ]             = __('This email is already used.');
$lang[ 'email-already-taken' ]    = __('This email seems to be already taken.');
$lang[ 'username-already-taken' ] = __('This username seems to be already taken.');
$lang[ 'user-created' ]           = __('The user has been successfully created.');
$lang[ 'account-activated' ]      = __('Your Account has been activated. Please Sign-up');
// Recovery
$lang[ 'unknow-email' ]        = __('Unknow email address');
$lang[ 'recovery-email-send' ] = __('The recovery email has been send. Please check your email, open the recovery email and follow the instructions.');
// Logout
$lang[ 'logout-required' ] = __('You must logout first to access that page.');

// General
$lang[ 'addon-enabled' ]                   = __('The addon has been enabled.');
$lang[ 'addon-disabled' ]                  = __('The addon has been disabled.');
$lang[ 'addon-removed' ]                   = __('The addon has been removed.');
$lang[ 'addon-extracted' ]                 = __('The addon has been extracted.');
$lang[ 'addon-updated' ]                   = __('The addon has been updated.');
$lang[ 'addon-sync' ]                      = __('The addon has been sync.');
$lang[ 'addon-installed' ]                 = __('The addon has been installed.');
$lang[ 'old-version-cannot-be-installed' ] = __('The version installed is already up to date.');
$lang[ 'unable-to-update' ]                = __('An error occured during update.');
$lang[ 'reset-not-handled' ]               = __('Resetting the setup is not handled by this addon.');
$lang[ 'reset-not-properly-handled' ]      = __('The addon has\'nt returned a valid state after the operation.');
$lang[ 'reset-completed' ]                 = __('The reset process has runned successfully.');
$lang[ 'manifest-file-not-found' ]         = __('manifest file hasn\'t been found. This file is not a valid addon. Installation aborded !!!');
$lang[ 'manifest-file-incorrect' ]         = __('manifest file incorrect. This file is not a valid addon. Installation aborded !!!');
$lang[ 'migration-not-required' ]          = __('A migration is not required or has already been done.');

// Extension
$lang[ 'fetch-from-upload' ] = function () {
    $error = array('error' =>get_instance()->upload->display_errors());
    foreach ($error as $type => $_error) {
        if ($type == 'error') {
            echo strip_tags($_error);
        } else {
            echo strip_tags($_error);
        }
    }
};