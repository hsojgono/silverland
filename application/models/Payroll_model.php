<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_model extends MY_Model
{
    
    protected $_table = 'payroll';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    protected $before_create = ['prep_data_before_create'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function prep_data_before_create($payroll)
    {
        $payroll['created']         = date('Y-m-d H:i:s');
        $payroll['created_by']      = $this->ion_auth->user()->row()->id;
        $payroll['validity_status'] = 1;

        return $payroll;
    }

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected function set_default_data($payroll)
    {
        if (!isset($payroll)) {
            return FALSE;
        }

        $payroll['status_label'] = (isset($payroll['validity_status']) && $payroll['validity_status'] == 1) ? '<span class="label label-success">Valid</span>' : '<span class="label label-danger">Void</span>';
        $payroll['status_url'] = (isset($payroll['validity_status']) && $payroll['validity_status'] == 1) ? 'void' : 'valid';
        $payroll['status_action'] = (isset($payroll['validity_status']) && $payroll['validity_status'] == 1) ? 'Deactivate' : 'Activate';
        $payroll['status_icon'] = (isset($payroll['validity_status']) && $payroll['validity_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';

        if (isset($payroll['cutoff'])) {

            switch ($payroll['cutoff']) {

                case 1:
                    $payroll['cut_off'] = 'First Period';
                    break;

                case 2:
                    $payroll['cut_off'] = 'Second Period';
                    break;

                case 3:
                    $payroll['cut_off'] = '13th Month Pay';
                    break;

                case 4:
                    $payroll['cut_off'] = 'Leave Conversion';
                    break;

                case 5:
                    $payroll['cut_off'] = 'Daily Workers';
                    break;

                case 6:
                    $payroll['cut_off'] = 'Other Pay Out';
                    break;

                case 7:
                    $payroll['cut_off'] = 'Annualization';
                    break;

                default:
                    $payroll['cut_off'] = 'Others';
                    break;
            }
        }

        $middle_name = ( ! empty($payroll['middle_name']) && isset($payroll['middle_name'])) ? $payroll['middle_name'] : '';
        
        if (isset($payroll['last_name']) && isset($payroll['first_name'])) {
            $full_name = implode(array(
                $payroll['last_name'] . ', ',
                $payroll['first_name'] . ' ',
                $middle_name
            ));
            $payroll['full_name'] = strtoupper($full_name);
        }

        if (isset($payroll['active_status'])) {
            $payroll['status_label'] = ($payroll['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
            $payroll['status_url'] = ($payroll['active_status'] == 1) ? 'deactivate' : 'activate';
            $payroll['status_action'] = ($payroll['active_status'] == 1) ? 'Deactivate' : 'Activate';
            $payroll['status_icon'] = ($payroll['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        }

        return $payroll;
    }

    /**
     * Undocumented function
     *
     * @param [type] $method
     * @param [type] $where
     * @return void
     */
    public function get_details($method, $where)
    {
        $this->db->select('
            payroll.*, 
            payroll_employees.id as employee_id,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name
        ')
        ->join('payroll_employees', 'payroll_employees.payroll_id=payroll.id', 'LEFT')
        ->join('employees', 'payroll_employees.employee_id=employees.id', 'LEFT');

        return $this->{$method}($where);
    }
    public function get_payroll_all()
    {
        $this->db->select('*')
        ->order_by('id', 'DESC');
         return $this->get_all();
    }
    
    public function get_payroll_by($param)
    {
        $query = $this->db;
        $query->select('payroll.*,
            payroll_employees.gross,
            payroll_employees.tax')

        ->join('payroll_employees', 'payroll_employees.payroll_id=payroll.id', 'LEFT')
        ->join('employees', 'payroll_employees.employee_id=employees.id', 'LEFT');
        return $this->get_by($param);
    }


    public function get_with_details($method, $param)
    {
        $this->db->select('
            payroll.start_date, 
            payroll.end_date, 
            payroll.id as payroll_id
        ');
        $this->db->join('payroll_employees as payrollEmployee', 'payroll.id = payrollEmployee.payroll_id', 'left');

        return $this->{$method}($param);
    }

    public function get_daily_payroll_details($method, $where)
    {
        $this->db->select('
            payroll.start_date as start_date, 
            payroll.end_date as end_date, 
            payroll.id as payroll_id
        ');
        $this->db->join('payroll_employees', 'payroll.id = payroll_employees.payroll_id', 'left');

        return $this->{$method}($param);
    }

}

// End of file Payroll_model.php
// Location: ./applicaiton/model/Payroll_model.php
