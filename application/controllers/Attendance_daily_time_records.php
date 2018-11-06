<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-CKSagun
 */
class Attendance_daily_time_records extends MY_Controller {
 
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

        // Load custom config of attendance summary
        $this->load->config('attendance_summary');

        // Load model of attendance summary
        $this->load->model('daily_time_record_model');
        $this->load->model('overtime_model');
        $this->load->model('employee_information_model');

        // Load library of attendance summary
        $this->load->library('attendance_dtr');
        $this->load->library('daily_time_record_model');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function index()
    {
        $employee_id = 12;
        $this->data['selected_employee'] = $this->employee_model->get_details_empployee('get_by', array('employees.id' => $employee_id));
        $this->data['page_header'] = 'FOR TESTING PURPOSE: ATTENDANCE DAILY TIME RECORD';
        $this->load_view('pages/attendance_daily_time_record');
    }

    public function time_in()
    {
        dump('Time in');
    }

    public function time_out()
    {
        $employee_id = $this->uri->segment(3);
        
        $employee_dtr = $this->daily_time_record_model->get_details('get_by', array(
            'attendance_daily_time_records.employee_id' => $employee_id
        ));
        
        $employee_ot  = $this->overtime_model->get_details('get_by', array('attendance_overtimes.employee_id' => $employee_id));
        $employee_information = $this->employee_information_model->get_by(array('employee_id' => $employee_id));
            
        $params['variables'] = $this->config->item('variables');
        $params['variables']['employee_id'] = $employee_id;
        $params['employee_dtr']  = $employee_dtr;
        $params['employee_ot']   = $employee_ot;
        $params['employee_info'] = $employee_information;

        $this->attendance_dtr->initialize($params);

        dump($this->attendance_dtr->return_values, '$this->attendance_dtr->return_values');

    }

    // only test function 
    function create_daily_time_records()
    {
        $err_handler = array();
        for ($employee_id = 1; $employee_id < 10; $employee_id++) {

            $data['employee_id'] = $employee_id;
            $data['shift_schedule_id'] = rand(1, 3);
            $data['reports_to'] = (rand(1, 10) == $employee_id) ? $employee_id++ : rand(1, 10);
            $data['date'] = '2018-01-03';
            $data['time_in'] = '2018-01-03 08:00:00';
            $data['time_out'] = '2018-01-03 17:00:00';
            $data['company_id'] = 1;
            $data['site_id'] = 1;
            $data['approval_status'] = 1;
            $data['remarks'] = 'test data';

            dump($data);

            $last_id = $this->daily_time_record_model->insert($data);


            dump($last_id);
            // $err_handler[] = ($last_id) ? 'success' : 'failed';
            
        }

        dump($err_handler);
    }
}
// End of file Attendance_daily_time_records.php
// Location: ./application/controller/Attendance_daily_time_records.php