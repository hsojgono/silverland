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
class System_module_model extends MY_Model {

	protected $_table = 'system_modules';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $before_create = array(
		'prep_data'
	);

	protected function prep_data($system_module)
	{
		$system_module['status'] = 0;
		$system_module['created_by'] = 1; // TODO: make this dynamic value based on the user id off current logged in user
		$system_module['created'] = date('Y-m-d H:i:s');
		return $system_module;
	}
}
