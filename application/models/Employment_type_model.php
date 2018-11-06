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
class Employment_type_model extends MY_Model {

    protected $_table      = 'employment_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($employment_types)
    {
        $employment_types['active_status'] = 1;
        return $employment_types;
    }

    protected function set_default_data($employment_types)
    {
        $employment_types['active_status']  = ($employment_types['active_status'] == 1) ? 'Active' : 'Inactive';
        return $employment_types;
    }

    public function get_employment_types_by($param)
    {
        $query = $this->db;
        $query->select('employment_types.*');
        $query->order_by('type_name', 'asc');
        return $this->get_by($param);
    }

    public function get_many_employment_types_by($param)
    {
        $query = $this->db;
        $query->select('employment_types.*');
        $query->order_by('type_name', 'asc');
        return $this->get_many_by($param);
    }

    public function get_employment_types_all()
    {
        $query = $this->db;
        $query->select('
            employment_types.*');
        $query->order_by('employment_types.type_name', 'asc');
        return $this->get_all();
    }
}
