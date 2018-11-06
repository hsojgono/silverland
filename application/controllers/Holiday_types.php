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

class Holiday_types extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['holiday_type_model']);
	}

	function index()
	{
		$holiday_types = $this->holiday_type_model->get_holiday_type_all();
		$companies 	   = $this->company_model->get_company_all();

		$this->data = array(
			'page_header' 	=> 'Holiday Type Management',
			'holiday_types' => $holiday_types,
			'companies'		=> $companies,
			'active_menu' 	=> $this->active_menu,
		);
		$this->load_view('pages/holiday_type-lists');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies 	 = $this->company_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Holiday Type Management',
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$holiday_types = $this->holiday_type_model->get_holiday_type_all();
		$data     = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_type_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('holiday_type_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_holiday_type',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

			$holiday_type_id = $this->holiday_type_model->insert($data);

			if ( ! $holiday_type_id) {
				$this->session->set_flashdata('failed', 'Failed to add holiday type.');
				redirect('holiday_types');
			} else {
				$this->session->set_flashdata('success', 'Successfully added ' .$data['name']);
				redirect('holiday_types');
			}
		}
		$this->load_view('forms/holiday_type-add');
	}

	function details($id)
	{
		$holiday_type = $this->holiday_type_model->get_holiday_type_by(['attendance_holiday_types.id' => $id]);

		$this->data = array(
            'page_header'  => 'Holiday Details',
			'holiday_type' => $holiday_type,
			'active_menu'  => $this->active_menu,
		);
		$this->load_view('pages/holiday_type-detail');
	}

	function edit($id)
	{
		// get specific holiday_type based on the id
		$holiday_type = $this->holiday_type_model->get_holiday_type_by(['attendance_holiday_types.id' => $id]);
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$this->data = array(
			'page_header' => 'Holiday Management',
			'holiday_type'=> $holiday_type,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$holiday_types = $this->holiday_type_model->get_holiday_type_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_type_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('holiday_type_add') == TRUE)
		{

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key'	  => 'edit_holiday_type',
				'old_data'	  => $holiday_type,
				'new_data'	  => $data
			]);
			$holiday_type_id = $this->holiday_type_model->update($id, $data);

			if ( ! $holiday_type_id) {
				$this->session->set_flashdata('failed', 'Failed to update holiday_type.');
				redirect('holiday_types');
			} else {
				$this->session->set_flashdata('success', 'Holiday successfully updated!');
				redirect('holiday_types');
			}
		}
		$this->load_view('forms/holiday_type-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_holiday_type 		  = $this->holiday_type_model->get_by(['id' => $id]);
        $data['edit_holiday_type'] = $edit_holiday_type;

        $this->load->view('modals/modal-update-holiday_type', $data);
    }

    public function update_status($id)
    {
        $holiday_type_data = $this->holiday_type_model->get_by(['id' => $id]);
        $data['holiday_type_data'] = $holiday_type_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->holiday_type_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->holiday_type_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $holiday_type_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('holiday_types');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$holiday_type_data['name'].'!');
                redirect('holiday_types');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-holiday_type-status', $data);
        }
    }
}
