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
class Phic_contribution_rates extends MY_Controller
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
		$phic_rates = $this->phic_contribution_rate_model->get_all();
		
		$this->data['show_modal']  = FALSE;
		$this->data['page_header'] = 'phic Rates Management';
		$this->data['phic_rates']   = $phic_rates;

		$this->load_view('pages/phic-rates-list');
	}

	public function details()
	{
		$phic_rate_id = $this->uri->segment(3);
		$phic_rate = $this->phic_contribution_rate_model->get_details('get_by', ['phic_rates.id' => $phic_rate_id]);
		
		$data['modal_title'] = 'PHIC Rates Management';
		$data['phic_rate'] 	 = $phic_rate;

		$this->load->view('modals/modal-phic-rate-details', $data);
	}

	public function activate()
	{
		$phic_rate_id = $this->uri->segment(3);
		$phic_rate 	  = $this->phic_contribution_rate_model->get($phic_rate_id);
		$update 	  = $this->phic_contribution_rate_model->update($phic_rate_id, ['active_status' => 1]);

		$phic_matrix_id = $phic_rate['phic_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated PHIC rate with ID: ' . $phic_rate_id);
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate PHIC rate with ID: ' . $phic_rate_id);
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		}
	}

	public function deactivate()
	{
		$phic_rate_id = $this->uri->segment(3);
		$phic_rate    = $this->phic_contribution_rate_model->get($phic_rate_id);
		$update       = $this->phic_contribution_rate_model->update($phic_rate_id, ['active_status' => 0]);

		$phic_matrix_id = $phic_rate['phic_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated PHIC rate with ID: ' . $phic_rate_id);
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate PHIC rate with ID: ' . $phic_rate_id);
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		}
	}

	public function confirmation()
	{
		$mode  		  = $this->uri->segment(3);
		$phic_rate_id = $this->uri->segment(4);
		$phic_rate 	  = $this->phic_contribution_rate_model->get_by(['id' => $phic_rate_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> phic rate with ID: " . $phic_rate_id; 

		$data = array(
			'url' 			=> 'phic_contribution_rates/' . $mode . '/' . $phic_rate_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data['modal_title'] = 'Add PHIC Rate';
		$data['phic_matrix_id'] = $this->uri->segment(3);

		$this->load->view('modals/modal-add-phic-rate', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$phic_matrix_id = $post['phic_matrix_id'];

 		$data = $post; // <<< TODO: this should be check if data is valid

		// dump($data);exit;

		// $this->session->set_flashdata('log_parameters', [
		// 	'action_mode' => 0,
		// 	'perm_key'	  => 'add_phic_matrix',
		// 	'old_data'	  => NULL,
		// 	'new_data'	  => $data
		// ]);

		$last_id = $this->phic_contribution_rate_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new phic rate. ');
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to add phic rate. ');
			redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
		}
	}

	public function edit()
	{
		$phic_rate_id = $this->uri->segment(3);

		$phic_rate   = $this->phic_contribution_rate_model->get_details('get_by', ['phic_rates.id' => $phic_rate_id]);

		$phic_matrix_id = $phic_rate['pr_phic_matrix_id'];

		$phic_rates  = $this->phic_contribution_rate_model->get_details('get_many_by', ['phic_rates.phic_matrix_id' => $phic_matrix_id]);
		$phic_matrix = $this->phic_contribution_matrix_model->get_by(['id' => $phic_matrix_id]);

		$this->data['page_header'] = 'Tax Matrix Management';
		$this->data['phic_matrix'] = $phic_matrix;
		$this->data['phic_rates']  = $phic_rates;

		// show modal 
		$this->data['show_modal'] 		= TRUE;
		$this->data['modal_title'] 		= 'Edit PHIC Rate';
		$this->data['modal_file_path']  = 'modals/modal-edit-phic-rate';
		$this->data['phic_rate'] 		= $phic_rate;

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->phic_contribution_rate_model->update($phic_rate_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated PHIC rate with ID: ' . $phic_matrix_id);
				redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update PHIC rate with ID: ' . $phic_matrix_id);
				redirect('phic_contribution_matrix/details/' . $phic_matrix_id);
			}
		}

		$this->load_view('pages/phic-contribution-matrix-details');
	}

	public function cancel()
	{
		redirect('phic_contribution_matrix');
	}
}

// End of file Phic_contribution_rates.php
// Location: ./application/controllers/Phic_contribution_rates.php
