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
class Violation_model extends MY_Model {

    protected $_table = 'violations';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($violation)
    {
        $violation['created']       = date('Y-m-d H:i:s');
        $violation['active_status'] = 1;
        $violation['created_by']    = $this->ion_auth->user()->row()->id;
        return $violation;
    }

    protected function set_default_data($violation)
    {   
        if ( ! isset($violation['id'])) return FALSE;
        $violation['status_label']   = (isset($violation['active_status']) && $violation['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $violation['status_url'] 	 = (isset($violation['active_status']) && $violation['active_status'] == 1) ? 'deactivate' : 'activate';
        $violation['status_action']  = (isset($violation['active_status']) && $violation['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$violation['status_icon']    = (isset($violation['active_status']) && $violation['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $violation;
    }



    public function get_many_violation_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.violation_id = violations.id');

        return $this->get_many_by($param);
    }

    public function get_violation_by($param)
    {
        $query = $this->db;
        $query->select('
            violations.*, 
			violation_levels.name as violation_level_name,
			violation_types.name as violation_type_name,
            companies.name as company_name
        ');
        $query->join('violation_levels', 'violation_levels.id=violations.violation_level_id', 'left');
        $query->join('violation_types', 'violation_types.id=violations.violation_type_id', 'left');
        $query->join('system_users', 'system_users.employee_id=violations.created_by','left');
        $query->join('companies', 'violations.company_id = companies.id', 'left');
        $query->order_by('violations.id', 'asc');

        return $this->get_by($param);
    }


    public function get_details($method, $where)
    {
        $this->db->select('
			violations.*,
			violation_levels.name as violation_level_name,
			violation_types.name as violation_type_name,
            companies.name as company_name
		')
        ->join('violation_levels', 'violation_levels.id=violations.violation_level_id', 'left')
        ->join('violation_types', 'violation_types.id=violations.violation_type_id', 'left')
        ->join('companies', 'companies.id=violations.company_id', 'left')
        ->order_by('created', 'asc');

        return $this->{$method}($where);
    }
    // public function get_violation($where = '')
    // {
    //     $this->db->select('
    //         violations.*,
    //         violations.name as name
    //     ')
    //     ->join('employee_violations', 'violations.id = employee_violations.violation_id', 'left');
    //     return $this->get_by($where);
    // }
}