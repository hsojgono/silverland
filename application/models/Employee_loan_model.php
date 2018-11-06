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
class Employee_loan_model extends MY_Model {

    protected $_table      = 'employee_loans';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_update = ['set_data_before_update'];
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($employee_loans)
    {
        $user = $this->ion_auth->user()->row();

        $employee_loans['created'] = date('Y-m-d H:i:s');
		$employee_loans['created_by'] = $user->id;
        $employee_loans['active_status'] = 1;
        return $employee_loans;
    }

    protected function set_data_before_update($employee_loans)
    {
        $employee_loans['modified']    = date('Y-m-d H:i:s');
        $employee_loans['modified_by'] = $this->ion_auth->user()->row()->id;
        return $employee_loans;
    }    

    protected function set_default_data($employee_loan)
    {
        $employee_loan['status_label']  = ($employee_loan['active_status'] == 1) ? '<span class="label label-success">Active</span>' : 
                                                                                 '<span class="label label-danger">Inactive</span>';

        $employee_loan['status_action'] = ($employee_loan['active_status'] == 1) ? 'Deactivate' : 'Activate';
        $employee_loan['status_icon'] = ($employee_loan['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $employee_loan['status_url']  = ($employee_loan['active_status'] == 1) ? 'deactivate' : 'activate';

        if ( ! isset($employee_loan)) {
            return FALSE;
        }
        
        if (isset($employee_loan['middle_name']) && isset($employee_loan['first_name']) && isset($employee_loan['last_name'])) {
            $middle_name = ( ! empty($employee_loan['middle_name'])) ? $employee_loan['middle_name'] : '';
            $full_name = $employee_loan['last_name'].', '.$employee_loan['first_name'].' '.$middle_name;
            $employee_loan['full_name'] = strtoupper($full_name);
        }

        // $employee_loan['status_loan_action'] = ($employee_loan['approval_status'] == 1) ? 'Approved' : 'Pending';
        $employee_loan['status_loan_label']  = ($employee_loan['approval_status'] == 1) ? '<span class="label label-success">APPROVED</span>' : 
                                                                                 '<span class="label label-warning">PENDING</span>';

        return $employee_loan; 
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            employee_loans.*,
            employee_loans.id as employee_loan_id,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name,
            employees.company_id as company_id,
            loan_types.interest_per_month as interest_per_month,
            loan_types.name as loan_type,
            loan_types.frequency as frequency
        ')
        ->join('employees', 'employees.id = employee_loans.employee_id', 'left')
        ->join('loan_types', 'loan_types.id = employee_loans.loan_type_id', 'left');
        return $this->{$method}($where);
    }
}
