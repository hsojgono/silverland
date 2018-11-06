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
class Incentive_matrix_model extends MY_Model
{
	protected $_table = 'incentive_matrices';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($incentive_matrix)
	{
		if ( ! isset($incentive_matrix)) return FALSE;
		
		$incentive_matrix['status_label']  = ($incentive_matrix['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$incentive_matrix['status_action'] = ($incentive_matrix['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$incentive_matrix['status_icon']   = ($incentive_matrix['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$incentive_matrix['status_url']    = ($incentive_matrix['active_status'] == 1) ? 'deactivate' : 'activate';
		return $incentive_matrix;
	}

	protected function set_data($incentive_matrix)
	{
		$incentive_matrix['created'] 	   = date('Y-m-d H:i:s');
		$incentive_matrix['created_by']    = $this->ion_auth->user()->row()->id;
		$incentive_matrix['active_status'] = 1;
		return $incentive_matrix;
    }
    
    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}

// End of file Incentive_matrix_model.php
// Location: ./application/models/Incentive_matrix_model.php