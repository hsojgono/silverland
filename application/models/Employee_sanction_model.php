<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_sanction_model extends MY_Model
{
	protected $_table = 'employee_sanctions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee_sanction)
    {
        $employee_sanction['created'] = date('Y-m-d H:i:s');
        $employee_sanction['active_status'] = 1;
        $employee_sanction['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_sanction;
    }	
    protected function set_default_data($employee_sanction)
    {
        if ( ! isset($employee_sanction)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee_sanction['middle_name'])) ? $employee_sanction['middle_name'] : '';
        // $full_name                = $employee_sanction['last_name'].', '.$employee_sanction['first_name'].' '.$middle_name;
        // $employee_sanction['full_name']    = strtoupper($full_name);
        $employee_sanction['status_label'] = ($employee_sanction['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee_sanction;
    }

	public function get_details($method, $where)
    {
        $this->db->select('
                employee_sanctions.id as employee_sanctions_id,
                employee_sanctions.employee_id,
                employee_sanctions.sanction_id as sanction_id,
				employee_sanctions.active_status,
                sanction.id as sanction_id,
				sanction.name as sanction_name,


            ')
            ->join('employees as employee', 'employee_sanctions.employee_id = employee.id', 'left')
            ->join('sanctions as sanction', 'employee_sanctions.sanction_id = sanction.id', 'left');

        return $this->{$method}($where);
	}
	public function get_employee_sanctions_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_sanctions.*,
                    employee_sanctions.id AS employee_sanctions_id,
					sanctions.name AS sanctions_name,
					employees.middle_name,           
                    employees.first_name as first_name,
                    employees.middle_name as middle_name,
                    employees.last_name as last_name,

                ')
            ->join('sanctions', 'employee_sanctions.sanction_id = sanctions.id', 'left')
            ->join('employees', 'employees.id = employee_sanctions.employee_id', 'left');
        
            // ->order_by('elc_balance', 'desc');

        return $this->get_many_by($where);
    }
}
