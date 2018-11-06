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
class Incentive_type_model extends MY_Model
{
	protected $_table = 'incentive_types';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
	protected $before_create = array('set_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($incentive_type)
	{
		if ( ! isset($incentive_type)) return FALSE;
		
		$incentive_type['status_label']  = ($incentive_type['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$incentive_type['status_action'] = ($incentive_type['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$incentive_type['status_icon'] 	 = ($incentive_type['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$incentive_type['status_url'] 	 = ($incentive_type['active_status'] == 1) ? 'deactivate' : 'activate';
		return $incentive_type;
	}

	protected function set_data($incentive_type)
	{
		$incentive_type['created'] 		 = date('Y-m-d H:i:s');
		$incentive_type['created_by'] 	 = $this->ion_auth->user()->row()->id;
		$incentive_type['active_status'] = 1;
		return $incentive_type;
    }
    
    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}

// End of file Incentive_type_model.php
// Location: ./application/models/Incentive_type_model.php