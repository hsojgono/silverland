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

class Benefits extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
            'benefit_model',
            'benefit_matrix_model',
            'company_model'
        ]);
	}

	function index()
	{
        $user = $this->ion_auth->user()->row();

        $benefits = $this->benefit_model->get_details('get_many_by', [
            'companies.id' => $user->company_id,
        ]);  

		$this->data = array(
			'page_header' => 'Benefit Management',
			'benefits'       => $benefits,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/benefit-lists');
	}

	function add()
	{
        $user = $this->ion_auth->user()->row();
        $benefit_matrices = $this->benefit_matrix_model->get_details('get_many_by', [
            'active_status' => 1,
            'company_id' => $user->company_id
        ]);

		$this->data = array(
			'page_header' => 'Benefit Management',
            'active_menu' => $this->active_menu,
            'benefit_matrices' => $benefit_matrices
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('benefit_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('benefit_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_benefit',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

            // dump($data);exit;
			$benefit_id = $this->benefit_model->insert($data);

			if ( ! $benefit_id) {
				$this->session->set_flashdata('failed', 'Failed to add new benefit.');
				redirect('benefits');
			} else {
				$this->session->set_flashdata('success', 'Successfully added '. $data['name']);
				redirect('benefits');
			}
		}
		$this->load_view('forms/benefit-add');
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
        $user = $this->ion_auth->user()->row();

        $benefit_matrices = $this->benefit_matrix_model->get_details('get_many_by', [
            'active_status' => 1,
            'company_id' => $user->company_id
        ]);

		$benefit = $this->benefit_model->get_details('get_by', ['benefits.id' => $id]);

		$this->data = array(
			'page_header' => 'Benefit Management',
            'benefit' => $benefit,
            'benefit_matrices' => $benefit_matrices,
			'active_menu' => $this->active_menu,
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('benefit_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('benefit_edit') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key' 	  => 'edit_bank',
			// 	'old_data'	  => $bank,
			// 	'new_data'    => $data
			// ]);

			$benefit_id = $this->benefit_model->update($id, $data);

			if ( ! $benefit_id) {
				$this->session->set_flashdata('failed', 'Failed to update benefit.');
				redirect('benefits');
			} else {
				$this->session->set_flashdata('success', $data['name'] .' successfully updated!');
				redirect('benefits');
			}
		}
		$this->load_view('forms/benefit-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_benefit = $this->benefit_model->get_by(['id' => $id]);
        $data['edit_benefit'] = $edit_benefit;

        $this->load->view('modals/modal-update-benefit', $data);
    }

    public function update_status($id)
    {
        $benefit_data = $this->benefit_model->get_by(['id' => $id]);
        $data['benefit_data'] = $benefit_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                $result = $this->benefit_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->benefit_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $benefit_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('benefits');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$benefit_data['name'].'!');
                redirect('benefits');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-benefit-status', $data);
        }
    }
}
