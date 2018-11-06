<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_training_model extends MY_Model
{
	protected $_table = 'employee_trainings';
	protected $primary_key = 'id';
	protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
   	protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($training)
    {   
        $user                      = $this->ion_auth->user()->row();
        $training['created']       = date('Y-m-d H:i:s');
        $training['created_by']    = $user->employee_id;
        $training['status'] = 1;
        return $training;
    }

    protected function set_default_data($training)
    {
		if ( ! isset($training)) return FALSE;
		$training['job_status'] = ($training['acquired_from'] == 0) ? 'Pre-Employment' : 'Current';   

        return $training;
    }	
	public function get_details($method, $where)
	{
		$this->db->select('
					employee_trainings.id as employee_training_id,
					employee_trainings.employee_id as employee_id,
					employee_trainings.training_id as training_id,					
					employee_trainings.acquired_from,				
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					companies.name as company_name,
					companies.id as company_id,
					trainings.title as training_title,
					trainings.id as training_id,
					employee.id as employee_id


				')
				->join('employees as employee', 'employee_trainings.employee_id = employee.id', 'left')
				->join('companies', 'employee_trainings.company_id = companies.id', 'left')
				->join('trainings', 'employee_trainings.training_id = trainings.id', 'left');

				// ->order_by('employee_trainings.type', 'asc');

		return $this->{$method}($where);
	}
}

// End of file Employee_training_model.php
// Location: ./applicaiton/model/Employee_training_model.php
