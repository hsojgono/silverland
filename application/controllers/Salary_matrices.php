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
class Salary_matrices extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
            'salary_matrix_model',
            'company_model'
		]);
	}

	public function index()
	{
        $salary_matrices = $this->salary_matrix_model->get_details('get_all', ['active_status' => 1]);
        
        $this->data = array(
            'page_header' => 'Salary Matrix Management',
            'salary_matrices' => $salary_matrices,
            'show_modal' => FALSE
        );

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}
		$this->load_view('pages/salary_matrix-lists');
	}

	public function details()
	{
		$salary_matrix_id = $this->uri->segment(3);
        $salary_matrices = $this->salary_matrix_model->get_by(['id' => $salary_matrix_id]);
        
        $this->data = array(
            'page_header' => 'Salary Matrix Management',
            'salary_matrices' => $salary_matrices,
            'show_modal' => FALSE
        );

		$this->load_view('pages/salary_matrix-details');
	}

	public function activate()
	{
		$salary_matrix_id = $this->uri->segment(3);
		$update = $this->salary_matrix_model->update($salary_matrix_id, ['active_status' => 1]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Salary matrix with ID: ' . $salary_matrix_id);
			redirect('salary_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Salary matrix with ID: ' . $salary_matrix_id);
			redirect('salary_matrices');
		}
	}

	public function deactivate()
	{
		$salary_matrix_id = $this->uri->segment(3);
		$update = $this->salary_matrix_model->update($salary_matrix_id, ['active_status' => 0]);
		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated Salary matrix with ID: ' . $salary_matrix_id);
			redirect('salary_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Salary matrix with ID: ' . $salary_matrix_id);
			redirect('salary_matrices');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$salary_matrix_id = $this->uri->segment(4);
		$salary_matrices = $this->salary_matrix_model->get_by(['id' => $salary_matrix_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> Salary matrix with ID: " . $salary_matrix_id; 

		$data = array(
			'url' 			=> 'salary/' . $mode . '/' . $salary_matrix_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$companies = $this->company_model->get_all();

		$data = array(
			'modal_title' => 'Add Salary Matrix',
			'companies'   => $companies
		);
		$this->load->view('modals/modal-add-salary-matrix', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		
		$data = $post; // <<< TODO: this should be check if data is valid

		$this->session->set_flashdata('log_parameters', [
			'action_mode' => 0,
			'perm_key'	  => 'add_salary',
			'old_data'	  => NULL,
			'new_data'	  => $data
		]);

		$last_id = $this->salary_matrix_model->insert($post);
		
		if ($last_id) {
			$this->session->set_flashdata('success', 'Successfully added new Salary matrix.');
			redirect('salary_matrices');
		} else {
			$this->session->set_flashdata('failed', 'Unable to add Salary matrix.');
			redirect('salary_matrices');
		}
	}

	public function edit()
	{
		$salary_matrix_id = $this->uri->segment(3);
		$salary    = $this->salary_matrix_model->get_by(['id' => $salary_matrix_id]);
		$salary_matrices  = $this->salary_matrix_model->get_all();
        
        $this->data = array(
            'page_header'     => 'Salary Matrix Management',
            'salary_matrices' => $salary_matrices,
            //shows modal
            'show_modal'      => TRUE,
            'modal_title'     => 'Edit Salary Matrix',
            'modal_file_path' => 'modals/modal-edit-salary',
            'salary'          => $salary
        );

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('salary_matrix_edit'));

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->salary_matrix_model->update($salary_matrix_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated Salary matrix with ID: ' . $salary_matrix_id);
				redirect('salary_matrices');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update Salary matrix with ID: ' . $salary_matrix_id);
				redirect('salary_matrices');
			}
		}

		$this->load_view('pages/salary_matrix-lists');
	}

	public function cancel()
	{
		redirect('salary_matrices');
	}
}

// End of file Salary_matrices.php
// Location: ./application/controllers/Salary_matrices.php