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
class Violation_level_model extends MY_Model {

    protected $_table = 'violation_levels';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($violation_level)
    {
        $violation_level['created']       = date('Y-m-d H:i:s');
        $violation_level['active_status'] = 1;
        $violation_level['created_by']    = $this->ion_auth->user()->row()->id;
        return $violation_level;
    }

    protected function set_default_data($violation_level)
    {   
        $violation_level['status_label']   = ($violation_level['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $violation_level['status_url'] 	 = ($violation_level['active_status'] == 1) ? 'deactivate' : 'activate';
        $violation_level['status_action']  = ($violation_level['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$violation_level['status_icon']    = ($violation_level['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $violation_level;
    }



    public function get_many_violation_level_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.violation_level_id = violation_levels.id');

        return $this->get_many_by($param);
    }

    public function get_violation_level_by($param)
    {
        $query = $this->db;
        $query->select('violation_levels.*, companies.name as company_name');
        $query->join('system_users', 'system_users.employee_id=violation_levels.created_by','left');
        $query->join('companies', 'violation_levels.company_id = companies.id', 'left');
        $query->order_by('violation_levels.name', 'asc');

        return $this->get_by($param);
    }


    public function get_details($method, $where)
    {
        $this->db->select('
			violation_levels.*,
			violation_levels.name as  name,
			violation_levels.description as description,
            companies.name as company_name,
        ')
        ->join('companies', 'companies.id=violation_levels.company_id', 'left')
        ->order_by('created', 'asc');

        return $this->{$method}($where);
    }
    // public function get_violation_level($where = '')
    // {
    //     $this->db->select('
    //         violation_levels.*,
    //         violation_levels.name as name
    //     ')
    //     ->join('employee_violation_levels', 'violation_levels.id = employee_violation_levels.violation_level_id', 'left');
    //     return $this->get_by($where);
    // }
}