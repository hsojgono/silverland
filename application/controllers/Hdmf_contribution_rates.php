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
class Hdmf_contribution_rates extends MY_Controller
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
		$hdmf_rates = $this->hdmf_contribution_rate_model->get_all();
		
		$this->data['show_modal']  = FALSE;
		$this->data['page_header'] = 'hdmf Rates Management';
		$this->data['hdmf_rates']   = $hdmf_rates;

		$this->load_view('pages/hdmf-rates-list');
	}

	public function details()
	{
		$hdmf_rate_id = $this->uri->segment(3);
		$hdmf_rate = $this->hdmf_contribution_rate_model->get_details('get_by', ['hdmf_rates.id' => $hdmf_rate_id]);
		
		$data['modal_title'] = 'hdmf Rates Management';
		$data['hdmf_rate'] 	 = $hdmf_rate;

		$this->load->view('modals/modal-hdmf-contribution-rate-details', $data);
	}

	public function activate()
	{
		$hdmf_rate_id = $this->uri->segment(3);
		$hdmf_rate 	  = $this->hdmf_contribution_rate_model->get($hdmf_rate_id);
		$update 	  = $this->hdmf_contribution_rate_model->update($hdmf_rate_id, ['active_status' => 1]);

		$hdmf_matrix_id = $hdmf_rate['hdmf_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated hdmf rate with ID: ' . $hdmf_rate_id);
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate hdmf rate with ID: ' . $hdmf_rate_id);
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		}
	}

	public function deactivate()
	{
		$hdmf_rate_id = $this->uri->segment(3);
		$hdmf_rate    = $this->hdmf_contribution_rate_model->get($hdmf_rate_id);
		$update       = $this->hdmf_contribution_rate_model->update($hdmf_rate_id, ['active_status' => 0]);

		$hdmf_matrix_id = $hdmf_rate['hdmf_matrix_id'];

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated hdmf rate with ID: ' . $hdmf_rate_id);
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate hdmf rate with ID: ' . $hdmf_rate_id);
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		}
	}

	public function confirmation()
	{
		$mode  		  = $this->uri->segment(3);
		$hdmf_rate_id = $this->uri->segment(4);
		$hdmf_rate 	  = $this->hdmf_contribution_rate_model->get_by(['id' => $hdmf_rate_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> hdmf rate with ID: " . $hdmf_rate_id; 

		$data = array(
			'url' 			=> 'hdmf_contribution_rates/' . $mode . '/' . $hdmf_rate_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data['modal_title'] = 'Add hdmf Rate';
		$data['hdmf_matrix_id'] = $this->uri->segment(3);

		$this->load->view('modals/modal-add-hdmf-contribution-rate', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		$hdmf_matrix_id = $post['hdmf_matrix_id'];

 		$data = $post; // <<< TODO: this should be check if data is valid

		// dump($data);exit;

		// $this->session->set_flashdata('log_parameters', [
		// 	'action_mode' => 0,
		// 	'perm_key'	  => 'add_hdmf_matrix',
		// 	'old_data'	  => NULL,
		// 	'new_data'	  => $data
		// ]);

		$last_id = $this->hdmf_contribution_rate_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new hdmf rate. ');
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		} else {
			$this->session->set_flashdata('failed', 'Unable to add hdmf rate. ');
			redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
		}
	}

	public function edit()
	{
		$hdmf_rate_id = $this->uri->segment(3);

		$hdmf_rate   = $this->hdmf_contribution_rate_model->get_details('get_by', ['hdmf_rates.id' => $hdmf_rate_id]);

		$hdmf_matrix_id = $hdmf_rate['hr_hdmf_matrix_id'];

		$hdmf_rates  = $this->hdmf_contribution_rate_model->get_details('get_many_by', ['hdmf_rates.hdmf_matrix_id' => $hdmf_matrix_id]);
		$hdmf_matrix = $this->hdmf_contribution_matrix_model->get_by(['id' => $hdmf_matrix_id]);

		$this->data['page_header'] = 'Tax Matrix Management';
		$this->data['hdmf_matrix'] = $hdmf_matrix;
		$this->data['hdmf_rates']  = $hdmf_rates;

		// show modal 
		$this->data['show_modal'] 		= TRUE;
		$this->data['modal_title'] 		= 'Edit hdmf Rate';
		$this->data['modal_file_path']  = 'modals/modal-edit-hdmf-contribution-rate';
		$this->data['hdmf_rate'] 		= $hdmf_rate;

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->hdmf_contribution_rate_model->update($hdmf_rate_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated hdmf rate with ID: ' . $hdmf_matrix_id);
				redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update hdmf rate with ID: ' . $hdmf_matrix_id);
				redirect('hdmf_contribution_matrix/details/' . $hdmf_matrix_id);
			}
		}

		$this->load_view('pages/hdmf-contribution-matrix-details');
	}

	public function cancel()
	{
		redirect('hdmf_contribution_matrix');
	}
}

// End of file Hdmf_contribution_rates.php
// Location: ./application/controllers/Hdmf_contribution_rates.php
