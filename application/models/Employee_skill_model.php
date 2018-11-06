<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_skill_model extends MY_Model
{
	protected $_table = 'employee_skills';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee_skill)
    {
        $employee_skill['created'] = date('Y-m-d H:i:s');
        $employee_skill['active_status'] = 1;
        $employee_skill['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_skill;
    }	
    protected function set_default_data($employee_skill)
    {
        if ( ! isset($employee_skill)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee_skill['middle_name'])) ? $employee_skill['middle_name'] : '';
        // $full_name                = $employee_skill['last_name'].', '.$employee_skill['first_name'].' '.$middle_name;
        // $employee_skill['full_name']    = strtoupper($full_name);
        $employee_skill['status_label'] = ($employee_skill['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee_skill;
    }
	public function get_details($method, $where)
	{
		$this->db->select('
					employee_skills.id as employee_skill_id,
					employee_skills.skill_id as employee_skill_id,
					employee_skills.proficiency_level_id as proficiency_level_id,
					employee_skills.active_status,			
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					companies.name as company_name,
					companies.id as company_id,
					skills.name as skill_name,
					skills.id as skill_id,
					proficiency_levels.proficiency as proficiency_level,
					proficiency_levels.id as proficiency_level_id
				')
				->join('employees as employee', 'employee_skills.employee_id = employee.id', 'left')
				->join('companies', 'employee_skills.company_id = companies.id', 'left')
				->join('skills', 'employee_skills.skill_id = skills.id', 'left')
				->join('proficiency_levels', 'employee_skills.proficiency_level_id = proficiency_levels.id', 'left');

				// ->order_by('employee_skills.type', 'asc');

		return $this->{$method}($where);
	}
}

// End of file Employee_skill_model.php
// Location: ./applicaiton/model/Employee_skill_model.php
