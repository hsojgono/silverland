<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_emergency_contact_model extends MY_Model
{
	protected $_table = 'employee_emergency_contacts';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');

	protected function prep_details($emergency_contact)
	{
		if ( ! isset($emergency_contact)) return FALSE;

		// get middle initial base on middle name
		$employee_middle_initial = (strlen($emergency_contact['employee_middle_name']) > 1) ? substr($emergency_contact['employee_middle_name'], 0, 1) : $emergency_contact['employee_middle_name'];
 
		// get middle initial base on middle name
		$eec_middle_initial = (strlen($emergency_contact['eec_middle_name']) > 1) ? substr($emergency_contact['eec_middle_name'], 0, 1) : $emergency_contact['eec_middle_name'];

		$status_label = ($emergency_contact['eec_active_status'] == 1) ? 'Active' : 'Inactive';
		
		$employee_full_name = array(
			$emergency_contact['employee_last_name'].', ',
			$emergency_contact['employee_first_name'].' ',
			$employee_middle_initial
		);

		$eec_full_name = array(
			$emergency_contact['eec_last_name'].', ',
			$emergency_contact['eec_first_name'].' ',
			$eec_middle_initial
		);

		$eec_full_address = array(
			$emergency_contact['eec_block_number'],
			$emergency_contact['eec_lot_number'],
			$emergency_contact['eec_floor_number'],
			$emergency_contact['eec_building_number'],
			$emergency_contact['eec_building_name'],
			$emergency_contact['eec_street']
		);

		// concat employee first name, middle name, last name
		$emergency_contact['employee_full_name'] = strtoupper(implode('', $employee_full_name));

		// concat employee emergency first name, middle name, last name
		$emergency_contact['eec_full_name'] = strtoupper(implode('', $eec_full_name));

		// concat employee first name, middle name, last name
		$emergency_contact['eec_full_address'] = strtoupper(implode(', ', $eec_full_address));

		$emergency_contact['status_label'] = $status_label;

		return $emergency_contact;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_emergency_contacts.id as eec_id,
					employee_emergency_contacts.first_name as eec_first_name,
					employee_emergency_contacts.middle_name as eec_middle_name,
					employee_emergency_contacts.last_name as eec_last_name,
					employee_emergency_contacts.telephone_number as eec_telephone_number,
					employee_emergency_contacts.mobile_number as eec_mobile_number,
					employee_emergency_contacts.block_number as eec_block_number,
					employee_emergency_contacts.lot_number as eec_lot_number,
					employee_emergency_contacts.floor_number as eec_floor_number,
					employee_emergency_contacts.building_number as eec_building_number,
					employee_emergency_contacts.building_name as eec_building_name,
					employee_emergency_contacts.street as eec_street,
					employee_emergency_contacts.active_status as eec_active_status,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					location.barangay as location_barangay,
					location.city as location_city,
					location.province as location_province,
					location.region as location_region,
					location.zipcode as location_zipcode,
					relation.name as relation_name,
				')
				->join('employees as employee', 'employee_emergency_contacts.employee_id = employee.id', 'left')
				->join('locations as location', 'employee_emergency_contacts.location_id = location.id', 'left')
				->join('relations as relation', 'employee_emergency_contacts.relationship_id = relation.id', 'left');


		return $this->{$method}($where);
	}
}

// End of file Employee_emergency_contact_model.php
// Location: ./applicaiton/model/Employee_emergency_contact_model.php
