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
class Users extends MY_Controller {

	private $active_menu = 'System';

	function __construct()
	{
		parent::__construct();
		$this->load->model(['user_model']);
	}

	function index()
	{
		// dump($this->ion_auth_acl->has_permission('view_users'));exit;
		// if ( ! $this->ion_auth_acl->has_permission('my_official_business'))
		// {
		// 	$this->session->set_flashdata('failed', 'Sorry you have no permission to access this function.');
		// 	redirect('/', '');
		// }

		$this->data['has_permission'] = [
			'assign_role' => $this->ion_auth_acl->has_permission('assign_roles'),
			'update_role' => ( ! $this->ion_auth_acl->has_permission('assign_roles')) ? 'disabled' : ''
		];

		$this->data['page_header'] = 'User Management';
		$this->data['active_menu'] = $this->active_menu;

		//list the users
		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();

			if ($user->id == 1) unset($this->data['users'][$k]);
		}
		
		// dump($this->data['users']);exit;
		$this->load_view('pages/user-list');
	}
	
	public function assign_roles($user_id)
	{
		$data['modal_header']  	= 'Assign Roles';
		$data['modal_message'] 	= 'Please select all applicable roles';
		$data['user_id'] 		= $user_id;
		$data['groups']  		= $this->ion_auth->groups()->result_array();
		$data['current_groups'] = $this->ion_auth->get_users_groups($user_id)->result();

		//Update the groups user belongs to
		$group_data = $this->input->post('groups');
		if (isset($group_data) && !empty($group_data))
		{
			$this->ion_auth->remove_from_group('', $user_id);

			$arr = [];

			foreach ($group_data as $group)
			{
				$arr = $this->ion_auth->add_to_group($group, $user_id);
				if ( ! $arr)
				{
					$this->session->set_flashdata('failed', 'Unable to assign role.');
					redirect('users');
				}
			}

			$this->session->set_flashdata('success', 'Success!.');
			redirect('users');
		}

		$this->load->view('modals/modal-assign-roles', $data);
	}

	public function test_ajax()
	{
		$data = $this->input->post();
		echo json_encode(['data' => $data]);
	}

	public function confirmation()
	{
		$user_id = $this->uri->segment(3);
		$user = $this->ion_auth->user($user_id)->row();
		$data['user_data'] = $user;

		$this->load->view('modals/modal-update-user-status', $data);
	}

	public function update_status($id)
	{
		$user_data = $this->ion_auth->user($id)->row();
		$data['user_data'] = $user_data;

		// $users = $this->user_model->get_user_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('User_add'));

		$this->form_validation->set_data($data);

		$post = $this->input->post();

		if ( ! isset($post['mode']))
		{
			$this->load->view('modals/modal-update-role-status', $data);
		}

		$result = ($post['mode'] == 1) ? $this->user_model->update($id, ['active' => 0]) : $this->user_model->update($id, ['active' => 1]);
		$mode_label = ($post['mode'] == 1) ? 'De-activated':'Activated';
		if ($result)
		{
			$this->session->set_flashdata('message', 'Successfully '.$mode_label.' user status.');
			redirect('users');
		}
		else
		{
			$this->session->set_flashdata('failed', 'Unable to '.$mode_label.' user status.');
			redirect('users');
		}
	}

	function details($id)
	{
		$user = $this->user_model->get_by(['id' => $id]);
		dump($user);
	}

	function edit($id)
	{
		// get specific User based on the id
		$User = $this->user_model->get_User_by(['system_users.id' => $id]);
		
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		
		$this->data = array(
			'page_header' => 'User Management',
			'User' 	  => $User,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$users = $this->user_model->get_User_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('User_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('User_add') == TRUE)
		{
			$User_id = $this->user_model->update($id, $data);

			if ( ! $User_id) {
				$this->session->set_flashdata('failed', 'Failed to update User.');
				redirect('users');
			} else {
				$this->session->set_flashdata('success', 'User successfully updated!');
				redirect('users');
			}
		}
		$this->load_view('forms/User-edit');
	}

	public function update_default_role()
	{
		if ( ! $this->ion_auth_acl->has_permission('assign_roles'))
		{
			$this->session->set_flashdata('failed', 'Sorry you have no permission to access this function.');
			redirect('users', 'refresh');
		}

		$this->load->model('user_roles_model');
		$post = $this->input->post();

		$user = $this->ion_auth->user($post['user_id'])->row();
		// get the current default user role
		$current_role = $this->user_roles_model->get_by([
			'system_user_id' => $post['user_id'],
			'default_status' => 1
		]);
		
		if ($current_role['id'] != $post['user_role_id']) {
			$updated = $this->db->set('default_status', 1)
								->where('system_user_id', $post['user_id'])
								->where('system_group_id', $post['user_role_id'])
								->update('system_users_groups');

			if ($updated) {
				$test = $this->db->set('default_status', 0)
					->where('system_user_id', $post['user_id'])
					->where('system_group_id', $current_role['system_group_id'])
					->update('system_users_groups');

				if ($test) {
					$this->session->set_flashdata('success', 'Successfully updated default role of user named '.$user->first_name.' '.$user->last_name);
					redirect('users');
				}
			}
		}
	}
}
