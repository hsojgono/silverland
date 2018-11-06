<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_educational_attainment_model extends MY_Model
{
	protected $_table = 'employee_educational_attainments';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	  /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($educational_attainment)
    {
        $educational_attainment['created']       = date('Y-m-d H:i:s');
        $educational_attainment['created_by']    = $this->ion_auth->user()->row()->id;
        $educational_attainment['active_status'] = 1;
        return $educational_attainment;
    }

    protected function set_default_data($educational_attainment)
    {
        if ( ! isset($educational_attainment)) {
            return FALSE;
        }

        $middle_name = ( ! empty($educational_attainment['middle_name'])) ? $educational_attainment['middle_name'] : '';
        $full_name   = $educational_attainment['last_name'].', '.$educational_attainment['first_name'].' '.$middle_name;
        $educational_attainment['full_name'] = strtoupper($full_name);
        return $educational_attainment;
    }

    public function get_details($method, $where)
    {
		$this->db->select('
			employee_educational_attainments.*,
			education_courses.description as ec_desc,
            educational_attainments.name as ea_name,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name
            
        ')
        ->join('employees', 'employee_educational_attainments.employee_id = employees.id', 'left')
		->join('education_courses', 'employee_educational_attainments.course_id = education_courses.id', 'left')
        ->join('educational_attainments', 'employee_educational_attainments.educational_attainment_id = educational_attainments.id', 'left')
        ->order_by('educational_attainments.id', 'desc');
        return $this->{$method}($where);
    }
}

// End of file Employee_educational_attainment_model.php
// Location: ./applicaiton/model/Employee_educational_attainment_model.php
