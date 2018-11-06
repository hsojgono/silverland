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
class Site_model extends MY_Model {

    protected $_table = 'sites';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($site)
    {
        $site['created']       = date('Y-m-d H:i:s');
        $site['active_status'] = 1;
        $site['created_by']    = 0;
        return $site;
    }

    protected function set_default_data($site)
    {
        $site['site_address']   = $site['block_number'].' '.$site['lot_number'].' '.
                                    $site['floor_number'].' '.$site['building_number'].' '.
                                    $site['building_name'].', '.$site['street'];
        $site['status_label']  = ($site['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$site['status_action'] = ($site['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$site['status_icon'] = ($site['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $site['status_url']  = ($site['active_status'] == 1) ? 'deactivate' : 'activate';
        return $site;
    }
    public function get_site_by($param)
    {
        $query = $this->db;
        $query->select('sites.*, companies.name as company_name, branches.name as branch_name');
        $query->join('companies', 'sites.company_id = companies.id', 'left');
        $query->join('branches', 'sites.branch_id = branches.id', 'left');
        $query->order_by('sites.name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_site_by($param)
    {
        $query = $this->db;
        $query->select('sites.*, companies.name as company_name, branches.name as branch_name');
        $query->join('companies', 'sites.company_id = companies.id', 'left');
        $query->join('branches', 'sites.branch_id = branches.id', 'left');
        $query->order_by('sites.name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_site_all()
    {
        $query = $this->db;
        $query->select(
            'sites.*, companies.name as company_name, branches.name as branch_name'
            );

        $query->join('companies', 'sites.company_id = companies.id', 'left');
        $query->join('branches', 'sites.branch_id = branches.id', 'left');
        $query->order_by('sites.name', 'asc');

        return $this->get_all();
    }

    public function get_site_employees()
    {
        $query = $this->db;
        $query->select(
            'sites.*,
             CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name," " ,employees.middle_name) as full_name,
             employees.employee_code as employee_code, employees.id as employee_id,
             positions.name as position_name,
             departments.name as department_name'
            );
        $query->join('employees', 'sites.company_id = employees.company_id', 'left');
        $query->join('employee_information', 'employees.id = employee_information.employee_id', 'left');
        $query->join('positions', 'positions.id = employee_information.position_id', 'left');
        $query->join('departments', 'departments.id = employee_information.department_id', 'left');
        $query->order_by('employees.last_name', 'asc');

        return $this->get_all();
    }
}
