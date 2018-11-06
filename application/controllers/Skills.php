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
class Skills extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['skill_model']);
	}

	function index()
	{
		$skills = $this->skill_model->get_details('get_many_by', ['skills.active_status' => 1]);
		$skills = $this->skill_model->get_skill_all();
		$this->data = array(
			'page_header' => 'Skills Management',
			'skills'      => $skills,
			'show_modal'  => FALSE,
			'active_menu' => $this->active_menu
		);
		$this->load_view('pages/skill-lists');
	}

	function add()
	{
		// get all company records where status is equal to active

		$this->data = array(
			'page_header' => 'Skills Management',
			'active_menu' => $this->active_menu,
		);

		$skills = $this->skill_model->get_details('get_all', ['skills.active_status' => 1]);
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('skill_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('skill_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_skill',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$skill_id = $this->skill_model->insert($data);

			if ( ! $skill_id) {
				$this->session->set_flashdata('failed', 'Failed to add new skill.');
				redirect('skills');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new skill.');
				redirect('skills');
			}
		}
		$this->load_view('forms/skill-add');
	}

	function details($id)
	{
		$skill = $this->skill_model->get_details('get_by', ['id' => $id]);

		$this->data = array(
			'page_header' => 'Skills Details',
			'skill'       => $skill,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/skill-details');
	}

	function edit($id)
	{
		$skill_id = $this->uri->segment(3);
		$skills = $this->skill_model->get_all();
		$skill = $this->skill_model->get_by(['id' => $skill_id]);

		$this->data = array(
			'page_header'     => 'Skills Management',
			'skill'           => $skill,
			'skills'          => $skills,
			'skill_id'        => $skill_id,
			'show_modal'      => TRUE,
			'modal_title'     => 'Update Skill',
			'modal_file_path' => 'modals/modal-edit-skill',
		);

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('skill_edit'));

		if (isset($post['save'])) {
			$update = $this->skill_model->update($skill_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated ' . $skill['name']);
				redirect('skills');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update ' . $skill['name']);
				redirect('skills');
			}
		}
		$this->load_view('pages/skill-lists');
	}

    public function edit_confirmation($id)
    {
        $edit_skill = $this->skill_model->get_by(['id' => $id]);
        $data['edit_skill'] = $edit_skill;

        $this->load->view('modals/modal-update-skill', $data);
    }

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$skill_id = $this->uri->segment(4);

        $edit_skill = $this->skill_model->get_by(['id' => $skill_id]);
        $data['edit_skill'] = $edit_skill;
		
		$skill = $this->skill_model->get_by(['id' => $skill_id]);

		$modal_message = "You're about to " . $mode . "<strong> " . $edit_skill['name'] . "</strong>"; 

		$data = array(
			'url' 			=> 'skills/' . $mode . '/' . $skill_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}  

	public function cancel()
	{
		redirect('skills');
	}  

    public function update_status($id)
    {
        $skill_data = $this->skill_model->get_by(['id' => $id]);
        $data['skill_data'] = $skill_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
				$old_data = 1;
				$new_data = 0;
                $result = $this->skill_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
				$old_data = 0;
				$new_data = 1;
                $result = $this->skill_model->update($id, ['active_status' => 1]);
            }

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 6,
				'perm_key'    => 'update_skill_status',
				'old_data'    => $old_data,
				'new_data'    => $new_data
			]);

            if ($result)
            {
                 $this->session->set_flashdata('message', $skill_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('skills');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$skill_data['name'].'!');
                redirect('skills');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-skill-status', $data);
        }
    }
}
