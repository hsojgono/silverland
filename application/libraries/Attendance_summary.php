<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-CKSagun
 */
class Attendance_summary
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $ci;

    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model(array(
            'employee_model',
            'daily_time_record_model',
            'attendance_summary_model'
        ));
    }

    /**
     * Undocumented function
     *
     * @param array $params
     * @return mixed
     */
    function compute_attendance_summary($params = array())
    {
        // NOTE: get all project base and permanent employees
        $employees = $this->ci->employee_model->get_details_empployee('get_many_by', array(
            'employee_information.employment_type_id' => array(1) 
        ));

        $attendanceSummaryVarsKeys = $this->ci->config->item('attendance_summary_vars');

        foreach ($employees as $empKey => $empVal) 
        {
            $employee_dtr = $this->ci->daily_time_record_model->get_details('get_many_by', array(
                'attendance_daily_time_records.date >='     => date('Y-m-d', strtotime($params['start_date'])),
                'attendance_daily_time_records.date <='     => date('Y-m-d', strtotime($params['end_date'])),
                'attendance_daily_time_records.employee_id' => $empVal['id']
            ));
            
            $attendanceSummaryVars[$empKey]['employee_id'] = $empVal['id'];
            $attendanceSummaryVars[$empKey]['payroll_id']  = $params['payroll_id'];

            foreach ($attendanceSummaryVarsKeys as $attSumkey) 
            {
                $attendanceSummaryVars[$empKey][$attSumkey] = array_sum(array_column($employee_dtr, $attSumkey));
            }
        }

        $attendance_summaries = $this->ci->attendance_summary_model->insert_many($attendanceSummaryVars);

        return $attendance_summaries;
    }
}
// End of file Attendance_summary.php
// Location: ./application/controller/Attendance_summary.php
