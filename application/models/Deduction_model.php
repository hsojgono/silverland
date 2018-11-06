<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Deduction_model extends MY_Model
{
	protected $_table = 'deductions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];
    protected $after_create  = ['write_audit_trail(0, add_site)'];
    protected $after_update  = ['write_audit_trail(1, edit_site)'];

    protected function generate_date_created_status($deduction)
    {
        $deduction['created']       = date('Y-m-d H:i:s');
        $deduction['active_status'] = 1;
        $deduction['created_by']    = $this->ion_auth->user()->row()->id;
        return $deduction;
    }

    protected function set_default_data($deduction)
    {   
        $deduction['status_label']   = ($deduction['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
        $deduction['status_url'] 	 = ($deduction['active_status'] == 1) ? 'deactivate' : 'activate';
        $deduction['status_action']  = ($deduction['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$deduction['status_icon']    = ($deduction['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        return $deduction;
    }

	
    public function get_details($method, $where)
    {
        $this->db->select(
			'deductions.*, 
			deductions.name as deduction_name,
			deductions.amount as deduction_amount,
            deductions.company_id as deduction_company_id,
			')



			->join('payroll_employees', 'deductions.company_id=payroll_employees.company_id','LEFT')
            ->join('companies', 'deductions.company_id=companies.id','LEFT');
            
        return $this->{$method}($where);
    }

}



// End of file Deduction_model.php
// Location: ./applicaiton/model/Deduction_model.php
