<?php


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        July 24, 2017
 */
class Employee_personal_information_model extends MY_Model
{
    protected $_table       = 'employees';
    protected $primary_key  = 'id';
    protected $return_type  = 'array';
    
    // protected $after_create = ['write_audit_trail'];
    // protected $after_update = ['write_audit_trail'];

    public function save($id, $data)
    {
        // dump($data);
        // exit;
        $fields = $this->form_validation->get_field_names('employee_personal_information');
        $new_data = remove_unknown_field($data, $fields);
        $updated = $this->update($id, $data);

        if ( ! $updated) {
            $this->session->set_flashdata('failed', lang('unable_update_personal_data'));
            redirect('employees/informations/'.$id);
        }

        // $this->session->set_flashdata('log_parameters', [
        //     'action_mode' => 0,
        //     'perm_key' 	 => NULL,
        //     'old_data'	 => NULL,
        //     'new_data'    => $data
        // ]);

        $this->session->set_flashdata('success', lang('success_update_personal_data'));
        redirect('employees/informations/'.$id);
    }
}

// End of file Employee_personal_information_model.php
// Location: ./application/models/Employee_personal_information_model.php
