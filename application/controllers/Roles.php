<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Roles extends MY_Controller {

	private $active_menu = 'System';
	/**
	 * Some description here
	 *
	 * @param   param
	 * @return  return
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'role_model',
			'permission_model',
			'role_permission_model'
		]);
	}

	// list all roles
	public function index()
	{
		$this->data = array(
			'page_header' => 'Role Management',
			'active_menu' => $this->active_menu,
		);
		$this->data['roles'] = $this->role_model->get_all();

		$this->load_view('pages/role-list');
	}

	// add new role
	public function add()
	{
		// if ( ! $this->ion_auth_acl->has_permission('add_role'))
		// {
		// 	$this->session->set_flashdata('failed', 'Sorry you have no permission to access this function.');
		// 	redirect('/', 'refresh');
		// }

		$this->data = array(
			'page_header' => 'Role Management',
			'active_menu' => $this->active_menu,
		);

		$this->data['role_permissions_data'] = $this->_set_role_permissions_data();

		$data = $this->input->post();
		$role_permissions = $this->acl_model->get_system_permissions();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$additional_data = [
				'active_status' => 0,
				'created_by' 	=> 1, // TODO: make this dynamic. get the id of current user logged in
				'created'		=> date('Y-m-d H:i:s')
			];
			$new_group_id = $this->ion_auth->create_group($data['group_name'], $data['description'], $additional_data);

			if($new_group_id)
			{
				$new_system_role_permissions = [];

				$counter = 0;
				$total_role_perm = count($role_permissions);

				foreach ($role_permissions as $pkey => $permission)
				{
					$active_status = 0;

					if (isset($data['role_permission'])) {
						$active_status = ( ! array_search($permission->id, $data['role_permission'])) ? 0 : 1;
					}

					$new_system_role_permissions[$pkey] = [
						'role_id' 				=> $new_group_id,
						'system_module_id' 		=> $permission->system_module_id,
						'system_function_id' 	=> $permission->system_function_id,
						'system_permission_id'  => $permission->id,
						'active_status' 		=> $active_status,
						'created'				=> date('Y-m-d H:i:s'),
						'created_by'			=> $this->ion_auth->user()->row()->id
					];

					$counter++;
				}

				$checker = ($counter == $total_role_perm) ? TRUE : FALSE;

				if ($checker) {
					// this will generate system_role_permission IDs stored in array
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$results = $this->role_permission_model->insert_many($new_system_role_permissions);
					redirect('roles');
				}
			}
		}

		$this->load_view('forms/role-add');
	}

	// edit role detail
	public function edit($id)
	{
		dump($id, 'edit/role_id: ');
	}

	// view role detail
	public function details($role_id)
	{
		$this->data['page_header'] 		= 'Role Management';
		$this->data['active_menu']		= 'System';
		$this->data['role_data'] 		= $this->role_model->get_by('id', $role_id);
		$this->data['role_permissions'] = $this->role_permission_model->get_all_by(['system_role_permissions.role_id' => $role_id]);
		$this->data['modules'] 	 		= $this->acl_model->get_system_modules();
		$this->data['functions'] 		= $this->acl_model->get_system_functions2();

		$this->data['users_groups']      = $this->ion_auth->get_users_groups()->result();
		$this->data['users_permissions'] = $this->ion_auth_acl->build_acl();

		// dump($this->data['users_permissions']);
		// exit;
		$this->load_view('pages/role-detail');
	}

	// update role status
	public function update($id)
	{
		dump($id, 'update/role_id: ');
	}

	public function update_status($id)
	{
		$role_data = $this->role_model->get_by(['id' => $id]);
		$data['role_data'] = $role_data;

		$post = $this->input->post();

		if (isset($post['mode']))
		{
			$result = FALSE;

			if ($post['mode'] == 'De-activate')
			{
				dump('De-activating...');
				$result = $this->role_model->update($id, ['active_status' => 0]);
				dump($this->db->last_query());
			}
			if ($post['mode'] == 'Activate')
			{
				dump('Activating...');
				$result = $this->role_model->update($id, ['active_status' => 1]);
				dump($this->db->last_query());
			}


			if ($result)
			{
				$this->session->set_flashdata('message', 'Successfully '.$post['mode'].' role permission status.');
				redirect('roles');
			}
			else
			{
				$this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' role permission status.');
				redirect('roles');
			}

		}
		else
		{
			$this->load->view('modals/modal-update-role-status', $data);
		}
	}



	/**
	 * private functions
	 */
	// set role permissions data
	private function _set_role_permissions_data()
	{
		$this->data['system_modules'] = $this->acl_model->get_system_modules(['status' => 1]);

		$role_permissions_data = [];
		foreach ($this->data['system_modules'] as $mkey => $module) {

			$this->data['system_functions'] = $this->acl_model->get_system_functions2(['system_module_id' => $module->id]);

			$new_function_data = [];
			foreach ($this->data['system_functions'] as $fkey => $function) {

				$this->data['system_permissions'] = $this->acl_model->get_system_permissions(['system_function_id' => $function->id]);

				$new_function_data[$fkey] = [
					'function_id' => $function->id,
					'function_name' => $function->name,
					'permissions' => $this->data['system_permissions']
				];
			}

			$role_permissions_data[$mkey] = [
				'module_id'   => $module->id,
				'module_name' => $module->name,
				'module_functions' => $new_function_data
			];
		}

		return $role_permissions_data;
	}
}
