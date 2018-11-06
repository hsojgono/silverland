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

class Loan_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['loan_type_model']);
	}

	function index()
	{
		$company_id = $this->ion_auth->user()->row()->company_id;
		$loan_types = $this->loan_type_model->get_details('get_many_by', ['company_id' => $company_id]);

		$this->data = array(
			'page_header' => 'Loan Type Management',
			'loan_types' => $loan_types,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/loan-type-lists');
	}

	function add()
	{
		$this->data = array(
			'page_header' => 'Loan Type Management',
			'active_menu' => $this->active_menu,
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('loan_type_add'));
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('loan_type_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_loan_type',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);
			$data['name'] = strtoupper($data['name']);
			$loan_type_id = $this->loan_type_model->insert($data);

			if ( ! $loan_type_id) {
				$this->session->set_flashdata('failed', 'Failed to add new loan type.');
				redirect('loan_types');
			} else {
				$this->session->set_flashdata('success', 'Successfully added '. $data['name']);
				redirect('loan_types');
			}
		}
		$this->load_view('forms/loan-type-add');
	}

	function details($id)
	{
		$bank = $this->bank_model->get_bank_by(['banks.id' => $id]);

		$this->data = array(
			'page_header' => 'Bank Details',
			'bank'     	  => $bank,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/bank-details');
	}

	public function edit($id)
	{
		$loan_type = $this->loan_type_model->get_by(['id' => $id]);

		$this->data = array(
			'page_header' => 'Loan Type Management',
			'loan_type' => $loan_type,
			'active_menu' => $this->active_menu,
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('loan_type_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('loan_type_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key' 	  => 'edit_loan_type',
			// 	'old_data'	  => $loan_type,
			// 	'new_data'    => $data
			// ]);
			$data['name'] = strtoupper($data['name']);
			$loan_type_id = $this->loan_type_model->update($id, $data);

			if ( ! $loan_type_id) {
				$this->session->set_flashdata('failed', 'Failed to update loan type.');
				redirect('loan_types');
			} else {
				$this->session->set_flashdata('success', $data['name'] .' successfully updated!');
				redirect('loan_types');
			}
		}
		$this->load_view('forms/loan-type-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_loan_type = $this->loan_type_model->get_by(['id' => $id]);
        $data['edit_loan_type'] = $edit_loan_type;
        $this->load->view('modals/modal-update-loan-type', $data);
    }

    public function update_status($id)
    {
        $loan_type = $this->loan_type_model->get_by(['id' => $id]);
        $data['loan_type'] = $loan_type;
        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                $result = $this->loan_type_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->loan_type_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $loan_type['name'].' successfully '.$post['mode'].'d!');
                 redirect('loan_types');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$loan_type['name'].'!');
                redirect('loan_types');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-loan-type-status', $data);
        }
    }
}
