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
class System_function_model extends MY_Model {

	protected $_table = 'system_functions';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	public function get_with_parent()
	{
		$this->db->select('system_functions.*, p.name parent_name, p.link as parent_link');
		$this->db->join('system_functions as p', 'system_functions.parent_function_id = p.id', 'left');

		return $this->get_all();
	}
}
