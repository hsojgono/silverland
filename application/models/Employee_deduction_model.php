<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_deduction_model extends MY_Model
{
	protected $_table = 'employee_deductions';
	protected $primary_key = 'id';
    protected $return_type = 'array';

    protected $before_create = array('prep_data_before_create');

	protected function prep_data_before_create($employee_deduction)
	{
		$employee_deduction['created'] = date('Y-m-d H:i:s');
		$employee_deduction['created_by'] = $this->ion_auth->user()->row()->id;
		$employee_deduction['active_status'] = 1;
		
		return $employee_deduction;
	}

	 public function get_details($method, $where)
    {
        $this->db->select(
			'employee_deductions.*,
			 employee_deductions.amount as amount_deduction,
             deductions.name as deduction_name,
             loan_types.name as loan_name
		')
            
            ->join('deductions', 'employee_deductions.deduction_id=deductions.id', 'left')
            ->join('employees', 'employee_deductions.employee_id=employees.id','left')
            ->join('employee_loans', 'employee_deductions.employee_loan_id = employee_loans.id', 'left')
            ->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left');
            return $this->{$method}($where);
    }
    
	public function get_employee_deduction_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_deductions.*,
                    employee_deductions.id AS employee_deduction_id,
                    employee_deductions.amount AS deduction_amount,
                    deductions.name AS deduction_name,

                ')
            ->join('deductions', 'employee_deductions.deduction_id = deductions.id', 'left')
            ->join('employees', 'employees.id = employee_deductions.employee_id', 'left');
        
            // ->order_by('elc_balance', 'desc');

        return $this->get_many_by($where);
    }

}

// End of file Employee_deduction_model.php
// Location: ./applicaiton/model/Employee_deduction_model.php
