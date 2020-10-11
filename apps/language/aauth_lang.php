<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* E-mail Messages */

// Account verification
$lang['aauth_email_verification_subject'] = __('Account Verification');
$lang['aauth_email_verification_code']    = __('Your verification code is: ');
$lang['aauth_email_verification_text']    = __(" You can also click on (or copy and paste) the following link\n\n");

// Password reset
$lang['aauth_email_reset_subject'] = __('Reset Password');
$lang['aauth_email_reset_text']    = __("To reset your password click on (or copy and paste in your browser address bar) the link below:\n\n");

// Password reset success
$lang['aauth_email_reset_success_subject']      = __('Successful Pasword Reset');
$lang['aauth_email_reset_success_new_password'] = __('Your password has successfully been reset. Your new password is : ');

/* Error Messages */

// Account creation errors
$lang['aauth_error_email_exists']       = __('Email address already exists on the system. If you forgot your password, you can click the link below.');
$lang['aauth_error_username_exists']    = __('Account already exists on the system with that username. Please enter a different username, or if you forgot your password, please click the link below.');
$lang['aauth_error_email_invalid']      = __('Invalid email address');
$lang['aauth_error_password_invalid']   = __('Invalid password');
$lang['aauth_error_username_invalid']   = __('Invalid Username');
$lang['aauth_error_username_required']  = __('Username required');
$lang['aauth_error_totp_code_required'] = __('Authentication Code required');
$lang['aauth_error_totp_code_invalid']  = __('Invalid Authentication Code');

// Account update errors
$lang['aauth_error_update_email_exists']    = __('Email address already exists on the system.  Please enter a different email address.');
$lang['aauth_error_update_username_exists'] = __('Username already exists on the system.  Please enter a different username.');

// Access errors
$lang['aauth_error_no_access']               = __('Sorry, you do not have access to the resource you requested.');
$lang['aauth_error_login_failed_email']      = __('Email Address and Password do not match.');
$lang['aauth_error_login_failed_name']       = __('Username and Password do not match.');
$lang['aauth_error_login_failed_all']        = __('Email, Username or Password do not match.');
$lang['aauth_error_login_attempts_exceeded'] = __('You have exceeded your login attempts, your account has now been locked.');
$lang['aauth_error_recaptcha_not_correct']   = __('Sorry, the reCAPTCHA text entered was incorrect.');

// Misc. errors
$lang['aauth_error_no_user']              = __('User does not exist');
$lang['aauth_error_vercode_invalid']      = __('Invalid Verification Code');
$lang['aauth_error_account_not_verified'] = __('Your account has not been verified. Please check your email and verify your account.');
$lang['aauth_error_no_group']             = __('Group does not exist');
$lang['aauth_error_no_subgroup']          = __('Subgroup does not exist');
$lang['aauth_error_self_pm']              = __('It is not possible to send a Message to yourself.');
$lang['aauth_error_no_pm']                = __('Private Message not found');

/* Info messages */
$lang['aauth_info_already_member']   = __('User is already member of group');
$lang['aauth_info_already_subgroup'] = __('Subgroup is already member of group');
$lang['aauth_info_group_exists']     = __('Group name already exists');
$lang['aauth_info_perm_exists']      = __('Permission name already exists');

$lang[ 'group-updated' ] = __('The group has been updated');

$lang[ 'fetch-error-from-auth' ] = function () {
    $errors_array = get_instance()->aauth->get_errors_array();
    $notice_array = get_instance()->aauth->get_infos_array();
    foreach ($errors_array as $_error) {
        echo $_error;
    }

    foreach ($notice_array as $notice) {
        echo $notice;
    }
};

// User Edition
$lang[ 'user-updated' ]       = __('User settings has been updated.');
$lang[ 'user-deleted' ]       = __('The user has been deleted.');
$lang[ 'pass-change-error' ]  = __('The new password cannot match the old one, please use another password.');
$lang[ 'old-pass-incorrect' ] = __('Your old password is not correct.');

// Group
$lang[ 'group-already-exists' ] = __('A group with this name already exists. Please choose another name.');
$lang[ 'group-created' ]        = __('Group has been created.');
$lang[ 'group-not-found' ]      = __('This group does\'nt exists or has been deleted.');
$lang[ 'unknow-group' ]         = __('Unknow group.');
$lang[ 'updated' ]              = __('Group has been updated.');
$lang[ 'cant-delete-yourself' ] = __( 'You can\'t delete your own  account.' );
