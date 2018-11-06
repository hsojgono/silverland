<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Tax_exemption_status_model extends MY_Model
{
	protected $_table = 'tax_exemption_status';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	// Model Observers or Callbacks
	protected $before_create = array('set_data');
	protected $after_get     = array('prepare_data');
    protected $after_create  = array('write_audit_trail');
    protected $after_update  = array('write_audit_trail');

	protected function prepare_data($tax_exemption_status)
	{
		if ( ! isset($tax_exemption_status)) return FALSE;
		
		$tax_exemption_status['status_label']  = ($tax_exemption_status['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$tax_exemption_status['status_action'] = ($tax_exemption_status['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$tax_exemption_status['status_icon']   = ($tax_exemption_status['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$tax_exemption_status['status_url']    = ($tax_exemption_status['active_status'] == 1) ? 'deactivate' : 'activate';
		return $tax_exemption_status;
	}

	protected function set_data($tax_exemption_status)
	{
		$tax_exemption_status['created'] 	   = date('Y-m-d H:i:s');
		$tax_exemption_status['created_by']    = $this->ion_auth->user()->row()->id;
		$tax_exemption_status['active_status'] = 1;

		return $tax_exemption_status;
	}
    // SMTI-RDaludado
	public function get_details($method, $where)
	{
		$this->db->select(
			'tax_exemption_status.*,
			employees.first_name,
			tax_exemption_status.tax_code as tax_code
			')

		->join('employees', 'employees.tax_exemption_status_id = tax_exemption_status.id', 'left');
		return $this->{$method}($where);
	}
}

// End of file Tax_exemption_status_model.php
// Location: ./application/models/Tax_exemption_status_model.php