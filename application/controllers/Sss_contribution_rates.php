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
class Sss_contribution_rates extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'sss_contribution_matrix_model',
			'sss_rate_model'
		]);
	}

	public function index()
	{
		$sss_rates = $this->sss_rate_model->get_all();
		
		$this->data['show_modal']  = FALSE;
		$this->data['page_header'] = 'SSS Rates Management';
		$this->data['sss_rates']   = $sss_rates;

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/sss-rates-list');
	}

	public function details()
	{
		$sss_rate_id = $this->uri->segment(3);
		
		$sss_rate = $this->sss_rate_model->get_details('get_by', ['sss_rates.id' => $sss_rate_id]);

		$data['modal_title'] = 'SSS Rates Management';
		$data['sss_rate'] 	 = $sss_rate;

		$this->load->view('modals/modal-sss-rate-details', $data);
	}

	public function activate()
	{
		$sss_rate_id = $this->uri->segment(3);
		$sss_rate 	 = $this->sss_rate_model->get($sss_rate_id);
		$update 	 = $this->sss_rate_model->update($sss_rate_id, ['active_status' => 1]);

		$sss_matrix_id = $sss_rate['sss_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated tax rate with ID: ' . $sss_rate_id);
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate tax rate with ID: ' . $sss_rate_id);
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		}
	}

	public function deactivate()
	{
		$sss_rate_id = $this->uri->segment(3);
		$sss_rate    = $this->sss_rate_model->get($sss_rate_id);
		$update      = $this->sss_rate_model->update($sss_rate_id, ['active_status' => 0]);

		$sss_matrix_id = $sss_rate['sss_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated tax rate with ID: ' . $sss_rate_id);
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate tax rate with ID: ' . $sss_rate_id);
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		}
	}

	public function confirmation()
	{
		$mode  		 = $this->uri->segment(3);
		$sss_rate_id = $this->uri->segment(4);
		$sss_rate 	 = $this->sss_rate_model->get_by(['id' => $sss_rate_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> sss rate with ID: " . $sss_rate_id; 

		$data = array(
			'url' 			=> 'sss_contribution_rates/' . $mode . '/' . $sss_rate_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data['modal_title'] = 'Add SSS Rate';
		$data['sss_matrix_id'] = $this->uri->segment(3);

		$this->load->view('modals/modal-add-sss-rate', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$sss_matrix_id = $post['sss_matrix_id'];

 		$data = $post; // <<< TODO: this should be check if data is valid

		// $this->session->set_flashdata('log_parameters', [
		// 	'action_mode' => 0,
		// 	'perm_key'	  => 'add_sss_matrix',
		// 	'old_data'	  => NULL,
		// 	'new_data'	  => $data
		// ]);

		$last_id = $this->sss_rate_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new sss rate.');
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to add sss rate.');
			redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
		}
	}

	public function edit()
	{
		$sss_rate_id = $this->uri->segment(3);

		$sss_rate   = $this->sss_rate_model->get_details('get_by', ['sss_rates.id' => $sss_rate_id]);

		$sss_matrix_id = $sss_rate['sr_sss_matrix_id'];

		$sss_rates  = $this->sss_rate_model->get_details('get_many_by', ['sss_rates.sss_matrix_id' => $sss_matrix_id]);
		$sss_matrix = $this->sss_contribution_matrix_model->get_by(['id' => $sss_matrix_id]);

		$this->data['page_header'] = 'Tax Matrix Management';
		$this->data['sss_matrix']  = $sss_matrix;
		$this->data['sss_rates']   = $sss_rates;

		// show modal 
		$this->data['show_modal'] 		= TRUE;
		$this->data['modal_title'] 		= 'Edit Tax Rate';
		$this->data['modal_file_path']  = 'modals/modal-edit-sss-rate';
		$this->data['sss_rate'] 		= $sss_rate;

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->sss_rate_model->update($sss_rate_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated tax rate with ID: ' . $sss_matrix_id);
				redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update tax rate with ID: ' . $sss_matrix_id);
				redirect('sss_contribution_matrix/details/' . $sss_matrix_id);
			}
		}

		$this->load_view('pages/sss-contribution-matrix-details');
	}

	public function cancel()
	{
		redirect('sss_contribution_matrix');
	}
}

// End of file Sss_contribution_rates.php
// Location: ./application/controllers/Sss_contribution_rates.php
