<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_information_model extends MY_Model
{
	protected $_table 	   = 'employee_information';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = ['set_default_data'];

	protected function set_default_data($employee_information)
	{
		if (!isset($employee_information)) {
			return false;
		}

		if (isset($employee_information['first_name']) && isset($employee_information['middle_name']) && $employee_information['last_name']) {
			$middle_name = (!empty($employee_information['middle_name'])) ? $employee_information['middle_name'] : '';
			$full_name = $employee_information['last_name'] . ', ' . $employee_information['first_name'] . ' ' . $middle_name;
            // $cut_off                  =$payrol['start_date'].'-'.$employee_information['end_date'];
			$employee_information['full_name'] = strtoupper($full_name);
		}
		return $employee_information;

	}

	public function get_details($method, $where)
	{
		$this->db->select('
			employee_information.id as employee_information_id,
			employee_information.employee_id,
			employee_information.date_hired,
			employee_information.active_status,
			employee_information.reports_to,
			employee.first_name,
			employee.middle_name,
			employee.last_name,
			company.name AS company,
			branch.name AS branch,
			cost_center.name AS cost_center,
			department.name AS department,
			team.name AS team,
			site.name AS site,
			position.id AS position_id,
			position.name AS position,
			team.id as team_id,
			employee_government_id_numbers.tin as tin,
			employee_government_id_numbers.sss as sss,
			employee_government_id_numbers.hdmf as hdmf,
			employee_government_id_numbers.phic as phic,
			employee.employee_code as employee_code
		')
				->join('employees as employee', 'employee_information.employee_id = employee.id', 'left')
				->join('companies as company', 'employee_information.company_id = company.id', 'left')
				->join('branches as branch', 'employee_information.branch_id = branch.id', 'left')
				->join('positions as position', 'employee_information.position_id = position.id', 'left')
				->join('cost_centers as cost_center', 'employee_information.cost_center_id = cost_center.id', 'left')
				->join('departments as department', 'employee_information.department_id = department.id', 'left')
				->join('teams as team', 'employee_information.team_id = team.id', 'left')
				->join('sites as site', 'employee_information.site_id = site.id', 'left')
				->join('employee_government_id_numbers', 'employee_information.govt_numbers_id = employee_government_id_numbers.id', 'left');

		// dump($foo);exit;
		return $this->{$method}($where);
	}

	protected function set_employee_hierarchy_data($where = '')
	{
		$this->db->select('
					employee_information.*,
					employee.first_name,
					employee.middle_name,
					employee.last_name,
					superior.first_name as superior_first_name,
					superior.middle_name as superior_middle_name,
					superior.last_name as superior_last_name,
				')
				->join('employees as employee', 'employee_information.employee_id = employee.id', 'left')
				->join('employees as superior', 'employee_information.reports_to = superior.id', 'left');


		if ($where != '' && isset($where))
		{
			return $this->get_many_by($where);
		}
		
		return $this->get_all();
	}

	public function get_employee_hierarchy_data()
	{
		$post = $this->input->post();

		$employees = $this->set_employee_hierarchy_data();

		$data = array();

		foreach ($employees as $index => $employee)
		{
			$employee_fullname = ucwords(strtolower(
				implode('', array(
					$employee['last_name'].', ',
					$employee['first_name'].' ',
					$employee['middle_name']
				))
			));

			$sub_data['id'] = $employee['employee_id'];
			$sub_data['name'] = $employee_fullname;
			$sub_data['text'] = $employee_fullname;
			$sub_data['parent_id'] = $employee['reports_to'];

			$data[] = $sub_data;
		}

		foreach ($data as $key => &$value)
		{
			$output[$value['id']] = &$value;
		}

		foreach ($data as $key => &$value)
		{
			if ($value['parent_id'] && isset($output[$value['parent_id']]))
			{
				$output[$value['parent_id']]['nodes'][] = &$value;
			}
		}

		foreach ($data as $key => &$value)
		{
			if ($value['parent_id'] && isset($output[$value['parent_id']])){
				unset($data[$key]);
			}
		}

		return $data;
	}

	public function set_system_menu_hierarchy_data()
	{
		$query = $this->db->select('parent.*, s.name as module_name, p.name as function_name')
				 ->from('system_functions as parent')
				 ->join('system_functions as p', 'parent.parent_function_id = p.id', 'left')
				 ->join('system_modules as s', 'parent.system_module_id = s.id', 'left')
				 ->get();

		return $query->result_array();
	}

	public function get_system_menu_hierarchy_data()
	{
		$system_functions = $this->set_system_menu_hierarchy_data();

		$data = array();

		foreach ($system_functions as $index => $system_function)
		{
			$sub_data['id'] = $system_function['id'];
			$sub_data['name'] = $system_function['name'];
			$sub_data['text'] = $system_function['name'];
			$sub_data['parent_id'] = $system_function['parent_function_id'];
			$sub_data['system_module_id'] = $system_function['system_module_id'];

			$data[] = $sub_data;
		}

		foreach ($data as $key => &$value)
		{
			$output[$value['id']] = &$value;
		}

		foreach ($data as $key => &$value)
		{
			if ($value['parent_id'] && isset($output[$value['parent_id']]))
			{
				$output[$value['parent_id']]['nodes'][] = &$value;
			}
		}

		foreach ($data as $key => &$value)
		{
			if ($value['parent_id'] && isset($output[$value['parent_id']])){
				unset($data[$key]);
			}
		}

		return $data;
	}

	public function get_employee_details($method, $where)
	{
		$this->db->select('
			employee_information.*,
			employees.id as employee_id,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
			employees.last_name as last_name,
			employees.employee_code as employee_code,
			employee_information.site_id as site_id,
			employee_information.company_id as company_id
		')
		->join('employees', 'employees.id = employee_information.employee_id', 'left');
		return $this->{$method}($where);
	}
}

// End of file Employee_information_model.php
// Location: ./applicaiton/model/Employee_information_model.php
