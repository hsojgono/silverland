<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */

class Company_contact_information_model extends MY_Model
{
	protected $_table = 'company_contact_information';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
	protected $before_update = ['set_data_before_update'];

	protected $after_create  = ['write_audit_trail'];
	protected $after_update  = ['write_audit_trail'];

	public function prepare_data($company_contact_information)
	{
		if ( ! isset($company_contact_information)) return FALSE;

		$company_contact_information['status_label']  = ($company_contact_information['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$company_contact_information['status_action'] = ($company_contact_information['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$company_contact_information['status_icon'] = ($company_contact_information['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$company_contact_information['status_url']  = ($company_contact_information['active_status'] == 1) ? 'deactivate' : 'activate';
		return $company_contact_information;
	}

	protected function set_data($company_contact_information)
	{
		$company_contact_information['created'] = date('Y-m-d H:i:s');
		$company_contact_information['created_by'] = $this->ion_auth->user()->row()->id;
		$company_contact_information['active_status'] = 1;
		return $company_contact_information;
	}

    protected function set_data_before_update($company_contact_information)
    {
        $company_contact_information['modified']    = date('Y-m-d H:i:s');
        $company_contact_information['modified_by'] = $this->ion_auth->user()->row()->id;
        return $company_contact_information;
	}  
	
	public function get_details($method, $where)
	{
		$this->db->select('
			company_contact_information.*,
			companies.name as company_name
		')
		->join('companies', 'companies.id = company_contact_information.company_id', 'left')
		->order_by('company_name', 'asc');
		return $this->{$method}($where);
	}
}

// End of file Company_contact_information_model.php
// Location: ./applicaiton/model/Company_contact_information_model.php
