<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_employee_benefit_model extends MY_Model
{
	protected $_table = 'payroll_employee_benefits';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	protected $before_create = array('prep_data_before_create');

	protected function prep_data_before_create($payroll_benefit)
	{
		$payroll_benefit['created']    = date('Y-m-d H:i:s');
		$payroll_benefit['created_by'] = $this->ion_auth->user()->row()->id;
		$payroll_benefit['status'] 	   = 1;

		return $payroll_benefit;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					tax_tables.id as tax_rate_id,
					tax_tables.tax_matrix_id as tr_tax_matrix_id,
					tax_tables.tax_exemption_status_id as tr_tax_exemption_status_id,
					tax_tables.base_tax as tr_base_tax,
					tax_tables.percentage_over as tr_percentage_over,
					tax_tables.minimum_monthly_salary as tr_minimum_monthly_salary,
					tax_tables.maximum_monthly_salary as tr_maximum_monthly_salary,
					tax_tables.active_status,
					tax_matrix.id as tax_matrix_id,
					tax_matrix.year_effective as tm_year_effective,
					tax_matrix.description as tm_description,
					tax_matrix.attachment as tm_attachment,
					tax_matrix.active_status as tm_active_status,
					tax_exemption_status.id as tax_exemption_status_id,
					tax_exemption_status.tax_status as te_tax_status,
					tax_exemption_status.tax_code as te_tax_code,
					tax_exemption_status.default_status as te_default_status
				')
			->join('tax_matrices as tax_matrix', 'tax_tables.tax_matrix_id = tax_matrix.id', 'left')
			->join('tax_exemption_status', 'tax_tables.tax_exemption_status_id = tax_exemption_status.id', 'left')
			->order_by('tax_exemption_status.id', 'asc');

		return $this->{$method}($where);
	}

	public function get_with_detail($method, $param)
	{
		$this->db->select('
				benefit.name as benefit_name,
				benefit.taxable_status,
				benefit.active_status,
				payroll_employee_benefits.amount,
				payroll_employee_benefits.employee_id
			')
			->join('employee_benefits as emp_benefit', 'emp_benefit.id = payroll_employee_benefits.employee_benefit_id', 'left')
			->join('benefits as benefit', 'benefit.id = emp_benefit.benefit_id', 'left');
		return $this->{$method}($param);
	}

	public function get_payroll_benefits($method, $param)
	{
		$this->db->select('
			payroll_employee_benefits.*,
			payroll_employees.id as payroll_employee_id,
			benefits.name as benefit,
			CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
			employees.employee_code as employee_code,
			payroll_employee_benefits.amount as benefit_amount
		')
				->join('payroll_employees', 'payroll_employees.id = payroll_employee_benefits.payroll_employee_id', 'left')
				->join('employee_benefits', 'employee_benefits.id = payroll_employee_benefits.employee_benefit_id', 'left')
				->join('employees', 'employees.id = payroll_employees.employee_id', 'left')
				->join('benefits', 'benefits.id = employee_benefits.benefit_id', 'left');
		return $this->{$method}($param);
	}
}

// End of file Payroll_employee_benefit_model.php
// Location: ./applicaiton/model/Payroll_employee_benefit_model.php
