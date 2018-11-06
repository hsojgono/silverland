<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employment Information Model Class
 *
 * @author 		cristhian.sagun@systemantech.com
 */
class Employee_employment_information_model extends MY_Model
{
	protected $_table = 'employee_information';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	protected $after_get = array('prep_data');

	protected function prep_data($employee_information)
	{
		if ( ! isset($employee_information)) return FALSE;

		$middle_initial = (strlen($employee_information['middle_name']) > 1) ? substr($employee_information['middle_name'], 0, 1) : $employee_information['middle_name'];

		$full_name = array(
			$employee_information['last_name'].', ',
			$employee_information['first_name'].' ',
			$middle_initial
		);

		$employee_information['full_name'] = strtoupper(implode('', $full_name));
		$employee_information['regularization_label'] = ($employee_information['regularization_status'] == 1) ? 'REGULAR':'PROBATIONARY';
		$employee_information['regularized_date'] = ($employee_information['date_regularized'] == '0000-00-00 00:00:00') ? '-' : 
			date('M d, Y', strtotime($employee_information['date_regularized']));
		return $employee_information;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
				employee_information.id as employee_information_id,
				employee_information.employee_id,
				employee_information.company_id,
				employee_information.date_hired,
				employee_information.date_regularized,
				employee_information.regularization_status,
				employee.first_name,
				employee.middle_name,
				employee.last_name,
				company.name AS company,
				branch.name AS branch,
				cost_center.name AS cost_center,
				department.name AS department,
				team.name AS team,
				site.name AS site,
				position.name AS position,
				employee_govt_id.tin,
				employee_govt_id.sss,
				employee_govt_id.hdmf,
				employee_govt_id.phic,
				employment_type.type_name AS employee_type,
				employee.employee_code as employee_code
    		')
			->join('employees as employee', 'employee_information.employee_id = employee.id', 'left')
			->join('companies as company', 'employee_information.company_id = company.id', 'left')
			->join('branches as branch', 'employee_information.branch_id = branch.id', 'left')
			->join('cost_centers as cost_center', 'employee_information.cost_center_id = cost_center.id', 'left')
			->join('departments as department', 'employee_information.department_id = department.id', 'left')
			->join('teams as team', 'employee_information.team_id = team.id', 'left')
			->join('sites as site', 'employee_information.site_id = site.id', 'left')
			->join('positions as position', 'employee_information.position_id = position.id', 'left')
			->join('employee_government_id_numbers as employee_govt_id', 'employee_information.govt_numbers_id = employee_govt_id.id', 'left')
			->join('employment_types as employment_type', 'employee_information.employment_type_id = employment_type.id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Employment_information_model.php
// Location: ./application/models/Employment_information_model.php