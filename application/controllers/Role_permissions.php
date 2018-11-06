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
class Role_permissions extends MY_Controller {

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
			'page_header' => 'Role Permissions Management',
			'active_menu' => $this->active_menu,
		);
		$this->data['role_permissions'] = $this->role_permission_model->get_all();
		$this->load_view('pages/role-permissions-list');
	}

	// add new role
	public function add()
	{
		
	}

	// edit role detail
	public function edit($id)
	{
		dump($id, 'edit/role_id: ');
	}

	// view role detail
	public function details($id)
	{
		dump($id, 'details/role_id: ');
	}

	// update role status
	public function update($id)
	{
		dump($id, 'update/role_id: ');
	}

	public function update_status($id)
	{
		$role_permission_data = $this->role_permission_model->get_role_perm_by(['system_role_permissions.id' => $id]);
		$data['role_perm_data'] = $role_permission_data;

		$post = $this->input->post();

		if (isset($post['mode']))
		{	

			$result = FALSE;

			if ($post['mode'] == 'De-activate')
			{
				dump('De-activating...');
				$result = $this->role_permission_model->update($id, ['active_status' => 0]);
			}
			if ($post['mode'] == 'Activate')
			{
				dump('Activating...');
				$result = $this->role_permission_model->update($id, ['active_status' => 1]);
			}


			if ($result)
			{
				$this->session->set_flashdata('message', 'Successfully '.$post['mode'].' role permission status.');
				redirect('roles/details/'.$role_permission_data['role_id']);
			}
			else
			{
				$this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' role permission status.');
				redirect('roles/details/'.$role_permission_data['role_id']);
			}
			
		}
		else
		{
			$this->load->view('modals/modal-update-role-perm-status', $data);
		}
	}
}
