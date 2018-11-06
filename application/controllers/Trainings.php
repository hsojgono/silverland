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
class Trainings extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'training_model',
			'company_model'
		]);
	}

	function index()
	{
		$trainings = $this->training_model->get_details('get_all', ['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Trainings Management',
			'trainings'   => $trainings,
			'show_modal'  => FALSE,
			'active_menu' => $this->active_menu
		);
		$this->load_view('pages/training-lists');
	}

	public function load_form()
	{
		$companies = $this->company_model->get_all(['active_status' => 1]);
		$data = array(
			'modal_title' => 'Add Training',
			'companies'   => $companies
		);
		$this->load->view('modals/modal-add-training', $data);
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_all(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Trainings Management',
			'companies'   => $companies,
			'active_menu' => $this->active_menu,
		);

		$trainings = $this->training_model->get_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('training_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('training_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$training_id = $this->training_model->insert($data);

			if ( ! $training_id) {
				$this->session->set_flashdata('failed', 'Failed to add new training.');
				redirect('trainings');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new training.');
				redirect('trainings');
			}
		}
		$this->load_view('forms/training-add');
	}

	function details($id)
	{
		$training = $this->training_model->get_details('get_by', ['id' => $id]);

		$this->data = array(
			'page_header' => 'trainings Details',
			'training'    => $training,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/training-details');
	}

	function edit($id)
	{
		$training_id = $this->uri->segment(3);
		$trainings   = $this->training_model->get_all();
		$training    = $this->training_model->get_by(['id' => $training_id]);

		$this->data = array(
			'page_header'     => 'Trainings Management',
			'training'        => $training,
			'trainings'       => $trainings,
			'training_id'     => $training_id,
			'show_modal'      => TRUE,
			'modal_title'     => 'Update Training',
			'modal_file_path' => 'modals/modal-edit-training',
		);

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('training_edit'));

		if (isset($post['save'])) {
			$update = $this->training_model->update($training_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated ' . $training['name']);
				redirect('trainings');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update ' . $training['name']);
				redirect('trainings');
			}
		}
		$this->load_view('pages/training-lists');
	}

    public function edit_confirmation($id)
    {
        $training = $this->training_model->get_by(['id' => $id]);
        $data['training'] = $training;

        $this->load->view('modals/modal-update-training', $data);
    }

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$training_id = $this->uri->segment(4);
		$training = $this->training_model->get_by(['id' => $training_id]);
		
        $data['training'] = $training;

		$modal_message = "You're about to " . $mode . "<strong> " . $training['title'] . "</strong>"; 

		$data = array(
			'url' 			=> 'trainings/' . $mode . '/' . $training_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}  

	public function cancel()
	{
		redirect('trainings');
	}  

    public function update_status($id)
    {
        $training_data = $this->training_model->get_by(['id' => $id]);
        $data['training_data'] = $training_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
				$old_data = 1;
				$new_data = 0;
                $result = $this->training_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
				$old_data = 0;
				$new_data = 1;
                $result = $this->training_model->update($id, ['active_status' => 1]);
            }

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 6,
				'perm_key'    => 'training_status',
				'old_data'    => $old_data,
				'new_data'    => $new_data
			]);

            if ($result)
            {
                 $this->session->set_flashdata('message', $training_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('trainings');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$training_data['name'].'!');
                redirect('trainings');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-training-status', $data);
        }
    }
}
