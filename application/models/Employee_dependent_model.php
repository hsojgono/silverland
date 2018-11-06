<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        July 24, 2017
 */
class Employee_dependent_model extends MY_Model
{
	protected $_table = 'employee_dependents';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	protected $after_get = array('prep_data');

	protected function prep_data($employee_dependent)
	{

		if ( ! isset($employee_dependent)) return FALSE;
		
		// get middle initial base on middle name
		$dependent_middle_initial = (strlen($employee_dependent['employee_dependent_middle_name']) > 1) ? substr($employee_dependent['employee_dependent_middle_name'], 0, 1) : $employee_dependent['employee_dependent_middle_name'];

		$dependent_full_name = array(
			$employee_dependent['employee_dependent_last_name'].', ',
			$employee_dependent['employee_dependent_first_name'].' ',
			$dependent_middle_initial,
		);

		// concat dependent first name, middle name, last name
		$employee_dependent['dependent_full_name'] = strtoupper(implode('', $dependent_full_name));

		$dependent_address = array(
			$employee_dependent['block_number'],
			$employee_dependent['lot_number'],
			$employee_dependent['floor_number'],
			$employee_dependent['building_number'],
			$employee_dependent['building_name'],
			$employee_dependent['street']
		);

		// concat dependent address
		$employee_dependent['dependent_address'] = strtoupper(implode(', ', $dependent_address));
		$employee_dependent['birthdate'] = date('F j, Y', strtotime($employee_dependent['birthdate']));

		return $employee_dependent;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_dependents.id as employee_dependent_id,
					employee_dependents.first_name as employee_dependent_first_name,
					employee_dependents.middle_name as employee_dependent_middle_name,
					employee_dependents.last_name as employee_dependent_last_name,
					employee_dependents.birthdate,
					employee_dependents.block_number,
					employee_dependents.lot_number,
					employee_dependents.floor_number,
					employee_dependents.building_number,
					employee_dependents.building_name,
					employee_dependents.street,
					relation.name as relation_name,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name
				')
				->join('employees as employee', 'employee_dependents.employee_id = employee.id', 'left')
				->join('relations as relation', 'employee_dependents.relationship_id = relation.id', 'left');

		return $this->{$method}($where);
	}

	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('add_employee_dependants'));
		
		$this->load->model('employee_employment_information_model');
		$employee = $this->employee_employment_information_model->get_details('get_by', ['employee_information.employee_id' => $employee_id]);

		$data['company_id'] = $employee['company_id'];
		$data['employee_id'] = $employee_id;

		// check who is logged in user
		$user = $this->ion_auth->user()->row();

		if ($mode == 'add') {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user->id;
			$last_id = $this->insert($data);

			if ($last_id) {
				$this->session->set_flashdata('success', lang('success_add_employee_dependent'));
				redirect('employees/informations/'.$employee_id);
			}
		}

		if ($mode == 'edit') {
			$data['modified'] = date('Y-m-d H:i:s');
			$data['modified_by'] = $user->id;
			$updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

			if ($updated) {
				$this->session->set_flashdata('success', lang('success_update_employee_dependent'));
				redirect('employees/informations/'.$employee_id);
			}
		}
	}
}

// End of file Employee_dependent_model.php
// Location: ./application/models/Employee_dependent_model.php
