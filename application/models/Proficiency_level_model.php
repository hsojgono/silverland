<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proficiency_level_model extends MY_Model
{
	protected $_table = 'proficiency_levels';
	protected $primary_key = 'id';
	protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected $after_create = ['write_audit_trail'];
    protected $after_update = ['write_audit_trail'];

    protected function generate_date_created_status($proficiency_level)
    {
        $proficiency_level['created'] = date('Y-m-d H:i:s');
        $proficiency_level['active_status'] = 1;
        $proficiency_level['created_by'] = '0';
        return $proficiency_level;
    }

    protected function set_default_data($proficiency_level)
    {
        $proficiency_level['active_status'] = ($proficiency_level['active_status'] == 1) ? 'Active' : 'Inactive';
        $proficiency_level['status_label']  = ($proficiency_level['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $proficiency_level;
    }

    public function get_proficiency_level_by($param)
    {
        $query = $this->db;
        $query->select('proficiency_levels.*');

        return $this->get_by($param);
    }
    public function get_many_proficiency_level_by($param)
    {
        $query = $this->db;
        $query->select('proficiency_levels.*');
        return $this->get_many_by($param);
    }
    public function get_proficiency_level_all()
    {
        $query = $this->db;
        $query->select('proficiency_levels.*');
        return $this->get_all();
    }
}

// End of file Proficiency_level_model.php
// Location: ./applicaiton/model/Proficiency_level_model.php