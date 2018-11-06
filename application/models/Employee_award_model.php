<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_award_model extends MY_Model
{
	protected $_table = 'employee_awards';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee_award)
    {
        $employee_award['created'] = date('Y-m-d H:i:s');
        $employee_award['active_status'] = 1;
        $employee_award['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_award;
    }	
    protected function set_default_data($employee_award)
    {
        if ( ! isset($employee_award)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee_award['middle_name'])) ? $employee_award['middle_name'] : '';
        // $full_name                = $employee_award['last_name'].', '.$employee_award['first_name'].' '.$middle_name;
        // $employee_award['full_name']    = strtoupper($full_name);
        // $employee_award['status_label'] = ($employee_award['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee_award;
    }
	public function get_details($method, $where)
	{
		$this->db->select('
					employee_awards.id as employee_award_id,
					employee_awards.employee_id as employee_id,				
					employee_awards.award as award_title,				
					employee_awards.comment as award_comment,
					employee_awards.date as award_date,
					employee.last_name as employee_last_name,
					companies.name as company_name,
					companies.id as company_id,
					employee.id as employee_id


				')
				->join('employees as employee', 'employee_awards.employee_id = employee.id', 'left')
				->join('companies', 'employee_awards.company_id = companies.id', 'left');

				// ->order_by('employee_awards.type', 'asc');

		return $this->{$method}($where);
	}
}

// End of file Employee_award_model.php
// Location: ./applicaiton/model/Employee_award_model.php
