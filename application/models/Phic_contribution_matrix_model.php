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
class Phic_contribution_matrix_model extends MY_Model
{
	protected $_table = 'phic_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($phic_matrix)
	{
		if ( ! isset($phic_matrix)) return FALSE;
		
		$phic_matrix['status_label']  = ($phic_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$phic_matrix['status_action'] = ($phic_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$phic_matrix['status_icon']   = ($phic_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$phic_matrix['status_url'] 	  = ($phic_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		return $phic_matrix;
	}

	protected function set_data($phic_matrix)
	{
		$phic_matrix['created'] 	  = date('Y-m-d H:i:s');
		$phic_matrix['created_by'] 	  = $this->ion_auth->user()->row()->id;
		$phic_matrix['active_status'] = 1;

		return $phic_matrix;
	}
}

// End of file Phic_contribution_matrix_model.php
// Location: ./application/models/Phic_contribution_matrix_model.php