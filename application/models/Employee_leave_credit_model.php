<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Employee_leave_credit_model extends MY_Model
{
    protected $_table      = 'employee_leave_credits';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($leave_credit)
    {
        $leave_credit['created']       = date('Y-m-d H:i:s');
        $leave_credit['created_by']    = 0;
        return $leave_credit;
    }

    protected function set_default_data($leave_credit)
    {
        if ( ! isset($leave_credit)) return FALSE;
        
        // get middle initial base on middle name
        $middle_initial = (strlen($leave_credit['middle_name']) > 1) ? substr($leave_credit['middle_name'], 0, 1) : $leave_credit['middle_name'];

        // get full_name
        $employee_full_name = array(
            $leave_credit['last_name'].', ',
            $leave_credit['first_name'].' ',
            $middle_initial.'.'
        );

        // concat employee first name, middle name, last name
        $leave_credit['full_name'] = strtoupper(implode('', $employee_full_name));
        
        $leave_credit['status_icon'] 	= ($leave_credit['elc_balance'] == 0 ) ? 'badge bg-red' : 'badge bg-green'; 
        
        return $leave_credit;
    }

    public function get_leave_credit_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_by($param);
    }

    public function get_many_leave_credit_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_many_by($param);
    }

    public function get_leave_credit_all()
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_all();
    }

    public function get_leave_credits_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_leave_credits.*,
                    employee_leave_credits.id AS elc_id,
                    employee_leave_credits.position_leave_credit_id AS elc_plc_id,
                    employee_leave_credits.balance AS elc_balance,
                    position_leave_credits.attendance_leave_type_id AS plc_alt_id,
                    position_leave_credits.credits AS elc_credit,
                    attendance_leave_types.name AS leave_type,
                    employees.middle_name,           
                    employees.first_name as first_name,
                    employees.middle_name as middle_name,
                    employees.last_name as last_name,
                    employees.employee_code as employee_code,
                    attendance_leave_types.id as leave_type_id,
                ')
            ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
            ->join('attendance_leave_types', 'employee_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left')
            ->join('employees', 'employees.id = employee_leave_credits.employee_id', 'left')
            ->order_by('elc_balance', 'desc');

        return $this->get_many_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            employee_leave_credits.*,
            employee_leave_credits.id AS elc_id,
            employee_leave_credits.position_leave_credit_id AS elc_plc_id,
            employee_leave_credits.balance AS elc_balance,
            employee_leave_credits.employee_id as elc_employee_id,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name,
            employees.employee_code as employee_code,
            attendance_leave_types.name as leave_type,
            attendance_leave_types.id AS leave_type_id,
            companies.id as company_id,
            companies.name as company_name,
            companies.short_name as company_short_name
        ')
        ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
        ->join('attendance_leave_types', 'employee_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left')
        ->join('employees', 'employees.id = employee_leave_credits.employee_id', 'left')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'left')
        ->join('positions', 'employee_information.position_id = positions.id', 'left')
        ->join('companies', 'employee_leave_credits.company_id = companies.id', 'left')
        ->order_by('employee_code', 'asc');

        return $this->{$method}($where);
    }

    public function get_leave_balance($method, $where)
    {
        $this->db->select('
            employee_leave_credits.*,
            employee_leave_credits.id AS elc_id,
            employee_leave_credits.position_leave_credit_id AS elc_plc_id,
            employee_leave_credits.balance AS elc_balance,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name,      
        ')
        ->join('employees', 'employees.id = employee_leave_credits.employee_id', 'left')
        ->join('attendance_leave_types', 'employee_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $this->{$method}($where);
    }
}
