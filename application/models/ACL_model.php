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
class Acl_model extends CI_Model {

    /**
     * Class constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get role permission modules
     */
    public function get_role_permission_modules($where = '')
    {
		if ( ! empty($where))
		{
			$this->db->where($where);
		}
		$query = $this->db->select('
			role_permission.*,
			s_module.id as s_module_id,
			s_module.name as s_module_name,
			s_module.icon as s_module_icon,
			s_module.status as s_module_status,
		')
		->from('system_role_permissions as role_permission')
		->join('system_modules as s_module', 'role_permission.system_module_id = s_module.id', 'left')
		->group_by('s_module.id')
		->order_by('s_module.id', 'asc')
		->get();

		return $query->result();
    }

    /**
     * Get role permission modules
     */
    public function get_role_permission_functions($where = '')
    {
		if ( ! empty($where))
		{
			$this->db->where($where);
		}

		$query = $this->db->select('
			role_permission.*,
			s_function.id as s_function_id,
			s_function.system_module_id as s_function_module_id,
			s_function.name as s_function_name,
			s_function.icon as s_function_icon,
			s_function.link as s_function_link,
		')

		->from('system_role_permissions as role_permission')
		->join('system_functions as s_function', 'role_permission.system_function_id = s_function.id', 'left')
		->group_by('s_function.id')
		->order_by('s_function.id', 'asc')
		->get();

		return $query->result();
    }

    public function get_system_functions($where = '')
    {
		if ( ! empty($where))
		{
			$this->db->where($where);
		}

		$query = $this->db->select('
			s_function.id as s_function_id,
			s_function.system_module_id as smid,
			s_function.name as s_function_name,
			s_function.icon as s_function_icon,
			s_function.link as s_function_link,
		')

		->from('system_functions as s_function')
		->group_by('s_function.id')
		->order_by('s_function.id', 'asc')
		->get();

		return $query->result();
    }

	public function get_system_modules($where = '')
	{
		if ( ! empty($where))
		{
			$this->db->where($where);
		}

		$query = $this->db->select('*')->from('system_modules')->group_by('id')->order_by('id', 'asc')->get();

		return $query->result();
	}

	public function get_system_functions2($where = '')
	{
		if ( ! empty($where))
		{
			$this->db->where($where);
		}

		$query = $this->db->select('*')->from('system_functions')->group_by('id')->order_by('id', 'asc')->get();

		return $query->result();
	}

	public function get_system_permissions($where = '')
	{
		if ( ! empty($where))
		{
			$this->db->where($where);
		}

		$query = $this->db->select('*')->from('system_permissions')->group_by('id')->order_by('id', 'asc')->get();

		return $query->result();
	}

}

/* End of file ACL_model.php */
/* Location: ./application/models/ACL_model.php */
