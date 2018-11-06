<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-CKSagun
 */
class Payroll_order extends MY_Controller {
 
    private $_payroll_employees;
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
        $this->load->model([
            'payroll_cutoff_model',
            'payroll_model',
            'payroll_employee_model',
            'employee_loan_model',
            'employee_deduction_model',
            'employee_information_model',
            'payroll_employee_deduction_model',
            'payroll_employee_benefit_model'
        ]);

        $this->load->library('attendance_summary');
        $this->load->library('attendance_dtr');
    }

    public function index()
    {
        $payroll_order = $this->payroll_model->get_payroll_all();

        $year = date('Y');

        $this->data = array(
            'page_header' => 'Payroll Order Management',
            'action_header' => 'Generate Payroll',
            'current_year' => $year,
            'payroll_order' => $payroll_order
        );

		$this->load_view('pages/payroll-order-index');
    }

    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    // public function load_form_generate()
    // {
    //     $this->data = array(
    //         'page_header' => 'Payroll Order'
    //     );

    //     $this->load->view('modals/modal-payroll-order');
    // }
 
    function get_payroll_data($posted_data)
    {
        // get cutoff dates information
        $cutoff_dates = $this->payroll_cutoff_model->get_by([
            'cutoff' => $posted_data['cutoff']
        ]);
        
        $start_date = $posted_data['year'] . '-' . $posted_data['month'] . '-' . $cutoff_dates['start_dayofmonth'];
        $start_date = $this->attendance_dtr->get_valid_date($start_date);

        $end_date = $posted_data['year'] . '-' . $posted_data['month'] . '-' . $cutoff_dates['end_dayofmonth'];
        $end_date = $this->attendance_dtr->get_valid_date($end_date);

        $payroll_data = array(
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'cutoff'        => $posted_data['cutoff']
        );

        return $payroll_data;
    }

    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function generate()
    {
        $this->load->model(array(
            'payroll_cutoff_model',
            'payroll_model',
            'payroll_employee_model',
            'payroll_employee_benefit_model',
            'payroll_employee_deduction_model',
            'payroll_employee_hdmf_model',
            'payroll_employee_overtime_model',
            'payroll_employee_phic_model',
            'payroll_employee_salary_model',
            'payroll_employee_sss_model',
            'attendance_summary_model',
            'daily_time_record_model',
            'employee_benefits_model',
            'employee_deduction_model'
        ));

        $posted_data = $this->input->post();
        $payroll_data = $this->get_payroll_data($posted_data);
        
        $this->load->library('salary_computation');

        $payroll_id = $this->payroll_model->insert($payroll_data);

        if ( ! $payroll_id) {
            $this->session->set_flashdata('error', 'Unable to create new record on payroll table. Please try again.');
            redirect('payroll_order');
        }

        // Call Atttendance Summaries function
        $params = array(
           'payroll_id' => $payroll_id,
           'start_date' => $payroll_data['start_date'],
           'end_date' => $payroll_data['end_date']
        );
        $this->attendance_summary->compute_attendance_summary($params);

        // Get all computed attendance summaries earlier
        $attendance_summaries = $this->attendance_summary_model->get_many_by(array('payroll_id' => $payroll_id));
        
        $payroll_employee_details = array();
        
        foreach ($attendance_summaries as $index => $attendance_summary) {
 
            $employee_id = $attendance_summary['employee_id'];
            $employee_data = $this->employee_model->get_by(array('id' => $employee_id));
            
            $payroll_employee_id = $this->payroll_employee_model->insert(array(
                'employee_id' => $employee_id,
                'payroll_id'  => $payroll_id
            ));

            $computed_salary = $this->salary_computation->init(array(
                'payroll_id'          => $payroll_id,
                'employee_id'         => $employee_id,
                'employee_data'       => $employee_data,
                'payroll_employee_id' => $payroll_employee_id
            ));
            
            // create insert function for payroll_employee
            $updated = $this->payroll_employee_model->update_payroll_parameters($payroll_employee_id, $computed_salary);
           
            $this->payroll_employee_sss_model->insert(array(
                'employee_id'           => $employee_id,
                'payroll_employee_id'   => $payroll_employee_id,
                'amount_employee'       => $computed_salary['employee_shares']['sss'],
                'amount_employer'       => $computed_salary['employer_shares']['sss'],
                'amount_total'          => array_sum(array($computed_salary['employee_shares']['sss'], $computed_salary['employer_shares']['sss'])),
                'created'               => date('Y-m-d H:i:s'),
                'created_by'            => $this->ion_auth->user()->row()->id,
            ));
            $this->payroll_employee_hdmf_model->insert(array(
                'employee_id'           => $employee_id,
                'payroll_employee_id'   => $payroll_employee_id,
                'amount_employee'       => $computed_salary['employee_shares']['hdmf'],
                'amount_employer'       => $computed_salary['employer_shares']['hdmf'],
                'amount_total'          => array_sum(array($computed_salary['employee_shares']['hdmf'], $computed_salary['employer_shares']['hdmf'])),
                'created'               => date('Y-m-d H:i:s'),
                'created_by'            => $this->ion_auth->user()->row()->id,
            ));
            $this->payroll_employee_phic_model->insert(array(
                'employee_id'           => $employee_id,
                'payroll_employee_id'   => $payroll_employee_id,
                'amount_employee'       => $computed_salary['employee_shares']['phic'],
                'amount_employer'       => $computed_salary['employer_shares']['phic'],
                'amount_total'          => array_sum(array($computed_salary['employee_shares']['phic'], $computed_salary['employer_shares']['phic'])),
                'created'               => date('Y-m-d H:i:s'),
                'created_by'            => $this->ion_auth->user()->row()->id,
            ));
            $this->payroll_employee_salary_model->insert(array(
                'employee_id'           => $employee_id,
                'payroll_employee_id'   => $payroll_employee_id,
                'amount'                => $computed_salary['employee_gross_salary'],
                'created'               => date('Y-m-d H:i:s'),
                'created_by'            => $this->ion_auth->user()->row()->id,
            ));
            
            $payroll_employee_details[$index] = array(
                'EMPLOYEE_ID'              => $employee_id,
                'PAYROLL_EMPLOYEE_DETAILS' => $this->payroll_employee_model->get($payroll_employee_id),
                'PAYROLL_EMPLOYEE_SSS'     => $this->payroll_employee_sss_model->get_by(array('payroll_employee_id' => $payroll_employee_id)),
                'PAYROLL_EMPLOYEE_HDMF'    => $this->payroll_employee_hdmf_model->get_by(array('payroll_employee_id' => $payroll_employee_id)),
                'PAYROLL_EMPLOYEE_PHIC'    => $this->payroll_employee_phic_model->get_by(array('payroll_employee_id' => $payroll_employee_id)),
                'PAYROLL_EMPLOYEE_SALARY'  => $this->payroll_employee_salary_model->get_by(array('payroll_employee_id' => $payroll_employee_id)),
                'PAYROLL_EMPLOYEE_BENEFITS' => $this->payroll_employee_benefit_model->get_by(array('payroll_employee_id' => $payroll_employee_id)),
            );

            //HOTFIX REVISION 0001
            //update total deductions
        }
        
        $this->session->set_flashdata('success', 'Done generating payroll order.');
        redirect('payroll_order/details/' . $payroll_id);
    }
    function details($id)
    {
        $user = $this->ion_auth->user()->row();
        $payroll = $this->payroll_model->get_by(['id' => $id]);
        $payroll_employees = $this->payroll_employee_model->get_payroll_employee_data(['payroll_employees.payroll_id' => $id]);
        $payroll_employee_loans = $this->payroll_employee_deduction_model->get_details('get_many_by', [
            'payroll_employees.payroll_id' => $id,
            'payroll_employee_deductions.amount !=' => 0
        ]);
        $payroll_employee_benefits = $this->payroll_employee_benefit_model->get_payroll_benefits('get_many_by', [
            'payroll_employees.payroll_id' => $id,
            'payroll_employee_benefits.amount !=' => 0    
        ]);

        $total_loans = array_sum(array_column($payroll_employee_loans, 'amount'));
        $total_benefits = array_sum(array_column($payroll_employee_benefits, 'amount'));

        $this->_payroll_employees = $payroll_employees;
        $processedBy = $user->first_name . ' ' . $user->last_name;

        $this->data = array(
            'page_header' => 'Payroll Order Details',
            'payroll' => $payroll,
            'payroll_employees' => $payroll_employees,
            'payroll_employee_loans' => $payroll_employee_loans,
            'payroll_employee_benefits' => $payroll_employee_benefits,
            'total_loans' => $total_loans,
            'total_benefits' => $total_benefits,
            'processedBy' => $processedBy
        );

        $this->total_sum(array(
            'gross',
            'tax',
            'sss',
            'phic',
            'hdmf',
            'net_pay',
            'deductions',
            'benefits',
            'tardiness_deduction',
            'unpaid_leave_deduction',
            'undertime_deduction'
        ));

        $this->load_view('pages/payroll_order-details');
    }

    function total_sum($fields = array())
    {
        $temp = array();
        foreach($fields as $field){
            $arr_key = 'total_' . $field;
            $this->data[$arr_key] = array_sum(array_column($this->_payroll_employees, $field));
        }
    }

    function getPrevDates() {
        $payroll = $this->payroll_model->get_all();
        
        if(!$payroll)
        {
            $dates = NULL;
        }
        else
        {
            $min_date = min(array_column($payroll, 'start_date'));
            $max_date = max(array_column($payroll, 'end_date'));
        
            $period = new DatePeriod(
                new DateTime($min_date),
                new DateInterval('P1D'),
                new DateTime($max_date)
            );

            $dates = [];

            foreach ($period as $key => $value)
            {
                $dates[] = $value->format('m/d/Y'); 
            }
        }

        echo json_encode(
            array(
                'dates' => $dates
            )
        );
    }
}
// End of file Payroll_order.php
// Location: ./application/controller/Payroll_order.php