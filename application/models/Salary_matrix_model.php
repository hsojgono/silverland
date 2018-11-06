<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Salary_matrix_model extends MY_Model
{
	protected $_table = 'salary_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($salary_matrix)
	{
		if ( ! isset($salary_matrix)) return FALSE;
		
		$salary_matrix['status_label']  = ($salary_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$salary_matrix['status_action'] = ($salary_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$salary_matrix['status_icon'] 	 = ($salary_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$salary_matrix['status_url'] 	 = ($salary_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		return $salary_matrix;
	}

	protected function set_data($salary_matrix)
	{
		$salary_matrix['created'] 		 = date('Y-m-d H:i:s');
		$salary_matrix['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$salary_matrix['active_status'] = 1;

		return $salary_matrix;
    }
    
    public function get_details($method, $where)
    {
        $this->db->select('
            salary_matrices.*,
            companies.name as company_name
        ')
        ->join('companies', 'companies.id = salary_matrices.company_id', 'left');
        return $this->{$method}($where);
    }
}

// End of file salary_matrix_model.php
// Location: ./application/models/salary_matrix_model.php