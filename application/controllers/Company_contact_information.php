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
class Company_contact_information extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
        
        $this->load->library('audit_trail');
		$this->load->model([
			'company_model',
			'company_contact_information_model',
		]);
	}

	public function index()
	{
		$company_contact_information = $this->company_contact_information_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Company Contact Information Management',
			'company_contact_information' => $company_contact_information,
			'show_modal' => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/company_contact_information-lists');
	}

	public function details()
	{
		$company_contact_information_id = $this->uri->segment(3);
		$company_contact_info = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.id' => $company_contact_information_id]);

		$data['modal_title'] = 'Company Contact Information Management';
		$data['company_contact_info'] = $company_contact_info;

		$this->load->view('modals/modal-company_contact_information-details', $data);
	}

	public function activate()
	{
		$company_contact_information_id = $this->uri->segment(3);
		$company_contact_info    = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.id' => $company_contact_information_id]);
		$update    = $this->company_contact_information_model->update($company_contact_information_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated company contact information ');
			redirect('company_contact_information');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate company contact information ');
			redirect('company_contact_information');
		}
	}

	public function deactivate()
	{
		$company_contact_information_id = $this->uri->segment(3);
		$company_contact_info    = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.id' => $company_contact_information_id]);
		$update    = $this->company_contact_information_model->update($company_contact_information_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Deactivated company contact information ');
			redirect('company_contact_information');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate company contact information ');
			redirect('company_contact_information');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$company_contact_information_id = $this->uri->segment(4);
		$company_contact_info    = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.id' => $company_contact_information_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> company contact information "; 

		$data = array(
			'url' 			=> 'company_contact_information/' . $mode . '/' . $company_contact_information_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
        $company_contact_information = $this->company_contact_information_model->get_all(['company_contact_information.active_status' => 1]);
        $companies = $this->company_model->get_company_all();

		$data = array(
			'modal_title' => 'Add Company Contact Information',
            'company_contact_information' => $company_contact_information,
            'companies' => $companies
		);
		
		$this->load->view('modals/modal-add-company_contact_information', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('company_contact_information_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('company_contact_information_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->company_contact_information_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added company contact information.');
				redirect('company_contact_information');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add company contact information.');
				redirect('company_contact_information');
			}
		}
	}

	public function edit()
	{
		$company_contact_information_id = $this->uri->segment(3);
		$company_contact_information  = $this->company_contact_information_model->get_details('get_many_by', ['company_contact_information.active_status' => 1]);
        $company_contact_info = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.id' => $company_contact_information_id]);
        $companies = $this->company_model->get_all();

		$this->data = array(
			'page_header'     => 'Company Contact Information Management',
			'company_contact_information_id' => $company_contact_information_id,
			'company_contact_information' => $company_contact_information,
            'company_contact_info' => $company_contact_info,
            'companies' => $companies,
			// show modal 
			'show_modal'      => TRUE,
			'modal_title'  	  => 'Edit Company Contact Information',
			'modal_file_path' => 'modals/modal-edit-company_contact_information'
        );

		$post = $this->input->post();
        $data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->company_contact_information_model->update($company_contact_information_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated company contact information ');
				redirect('company_contact_information');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update company contact information ');
				redirect('company_contact_information');
			}
		}

		 $this->load_view('pages/company_contact_information-lists');
	}

	public function cancel()
	{
		redirect('company_contact_information');
	}
}

// End of file company_contact_information.php
// Location: ./application/controllers/company_contact_information.php