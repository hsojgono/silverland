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
class Salaries extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'salary_matrix_model',
			'salary_model'
		]);
	}

	public function index()
	{
		$salaries = $this->salary_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Salaries Management',
			'salaries' => $salaries,
			'show_modal' => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/salary-lists');
	}

	public function details()
	{
		$salary_id = $this->uri->segment(3);
		$salary = $this->salary_model->get_details('get_by', ['salaries.id' => $salary_id]);

		$data['modal_title'] = 'Salaries Management';
		$data['salary'] 	 = $salary;

		$this->load->view('modals/modal-salary-details', $data);
	}

	public function activate()
	{
		$salary_id = $this->uri->segment(3);
		$salary    = $this->salary_model->get_details('get_by', ['salaries.id' => $salary_id]);
		$update    = $this->salary_model->update($salary_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated salary ' . $salary['monthly_salary']);
			redirect('salaries');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate salary ' . $salary['monthly_salary']);
			redirect('salaries');
		}
	}

	public function deactivate()
	{
		$salary_id = $this->uri->segment(3);
		$salary    = $this->salary_model->get_details('get_by', ['salaries.id' => $salary_id]);
		$update    = $this->salary_model->update($salary_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $salary['monthly_salary'] . 'successfully Deactivated salary ');
			redirect('salaries');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate salary ' . $salary['monthly_salary']);
			redirect('salaries');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$salary_id = $this->uri->segment(4);
		$salary    = $this->salary_model->get_details('get_by', ['salaries.id' => $salary_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> salary " . $salary['monthly_salary']; 

		$data = array(
			'url' 			=> 'salaries/' . $mode . '/' . $salary_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$salary_matrices = $this->salary_matrix_model->get_all(['active_status' => 1]);

		$data = array(
			'modal_title' => 'Add Salary',
			'salary_matrices' => $salary_matrices
		);
		
		$this->load->view('modals/modal-add-salary', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('salary_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('salary_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->salary_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added salary.');
				redirect('salaries');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add salary.');
				redirect('salaries');
			}
		}
	}

	public function edit()
	{
		$salary_id = $this->uri->segment(3);
		$salary    = $this->salary_model->get_details('get_by', ['salaries.id' => $salary_id]);
		$salary_matrix = $this->salary_matrix_model->get_by(['id' => $salary['salary_matrix_id']]);
		$salary_matrices = $this->salary_matrix_model->get_all();
		$salaries  = $this->salary_model->get_details('get_many_by', ['salaries.active_status' => 1]);

		$this->data = array(
			'page_header'     => 'Salary Management',
			'salary_matrix'   => $salary_matrix,
			'salary_matrices' => $salary_matrices,
			// show modal 
			'show_modal'      => TRUE,
			'modal_title'  	  => 'Edit salary',
			'modal_file_path' => 'modals/modal-edit-salary',
			'salary' 		  => $salary,
			'salaries'		  => $salaries,
			'salary_id' 	  => $salary_id
		);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->salary_model->update($salary_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated salary ' . $salary['monthly_salary']);
				redirect('salaries');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update salary ' . $salary['monthly_salary']);
				redirect('salaries');
			}
		}

		 $this->load_view('pages/salary-lists');
	}

	public function cancel()
	{
		redirect('salaries');
	}
}

// End of file salaries.php
// Location: ./application/controllers/salaries.php