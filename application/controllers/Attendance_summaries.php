<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-JBGono
 */
class Attendance_summaries extends MY_Controller {
 
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
    }

    public function index()
    {
        $this->data = array(
            'page_header' => 'Attendance Summary'
        );

        $this->load_view('pages/attendance-summary-index');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-JBGono
     * @param
     * @return
     */
    function summarized()
    {
        // $payroll_id = 1;
        // $employee_id = 7;
        //  $total_employee = 1;

        $this->load->model('attendance_summary_model');

        // $employee_data = $this->employee_model->get_by(array('id' => $employee_id));
        // $employee_attendance_summaries = $this->attendance_summary_model->get_details('get_all', '');

        // //dump($employee_attendance_summaries);exit;
        
        // $attendance_summary_details = array();
        
        // for ($c = 1; $c <= $total_employee; $c++) {

        //     $params = array(
        //         'payroll_id'    => $payroll_id,
        //         'employee_id'   => $employee_id,
        //         'employee_data' => $employee_data
        //     );

        //     $this->load->library('attendance_summary', $params);

        //     $attendance_summary_details[] = $this->attendance_summary->init();
        // }
        $this->load->library('attendance_summary');
        
        $attendance_summary_details[] = $this->attendance_summary->init();
        dump($attendance_summary_details, 'hours per day');
    }
}
// End of file Attendance_summary.php
// Location: ./application/controller/Attendance_summary.php