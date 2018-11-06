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
class Sanction_type_model extends MY_Model {

    protected $_table = 'sanction_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($sanction_type)
    {
        $sanction_type['created']       = date('Y-m-d H:i:s');
        $sanction_type['active_status'] = 1;
        $sanction_type['created_by']    = $this->ion_auth->user()->row()->id;
        return $sanction_type;
    }

    protected function set_default_data($sanction_type)
    {   
        $sanction_type['status_label']   = ($sanction_type['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $sanction_type['status_url'] 	 = ($sanction_type['active_status'] == 1) ? 'deactivate' : 'activate';
        $sanction_type['status_action']  = ($sanction_type['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$sanction_type['status_icon']    = ($sanction_type['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $sanction_type;
    }



    public function get_many_sanction_type_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.violation_type_id = violation_types.id');

        return $this->get_many_by($param);
    }

    public function get_sanction_type_by($param)
    {
        $query = $this->db;
        $query->select('sanction_types.*, companies.name as company_name');
        $query->join('system_users', 'system_users.employee_id=sanction_types.created_by','left');
        $query->join('companies', 'sanction_types.company_id = companies.id', 'left');
        $query->order_by('sanction_types.name', 'asc');

        return $this->get_by($param);
    }


    public function get_details($method, $where)
    {
        $this->db->select('
			sanction_types.*,
			sanction_types.name as  name,
			sanction_types.description as description,
            companies.name as company_name,
        ')
        ->join('companies', 'companies.id=sanction_types.company_id', 'left')
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
