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
class Employee_hierarchy extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['page_header'] = 'Employee Hierarchy';
        $this->load_view('pages/employee-hierarchy');
	}

	public function ajax_employee_hierarchy()
    {
        $this->load->model('employee_information_model');
        
		$new_data = $this->employee_information_model->get_employee_hierarchy_data();

        echo json_encode(array('data' => $new_data));
	}
	
	public function ajax_system_menu()
	{
		$this->load->model('employee_information_model');
        
		$new_data = $this->employee_information_model->get_system_menu_hierarchy_data();
        echo json_encode(array('data' => $new_data));
	}
}

// End of file Employee_hierarchy.php
// Location: ./application/controllers/Employee_hierarchy.php