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

class Company_address_model extends MY_Model
{
	protected $_table = 'company_addresses';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $before_update = ['set_data_before_update'];
	protected $after_create  = ['write_audit_trail'];
	protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($company_address)
	{
		if ( ! isset($company_address)) return FALSE;

		$full_address = array(
			$company_address['unit_number'],
			$company_address['floor_number'],
			$company_address['building_number'],
			$company_address['building_name'],
			$company_address['block_number'],
			$company_address['lot_number'],
			$company_address['street']
		);

		$location = array(
			$company_address['barangay'],
			$company_address['city'],
			$company_address['province']
		);

		//full address of the company
		$company_address['full_address'] = strtoupper(implode(', ', $full_address));

		// //location of the company
		$company_address['location'] = strtoupper(implode(', ', $location));

		$company_address['status_label']  = ($company_address['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$company_address['status_action'] = ($company_address['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$company_address['status_icon'] = ($company_address['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$company_address['status_url']  = ($company_address['active_status'] == 1) ? 'deactivate' : 'activate';
		return $company_address;
	}

	protected function set_data($company_address)
	{
		$company_address['created'] = date('Y-m-d H:i:s');
		$company_address['created_by'] = $this->ion_auth->user()->row()->employee_id;
		$company_address['active_status'] = 1;
		return $company_address;
	}

    protected function set_data_before_update($salary_grade)
    {
        $salary_grade['modified']    = date('Y-m-d H:i:s');
        $salary_grade['modified_by'] = $this->ion_auth->user()->row()->id;
        return $salary_grade;
    }    

	public function get_details($method, $where)
	{
		$this->db->select('
			company_addresses.*,
			companies.name as company_name,
			locations.barangay as barangay,
			locations.city as city,
			locations.province as province
		')
		->join('companies', 'companies.id = company_addresses.company_id', 'left')
		->join('locations', 'locations.id = company_addresses.location_id', 'left')
		->order_by('company_name', 'asc');
		return $this->{$method}($where);
	}
}

// End of file Company_addresses_model.php
// Location: ./applicaiton/model/Company_addresses_model.php
