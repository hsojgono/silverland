<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_address_model extends MY_Model
{
	protected $_table = 'employee_addresses';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');

	protected function prep_details($employee_address)
	{
		if ( ! isset($employee_address)) return FALSE;

		// get middle initial base on middle name
		$middle_initial = (strlen($employee_address['employee_middle_name']) > 1) ? substr($employee_address['employee_middle_name'], 0, 1) : $employee_address['employee_middle_name'];

		$employee_full_name = array(
			$employee_address['employee_last_name'].', ',
			$employee_address['employee_first_name'].' ',
			$middle_initial
		);

		// concat employee first name, middle name, last name
		$employee_address['employee_full_name'] = strtoupper(implode('', $employee_full_name));

		$full_address = array(
			$employee_address['unit_number'],
			$employee_address['floor_number'],
			$employee_address['building_number'],
			$employee_address['building_name'],
			$employee_address['block_number'],
			$employee_address['lot_number'],
			$employee_address['street'],
			$employee_address['location_barangay'],
			$employee_address['location_city'],
			$employee_address['location_province'],
			// $employee_address['location_region'],
			$employee_address['location_zipcode'],
			// $employee_address['country_name'],
			// $employee_address['country_iso'],
			// $employee_address['country_iso3'],
			// $employee_address['country_number_code'],
			// $employee_address['country_phone_code']
		);

		// concat employee first name, middle name, last name
		$employee_address['full_address'] = strtoupper(implode(' ', $full_address));

		$employee_address['address_type_label'] = ($employee_address['employee_addresses_type'] == 0) ? 'CURRENT' : (($employee_address['employee_addresses_type'] == 1) ? 'PERMANENT':'FOREIGN');

		return $employee_address;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_addresses.id as employee_address_id,
					employee_addresses.type as employee_addresses_type,
					employee_addresses.unit_number,
					employee_addresses.floor_number,
					employee_addresses.building_number,
					employee_addresses.building_name,
					employee_addresses.block_number,
					employee_addresses.lot_number,
					employee_addresses.street,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					location.barangay as location_barangay,
					location.city as location_city,
					location.province as location_province,
					location.region as location_region,
					location.zipcode as location_zipcode,
					country.name as country_name,
					country.iso as country_iso,
					country.iso3 as country_iso3,
					country.number_code as country_number_code,
					country.phone_code as country_phone_code,
				')
				->join('employees as employee', 'employee_addresses.employee_id = employee.id', 'left')
				->join('locations as location', 'employee_addresses.location_id = location.id', 'left')
				->join('countries as country', 'employee_addresses.country_id = country.id', 'left')
				->order_by('employee_addresses.type', 'asc');

		return $this->{$method}($where);
	}

	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('add_employee_address'));
		$data['employee_id'] = $employee_id;

		// check who is logged in user
		$user = $this->ion_auth->user()->row();

		if ($mode == 'add') {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user->id;
			$last_id = $this->insert($data);

			if ($last_id) {
				$this->session->set_flashdata('success', lang('success_add_employee_benefit'));
				redirect('employees/informations/'.$employee_id);
			}
		}

		if ($mode == 'edit') {
			$data['modified'] = date('Y-m-d H:i:s');
			$data['modified_by'] = $user->id;
			$updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

			if ($updated) {
				$this->session->set_flashdata('success', lang('success_update_spouse_data'));
				redirect('employees/informations/'.$employee_id);
			}
		}
	}
}

// End of file Employee_address_model.php
// Location: ./applicaiton/model/Employee_address_model.php
