<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Attachment_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['attachment_type_model']);
	}

	function index()
	{
		$attachment_types = $this->attachment_type_model->get_details('get_many_by', ['attachment_types.active_status' => 1]);

		$this->data = array(
			'page_header' => 'Attachment Types Management',
			'attachment_types' => $attachment_types,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/attachment_type-lists');
	}

	public function add()
	{

		$this->data = array(
			'page_header' => 'Attachment Types Management',
			'active_menu' => $this->active_menu,
		);

		$attachment_types = $this->attachment_type_model->get_details('get_all', ['attachment_types.active_status' => 1]);
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('attachment_type_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('attachment_type_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_attachment_type',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$attachment_type_id = $this->attachment_type_model->insert($data);

			if ( ! $attachment_type_id) {
				$this->session->set_flashdata('failed', 'Failed to add new attachment_type.');
				redirect('attachment_types');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new attachment_type.');
				redirect('attachment_types');
			}
		}
		$this->load_view('forms/attachment_type-add');
	}

	function details($id)
	{
		$attachment_type = $this->attachment_type_model->get_attachment_type_by(['attachment_types.id' => $id]);
		$site 			 = $this->site_model->get_many_site_by(['sites.attachment_type_id' => $id]);
		$sites 			 = $this->site_model->get_many_site_by(['sites.attachment_type_id' => $id]);
		$employee_infos  = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);

		$this->data = array(
			'page_header'    => 'Attachment Types Details',
			'attachment_type'=> $attachment_type,
			'sites' 		 => $site,
			'sites' 		 => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' 	 => $this->active_menu,
		);
		$this->load_view('pages/attachment_type-detail');
	}

	function edit($id)
	{
		// get specific attachment_type based on the id
		$attachment_type = $this->attachment_type_model->get_attachment_type_by(['attachment_types.id' => $id]);
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		if ( ! $this->ion_auth_acl->has_permission('edit_attachment_type'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
		}

        $attachment_type_data = $this->attachment_type_model->get_attachment_type_by(['attachment_types.id' => $id]);

		$this->data = array(
			'page_header' => 'Attachment Types Management',
			'attachment_type' 	  => $attachment_type,
			'attachment_type_data' => $attachment_type_data,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$attachment_types = $this->attachment_type_model->get_attachment_type_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('attachment_type_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('attachment_type_edit') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key'    => 'edit_attachment_type',
				'old_data'    => $attachment_type_data,
				'new_data'    => $data
			]);

			$attachment_type_id = $this->attachment_type_model->update($id, $data);

			if ( ! $attachment_type_id) {
				$this->session->set_flashdata('failed', 'Failed to update attachment_type.');
				redirect('attachment_types');
			} else {
				$this->session->set_flashdata('success', 'Attachment Types successfully updated!');
				redirect('attachment_types');
			}
		}
		$this->load_view('forms/attachment_type-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_attachment_type = $this->attachment_type_model->get_by(['id' => $id]);
        $data['edit_attachment_type'] = $edit_attachment_type;

        $this->load->view('modals/modal-update-attachment_type', $data);
    }

    public function update_status($id)
    {
        $attachment_type_data = $this->attachment_type_model->get_by(['id' => $id]);
        $data['attachment_type_data'] = $attachment_type_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
				$old_data = 1;
				$new_data = 0;
                $result = $this->attachment_type_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
				$old_data = 0;
				$new_data = 1;
                $result = $this->attachment_type_model->update($id, ['active_status' => 1]);
            }

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 6,
				'perm_key'    => 'update_attachment_type_status',
				'old_data'    => $old_data,
				'new_data'    => $new_data
			]);

            if ($result)
            {
                 $this->session->set_flashdata('message', $attachment_type_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('attachment_types');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$attachment_type_data['name'].'!');
                redirect('attachment_types');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-attachment_type-status', $data);
        }
    }
}
