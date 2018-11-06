<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_work_experience_model extends MY_Model
{
	protected $_table = 'employee_work_experiences';
	protected $primary_key = 'id';
	protected $return_type = 'array';

		// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
	protected $after_get = array('prep_details');

    protected function generate_date_created_status($employee_violation)
    {
        $employee_violation['created'] = date('Y-m-d H:i:s');
        $employee_violation['active_status'] = 1;
        $employee_violation['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_violation;
    }
	protected function prep_details($employee_work_experience)
	{
		if ( ! isset($employee_work_experience)) return FALSE;

		// get middle initial base on middle name
		// $middle_initial = (strlen($employee_work_experience['employee_middle_name']) > 1) ? substr($employee_work_experience['employee_middle_name'], 0, 1) : $employee_work_experience['employee_middle_name'];

		$employee_full_name = array(
			// $employee_work_experience['employee_last_name'].', ',
			// $employee_work_experience['employee_first_name'].' ',
			// $middle_initial
		);

		// concat employee first name, middle name, last name
		 $employee_work_experience['employee_full_name'] = strtoupper(implode('', $employee_full_name));

		$full_address = array(
			$employee_work_experience['floor_number'],
			$employee_work_experience['building_number'],
			$employee_work_experience['building_name'],
			$employee_work_experience['block_number'],
			$employee_work_experience['lot_number'],
			$employee_work_experience['street']
			// $employee_work_experience['location_region'],
			// $employee_work_experience['location_zipcode'],

		);

		// concat employee first name, middle name, last name
		$employee_work_experience['full_address'] = strtoupper(implode(' ', $full_address));

		// $employee_work_experience['address_type_label'] = ($employee_work_experience['employee_work_experiences_type'] == 0) ? 'CURRENT' : (($employee_work_experience['employee_work_experiences_type'] == 1) ? 'PERMANENT':'FOREIGN');

		return $employee_work_experience;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_work_experiences.id as employee_work_experience_id,
					employee_work_experiences.company_name as company_name,
					employee_work_experiences.immediate_superior,
					employee_work_experiences.duties,
					employee_work_experiences.position,
					employee_work_experiences.employment_type_id as employment_type_id,
					employee_work_experiences.salary,
					employee_work_experiences.date_hired,
					employee_work_experiences.date_separated,
					employee_work_experiences.reason_for_leaving,
					employee_work_experiences.floor_number,
					employee_work_experiences.building_number,
					employee_work_experiences.building_name,
					employee_work_experiences.block_number,
					employee_work_experiences.lot_number,
					employee_work_experiences.street,
					employee_work_experiences.mobile_number,
					employee_work_experiences.telephone_number,
					employment_types.type_name as employment_type_name,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name

				')
				->join('employees as employee', 'employee_work_experiences.employee_id = employee.id', 'left')
				->join('employment_types', 'employee_work_experiences.employment_type_id = employment_types.id', 'left');

				// ->order_by('employee_work_experiences.type', 'asc');

		return $this->{$method}($where);
	}

	public function get_employee_work_experience($employee_work_experience)
	{
		$this->db->select('
			employee_work_experiences.*,
			employee_work_experiences.id as employee_work_experience_id,
			employee_work_experiences.company_name as company_name,
			employee_work_experiences.immediate_superior,
			employee_work_experiences.duties,
			employee_work_experiences.position,
			employee_work_experiences.employment_type_id as employment_type_id,
			employee_work_experiences.salary,
			employee_work_experiences.date_hired,
			employee_work_experiences.date_separated,
			employee_work_experiences.reason_for_leaving,
			employee_work_experiences.floor_number,
			employee_work_experiences.building_number,
			employee_work_experiences.building_name,
			employee_work_experiences.block_number,
			employee_work_experiences.lot_number,
			employee_work_experiences.street,
			employee_work_experiences.mobile_number,
			employee_work_experiences.telephone_number,

			employees.first_name as employee_first_name,				
			employees.middle_name as employee_middle_name,
			employees.last_name as employee_last_name
		')
		->join('employees', 'employees.id = employee_work_experiences.employee_id', 'left');

		return $this->get_by($employee_work_experience);
	}

	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('employee_work_experiences'));
		$data['employee_id'] = $employee_id;
		$updated = $this->update($id, $data);

		// check who is logged in user
		$user = $this->ion_auth->user()->row();

		if ($mode == 'add') {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user->id;
			$last_id = $this->insert($data);

			if ($last_id) {
				$this->session->set_flashdata('success', lang('success_add_work_experience'));
				redirect('employees/informations/'.$employee_id);
			}
		}

		if ($mode == 'edit') {
			$data['modified'] = date('Y-m-d H:i:s');
			$data['modified_by'] = $user->id;
			$updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

			if ($updated) {
				$this->session->set_flashdata('success', lang('success_update_work_experience'));
				redirect('employees/informations/'.$employee_id);
			}
		}
	}
}


// End of file Employee_work_experience_model.php
// Location: ./applicaiton/model/Employee_work_experience_model.php
