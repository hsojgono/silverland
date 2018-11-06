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
class Salary_grades extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'company_model',
			'salary_grade_model',
			'salary_model'
		]);
	}

	public function index()
	{
		$salary_grades = $this->salary_grade_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header'   => 'Salary Grades Management',
			'salary_grades' => $salary_grades,
			'show_modal'    => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/salary-grade-lists');
	}

	public function details()
	{
		$salary_grade_id = $this->uri->segment(3);
		$salary_grade = $this->salary_grade_model->get_details('get_by', ['salary_grades.id' => $salary_grade_id]);

		$data['modal_title']  = 'Salary Grades Management';
		$data['salary_grade'] = $salary_grade;

		$this->load->view('modals/modal-salary-grade-details', $data);
	}

	public function activate()
	{
		$salary_grade_id = $this->uri->segment(3);
		$salary_grade    = $this->salary_grade_model->get_details('get_by', ['salary_grades.id' => $salary_grade_id]);
		$update          = $this->salary_grade_model->update($salary_grade_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated salary grade ' . $salary_grade['grade_code']);
			redirect('salary_grades');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate salary grade ' . $salary_grade['grade_code']);
			redirect('salary_grades');
		}
	}

	public function deactivate()
	{
		$salary_grade_id = $this->uri->segment(3);
		$salary_grade    = $this->salary_grade_model->get_details('get_by', ['salary_grades.id' => $salary_grade_id]);
		$update    = $this->salary_grade_model->update($salary_grade_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $salary_grade['grade_code'] . 'successfully Deactivated ');
			redirect('salary_grades');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate salary grade' . $salary_grade['grade_code']);
			redirect('salary_grades');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$salary_grade_id = $this->uri->segment(4);
		$salary_grade    = $this->salary_grade_model->get_details('get_by', ['salary_grades.id' => $salary_grade_id]);
		$modal_message = "You're about to <strong>" . $mode . "</strong> salary grade " . $salary_grade['grade_code']; 

		$data = array(
			'url' 			=> 'salary_grades/' . $mode . '/' . $salary_grade_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
		$salary_grades = $this->salary_grade_model->get_all(['active_status' => 1]);
		$companies = $this->company_model->get_all(['active_status' => 1]);
		$company_id = $this->ion_auth->user()->row()->company_id;
		$company_name = $this->company_model->get_company_by(['companies.id' => $company_id]);

		$data = array(
			'modal_title' => 'Add Salary Grade',
			'salary_matrices' => $salary_grades,
			'companies' => $companies,
			'company_id' => $company_id,
			'company_name' => $company_name
		);
		
		$this->load->view('modals/modal-add-salary_grade', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('salary_grade_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('salary_grade_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->salary_grade_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added salary.');
				redirect('salary_grades');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add Salary Grade.');
				redirect('salary_grades');
			}
		}
	}

	public function edit()
	{
		$salary_grade_id = $this->uri->segment(3);
		$salary_grade    = $this->salary_grade_model->get_details('get_by', ['salary_grades.id' => $salary_grade_id]);
		$salary_grades  = $this->salary_grade_model->get_details('get_many_by', ['salary_grades.active_status' => 1]);

		$this->data = array(
			'page_header'     => 'Salary Management',
			// show modal 
			'show_modal'      => TRUE,
			'modal_title'  	  => 'Edit salary',
			'modal_file_path' => 'modals/modal-edit-salary-grade',
			'salary' 		  => $salary_grade,
			'salary_grades'	  => $salary_grades,
			'salary_id' 	  => $salary_grade_id
		);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->salary_grade_model->update($salary_grade_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated salary ' . $salary_grade['grade_code']);
				redirect('salary_grades');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update salary ' . $salary_grade['grade_code']);
				redirect('salary_grades');
			}
		}

		 $this->load_view('pages/salary-grade-lists');
	}

	public function cancel()
	{
		redirect('salary_grades');
	}
}

// End of file Salary_grades.php
// Location: ./application/controllers/Salary_grades.php