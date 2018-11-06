<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_violation_model extends MY_Model
{
	protected $_table = 'employee_violations';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee_violation)
    {
        $employee_violation['created'] = date('Y-m-d H:i:s');
        $employee_violation['active_status'] = 1;
        $employee_violation['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_violation;
    }	
    protected function set_default_data($employee_violation)
    {
        if ( ! isset($employee_violation)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee_violation['middle_name'])) ? $employee_violation['middle_name'] : '';
        // $full_name                = $employee_violation['last_name'].', '.$employee_violation['first_name'].' '.$middle_name;
        // $employee_violation['full_name']    = strtoupper($full_name);
        $employee_violation['status_label'] = ($employee_violation['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee_violation;
    }

	public function get_details($method, $where)
    {
        $this->db->select('
                employee_violations.id as employee_violations_id,
                employee_violations.employee_id,
                employee_violations.violation_id as violation_id,
                employee_violations.number_of_offense,
				employee_violations.active_status,
                violation.id as violation_id,
				violation.name as violation_name,


            ')
            ->join('employees as employee', 'employee_violations.employee_id = employee.id', 'left')
            ->join('violations as violation', 'employee_violations.violation_id = violation.id', 'left')
            ->join('violation_types as violation_type', 'violation.violation_type_id = violation_type.id', 'left')
            ->join('violation_levels as violation_level', 'violation.violation_level_id = violation_level.id', 'left');

        return $this->{$method}($where);
	}
	public function get_employee_violations_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_violations.*,
                    employee_violations.id AS employee_violations_id,
                    employee_violations.amount AS employee_violations_amount,
					violations.name AS violations_name,
					employees.middle_name,           
                    employees.first_name as first_name,
                    employees.middle_name as middle_name,
                    employees.last_name as last_name,

                ')
            ->join('violations', 'employee_violations.violation_id = violations.id', 'left')
            ->join('employees', 'employees.id = employee_violations.employee_id', 'left');
        
            // ->order_by('elc_balance', 'desc');

        return $this->get_many_by($where);
    }
}
