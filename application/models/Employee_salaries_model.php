<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_salaries_model extends MY_Model
{
	protected $_table = 'employee_salaries';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $before_create = array('set_data');
	protected $after_get = array('prep_details');
	

	protected function set_data($employee_salary)
	{
		$employee_salary['created'] 	  = date('Y-m-d H:i:s');
		$employee_salary['created_by'] 	  = $this->ion_auth->user()->row()->id;
		$employee_salary['active_status'] = 1;
		
		return $employee_salary;
	}

	protected function prep_details($employee_salary)
	{
		if ( ! isset($employee_salary)) return FALSE;
		
		// get middle initial base on middle name
		$middle_initial = (strlen($employee_salary['middle_name']) > 1) ? substr($employee_salary['middle_name'], 0, 1) : $employee_salary['middle_name'];

		$full_name = array(
			$employee_salary['last_name'].', ',
			$employee_salary['first_name'].' ',
			$middle_initial
		);

		// concat employee first name, middle name, last name
		$employee_salary['full_name'] = strtoupper(implode('', $full_name));

		// check if active or inactive then set labels
		$employee_salary['status_label'] = ($employee_salary['active_status'] == 1) ? 'ACTIVE':'INACTIVE';

		return $employee_salary;
	}

	public function get_details($method, $where)
    {
		$this->db->select('
			
                employee_salaries.id as employee_salaries_id,
                employee_salaries.employee_id,
                employee_salaries.company_id as employee_company_id,
                employee_salaries.salary_matrix_id as employee_salary_matrix_id,
                employee_salaries.salary_grade_id as employee_salary_grade_id,
                employee_salaries.monthly_salary as employee_monthly_salary,
                employee_salaries.active_status,
                salary_matrix.effectivity_date as salary_matrix_effectivity_date,
                salary_grade.grade_code as salary_grade_code,
                employee.first_name,
                employee.middle_name,
				employee.last_name,
				employee_salaries.daily_rate as daily_rate,
				
            ')
            ->join('employees as employee', 'employee_salaries.employee_id = employee.id', 'left')
            ->join('companies as company', 'employee_salaries.company_id = company.id', 'left')
            ->join('salary_matrices as salary_matrix', 'employee_salaries.salary_matrix_id = salary_matrix.id', 'left')
            ->join('salary_grades as salary_grade', 'employee_salaries.salary_grade_id = salary_grade.id', 'left');

        return $this->{$method}($where);
    }

	// public function deactivate_previous_salary($current_salary_id)
	// {
	// 	return $this->update($current_salary_id, ['active_status' => 0]);
	// }

	public function edit($post_data)
	{
		$data = remove_unknown_field($post_data, $this->form_validation->get_field_names('edit_employee_salary'));
		return $this->update($post_data['employee_salary_id'], $post_data['monthly_salary']);
	}

	public function set($post_data)
	{
		$data = remove_unknown_field($post_data, $this->form_validation->get_field_names('set_employee_salary'));
		return $this->insert($post_data);
	}
}

// End of file Employee_salaries_model.php
// Location: ./application/models/Employee_salaries_model.php