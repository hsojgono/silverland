<?php

defined('BASEPATH') OR exit('No direct script accessa allowed');

class Account extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->library('calendar');
		$data = array(
			3  => site_url('account/calendar_event/1'),
			7  => site_url('account/calendar_event/2'),
			13 => site_url('account/calendar_event/3'),
			26 => site_url('account/calendar_event/4')
		);
		
		$data[2] = site_url('account/calendar_event/5');
		
		$year = date('Y');
		$month =  date('n');
		echo $this->calendar->generate($year, $month, $data);
	}
	
	public function calendar_event($event_id)
	{
		echo '<pre>';
		echo 'EventID: ' . $event_id;
		echo '</pre>';
	}
}