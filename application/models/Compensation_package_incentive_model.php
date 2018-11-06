<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compensation_package_incentive_model extends MY_Model
{
	protected $_table      = 'compensation_package_incentives';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get     = ['prepare_data'];
    protected $before_create = ['set_data'];
    protected $before_update = ['set_data_before_update'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($compensation_package_incentive)
	{
		if ( ! isset($compensation_package_incentive)) return FALSE;
		
		$compensation_package_incentive['status_url']    = ($compensation_package_incentive['active_status'] == 1) ? 'deactivate' : 'activate';
		$compensation_package_incentive['status_icon']   = ($compensation_package_incentive['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$compensation_package_incentive['status_label']  = ($compensation_package_incentive['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$compensation_package_incentive['status_action'] = ($compensation_package_incentive['active_status'] == 1) ? 'Deactivate' : 'Activate';
		return $compensation_package_incentive;
	}

	protected function set_data($compensation_package_incentive)
	{
		$compensation_package_incentive['created'] 	     = date('Y-m-d H:i:s');
		$compensation_package_incentive['created_by']    = $this->ion_auth->user()->row()->id;
		$compensation_package_incentive['active_status'] = 1;
		return $compensation_package_incentive;
    }

    protected function set_data_before_update($compensation_package_incentive)
    {
        $compensation_package_incentive['modified']    = date('Y-m-d H:i:s');
        $compensation_package_incentive['modified_by'] = $this->ion_auth->user()->row()->id;
        return $compensation_package_incentive;
    }  

	public function get_details($method, $where)
	{
		$this->db->select('
			compensation_package_incentives.*,
			incentives.amount as incentive_amount,
			incentive_types.name as incentive_name
		')
		->join('incentives', 'incentives.id = compensation_package_incentives.incentive_id', 'left')
		->join('incentive_types', 'incentive_types.id = incentives.incentive_type_id', 'left');
		return $this->{$method}($where);
	}
}

// End of file Compensation_package_incentive_model.php
// Location: ./applicaiton/model/Compensation_package_incentive_model.php
