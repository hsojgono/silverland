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

class Violation_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'violation_type_model',
			'company_model'
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$violation_types = $this->violation_type_model->get_details('get_all', ['violation_types.active_status' => 1]);
		$this->data = array(
            'page_header' 	=> 'Violation type Management',
            'notification' 	=> array("sound"=>false),
			'violation_types' 	=> $violation_types
		);
		$this->load_view('pages/violation_type-lists');
	}

	/**
	 * Load add violation_type form
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function add()
	{
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
		
		$this->data = array(
            'page_header' 	=> 'Add New Violation type',
            'notification' 	=> array("sound"=>false),
			'companies'		=> $companies
        );
		$this->load_view('forms/violation_type-add');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
        $id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
        $violation_type = $this->violation_type_model->get($id);
        
        $type = 'Violation type named <strong>' . $violation_type['name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'violation_types/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
		);
		$this->load->view('modals/modal-confirmation', $data);            
    }	


	function edit($violation_type_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific violation_type based on the id
		$violation_type = $this->violation_type_model->get_details('get_by', ['violation_types.id' => $violation_type_id]);
		$companies  =$this->company_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 			=> 'Violationtype Edit',
            'notification' 			=> array("sound"=>false),
			'violation_type' 		=> $violation_type, 
			'violation_type_id'		=> $violation_type_id,	
			'companies'				=> $companies
		);
		

		$this->load_view('forms/violation_type-edit');

		
		$post = $this->input->post();
        // $this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('name', 'Violation type', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/violation_type-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->violation_type_model->update($violation_type_id, $post);
				
			// dump($result);exit;

				if($result){
					$this->session->set_flashdata('success', lang('edit_violation_type_success'));
					redirect('violation_types');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_violation_type_error'));
					redirect('violation_types');
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
	function activate($violation_type_id)
	{
		$object_id = $this->uri->segment(3);
		$violation_type    = $this->violation_type_model->get_many_violation_type_by(['id' => $violation_type_id]);
		$update    = $this->violation_type_model->update($violation_type_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Violation type ' . $violation_type['name']);
			redirect('violation_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Violation type ' . $violation_type['name']);
			redirect('violation_types');
		}
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function deactivate($violation_type_id)
	{
		$object_id = $this->uri->segment(3);
		$violation_type    	= $this->violation_type_model->get_many_violation_type_by(['id' => $violation_type_id]);
		$update    		= $this->violation_type_model->update($violation_type_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $violation_type['name'] . 'Successfully Deactivated Violation type ');
			redirect('violation_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Violation type ' . $violation_type['name']);
			redirect('violation_types');
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
		
		$this->data=array(
			'page_header'=>"Violation type MANAGEMENT",
			'companies'		=> $companies
		);
        $post = $this->input->post();
        $this->form_validation->set_rules('name', 'Violation type Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        //
        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/violation_type-add'); 
        }
        else
        {
			// dump($post);exit;

			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->violation_type_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_violation_type_success'));
					redirect('violation_types');
		
				}
				else{
					$this->session->set_flashdata('error', lang('add_violation_type_error'));
					redirect('violation_types');
				}
			}

   }
}
}