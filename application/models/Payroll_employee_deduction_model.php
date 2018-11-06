<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_employee_deduction_model extends MY_Model
{
	protected $_table = 'payroll_employee_deductions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $before_create = array('prep_data_before_create');

	protected function prep_data_before_create($payroll_deduction)
	{
		$payroll_deduction['created'] = date('Y-m-d H:i:s');
		$payroll_deduction['created_by'] = $this->ion_auth->user()->row()->id;
		$payroll_deduction['status'] = 1;
		
		return $payroll_deduction;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
			payroll_employee_deductions.*,
			employee_deductions.amount as amount_deduction,
			deductions.name as deduction_name,
			loan_types.name as loan_name,
			CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
			employees.employee_code as employee_code,
		')
			->join('payroll_employees', 'payroll_employees.id = payroll_employee_deductions.payroll_employee_id', 'left')
			->join('employee_deductions', 'payroll_employee_deductions.employee_deduction_id = employee_deductions.id', 'left')
			->join('deductions', 'employee_deductions.deduction_id=deductions.id', 'left')
			->join('employees', 'employee_deductions.employee_id=employees.id', 'left')
			->join('employee_loans', 'employee_deductions.employee_loan_id = employee_loans.id', 'left')
			->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left');
		return $this->{$method}($where);
	}
}

// End of file Payroll_employee_deduction_model.php
// Location: ./applicaiton/model/Payroll_employee_deduction_model.php
