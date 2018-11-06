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
class Holiday_type_model extends MY_Model {

    protected $_table      = 'attendance_holiday_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($holiday_type)
    {
        $holiday_type['created']       = date('Y-m-d H:i:s');
        $holiday_type['active_status'] = 1;
        $holiday_type['created_by']    = 0;
        return $holiday_type;
    }

    // protected function set_modified_data($holiday_type)
    // {
    //     $holiday_type['modified'] = date('Y-m-d H:i:s');
    //     return $holiday_type;
    // }

    protected function set_default_data($holiday_type)
    {
        $holiday_type['active_status'] = ($holiday_type['active_status'] == 1) ? 'Active' : 'Inactive';
        $holiday_type['status_label']  = ($holiday_type['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $holiday_type;
    }

    public function get_holiday_type_by($param)
    {
        $query = $this->db;
        $query->select('attendance_holiday_types.*, companies.name as company_name');
        $query->join('companies', 'attendance_holiday_types.company_id = companies.id', 'left');
        $query->order_by('attendance_holiday_types.name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_holiday_type_by($param)
    {
        $query = $this->db;
        $query->select('attendance_holiday_types.*, companies.name as company_name');
        $query->join('companies', 'attendance_holiday_types.company_id = companies.id', 'left');
        $query->order_by('attendance_holiday_types.name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_holiday_type_all()
    {
        $query = $this->db;
        $query->select('attendance_holiday_types.*, companies.name as company_name');
        $query->join('companies', 'attendance_holiday_types.company_id = companies.id', 'left');
        $query->order_by('attendance_holiday_types.name', 'asc');

        return $this->get_all();
    }
}
