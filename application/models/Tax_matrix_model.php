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
class Tax_matrix_model extends MY_Model
{
	protected $_table = 'tax_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($tax_matrix)
	{
		if ( ! isset($tax_matrix)) return FALSE;
		
		$tax_matrix['status_label']  = ($tax_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$tax_matrix['status_action'] = ($tax_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$tax_matrix['status_icon'] 	 = ($tax_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$tax_matrix['status_url'] 	 = ($tax_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		
		return $tax_matrix;
	}

	protected function set_data($tax_matrix)
	{
		$tax_matrix['created'] 		 = date('Y-m-d H:i:s');
		$tax_matrix['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$tax_matrix['active_status'] = 0;

		return $tax_matrix;
	}
}

// End of file Tax_matrix_model.php
// Location: ./application/models/Tax_matrix_model.php