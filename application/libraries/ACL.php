<?php

/**
 *
 */
class Acl {

    /**
     * Store CI instances
     */
    protected $ci;

    /**
     * Store current user_id
     */
    protected $user_id;

    /**
     * Store current user role_id
     */
    protected $user_role_id;

    /**
     * Store class acl_model
     */
    protected $acl_model;

    /**
     * Store class acl_model
     */
    protected $role_permission_model;

    /**
     * Store user permissions
     */
    protected $user_permissions = array();

    /**
     * Class construtor
     */
	function __construct()
	{
		$this->ci = & get_instance();

		$this->ci->load->library('ion_auth');

		$this->ci->load->model([
			'acl_model',
			'role_permission_model'
		]);

		// $user = $this->ci->ion_auth->user()->row();
		// $user_roles = $this->ci->ion_auth->get_users_groups($this->user_id)->result();
		// $this->user_id = $user->id;
		// $this->user_role_id = $user_roles[0]->id; // Index 0 for default user_role_id
		$this->acl_model = $this->ci->acl_model;
		$this->role_permission_model = $this->ci->role_permission_model;
	}

	public function get_role_navigation_menu($role_id)
	{
		$modules = $this->acl_model->get_role_permission_modules([
			'role_permission.role_id'		 => $role_id,
			'role_permission.active_status'  => 1,
			'role_permission.system_module_id !=' => 0,
			'role_permission.system_function_id !=' => 0
		]);

		$navigation_menu = array();

		foreach ($modules as $module)
		{
			$key = strtolower($module->s_module_name);

			$modules_functions = $this->acl_model->get_role_permission_functions([
				's_function.system_module_id' 	=> $module->s_module_id,
				's_function.function_level' 	=> 0,
				'role_permission.role_id' 		=> $role_id,
				'role_permission.active_status' => 1
			]);

			// dump($this->ci->db->last_query());

			$navigation_menu[$key] = [
				'module_id' 		=> $module->s_module_id,
				'module_name' 		=> $module->s_module_name,
				'module_icon' 		=> $module->s_module_icon,
				'module_status' 	=> $module->s_module_status,
				'module_functions'  => $modules_functions,
			];
		}
		// exit;
		return $navigation_menu;
	}

	public function get_system_role_permission()
	{
		$modules = $this->acl_model->get_role_permission_modules([
			'role_permission.active_status' => 1
		]);

		$navigation_menu = array();

		foreach ($modules as $module)
		{
			$key = strtolower($module->s_module_name);

			$modules_functions = $this->acl_model->get_system_functions([
				'role_permission.active_status' => 1,
				's_function.system_module_id' 	=> $module->s_module_id
			]);

			$navigation_menu[$key] = [
				'module_id' 	   => $module->s_module_id,
				'module_name' 	   => $module->s_module_name,
				'module_functions' => $modules_functions,
			];

			foreach ($modules_functions as $fid => $component)
			{
				$role_permissions = $this->role_permission_model->get_many_role_permission_by([
					'system_role_permissions.system_function_id' => $component->system_function_id
				]);

				$permission_test = [];

				foreach ($role_permissions as $role_permission)
				{
					$permission_test['roles'] = $role_permission;
				}
			}
		}

		return $navigation_menu;
	}

	public function get_user_permissions()
	{

	}

}

/* End of file Acl.php */
/* Location: ./application/library/Acl.php */
