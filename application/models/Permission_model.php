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
class Permission_model extends MY_Model {

	protected $_table = 'system_permissions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/**
	 * Callbacks or Observers
	 */
	protected $before_create = ['generate_date_created_status'];

	protected function generate_date_created_status($permission)
	{
		$permission['created'] = date('Y-m-d H:i:s');
		$permission['active_status'] = 1;
		$permission['created_by'] = 1;
		return $permission;
	}

	public function get_permission_by($param)
	{
		$query = $this->db;
		$query->select('
			system_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name
		');
		$query->join('system_modules', 'system_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_permissions.system_function_id = system_functions.id', 'left');

		return $this->get_by($param);
	}

	public function get_many_permission_by($param)
	{
		$query = $this->db;
		$query->select('
			system_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name
		');
		$query->join('system_modules', 'system_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_permissions.system_function_id = system_functions.id', 'left');

		return $this->get_many_by($param);
	}

	public function get_permission_all()
	{
		$query = $this->db;
		$query->select('
			system_permissions.*,
			system_modules.name as system_module_name,
			system_functions.name as system_function_name
		');
		$query->join('system_modules', 'system_permissions.system_module_id = system_modules.id', 'left');
		$query->join('system_functions', 'system_permissions.system_function_id = system_functions.id', 'left');

		return $this->get_all();
	}
}
