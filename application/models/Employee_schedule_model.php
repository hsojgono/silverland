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
class Employee_schedule_model extends MY_Model {

    protected $_table      = 'attendance_employee_daily_schedules';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    // /**
    //  * Callbacks or Observers
    //  */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data', ];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($employee_schedule)
    {
        $employee_schedule['status']     = 1;
        $employee_schedule['created']    = date('Y-m-d H:i:s');
        $employee_schedule['created_by'] = $this->ion_auth->user()->row()->employee_id;
        return $employee_schedule;
    }

    protected function set_default_data($employee_schedule)
    {

        if ( ! isset($employee_schedule['id'])) return FALSE;
        
        $employee_schedule['active_status'] = ($employee_schedule['status'] == 1) ? 'Active' : 'Inactive';
        $employee_schedule['status_label']  = ($employee_schedule['status'] == 'Active') ? 'De-activate' : 'Activate';

        // $fullname = array(
        //     $employee_schedule['last_name'].',',
        //     $employee_schedule['first_name'],
        //     $employee_schedule['middle_name']
        // );

        // $employee_schedule['fullname'] = strtoupper(implode(' ', $fullname));

        return $employee_schedule;
    }

    public function get_employee_schedule_by($where)
    {
        $query = $this->db;
        $query->select('
                    attendance_employee_daily_schedules.*,
                    employees.*,
                    companies.name as company_name,
                    employees.employee_code as employee_code,
                    attendance_shift_schedules.code as shift_code
                ');
        $query->join('companies', 'attendance_employee_daily_schedules.company_id = companies.id', 'left');
        $query->join('employees', 'attendance_employee_daily_schedules.employee_id = employees.id', 'left');
        $query->join('attendance_shift_schedules', 'attendance_employee_daily_schedules.shift_id = attendance_shift_schedules.id', 'left');
        $query->order_by('date', 'desc');

        return $this->get_many_by($where);
    }

    public function get_many_employee_schedule_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_employee_schedule_all()
    {
        $query = $this->db;
        $query->select('
                    attendance_employee_daily_schedules.*,
                    companies.name as company_name,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                    attendance_shift_schedules.code as shift_code
                ');
        $query->join('companies', 'attendance_employee_daily_schedules.company_id = companies.id', 'left');
        $query->join('employees', 'attendance_employee_daily_schedules.employee_id = employees.id', 'left');
        $query->join('attendance_shift_schedules', 'attendance_employee_daily_schedules.shift_id = attendance_shift_schedules.id', 'left');
        $query->order_by('date', 'desc');

        return $this->get_all();
    }

    public function get_employees_by($where = '')
    {
        $this->db->select('
            attendance_employee_daily_schedules.*,
            attendance_employee_daily_schedules.id as attendance_id,
            employees.id as employee_id,
            employees.employee_code as employee_code,
            CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
            employee_information.reports_to,
            companies.name as company_name,
            attendance_shift_schedules.code as shift_code
            ')
        ->join('employees', 'employees.id = attendance_employee_daily_schedules.employee_id', 'left')
        ->join('employee_information', 'employee_information.id = attendance_employee_daily_schedules.employee_id', 'left')
        ->join('companies', 'attendance_employee_daily_schedules.company_id = companies.id', 'left')
        ->join('attendance_shift_schedules', 'attendance_employee_daily_schedules.shift_id = attendance_shift_schedules.id', 'left')
        ->order_by('employees.last_name', 'asc');

        return $this->get_many_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            attendance_employee_daily_schedules.*,
            attendance_shift_schedules.time_start as time_start,
            attendance_shift_schedules.time_end as time_end,
            attendance_shift_schedules.grace_period as grace_period,
            attendance_shift_schedules.number_of_hours as number_of_hours,
            attendance_shift_schedules.type as type
        ')
        ->join('attendance_shift_schedules', 'attendance_employee_daily_schedules.shift_id = attendance_shift_schedules.id', 'left');
        return $this->{$method}($where);
    }
}
