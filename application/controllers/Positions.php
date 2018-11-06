<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      SMTI-RDaludado
 * @link        http://systemantech.com
 */

class Positions extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'position_model',
			'company_model',
			'salary_grade_model',
			'employee_positions_model'
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$positions = $this->position_model->get_details('get_all', ['positions.active_status' => 1]);
		// dump($positions);exit;
		// $positions = $this->position_model->get_positions_from_salary_grade();
		// $positions = $this->position_model->get_positions_from_company();
		// $companies = $this->company_model->get_company_all('get_all', ['companies.active_status']);
		// $salary_grades = $this->salary_grade_model->get_details('get_all', ['companies.active_status']);
		$this->data = array(
            'page_header' 	=> 'Position Management',
            'notification' 	=> array("sound"=>false),
			'positions' 	=> $positions
		);
		$this->load_view('pages/position-lists');
	}

	/**
	 * Load add position form
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function add()
	{
        $salary_grades = $this->salary_grade_model->get_many_by(array('active_status' => 1));
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
		
		$this->data = array(
            'page_header' 	=> 'Add Position',
            'notification' 	=> array("sound"=>false),
			'companies'		=> $companies,
			'salary_grades' => $salary_grades
			
        );
		$this->load_view('forms/position-add');
	}

	function details($id)
	{
		
		// $site 			= $this->site_model->get_many_site_by(['sites.position_id' => $id]);
		// $sites 			= $this->site_model->get_many_site_by(['sites.position_id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);
		$employees = $this->employee_positions_model->get_details('get_many_by', ['position.id'=>$id]);
		$position 		= $this->position_model->get_position_by(['positions.id' => $id]);
		// dump($position);
		// dump($this->db->last_query());exit;
		$this->data = array(
			'page_header'    => 'Position Details',
			'position'         => $position,
			'employee_infos' => $employee_infos,
			'employees'		=>$employees,
			'active_menu' 	 => $this->active_menu
		);
		$this->load_view('pages/position-details');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
        $id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
        $position = $this->position_model->get($id);
        
        $type = 'position named <strong>' . $position['name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'positions/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
		);
		$this->load->view('modals/modal-confirmation', $data);            
    }	

	// function details($id)
	// {
	// 	$position = $this->position_model->get_position_by(['positions.id' => $id]);
	// 	$salary_grade = $this->salary_grade_model->get_many_salary_grade_by(['salary_grades.position_id' => $id]);
	// 	$salary_grades = $this->salary_grade_model->get_many_salary_grade_by(['salary_grades.position_id' => $id]);
	// 	$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);

	// 	$this->data = array(
	// 		'page_header' => 'Position Details',
	// 		'position'      => $position,
	// 		'salary_grades' => $salary_grade,
	// 		'salary_grades' => $salary_grades,
	// 		'employee_infos' => $employee_infos,
	// 		'active_menu' => $this->active_menu,
	// 	);
	// 	$this->load_view('pages/position-detail');
	// }

	function edit($position_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific position based on the id
		$position = $this->position_model->get_details('get_by', ['positions.id' => $position_id]);
		$companies  =$this->company_model->get_all(['active_status' => 1]);
		$salary_grades  =$this->salary_grade_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 	=> 'Position Edit',
            'notification' 	=> array("sound"=>false),
			'position' 		=> $position, 
			'position_id'	=> $position_id,	
			'companies'		=> $compasnies,
			'salary_grades'	=> $salary_grades
		);

		// $positions = $this->position_model->get_position_all();
		// $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('position_add'));

		// $this->form_validation->set_data($data);

		// if ($this->form_validation->run('position_add') == TRUE)
		// {
		// 	$position_id = $this->position_model->update($id, $data);

		// 	if ( ! $position_id) {
		// 		$this->session->set_flashdata('failed', 'Failed to update position.');
		// 		redirect('positions');
		// 	} else {
		// 		$this->session->set_flashdata('success', 'Position successfully updated!');
		// 		redirect('positions');
		// 	}
		// }
		$this->load_view('forms/position-edit');

		
		$post = $this->input->post();
        $this->form_validation->set_rules('salary_grade_id', 'Salary Grade', 'required');
        $this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('name', 'Position', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/position-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->position_model->update($position_id, $post);
				
			

				if($result){
					$this->session->set_flashdata('success', lang('edit_position_success'));
					redirect('positions');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_position_error'));
					redirect('positions');
				}
			}
		}
	}

	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function activate($position_id)
	{
		$object_id = $this->uri->segment(3);
		$position    = $this->position_model->get_many_position_by(['id' => $position_id]);
		$update    = $this->position_model->update($position_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated position ' . $position['name']);
			redirect('positions');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate position ' . $position['name']);
			redirect('positions');
		}
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function deactivate($position_id)
	{
		$object_id = $this->uri->segment(3);
		$position    	= $this->position_model->get_many_position_by(['id' => $position_id]);
		$update    		= $this->position_model->update($position_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $position['name'] . 'successfully Deactivated position ');
			redirect('positions');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate position ' . $position['name']);
			redirect('positions');
		}
	}

	/**
    * Some description here
    *
    * @param       param
    * @return      return
    */
   public function save()
   {
		$companies  =$this->company_model->get_all(['active_status' => 1]);
		$salary_grades  =$this->salary_grade_model->get_all(['active_status' => 1]);
		
		$this->data=array(
			'page_header'=>"POSITION MANAGEMENT",
			'companies'		=> $companies,
			'salary_grades'	=> $salary_grades
		);
        $post = $this->input->post();
        $this->form_validation->set_rules('name', 'Position name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('salary_grade_id', 'Salary Grade', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        //
        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/position-add'); 
        }
        else
        {
			// dump($post);exit;

			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->position_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_position_success'));
					redirect('positions');
		
				}
				else{
					$this->session->set_flashdata('error', lang('add_position_error'));
					redirect('positions');
				}
			}

   }
}
}
