<?php

class Salary_computation
{
    protected $ci;
    protected $night_differential_pay;
    protected $overtime_pay;
    protected $overtime_night_differential_pay;
    protected $holiday_regular_pay;
    protected $holiday_regular_night_differential_pay;
    protected $holiday_regular_overtime_pay;
    protected $holiday_regular_overtime_night_differential_pay;
    protected $holiday_special_pay;
    protected $holiday_special_night_differential_pay;
    protected $holiday_special_overtime_pay;
    protected $holiday_special_overtime_night_differential_pay;
    protected $rest_day_pay;
    protected $rest_day_overtime_pay;
    protected $rest_day_night_differential_pay;
    protected $rest_day_overtime_night_differential_pay;
    protected $rest_day_holiday_regular_pay;
    protected $rest_day_holiday_regular_night_differential_pay;
    protected $rest_day_holiday_regular_overtime_pay;
    protected $rest_day_holiday_regular__overtime_night_differential_pay;
    protected $rest_day_holiday_special_pay;
    protected $rest_day_holiday_special_overtime_pay;
    protected $rest_day_holiday_special_night_differential_pay;
    protected $rest_day_holiday_special_overtime_night_differential_pay;
    protected $_unpaid_leave_deduction;
    protected $_employee_id = NULL;
    protected $_employee_data = array();
    protected $_error_messages = array();
    protected $_working_days_monthly;
    protected $_counting_method_tardiness;
    protected $_tardiness_deduction;
    protected $_counting_method_undertime;
    protected $_undertime_deduction;
    protected $_payroll_id;
    protected $_employee_salary;
    protected $_attendance_summaries;
    protected $_payroll_employee_salary;
    protected $_employee_gross_salary;
    protected $_employee_tax_exemption_status_id;
    protected $_phic_monthly_percentage;
    
    protected $_sss_deduction_cutoff;
    protected $_tax_deduction_cutoff;
    
    protected $_payroll_employee_id;
    protected $_payroll_employee_tax;
    protected $_payroll_employee_taxable_benefits;
    protected $_payroll_employee_benefits_amount;
    protected $_payroll_employee_net_pay;
    protected $_payroll_employee_gross_taxable_income;
    protected $_payroll_employee_deductions;
    
    protected $_employee_deductions = array(
        'sss'        => 0,
        'phic'       => 0,
        'hdmf'       => 0,
        'tax'        => 0,
        'deductions' => 0,
    );
    protected $_employee_share = array(
        'sss'  => 0,
        'phic' => 0,
        'hdmf' => 0
    );
    protected $_employer_share  = array(
        'sss'  => 0,
        'phic' => 0,
        'hdmf' => 0
    );

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model(array(
            'employee_salaries_model',
            'system_config_model',
            'attendance_summary_model',
            'tax_rate_model',
            'tax_matrix_model',
            'sss_rate_model',
            'phic_contribution_rate_model',
            'hdmf_contribution_rate_model',
            'payroll_employee_model',
            'employee_loan_model',
            'payroll_employee_deduction_model',
            'employee_deduction_model',
            'employee_benefits_model',
            'payroll_employee_benefit_model',
            'payroll_model',
            'benefit_model'
        ));

        $this->_counting_method_tardiness = $this->ci->system_config_model->get_by(array('name' => 'counting_method_tardiness'));
        $this->_counting_method_undertime = $this->ci->system_config_model->get_by(array('name' => 'counting_method_undertime'));
        $this->_phic_monthly_percentage   = $this->ci->system_config_model->get_by(array('id' => 18));
        $this->_sss_deduction_cutoff      = $this->ci->system_config_model->get_by(array('id' => 12));
        $this->_tax_deduction_cutoff      = $this->ci->system_config_model->get_by(array('id' => 15));

    }
    
    public function init($params = array())
    {

        $this->_employee_id = isset($params['employee_id']) ? $params['employee_id'] : FALSE;
        $this->_payroll_id = isset($params['payroll_id']) ? $params['payroll_id'] : FALSE;
        $this->_payroll_employee_id = isset($params['payroll_employee_id']) ? $params['payroll_employee_id'] : FALSE;

        $this->_employee_tax_exemption_status_id = $params['employee_data']['tax_exemption_status_id'];

        $this->_employee_salary = $this->ci->employee_salaries_model->get_details('get_by', array(
            'employee_salaries.employee_id' => $this->_employee_id
        ));

        $this->_attendance_summaries = $this->ci->attendance_summary_model->get_details('get_by', array(
            'attendance_summaries.employee_id' => $this->_employee_id,
            'attendance_summaries.payroll_id' => $this->_payroll_id 
        ));

        $this->_working_days_monthly = $this->get_working_days_monthly();

        if(empty($this->_employee_id)) {
            $this->_error_messages[] = 'You must set Employee ID.';
            return FALSE;
        }

        if (empty($this->_payroll_id)) {
            $this->_error_messages[] = 'You must set Payroll ID.';
            return FALSE;
        }

        $this->_payroll_employee_salary                         = $this->set_payroll_employee_salary();
        $this->night_differential_pay                           = $this->set_night_differential_pay();
        
        $this->overtime_pay                                     = $this->set_overtime_pay();
        $this->overtime_night_differential_pay                  = $this->set_overtime_night_differential_pay();
        
        $this->holiday_regular_pay                              = $this->set_holiday_regular_pay();
        $this->holiday_regular_night_differential_pay           = $this->set_holiday_regular_night_differential_pay();
        $this->holiday_regular_overtime_pay                     = $this->set_holiday_regular_overtime_pay();
        $this->holiday_regular_overtime_night_differential_pay  = $this->set_holiday_regular_overtime_night_differential_pay();
        
        $this->holiday_special_pay                              = $this->set_holiday_special_pay();
        $this->holiday_special_night_differential_pay           = $this->set_holiday_special_night_differential_pay();
        $this->holiday_special_overtime_pay                     = $this->set_holiday_special_overtime_pay();
        $this->holiday_special_overtime_night_differential_pay  = $this->set_holiday_special_overtime_night_differential_pay();
        
        $this->rest_day_pay                                     = $this->set_rest_day_pay();
        $this->rest_day_night_differential_pay                  = $this->set_rest_day_night_differential_pay();

        $this->rest_day_overtime_pay                            = $this->set_rest_day_overtime_pay();
        $this->rest_day_overtime_night_differential_pay         = $this->set_rest_day_overtime_night_differential_pay();

        $this->rest_day_holiday_regular_pay                     = $this->set_rest_day_holiday_regular_pay();
        $this->rest_day_holiday_regular_night_differential_pay  = $this->set_rest_day_holiday_regular_night_differential_pay();
        $this->rest_day_holiday_regular_overtime_pay            = $this->set_rest_day_holiday_regular_overtime_pay();
        $this->rest_day_holiday_regular_overtime_night_differential_pay = $this->set_rest_day_holiday_regular_overtime_night_differential_pay();

        $this->rest_day_holiday_special_pay                     = $this->set_rest_day_holiday_special_pay();
        $this->rest_day_holiday_special_overtime_pay            = $this->set_rest_day_holiday_special_overtime_pay();
        $this->rest_day_holiday_special_night_differential_pay  = $this->set_rest_day_holiday_special_night_differential_pay();
        $this->rest_day_holiday_special_overtime_night_differential_pay = $this->set_rest_day_holiday_special_overtime_night_differential_pay();
        $this->_unpaid_leave_deduction                = $this->set_unpaid_leave_deduction();
        $this->_tardiness_deduction                   = $this->set_tardiness_deduction();
        $this->_undertime_deduction                   = $this->set_undertime_deduction();
        
        $this->set_payroll_employee_benefits();
        $this->_payroll_employee_taxable_benefits     = $this->set_payroll_employee_taxable_benefits();
        $this->_employee_gross_salary                 = $this->set_employee_gross_salary();
        $this->_payroll_employee_gross_taxable_income = $this->set_payroll_employee_gross_taxable_income(); 
        
        $this->set_payroll_employee_sss();
        $this->set_payroll_employee_phic();
        $this->set_payroll_employee_hdmf();
        $this->_payroll_employee_tax                  = $this->set_payroll_employee_tax();
        $this->_payroll_employee_benefits_amount      = $this->set_payroll_employee_benefits_amount();

        $this->set_employee_loans_to_deduction();
        $this->set_payroll_employee_deductions();
        $this->_payroll_total_deduction               = $this->set_total_deductions();

        $this->_payroll_employee_net_pay              = $this->set_payroll_employee_net_pay();
        
        $result = array(
            'night_differential_pay'                                    => $this->night_differential_pay,
            'overtime_pay'                                              => $this->overtime_pay,
            'overtime_night_differential_pay'                           => $this->overtime_night_differential_pay,
            'holiday_regular_pay'                                       => $this->holiday_regular_pay,
            'holiday_regular_night_differential_pay'                    => $this->holiday_regular_night_differential_pay,
            'holiday_regular_overtime_pay'                              => $this->holiday_regular_overtime_pay,
            'holiday_regular_overtime_night_differential_pay'           => $this->holiday_regular_overtime_night_differential_pay,
            'holiday_special_pay'                                       => $this->holiday_special_pay,
            'holiday_special_night_differential_pay'                    => $this->holiday_special_night_differential_pay,
            'holiday_special_overtime_pay'                              => $this->holiday_special_overtime_pay,
            'holiday_special_overtime_night_differential_pay'           => $this->holiday_special_overtime_night_differential_pay,
            'rest_day_pay'                                              => $this->rest_day_pay,
            'rest_day_night_differential_pay'                           => $this->rest_day_night_differential_pay,
            'rest_day_overtime_pay'                                     => $this->rest_day_overtime_pay,
            'rest_day_overtime_night_differential_pay'                  => $this->rest_day_overtime_night_differential_pay,
            'rest_day_holiday_regular_pay'                              => $this->rest_day_holiday_regular_pay,
            'rest_day_holiday_regular_night_differential_pay'           => $this->rest_day_holiday_regular_night_differential_pay,
            'rest_day_holiday_regular_overtime_pay'                     => $this->rest_day_holiday_regular_overtime_pay,
            'rest_day_holiday_regular_overtime_night_differential_pay'  => $this->rest_day_holiday_regular_overtime_night_differential_pay,
            'rest_day_holiday_special_pay'                              => $this->rest_day_holiday_special_pay,
            'rest_day_holiday_special_overtime_pay'                     => $this->rest_day_holiday_special_overtime_pay,
            'rest_day_holiday_special_night_differential_pay'           => $this->rest_day_holiday_special_night_differential_pay,
            'rest_day_holiday_special_overtime_night_differential_pay'  => $this->rest_day_holiday_special_overtime_night_differential_pay,
            'unpaid_leave_deduction'                                    => $this->_unpaid_leave_deduction,
            'tardy_deduction'                                           => $this->_tardiness_deduction,
            'undertime_deduction'                                       => $this->_undertime_deduction,
            'employee_gross_salary'                                     => $this->_employee_gross_salary,
            'salary'                                                    => $this->_payroll_employee_salary,
            'employee_shares'                                           => $this->_employee_share,
            'employer_shares'                                           => $this->_employer_share,
            'employee_id'                                               => $this->_employee_id,
            'payroll_id'                                                => $this->_payroll_id,
            'payroll_details'                                           => $this->get_payroll_details($this->_payroll_id),
            'payroll_employee_tax'                                      => $this->_payroll_employee_tax,
            'payroll_employee_taxable_benefits'                         => $this->_payroll_employee_taxable_benefits,
            'payroll_employee_benefits_amount'                          => $this->_payroll_employee_benefits_amount,
            'net_pay'                                                   => $this->_payroll_employee_net_pay,
            'deductions'                                                => $this->_payroll_total_deduction,
            'gross_taxable_income'                                      => $this->_payroll_employee_gross_taxable_income,
            'created'                                                   => date('Y-m-d H:i:s'),
        );

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    public function get_error_messages()
    {
        $error_message = implode('. ', $this->_error_messages);
        return $error_message;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    public function get_error_message_array()
    {
        return $this->_error_messages;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    private function get_working_days_monthly()
    {
        $working_days_monthly = $this->ci->system_config_model->get_by(array('name' => 'working_days_monthly'));

        $result = ($working_days_monthly['value'] * 8) * 60;

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;
        
        $employee_monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_diff'] = $night_differential['value'] + 1;

        $result = ($employee_monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_nightdiff'] * $pay_premium['night_diff']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];
        $minutes_overtime = $attendance_summaries['minutes_ot'];
        $pay_premium_overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));

        $result = ($monthly_salary / $this->_working_days_monthly) * ($minutes_overtime * ($pay_premium_overtime['value'] + 1));
        
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];
        
        // Minutes overtime night differential
        $min_ot_ndiff = $attendance_summaries['minutes_ot_nightdiff'];

        $pay_premium = array();

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium night differential
        $night_diff = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_diff['value'] + 1;

        $result = (($monthly_salary / $this->_working_days_monthly) * $min_ot_ndiff) * ($pay_premium['overtime'] * $pay_premium['night_differential']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_regular_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];
        
        // Minutes overtime night differential
        $min_ot_ndiff = $attendance_summaries['minutes_ot_nightdiff'];

        $pay_premium = array();

        // Pay premium overtime
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'];
        
        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_reg'] * $pay_premium['holiday_regular']);
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_regular_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium overtime
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'];

        // Pay premium overtime night differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_reg_nightdiff'] * $pay_premium['holiday_regular']) * $pay_premium['night_differential'];
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_regular_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium overtime
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'];

        // Pay premium overtime night differential
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_reg_ot'] * $pay_premium['holiday_regular']) * $pay_premium['overtime'];
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_regular_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium overtime holiday regular
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'];

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium night differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_reg_ot_nightdiff'] * $pay_premium['holiday_regular']) * ($pay_premium['overtime'] * $pay_premium['night_differential']);
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_special_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium overtime holiday special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'];

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_spcl'] * $pay_premium['holiday_special']);
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_special_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium overtime holiday special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'];

        // Pay premium overtime night differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_spcl_nightdiff'] * $pay_premium['holiday_special']) * $pay_premium['night_differential'];
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_special_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium holiday special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'];

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_spcl_ot'] * $pay_premium['holiday_special']) * $pay_premium['overtime'];
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_holiday_special_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium holiday special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'];

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium night_differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_hday_spcl_ot_nightdiff'] * $pay_premium['holiday_special']) * ($pay_premium['overtime'] * $pay_premium['night_differential']);
        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium night_differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_nightdiff'] * $pay_premium['rest_day']) * $pay_premium['night_differential'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium night_differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest'] * $pay_premium['rest_day']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_ot'] * $pay_premium['rest_day']) * $pay_premium['overtime'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium night_differential
        $night_differential = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_night_differential'));
        $pay_premium['night_differential'] = $night_differential['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_ot_nightdiff'] * $pay_premium['rest_day']) * ($pay_premium['overtime'] * $pay_premium['night_differential']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_regular_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_regular
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_reg'] * $pay_premium['rest_day']) * $pay_premium['holiday_regular'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_regular_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_regular
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'] + 1;

        // Pay premium nightdiff
        $nightdiff = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_nightdiff'));
        $pay_premium['nightdiff'] = $nightdiff['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_reg_nightdiff'] * $pay_premium['rest_day']) * ($pay_premium['holiday_regular'] * $pay_premium['nightdiff']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_regular_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_regular
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'] + 1;

        // Pay premium nightdiff
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_reg_ot'] * $pay_premium['rest_day']) * ($pay_premium['holiday_regular'] * $pay_premium['overtime']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_regular_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_regular
        $holiday_regular = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_regular'));
        $pay_premium['holiday_regular'] = $holiday_regular['value'] + 1;

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium nightdiff
        $nightdiff = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_nightdiff'));
        $pay_premium['nightdiff'] = $nightdiff['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_reg_ot_nightdiff'] * $pay_premium['rest_day']) * ($pay_premium['holiday_regular'] * $pay_premium['overtime']) * $pay_premium['nightdiff'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_special_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_spcl'] * $pay_premium['rest_day']) * $pay_premium['holiday_special'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_special_overtime_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'] + 1;

        // Pay premium nightdiff
        $nightdiff = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_nightdiff'));
        $pay_premium['nightdiff'] = $nightdiff['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_spcl_nightdiff'] * $pay_premium['rest_day']) * ($pay_premium['holiday_special'] * $pay_premium['nightdiff']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_special_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'] + 1;

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_spcl_ot'] * $pay_premium['rest_day']) * ($pay_premium['holiday_special'] * $pay_premium['overtime']);

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_rest_day_holiday_special_overtime_night_differential_pay()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $rest_day = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_rest_day'));
        $pay_premium['rest_day'] = $rest_day['value'] + 1;

        // Pay premium holiday_special
        $holiday_special = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_holiday_special'));
        $pay_premium['holiday_special'] = $holiday_special['value'] + 1;

        // Pay premium overtime
        $overtime = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_overtime'));
        $pay_premium['overtime'] = $overtime['value'] + 1;

        // Pay premium nightdiff
        $nightdiff = $this->ci->system_config_model->get_by(array('name' => 'pay_premium_nightdiff'));
        $pay_premium['nightdiff'] = $nightdiff['value'] + 1;

        $result = ($monthly_salary / $this->_working_days_monthly) * ($attendance_summaries['minutes_rest_hday_spcl_ot_nightdiff'] * $pay_premium['rest_day']) * ($pay_premium['holiday_special'] * $pay_premium['overtime']) * $pay_premium['nightdiff'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_unpaid_leave_deduction()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $pay_premium = array();

        // Pay premium rest_day
        $working_days_monthly = $this->ci->system_config_model->get_by(array('name' => 'working_days_monthly'));

        $result = ($monthly_salary / $working_days_monthly['value']) * $attendance_summaries['unpaid_leaves'];

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_tardiness_deduction()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];
        
        $minutes_tardy = 0;

        switch ($this->_counting_method_tardiness) {
            case '0':
                $minutes_tardy = $attendance_summaries['minutes_tardy'];
                break;
            case '1' :
                $computation = ($attendance_summaries['minutes_tardy'] / 60) * 4;
                $floor_computation = floor($computation);
                $minutes_tardy = $floor_computation / 4;
                break;
            case '2' :
                $computation = ($attendance_summaries['minutes_tardy'] / 60);
                $minutes_tardy = floor($computation);
                break;
            
            default:
                $minutes_tardy = $attendance_summaries['minutes_tardy'];
                break;
        }

        $result = ($monthly_salary / $this->_working_days_monthly) * $minutes_tardy;

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_undertime_deduction()
    {
        $employee_salary = $this->_employee_salary;
        $attendance_summaries = $this->_attendance_summaries;

        $monthly_salary = $employee_salary['employee_monthly_salary'];
        
        $minutes_undertime = 0;
        $working_days_monthly = $this->_working_days_monthly;

        switch ($this->_counting_method_undertime) {
            case '0':
                $minutes_undertime = $attendance_summaries['minutes_undertime'];
                break;
            case '1' :
                $working_days = $this->ci->system_config_model->get_by(array('name' => 'working_days_monthly'));
                $working_days_monthly = $working_days['value'] * 8;
                $computation = ($attendance_summaries['minutes_undertime'] / 60) * 4;
                $floor_computation = floor($computation);
                $minutes_undertime = $floor_computation / 4;
                break;
            case '2' :
                $working_days = $this->ci->system_config_model->get_by(array('name' => 'working_days_monthly'));
                $working_days_monthly = $working_days['value'] * 8;
                $computation = ($attendance_summaries['minutes_undertime'] / 60);
                $minutes_undertime = floor($computation);
                break;
            
            default:
                $minutes_undertime = $attendance_summaries['minutes_undertime'];
                break;
        }

        $result = ($monthly_salary / $working_days_monthly) * $minutes_undertime;

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    public function set_payroll_employee_salary()
    {
        $payroll_employee_salary = 0;

        $payroll = $this->get_payroll_details($this->_payroll_id);

        $current_payroll_cutoff = $payroll['cutoff'];
        $cutoff_percentage_id   = ($current_payroll_cutoff == 1) ? 16 : 17;
        $cutoff_percentage      = $this->get_system_config_by(array('id' => $cutoff_percentage_id));

        $employee_salary = $this->_employee_salary;
        $monthly_salary = $employee_salary['employee_monthly_salary'];

        $payroll_employee_salary = $monthly_salary * $cutoff_percentage['value'];

        return $payroll_employee_salary;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_gross_salary()
    {
        $gross_pay_variables = array(
            $this->_payroll_employee_salary,
            $this->_payroll_employee_taxable_benefits,
            $this->night_differential_pay,
            $this->overtime_pay,
            $this->overtime_night_differential_pay,
            $this->holiday_regular_pay,
            $this->holiday_regular_overtime_pay,
            $this->holiday_regular_night_differential_pay,
            $this->holiday_regular_overtime_night_differential_pay,
            $this->holiday_special_pay,
            $this->holiday_special_overtime_pay,
            $this->holiday_special_night_differential_pay,
            $this->holiday_special_overtime_night_differential_pay,
            $this->rest_day_pay,
            $this->rest_day_night_differential_pay,
            $this->rest_day_overtime_pay,
            $this->rest_day_overtime_night_differential_pay,
            $this->rest_day_holiday_regular_pay,
            $this->rest_day_holiday_regular_night_differential_pay,
            $this->rest_day_holiday_regular_overtime_pay,
            $this->rest_day_holiday_regular_overtime_night_differential_pay,
            $this->rest_day_holiday_special_pay,
            $this->rest_day_holiday_special_night_differential_pay,
            $this->rest_day_holiday_special_overtime_pay,
            $this->rest_day_holiday_special_overtime_night_differential_pay
        );

        $gross_pay_deductions = array(
            $this->_unpaid_leave_deduction,
            $this->_tardiness_deduction,
            $this->_undertime_deduction

        ); 

        $gross_salary = (array_sum($gross_pay_variables) - array_sum($gross_pay_deductions));
        
        return round($gross_salary, 2);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_payroll_employee_sss()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];
        
        $sss_deduction_cutoff_percentage = 1;//CHECKING  
        $sss_deduction_cutoff = $this->_sss_deduction_cutoff['value'];

        $payroll = $this->get_payroll_details($this->_payroll_id);
        $payroll_cutoff = $payroll['cutoff'];

        $sss_employee_share = 0;
        $sss_employer_share = 0;

        if ($sss_deduction_cutoff == 0) {
            $sss_deduction_cutoff_percentage = 0.5;
        } else {
            $sss_deduction_cutoff_percentage = 1;
        }

        $result =  $this->ci->sss_rate_model->get_details('get_by', array(
            'sss_rates.minimum_range <=' => $monthly_salary,
            'sss_rates.maximum_range >=' => $monthly_salary,
            'sss_rates.active_status' => 1
        ));

        if ($sss_deduction_cutoff != $payroll_cutoff) {
            $sss_employee_share = floatval($sss_employee_share);
            $sss_employer_share = floatval($sss_employer_share);
        } else {
            $sss_employee_share = $result['sr_employee_share'] * $sss_deduction_cutoff_percentage;
            $sss_employer_share = $result['sr_employer_share'] * $sss_deduction_cutoff_percentage;
        }

        $this->_employee_share['sss'] = $sss_employee_share;
        $this->_employer_share['sss'] = $sss_employer_share;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_payroll_employee_phic()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];

        $salary = $this->ci->phic_contribution_rate_model->get_details('get_by', array(
            'phic_rates.active_status' => 1,
            'phic_rates.id' => 30
        ));

        $salary_minimum = $salary['pr_minimum_range'];
        $salary_maximum = $salary['pr_maximum_range'];
        
        $phic_share_percentage = $this->get_system_config_by(array('id' => 18));
        $phic_deduction_cutoff = $this->get_system_config_by(array('id' => 13));
        
        $payroll_cutoff = $this->get_payroll_details(array('id' => $this->_payroll_id));
        $phic_deduction_cutoff_percentage = 0;
        $phic_employee_share = 0;
        
        if ($phic_deduction_cutoff['value'] == 0)  
        {
            $phic_deduction_cutoff_percentage = 0.5;
        } 
        else if ($phic_deduction_cutoff['value'] != $payroll_cutoff['cutoff'])
        {
            return floatval($phic_employee_share);
        }
        else 
        {
            $phic_deduction_cutoff_percentage = 1;
        }
        
        //computation of PHIC
        if (($monthly_salary >= $salary_minimum) && ($monthly_salary <= $salary_maximum)) 
        {
            $employee_share = $salary['pr_employee_share'];
            $employer_share = $salary['pr_employer_share'];
            $phic_employee_share = (($monthly_salary * $phic_deduction_cutoff_percentage) * $phic_share_percentage['value']) * $employee_share;
            $phic_employer_share = (($monthly_salary * $phic_deduction_cutoff_percentage) * $phic_share_percentage['value']) * $employer_share;
        }
        else 
        {
            $employee_share = $this->ci->phic_contribution_rate_model->get_details('get_by', array(
                'phic_rates.phic_matrix_id' => 2,
                'phic_rates.active_status' => 1,
                'phic_rates.minimum_range <=' => $monthly_salary,
                'phic_rates.maximum_range >=' => $monthly_salary
            ));
            
            $phic_employee_share = $employee_share['pr_employee_share'] * $phic_deduction_cutoff_percentage;
            $phic_employer_share = $employee_share['pr_employer_share'] * $phic_deduction_cutoff_percentage;
        }

        $this->_employee_share['phic'] = floatval($phic_employee_share);
        $this->_employer_share['phic'] = floatval($phic_employer_share);

    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_payroll_employee_hdmf()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];
        
        $payroll        = $this->get_payroll_details($this->_payroll_id);
        $hdmf_deduction = $this->get_system_config_by(array('id' => 14));
        $payroll_cutoff = $payroll['cutoff'];
        $hdmf_cutoff    = $hdmf_deduction['value'];
        $hdmf_employee_share = 0;

        if ($hdmf_cutoff == 0) {
            $hdmf_deduction_cutoff_percentage = 0.5;
        } else if ($hdmf_cutoff != $payroll_cutoff) {
            return floatval($hdmf_employee_share);
        } else {
            $hdmf_deduction_cutoff_percentage = 1;
        }

        $hdmf_rates = $this->ci->hdmf_contribution_rate_model->get_details('get_by', array(
            'hdmf_rates.minimum_range <=' => $monthly_salary,
            'hdmf_rates.maximum_range >=' => $monthly_salary,
            'hdmf_rates.active_status' => 1
        ));

        $this->_employee_share['hdmf'] = ($hdmf_rates['hr_employee_share'] * $hdmf_rates['ceiling']) * $hdmf_deduction_cutoff_percentage;
        $this->_employer_share['hdmf'] = ($hdmf_rates['hr_employer_share'] * $hdmf_rates['ceiling']) * $hdmf_deduction_cutoff_percentage;

    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_payroll_employee_tax()
    {
        $gross_taxable_income = $this->set_payroll_employee_gross_taxable_income();

        $payroll = $this->get_payroll_details(array('id' => $this->_payroll_id));

        $payrollCutOff = $payroll['cutoff'];

        $result = 0;
        
        if ($this->_tax_deduction_cutoff['value'] == 0) { 
            $tax_deduction_cutoff_percentage = 0.5;
        } else if($this->_tax_deduction_cutoff['value'] != $payrollCutOff){
            return $result;
        } else{
            $tax_deduction_cutoff_percentage = 1;
        }            

        $sss = $this->_employee_share['sss'];
        $phic = $this->_employee_share['phic'];
        $hdmf = $this->_employee_share['hdmf'];
        
        $taxable_salary = $gross_taxable_income - ($sss + $hdmf + $phic);
        
        $tax_table = $this->ci->tax_rate_model->get_details('get_by', array(
            'tax_tables.tax_matrix_id' => 2,
            'tax_tables.tax_exemption_status_id' => $this->_employee_tax_exemption_status_id,
            'tax_tables.minimum_monthly_salary <=' => $taxable_salary,
            'tax_tables.maximum_monthly_salary >=' => $taxable_salary
        ));

        $base_tax = $tax_table['tr_base_tax'];
        $percentage_over = $tax_table['tr_percentage_over'];
        $minimum_monthly_salary = $tax_table['tr_minimum_monthly_salary'];

        $result = ($base_tax + ($percentage_over * ($taxable_salary - $minimum_monthly_salary))) * $tax_deduction_cutoff_percentage;

        return $result;
    }
    
    /**
     * Undocumented function
     *
     * @param string $id
     * @return void
     */
    protected function get_payroll_details($id = '') {
        if (empty($id)) return FALSE;
        return $this->ci->payroll_model->get_by(array('id'=>$id));
    }

    protected function get_employee_loan_details($id = '') {
        
        if (empty($id)) return FALSE;

        return $this->ci->employee_loan_model->get_by(array('id'=>$id));

    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return void
     */
    protected function get_system_config_by($param = array()) {
        return $this->ci->system_config_model->get_by($param);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    public function set_payroll_employee_taxable_benefits()
    {
        $where_payroll_employee = array(
            'payroll_employee_benefits.payroll_employee_id' => $this->_payroll_employee_id,
            'payroll_employee_benefits.status' => 1,
            'benefit.taxable_status' => 1,
            'benefit.active_status' => 1
        );
        $payroll_employee_benefits = $this->ci->payroll_employee_benefit_model->get_with_detail('get_many_by', $where_payroll_employee);
        
        $payrollEmployeeTaxableBenefits = array_column($payroll_employee_benefits, 'amount');
        
        return array_sum($payrollEmployeeTaxableBenefits);        
    }

    /**
     * Put some description here 
     *
     * @author SMTI-DJAquino
     */
    public function set_payroll_employee_benefits()
    {
        $payroll = $this->get_payroll_details(array('id' => $this->_payroll_id));
        $payrollCutOff = $payroll['cutoff'];

        $employee_benefits = $this->ci->employee_benefits_model->get_details('get_many_by', array('employee_benefits.employee_id' => $this->_employee_id));
        $empBenefitTemp = array();

        // dump($employee_benefits, 'EMPLOYEE BENEFITS');

        foreach ($employee_benefits as $empBenefitKey => $empBenefit) 
        {
            $payrollEmployeeBenefitsAmount = 0;
            
            if ($empBenefit['benefit_cutoff'] == 0) 
            {
                $payrollEmployeeBenefitsAmount = $empBenefit['employee_benefit_amount'] * 0.5;
            }
            else if(($payrollCutOff == 1) && ($empBenefit['benefit_cutoff'] == 1))
            {
                $payrollEmployeeBenefitsAmount = $empBenefit['employee_benefit_amount'] * 1;
            }
            else if(($payrollCutOff == 2) && ($empBenefit['benefit_cutoff'] == 2))
            {
                $payrollEmployeeBenefitsAmount = $empBenefit['employee_benefit_amount'] * 1;
            }
            else 
            {
                // nothing to do
            }

            $empBenefitTemp = array(
                'payroll_employee_id' => $this->_payroll_employee_id,                
                'employee_id'         => $empBenefit['employee_id'],
                'employee_benefit_id' => $empBenefit['employee_benefits_id'],
                'amount'              => $payrollEmployeeBenefitsAmount,
                'status'              => 1
            );

            $payrollEmployeeBenefits = $this->ci->payroll_employee_benefit_model->insert($empBenefitTemp);
        }
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    public function set_payroll_employee_benefits_amount()
    {
        $where_payroll_employee = array(
            'payroll_employee_benefits.payroll_employee_id' => $this->_payroll_employee_id,
            'payroll_employee_benefits.status' => 1,
            'benefit.taxable_status' => 0,
            'benefit.active_status' => 1
        );
        $payroll_employee_benefits = $this->ci->payroll_employee_benefit_model->get_with_detail('get_many_by', $where_payroll_employee);
        
        $payroll_benefit_amounts = array_column($payroll_employee_benefits, 'amount');
        
        return array_sum($payroll_benefit_amounts);
    }

    public function set_payroll_employee_net_pay()
    {
        $payroll_employee_deductions = $this->ci->payroll_employee_deduction_model->get_many_by(array('payroll_employee_id' => $this->_payroll_employee_id));
        $a = array_sum(array($this->_employee_gross_salary, $this->_payroll_employee_benefits_amount));
        $b = array_sum(array($this->_employee_share['sss'], $this->_employee_share['phic'], $this->_employee_share['hdmf'], $this->_payroll_employee_tax));
        $c = array_sum(array_column($payroll_employee_deductions, 'amount'));

        $net_pay = ($a - $b) - $c;

        return $net_pay;
    }

    public function get_loan_balance(&$deduction, $balance)
    {
            if(($deduction > 0) &&
               ($deduction <= $balance))
            {
                $result = $balance - $deduction;
            }
            else if($deduction > $balance)
            {
                $result = $balance - $balance;
                $deduction = $balance;
            }
            else
            {
                // nothing
            }  

        return $result;
    }//end function get_loan_balance

    // loan['frequency'] = SEMI-MONTHLY
    public function loan_semi_monthly($employee_loan, $payroll)
    {
        // initialization information 
        $data_employee_deduction = NULL;
        $loan_date_start = date('Y-m', strtotime($employee_loan['date_start']));
        $payroll_date = date('Y-m', strtotime($payroll['end_date']));

        $company = $this->ci->employee_information_model->get_by(['employee_id' => $this->_employee_id]);
        
        if ($payroll_date >= $loan_date_start)        
        {
            $deduction_amount = $employee_loan['monthly_amortization'] * 0.5;
            
            // $deduction_amount has been called-by-reference
            $balance = $this->get_loan_balance($deduction_amount, $employee_loan['balance']);
            
            $count = $employee_loan['count'] + 1;                           //add count after deduction
            $remaining_term = $employee_loan['remaining_term'] - 1;         //less remaining_term after deduction
            $active_status = ($balance <= 0) ? 0 : 1;                       //de-activate employee_loan when balance reached 0 (zero) 

            // update employee_loan information
            $update_employee_loan = array(
                'balance' => $balance,
                'count' => $count,
                'remaining_term' => $remaining_term,
                'active_status' => $active_status
            );
            $update_id = $this->ci->employee_loan_model->update($employee_loan['id'], $update_employee_loan);

            // return employee_deduction information
            $data_employee_deduction = array(
                'company_id' => $employee_loan['company_id'],
                'employee_id' => $employee_loan['employee_id'],
                'employee_loan_id' => $employee_loan['id'],
                'amount' => $deduction_amount
            );

        }// end if

        return $data_employee_deduction;
    }//end function loan_semi_monthly

    // loan['frequency'] = MONTHLY
    public function loan_monthly($employee_loan, $payroll)
    {
        // initialization information 
        $data_employee_deduction = NULL;
        $company = $this->ci->employee_information_model->get_by(['employee_id' => $this->_employee_id]);

        if ($payroll['cutoff'] == 2)    // loan deduction every second cut off
        {
            if ($employee_loan['date_start'] <= $payroll['end_date'])
            {
                $deduction_amount = $employee_loan['monthly_amortization'];
                
                // $deduction_amount has been called-by-reference
                $balance = $this->get_loan_balance($deduction_amount, $employee_loan['balance']);

                $count = $employee_loan['count'] + 1;                            //add count after deduction
                $remaining_term = $employee_loan['remaining_term'] - 1;          //less remaining_term after deduction
                $active_status = ($balance <= 0) ? 0 : 1;                        //de-activate employee_loan when balance reached 0 (zero) 

                // update employee_loan information
                $update_employee_loan = array(
                    'balance' => $balance,
                    'count' => $count,
                    'remaining_term' => $remaining_term,
                    'active_status' => $active_status
                );
                $update_id = $this->ci->employee_loan_model->update($employee_loan['id'], $update_employee_loan);

                // return employee_deduction information
                $data_employee_deduction = array(
                    'company_id' => $employee_loan['company_id'],
                    'employee_id' => $employee_loan['employee_id'],
                    'employee_loan_id' => $employee_loan['id'],
                    'amount' => $deduction_amount
                );
            } // end if payroll date and loan dates

        }//($payroll['cutoff'] == 2)

        return $data_employee_deduction;
    }

    // employee_loans to employee_deductions migration during payroll generation
    public function set_employee_loans_to_deduction()
    {
        $payroll = $this->get_payroll_details(array('id' => $this->_payroll_id));

        $employee_deduction_data = NULL;

        $employee_loans = $this->ci->employee_loan_model->get_details('get_many_by', [
            'employee_loans.employee_id' => $this->_employee_id,
            'employee_loans.approval_status' => 1,
            'employee_loans.active_status' => 1, 
            'employee_loans.balance >' => 0.00 
        ]);

        foreach ($employee_loans as $employeeLoan => $employee_loan)
        {
            if($employee_loan['frequency'] == 0)
            {
                //continuous
            }
            else if($employee_loan['frequency'] == 1)
            {
                //once
            }
            else if($employee_loan['frequency'] == 2)
            {
                //semi-monthly
                $employee_deduction_data = $this->loan_semi_monthly($employee_loan, $payroll);
            }
            else if($employee_loan['frequency'] == 3)
            {
                //monthly
                $employee_deduction_data = $this->loan_monthly($employee_loan, $payroll);
            }
            else if($employee_loan['frequency'] == 4)
            {
                //quarterly
            }
            else if($employee_loan['frequency'] == 5)
            {
                //semi-annually
            }        
            else if($employee_loan['frequency'] == 6)
            {
                //annually
            }
            else
            {
                // do nothing
            }

            //insert to employee_deductions table
            if($employee_deduction_data != NULL) 
            {
                $this->ci->employee_deduction_model->insert($employee_deduction_data);
            }
        }//end of foreach
    }// end of function set_employee_loans_to_deduction

    public function set_payroll_employee_deductions()
    {
        $payroll = $this->get_payroll_details(array('id' => $this->_payroll_id));

        $employee_deductions = $this->ci->employee_deduction_model->get_many_by([
            'employee_id' => $this->_employee_id,
            'active_status' => 1
        ]);

        foreach ($employee_deductions as $employeeDeduction => $employee_deduction)
        {
            $data_payroll_employee_deduction = array(
                'employee_id' => $employee_deduction['employee_id'],
                'employee_deduction_id' => $employee_deduction['id'],
                'amount' => $employee_deduction['amount'],
                'payroll_employee_id' => $this->_payroll_employee_id
            );

            $this->ci->payroll_employee_deduction_model->insert($data_payroll_employee_deduction);

            // de-activate employee_deduction record after posting in payroll_employee_deduction
            $this->ci->employee_deduction_model->update($employee_deduction['id'], ['active_status' => 0]);

        }// end foreach        
        
    }//end of function set_payroll_employee_deductions

    public function set_payroll_employee_gross_taxable_income() {

        $payroll = $this->get_payroll_details(array('id' => $this->_payroll_id));
        $payrollCutOff = $payroll['cutoff'];

        $payrollEmployeesGross = 0;

        if ($payrollCutOff == 2) {

            $currentCutOffGross = $this->_employee_gross_salary;

            $month = date('m', strtotime($payroll['end_date']));
            $year = date('Y', strtotime($payroll['end_date']));

            $previousPayroll = $this->ci->payroll_model->get_by([
                'cutoff' => 1,
                'MONTH(end_date)' => (int)$month,
                'YEAR(end_date)' => $year
            ]);

            $previousPayrollEmployee = $this->ci->payroll_employee_model->get_by(array(
                'payroll_id' => $previousPayroll['id'],
                'employee_id' => $this->_employee_id
            ));

            $previousCutoffGross = $previousPayrollEmployee['gross'];
            $payrollEmployeesGross = $previousCutoffGross + $currentCutOffGross;
        }

        return $payrollEmployeesGross;
    }

    public function set_total_deductions()
    {
        $payroll_employee_deductions = $this->ci->payroll_employee_deduction_model->get_many_by(array('payroll_employee_id' => $this->_payroll_employee_id));
        $total_amount = array_sum(array_column($payroll_employee_deductions, 'amount'));
        return $total_amount;
    }
}