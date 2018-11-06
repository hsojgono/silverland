<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Benefit_matrix_model extends MY_Model
{
	protected $_table = 'benefit_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected $after_create = ['write_audit_trail'];
    protected $after_update = ['write_audit_trail'];

    protected function generate_date_created_status($benefit_matrix)
    {
        $benefit_matrix['created'] = date('Y-m-d H:i:s');
        $benefit_matrix['active_status'] = 1;
        $benefit_matrix['created_by'] = $this->ion_auth->user()->row()->employee_id;
        return $benefit_matrix;
    }

    protected function set_default_data($benefit_matrix)
    {
        $benefit_matrix['status_label']  = ($benefit_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$benefit_matrix['status_action'] = ($benefit_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$benefit_matrix['status_icon'] = ($benefit_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $benefit_matrix['status_url']  = ($benefit_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
        return $benefit_matrix; 
    }

	public function get_details($method, $where)
	{
		$this->db->select('*');
		return $this->{$method}($where);
	}
}

// End of file Benefit_matrix_model.php
// Location: ./applicaiton/model/Benefit_matrix_model.php
