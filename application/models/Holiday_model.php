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
class Holiday_model extends MY_Model {

    protected $_table      = 'attendance_holidays';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($holiday)
    {
        $holiday['created']       = date('Y-m-d H:i:s');
        $holiday['created_by']    = $this->ion_auth->user()->row()->id;
        $holiday['active_status'] = 1;
        return $holiday;
    }

    protected function set_default_data($holiday)
    {

        if ( ! isset($holiday)) return FALSE;
        $holiday['status_label'] = ($holiday['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $holiday['status_action'] = ($holiday['active_status'] == 1) ? 'Deactivate' : 'Activate';
        $holiday['status_icon'] = ($holiday['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $holiday['status_url'] = ($holiday['active_status'] == 1) ? 'deactivate' : 'activate';
        return $holiday;
    }

    public function get_holiday_by($param)
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_holiday_by($param)
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');
        return $this->get_many_by($param);
    }

    public function get_holiday_all()
    {
        $query = $this->db;
        $query->select('
            attendance_holidays.*,
            companies.name as company_name,
            branches.name as branch_name,
            sites.name as site_name
        ');
        $query->join('companies', 'attendance_holidays.company_id = companies.id', 'left');
        $query->join('branches', 'attendance_holidays.branch_id = branches.id', 'left');
        $query->join('sites', 'attendance_holidays.site_id = sites.id', 'left');
        return $this->get_all();
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            attendance_holidays.*,
            attendance_holiday_types.name as holiday_type,
            companies.name as company_name,
            companies.short_name as short_name,
            branches.name as branch_name,
            sites.name as site_name
        ')
        ->join('attendance_holiday_types', 'attendance_holiday_types.id = attendance_holidays.attendance_holiday_type_id', 'left')
        ->join('companies', 'companies.id = attendance_holidays.company_id', 'left')
        ->join('branches', 'branches.id = attendance_holidays.branch_id', 'left')
        ->join('sites', 'sites.id = attendance_holidays.site_id', 'left');
        return $this->{$method}($where);
    }

    public function get_holiday($where = '')
    {
        $this->db->select('*');
        return $this->get_many_by($where);
    }
}
