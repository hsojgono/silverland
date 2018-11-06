<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-JBGono
 */
class Attendance_timelogs_timeout extends MY_Controller {
 
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
            'attendance_time_log_model',
            'employee_info_model',
            'attendance_daily_time_record_model'
        ]);

        $this->load->library('attendance_dtr');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-JBGono
     * @param
     * @return
     */
    function index()
    {
        //$this->put_timelogs_to_dtr();
        $this->compute_dtr_today();
    }

    function compute_dtr_today()
    {
        $dtr = $this->attendance_daily_time_record_model->get_many_by([
            //'date' => '2018-01-26'/*date('Y-m-d')*/,
            'logs_processed' => 1
        ]);

        if( !(isset($dtr)) ) return;

        foreach($dtr as $record)
        {
            $info = $this->employee_info_model->get_employee_dtr_info([
                'employee_id' => $record['employee_id'],
                'employees.active_status' => 1
            ]);

            if( !(empty($info)) )
            {
                $params['employee_info'] = $info[0];
                $params['date'] = $record['date'];
                $params['time_in'] = $record['time_in'];
                $params['time_out'] = $record['time_out'];
                $params['minutes_undertime'] = $record['minutes_undertime'];

                $this->attendance_dtr->timeout_trigger($params);

                // do DTR update 
                $update_data = $this->attendance_dtr->return_values;
                $this->attendance_daily_time_record_model->update($record['id'], $update_data);
            }
        }
    }
    /**
     * Put timein/out logs in DTR
     */
    protected function update_timelogs($log)
    {
        if( !(isset($log)) ) return null;

        $this->attendance_time_log_model->update($log['id'], ['dtr_reflected' => 1]);
    }
    
    protected function put_timelogs_to_dtr()
    {
        $dtr = $this->attendance_daily_time_record_model->get_many_by([
            'logs_processed' => 0
        ]);

        if( !(isset($dtr)) ) return;

        foreach($dtr as $record)
        {
            // initialization information
            $time_in = NULL;
            $time_out = NULL;
            $logs_processed = 0;                // initial value

            // get_shift_schedule() returns false if no schedule
            $shift_info = $this->attendance_dtr->get_shift_schedule($record['employee_id'], $record['date']);

            if ( isset($shift_info) )
            {
                // get earliest timein
                $time_in = $this->attendance_time_log_model->get_timein_by($record['employee_id'], $shift_info['time_start']);

                // get latest timeout
                $time_out = $this->attendance_time_log_model->get_timeout_by($record['employee_id'], $shift_info['time_end']);
            }
            
            if( isset($time_in) && isset($time_out) )
            {
                // update timelogs information
                $this->update_timelogs($time_in);           // reflect to dtr
                $this->update_timelogs($time_out);          // reflect to dtr
                
                $logs_processed = 1;                        // time logs processed
            }
            else if (isset($time_in))
            {
                $this->update_timelogs($time_in);           // reflect to dtr
                $logs_processed = 0;                        // time logs not yet processed
            }
            else if (isset($time_out))
            {
                $this->update_timelogs($time_out);           // reflect to dtr
                $logs_processed = 0;                         // time logs not yet processed
            }
            else
            {
                // default
                $logs_processed = 0;                        // time logs not yet processed
            }
            
            $update_data = array(
                'shift_schedule_id' => $shift_info['shift_id'],
                'time_in' => $time_in['date_time'],
                'time_out' => $time_out['date_time'],
                'logs_processed' => $logs_processed
            );

            // dump($update_data);

            $this->attendance_daily_time_record_model->update($record['id'], $update_data);
        }
    }
}
// End of file Attendance_timelogs_timeout.php