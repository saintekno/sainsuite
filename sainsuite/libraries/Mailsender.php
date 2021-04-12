<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailsender
{
	public $mailer;
	public $template;
	public $config_vars;
	public $body = '';
    public $body_alt = '';
    
    public function __construct()
    {        
		// creating the phpmailer object
        $mail = new PHPMailer;

		// enables SMTP debug information (for testing)
		// 1 = client; will show you messages sent by the client
		// 2 = client and server; will add server messages, it’s the recommended setting.
		// 3 = client, server, and connection; will add information about the initial information, might be useful for discovering STARTTLS failures
		// 4 = low-level information. 
		$mail->SMTPDebug = 0;

		// Set the class to use smtp method
        $mail->isSMTP();

		// Enable smtp authentication
        $mail->SMTPAuth = true;

		// Aktifkan jika isi emailnya berupa html
		$mail->isHTML(true); 

        $this->config_vars = get_instance()->events->apply_filters('fill_config_aauth', get_instance()->config->item('aauth'));
        if(isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])){
			// for gmail
            $mail->SMTPSecure = $this->config_vars['email_config']['smtp_crypto'];
            $mail->Host       = $this->config_vars['email_config']['smtp_host'];
            $mail->Port       = $this->config_vars['email_config']['smtp_port'];

            $mail->Username   = $this->config_vars['email_config']['smtp_user'];
            $mail->Password   = $this->config_vars['email_config']['smtp_pass'];
            $mail->Timeout    = $this->config_vars['email_config']['smtp_timeout'];
        }
		
		$mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
		$mail->CharSet     = 'UTF-8';
		$mail->Encoding    = '8bit';

        // Save PHPMailer Instance
        $this->mailer = $mail;
    }

	/**
	 * Template .html path
	 * @param String $path 
	 */
	public function setTemplateURL($path) {
		$this->template = $path;
		$this->body = file_get_contents($this->template);
	}

	public function setBodyAlt($string) {
		$this->body_alt = $string;
	}

	/**
	 * Remplace mail variables inside template with %var% notation.
	 * @return Array 
	 */
	public function compose($args) {
		if(is_array($args)) {
			foreach($args as $key => $value){
				if(!is_array($value)) $this->body = preg_replace('/%'.$key.'%/', $value, $this->body);	
			}
		}
	}

	/**
	 * Send!
	 * @param  [type] $from    [description]
	 * @param  [type] $to      [description]
	 * @param  [type] $subject [description]
	 * @return [type]          [description]
	 */
	function send($to, $subject) {
		
		$this->mailer->Subject = $subject;
		$this->mailer->MsgHTML($this->body);

		if(!empty($this->body_alt)) $this->mailer->AltBody = $this->body_alt; 
		
		$this->mailer->setFrom($this->config_vars['email'], $this->config_vars['name']);

		// add one or multiple recipient
		if(!is_array($to)) :
			$this->mailer->addAddress($to) ;
		else :
			//  blind carbon copy (bcc) to the recipient.
			foreach ($to as $email => $name) {
				$this->mailer->addBcc($email, $name);
			}
		endif;
		
		try {
			$this->mailer->Send();
			$this->mailer->SmtpClose();
			echo "Mail send successfully";
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}