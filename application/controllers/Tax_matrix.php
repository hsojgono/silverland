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
class Tax_matrix extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'tax_matrix_model',
			'tax_rate_model'
		]);
	}

	public function index()
	{
		$tax_matrices = $this->tax_matrix_model->get_all();
		
		$this->data['show_modal'] = FALSE;
		$this->data['page_header'] = 'Tax Matrix Management';
		$this->data['tax_matrices'] = $tax_matrices;

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}


		$this->load_view('pages/tax-matrix-list');
	}

	public function details()
	{
		$tax_matrix_id = $this->uri->segment(3);
		
		$tax_matrix = $this->tax_matrix_model->get_by(['id' => $tax_matrix_id]);
		$tax_rates = $this->tax_rate_model->get_details('get_many_by', ['tax_tables.tax_matrix_id' => $tax_matrix_id]);

		$this->data['page_header'] = 'Tax Matrix Management';
		$this->data['tax_matrix']  = $tax_matrix;
		$this->data['tax_rates']   = $tax_rates;
		$this->data['show_modal']  = FALSE;

		$this->load_view('pages/tax-matrix-details');
	}

	public function activate()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$update = $this->tax_matrix_model->update($tax_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		}
	}

	public function deactivate()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$update = $this->tax_matrix_model->update($tax_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate tax matrix with ID: ' . $tax_matrix_id);
			redirect('tax_matrix');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$tax_matrix_id = $this->uri->segment(4);
		
		$tax_matrix = $this->tax_matrix_model->get_by(['id' => $tax_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> tax matrix with ID: " . $tax_matrix_id; 

		$data = array(
			'url' 			=> 'tax_matrix/' . $mode . '/' . $tax_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Add Tax Matrix',
			'years'		  => incremental_year(10)
		);
		$this->load->view('modals/modal-add-tax-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		
		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'action_mode' => 0,
			'perm_key'	  => 'add_tax_matrix',
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->tax_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new tax matrix.');
			redirect('tax_matrix');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add tax matrix.');
			redirect('tax_matrix');
		}
	}

	public function edit()
	{
		$tax_matrix_id = $this->uri->segment(3);
		$tax_matrix    = $this->tax_matrix_model->get_by(['id' => $tax_matrix_id]);
		$tax_matrices  = $this->tax_matrix_model->get_all();

		$this->data['page_header']  = 'Tax Matrix Management';
		$this->data['tax_matrices'] = $tax_matrices;

		// show modal 
		$this->data['show_modal'] 		= TRUE;
		$this->data['modal_title'] 		= 'Edit Tax Rate';
		$this->data['modal_file_path']  = 'modals/modal-edit-tax-matrix';
		$this->data['tax_matrix']  		= $tax_matrix;
		$this->data['years'] 			= incremental_year(10);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->tax_matrix_model->update($tax_matrix_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated tax matrix with ID: ' . $tax_matrix_id);
				redirect('tax_matrix');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update tax matrix with ID: ' . $tax_matrix_id);
				redirect('tax_matrix');
			}
		}

		$this->load_view('pages/tax-matrix-list');
	}

	public function cancel()
	{
		redirect('tax_matrix');
	}
}

// End of file Tax_matrix.php
// Location: ./application/controllers/Tax_matrix.php