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
class Hdmf_contribution_matrix_model extends MY_Model
{
	protected $_table = 'hdmf_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($hdmf_matrix)
	{
		if ( ! isset($hdmf_matrix)) return FALSE;
		
		$hdmf_matrix['status_label']  = ($hdmf_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$hdmf_matrix['status_action'] = ($hdmf_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$hdmf_matrix['status_icon']   = ($hdmf_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$hdmf_matrix['status_url'] 	  = ($hdmf_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		return $hdmf_matrix;
	}

	protected function set_data($hdmf_matrix)
	{
		$hdmf_matrix['created'] 	  = date('Y-m-d H:i:s');
		$hdmf_matrix['created_by'] 	  = $this->ion_auth->user()->row()->id;
		$hdmf_matrix['active_status'] = 1;

		return $hdmf_matrix;
	}
}

// End of file Hdmf_contribution_matrix_model.php
// Location: ./application/models/Hdmf_contribution_matrix_model.php