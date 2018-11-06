<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Employment_types extends MY_Controller {


	private $active_menu = 'System';

	/**
	 * Some description here
	 *
	 * @param   param
	 * @return  return
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
	}

	public function index()
	{
		// todo: get all employment_types records from database order by name ascending
			// todo: load employment_type model
			// todo: load view & past the retrieved data from model
		$employment_types = $this->employment_type_model->get_employment_types_all();
        //dump($this->db->last_query());

		$this->data = array(
			'page_header' 		=> 'Employment Type Management',
			'employment_types'  => $employment_types,
			'active_menu' 		=> $this->active_menu,
		);

		$this->load_view('pages/employment_type-lists');
	}

	public function add()
	{

        $this->data = array(
            'page_header' => 'Employment Type Management',
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employment_type_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('employment_type_add') == TRUE)
        {
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_employment_type',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

            $employment_type_id = $this->employment_type_model->insert($data);

            if ( ! $employment_type_id) {
                $this->session->set_flashdata('failed', 'Failed to add new employment type.');
                redirect('employment_types');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new employment type.');
                redirect('employment_types');
            }
        }
        $this->load_view('forms/employment_type-add');
	}

	public function edit($id)
	{
        // get specific employment_type based on the id
        $employment_type = $this->employment_type_model->get_employment_types_by(['employment_types.id' => $id]);

        $this->data = array(
            'page_header' => 'Employment Type Management',
            'employment_type'      => $employment_type,
            'active_menu' => $this->active_menu,
        );

        // $employment_types = $this->employment_type_model->get_employment_type_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('employment_type_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('employment_type_add') == TRUE)
        {
            $employment_type_id = $this->employment_type_model->update($id, $data);

            if ( ! $employment_type_id) {
                $this->session->set_flashdata('failed', 'Failed to update employment_type.');
                redirect('employment_types');
            } else {
                $this->session->set_flashdata('success', 'Successfully updated employment_type.');
                redirect('employment_types');
            }
        }
        $this->load_view('forms/employment_type-edit');
	}

	public function details($id)
	{
        $employment_type = $this->employment_type_model->get_employment_types_by(['employment_types.id' => $id]);

        $this->data = array(
            'page_header' 	  => 'Employment Type Details',
            'employment_type' => $employment_type,
            'active_menu' 	  => $this->active_menu,
        );
        $this->load_view('pages/employment_type-details');
	}
}
