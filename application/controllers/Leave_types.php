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
class Leave_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['leave_type_model']);
	}

	function index()
	{
		$leave_types = $this->leave_type_model->get_leave_type_all();

		$this->data = array(
			'page_header' => 'Leave Type Management',
			'leave_types' => $leave_types,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/leave_type-lists');
	}

	function add()
	{
		$this->data = array(
			'page_header' => 'Leave Type Management',
			'active_menu' => $this->active_menu,
		);

		$leave_types = $this->leave_type_model->get_leave_type_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_type_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('leave_type_add') == TRUE)
		{
			//write to system_logs
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_leave_type',
			// 	'old_data' 	  => NULL,
			// 	'new_data'	  => $data
			// ]);

			$leave_type_id = $this->leave_type_model->insert($data);

			if ( ! $leave_type_id) {
				$this->session->set_flashdata('failed', 'Failed to add leave type.');
				redirect('leave_types');
			} else {
				$this->session->set_flashdata('success', 'Leave type has been successfully added.');
				redirect('leave_types');
			}
		}
		$this->load_view('forms/leave_type-add');
	}

	function details($id)
	{
		$leave_type = $this->leave_type_model->get_leave_type_by(['attendance_leave_types.id' => $id]);

		$this->data = array(
			'page_header' => 'Leave Type Details',
			'leave_type'  => $leave_type,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/leave_type-detail');
	}

	function edit($id)
	{
		// get specific leave_type based on the id
		$leave_type = $this->leave_type_model->get_leave_type_by(['attendance_leave_types.id' => $id]);

		$this->data = array(
			'page_header' => 'Leave Type Management',
			'leave_type' 	  => $leave_type,
			'active_menu' => $this->active_menu,
		);

		$leave_types = $this->leave_type_model->get_leave_type_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_type_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('leave_type_add') == TRUE)
		{
			//write to system_logs
			$this->session->set_flashdata('log_parameters',[
				'action_mode' => 1,
				'perm_key'    => 'edit_leave_type',
				'old_data'    => $leave_type,
				'new_data'    => $data
			]);

			$leave_type_id = $this->leave_type_model->update($id, $data);

			if ( ! $leave_type_id) {
				$this->session->set_flashdata('failed', 'Failed to update leave_type.');
				redirect('leave_types');
			} else {
				$this->session->set_flashdata('success', 'Leave Type successfully updated!');
				redirect('leave_types');
			}
		}
		$this->load_view('forms/leave_type-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_leave_type = $this->leave_type_model->get_by(['id' => $id]);
        $data['edit_leave_type'] = $edit_leave_type;

        $this->load->view('modals/modal-update-leave_type', $data);
    }

    public function update_status($id)
    {
        $leave_type_data = $this->leave_type_model->get_by(['id' => $id]);
        $data['leave_type_data'] = $leave_type_data;

		$post = $this->input->post();
		
		//dump($post);exit;

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->leave_type_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->leave_type_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $leave_type_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('leave_types');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$leave_type_data['name'].'!');
                redirect('leave_types');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-leave_type-status', $data);
        }
    }
}
