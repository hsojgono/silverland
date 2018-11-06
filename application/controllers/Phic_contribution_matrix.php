<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Phic_contribution_matrix extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'phic_contribution_matrix_model',
			'phic_contribution_rate_model'
		]);
	}

	public function index()
	{
		$phic_matrices = $this->phic_contribution_matrix_model->get_all();

		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'PHIC Contribution Matrix Management';
		$this->data['phic_matrices'] = $phic_matrices;

		$this->load_view('pages/phic-contribution-matrix-list');
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$phic_contribution_matrix_id = $this->uri->segment(4);
		
		$phic_contribution_matrix = $this->phic_contribution_matrix_model->get_by(['id' => $phic_contribution_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> PHIC Contribution Matrix with ID: " . $phic_contribution_matrix_id; 

		$data = array(
			'url' 			=> 'phic_contribution_matrix/' . $mode . '/' . $phic_contribution_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message,
			'mode'			=> $mode
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function details()
	{
		$phic_contribution_matrix_id = $this->uri->segment(3);
		
		$phic_contribution_matrix = $this->phic_contribution_matrix_model->get_by([
			'id' => $phic_contribution_matrix_id
		]);
		$phic_rates = $this->phic_contribution_rate_model->get_details('get_many_by', [
			'phic_rates.phic_matrix_id' => $phic_contribution_matrix_id
		]);

		$this->data['page_header'] = 'PHIC Contribution Matrix Management';
		$this->data['phic_matrix'] = $phic_contribution_matrix;
		$this->data['phic_rates']  = $phic_rates;
		$this->data['show_modal']  = FALSE;

		$this->load_view('pages/phic-contribution-matrix-details');
	}

	public function activate()
	{
		$phic_contribution_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'activate_phic_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $phic_contribution_matrix_id, 'active_status' => 0],
			'new_data'	  => ['active_status' => 1]
		]);

		$update = $this->phic_contribution_matrix_model->update($phic_contribution_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated PHIC Contribution Matrix with ID: ' . $phic_contribution_matrix_id);
			redirect('phic_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate PHIC Contribution Matrix with ID: ' . $phic_contribution_matrix_id);
			redirect('phic_contribution_matrix');
		}
	}

	public function deactivate()
	{
		$phic_contribution_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'deactivate_phic_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $phic_contribution_matrix_id, 'active_status' => 1],
			'new_data'	  => ['active_status' => 0]
		]);

		$update = $this->phic_contribution_matrix_model->update($phic_contribution_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated PHIC Contribution Matrix with ID: ' . $phic_contribution_matrix_id);
			redirect('phic_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate PHIC Contribution Matrix with ID: ' . $phic_contribution_matrix_id);
			redirect('phic_contribution_matrix');
		}
	}

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Add PHIC Contribution Matrix',
			'years'		  => incremental_year(10)
		);
		$this->load->view('modals/modal-add-phic-contribution-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'add_phic_matrix',
			'action_mode' => 0,
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->phic_contribution_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new PHIC Contribution Matrix.');
			redirect('phic_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add PHIC Contribution Matrix.');
			redirect('phic_contribution_matrix');
		}
	}

	public function edit()
	{
		$phic_matrix_id = $this->uri->segment(3);
		
		$phic_matrices = $this->phic_contribution_matrix_model->get_all();
		$this->data['page_header'] = 'PHIC Contribution Matrix Management';
		$this->data['phic_matrices'] = $phic_matrices;

		// show modal
		$this->data['phic_matrix'] = $this->phic_contribution_matrix_model->get_by(['id' => $phic_matrix_id]);
		$this->data['show_modal'] = TRUE;
		$this->data['modal_title'] = 'Edit PHIC Matrix';
		$this->data['modal_file_path'] = 'modals/modal-edit-phic-contribution-matrix';
		$this->data['years'] = incremental_year(10);
		$this->data['phic_matrix_id'] = $phic_matrix_id;

		$post = $this->input->post();

		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);
			$update = $this->phic_contribution_matrix_model->update($phic_matrix_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated PHIC Contribution Matrix with ID: ' . $phic_matrix_id);
				redirect('phic_contribution_matrix');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update PHIC Contribution Matrix with ID: ' . $phic_matrix_id);
				redirect('phic_contribution_matrix');
			}
		}

		$this->load_view('pages/phic-contribution-matrix-list');
	}

	public function cancel()
	{
		redirect('phic_contribution_matrix');
	}
}

// End of file Phic_contribution_matrix.php
// Location: ./application/controllers/Phic_contribution_matrix.php