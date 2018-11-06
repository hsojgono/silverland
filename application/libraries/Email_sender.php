<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
* 
*/
class Email_sender
{
	private $ci;

	function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model(array(
			'employee_model',
			'daily_time_record_model',
			'attendance_summary_model'
		));
		$this->ci->load->library('email');
	}

	function send_to_approver()
	{
		echo 'Sending email to';
	}

	public function send_email($subject, $message, $email_requester, $email_approver)
	{
		$this->ci->email->clear();

		$this->ci->email->to($email_approver);
		$this->ci->email->from($email_requester);
		$this->ci->email->subject($subject);
		$this->ci->email->message($message);
		$this->ci->email->send();
	}
}