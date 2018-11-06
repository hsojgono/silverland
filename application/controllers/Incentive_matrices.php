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
class Incentive_matrices extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'incentive_matrix_model'
		]);
	}

	public function index()
	{
		$incentive_matrices = $this->incentive_matrix_model->get_all();

		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'Incentive Matrix Management';
		$this->data['incentive_matrices'] = $incentive_matrices;

		$this->load_view('pages/incentive-matrix-lists');
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$incentive_matrix_id = $this->uri->segment(4);
		
		$incentive_matrices = $this->incentive_matrix_model->get_by(['id' => $incentive_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> Incentive Matrix with ID: " . $incentive_matrix_id; 

		$data = array(
			'url' 			=> 'incentive_matrices/' . $mode . '/' . $incentive_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message,
			'mode'			=> $mode
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function details()
	{
		$incentive_matrix_id = $this->uri->segment(3);
		
		$incentive_matrices = $this->incentive_matrix_model->get_by([
			'id' => $incentive_matrix_id
		]);
		
		$sss_rates = $this->sss_rate_model->get_details('get_many_by', [
			'sss_rates.sss_matrix_id' => $incentive_matrix_id
		]);

		$this->data['show_modal']  = FALSE;
		$this->data['page_header'] = 'Incentive Matrix Management';
		$this->data['sss_matrix']  = $incentive_matrices;

		$this->load_view('pages/incentive-matrix-details');
	}

	public function activate()
	{
		$incentive_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'activate_sss_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $incentive_matrix_id, 'active_status' => 0],
			'new_data'	  => ['active_status' => 1]
		]);

		$update = $this->incentive_matrix_model->update($incentive_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Incentive Matrix with ID: ' . $incentive_matrix_id);
			redirect('incentive_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Incentive Matrix with ID: ' . $incentive_matrix_id);
			redirect('incentive_matrices');
		}
	}

	public function deactivate()
	{
		$incentive_matrix_id = $this->uri->segment(3);

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'deactivate_sss_matrix',
			'action_mode' => 1,
			'old_data'	  => ['id' => $incentive_matrix_id, 'active_status' => 1],
			'new_data'	  => ['active_status' => 0]
		]);

		$update = $this->incentive_matrix_model->update($incentive_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated Incentive Matrix with ID: ' . $incentive_matrix_id);
			redirect('incentive_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Incentive Matrix with ID: ' . $incentive_matrix_id);
			redirect('incentive_matrices');
		}
	}

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Add Incentive Matrix',
			'years'		  => incremental_year(10)
		);
		$this->load->view('modals/modal-add-incentive-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'perm_key'	  => 'add_sss_matrix',
			'action_mode' => 0,
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->incentive_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new Incentive Matrix.');
			redirect('incentive_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add Incentive Matrix.');
			redirect('incentive_matrices');
		}
	}

	public function edit()
	{
		$sss_matrix_id = $this->uri->segment(3);
		
		$incentive_matrices = $this->incentive_matrix_model->get_all();
		$this->data['page_header'] = 'Incentive Matrix Management';
		$this->data['incentive_matrices'] = $incentive_matrices;

		// show modal
		$this->data['sss_matrix'] = $this->incentive_matrix_model->get_by(['id' => $sss_matrix_id]);
		$this->data['show_modal'] = TRUE;
		$this->data['modal_title'] = 'Edit SSS Matrix';
		$this->data['modal_file_path'] = 'modals/modal-edit-incentive-matrix';
		$this->data['years'] = incremental_year(10);

		$post = $this->input->post();

		$data = $post;

		if (isset($data['save'])) {

			unset($data['save']);

			$update = $this->incentive_matrix_model->update($sss_matrix_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated Incentive Matrix with ID: ' . $sss_matrix_id);
				redirect('incentive_matrices');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update Incentive Matrix with ID: ' . $sss_matrix_id);
				redirect('incentive_matrices');
			}
		}

		$this->load_view('pages/incentive-matrix-list');
	}

	public function cancel()
	{
		redirect('incentive_matrices');
	}
}

// End of file incentive_matrices.php
// Location: ./application/controllers/incentive_matrices.php