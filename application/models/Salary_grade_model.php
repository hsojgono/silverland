<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Salary_grade_model extends MY_Model
{
	protected $_table = 'salary_grades';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get     = ['prepare_data'];
    protected $before_create = ['set_data'];
    protected $before_update = ['set_data_before_update'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($salary_grade)
	{
		if ( ! isset($salary_grade)) return FALSE;
		
		$salary_grade['status_url']    = ($salary_grade['active_status'] == 1) ? 'deactivate' : 'activate';
		$salary_grade['status_icon']   = ($salary_grade['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$salary_grade['status_label']  = ($salary_grade['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$salary_grade['status_action'] = ($salary_grade['active_status'] == 1) ? 'Deactivate' : 'Activate';
		return $salary_grade;
	}

	protected function set_data($salary_grade)
	{
		$salary_grade['created'] 		 = date('Y-m-d H:i:s');
		$salary_grade['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$salary_grade['active_status'] = 1;

		return $salary_grade;
    }

    protected function set_data_before_update($salary_grade)
    {
        $salary_grade['modified']    = date('Y-m-d H:i:s');
        $salary_grade['modified_by'] = $this->ion_auth->user()->row()->id;
        return $salary_grade;
    }    
    
    public function get_details($method, $where)
    {
        $this->db->select('
            salary_grades.*,
            companies.name as company_name
        ')
        ->join('companies', 'companies.id = salary_grades.company_id', 'left')
        ->order_by('created', 'asc');
        return $this->{$method}($where);
    }
}

// End of file Salary__grade_model.php
// Location: ./application/models/Salary__grade_model.php