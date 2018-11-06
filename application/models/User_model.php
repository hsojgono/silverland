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
class User_model extends MY_Model {

	protected $_table = 'system_users';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('remove_sensitive_data', 'concat_name_fields');

	protected function concat_name_fields($user)
	{
		$user_fullname = array(
			$user['last_name'] . ', ',
			$user['first_name']
		);

		$user['full_name'] = ucwords(implode('', $user_fullname));
		
		return $user;
	}

	protected function remove_sensitive_data($user)
	{
		$sensitive_fields = [
			'password',
			'ip_address',
			'salt',
			'activation_code',
			'forgotten_password_code',
			'forgotten_password_time',
			'remember_code',
			'created_on',
			'last_login',
		];

		foreach ($sensitive_fields as $field_key => $field_name)
		{
			unset($user[$field_name]);
		}

		return $user;
	}

	public function get_user_default_role($user_id)
	{
		$this->db->select('user_role.*, role.name as role_name');
		$this->db->from('system_users_groups as user_role');
		$this->db->join('system_groups as role', 'user_role.system_group_id = role.id', 'left');
		$this->db->where([
			'user_role.system_user_id' => $user_id,
			'user_role.default_status' => 1
		]);
		$query = $this->db->get();

		return $query->result_array();
	}

}
