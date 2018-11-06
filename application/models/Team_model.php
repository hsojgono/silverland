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
class Team_model extends MY_Model {

    protected $_table      = 'teams';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($team)
    {
        $user                  = $this->ion_auth->user()->row();
        $team['created']       = date('Y-m-d H:i:s');
        $team['created_by']    = $user->employee_id;
        $team['active_status'] = 1;
        return $team;
    }

    protected function set_default_data($team)
    {
        $team['active_status']  = ($team['active_status'] == 1) ? 'Active' : 'Inactive';
        $team['status_label'] = ($team['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        $team['status_color']  = ($team['active_status'] == 'Active') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        return $team;
    }

    public function get_team_by($param)
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_by($param);
    }

    public function get_many_team_by($param)
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_many_by($param);
    }

    public function get_team_all()
    {
        $query = $this->db;
        $query->select('*');

        return $this->get_all();
    }

    public function get_team_data($from = 'teams', $where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->select('*')->from($from)->get();

        return $query->result_array();
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            teams.*,
            companies.name as company_name,
            branches.name as branch_name,
            departments.name as department_name,
            sites.name as site_name,
            cost_centers.name as cost_center_name
        ')
        ->join('companies', 'teams.company_id = companies.id', 'left')
        ->join('branches', 'teams.branch_id = branches.id', 'left')
        ->join('departments', 'teams.department_id = departments.id', 'left')
        ->join('sites', 'teams.site_id = sites.id', 'left')
        ->join('cost_centers', 'teams.cost_center_id = cost_centers.id', 'left');
        return $this->{$method}($where);
    }
}

