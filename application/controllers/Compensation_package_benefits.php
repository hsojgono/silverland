<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Compensation_packages_benefits extends MY_Controller {

	private $active_menu = 'System';

	/**
	 * Some description here
	 *
	 * @param   param
	 * @return  return
	 */

	function __construct()
	{
		parent::__construct();
        $this->load->library('audit_trail');
        $this->load->model([
           'compensation_package_benefit_model',
           'benefit_model',
           'compensation_package_model'
        ]);
	}

	public function index()
	{
		// TODO: get all companies records from database order by name ascending
			// TODO: load company model
			// TODO: load view & past the retrieved data from model
        $companies = $this->company_model->get_company_all();

		$this->data = array(
			'page_header' => 'Company Management',
			'companies'   => $companies,
			'active_menu' => $this->active_menu,
		);

		$this->load_view('pages/company-lists');
	}

	public function add()
	{
        if ( ! $this->ion_auth_acl->has_permission('add_company'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
        }
        
        $rdos = $this->revenue_district_office_model->get_details('get_many_by', ['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Company Management',
            'rdos' => $rdos,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_add'));
        $company_address = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_address_add'));
        $company_govt_id_numbers = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_government_id_numbers_add'));
        $company_information = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_information_add'));
        $company_contact_information = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_contact_information_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('company_add') == TRUE)
        {
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_company',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

            $company_id = $this->company_model->insert($data);

            //This line would insert to company addresses
            $company_address['company_id'] = $company_id;
            $company_address_id = $this->company_address_model->insert($company_address);

            //This line would insert to company government id numbers
            $company_govt_id_numbers['company_id'] = $company_id;
            $company_govt_id_number_id = $this->company_government_id_number_model->insert($company_govt_id_numbers);

            //This line would insert to company contact information
            $company_contact_information['company_id'] = $company_id;
            $company_contact_information_id = $this->company_contact_information_model->insert($company_contact_information);

            //This line would insert to company information
            $company_information['company_id'] = $company_id;
            $company_information['company_address_id'] = $company_address_id;
            $company_information['company_contact_id'] = $company_contact_information_id;
            $company_information['government_id_numbers_id'] = $company_govt_id_number_id;
            $this->company_information_model->insert($company_information);

            if ( ! $company_id) {
                $this->session->set_flashdata('failed', 'Failed to add new company.');
                redirect('companies');
            } else {
                $this->session->set_flashdata('success', 'Successfully saved new company.');
                redirect('companies');
            }
        }
        $this->load_view('forms/company-add');
	}

    public function edit($company_id)
    {
		if ( ! $this->ion_auth_acl->has_permission('edit_company'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
		}

        $company   = $this->company_model->get_details('get_by', ['companies.id' => $company_id]);
        $company_address = $this->company_address_model->get_details('get_by', ['company_addresses.company_id' => $company_id]);
        $company_govt_number = $this->company_government_id_number_model->get_details('get_by', ['company_id' => $company_id]);
        $company_contact = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.company_id' => $company_id]);
        $rdos = $this->revenue_district_office_model->get_details('get_many_by', ['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Company Management',
            'company'     => $company,
            'company_address' => $company_address,
            'company_govt_number' => $company_govt_number,
            'company_contact' => $company_contact,
            'rdos' => $rdos,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_edit'));
        $company_address = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_address_edit'));
        $company_govt_id_numbers = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_government_id_numbers_edit'));
        $company_information = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_information_edit'));
        $company_contact_information = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('company_contact_information_edit'));        

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('company_edit') == TRUE)
        {
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key' 	  => 'edit_company',
			// 	'old_data'	  => $company,
			// 	'new_data'	  => $data
            // ]);
            
            $company_id = $this->company_model->update($company_id, $data);

            //This line would insert to company addresses
            // $company_address['company_id'] = $company_id;
            $company_address_id = $this->company_address_model->update($company_id, $company_address);

            //This line would insert to company government id numbers
            // $company_govt_id_numbers['company_id'] = $company_id;
            $company_govt_id_number_id = $this->company_government_id_number_model->update($company_id, $company_govt_id_numbers);

            //This line would insert to company contact information
            // $company_contact_information['company_id'] = $company_id;
            $company_contact_information_id = $this->company_contact_information_model->update($company_id, $company_contact_information);

            if ( ! $company_id) {
                $this->session->set_flashdata('failed', 'Failed to update company.');
                redirect('companies');
            } else {
                $this->session->set_flashdata('success', 'Company successfully updated!');
                redirect('companies');
            }
        }
        $this->load_view('forms/company-edit');
    }

    public function details($id)
    {
        $company   = $this->company_model->get_details('get_by', ['companies.id' => $id]);
        $branches  = $this->branch_model->get_many_branch_by(['companies.id' => $id]);
        $employees = $this->employee_model->get_many_employee_by(['company_id' => $id]);

        $company_address = $this->company_address_model->get_details('get_by', ['company_addresses.company_id' => $id]);
        $company_govt_number = $this->company_government_id_number_model->get_details('get_by', ['company_id' => $id]);
        $company_contact = $this->company_contact_information_model->get_details('get_by', ['company_contact_information.company_id' => $id]);
        
        $this->data = array(
            'page_header' => 'Company Details',
            'company'     => $company,
            'branches'    => $branches,
            'employees'   => $employees,
            'company_address' => $company_address,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/company-details');
    }

    public function edit_confirmation($id)
    {
        $company_data = $this->company_model->get_by(['id' => $id]);
        $data['company_data'] = $company_data;

        $this->load->view('modals/modal-update-company', $data);
    }

    public function update_status($id)
    {
        $company_data = $this->company_model->get_by(['id' => $id]);
        $data['company_data'] = $company_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                // dump('De-activating...');
                $result = $this->company_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                // dump('Activating...');
                $result = $this->company_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $company_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('companies');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$company_data['name'].'!');
                redirect('companies');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-company-status', $data);
        }
    }
}
