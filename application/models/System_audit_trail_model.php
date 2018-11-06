<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class System_audit_trail_model extends MY_Model
{
	protected $_table 	   = 'system_audit_trails';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = ['prep_default_data'];

	protected function prep_default_data($audit_trail)
	{
		if ( ! isset($audit_trail)) return FALSE;

		$this->config->load('employee', TRUE);
		$mode_labels = $this->config->item('log_modes', 'employee');

		$audit_trail['mode_label'] = ($audit_trail['action_mode'] > count($mode_labels)) ? 'N/A' : $mode_labels[$audit_trail['action_mode']];

		return $audit_trail;
	}
}
