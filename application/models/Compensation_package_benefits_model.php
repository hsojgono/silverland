<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Compensation_package_benefits_model extends MY_Model
{
	protected $_table = 'compensation_package_benefits';
	protected $primary_key = 'id';
    protected $return_type = 'array';
    
    public function get_with_benefit_details($method = 'get_by', $where = '')
    {
        $this->db->select('compensation_package_benefits.*, benefits.name as benefit_name');
        $this->db->join('benefits', 'compensation_package_benefits.benefit_id = benefits.id', 'left');

        return $this->{$method}($where);
    }
}

// End of file Compensation_package_benefits_model.php
// Location: ./applicaiton/model/Compensation_package_benefits_model.php
