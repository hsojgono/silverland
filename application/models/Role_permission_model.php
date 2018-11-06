<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.kevin@systemantech.com
 * @link        http://systemantech.com
 */
class Role_permission_model extends MY_Model {

	protected $_table = 'system_role_permissions';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	protected $after_get = ['set_data'];

	protected function set_data($role_permission)
	{
		$role_permission['status'] = ($role_permission['active_status'] == 1) ? 'De-activate':'Activate'; 
		return $role_permission;
	}

	public function get_many_role_permission_by($param)
	{
		$query = $this->db;
		$query->select('
			system_role_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name,
			system_permissions.name as system_permission_name
		');
		$query->join('system_modules', 'system_role_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_role_permissions.system_function_id = system_functions.id', 'left');
		$query->join('system_permissions', 'system_role_permissions.system_permission_id = system_permissions.id', 'left');

		return $this->get_many_by($param);
	}

	public function get_all_by($param)
	{
		$query = $this->db;
		$query->select('
			system_role_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name,
			system_permissions.name as system_permission_name
		');
		$query->join('system_modules', 'system_role_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_role_permissions.system_function_id = system_functions.id', 'left');
		$query->join('system_permissions', 'system_role_permissions.system_permission_id = system_permissions.id', 'left');

		return $this->get_many_by($param);
	}

	public function get_role_perm_by($param)
	{
		$query = $this->db;
		$query->select('
			system_role_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name,
			system_permissions.name as system_permission_name
		');
		$query->join('system_modules', 'system_role_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_role_permissions.system_function_id = system_functions.id', 'left');
		$query->join('system_permissions', 'system_role_permissions.system_permission_id = system_permissions.id', 'left');

		return $this->get_by($param);
	}
}
