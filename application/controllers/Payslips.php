<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-RDaludado
 */
class Payslips extends MY_Controller {
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model([
			'payroll_model',
			'employee_model',
			'company_model',
			'payroll_employee_model',
			'department_model',
			'position_model',
			'employee_government_id_number_model',
			'deduction_model',
			'tax_exemption_status_model',
			'employee_deduction_model',
			'leave_model',
			'leave_type_model',
			'employee_benefits_model'
		]);
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function index()
	{
        $user   = $this->ion_auth->user()->row();       
		$payslips = $this->payroll_employee_model->get_details('get_all', '');

		if ( ! $this->ion_auth_acl->has_permission('view_payslips'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('employees/informations/' . $user->employee_id);
		}

		$this->data = array(
            'page_header' 	=> 'Payslip Management',
            'notification' 	=> array("sound"=>false),
			'payslips' 	    => $payslips
		);
		$this->load_view('pages/payslip-lists');
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function confirmation()
	{
        $url = $this->uri->segment(3);
        $id = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
        $payslip = $this->payroll_model->get($id);
        
        $type = 'payslip named <strong>' . $payslip['name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'payslips/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
		);

		$this->load->view('modals/modal-confirmation', $data);     
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function view($payroll_id)
	{
		$employee_id = $this->uri->segment(3);

		$position 	= $this->position_model->get_position(['employee_information.employee_id' => $employee_id]);
		$department = $this->department_model->get_department(['employee_information.employee_id' => $employee_id]);

		$payslips 	= $this->payroll_employee_model->get_details('get_many_by', array('
			payroll_employees.employee_id' => $employee_id
		));
		$employee_government_id_numbers = $this->employee_government_id_number_model->get_details('get_by', array('
			employee_government_id_numbers.employee_id' => $employee_id
		));
		$employees = $this->employee_model->get_by(['id' => $employee_id]);

		$tax_exemption_status = $this->tax_exemption_status_model->get_details('get_by', array('
			employees.tax_exemption_status_id' => $employees['tax_exemption_status_id']
		));
        $leave_balances = $this->employee_leave_credit_model->get_leave_credits_by(['
			employee_leave_credits.employee_id' => $employee_id
		]);
		$employee_deductions = $this->employee_deduction_model->get_employee_deduction_by([
			'employee_deductions.employee_id' => $employee_id
		]);
		$employee_benefits = $this->employee_benefits_model->get_employee_benefits_by([
			'employee_benefits.employee_id' => $employee_id
		]);

		$this->data = array(
            'page_header' 						=> 'Payslip View',
            'notification' 						=> array("sound"=>false),
			'payslips' 							=> $payslips, 
			'department'    					=> $department,
			'position'							=> $position,
			'employee_government_id_numbers'	=> $employee_government_id_numbers,
			'tax_exemption_status'				=> $tax_exemption_status,
			'leave_balances'					=> $leave_balances,
			'employee_deductions'				=> $employee_deductions,
			'employee_benefits'					=> $employee_benefits
			// 'tax_exemption_status'				=> $tax_exemption_status
		);
		$this->load_view('forms/payslip-view');

	}
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function activate()
	{
		$object_id = $this->uri->segment(3);
		// code here...
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function deactivate()
	{
		$object_id = $this->uri->segment(3);
		// code here...
	}
}
// End of file Payslips.php
// Location: ./application/controller/Payslips.php