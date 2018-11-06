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
class Branch_model extends MY_Model {

    protected $_table = 'branches';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    // protected $after_update = ['set_modified_data'];

    protected function generate_date_created_status($branch)
    {
        $branch['created'] = date('Y-m-d H:i:s');
        $branch['active_status'] = 1;
        $branch['created_by'] = '0';
        return $branch;
    }

    // protected function set_modified_data($branch)
    // {
    //     $branch['modified'] = date('Y-m-d H:i:s');
    //     return $branch;
    // }

    protected function set_default_data($branch)
    {
            $branch['status_label']  = ($branch['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
            $branch['status_action'] = ($branch['active_status'] == 1) ? 'Deactivate' : 'Activate';
            $branch['status_icon'] = ($branch['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
            $branch['status_url']  = ($branch['active_status'] == 1) ? 'deactivate' : 'activate';
            return $branch;
    }

    public function get_branch_by($param)
    {
        $query = $this->db;
        $query->select('branches.*, companies.name as company_name');
        $query->join('companies', 'branches.company_id = companies.id', 'left');
        $query->order_by('branches.name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_branch_by($param)
    {
        $query = $this->db;
        $query->select('branches.*, companies.name as company_name');
        $query->join('companies', 'branches.company_id = companies.id', 'left');
        $query->order_by('branches.name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_branch_all()
    {
        $query = $this->db;
        $query->select('branches.*, companies.name as company_name');
        $query->join('companies', 'branches.company_id = companies.id', 'left');
        $query->order_by('branches.name', 'asc');

        return $this->get_all();
    }
}
