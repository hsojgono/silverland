<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compensation_package_model extends MY_Model
{
	protected $_table = 'compensation_packages';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get     = ['prepare_data'];
    protected $before_create = ['set_data'];
    protected $before_update = ['set_data_before_update'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($compensation_package)
	{
		if ( ! isset($compensation_package)) return FALSE;
		
		$compensation_package['status_url']    = ($compensation_package['active_status'] == 1) ? 'deactivate' : 'activate';
		$compensation_package['status_icon']   = ($compensation_package['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$compensation_package['status_label']  = ($compensation_package['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$compensation_package['status_action'] = ($compensation_package['active_status'] == 1) ? 'Deactivate' : 'Activate';
		return $compensation_package;
	}

	protected function set_data($compensation_package)
	{
		$compensation_package['created'] 	   = date('Y-m-d H:i:s');
		$compensation_package['created_by']    = $this->ion_auth->user()->row()->id;
		$compensation_package['company_id']    = $this->ion_auth->user()->row()->company_id;
		$compensation_package['active_status'] = 1;
		return $compensation_package;
    }

    protected function set_data_before_update($compensation_package)
    {
        $compensation_package['modified']    = date('Y-m-d H:i:s');
        $compensation_package['modified_by'] = $this->ion_auth->user()->row()->id;
        return $compensation_package;
    }  

	public function get_details($method, $where)
	{
		$this->db->select('
				compensation_packages.id as compensation_package_id,
				compensation_packages.position_id as cp_position_id,
				compensation_packages.salary_id as cp_salary_id,
				compensation_packages.company_id as cp_company_id,
				compensation_packages.active_status,
				compensation_packages.created as cp_created,
				salary.monthly_salary as monthly_salary,
				salary.salary_matrix_id,
				company.name as company_name,
				position.name as position_name
			')
			->join('positions as position', 'compensation_packages.position_id = position.id', 'left')
			->join('salaries as salary', 'compensation_packages.salary_id = salary.id', 'left')
			->join('companies as company', 'compensation_packages.company_id = company.id', 'left');

		return $this->{$method}($where);
	}

	public function get_with_salary($method, $where)
	{
		$this->db->select('
				compensation_packages.id as compensation_package_id,
				compensation_packages.position_id as cp_position_id,
				compensation_packages.salary_id as cp_salary_id,
				compensation_packages.company_id as cp_company_id,
				compensation_packages.active_status,
				salary.monthly_salary,
				salary.salary_matrix_id,
				company.name as company_name
			')
			->join('positions as position', 'compensation_packages.position_id = position.id', 'left')
			->join('salaries as salary', 'compensation_packages.salary_id = salary.id', 'left')
			->join('companies as company', 'compensation_packages.company_id = company.id', 'left');
		
		return $this->{$method}($where);
	}

	public function get_with_benefits($method, $where)
	{
		$this->db->select('
				compensation_packages.id as compensation_package_id,
				compensation_packages.position_id as cp_position_id,
				compensation_packages.salary_id as cp_salary_id,
				compensation_packages.company_id as cp_company_id,
				compensation_packages.active_status,
				salary.monthly_salary,
				salary.salary_matrix_id,
				company.name as company_name
			')
			->join('positions as position', 'compensation_packages.position_id = position.id', 'left')
			->join('salaries as salary', 'compensation_packages.salary_id = salary.id', 'left')
			->join('companies as company', 'compensation_packages.company_id = company.id', 'left');

		return $this->{$method}($where);
	}

	public function get_compensation_package_history($old_position_id, $new_position_id)
	{
		$old_compensation_package = $this->get_with_salary('get_by', array('compensation_packages.position_id' => $old_position_id));
		$new_compensation_package = $this->get_with_salary('get_by', array('compensation_packages.position_id' => $new_position_id));
	
		return array(
			'for_old_position' => $old_compensation_package,
			'for_new_position' => $new_compensation_package
		);
	}
}

// End of file Compensation_package_model.php
// Location: ./applicaiton/model/Compensation_package_model.php
