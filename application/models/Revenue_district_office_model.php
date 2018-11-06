<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue_district_office_model extends MY_Model
{
	protected $_table = 'revenue_district_offices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	public function get_details($method, $where)
	{
		$this->db->select('*')
        ->order_by('rdo_name', 'asc');
        return $this->{$method}($where);
	}
}

// End of file Revenue_district_office_model.php
// Location: ./applicaiton/model/Revenue_district_office_model.php 