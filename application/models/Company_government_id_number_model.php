<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_government_id_number_model extends MY_Model
{
	protected $_table = 'company_government_id_numbers';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $before_create = ['generate_date_created_status'];
	protected $after_get     = ['set_default_data'];
	protected $before_update = ['set_data_before_update'];

    protected $after_create = ['write_audit_trail'];
    protected $after_update = ['write_audit_trail'];

    protected function generate_date_created_status($company_govt_id_number)
    {
        $company_govt_id_number['created'] = date('Y-m-d H:i:s');
        $company_govt_id_number['created_by'] = $this->ion_auth->user()->row()->id;
        $company_govt_id_number['active_status'] = 1;
        return $company_govt_id_number;
	}
	
	protected function set_data_before_update($company_govt_id_number)
	{
		$company_govt_id_number['modified'] = date('Y-m-d H:i:s');
        $company_govt_id_number['modified'] = $this->ion_auth->user()->row()->id;
        return $company_govt_id_number;
	}

    protected function set_default_data($company_govt_id_number)
    {
        // $company_govt_id_number['active_status'] = ($company_govt_id_number['active_status'] == 1) ? 'Active' : 'Inactive';
        // $company_govt_id_number['status_label']  = ($company_govt_id_number['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        // return $company_govt_id_number;
    }

	public function get_details($method, $where)
	{
		$this->db->select('
			company_government_id_numbers.*,
			revenue_district_offices.rdo_name as revenue_district_office
			')
		->join('revenue_district_offices', 'revenue_district_offices.id = company_government_id_numbers.revenue_district_office_id');
		return $this->{$method}($where);
	}
}

// End of file Company_government_id_number_model.php
// Location: ./applicaiton/model/Company_government_id_number_model.php
