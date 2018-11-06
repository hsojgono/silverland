<?php defined('BASEPATH') OR exit('No direct script access allowed');

class System_config_model extends MY_Model
{
	protected $_table = 'system_config';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($system_config)
	{
		if ( ! isset($system_config)) return FALSE;
		
		$system_config['status_label']  = ($system_config['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$system_config['status_action'] = ($system_config['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$system_config['status_icon'] 	= ($system_config['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$system_config['status_url'] 	= ($system_config['active_status'] == 1) ? 'deactivate' : 'activate';
		return $system_config;
	}

	protected function set_data($system_config)
	{
		$system_config['created'] 		= date('Y-m-d H:i:s');
		$system_config['created_by'] 	= $this->ion_auth->user()->row()->id;
		$system_config['active_status'] = 1;
		return $system_config;
	}
	
	public function get_details($method, $where)
	{
		$this->db->select('*');
		return $this->{$method}($where);
	}
}

// End of file System_config_model.php
// Location: ./applicaiton/model/System_config_model.php 