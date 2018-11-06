<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      SMTI-DAbad;Intern
 * @link        http://systemantech.com
 */

class Sanctions extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'sanction_model',
			'company_model',
			'sanction_type_model'
			
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$sanctions = $this->sanction_model->get_details('get_all', ['sanctions.active_status' => 1]);
		$this->data = array(
            'page_header' 	=> 'Sanction Management',
            'notification' 	=> array("sound"=>false),
			'sanctions' 	=> $sanctions
			
		);
		$this->load_view('pages/sanction-view');
	}

	/**
	 * Load add violation form
	 * 
	 * @author	SMTI-DAbad;Intern
	 * @param
	 * @return
	 */
	function add()
	{
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
        $sanction_types = $this->sanction_type_model->get_many_by(array('active_status' => 1));
        
		$this->data = array(
            'page_header' 		=> 'Add Sanction',
            'notification' 		=> array("sound"=>false),
			'companies'			=> $companies,
			'sanction_types'	=> $sanction_types
        );
		$this->load_view('forms/sanction-add');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
		$id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
		$sanction = $this->sanction_model->get_details('get_by', ['sanctions.id' => $id]);
		// $violation_type =$this->violation_type_model->get_by(array('id'=>$id));
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		// $violation_type = $this->violation_model->get_by(array('violations.violation_type_id' => $violation_type_id));
		// dump($this->db->last_query());
		// dump($violation);
		// exit;
        $type = 'Sanction named <strong>' . $sanction['sanction_type_name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'sanctions/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
					);
		$this->load->view('modals/modal-confirmation', $data);            
    }	


	function edit($sanction_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific violation based on the id
		$sanction        = $this->sanction_model->get_details('get_by', ['sanctions.id' => $sanction_id]);
        $sanction_types  = $this->sanction_type_model->get_all(['active_status' => 1]);
        $companies       = $this->company_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 			=> 'Edit Sanction',
            'notification' 			=> array("sound"=>false),
			'sanction' 			    => $sanction, 
			'sanction_id'			=> $sanction_id,	
            'sanction_types'		=> $sanction_types,
            'companies'             => $companies
		);
		

		$this->load_view('forms/sanction-edit');

		
		$post = $this->input->post();
		$this->form_validation->set_rules('sanction_type_id', 'Sanction Type', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/sanction-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->sanction_model->update($sanction_id, $post);
				
			

				if($result){
					$this->session->set_flashdata('success', lang('edit_sanction_success'));
					redirect('sanctions');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_sanction_error'));
					redirect('sanctions');
				}
			}
		}
	}

	/**
	 * Some description here
	 * 
	 * @author	SMTI-DAbad;Intern
	 * @param
	 * @return
	 */
	function activate($sanction_id)
	{
		$object_id 	= $this->uri->segment(3);
		$sanction   = $this->sanction_model->get_many_sanction_by(['id' => $sanction_id]);
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		$update    	= $this->sanction_model->update($sanction_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Sanction ' . $sanction['sanction_type_name']);
			redirect('sanctions');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Sanction ' . $sanction['sanction_type_name']);
			redirect('sanctions');
		}
	}

	/**
	 * Some description here
	 * 
	 * @author	SMTI-DAbad;Intern
	 * @param
	 * @return
	 */
	function deactivate($sanction_id)
	{
		$object_id 		= $this->uri->segment(3);
		$sanction    	= $this->sanction_model->get_many_sanction_by(['id' => $sanction_id]);
		// $violation_type = $this->violation_model->get_details('get_many_by', ['violations.violation_type_id' => $violation_type_id]);
		$update    		= $this->sanction_model->update($sanction_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $sanction['sanction_type_name'] . 'Successfully Deactivated Sanction ');
			redirect('sanctions');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Sanction ' . $sanction['sanction_type_name']);
			redirect('sanctions');
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
		$sanction_types  = $this->sanction_type_model->get_all(['active_status' => 1]);
		
		$this->data=array(
			'page_header'		=>"Sanction Management",
			'companies'			=> $companies,
			'sanction_types'	=>$sanction_types
		);

		$post = $this->input->post();
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('sanction_type_id', 'Sanction Type', 'required');
		//
		
        if ($this->form_validation->run() == FALSE)
        {
        	$this->load_view('forms/sanction-add'); 
        }
        else
        {
			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->sanction_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_sanction_success'));
					redirect('sanctions');
				}
				else{
					$this->session->set_flashdata('error', lang('add_sanction_error'));
					redirect('sanctions');
				}
			}
   		}
	}
}
