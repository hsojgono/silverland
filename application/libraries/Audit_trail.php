<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_trail
{
	protected $_ci;
	protected $_table = 'system_audit_trails';
	protected $data_model;

	function __construct()
	{
		$this->_ci =& get_instance();
		$this->data_model = $this->_ci->load->model([
			'system_audit_trail_model',
			'system_permission_model'
		]);
	}

	public function write_log($action_mode, $permission_key = '', $additional_fields = array())
	{
		$user = $this->_ci->ion_auth->user()->row();
		$permission_data = $this->_ci->system_permission_model->get_by(['method' => $permission_key]);

		$data = [
			'system_user_id' 		=> $user->id,
			'system_permission_id'	=> $permission_data['id'],
			'system_module_id'		=> $permission_data['system_module_id'],
			'system_function_id'	=> $permission_data['system_function_id'],
			'action_mode' 	 		=> $action_mode,
			'timestamp'		 		=> date('Y-m-d H:i:s'),
			'ip_address'	 		=> $this->_ci->input->ip_address()
		];

		$new_data = array_merge(filter_data($this->_table, $additional_fields), $data);
		$this->_ci->system_audit_trail_model->insert($new_data);
		dump($this->_ci->db->last_query());
	}
}
