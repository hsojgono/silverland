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
class Employee_positions_model extends MY_Model {

    protected $_table = 'employee_positions';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $after_get = array('prep_details');
    protected $before_create = ['generate_date_created_status'];

    protected function prep_details($employee_position)
    {
        if ( ! isset($employee_position)) return FALSE;
        
        // get middle initial base on middle name
        $middle_initial = (strlen($employee_position['middle_name']) > 1) ? substr($employee_position['middle_name'], 0, 1) : $employee_position['middle_name'];

        $full_name = array(
            $employee_position['last_name'].', ',
            $employee_position['first_name'].' ',
            $middle_initial
        );

        // concat employee first name, middle name, last name
        $employee_position['full_name'] = strtoupper(implode('', $full_name));

        // check if active or inactive then set labels
        $employee_position['status_label'] = ($employee_position['active_status'] == 1) ? 'ACTIVE':'INACTIVE';

        return $employee_position;
    }

    protected function generate_date_created_status($employee_position)
    {
        $employee_position['created']       = date('Y-m-d H:i:s');
        $employee_position['created_by']    = $this->ion_auth->user()->row()->id;
        $employee_position['active_status'] = 1;

        return $employee_position;
    }

    public function get_details($method, $where)
    {
        $this->db->select('
                employee_positions.id as employee_positions_id,
                employee_positions.employee_id,
                employee_positions.date_started,
                employee_positions.date_ended,
                employee_positions.active_status,
                employee.first_name,
                employee.middle_name,
                employee.last_name,
                company.name AS company,
                branch.name AS branch,
                cost_center.name AS cost_center,
                department.name AS department,
                team.name AS team,
                site.name AS site,
                position.id AS position_id,
                position.name AS position,
            ')
            ->join('employees as employee', 'employee_positions.employee_id = employee.id', 'left')
            ->join('positions as position', 'employee_positions.position_id = position.id', 'left')
            ->join('companies as company', 'employee_positions.company_id = company.id', 'left')
            ->join('branches as branch', 'employee_positions.branch_id = branch.id', 'left')
            ->join('departments as department', 'employee_positions.department_id = department.id', 'left')
            ->join('teams as team', 'employee_positions.team_id = team.id', 'left')
            ->join('cost_centers as cost_center', 'employee_positions.cost_center_id = cost_center.id', 'left')
            ->join('sites as site', 'employee_positions.site_id = site.id', 'left')
            ->order_by('employee_positions.id', 'desc');

        return $this->{$method}($where);
    }

    public function get_fields()
    {
        return $this->db->list_fields($this->_table);
    }
}
