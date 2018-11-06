<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      SMTI-RDaludado
 * @link        http://systemantech.com
 */
class Position_model extends MY_Model {

    protected $_table = 'positions';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($position)
    {
        $position['created']       = date('Y-m-d H:i:s');
        $position['active_status'] = 1;
        $position['created_by']    = $this->ion_auth->user()->row()->id;
        return $position;
    }

    protected function set_default_data($position)
    {   
        if (! isset($position)) return FALSE;
        
        $position['status_label']   = ($position['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $position['status_url'] 	 = ($position['active_status'] == 1) ? 'deactivate' : 'activate';
        $position['status_action']  = ($position['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$position['status_icon']    = ($position['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $position;
    }

    // public function get_position_by($param)
    // {
    //     $query = $this->db;
    //     $query->select('*');
    //     // $query->join('employee_info', 'employee_info.position_id = positions.id');

    //     return $this->get_by($param);
    // }

    public function get_many_position_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.position_id = positions.id');

        return $this->get_many_by($param);
    }

    public function get_position_by($param)
    {
        $query = $this->db;
        $query->select('positions.*, companies.name as company_name, 
                        CONCAT_WS(' . '" "' . ', system_users.last_name,", " ,system_users.first_name) as full_name');
        $query->join('system_users', 'system_users.employee_id=positions.created_by','left');
        $query->join('companies', 'positions.company_id = companies.id', 'left');
        $query->order_by('positions.name', 'asc');

        return $this->get_by($param);
    }


    // public function get_position_all()
    // {
    //     $query = $this->db;
    //     $query->select('*');
    //     return $this->get_all();
    // }

    // public function get_position_data($from = 'positions', $where = '')
    // {
    //     if ( ! empty($where)) {
    //         $this->db->where($where);
    //     }
    //     $query = $this->db->select('*')->from($from)->get();

    //     return $query->result_array();

    // }

    public function get_details($method, $where)
    {
        $this->db->select('
            positions.*,
            companies.name as company_name,
            salary_grades.grade_code as grade_code
        ')
        ->join('companies', 'companies.id=positions.company_id', 'left')
        ->join('salary_grades', 'salary_grades.id=positions.salary_grade_id', 'left')
        ->order_by('created', 'asc');

        return $this->{$method}($where);
    }
        // SMTI-RDaludado
    public function get_position($where = '')
    {
        $this->db->select('
            positions.*,
            positions.name as position_name
        ')
        ->join('employee_information', 'positions.id = employee_information.position_id', 'left')
        ->join('employees', 'employees.id = employee_information.employee_id', 'left');      
        // ->join('employee_positions', 'positions.id = employee_positions.position_id', 'left');
        return $this->get_by($where);
    }
}