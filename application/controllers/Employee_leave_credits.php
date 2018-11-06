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

class Employee_leave_credits extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'employee_leave_credit_model',
			'employee_model',
			'employee_information_model',
			'employee_employment_information_model',
			'company_model',
			'leave_type_model'
		]);
	}

	function post_full_name($id)
	{
        $employee = $this->employee_model->get_details('get_by',[
			'id' => $id
		]);

		if(strlen($employee['middle_name']) > 1)
		{

			$middle_initial = substr($employee['middle_name'], 0, 1);
			$middle_initial .= '.';
		}
		else
		{
			$middle_initial = $employee['middle_name'];
		}

        // get full_name
		$employee_full_name = '';
		$employee_full_name = $employee['last_name'].', ' . $employee['first_name'].' '. $middle_initial;

		return $employee_full_name;
	}

	function index()
	{
		$employees = $this->employee_leave_credit_model->get_details('get_many_by',[
			'attendance_leave_types.active_status' => 1
		]);
		$companies = $this->company_model->get_many_company_by([
			'active_status' => 1
		]);

		$this->data = array(
			'page_header' => 'Leave Credits Management',
			'employees' => $employees,
			'companies' => $companies,
			'active_menu' => $this->active_menu
		);
		
		$this->load_view('pages/employee_leave_credit-lists');
	}

	function add_form()
	{
        $employee_leave_credits = $this->employee_leave_credit_model->get_details('get_many_by',[
			'employees.active_status' => 1
		]);

        $employees = $this->employee_model->get_details('get_many_by',[
			'active_status' => 1
		]);

		$companies = $this->company_model->get_many_company_by([
			'active_status' => 1
		]);

		$leave_types = $this->leave_type_model->get_leaves('get_many_by',[
			'active_status' => 1
		]);

		$this->data = array(
			'page_header' => 'Leave Credits Management',
			'method_name' => 'Add Employee Leave',
			'companies' => $companies,
			'employees' => $employees,
			'leave_types' => $leave_types,
			'active_menu' => $this->active_menu
		);
		
		$this->load_view('forms/employee_leave_credit-add');
	}

	function add()
	{
		$post = $this->input->post();

		$data = array(
			'employee_id' => $post['employee'],
			'position_leave_credit_id' => 0,
			'attendance_leave_type_id' => $post['leave_type'],
			'balance' => $post['balance'],
			'company_id' => $post['company']
		);

		$employee_leave_credit = $this->employee_leave_credit_model->get_details('get_by', [
			'employee_leave_credits.employee_id' => $data['employee_id'],
			'attendance_leave_types.id' => $data['attendance_leave_type_id']
		]);
		
		if ($this->form_validation->run('employee_leave_credit_add') == TRUE)
		{
			if(! $employee_leave_credit)
			{
				// where leave type does not exist to employee	
				$employee_leave_credit_id = $this->employee_leave_credit_model->insert($data);

				$new_record = $this->employee_leave_credit_model->get_details('get_by', [
					'employee_leave_credits.id' => $employee_leave_credit_id
				]);

				if ( ! $employee_leave_credit_id)
				{
					$this->session->set_flashdata('failed', 'Failed to add new leave credit.');
					redirect('employee_leave_credits');
				}
				else
				{
					$employee_full_name = $this->post_full_name($new_record['elc_employee_id']);

					$this->session->set_flashdata('success', $new_record['leave_type'] . ' has been successfully added to'. $employee_full_name . '.');
					redirect('employee_leave_credits');
				}
			}
			else
			{
				redirect('employee_leave_credits');
			}
		}// end if ($this->form_validation->run('employee_leave_credit_add') == TRUE)

		$this->load_view('pages/employee_leave_credit-add');
	}

	function details($id)
	{
		$employee = $this->employee_employment_information_model->get_details('get_by',['employee.id' => $id]);
		$employee_leave_credits = $this->employee_leave_credit_model->get_details('get_many_by', [
			'employee_leave_credits.employee_id' => $employee['employee_id']
		]);

		$this->data = array(
			'page_header' => 'Employee Leave Credit Details',
			'employee' => $employee,
			'employee_leave_credits' => $employee_leave_credits,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/employee_leave_credit-details');
	}

	public function edit($id)
	{
		// get specific employee_leave_credit based on the id
		$employee_leave_credit = $this->employee_leave_credit_model->get_details('get_by',[
			'employee_leave_credits.id' => $id
		]);

		$post = $this->input->post();
		
		$data = array(
			'balance' => $post['balance']
		);

		if ($this->form_validation->run('employee_leave_credit_edit') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key' 	  => 'edit_leave_credit',
			// 	'old_data'	  => $employee_leave_credit,
			// 	'new_data'    => $data
			// ]);

			$employee_leave_credit_id = $this->employee_leave_credit_model->update($id, $data);

			if ( ! $employee_leave_credit_id) {
				$this->session->set_flashdata('failed', 'Failed to update leave balance.');
				redirect('employee_leave_credits');
			} else {
				$this->session->set_flashdata('success', 'Leave balance of ' .$employee_leave_credit['full_name'].' was successfully updated!');
				redirect('employee_leave_credits');
			}
		}
		$this->load_view('pages/employee_leave_credit-lists');
	}

    public function edit_form($id)
    {
        $employee_leave_credit = $this->employee_leave_credit_model->get_details('get_by',[
			'employee_leave_credits.id' => $id
		]);

		$data = array(
			'modal_header' => 'Edit Leave Credit',
			'employee_leave_credit' => $employee_leave_credit,
			'employee_leave_credit_id' => $id,
			'active_menu' => $this->active_menu
		);

		// $this->load_view('modals/modal-edit-employee_leave_credit');		
		$this->load->view('modals/modal-edit-employee_leave_credit', $data);
    }

	public function post_employees()
	{
		$company_id = $this->input->post('company_id');

		if((! is_numeric($company_id)) || $company_id == '')
		{
			$select_employees = '';
			$select_employees .= '<option value=""> NO DATA </option>';
		}
		else
		{
			$employees = $this->employee_model->get_many_by([
				'company_id' => $company_id, 
				'active_status' => 1
			]);

			$select_employees = '';
			$select_employees .= '<option value=""> -- Select Employee -- </option>';

			foreach ($employees as $employee) 
			{
				$select_employees .= "<option value='" . $employee['id'] . "'>" . $employee['full_name'] . "</option>";
			}
		}
		echo json_encode($select_employees);
	}

	public function post_leave_types()
	{
		$company_id = $this->input->post('company_id');
		$employee_id = $this->input->post('employee_id');

		$select_leave_types = '';

		if((! is_numeric($employee_id)) || $employee_id == '')
		{
			$select_leave_types .= '<option value=""> NO DATA </option>';
		}
		else
		{
			$employee_leave_types = $this->employee_leave_credit_model->get_details('get_many_by',[
				'employee_leave_credits.employee_id' => $employee_id
			]);

			$employee_leave_type_ids = array_column($employee_leave_types, 'leave_type_id');

			$leave_types = $this->leave_type_model->get_many_by([
				'company_id' => $company_id,
				'active_status' => 1,
				'id NOT' => $employee_leave_type_ids
			]);

			$select_leave_types .= '<option value=""> -- Select Leave Type -- </option>';

			foreach ($leave_types as $index => $leave_type) 
			{
				$select_leave_types .= "<option value='" . $leave_type['id'] . "'>" . strtoupper($leave_type['name']) . "</option>";
			}
		}
		echo json_encode($select_leave_types);

	}
}