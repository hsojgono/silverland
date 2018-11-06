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
class Department_model extends MY_Model {

    protected $_table = 'departments';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($department)
    {
        $department['created']       = date('Y-m-d H:i:s');
        $department['created_by']    = $this->ion_auth->user()->row()->id;
        $department['active_status'] = 1;
        return $department;
    }

    protected function set_default_data($department)
    {
        $department['status_label']  = ($department['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$department['status_action'] = ($department['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$department['status_icon'] = ($department['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $department['status_url']  = ($department['active_status'] == 1) ? 'deactivate' : 'activate';

        $department['department_id'] = ($department['department_id'] != 0 || NULL) ? $department['department_name'] : '';
        
        // $department['active_status'] = ($department['active_status'] == 1) ? 'Active' : 'Inactive';
        // $department['status_label']  = ($department['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        // $department['status_color']  = ($department['active_status'] == 'Active') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        return $department;
    }

    public function get_department_by($param)
    {
        $query = $this->db;
        $query->select('departments.*');
        $query->order_by('name', 'asc');
        //$query->join('companies', 'departments.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_department_by($param)
    {
        $query = $this->db;
        $query->select('departments.*');
        $query->order_by('name', 'asc');
        // $query->join('companies', 'departments.company_id = companies.id', 'left');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_department_all()
    {
        $query = $this->db;
        $query->select('departments.*, companies.name as company_name');
        $query->join('companies', 'departments.company_id = companies.id', 'left');
        $query->order_by('departments.name', 'asc');

        return $this->get_all();
    }

    // SMTI-RDaludado
    public function get_department($where = '')
    {
        $this->db->select('
            departments.*,
            departments.name as department_name,
            departments.active_status as active_status,
            employee_information.department_id as department_id
        ')
        ->join('employee_information', 'departments.id = employee_information.department_id', 'left');
        // ->join('employees', 'employees.id = employee_information.employee_id', 'left');
        return $this->get_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            departments.*,
            companies.name as company_name,
            departments.name as department_name,
            branches.name as branch_name,
            sites.name as site_name
        ')
        ->join('companies', 'companies.id = departments.company_id', 'left')
        ->join('branches', 'branches.id = departments.branch_id', 'left')
        ->join('sites', 'sites.id = departments.site_id', 'left');

        return $this->{$method}($where);
    }
}
