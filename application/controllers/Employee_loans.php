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

class Employee_loans extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
            'loan_type_model',
            'employee_loan_model',
			'employee_model',
			'employee_information_model'
        ]);
	}

	function index()
	{		
		$user = $this->ion_auth->user()->row();

		// if ( ! $this->ion_auth_acl->has_permission('view_employee_loans'))
		// {
		// 	$this->session->set_flashdata('failed', 'You have no permission to access this module');
		// 	redirect('employees/informations/' . $user->employee_id);
		// }c

		$employee_loans = $this->employee_loan_model->get_details('get_many_by', [
			// 'employee_loans.active_status' => 1,
			'employee_loans.approval_status' => 1
		]);

		$for_approvals = $this->employee_loan_model->get_details('get_many_by', [
			'employee_loans.active_status' => 1,
			'employee_loans.approval_status' => 2,
			'employee_loans.approver_id' => $user->employee_id
		]);

		$total_pending = $this->employee_loan_model->count_by([
            'approval_status' => 2, 
            'approver_id' => $user->employee_id
        ]); 

		$this->data = array(
			'page_header' => 'Employee Loans Management',
            'active_menu' => $this->active_menu,
			'employee_loans' => $employee_loans,
			'total_pending' => $total_pending,
			'for_approvals' => $for_approvals
		);
		$this->load_view('pages/employee-loan-lists');
	}
	
	public function add()
	{
		$user = $this->ion_auth->user()->row();

		// if ( ! $this->ion_auth_acl->has_permission('add_employee_loan'))
		// {
		// 	$this->session->set_flashdata('failed', 'You have no permission to access this module');
		// 	redirect('employees/informations/' . $user->employee_id);
		// }
		
		$employees = $this->employee_model->get_details('get_many_by', ['active_status' => 1]);
		$loan_types = $this->loan_type_model->get_details('get_many_by', [
			'active_status' => 1,
			'company_id' => $user->company_id
		]);

		$this->data = array(
			'page_header' => 'Employee Loans Management',
            'active_menu' => $this->active_menu,
			'employees' => $employees,
			'loan_types' => $loan_types
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_loan_add'));
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('employee_loan_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_bank',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);
			
			$approver = $this->employee_information_model->get_by(['employee_id' => $data['employee_id']]);

			$data['remaining_term'] = $data['months_to_pay'];
			$data['balance'] = $data['total_amount'];
			$data['approval_status'] = 2;
			$data['approver_id'] = $approver['approver_id'];

			$loan_id = $this->employee_loan_model->insert($data);

			if ( ! $loan_id) {
				$this->session->set_flashdata('failed', 'Failed to add new loan.');
				redirect('employee_loans');
			} else {
				$this->session->set_flashdata('success', 'Loan successfully saved');
				redirect('employee_loans');
			}
		}
		$this->load_view('forms/employee-loan-add');
	}

	public function edit($id)
	{
		$user = $this->ion_auth->user()->row();

		// if ( ! $this->ion_auth_acl->has_permission('add_employee_loan'))
		// {
		// 	$this->session->set_flashdata('failed', 'You have no permission to access this module');
		// 	redirect('employees/informations/' . $user->employee_id);
		// }	

		$loan = $this->employee_loan_model->get_details('get_by', ['employee_loans.id' => $id]);
		$employees = $this->employee_model->get_details('get_many_by', ['active_status' => 1]);
		$loan_types = $this->loan_type_model->get_details('get_many_by', [
			'active_status' => 1,
			'company_id' => $user->company_id
		]);

		$this->data = array(
			'page_header' => 'Employee Loans Management',
            'active_menu' => $this->active_menu,
			'employees' => $employees,
			'loan_types' => $loan_types,
			'loan' => $loan
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employee_loan_add'));
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('employee_loan_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key' 	  => 'edit_bank',
			// 	'old_data'	  => $bank,
			// 	'new_data'    => $data
			// ]);

			$loan_id = $this->employee_loan_model->update($id, $data);

			if ( ! $loan_id) {
				$this->session->set_flashdata('failed', 'Failed to update employee loan.');
				redirect('employee_loans');
			} else {
				$this->session->set_flashdata('success', 'Employee loan successfully updated!');
				redirect('employee_loans');
			}
		}

		$this->load_view('forms/employee-loan-edit');
	}

	public function get_loan_interest()
	{
		$loan_type_id = $this->input->post('loan_type_id');
		$loan_interest = $this->loan_type_model->get_by(['id' => $loan_type_id]);

		$data['loan_interest_per_month'] = array('interest_per_month' => $loan_interest['interest_per_month']);
		echo json_encode($data);
	}

	public function confirmation()
    {
        $mode = $this->uri->segment(3);
		$employee_loan_id = $this->uri->segment(4);
        $employee_loan = $this->employee_loan_model->get_details('get_by', ['employee_loans.id' => $employee_loan_id]);
        
		$modal_message = "You're about to <strong>" . $mode . "</strong> the loan of " . $employee_loan['full_name']; 

		$data = array(
			'url' 			=> 'employee_loans/' . $mode . '/' . $employee_loan_id,
			'modal_title' 	=> ucfirst($mode) . '?',
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}
	
	public function approve()
	{
        $user = $this->ion_auth->user()->row();
        $employee_loan_id = $this->uri->segment(3);
        $employee_loan = $this->employee_loan_model->get_details('get_by', ['employee_loans.id' => $employee_loan_id]);
		$update = $this->employee_loan_model->update($employee_loan_id, ['approval_status' => 1]);
		
		if ($update) {
			$this->session->set_flashdata('success', 'Loan successfully approved');
			redirect('employee_loans');
		} else {
			$this->session->set_flashdata('failed', 'Unable to approve loan application');
			redirect('employee_loans');
		}	
	}

	public function reject()
	{
   		$user = $this->ion_auth->user()->row();
        $employee_loan_id = $this->uri->segment(3);
        $employee_loan = $this->employee_loan_model->get_details('get_by', ['employee_loans.id' => $employee_loan_id]);
		$update = $this->employee_loan_model->update($employee_loan_id, ['approval_status' => 0]);
		
		if ($update) {
			$this->session->set_flashdata('success', 'Loan successfully rejected');
			redirect('employee_loans');
		} else {
			$this->session->set_flashdata('failed', 'Unable to reject loan application');
			redirect('employee_loans');
		}	
	}
}