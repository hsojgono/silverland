<?php

class Salary_computation
{
    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $ci;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_regular_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_regular_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_regular_overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_regular_overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_special_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_special_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_special_overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $holiday_special_overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_regular_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_regular_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_regular_overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_regular__overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_special_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_special_overtime_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_special_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $rest_day_holiday_special_overtime_night_differential_pay;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected $_unpaid_leave_deduction;
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_id = NULL;
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_data = array();
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_error_messages = array();
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_working_days_monthly;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_counting_method_tardiness;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_tardiness_deduction;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_counting_method_undertime;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_undertime_deduction;
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_payroll_id;
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_salary;
    
    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_attendance_summaries;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_gross_salary;

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_deductions = array(
        'sss' => NULL,
        'phic' => NULL,
        'hdmf' => NULL,
        'tax' => NULL,
        'benefits' => NULL,
        'deductions' => NULL,
        'net_pay' => NULL
    );

    /**
     * Put some description here
     *
     * @author SMTI-CKSagun
     */
    protected $_employee_tax_exemption_status_id;

    /**
     * Undocumented variable
     *
     * @author SMTI-CKSagun
     */
    protected $_phic_monthly_percentage;

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model(array(
            'employee_salaries_model',
            'system_config_model',
            'attendance_summary_model',
            'tax_rate_model',
            'sss_rate_model',
            'phic_contribution_rate_model',
            'hdmf_contribution_rate_model',
        ));

        $this->_counting_method_tardiness = $this->ci->system_config_model->get_by(array('name' => 'counting_method_tardiness'));
        $this->_counting_method_undertime = $this->ci->system_config_model->get_by(array('name' => 'counting_method_undertime'));
        $this->_phic_monthly_percentage   = $this->ci->system_config_model->get_by(array('id' => 18));
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */    
    public function init($params = array())
    {

        $this->_employee_id = isset($params['employee_id']) ? $params['employee_id'] : '';
        $this->_payroll_id = isset($params['payroll_id']) ? $params['payroll_id'] : '';

        $this->_employee_tax_exemption_status_id = $params['employee_data']['tax_exemption_status_id'];

        $this->_employee_salary = $this->ci->employee_salaries_model->get_details('get_by', array(
            'employee_salaries.employee_id' => $this->_employee_id
        ));

        $this->_attendance_summaries = $this->ci->attendance_summary_model->get_details('get_by', array(
            'attendance_summaries.employee_id' => $this->_employee_id,
            'attendance_summaries.payroll_id' => $this->_payroll_id // TODO: Temporary id. Make this dynamic or as a requirement
        ));

        $this->_working_days_monthly = $this->get_working_days_monthly();

        $requirements = array(
            'employee_id' => TRUE,
            'test_one_id' => TRUE,
            'test_two_id' => TRUE
        );

        if(empty($this->_employee_id)) {
            $this->_error_messages[] = 'You must set Employee ID.';
            return FALSE;
        }

        if (empty($this->_payroll_id)) {
            $this->_error_messages[] = 'You must set Payroll ID.';
            return FALSE;
        }

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

        $this->_unpaid_leave_deduction  = $this->set_unpaid_leave_deduction();
        $this->_tardiness_deduction     = $this->set_tardiness_deduction();
        $this->_undertime_deduction     = $this->set_undertime_deduction();
        $this->_employee_gross_salary   = $this->set_employee_gross_salary();

        $this->_employee_deductions['sss']        = $this->set_employee_deduction_sss();
        $this->_employee_deductions['phic']       = $this->set_employee_deduction_phic();
        $this->_employee_deductions['hdmf']       = $this->set_employee_deduction_hdmf();
        $this->_employee_deductions['tax']        = $this->set_employee_deduction_tax();
        // $this->_employee_deductions['benefits']   = $this->set_employee_deduction_benefits();
        // $this->_employee_deductions['deductions'] = $this->set_employee_deduction_deductions();
        // $this->_employee_deductions['net_pay']    = $this->set_employee_deduction_net_pay();

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
            'employee_details'                                          => $this->_employee_salary,
            'employee_deductions'                                       => $this->_employee_deductions,
            'employee_id'                                               => $this->_employee_id,
            'payroll_id'                                                => $this->_payroll_id,
            'created'                                                   => date('Y-m-d H:i:s')
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
    protected function set_employee_gross_salary()
    {

        $payroll                = $this->get_payroll_details($this->_payroll_id);

        $current_payroll_cutoff = $payroll['cutoff'];

        $cutoff_percentage_id   = ($current_payroll_cutoff == 0) ? 16 : 17;

        $cutoff_percentage      = $this->get_system_config_by(array('id' => $cutoff_percentage_id));

        $base_pay_per_cutoff    = $this->_employee_salary['employee_monthly_salary'] * $cutoff_percentage['value'];

        $sum_salary_benefits = array(
            $base_pay_per_cutoff,
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

        $gross_salary = (((array_sum($sum_salary_benefits) - $this->_unpaid_leave_deduction) - $this->_tardiness_deduction) - $this->_undertime_deduction);
        
        return round($gross_salary, 2);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_sss()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];

        $result =  $this->ci->sss_rate_model->get_details('get_by', array(
            'sss_rates.minimum_range <=' => $monthly_salary,
            'sss_rates.maximum_range >=' => $monthly_salary,
            'sss_rates.active_status' => 1
        ));

        return floatval($result['sr_employee_share']);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_phic()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];

        $phic_deduction_cutoff = $this->get_system_config_by(array('id' => 13));
        $payroll_cutoff = $this->get_payroll_details(array('id' => $this->_payroll_id));

        if ($phic_deduction_cutoff == 0)  
        {
            $phic_deduction_cutoff_percentage = 0.5;
        } 
        else if ($phic_deduction_cutoff != $payroll_cutoff['cutoff'])
        {
            $phic_deduction_cutoff_percentage = 0;
        }
        else 
        {
            $phic_deduction_cutoff_percentage = 1;
        }
        
        $result = $this->ci->phic_contribution_rate_model->get_details('get_by', array(
            'phic_rates.minimum_range <=' => $monthly_salary,
            'phic_rates.maximum_range >=' => $monthly_salary,
            'phic_rates.active_status' => 1,
            'phic_rates.id' => 30
        ));

        if ($result) {
            $phic = ($monthly_salary * $this->_phic_monthly_percentage['value']) * $result['pr_employee_share'];
        } else {
            $phic_query = $this->ci->phic_contribution_rate_model->get_details('get_by', array(
                'phic_rates.minimum_range <=' => $monthly_salary,
                'phic_rates.maximum_range >=' => $monthly_salary,
                'phic_rates.active_status' => 1,
                'phic_rates.id' => 30
            )); 
            
            $phic = $phic_query['pr_employee_share'];
        }

        return floatval($phic);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_hdmf()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];
        $result = $this->ci->hdmf_contribution_rate_model->get_details('get_by', array(
            'hdmf_rates.minimum_range <=' => $monthly_salary,
            'hdmf_rates.maximum_range >=' => $monthly_salary,
            'hdmf_rates.active_status' => 1
        ));

        $return = $result['hr_employee_share'] * $monthly_salary;

        return floatval($return);
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_tax()
    {
        $monthly_salary = $this->_employee_salary['employee_monthly_salary'];
        
        $tax_table = $this->ci->tax_rate_model->get_details('get_by', array(
            'tax_tables.tax_exemption_status_id' => $this->_employee_tax_exemption_status_id,
            'tax_tables.tax_matrix_id' => 2,
            'tax_tables.minimum_monthly_salary <=' => $monthly_salary,
            'tax_tables.maximum_monthly_salary >=' => $monthly_salary
        ));

        $base_tax = $tax_table['tr_base_tax'];
        $percentage_over = $tax_table['tr_percentage_over'];
        $minimum_monthly_salary = $tax_table['tr_minimum_monthly_salary'];
        $gross_salary = $this->_employee_gross_salary;

        $result = $base_tax + ($percentage_over * ($gross_salary - $minimum_monthly_salary));

        return $result;
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_benefits()
    {

        $this->ci->load->model('payroll_employee_benefit_model');
        $payroll_employee_benefit = $this->ci->payroll_employee_benefit_model->get_details();
        // code here...
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_deductions()
    {
        // code here...
    }

    /**
     * Put some description here 
     *
     * @author SMTI-CKSagun
     */
    protected function set_employee_deduction_net_pay()
    {
        // code here...
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

    /**
     * Undocumented function
     *
     * @param string $id
     * @return void
     */
    protected function get_system_config_by($param = array()) {
        return $this->ci->system_config_model->get_by($param);
    }

}
