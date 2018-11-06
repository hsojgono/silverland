<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_contact_model extends MY_Model
{
	protected $_table = 'employee_contacts';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');

	protected function prep_details($employee_contact)
	{
		if ( ! isset($employee_contact)) return FALSE;

		// get middle initial base on middle name
		$middle_initial = (strlen($employee_contact['employee_middle_name']) > 1) ? substr($employee_contact['employee_middle_name'], 0, 1) : $employee_contact['employee_middle_name'];
		
		// get middle initial base on middle name
		$eec_middle_initial = (strlen($employee_contact['eec_middle_name']) > 1) ? substr($employee_contact['eec_middle_name'], 0, 1) : $employee_contact['eec_middle_name'];

		$status_label = ($employee_contact['active_status'] == 1) ? 'Active' : 'Inactive';

		$employee_full_name = array(
			$employee_contact['employee_last_name'].', ',
			$employee_contact['employee_first_name'].' ',
			$middle_initial
		);

		$eec_full_name = array(
			$employee_contact['eec_last_name'].', ',
			$employee_contact['eec_first_name'].' ',
			$eec_middle_initial
		);

		$eec_full_address = array(
			$employee_contact['eec_block_number'],
			$employee_contact['eec_lot_number'],
			$employee_contact['eec_floor_number'],
			$employee_contact['eec_building_number'],
			$employee_contact['eec_building_name'],
			$employee_contact['eec_street']
		);

		// concat employee first name, middle name, last name
		$employee_contact['employee_full_name'] = strtoupper(implode('', $employee_full_name));

		// concat employee emergency first name, middle name, last name
		$employee_contact['eec_full_name'] = strtoupper(implode('', $eec_full_name));

		// concat employee first name, middle name, last name
		$employee_contact['eec_full_address'] = strtoupper(implode(', ', $eec_full_address));

		$employee_contact['status_label'] = $status_label;

		return $employee_contact;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_contacts.id as employee_contact_id,
					employee_contacts.telephone_number as employee_telephone_number,
					employee_contacts.mobile_number as employee_mobile_number,
					employee_contacts.email as employee_email,
					employee_contacts.active_status,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					emergency_contact.first_name as eec_first_name,
					emergency_contact.middle_name as eec_middle_name,
					emergency_contact.last_name as eec_last_name,
					emergency_contact.telephone_number as eec_telephone_number,
					emergency_contact.mobile_number as eec_mobile_number,
					emergency_contact.block_number as eec_block_number,
					emergency_contact.lot_number as eec_lot_number,
					emergency_contact.floor_number as eec_floor_number,
					emergency_contact.building_number as eec_building_number,
					emergency_contact.building_name as eec_building_name,
					emergency_contact.street as eec_street,
					company.name as company,
				')
				->join('employees as employee', 'employee_contacts.employee_id = employee.id', 'left')
				->join('companies as company', 'employee_contacts.company_id = company.id', 'left')
				->join('employee_emergency_contacts as emergency_contact', 'employee_contacts.emergency_contact_id = emergency_contact.id', 'left');


		return $this->{$method}($where);
	}
}

// End of file Employee_contact_model.php
// Location: ./applicaiton/model/Employee_contact_model.php
