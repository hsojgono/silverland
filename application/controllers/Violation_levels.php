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

class Violation_levels extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'violation_level_model',
			'company_model'
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$violation_levels = $this->violation_level_model->get_details('get_all', ['violation_levels.active_status' => 1]);
		$this->data = array(
            'page_header' 	=> 'Violation Level Management',
            'notification' 	=> array("sound"=>false),
			'violation_levels' 	=> $violation_levels
		);
		$this->load_view('pages/violation_level-lists');
	}

	/**
	 * Load add violation_level form
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function add()
	{
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
		
		$this->data = array(
            'page_header' 	=> 'Add New Violation Level',
            'notification' 	=> array("sound"=>false),
			'companies'		=> $companies
        );
		$this->load_view('forms/violation_level-add');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
        $id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
        $violation_level = $this->violation_level_model->get($id);
        
        $type = 'Violation Level named <strong>' . $violation_level['name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'violation_levels/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
		);
		$this->load->view('modals/modal-confirmation', $data);            
    }	


	function edit($violation_level_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific violation_level based on the id
		$violation_level = $this->violation_level_model->get_details('get_by', ['violation_levels.id' => $violation_level_id]);
		$companies  =$this->company_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 			=> 'ViolationLevel Edit',
            'notification' 			=> array("sound"=>false),
			'violation_level' 		=> $violation_level, 
			'violation_level_id'	=> $violation_level_id,	
			'companies'				=> $companies
		);
		

		$this->load_view('forms/violation_level-edit');

		
		$post = $this->input->post();
        $this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('name', 'Violation Level', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/violation_level-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->violation_level_model->update($violation_level_id, $post);
				
			

				if($result){
					$this->session->set_flashdata('success', lang('edit_violation_level_success'));
					redirect('violation_levels');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_violation_level_error'));
					redirect('violation_levels');
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
	function activate($violation_level_id)
	{
		$object_id = $this->uri->segment(3);
		$violation_level    = $this->violation_level_model->get_many_violation_level_by(['id' => $violation_level_id]);
		$update    = $this->violation_level_model->update($violation_level_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Violation Level ' . $violation_level['name']);
			redirect('violation_levels');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Violation Level ' . $violation_level['name']);
			redirect('violation_levels');
		}
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-RDaludado
	 * @param
	 * @return
	 */
	function deactivate($violation_level_id)
	{
		$object_id = $this->uri->segment(3);
		$violation_level    	= $this->violation_level_model->get_many_violation_level_by(['id' => $violation_level_id]);
		$update    		= $this->violation_level_model->update($violation_level_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $violation_level['name'] . 'Successfully Deactivated Violation Level ');
			redirect('violation_levels');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Violation Level ' . $violation_level['name']);
			redirect('violation_levels');
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
			'page_header'=>"Violation Level MANAGEMENT",
			'companies'		=> $companies
		);
        $post = $this->input->post();
        $this->form_validation->set_rules('name', 'Violation Level Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        //
        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/violation_level-add'); 
        }
        else
        {
			// dump($post);exit;

			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->violation_level_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_violation_level_success'));
					redirect('violation_levels');
		
				}
				else{
					$this->session->set_flashdata('error', lang('add_violation_level_error'));
					redirect('violation_levels');
				}
			}

   }
}
}
