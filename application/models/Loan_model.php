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
class Loan_model extends MY_Model {

    protected $_table = 'employee_loans';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($loan)
    {
        $loan['created']       = date('Y-m-d H:i:s');
        $loan['active_status'] = 1;
        $loan['created_by']    = '0';
        return $loan;
    }

    protected function set_default_data($loan)
    {
        if (!isset($loan)) {
            return FALSE;
        }

        $middle_name = ( ! empty($loan['middle_name']) && isset($loan['middle_name'])) ? $loan['middle_name'] : '';
        
        if (isset($loan['last_name']) && isset($loan['first_name'])) {
            $full_name = implode(array(
                $loan['last_name'] . ', ',
                $loan['first_name'] . ' ',
                $middle_name
            ));
            $loan['full_name'] = strtoupper($full_name);
        }
        $loan['status_label']  = ($loan['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$loan['status_action'] = ($loan['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$loan['status_icon'] = ($loan['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $loan['status_url']  = ($loan['active_status'] == 1) ? 'deactivate' : 'activate';
        
        // $loan['active_status'] = ($loan['active_status'] == 1) ? 'Active' : 'Inactive';
        // $loan['status_label']  = ($loan['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        // $loan['status_color']  = ($loan['active_status'] == 'Active') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        return $loan;
    }

    public function get_loan_by($param)
    {
        $query = $this->db;
        $query->select('employee_loans.*');
        $query->order_by('id', 'asc');
        $query->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left')
        ->join('employee_information', 'employee_loans.id = employee_information.employee_id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left');

        return $this->get_by($param);
    }

    public function get_many_loan_by($param)
    {
        $query = $this->db;
        $query->select('employee_loans.*');
        $query->order_by('id', 'asc');
        $query->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left')
        ->join('employee_information', 'employee_loans.id = employee_information.employee_id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left');

        return $this->get_many_by($param);
    }

    public function get_loan_all()
    {
        $query = $this->db;
        $query->select('employee_loans.*,
        employee_loans.id,
        employee_loans.date_start as date_start,
        employees.id as employee_id,
        employees.first_name as first_name,
        employees.middle_name as middle_name,
        employees.last_name as last_name,
        loan_types.name as loan_type_name,
        loan_types.interest_per_month as interest_per_month,

                                        
        ');
        $query->order_by('id', 'asc');
        $query->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left')
        ->join('employees', 'employee_loans.employee_id = employees.id', 'left');

        return $this->get_all();
    }

    // SMTI-RDaludado
    public function get_loan($where = '')
    {
        $this->db->select('
            employee_loans.*,
            employee_loans.name as loan_name
        ')

        ->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left')
        ->join('employee_information', 'employee_loans.id = employee_information.employee_id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left');
        return $this->get_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            employee_loans.*,
            employee_loans.employee_id as employee_id,
            loan_types.name as loan_type_name,
            loan_types.interest_per_month as interest_per_month,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name, 
            payroll_employees.id as payroll_employees_id,
            payroll.start_date as payroll_start_date,
            payroll.end_date as payroll_end_date,
            
    
            
            
        ')
        ->join('loan_types', 'employee_loans.loan_type_id = loan_types.id', 'left')
        ->join('payroll_employees', 'employee_loans.employee_id = payroll_employees.id', 'left')
        ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'left')
        ->join('employee_information', 'employee_loans.approver_id = employee_information.employee_id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left');

        return $this->{$method}($where);
    }
}
