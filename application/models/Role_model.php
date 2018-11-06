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
class Role_model extends MY_Model {

	protected $_table = 'system_groups';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/**
	 * Callbacks or Observers
	 */
	
	protected $before_create = ['generate_date_created_status'];
	protected $after_get = ['set_active_status'];

	protected function generate_date_created_status($group)
	{
		$group['created'] = date('Y-m-d H:i:s');
		$group['created_by'] = '0';
		return $group;
	}

	protected function set_active_status($group)
	{
		$group['status_label'] = ($group['active_status'] == 1) ? 'De-activate' : 'Activate';
		return $group;
	}
}
