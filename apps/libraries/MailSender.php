<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailSender
{
	public $mailer;
	public $template;
	public $config_publics;
	public $body = '';
    public $body_alt = '';
    
    public function __construct()
    {
        $this->config_vars = get_instance()->config->item('aauth');
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
		$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

        if(isset($this->config_vars['email_config']) && is_array($this->config_vars['email_config'])){
            $mail->Host       = $this->config_vars['email_config']['smtp_host'];
            $mail->Port       = $this->config_vars['email_config']['smtp_port'];
            $mail->Username   = $this->config_vars['email_config']['smtp_user'];
            $mail->Password   = $this->config_vars['email_config']['smtp_pass'];
            $mail->SMTPSecure = $this->config_vars['email_config']['smtp_crypto'];
        }

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

		if(!is_array($to)) $this->mailer->addAddress($to);
		else {
			foreach ($to as $email => $name) {
				$this->mailer->addBcc($email, $name);
			}
		}

		return $this->mailer->send();
	}
}