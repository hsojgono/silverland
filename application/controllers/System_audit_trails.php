<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class System_audit_trails extends MY_Controller
{
	
	private $active_menu = 'System Admin';

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// if ( ! $this->ion_auth_acl->has_permission('audit_trails'))
		// {

		// }
		$this->data['page_header'] = 'System Audit Trails';
		$this->data['active_menu'] = $this->active_menu;

		$this->load_view('pages/audit-logs');
	}
}