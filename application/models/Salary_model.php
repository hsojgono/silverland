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
class salary_model extends MY_Model
{
	protected $_table = 'salaries';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($salary)
	{
		if ( ! isset($salary)) return FALSE;
		
		$salary['status_label']  = ($salary['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$salary['status_action'] = ($salary['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$salary['status_icon'] 	 = ($salary['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$salary['status_url'] 	 = ($salary['active_status'] == 1) ? 'deactivate' : 'activate';
		return $salary;
	}

	protected function set_data($salary)
	{
		$salary['created'] 		 = date('Y-m-d H:i:s');
		$salary['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$salary['active_status'] = 1;

		return $salary;
    }
    
    public function get_details($method, $where)
    {
        $this->db->select('
            salaries.*,
            salary_matrices.description as salary_matrix_desc
        ')
        ->join('salary_matrices', 'salary_matrices.id = salaries.salary_matrix_id', 'left')
        ->order_by('monthly_salary', 'asc');
        return $this->{$method}($where);
    }
}

// End of file salary_model.php
// Location: ./application/models/salary_model.php