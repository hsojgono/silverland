<?php


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        July 24, 2017
 */
class Employee_spouse_information_model extends MY_Model
{
    protected $_table = 'employee_spouses';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    protected $after_get = array('prep_data');

    protected function prep_data($spouse)
    {

        if ( ! isset($spouse['id'])) return FALSE;

        $address = array(
            $spouse['block_number'],
            $spouse['lot_number'],
            $spouse['floor_number'],
            $spouse['building_number'],
            $spouse['building_name'],
            $spouse['street'],
            $spouse['barangay'],
        );

        $fullname = array(
            $spouse['last_name'].',',
            $spouse['first_name'],
            $spouse['middle_name'].'.'
        );

        $spouse['address']      = implode(', ', $address);
        $spouse['fullname']     = strtoupper(implode(' ', $fullname));
        $spouse['status_label'] = ($spouse['active_status'] == 1) ? 'Deactivate':'Activate';
        $spouse['btn_color']    = ($spouse['active_status'] == 1) ? 'btn btn-danger':'btn btn-success';
        $spouse['status_link']  = ($spouse['active_status'] == 1) ? 'deactivate/spouse/'.$spouse['id'] : 'activate/spouse/'.$spouse['id'];

        return $spouse;
    }

    public function edit($employee_id, $posted_data)
    {
        $data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('employee_spouse_information'));
        $data['employee_id'] = $employee_id;

        $updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

        if ($updated) {
            $this->session->set_flashdata('success', lang('success_update_spouse_data'));
            redirect('employees/informations/'.$employee_id);
        }
    }

	public function save($employee_id, $posted_data)
	{
		$mode = $posted_data['mode'];
		$data = remove_unknown_field($posted_data, $this->form_validation->get_field_names('employee_spouse_information'));
		$data['employee_id'] = $employee_id;

		// check who is logged in user
		$user = $this->ion_auth->user()->row();

		if ($mode == 'add') {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $user->id;
			$data['active_status'] = 0;

			$last_id = $this->insert($data);

			if ($last_id) {
				$this->session->set_flashdata('success', lang('success_add_employee_spouse'));
				redirect('employees/informations/'.$employee_id);
			}
		}

		if ($mode == 'edit') {
			$data['modified'] = date('Y-m-d H:i:s');
			$data['modified_by'] = $user->id;
			$updated = $this->db->where('employee_id', $employee_id)->update($this->_table, $data);

			if ($updated) {
				$this->session->set_flashdata('success', lang('success_update_employee_spouse'));
				redirect('employees/informations/'.$employee_id);
			}
		}
	}
}

// End of file Employee_spouse_model.php
// Location: ./application/models/Employee_spouse_model.php
