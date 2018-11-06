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
class Hdmf_contribution_matrix extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'hdmf_contribution_matrix_model',
			'hdmf_contribution_rate_model'
		]);
	}

	public function index()
	{
		$hdmf_matrices = $this->hdmf_contribution_matrix_model->get_all();

		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'HDMF Contribution Matrix Management';
		$this->data['hdmf_matrices'] = $hdmf_matrices;

		$this->load_view('pages/hdmf-contribution-matrix-list');
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$hdmf_contribution_matrix_id = $this->uri->segment(4);
		
		$hdmf_contribution_matrix = $this->hdmf_contribution_matrix_model->get_by(['id' => $hdmf_contribution_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> HDMF Contribution Matrix with ID: " . $hdmf_contribution_matrix_id; 

		$data = array(
			'url' 			=> 'hdmf_contribution_matrix/' . $mode . '/' . $hdmf_contribution_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message,
			'mode'			=> $mode
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function details()
	{
		$hdmf_contribution_matrix_id = $this->uri->segment(3);
		
		$hdmf_contribution_matrix = $this->hdmf_contribution_matrix_model->get_by([
			'id' => $hdmf_contribution_matrix_id
		]);
		$hdmf_rates = $this->hdmf_contribution_rate_model->get_details('get_many_by', [
			'hdmf_rates.hdmf_matrix_id' => $hdmf_contribution_matrix_id
		]);

		$this->data['page_header'] = 'HDMF Contribution Matrix Management';
		$this->data['hdmf_matrix'] = $hdmf_contribution_matrix;
		$this->data['hdmf_rates']  = $hdmf_rates;
		$this->data['show_modal'] = FALSE;

		$this->load_view('pages/hdmf-contribution-matrix-details');
	}

	public function activate()
	{
		$hdmf_contribution_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'activate_hdmf_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $hdmf_contribution_matrix_id, 'active_status' => 0],
			'new_data'	  => ['active_status' => 1]
		]);

		$update = $this->hdmf_contribution_matrix_model->update($hdmf_contribution_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated HDMF Contribution Matrix with ID: ' . $hdmf_contribution_matrix_id);
			redirect('hdmf_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate HDMF Contribution Matrix with ID: ' . $hdmf_contribution_matrix_id);
			redirect('hdmf_contribution_matrix');
		}
	}

	public function deactivate()
	{
		$hdmf_contribution_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'deactivate_hdmf_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $hdmf_contribution_matrix_id, 'active_status' => 1],
			'new_data'	  => ['active_status' => 0]
		]);

		$update = $this->hdmf_contribution_matrix_model->update($hdmf_contribution_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated HDMF Contribution Matrix with ID: ' . $hdmf_contribution_matrix_id);
			redirect('hdmf_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate HDMF Contribution Matrix with ID: ' . $hdmf_contribution_matrix_id);
			redirect('hdmf_contribution_matrix');
		}
	}

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Add HDMF Contribution Matrix',
			'years'		  => incremental_year(10)
		);
		$this->load->view('modals/modal-add-hdmf-contribution-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'add_hdmf_matrix',
			'action_mode' => 0,
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->hdmf_contribution_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new HDMF Contribution Matrix.');
			redirect('hdmf_contribution_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add HDMF Contribution Matrix.');
			redirect('hdmf_contribution_matrix');
		}
	}

	public function edit()
	{
		$hdmf_matrix_id = $this->uri->segment(3);
		
		$hdmf_matrices = $this->hdmf_contribution_matrix_model->get_all();
		$this->data['page_header'] = 'HDMF Contribution Matrix Management';
		$this->data['hdmf_matrices'] = $hdmf_matrices;

		// show modal
		$this->data['hdmf_matrix'] = $this->hdmf_contribution_matrix_model->get_by(['id' => $hdmf_matrix_id]);
		$this->data['show_modal'] = TRUE;
		$this->data['modal_title'] = 'Edit HDMF Matrix';
		$this->data['modal_file_path'] = 'modals/modal-edit-hdmf-contribution-matrix';
		$this->data['years'] = incremental_year(10);
		$this->data['hdmf_matrix_id'] = $hdmf_matrix_id;

		$post = $this->input->post();

		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);
			$update = $this->hdmf_contribution_matrix_model->update($hdmf_matrix_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated HDMF Contribution Matrix with ID: ' . $hdmf_matrix_id);
				redirect('hdmf_contribution_matrix');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update HDMF Contribution Matrix with ID: ' . $hdmf_matrix_id);
				redirect('hdmf_contribution_matrix');
			}
		}

		$this->load_view('pages/hdmf-contribution-matrix-list');
	}

	public function cancel()
	{
		redirect('hdmf_contribution_matrix');
	}
}

// End of file hdmf_contribution_matrix.php
// Location: ./application/controllers/hdmf_contribution_matrix.php