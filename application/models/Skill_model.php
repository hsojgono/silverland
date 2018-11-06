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
class Skill_model extends MY_Model {

    protected $_table      = 'skills';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($skill)
    {   
        $user                   = $this->ion_auth->user()->row();
        $skill['created']       = date('Y-m-d H:i:s');
        $skill['created_by']    = $user->employee_id;
        $skill['active_status'] = 1;
        return $skill;
    }

    protected function set_default_data($skill)
    {
        if ( ! isset($skill)) return FALSE;
        
        $skill['status_label']  = ($skill['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $skill['status_action'] = ($skill['active_status'] == 1) ? 'Deactivate' : 'Activate';
        $skill['status_icon']   = ($skill['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $skill['status_url']    = ($skill['active_status'] == 1) ? 'deactivate' : 'activate';

        $skill['active_status']  = ($skill['active_status'] == 1) ? 'Active' : 'Inactive';
        $skill['status_label']   = ($skill['active_status'] == 'Active') ? 'Deactivate' : 'Activate';
        return $skill;
    }

    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
    
    public function get_skill_all()
    {
        $query = $this->db;
        $query->select('skills.*');
        $query->order_by('name', 'asc');
        return $this->get_all();
    }
}
