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

class Banks extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['bank_model']);
	}

	function index()
	{
		$banks       = $this->bank_model->get_bank_all();
		$companies 	 = $this->company_model->get_company_all();
		$branches 	 = $this->branch_model->get_branch_all();
		$departments = $this->department_model->get_department_all();
		// $teams 				= $this->team_model->get_team_all();

		$this->data = array(
			'page_header' => 'Bank Management',
			'banks'       => $banks,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/bank-lists');
	}

	function add()
	{
		$this->data = array(
			'page_header' => 'Bank Management',
			'active_menu' => $this->active_menu,
		);

		$banks = $this->bank_model->get_bank_all();
		$data     = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('bank_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('bank_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_bank',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

			$bank_id = $this->bank_model->insert($data);

			if ( ! $bank_id) {
				$this->session->set_flashdata('failed', 'Failed to add new bank.');
				redirect('banks');
			} else {
				$this->session->set_flashdata('success', 'Successfully added '. $data['name']);
				redirect('banks');
			}
		}
		$this->load_view('forms/bank-add');
	}

	function details($id)
	{
		$bank = $this->bank_model->get_bank_by(['banks.id' => $id]);

		$this->data = array(
			'page_header' => 'Bank Details',
			'bank'     	  => $bank,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/bank-details');
	}

	public function edit($id)
	{
		// get specific bank based on the id
		$bank = $this->bank_model->get_bank_by(['banks.id' => $id]);

		$this->data = array(
			'page_header' => 'Bank Management',
			'bank' 	      => $bank,
			'active_menu' => $this->active_menu,
		);

		$banks = $this->bank_model->get_bank_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('bank_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('bank_edit') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key' 	  => 'edit_bank',
				'old_data'	  => $bank,
				'new_data'    => $data
			]);

			$bank_id = $this->bank_model->update($id, $data);

			if ( ! $bank_id) {
				$this->session->set_flashdata('failed', 'Failed to update bank.');
				redirect('banks');
			} else {
				$this->session->set_flashdata('success', $data['name'] .' successfully updated!');
				redirect('banks');
			}
		}
		$this->load_view('forms/bank-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_bank 		   = $this->bank_model->get_by(['id' => $id]);
        $data['edit_bank'] = $edit_bank;

        $this->load->view('modals/modal-update-bank', $data);
    }

    public function update_status($id)
    {
        $bank_data = $this->bank_model->get_by(['id' => $id]);
        $data['bank_data'] = $bank_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                dump('De-activating...');
                $result = $this->bank_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->bank_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $bank_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('banks');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$bank_data['name'].'!');
                redirect('banks');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-bank-status', $data);
        }
    }
}
