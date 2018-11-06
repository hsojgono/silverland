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
class Company_addresses extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
        
        $this->load->library('audit_trail');
		$this->load->model([
            'company_model',
            'location_model',
			'company_address_model'
		]);
	}

	public function index()
	{
        $company_addresses = $this->company_address_model->get_details('get_all', ['company_addresses.active_status' => 1]);

		$this->data = array(
			'page_header' => 'Company Addresses Management',
			'company_addresses' => $company_addresses,
			'show_modal' => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/company_address-lists');
	}

	public function details()
	{
		$company_address_id = $this->uri->segment(3);
		$company_address = $this->company_address_model->get_details('get_by', ['company_addresses.id' => $company_address_id]);

		$data['modal_title'] = 'Company Addresses Management';
		$data['company_address'] = $company_address;

		$this->load->view('modals/modal-company_address-details', $data);
	}

	public function activate()
	{
		$company_address_id = $this->uri->segment(3);
		$company_address    = $this->company_address_model->get_details('get_by', ['company_addresses.id' => $company_address_id]);
		$update    = $this->company_address_model->update($company_address_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated company address ' . $company_address['monthly_company_address']);
			redirect('company_addresses');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate company address ' . $company_address['monthly_company_address']);
			redirect('company_addresses');
		}
	}

	public function deactivate()
	{
		$company_address_id = $this->uri->segment(3);
		$company_address    = $this->company_address_model->get_details('get_by', ['company_addresses.id' => $company_address_id]);
		$update    = $this->company_address_model->update($company_address_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $company_address['monthly_company_address'] . 'successfully Deactivated company address ');
			redirect('company_addresses');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate company address ' . $company_address['monthly_company_address']);
			redirect('company_addresses');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$company_address_id = $this->uri->segment(4);
		$company_address    = $this->company_address_model->get_details('get_by', ['company_addresses.id' => $company_address_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> company address "; 

		$data = array(
			'url' 			=> 'company_addresses/' . $mode . '/' . $company_address_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
        $companies = $this->company_model->get_company_all();
        $locations = $this->location_model->get_details('get_all', ['active_status' => 1]);

		// $this->data = array(
        //     'modal_title' => 'Set Company Address',
		// 	// 'active_menu' => $this->active_menu,
        //     // 'page_header' => 'Company Address Management',
        //     'companies' => $companies,
        //     'locations' => $locations
        // );
		$data = array(
            'modal_title' => 'Set Company Address',
			// 'active_menu' => $this->active_menu,
            // 'page_header' => 'Company Address Management',
            'companies' => $companies,
            'locations' => $locations
        );
        // dump($locations);exit;
        
        // $this->load_view('forms/company_address-add');
		$this->load->view('modals/modal-add-company_address', $data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('company_address_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('company_address_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_company_address',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->company_address_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added company address.');
				redirect('company_addresses');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add company address.');
				redirect('company_addresses');
			}
		}
	}

	public function edit()
	{
		$company_address_id = $this->uri->segment(3);
		$company_address    = $this->company_address_model->get_details('get_by', ['company_addresses.id' => $company_address_id]);
        $company_addresses  = $this->company_address_model->get_details('get_many_by', ['company_addresses.active_status' => 1]);
        $companies = $this->company_model->get_company_all();
        $locations = $this->location_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header'        => 'Company Addresses Management',
			'company_address'    => $company_address,
			'company_addresses'  => $company_addresses,
            'company_address_id' => $company_address_id,
            'companies'          => $companies,
            // 'locations'          => $locations,
			// show modal 
			'show_modal'         => TRUE,
			'modal_title'  	     => 'Edit Company Address',
			'modal_file_path'    => 'modals/modal-edit-company_address'
		);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->company_address_model->update($company_address_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated company address ');
				redirect('company_addresses');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update company address ');
				redirect('company_addresses');
			}
		}
		 $this->load_view('pages/company_address-lists');
	}

	public function cancel()
	{
		redirect('company_addresses');
	}
}

// End of file company_addresses.php
// Location: ./application/controllers/company_addresses.php