<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.kevin@systemantech.com
 * @link        http://systemantech.com
 */
class Location_model extends MY_Model {

	protected $_table = 'locations';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/**
	 * Callbacks or Observers
	 */

	 protected $after_get = array('prepare_data');
	 protected $before_create = array('set_data');
	 protected $before_update = ['set_data_before_update'];
	 protected $after_create  = ['write_audit_trail'];
	 protected $after_update  = ['write_audit_trail'];

	 protected function prepare_data($location)
	 {
		 if ( ! isset($location)) return FALSE;
 
		 $locations = array(
			 $location['barangay'],
			 $location['city'],
			 $location['province']
		 );
 
		 // //location of the company
		 $location['location'] = strtoupper(implode(', ', $locations));
 
		 $location['status_label']  = ($location['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		 $location['status_action'] = ($location['active_status'] == 1) ? 'Deactivate' : 'Activate';
		 $location['status_icon'] = ($location['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		 $location['status_url']  = ($location['active_status'] == 1) ? 'deactivate' : 'activate';
		 return $location;
	 }
	
	public function get_locations()
	{
        $query = $this->db;

        $query->select('
            CONCAT_WS(", ", "barangay", "city", "province") as loc
		');
        return $this->get_all();
	}

	public function get_details($method, $where)
	{
		$this->db->select('*');
		return $this->{$method}($where);
	}
}
