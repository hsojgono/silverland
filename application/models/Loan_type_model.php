<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Loan_type_model extends MY_Model
{
	protected $_table = 'loan_types';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($loan_type)
	{
		if ( ! isset($loan_type)) return FALSE;
		
		$loan_type['status_label']  = ($loan_type['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$loan_type['status_action'] = ($loan_type['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$loan_type['status_icon'] 	= ($loan_type['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$loan_type['status_url'] 	= ($loan_type['active_status'] == 1) ? 'deactivate' : 'activate';
		return $loan_type;
	}

	protected function set_data($loan_type)
	{
		$loan_type['created'] = date('Y-m-d H:i:s');
		$loan_type['created_by'] = $this->ion_auth->user()->row()->id;
		$loan_type['company_id'] = $this->ion_auth->user()->row()->company_id;
		$loan_type['active_status'] = 1;

		return $loan_type;
	}

	public function get_details($method, $where)
	{
		$this->db->select('*')
		->order_by('name', 'asc');

		return $this->{$method}($where);
	}
}

// End of file Loan_type_model.php
// Location: ./application/models/Loan_type_model.php