<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.kevin@systemantech.com
 * @link        http://systemantech.com
 */

class Daily_time_record_model extends MY_Model {

    protected $_table 	   = 'attendance_daily_time_records';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    // protected $before_create = ['generate_date_created_status'];
    // protected $after_create  = ['write_audit_trail'];
    // protected $after_update  = ['write_audit_trail'];
    protected $after_get 	 = array('set_default_data');

    // protected function generate_date_created_status($daily_time_record)
    // {
    //     $daily_time_record['status']          = 1; //filed
    //     $daily_time_record['approval_status'] = 0; //subject for approval
    //     return $daily_time_record;
    // }

    protected function set_default_data($daily_time_record)
    {
    	if ( ! isset($daily_time_record)) return FALSE;

		$middle_initial = (strlen($daily_time_record['middle_name']) > 1) ? substr($daily_time_record['middle_name'], 0, 1) : $daily_time_record['middle_name'];

		$full_name = array(
			$daily_time_record['last_name'].', ',
			$daily_time_record['first_name'].' ',
			$middle_initial
		);

        $shift = array(
            date('h:i A', strtotime($daily_time_record['time_start'])).' - ',
            date('h:i A', strtotime($daily_time_record['time_end']))
        );

		$daily_time_record['full_name'] = strtoupper(implode('', $full_name));
        $daily_time_record['shift']     = implode('', $shift);
        $daily_time_record['timein']    = ($daily_time_record['time_in'] == '0000-00-00 00:00:00') ? '-' : date('h:i A', strtotime($daily_time_record['time_in']));
        $daily_time_record['timeout']   = ($daily_time_record['time_out'] == '0000-00-00 00:00:00') ? '-' : date('h:i A', strtotime($daily_time_record['time_out']));
        $daily_time_record['status_action_in'] = ($daily_time_record['approval_in'] == 1) ? 'Approved' : 'Pending';
        $daily_time_record['status_action_out'] = ($daily_time_record['approval_out'] == 1) ? 'Approved' : 'Pending';
        return $daily_time_record;
    }

    public function get_details($method, $where)
    {
    	$this->db->select('
    		attendance_daily_time_records.*,
			employee.first_name,
			employee.middle_name,
            employee.last_name,
            employee.employee_code,
            attendance_shift_schedules.code as shift_code,
            attendance_shift_schedules.time_start as time_start,
            attendance_shift_schedules.time_end as time_end,
            companies.short_name as company
    	')
    	->join('employees as employee', 'attendance_daily_time_records.employee_id = employee.id', 'left')
    	->join('attendance_shift_schedules', 'attendance_daily_time_records.shift_schedule_id = attendance_shift_schedules.id', 'left')
        ->join('companies', 'attendance_daily_time_records.company_id = companies.id', 'left')
        ->order_by('employee.employee_code', 'DESC')
        ->order_by('employee.last_name', 'ASC')
        ->order_by('employee.first_name', 'ASC')
        ->order_by('employee.middle_name', 'ASC')
        ->order_by('attendance_daily_time_records.date', 'DESC');
        // ->order_by('date', 'DESC');        
    	return $this->{$method}($where);
    }

    // public function get_dtr($method, $where)
    // {
    //     $this->db->select('
    //         attendance_daily_time_records.*,
    //         employee.first_name,
	// 		employee.middle_name,
	// 		employee.last_name,
    //         attendance_shift_schedules.code as shift_code,
    //     ')
    //     ->join('attendance_shift_schedules', 'attendance_daily_time_records.shift_schedule_id = attendance_shift_schedules.id', 'left')
    // 	->join('employees as employee', 'attendance_daily_time_records.employee_id = employee.id', 'left');
        
    //     return $this->{$method}($where);
    // }

    public function night_diff()
    {
        $data['test'] = 'night diff';

        $this->load->library('attendance_dtr');
        $data['hoursNum'] = $this->attendance_dtr->number_of_hours;

        return $data;
    }
}
