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

class Sanction_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		
		$this->load->model([
			'sanction_type_model',
			'company_model'
			]);
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		$sanction_types = $this->sanction_type_model->get_details('get_all', ['sanction_types.active_status' => 1]);
		$this->data = array(
            'page_header' 	=> 'Sanction Type Management',
            'notification' 	=> array("sound"=>false),
			'sanction_types' 	=> $sanction_types
		);
		$this->load_view('pages/sanction-type-view');
	}

	/**
	 * Load add violation_type form
	 * 
	 * @author	SMTI-DAbad;Intern
	 * @param
	 * @return
	 */
	function add()
	{
		$companies = $this->company_model->get_many_by(array('active_status' => 1));
		
		$this->data = array(
            'page_header' 	=> 'Add Sanction type',
            'notification' 	=> array("sound"=>false),
			'companies'		=> $companies
        );
		$this->load_view('forms/sanction-type-add');
	}

	function confirmation()
	    {
        $url         = $this->uri->segment(3);
        $id 		 = $this->uri->segment(4);

        $mode = explode('_', $url);

		// dump($mode);exit;
        
        $sanction_type = $this->sanction_type_model->get($id);
        
        $type = 'Sanction Type named <strong>' . $sanction_type['name'] . '</strong>';
		$modal_message = sprintf(lang('confirmation_message'), $mode[0], $type);

		$data = array(
			'url' 			=> 'sanction_types/' . $url . '/' . $id,
			'modal_title' 	=> ucfirst($mode[0]),
			'modal_message' => $modal_message,
			'mode'			=> $mode[0]
		);
		$this->load->view('modals/modal-confirmation', $data);            
    }	


	function edit($sanction_type_id)
	{
		$primary_id = $this->uri->segment(3);
		// get specific violation_type based on the id
		$sanction_type = $this->sanction_type_model->get_details('get_by', ['sanction_types.id' => $sanction_type_id]);
		$companies  =$this->company_model->get_all(['active_status' => 1]);
		

		$this->data = array(
            'page_header' 			=> 'Edit Sanction Type',
            'notification' 			=> array("sound"=>false),
			'sanction_type' 		=> $sanction_type, 
			'sanction_type_id'		=> $sanction_type_id,	
			'companies'				=> $companies
		);
		

		$this->load_view('forms/sanction-type-edit');

		
		$post = $this->input->post();
        // $this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('name', 'Sanction type', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
        

        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/sanction-type-edit'); 
        }
		else
        {
			

			$mode=$post['mode'];
			unset($post['mode']);


			if($mode=='edit'){
				$id=$post['id'];
				// dump($post['id']);exit;
				unset($post['id']);

				$result = $this->sanction_type_model->update($sanction_type_id, $post);
				
			// dump($result);exit;

				if($result){
					$this->session->set_flashdata('success', lang('edit_sanction_type_success'));
					redirect('sanction_types');
					
				}
				else{
					$this->session->set_flashdata('error', lang('edit_sanction_type_error'));
					redirect('sanction_types');
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
	function activate($sanction_type_id)
	{
		$object_id = $this->uri->segment(3);
		$sanction_type    = $this->sanction_type_model->get_many_sanction_type_by(['id' => $sanction_type_id]);
		$update    = $this->sanction_type_model->update($sanction_type_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated Sanction Type ' . $sanction_type['name']);
			redirect('sanction_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate Sanction Type ' . $sanction_type['name']);
			redirect('sanction_types');
		}
	}
 
	/**
	 * Some description here
	 * 
	 * @author	SMTI-DAbad;Intern
	 * @param
	 * @return
	 */
	function deactivate($sanction_type_id)
	{
		$object_id 			= $this->uri->segment(3);
		$sanction_type    	= $this->sanction_type_model->get_many_sanction_type_by(['id' => $sanction_type_id]);
		$update    			= $this->sanction_type_model->update($sanction_type_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', $sanction_type['name'] . 'Successfully Deactivated Sanction Type ');
			redirect('sanction_types');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Deactivate Sanction Type ' . $sanction_type['name']);
			redirect('sanction_types');
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
			'page_header'=>"Sanction Type MANAGEMENT",
			'companies'		=> $companies
		);
        $post = $this->input->post();
        $this->form_validation->set_rules('name', 'Sanction type Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
        //
        if ($this->form_validation->run() == FALSE)
        {
			// dump('here');
        	$this->load_view('forms/sanction-type-add'); 
        }
        else
        {
			// dump($post);exit;

			$mode=$post['mode'];
			unset($post['mode']);

			if($mode=='add'){
				$result = $this->sanction_type_model->insert($post);
				if($result){
					$this->session->set_flashdata('success', lang('add_sanction_type_success'));
					redirect('sanction_types');
		
				}
				else{
					$this->session->set_flashdata('error', lang('add_sanction_type_error'));
					redirect('sanction_types');
				}
			}

   }
}
}