<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-JGono
 */
class Employee_payslips extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'payroll_model',
            'payroll_employee_model',
            'employee_government_id_number_model',
            'tax_exemption_status_model',
            'employee_deduction_model',
            'employee_benefits_model',
            'employee_information_model',
            'payroll_employee_benefit_model',
            'payroll_employee_deduction_model'
        ]);
    }

    function index()
    {
        $user = $this->ion_auth->user()->row();
        $payslips = $this->payroll_employee_model->get_details('get_many_by', ['payroll.validity_status' => 1]);
       
        if (!$this->ion_auth_acl->has_permission('view_payslips')) {
            $this->session->set_flashdata('failed', 'You have no permission to access this module');
            redirect('employees/informations/' . $user->employee_id);
        }

        $this->data = array(
            'page_header' => 'Payslip Management',
            'notification' => array("sound" => false),
            'payslips' => $payslips
        );
        $this->load_view('pages/payslip-lists');        
    }

    function view($payroll_employee_id)
    {
        $payslip = $this->payroll_employee_model->get_details('get_by', ['payroll_employees.id' => $payroll_employee_id]);
        $employee_id = $payslip['employee_id'];

        $employee_information = $this->employee_information_model->get_details('get_by', ['employee_information.employee_id' => $employee_id]);
        $leave_balances = $this->employee_leave_credit_model->get_details('get_many_by', ['employee_leave_credits.employee_id' => $employee_id]);
        
        $deductions = $this->payroll_employee_deduction_model->get_details('get_many_by', [
            'payroll_employee_deductions.employee_id' => $employee_id,
            'payroll_employee_deductions.payroll_employee_id' => $payroll_employee_id
        ]);

        $benefits = $this->payroll_employee_benefit_model->get_with_detail('get_many_by', [
            'payroll_employee_benefits.employee_id' => $employee_id,
            'payroll_employee_benefits.payroll_employee_id' => $payroll_employee_id
        ]);

        //get total earnings
        $total_benefits = array_sum(array_column($benefits, 'amount'));
        $total_earnings = $total_benefits + $payslip['gross'];

        // get total deductions
        $govt_totals = $payslip['current_sss'] + $payslip['current_hdmf'] + $payslip['current_phic'] + $payslip['current_tax'];
        $total_deductions = $payslip['deductions'] + $govt_totals;

        $this->data = array(
            'page_header' => 'Payslip Details',
            'notification' => array("sound" => false),
            'employee_information' => $employee_information,
            'payslip' => $payslip,
            'leave_balances' => $leave_balances,
            'benefits' => $benefits,
            'deductions' => $deductions,
            'total_deductions' => $total_deductions,
            'total_earnings' => $total_earnings
        );
        $this->load_view('pages/employee-payslip-details');     
    }
}
// End of file Payslips.php
// Location: ./application/controller/Payslips.php