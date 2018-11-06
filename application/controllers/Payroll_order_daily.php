<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-CKSagun
 */
class Payroll_order_daily extends MY_Controller {
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('attendance_summary');
        $this->load->model([
            'employment_type_model',
            'employee_model',
            'employee_information_model',
            'daily_time_record_model',
            'attendance_daily_time_record_model',
            'employee_salaries_model',
            'system_config_model',
            'payroll_employee_salary_model',
            'payroll_employee_model',
            'payroll_model'
        ]);
    }

    public function index()
    {
        $daily_payroll = $this->payroll_model->get_many_by(['validity_status' => 1, 'cutoff' => 5]);

        $this->data = array(
            'page_header' => 'Daily Payroll Order',
            'daily_payroll' => $daily_payroll
        );

        $this->load_view('pages/payroll-order-index-daily');
    }

    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    public function load_form_generate()
    {
        $this->data = array(
            'page_header' => 'Daily Payroll Order'
        );

        $this->load->view('modals/modal-payroll-order-daily');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */

    public function generate_payroll_daily_workers()
    {
        $post = $this->input->post();

          $payroll_data = array(
            'start_date' => $post['date_start'],
            'end_date'   => $post['date_end'],
            'cutoff'     => 5 // TODO: 5 for daily
        );

        $payroll_id = $this->payroll_model->insert($payroll_data);

        if ( ! $payroll_id) {
            $this->session->set_flashdata('error', 'Unable to create new record on payroll table. Please try again.');
            redirect('payroll_order_daily');
        }

        $params['payroll_id'] = $payroll_id;

        $daily_workers = $this->employee_information_model->get_employee_details('get_many_by', ['employment_type_id' => 2]);
        $working_days_monthly = $this->system_config_model->get_details('get_by', ['id' => 1]);

        $computed_salary = 0;
        $count_no_of_days_entered = 0;
        $payroll_employee_daily = array();

        foreach ($daily_workers as $key => $daily_worker) {
            
            $dtr = $this->attendance_daily_time_record_model->get_works_entered('get_many_by', [
                'date >=' => $post['date_start'],
                'date <=' => $post['date_end'],
                'employee_id' => $daily_worker['employee_id']
            ]);

            $count_no_of_days_worked = count($dtr);

            $salary = $this->employee_salaries_model->get_details('get_by', ['employee_id' => $daily_worker['employee_id']]);

            $computed_salary = $salary['daily_rate'] *  $count_no_of_days_worked;
  
            $payroll_employee_daily[] = array(
                'employee_id' => $daily_worker['employee_id'],
                'payroll_id' => $payroll_id,
                'salary' => $salary['daily_rate'],
                'net_pay' => $computed_salary,
                'gross' => $computed_salary,
                'company_id' => $daily_worker['company_id']
            );
        }

        $payroll_employee_id = $this->payroll_employee_model->insert_many($payroll_employee_daily);

        $daily_salaries = $this->payroll_employee_model->get_details('get_many_by', [
            'payroll_id' => $payroll_id,
            'net_pay !=' => 0.00
        ]);

        $salary_sum = 0;
        foreach ($daily_salaries as $key => $daily_salary) {
            $salary_sum += $daily_salary['current_salary'];
        }

        $this->data = array(
            'page_header' => 'Daily Payroll Order',
            'daily_salaries' => $daily_salaries,
            'salary_sum' => $salary_sum
        );

        // $this->load_view('pages/payroll-order-index-daily');
        redirect('payroll_order_daily/details/' . $payroll_id);
    }

    public function details($id)
    {
        $user = $this->ion_auth->user()->row();
        $payroll = $this->payroll_model->get_payroll_by(['payroll.id' => $id]);
        $payroll_employees = $this->payroll_employee_model->get_payroll_employee_data([
            'payroll_employees.payroll_id' => $id,
            'payroll_employees.net_pay > ' => 0.00    
        ]);
        $processedBy = $user->first_name . ' ' . $user->last_name;

        $total_net_pay = 0;

        $this->data = array(
            'page_header' => 'Daily Payroll Details',
            'payroll'      => $payroll,
            'payroll_employees' => $payroll_employees,
            'total_net_pay' => $total_net_pay,
            'processedBy' => $processedBy
        
        );
        $this->load_view('pages/payroll-order-daily-details');
    }
}
// End of file Payroll_order.php
// Location: ./application/controller/Payroll_order.php