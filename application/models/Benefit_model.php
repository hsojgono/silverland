<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Benefit_model extends MY_Model
{
	protected $_table = 'benefits';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	 /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $before_update = ['set_data_before_update'];

    protected $after_create = ['write_audit_trail'];
    protected $after_update = ['write_audit_trail'];

    protected function generate_date_created_status($benefit)
    {
		$user = $this->ion_auth->user()->row();

        $benefit['created'] = date('Y-m-d H:i:s');
        $benefit['active_status'] = 1;
		$benefit['created_by'] = $user->employee_id;
		$benefit['company_id'] = $user->company_id;
        return $benefit;
	}
	
	protected function set_data_before_update($benefit)
    {
        $benefit['modified']    = date('Y-m-d H:i:s');
        $benefit['modified_by'] = $this->ion_auth->user()->row()->id;
        return $benefit;
    }    

    protected function set_default_data($benefit)
    {
        $benefit['status_label']  = ($benefit['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $benefit['status_action'] = ($benefit['active_status'] == 1) ? 'Deactivate' : 'Activate';
        $benefit['status_icon'] = ($benefit['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $benefit['status_url']  = ($benefit['active_status'] == 1) ? 'deactivate' : 'activate';
        return $benefit; 
    }

	public function get_details($method, $where)
	{
		$this->db->select('
			benefits.*,
			companies.name as company_name,
			benefit_matrices.effectivity_date as effectivity_date
		')
		->join('companies', 'companies.id = benefits.company_id', 'left')
		->join('benefit_matrices', 'benefit_matrices.id = benefits.benefit_matrix_id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Benefit_model.php
// Location: ./applicaiton/model/Benefit_model.php
