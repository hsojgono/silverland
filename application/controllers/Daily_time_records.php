<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Daily_time_records extends MY_Controller {

    private $active_menu = 'System';

    /**
     * Some description here
     *
     * @param   param
     * @return  return
     */

    function __construct()
    {
        parent::__construct();

        $this->load->library([
            'audit_trail',
        ]);

        $this->load->model([
            'daily_time_record_model',
            'daily_time_log_model',
            'employee_schedule_model',
            'employee_information_model',
            'shift_schedule_model',
            'employee_model',
            'official_business_model',
            'overtime_model',
            'undertime_model',
            'leave_model',
            'leave_type_model',
            'holiday_model',
            'system_config_model'
        ]);
    }

    public function index()
    {
        // todo: get all companies records from database order by name ascending
            // todo: load daily_time_record model
            // todo: load view & past the retrieved data from model
            
        $user = $this->ion_auth->user()->row();
        $company_id = $user->company_id;
        $approved = 1; //for approval_status

        //dates for checker
        $date_today = date('Y-m-d H:i:s'); 
        $split_time = explode(' ', $date_today);

        $date_entered = $split_time[0]; // 0 for date
        $time_entered = $split_time[1]; // 1 for time 

        $reports_to = $this->employee_information_model->get_by(['employee_id' => $user->employee_id]);
    
        $total_pending = $this->daily_time_log_model->count_by([
            'approval_status' => 2, 
            'approver_id' => $user->employee_id
        ]); 

        $daily_time_records = $this->daily_time_record_model->get_details('get_many_by', [
            'attendance_daily_time_records.employee_id' => $user->employee_id
        ]);

        $dtr_approvals = $this->daily_time_log_model->get_details('get_many_by', [
            'approver_id' => $user->employee_id,
            'approval_status' => 2
        ]);
 
        $this->data = array(
            'page_header' => 'Attendance  Management',
            'daily_time_records' => $daily_time_records,
            'employee_id' => $user->employee_id,
            'total_pending' => $total_pending,
            'dtr_approvals' => $dtr_approvals,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/daily_time_record-lists');
    }

	public function load_form()
	{
		$data = array(
			'modal_title' => 'Export Daily Time Record',
		);
		$this->load->view('modals/modal-export-dtr', $data);
    }

    public function under_my_supervision()
    {
        $user = $this->ion_auth->user()->row();

        $employees = $this->employee_information_model->get_employee_details('get_many_by', [
            'employee_information.reports_to' => $user->employee_id
        ]);

            // dump($employees);exit;

        $data = array(
            'modal_title' => 'Export Daily Time Record',
            'employees' => $employees
        );
        $this->load->view('modals/modal-export-dtr-supervision', $data);
    }

    public function select_personnel()
    {
        $data = array(
            'modal_title' => 'Export Daily Time Record',
        );
        $this->load->view('modals/modal-export-dtr', $data);
    }

    public function in()
    {
        $user = $this->ion_auth->user()->row();
        $employee_id = $user->employee_id;
        $company_id  = $user->company_id;

        $date_today = date('Y-m-d H:i:s'); 
        $split_time = explode(' ', $date_today);

        $date_entered = $split_time[0]; // 0 for date
        $time_entered = $split_time[1]; // 1 for time 
        
        $shift_schedule = $this->employee_information_model->get_employee_details('get_by', [
            'employee_information.employee_id' => $employee_id
        ]);

        $s_schedule = $this->shift_schedule_model->get_details('get_by', ['id' => $shift_schedule['shift_schedule_id']]);

        $this->data = array(
            'page_header' => 'Attendance Management',
            'active_menu' => $this->active_menu,
            'employee_id' => $employee_id,
            'company_id' => $company_id
        );
        
        $grace_period = $s_schedule['grace_period'];
        $type_of_daily_schedule = $s_schedule['type'];
        $shift_id = $shift_schedule['shift_schedule_id'];
        $minutes_tardy = 0;
            
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_record',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $time_in = $data['time_in'];

            //this is for fixed schedule
            if ($type_of_daily_schedule == 1) {

                $result = $time_in->diff($s_schedule['time_start']);
                $late = $result->format('%h') * 60 + $result->format('%i');

                if (($late > $grace_period)) {
                    
                    $minutes_tardy = $late;

                }
                else {

                    $minutes_tardy = 0;

                }
            }

            //this is for variable schedule
            if ($type_of_daily_schedule == 3) {
                
                $result = $time_in->diff($s_schedule['time_start']);
                $late = $result->format('%h') * 60 + $result->format('%i');

                if (($late > $grace_period)) {
                    
                    $minutes_tardy = $late;

                }
                else {

                    $minutes_tardy = 0;

                }
            }
    
            $data_log = array(
                'employee_id' => $employee_id,
                'date_time' => $date_entered . ' ' . $data['time_in'],
                'company_id' => $company_id,
                'approver_id' => $shift_schedule['approver_id'],
                'log_type' => 1,
                'status' => 1,
                'dtr_reflected' => 0,
                'approval_status' => 2
            );

            $daily_time_log_id = $this->daily_time_log_model->insert($data_log);

            if ( ! $daily_time_log_id) {
                $this->session->set_flashdata('failed', 'Failed to add new daily time record.');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Successfully timed in on ' . $date_time_in['time_in']);
                redirect('daily_time_records');
            }
        }
        $this->load_view('forms/daily-time-log-in');
    }

    public function out()
    {   
        $user        = $this->ion_auth->user()->row();
        $employee_id = $user->employee_id;
        $company_id  = $user->company_id;

        $date_today = date('Y-m-d H:i:s'); 
        $split_time = explode(' ', $date_today);

        $date_entered = $split_time[0]; // 0 for date
        $time_entered = $split_time[1]; // 1 for time 
        
        $shift_schedule = $this->employee_information_model->get_employee_details('get_by', [
            'employee_information.employee_id' => $employee_id
        ]);

        $s_schedule = $this->shift_schedule_model->get_details('get_by', ['id' => $shift_schedule['shift_schedule_id']]);

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_add'));

        $this->data = array(
            'page_header' => 'Attendance Management',
            'active_menu' => $this->active_menu,
        );

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_record',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);
            // $check_existence = $this->daily_time_log_model->check_existence('get_by', [
            //     'employee_id' => $employee_id,
            //     'date_time' => date('Y-m-d', strtotime($data['time_out'])),
            //     'log_type' => 0
            // ]);
            // dump($this->db->last_query());
            // dump($check_existence);exit;

            // if ($check_existence == 0) {
            //     dump('wala pang laman');exit;
            // } else {
            //     dump('meron na');exit;
            // }

            $data_log = array(
                'employee_id' => $employee_id,
                'date_time' => $date_entered . ' ' . $data['time_out'],
                'company_id' => $company_id,
                'approver_id' => $shift_schedule['approver_id'],
                'log_type' => 0,
                'status' => 1,
                'dtr_reflected' => 0,
                'approval_status' => 2
            );

            $daily_time_log_id = $this->daily_time_log_model->insert($data_log);

            if ( ! $daily_time_log_id) {
                $this->session->set_flashdata('failed', 'Failed to add new daily time record.');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Successfully timed out on ' . $data['time_out']);
                redirect('daily_time_records');
            }
        }
      
        $this->load_view('forms/daily-time-log-out');
    }

    public function edit($daily_time_record_id)
    {
        if ( ! $this->ion_auth_acl->has_permission('edit_daily_time_record'))
        {
            $this->session->set_flashdata('failed', 'You have no permission to access this module');
            redirect('/', 'refresh');
        }

        $daily_time_record = $this->daily_time_record_model->get_daily_time_record_by(['attendance_daily_time_records.id' => $daily_time_record_id]);

        $this->data = array(
            'page_header'       => 'Attendance Management',
            'daily_time_record' => $daily_time_record,
            'active_menu'       => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_record_edit'));
        
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_record_edit') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 1,
            //     'perm_key'    => 'edit_daily_time_record',
            //     'old_data'    => $daily_time_record,
            //     'new_data'    => $data
            // ]);

            $daily_time_record_id = $this->daily_time_record_model->update($daily_time_record_id, $data);

            if ( ! $daily_time_record_id) {
                $this->session->set_flashdata('failed', 'Failed to update daily time record.');
                redirect('daily_time_records');
            } else {
                $this->session->set_flashdata('success', 'Attendance successfully updated!');
                redirect('daily_time_records');
            }
        }
        $this->load_view('forms/daily_time_record-edit');
    }

    public function details($id)
    {
        $daily_time_record = $this->daily_time_record_model->get_daily_time_record_by(['attendance_daily_time_records.id' => $id]);
        $employees         = $this->employee_model->get_many_employee_by(['daily_time_record_id' => $id]);

        $this->data = array(
            'page_header'       => 'Attendance Details',
            'daily_time_record' => $daily_time_record,
            'branches'          => $branches,
            'employees'         => $employees,
            'active_menu'       => $this->active_menu,
        );
        $this->load_view('pages/daily_time_record-details');
    }

    public function edit_confirmation($id)
    {
        $daily_time_record_data = $this->daily_time_record_model->get_by(['id' => $id]);
        $data['daily_time_record_data'] = $daily_time_record_data;

        $this->load->view('modals/modal-update-daily_time_record', $data);
    }

    public function update_status($id)
    {
        $daily_time_record_data         = $this->daily_time_record_model->get_by(['id' => $id]);
        $data['daily_time_record_data'] = $daily_time_record_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                $result = $this->daily_time_record_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->daily_time_record_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $daily_time_record_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('daily_time_records');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$daily_time_record_data['name'].'!');
                redirect('daily_time_records');

                $this->session->set_flashdata('failed', 'Unable to edit daily time record');
                redirect('daily_time_records');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-daily_time_record-status', $data);
        }
    }

    public function export()
    {
        $user = $this->ion_auth->user()->row();
        $post = $this->input->post();

        if (!empty($post['employee']))
        {
            if($post['employee'] == 0)
            {
                $data = array(
                    'attendance_daily_time_records.date >=' => date('Y-m-d', strtotime($post['date_from'])),
                    'attendance_daily_time_records.date <=' => date('Y-m-d', strtotime($post['date_to'])),
                    'attendance_daily_time_records.reports_to' => $user->employee_id,
                );
            }
            else {
                $data = array(
                    'attendance_daily_time_records.date >=' => date('Y-m-d', strtotime($post['date_from'])),
                    'attendance_daily_time_records.date <=' => date('Y-m-d', strtotime($post['date_to'])),
                    'attendance_daily_time_records.employee_id' => $post['employee'],
                    'attendance_daily_time_records.reports_to' => $user->employee_id,
                );
            }
        }
        else 
        {
            $data = array(
                'attendance_daily_time_records.date >=' => date('Y-m-d', strtotime($post['date_from'])),
                'attendance_daily_time_records.date <=' => date('Y-m-d', strtotime($post['date_to'])),
                'attendance_daily_time_records.reports_to' => $user->employee_id,
            );
        }

        $daily_time_record = $this->daily_time_record_model->get_details('get_many_by', $data);

        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');



        $current_year = date('Y', strtotime($post['date_from']));
        $current_month = date('F', strtotime($post['date_from']));
        $date_from = date('d', strtotime($post['date_from']));
        $date_to = date('d', strtotime($post['date_to']));

        $data_php = new PHPExcel();

        $data_php->setActiveSheetIndex(0);
        $data_php->getActiveSheet()->setTitle('Daily Time Records')->mergeCells('A1:F1');
        $data_php->getActiveSheet()->getCell('A1')->setValue('DAILY TIME RECORDS FOR THE PERIOD OF '
            .strtoupper($current_month). ' '.$date_from.' - '.$date_to.', '.$current_year);
        
        $data_php->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        
        $data_php->getActiveSheet()->getStyle("A1:F1")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize(12);
        
        $data_php->getActiveSheet()->getStyle("A3:F3")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A3:F3")->getFont()->getColor()->setRGB('ffffff');
        $data_php->getActiveSheet()->getStyle("A3:F3")->getFont()->setSize(12);

        //this is for title
        $data_php->getActiveSheet()->getStyle('A1:F1')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );

        $data_php->getActiveSheet()->getStyle('A3:F3')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '83b32f')
                ),

                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );

        $data_php->getActiveSheet()->setCellValue('A3', 'EMPLOYEE CODE');
        $data_php->getActiveSheet()->setCellValue('B3', 'EMPLOYEE');
        $data_php->getActiveSheet()->setCellValue('C3', 'DATE');
        $data_php->getActiveSheet()->setCellValue('D3', 'TIME IN');
        $data_php->getActiveSheet()->setCellValue('E3', 'TIME OUT');
        $data_php->getActiveSheet()->setCellValue('F3', 'SHIFT SCHEDULE');

        $row = 4;

        foreach ($daily_time_record as $key => $dtr) 
        {
            $data_php->getActiveSheet()->setCellValue('A'.$row, $dtr['employee_code']);
            $data_php->getActiveSheet()->setCellValue('B'.$row, $dtr['full_name']);
            $data_php->getActiveSheet()->setCellValue('C'.$row, date('Y-m-d',strtotime($dtr['date'])));
            $data_php->getActiveSheet()->setCellValue('D'.$row, date('h:i a', strtotime($dtr['time_in'])));
            $data_php->getActiveSheet()->setCellValue('E'.$row, date('h:i a', strtotime($dtr['time_out'])));
            $data_php->getActiveSheet()->setCellValue('F'.$row, $dtr['shift']);

            $row++;
        }

        if ( ! isset($dtr['last_name']) && ! isset($dtr['first_name']) ) 
        {
            $dtr['last_name'] = $user->last_name;
            $dtr['first_name'] = $user->first_name;
        }

        $date_today = date('Y-m-d');
        $ps = $user->last_name . '_' . $user->first_name;

        /**
         * site
         * full_name
         * date yyyy-mm-dd
         * */

        $filename = $dtr['company'] . '_' . $ps . '_' . $date_today . '.xlsx';
              
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($data_php, 'Excel2007');
        ob_end_clean();
        $writer->save('php://output');
        exit;
        
        // echo '<pre>';
        // print_r ($daily_time_record);
        // echo '</pre>';
    }

    public function export_supervision()
    {
        $post = $this->input->post();

        dump($post['employee']);exit;
    }

    public function confirmation()
    {
        $mode = $this->uri->segment(3);
		$dtr_id = $this->uri->segment(4);
        $dtr    = $this->daily_time_log_model->get_details('get_by', ['attendance_time_logs.id' => $dtr_id]);
        
        $log_type = $dtr['log_type'];

		$modal_message = "You're about to <strong>" . $mode . "</strong> time " . strtolower($log_type) . " of " . $dtr['full_name']; 

		$data = array(
			'url' 			=> 'daily_time_records/' . $mode . '/' . $dtr_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
    }

    public function approve()
    {
        $user = $this->ion_auth->user()->row();
        $dtr_id = $this->uri->segment(3);
        $dtr = $this->daily_time_log_model->get_details('get_by', ['attendance_time_logs.id' => $dtr_id]);
        $update = $this->daily_time_log_model->update($dtr_id, ['approval_status' => 1]);

        $shift_schedule = $this->employee_information_model->get_employee_details('get_by', ['employee_information.employee_id' => $dtr['employee_id']]);
        $s_schedule = $this->shift_schedule_model->get_details('get_by', ['id' => $shift_schedule['shift_schedule_id']]);

        $log_type = $dtr['log_type'];

        $minutes_tardy = 0;
        
        $grace_period = $s_schedule['grace_period'];
        $type_of_daily_schedule = $s_schedule['type'];
        $time_in = new DateTime(date('H:i', strtotime($dtr['date_time']))); 
        $time_start = new DateTime(date('H:i', strtotime($s_schedule['time_start'])));

		if ($update) {
           

            if ($log_type == 'IN') {

                 //this is for fixed schedule
                if ($type_of_daily_schedule == 0) {

                $result = $time_in->diff($time_start);
                $late = $result->format('%h') * 60 + $result->format('%i');

                    if (($late > $grace_period)) {
                        
                        $minutes_tardy = $late;

                    }
                    else {

                        $minutes_tardy = 0;

                    }
                }

                //this is for variable schedule
                if ($type_of_daily_schedule == 3) {
                    
                    $result = $time_in->diff($s_schedule['time_start']);
                    $late = $result->format('%h') * 60 + $result->format('%i');

                    if (($late > $grace_period)) {
                        
                        $minutes_tardy = $late;

                    }
                    else {

                        $minutes_tardy = 0;

                    }
                }

                $data = array(
                    'employee_id' => $dtr['employee_id'],
                    'shift_schedule_id' => $shift_schedule['shift_schedule_id'],
                    'reports_to' => $shift_schedule['approver_id'],
                    'date' => date('Y-m-d', strtotime($dtr['date_time'])),
                    'time_in' => $dtr['date_time'],
                    'minutes_tardy' => $minutes_tardy,
                    'company_id' => $user->company_id,
                    'remarks' => 'Approved',
                    'approval_status' => 1
                );

                $this->daily_time_record_model->insert($data);

            } else {

                //TODO: OUT
                $dtr_in = $this->daily_time_record_model->get_details('get_by', [
                    'employee_id' => $dtr['employee_id'],
                    'date' => date('Y-m-d', strtotime($dtr['date_time'])),
                ]);

                $id_dtr = $dtr_in['id'];

                $t_in = date('H:i', strtotime($dtr_in['time_in']));
                $t_out = date('H:i', strtotime($dtr['date_time']));

                $in = new DateTime($t_in);
                $out = new DateTime($t_out);  
                
                $result = $out->diff($in);
                $hours_rendered = $result->format('%h') . '.' . $result->format('%i');

                $time_out = $dtr['date_time'];

                $data = array(
                    'time_out' => $time_out,
                    'number_of_hours' => $hours_rendered
                );

                $dtr_update = $this->daily_time_record_model->update($id_dtr, $data);
            }

			$this->session->set_flashdata('success', 'Time log successfully approved');
			redirect('daily_time_records');
		} else {
			$this->session->set_flashdata('failed', 'Unable to approve time log');
			redirect('daily_time_records');
		}
    }

    public function reject()
    {
        $dtr_id = $this->uri->segment(3);
		$dtr = $this->daily_time_log_model->get_details('get_by', ['attendance_daily_time_logs.id' => $dtr_id]);
		$update = $this->daily_time_log_model->update($dtr_id, ['approval_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', 'Time log rejected');
			redirect('daily_time_records');
		} else {
			$this->session->set_flashdata('failed', 'Unable to reject time log');
			redirect('daily_time_records');
		}	
    }
}
