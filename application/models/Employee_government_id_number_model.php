<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employment Information Model Class
 *
 * @author 		cristhian.sagun@systemantech.com
 */
class Employee_government_id_number_model extends MY_Model
{
	protected $_table = 'employee_government_id_numbers';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	protected $after_get = array('prep_data');

	protected function prep_data($employee_information)
	{
		if ( ! isset($employee_information)) return FALSE;

		// $middle_initial = '';

		// if (isset($employee_information['middle_name'])) {
		// }

		$middle_initial = (strlen($employee_information['middle_name']) > 1) ? substr($employee_information['middle_name'], 0, 1) : $employee_information['middle_name'];
		
		$full_name = array(
			$employee_information['last_name'].', ',
			$employee_information['first_name'].' ',
			$middle_initial
		);

		$employee_information['full_name'] = strtoupper(implode('', $full_name));

		if (isset($employee_information['regularization_status'])) {
			$employee_information['regularization_label'] = ($employee_information['regularization_status'] == 1) ? 'REGULAR':'PROBITIONARY';
		}
		
		return $employee_information;
	}

	public function get_details($method, $where)
	{
		$this->db->select(
			'employee_government_id_numbers.*,
			employees.first_name,
			employees.middle_name,
			employees.last_name,
			employee_government_id_numbers.tin as employee_government_id_numbers_tin,
			employee_government_id_numbers.sss as employee_government_id_numbers_sss,
			employee_government_id_numbers.hdmf as employee_government_id_numbers_hdmf,
			employee_government_id_numbers.phic as employee_government_id_numbers_phic'
		)

		->join('employees', 'employees.id = employee_government_id_numbers.employee_id', 'left');
		return $this->{$method}($where);
	}
}

// End of file Employee_government_id_number_model.php
// Location: ./application/models/Employee_government_id_number_model.php