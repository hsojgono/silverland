<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_certification_model extends MY_Model
{
	protected $_table = 'employee_certifications';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	// Callbacks or Observers
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee_certification)
    {
        $employee_certification['created'] = date('Y-m-d H:i:s');
        $employee_certification['active_status'] = 1;
        $employee_certification['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee_certification;
    }	
    protected function set_default_data($employee_certification)
    {
        if ( ! isset($employee_certification)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee_certification['middle_name'])) ? $employee_certification['middle_name'] : '';
        // $full_name                = $employee_certification['last_name'].', '.$employee_certification['first_name'].' '.$middle_name;
        // $employee_certification['full_name']    = strtoupper($full_name);
        // $employee_certification['status_label'] = ($employee_certification['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee_certification;
    }

	public function get_details($method, $where)
	{
		$this->db->select('
					employee_certifications.id as employee_certification_id,
					employee_certifications.name,
					employee_certifications.number,
					employee_certifications.issuing_authority,
					employee_certifications.date_received,
					employee_certifications.validity,
					employee_certifications.attachment,
					employee.first_name as employee_first_name,
					employee.middle_name as employee_middle_name,
					employee.last_name as employee_last_name,
					companies.name as company_name,
					companies.id as company_id


				')
				->join('employees as employee', 'employee_certifications.employee_id = employee.id', 'left')
				->join('companies', 'employee_certifications.company_id = companies.id', 'left');

				// ->order_by('employee_certifications.type', 'asc');

		return $this->{$method}($where);
	}

	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('employee_certifications'));
		$data['employee_id'] = $employee_id;

		// check who is logged in user
		$user = $this->ion_auth->user()->row();

		if ($mode == 'add') {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user->id;
			$last_id = $this->insert($data);

			if ($last_id) {
				$this->session->set_flashdata('success', lang('success_add_employee_certification'));
				redirect('employees/informations/'.$employee_id);
			}
		}

		if ($mode == 'edit') {
			$data['modified'] = date('Y-m-d H:i:s');
			$data['modified_by'] = $user->id;
			$updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

			if ($updated) {
				$this->session->set_flashdata('success', lang('success_update_employee_certification'));
				redirect('employees/informations/'.$employee_id);
			}
		}
	}
}

// End of file Employee_certification_model.php
// Location: ./applicaiton/model/Employee_certification_model.php
