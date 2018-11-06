<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
*
*/
class Employee_information_manager
{
	private $ci;
	private $_params = array();

	function __construct($params)
	{
		$ci =& get_instance();

		$this->_params = $params;
	}

	public function edit()
	{
		$event_trigger = $this->_params['event_trigger'];
		$this->{$event_trigger}();
	}

	public function personal_information()
	{
		dump($this->_params, 'asdasd');
		dump('personal_information on employee library');
	}

	public function parents_information()
	{
		dump($this->_params, 'asdasd');
		dump('parents_information on employee library');
	}

	public function spouse_information()
	{
		dump($this->_params, 'asdasd');
		dump('spouse_information on employee library');
	}

	public function dependents_information()
	{
		dump($this->_params, 'asdasd');
		dump('dependents_information on employee library');
	}
}

// End of file Employee.php
// Location: ./application/libraries/Employee.php
