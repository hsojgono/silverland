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
class Cost_centers extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'cost_center_model',
			'branch_model',
			'company_model',
			'department_model',
			'team_model'
		]);
	}

	function index()
	{
		// $cost_centers = $this->cost_center_model->get_cost_center_all();
		$cost_centers = $this->cost_center_model->get_details('get_all', ['cost_centers.active_status' => 1]);

		$this->data = array(
			'page_header'    => 'Cost Centers Management',
			'cost_centers'  => $cost_centers,
			'active_menu'    => $this->active_menu,
		);
		$this->load_view('pages/cost_center-lists');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies 	 = $this->company_model->get_many_by(['active_status' => 1]);
		$branches  	 = $this->branch_model->get_many_by(['active_status' => 1]);
		$departments = $this->department_model->get_many_by(['active_status' => 1]);
		// $teams 		 = $this->team_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Cost Centers Management',
			'companies'	  => $companies,
			'branches'	  => $branches,
			'departments' => $departments,
			'active_menu' => $this->active_menu,
		);

		$cost_centers = $this->cost_center_model->get_cost_center_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('cost_center_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('cost_center_add') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 0,
				'perm_key' 	  => 'add_cost_center',
				'old_data'	  => NULL,
				'new_data'    => $data
			]);

			$cost_center_id = $this->cost_center_model->insert($data);

			if ( ! $cost_center_id) {
				$this->session->set_flashdata('failed', 'Failed to add new cost center.');
				redirect('cost_centers');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new cost center.');
				redirect('cost_centers');
			}
		}
		$this->load_view('forms/cost_center-add');
	}

	function details($id)
	{
		$cost_center 	= $this->cost_center_model->get_cost_center_by(['cost_centers.id' => $id]);
		$site 			= $this->site_model->get_many_site_by(['sites.id' => $id]);
		$sites 			= $this->site_model->get_many_site_by(['sites.id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);

		$this->data = array(
			'page_header' => 'Cost Centers Details',
			'cost_center' => $cost_center,
			'sites' => $site,
			'sites' => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/cost_center-detail');
	}

	function edit($id)
	{
		// get specific cost_center based on the id
		$cost_center = $this->cost_center_model->get_details('get_by',['cost_centers.id' => $id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$branches = $this->branch_model->get_many_by(['active_status' => 1]);
		$departments = $this->department_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Cost Centers Management',
			'cost_center' 	  => $cost_center,
			'companies'	  => $companies,
			'companies' => $companies,
			'branches' => $branches,
			'departments' => $departments,
			'active_menu' => $this->active_menu,
		);

		$cost_centers = $this->cost_center_model->get_cost_center_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('cost_center_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('cost_center_add') == TRUE)
		{
			$cost_center_id = $this->cost_center_model->update($id, $data);

			if ( ! $cost_center_id) {
				$this->session->set_flashdata('failed', 'Failed to update cost_center.');
				redirect('cost_centers');
			} else {
				$this->session->set_flashdata('success', 'Cost Centers successfully updated!');
				redirect('cost_centers');
			}
		}
		$this->load_view('forms/cost_center-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_cost_center = $this->cost_center_model->get_by(['id' => $id]);
        $data['edit_cost_center'] = $edit_cost_center;

        $this->load->view('modals/modal-update-cost_center', $data);
    }

    public function update_status($id)
    {
        $cost_center_data = $this->cost_center_model->get_by(['id' => $id]);
        $data['cost_center_data'] = $cost_center_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                dump('De-activating...');
                $result = $this->cost_center_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->cost_center_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $cost_center_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('cost_centers');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$cost_center_data['name'].'!');
                redirect('cost_centers');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-cost_center-status', $data);
        }
    }
}
