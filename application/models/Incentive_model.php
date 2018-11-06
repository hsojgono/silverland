<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Incentive_model extends MY_Model
{
	protected $_table      = 'incentives';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get     = ['prepare_data'];
    protected $before_create = ['set_data'];
    protected $before_update = ['set_data_before_update'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($incentive)
	{
		if ( ! isset($incentive)) return FALSE;
		
		$incentive['status_url']    = ($incentive['active_status'] == 1) ? 'deactivate' : 'activate';
		$incentive['status_icon']   = ($incentive['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$incentive['status_label']  = ($incentive['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$incentive['status_action'] = ($incentive['active_status'] == 1) ? 'Deactivate' : 'Activate';
		return $incentive;
	}

	protected function set_data($incentive)
	{
		$incentive['created'] 	    = date('Y-m-d H:i:s');
		$incentive['created_by']    = $this->ion_auth->user()->row()->id;
		$incentive['active_status'] = 0;
		return $incentive;
    }

    protected function set_data_before_update($incentive)
    {
        $incentive['modified']    = date('Y-m-d H:i:s');
        $incentive['modified_by'] = $this->ion_auth->user()->row()->id;
        return $incentive;
    }  

	public function get_details($method, $where)
	{
		$this->db->select('*');

		return $this->{$method}($where);
	}
}

// End of file Incentive_model.php
// Location: ./applicaiton/model/Incentive_model.php
