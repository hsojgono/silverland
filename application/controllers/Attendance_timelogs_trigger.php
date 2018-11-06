<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-JBGono
 */
class Attendance_timelogs_trigger extends MY_Controller {
 
    /**
     * Some description here
     * 
     * @author	SMTI-JBGono
     * @param
     * @return
     */
    function __construct()
    {
        parent::__construct();        
        $this->load->helper('url');
        $this->load->model([
            'employee_information_model',
            'attendance_time_log_model',
        ]);
        $this->load->library('attendance_dtr');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-JBGono
     * @author	SMTI-DAquino
     * @param
     * @return
     */
    function index()
    {
        // put schedule to DTR
        $this->attendance_dtr->generate_dates_to_dtr();

        // get time logs in attendance_time_logs
        $time_logs = $this->get_timelogs_from_json();
    
        // put time logs in attendance_time_logs
        $this->process_timelogs($time_logs);
    }

    /**
     * Get Time Logs (JSON)
     * @return JSON data
     * 
     */
    function get_timelogs_from_json()
    {
        $datetoday = date('Ymd');

        $file_path = 'timelogs\timelogs_20180621.json';
        $file = file_get_contents($file_path, true);
        
        return json_decode($file, true);
    }

    /**
     * Process timelogs data
     * 
     * @return void
    */
    protected function process_timelogs($time_logs)
    {
        // dump($time_logs);
        foreach ($time_logs as $daily_time_logs) 
        {
            foreach ($daily_time_logs['CHECKINOUT'] as $log)
            {
                $employee_info = $this->employee_information_model->get_employee_details('get_by', [
                    'employees.employee_code' => $daily_time_logs['BADGENUMBER']
                ]);

                if (!$employee_info)
                {   
                    // dump($employee_info);
                    $employee_info = null;
                    // dump($employee_info);
                }

                // Put JSON data to attendance_time_logs
                $log_type = ($log['CHECKTYPE'] == 'I')? 1 : 0;
                $log_time = $log['CHECKTIME'];
                
                $this->put_timelog_to_table($employee_info, $log_time, $log_type);
            }
        }    
    }

    /**
     * Put JSON data to attendance_time_logs
     * @param employee details
     * @param log date/time
     * @param log type
     * 
     * @return int/null
    */
    protected function put_timelog_to_table($employee_info, $log_time, $log_type)
    {
        if( !(isset($employee_info)) ) return null;
        // dump($employee_info);

        $data = array(
            'employee_id' => $employee_info['employee_id'],
            'date_time' => $log_time,
            'log_type' => $log_type,
            'company_id' => $employee_info['company_id'],
            'site_id' => $employee_info['site_id'],
            'dtr_reflected' => 0                            // initial value
        );
        
        if ( !($this->_check_logs_exist($this->attendance_time_log_model, $data)) )
        {
            return $this->attendance_time_log_model->insert($data);
        }
    }
    
    protected function _check_logs_exist($table, $params = array())
    {
        if ( ! isset($params['date_time'])) return FALSE;
        if ( ! isset($params['employee_id'])) return FALSE;
        
        $data = array(
            'date_time' => $params['date_time'],
            'employee_id' => $params['employee_id'],
        );

        $timelog = $table->get_by($data);

        return (isset($timelog));
    }
}
// End of file Attendance_timelogs_trigger.php
// Location: ./application/controller/Attendance_timelogs_trigger.php