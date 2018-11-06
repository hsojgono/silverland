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
class Cost_center_model extends MY_Model {

    protected $_table      = 'cost_centers';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($cost_center)
    {
        $cost_center['created']       = date('Y-m-d H:i:s');
        $cost_center['created_by']    = 0;
        $cost_center['active_status'] = 1;
        return $cost_center;
    }

    // protected function set_modified_data($cost_center)
    // {
    //     $cost_center['modified'] = date('Y-m-d H:i:s');
    //     return $cost_center;
    // }

    protected function set_default_data($cost_center)
    {
        $cost_center['status_label']  = ($cost_center['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$cost_center['status_action'] = ($cost_center['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$cost_center['status_icon'] = ($cost_center['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $cost_center['status_url']  = ($cost_center['active_status'] == 1) ? 'deactivate' : 'activate';
       
        return $cost_center;
    }

    public function get_cost_center_by($param)
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_cost_center_by($param)
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_cost_center_all()
    {
        $query = $this->db;
        $query->select('cost_centers.*, companies.name as company_name');
        $query->join('companies', 'cost_centers.company_id = companies.id', 'left');
        $query->order_by('cost_centers.name', 'asc');

        return $this->get_all();
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            cost_centers.*,
            companies.name as company_name,
            branches.name as branch_name,
            departments.name as department_name,
            teams.name as team_name
        ')
        ->join('companies','companies.id = cost_centers.company_id','left')
        ->join('branches','branches.id = cost_centers.branch_id','left')
        ->join('departments','departments.id = cost_centers.department_id','left')
        ->join('teams','teams.id = cost_centers.team_id','left');
        return $this->{$method}($where);
    }
}
