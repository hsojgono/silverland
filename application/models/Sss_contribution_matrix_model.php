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
class Sss_contribution_matrix_model extends MY_Model
{
	protected $_table = 'sss_matrix';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($sss_matrix)
	{
		if ( ! isset($sss_matrix)) return FALSE;
		
		$sss_matrix['status_label']  = ($sss_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$sss_matrix['status_action'] = ($sss_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$sss_matrix['status_icon'] 	 = ($sss_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$sss_matrix['status_url'] 	 = ($sss_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		return $sss_matrix;
	}

	protected function set_data($sss_matrix)
	{
		$sss_matrix['created'] 		 = date('Y-m-d H:i:s');
		$sss_matrix['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$sss_matrix['active_status'] = 1;

		return $sss_matrix;
	}
}

// End of file Sss_contribution_matrix_model.php
// Location: ./application/models/Sss_contribution_matrix_model.php