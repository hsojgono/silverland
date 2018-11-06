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
class Violation_type_model extends MY_Model {

    protected $_table = 'violation_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($violation_type)
    {
        $violation_type['created']       = date('Y-m-d H:i:s');
        $violation_type['active_status'] = 1;
        $violation_type['created_by']    = $this->ion_auth->user()->row()->id;
        return $violation_type;
    }

    protected function set_default_data($violation_type)
    {   
        $violation_type['status_label']   = ($violation_type['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $violation_type['status_url'] 	 = ($violation_type['active_status'] == 1) ? 'deactivate' : 'activate';
        $violation_type['status_action']  = ($violation_type['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$violation_type['status_icon']    = ($violation_type['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $violation_type;
    }



    public function get_many_violation_type_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.violation_type_id = violation_types.id');

        return $this->get_many_by($param);
    }

    public function get_violation_type_by($param)
    {
        $query = $this->db;
        $query->select('violation_types.*, companies.name as company_name');
        $query->join('system_users', 'system_users.employee_id=violation_types.created_by','left');
        $query->join('companies', 'violation_types.company_id = companies.id', 'left');
        $query->order_by('violation_types.name', 'asc');

        return $this->get_by($param);
    }


    public function get_details($method, $where)
    {
        $this->db->select('
			violation_types.*,
			violation_types.name as  name,
			violation_types.description as description,
            companies.name as company_name,
        ')
        ->join('companies', 'companies.id=violation_types.company_id', 'left')
        ->order_by('created', 'asc');

        return $this->{$method}($where);
    }
    // public function get_violation_type($where = '')
    // {
    //     $this->db->select('
    //         violation_types.*,
    //         violation_types.name as name
    //     ')
    //     ->join('employee_violation_types', 'violation_types.id = employee_violation_types.violation_type_id', 'left');
    //     return $this->get_by($where);
    // }
}
