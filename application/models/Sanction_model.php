<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sanction_model extends MY_Model
{
	protected $_table = 'sanctions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get 	 = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($sanction)
    {
        $sanction['created']       = date('Y-m-d H:i:s');
        $sanction['active_status'] = 1;
        $sanction['created_by']    = $this->ion_auth->user()->row()->id;
        return $sanction;
    }

    protected function set_default_data($sanction)
    {   
        if ( ! isset($sanction['id'])) return FALSE;
        $sanction['status_label']   = (isset($sanction['active_status']) && $sanction['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $sanction['status_url'] 	 = (isset($sanction['active_status']) && $sanction['active_status'] == 1) ? 'deactivate' : 'activate';
        $sanction['status_action']  = (isset($sanction['active_status']) && $sanction['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$sanction['status_icon']    = (isset($sanction['active_status']) && $sanction['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $sanction;
    }

    public function get_many_sanction_by($param)
    {
        $query = $this->db;
        $query->select('*');
        // $query->join('employee_info', 'employee_info.violation_id = violations.id');

        return $this->get_many_by($param);
    }

    public function get_sanction_by($param)
    {
        $query = $this->db;
        $query->select('
            sanctions.*,
			sanction_types.name as sanction_type_name,
            companies.name as company_name
        ');
        $query->join('sanction_types', 'sanction_types.id=sanctions.sanction_type_id', 'left');
        $query->join('system_users', 'system_users.employee_id=sanctions.created_by','left');
        $query->join('companies', 'sanctions.company_id = companies.id', 'left');
        $query->order_by('sanctions.id', 'asc');

        return $this->get_by($param);
    }


    public function get_details($method, $where)
    {
        $this->db->select('
			sanctions.*,
			sanction_types.name as sanction_type_name,
            companies.name as company_name
		')
        ->join('sanction_types', 'sanction_types.id=sanctions.sanction_type_id', 'left')
        ->join('companies', 'companies.id=sanctions.company_id', 'left')
        ->order_by('created', 'asc');

        return $this->{$method}($where);
    }

	public function get_sanctions_by($where)
    {
    	$query = $this->db
            ->select('
                    sanctions.*,
                    sanctions.id AS sanction_id,
					sanctions.name AS sanction_name
                ');

        return $this->get_many_by($where);
    }
}

// End of file Sanction_model.php
// Location: ./applicaiton/model/Sanction_model.php 