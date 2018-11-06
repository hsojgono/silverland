<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Employee_parent_information_model extends MY_Model
{
    protected $_table = 'employee_parents';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    protected $before_create = array(
        'set_default_data'
    );

    protected $after_get = array(
        'prep_default_data'
    );

    protected function set_default_data($parent)
    {
        $parent['created'] = date('Y-m-d H:i:s');
        $parent['created_by'] = $this->ion_auth->user()->row()->id;

        return $parent;
    }

    protected function prep_default_data($parent)
    {
        if ( ! isset($parent)) return FALSE;

        $fullname = array(
            $parent['last_name'] . ', ',
            $parent['first_name']
        );

        $parent['fullname'] = implode('', $fullname);

        return $parent;
    }


    public function edit($employee_id, $posted_data)
    {
        $new_data = array();

        foreach ($posted_data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $relation_id => $parent_data) {
                    $new_data[$relation_id][$key] = $parent_data;
                }
            }
            else {
                dump($value);
            }
        }

        $result = array();
        foreach ($new_data as $data) {
            $data['modified'] = date('Y-m-d H:i:s');
            $result[] = $this->db->where(['relationship_id' => $data['relationship_id'], 'employee_id' => $data['employee_id']])->update($this->_table, $data);
        }

        $this->session->set_flashdata('success', lang('success_update_parent_data'));
        redirect('employees/informations/'.$employee_id);
    }
}
