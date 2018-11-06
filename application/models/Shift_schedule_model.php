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
class Shift_schedule_model extends MY_Model {

    protected $_table      = 'attendance_shift_schedules';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    // protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($shift_schedule)
    {
        $shift_schedule['created']       = date('Y-m-d H:i:s');
        $shift_schedule['active_status'] = 1;
        $shift_schedule['created_by']    = 0;
        return $shift_schedule;
    }

    protected function set_default_data($shift_schedule)
    {
        $shift_schedule['status_label']  = ($shift_schedule['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$shift_schedule['status_action'] = ($shift_schedule['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$shift_schedule['status_icon'] = ($shift_schedule['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $shift_schedule['status_url']  = ($shift_schedule['active_status'] == 1) ? 'deactivate' : 'activate';
    
        $shift_schedule['type_label']     = (($shift_schedule['type'] == 0) ? 'Fixed' : (($shift_schedule['type'] == 1) ?   'Flexi':'Variable'));
        $shift_schedule['timestamp_start'] = strtotime($shift_schedule['time_start']);
        $shift_schedule['timestamp_end']   = strtotime($shift_schedule['time_end']);
        return $shift_schedule;
    }

    public function get_shift_schedule_by($where)
    {
        $query = $this->db;
        $query->select('
                    attendance_shift_schedules.*,
                    companies.name as company_name
                ');
        $query->join('companies', 'attendance_shift_schedules.company_id = companies.id', 'left');

        return $this->get_by($where);
    }

    public function get_schedule_by($where)
    {
        $this->db->
        select('
            attendance_shift_schedules.*,
            attendance_shift_schedules.type as att_shift_type,
            attendance_shift_schedules.time_start as time_start,
            attendance_shift_schedules.time_end as time_end,
            attendance_shift_schedules.grace_period as grace_period,
            attendance_employee_daily_schedules.shift_id as att_shift_schedule_id,
            attendance_employee_daily_schedules.date as att_date,
            companies.id as company_id,
            branches.id as branch_id,
            sites.id as site_id,
            employees.employee_code as employee_code,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_information.employee_id as employee_id,
            employee_information.reports_to as reports_to,
            employee_information.shift_type as info_shift_type,
            employee_information.shift_schedule_id as info_shift_schedule_id
        ')
        ->join('employee_information', 'employee_information.shift_schedule_id = attendance_shift_schedules.id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left')
        ->join('attendance_employee_daily_schedules', 'attendance_employee_daily_schedules.employee_id = employee_information.employee_id', 'left')
        ->join('companies', 'employee_information.company_id = companies.id', 'left')
        ->join('branches', 'employee_information.branch_id = branches.id', 'left')
        ->join('sites', 'employee_information.site_id = sites.id', 'left');

        return $this->get_by($where);
    }
    
    public function get_many_shift_schedule_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_shift_schedule_all()
    {
        $query = $this->db;
        $query->select('
                    attendance_shift_schedules.*,
                    companies.name as company_name
                ');
        $query->join('companies', 'attendance_shift_schedules.company_id = companies.id', 'left');
        return $this->get_all();
    }

    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}
