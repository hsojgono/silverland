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
class Teams extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		// $this->load->library('audti_trail');
		$this->load->model([
			'team_model',
			'employee_information_model'
			]);
	}

	function index()
	{
		$teams       = $this->team_model->get_team_all();
		$companies 	 = $this->company_model->get_company_all();
		$branches 	 = $this->branch_model->get_branch_all();
		$departments = $this->department_model->get_department_all();
		// $team_information = $this->employee_information_model->get_details('get_all', '');

		// dump($team_information);exit;

		$this->data = array(
			'page_header'  => 'Team Management',
			'teams'        => $teams,
			'companies'    => $companies,
			'branches'     => $branches,
			'departments'  => $departments,
			// 'team_information' => $team_information,
			'active_menu'  => $this->active_menu,
		);
		$this->load_view('pages/team-lists');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$teams       = $this->team_model->get_many_by(['active_status' => 1]);
		$companies 	 = $this->company_model->get_many_by(['active_status' => 1]);
		$branches 	 = $this->branch_model->get_many_by(['active_status' => 1]);
		$departments = $this->department_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Team Management',
			'companies'	  => $companies,
			'teams' => $teams,
			'companies' => $companies,
			'branches' => $branches,
			'departments' => $departments,
			'active_menu' => $this->active_menu,
		);

		$teams = $this->team_model->get_team_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('team_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('team_add') == TRUE)
		{
			$team_id = $this->team_model->insert($data);

			if ( ! $team_id) {
				$this->session->set_flashdata('failed', 'Failed to add new team.');
				redirect('teams');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new team.');
				redirect('teams');
			}
		}
		$this->load_view('forms/team-add');
	}

	function details($id)
	{
		$team 		= $this->team_model->get_team_by(['teams.id' => $id]);
		$site 					= $this->site_model->get_many_site_by(['sites.team_id' => $id]);
		$sites 					= $this->site_model->get_many_site_by(['sites.team_id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);

		$this->data = array(
			'page_header' => 'Team Details',
			'team'      => $team,
			'sites' => $site,
			'sites' => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/team-detail');
	}

	function edit($id)
	{
		// get specific team based on the id
		$team = $this->team_model->get_details('get_by', ['teams.id' => $id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$teams       = $this->team_model->get_many_by(['active_status' => 1]);
		$companies 	 = $this->company_model->get_many_by(['active_status' => 1]);
		$branches 	 = $this->branch_model->get_many_by(['active_status' => 1]);
		$departments = $this->department_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Team Management',
			'team' => $team,
			'companies'	  => $companies,
			'teams' => $teams,
			'companies' => $companies,
			'branches' => $branches,
			'departments' => $departments,
			'active_menu' => $this->active_menu,
		);

		$teams = $this->team_model->get_team_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('team_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('team_edit') == TRUE)
		{
			$team_id = $this->team_model->update($id, $data);

			if ( ! $team_id) {
				$this->session->set_flashdata('failed', 'Failed to update team.');
				redirect('teams');
			} else {
				$this->session->set_flashdata('success', 'Team successfully updated!');
				redirect('teams');
			}
		}
		$this->load_view('forms/team-edit');
	}

    public function edit_confirmation($id)
    {
        $team_data = $this->team_model->get_by(['id' => $id]);
        $data['team_data'] = $team_data;

        $this->load->view('modals/modal-update-team', $data);
    }

    public function update_status($id)
    {
        $team_data = $this->team_model->get_by(['id' => $id]);
        $data['team_data'] = $team_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->team_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->team_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $team_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('teams');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$team_data['name'].'!');
                redirect('teams');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-team-status', $data);
        }
    }
}
