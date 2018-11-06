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

class Violations extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'violation_model',
			'company_model',
			'violation_type_model',
			'violation_level_model'
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$violations = $this->violation_model->get_details('get_all', ['violations.active_status' => 1]);
		$this->data = array(
            'page_header' 	=> 'Violation Management',
            'notification' 	=> array("sound"=>false),
			'violations' 	=> $violations
			
		);
		$this->load_view('pages/violation-lists');
	}

	/**
	 * Load add violation form
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function add()
	{
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
		$violation_levels = $this->violation_level_model->get_many_by(array('active_status' => 1));
		$violation_types = $this->violation_type_model->get_many_by(array('active_status' => 1));
		
		$this->data = array(
            'page_header' 	=> 'Add New Violation',
            'notification' 	=> array("sound"=>false),
			'companies'		=> $companies,
			'violation_levels'	=>$violation_levels,
			'violation_types'	=>$violation_types
        );
		$this->load_view('forms/violation-add');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
		$id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
		$violation = $this->violation_model->get_details('get_by', ['violations.id' => $id]);
		// $violation_type =$this->violation_type_model->get_by(array('id'=>$id));
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		// $violation_type = $this->violation_model->get_by(array('violations.violation_type_id' => $violation_type_id));
		// dump($this->db->last_query());
		// dump($violation);
		// exit;
        $type = 'Violation named <strong>' . $violation['violation_type_name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'violations/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
					);
		$this->load->view('modals/modal-confirmation', $data);            
    }	


	function edit($violation_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific violation based on the id
		$violation = $this->violation_model->get_details('get_by', ['violations.id' => $violation_id]);
		$violation_levels  =$this->violation_level_model->get_all(['active_status' => 1]);
		$violation_types  =$this->violation_type_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 			=> 'Violatio Edit',
            'notification' 			=> array("sound"=>false),
			'violation' 			=> $violation, 
			'violation_id'			=> $violation_id,	
			'violation_levels'		=> $violation_levels,
			'violation_types'		=>	$violation_types
		);
		

		$this->load_view('forms/violation-edit');

		
		$post = $this->input->post();
		$this->form_validation->set_rules('violation_level_id', 'Violation Level', 'required');
		$this->form_validation->set_rules('violation_type_id', 'Violation Type', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/violation-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->violation_model->update($violation_id, $post);
				
			

				if($result){
					$this->session->set_flashdata('success', lang('edit_violation_success'));
					redirect('violations');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_violation_error'));
					redirect('violations');
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
	function activate($violation_id)
	{
		$object_id = $this->uri->segment(3);
		$violation    = $this->violation_model->get_many_violation_by(['id' => $violation_id]);
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		$update    = $this->violation_model->update($violation_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Violation ' . $violation['violation_type_name']);
			redirect('violations');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Violation ' . $violation['violation_type_name']);
			redirect('violations');
		}
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function deactivate($violation_id)
	{
		$object_id = $this->uri->segment(3);
		$violation    	= $this->violation_model->get_many_violation_by(['id' => $violation_id]);
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		$update    		= $this->violation_model->update($violation_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $violation['violation_type_name'] . 'Successfully Deactivated Violation ');
			redirect('violations');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Violation ' . $violation['violation_type_name']);
			redirect('violations');
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
		$companies  = $this->company_model->get_all(['active_status' => 1]);
		$violation_levels  = $this->violation_level_model->get_all(['active_status' => 1]);
		$violation_types  = $this->violation_type_model->get_all(['active_status' => 1]);
		
		$this->data=array(
			'page_header'=>"Violation Management",
			'companies'		=> $companies,
			'violation_levels'	=>$violation_levels,
			'violation_types'	=>$violation_types
		);

		$post = $this->input->post();
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('violation_type_id', 'Violation Type', 'required');
        $this->form_validation->set_rules('violation_level_id', 'Violation Level', 'required');
		//
		
        if ($this->form_validation->run() == FALSE)
        {
        	$this->load_view('forms/violation-add'); 
        }
        else
        {
			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->violation_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_violation_success'));
					redirect('violations');
				}
				else{
					$this->session->set_flashdata('error', lang('add_violation_error'));
					redirect('violations');
				}
			}
   		}
	}
}
