<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class System_settings extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'system_module_model',
			'system_function_model',
			'system_permission_model',
		]);
	}

	// --------------------------------------

	public function list_modules()
	{
		dump('modules get');
		$list = $this->system_module_model->get_all();
		dump($list);
		echo anchor('system_settings/add_module', 'ADD NEW MODULE');
	}

	public function add_module()
	{
		dump('modules add');

		// $data = remove_unknown_fields($this->input->post(), $this->form_validation->get_field_names('add_module'));

		// dump($data);

		$this->data['page_header'] = 'System Module';
		$this->data['active_menu'] = 'System';
		$this->load_view('forms/system-module-add');
	}

	public function edit_module()
	{
		dump('modules edit');
	}

	public function details_module()
	{
		dump('modules details');
	}

	// --------------------------------------

	public function list_functions()
	{
		dump('functions get');
	}

	public function add_function()
	{
		dump('functions add');
	}

	public function edit_function()
	{
		dump('functions edit');
	}

	public function details_function()
	{
		dump('functions details');
	}

	// --------------------------------------

	public function list_permissions()
	{
		dump('permissions get');
	}

	public function add_permission()
	{
		dump('permissions add');
	}

	public function edit_permission()
	{
		dump('permissions edit');
	}

	public function details_permission()
	{
		dump('permissions details');
	}

}
