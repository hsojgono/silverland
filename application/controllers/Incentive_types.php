<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Incentive_types extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
            'incentive_type_model'
		]);
	}

	public function index()
	{
		$incentive_types = $this->incentive_type_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Incentive Types Management',
			'incentive_types' => $incentive_types,
			'show_modal' => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/incentive_type-lists');
	}

	public function details()
	{
		$incentive_type_id = $this->uri->segment(3);
		$incentive_type = $this->incentive_type_model->get_details('get_by', ['incentive_types.id' => $incentive_type_id]);

		$data['modal_title']    = 'Incentive Types Management';
		$data['incentive_type'] = $incentive_type;

		$this->load->view('modals/modal-incentive_type-details', $data);
	}

	public function activate()
	{
		$incentive_type_id = $this->uri->segment(3);
		$incentive_type    = $this->incentive_type_model->get_details('get_by', ['incentive_types.id' => $incentive_type_id]);
		$update    = $this->incentive_type_model->update($incentive_type_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully activated ' . $incentive_type['name']);
			redirect('incentive_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to activate ' . $incentive_type['name']);
			redirect('incentive_types');
		}
	}

	public function deactivate()
	{
		$incentive_type_id = $this->uri->segment(3);
		$incentive_type    = $this->incentive_type_model->get_details('get_by', ['incentive_types.id' => $incentive_type_id]);
		$update    = $this->incentive_type_model->update($incentive_type_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $incentive_type['name'] . ' successfully deactivated ');
			redirect('incentive_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to deactivate ' . $incentive_type['name']);
			redirect('incentive_types');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$incentive_type_id = $this->uri->segment(4);
		$incentive_type    = $this->incentive_type_model->get_details('get_by', ['incentive_types.id' => $incentive_type_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> incentive type " . $incentive_type['name']; 

		$data = array(
			'url' 			=> 'incentive_types/' . $mode . '/' . $incentive_type_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$incentive_types = $this->incentive_type_model->get_all(['active_status' => 1]);

		$data = array(
			'modal_title' => 'Add Incentive Type',
			'incentive_type_matrices' => $incentive_types
		);
		
		$this->load->view('modals/modal-add-incentive_type', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('incentive_type_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('incentive_type_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->incentive_type_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added incentive type.');
				redirect('incentive_types');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add incentive type.');
				redirect('incentive_types');
			}
		}
	}

	public function edit()
	{
		$incentive_type_id = $this->uri->segment(3);
		$incentive_type    = $this->incentive_type_model->get_details('get_by', ['id' => $incentive_type_id]);
		$incentive_types   = $this->incentive_type_model->get_details('get_many_by', ['active_status' => 1]);

		$this->data = array(
			'page_header'             => 'Incentive Types Management',
			// show modal 
			'show_modal'        => TRUE,
			'modal_title'  	    => 'Edit Incentive Type',
			'modal_file_path'   => 'modals/modal-edit-incentive_type',
			'incentive_type'    => $incentive_type,
			'incentive_types'   => $incentive_types,
			'incentive_type_id' => $incentive_type_id
		);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->incentive_type_model->update($incentive_type_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated incentive type ' . $incentive_type['name']);
				redirect('incentive_types');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update incentive type ' . $incentive_type['name']);
				redirect('incentive_types');
			}
		}

		 $this->load_view('pages/incentive_type-lists');
	}

	public function cancel()
	{
		redirect('incentive_types');
	}
}

// End of file Incentive_types.php
// Location: ./application/controllers/Incentive_types.php