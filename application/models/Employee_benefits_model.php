<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_benefits_model extends MY_Model
{
	protected $_table = 'employee_benefits';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Callbacks or Observers
	protected $after_get = array('prep_details');
	
	protected function prep_details($employee_benefit)
	{
		if ( ! isset($employee_benefit)) return FALSE;
		
		if (isset($employee_benefit['first_name']) && isset($employee_benefit['middle_name']) && isset($employee_benefit['last_name'])) {
			// get middle initial base on middle name
			$middle_initial = (strlen($employee_benefit['middle_name']) > 1) ? substr($employee_benefit['middle_name'], 0, 1) : $employee_benefit['middle_name'];

			$full_name = array(
				$employee_benefit['last_name'] . ', ',
				$employee_benefit['first_name'] . ' ',
				$middle_initial
			);

			// concat employee first name, middle name, last name
			$employee_benefit['full_name'] = strtoupper(implode('', $full_name));
		}

		// check if active or inactive then set labels
		$employee_benefit['status_label'] = ($employee_benefit['active_status'] == 1) ? 'ACTIVE':'INACTIVE';

		return $employee_benefit;
	}

	public function get_details($method, $where)
    {
        $this->db->select('
                employee_benefits.id as employee_benefits_id,
                employee_benefits.employee_id,
                employee_benefits.company_id as employee_company_id,
                employee_benefits.benefit_id as employee_benefit_id,
                employee_benefits.amount as employee_benefit_amount,
                employee_benefits.active_status,
                benefit.id as benefit_id,
                benefit.name as benefit_name,
				benefit.amount as benefit_amount,
				benefit.taxable_status,
				benefit.cutoff_period as benefit_cutoff,
                employee.first_name,
                employee.middle_name,
                employee.last_name
            ')
            ->join('employees as employee', 'employee_benefits.employee_id = employee.id', 'left')
            ->join('companies as company', 'employee_benefits.company_id = company.id', 'left')
            ->join('benefits as benefit', 'employee_benefits.benefit_id = benefit.id', 'left');

        return $this->{$method}($where);
	}
	public function get_employee_benefits_by($where)
    {
    	$query = $this->db
            ->select('
                    employee_benefits.*,
                    employee_benefits.id AS employee_benefits_id,
                    employee_benefits.amount AS employee_benefits_amount,
					benefits.name AS benefits_name,
					employees.middle_name,           
                    employees.first_name as first_name,
                    employees.middle_name as middle_name,
                    employees.last_name as last_name,
                ')
            ->join('benefits', 'employee_benefits.benefit_id = benefits.id', 'left')
            ->join('employees', 'employees.id = employee_benefits.employee_id', 'left');
        
            // ->order_by('elc_balance', 'desc');

        return $this->get_many_by($where);
    }


	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('employee_benefits'));
		$data['employee_id'] = $employee_id;

		$this->load->model('employee_employment_information_model');
		$employee = $this->employee_employment_information_model->get_details('get_by', ['employee_information.employee_id' => $employee_id]);
		$data['company_id'] = $employee['company_id'];

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

// End of file Employee_benefits_model.php
// Location: ./application/models/Employee_benefits_model.php