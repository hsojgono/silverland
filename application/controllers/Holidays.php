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

class Holidays extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'holiday_model',
			'holiday_type_model',
			'branch_model',
			'site_model',
			'company_model'
		]);

		header("Access-Control-Allow-Methods: GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
	}

	function index()
	{
		$holidays = $this->holiday_model->get_details('get_all', '');

		$this->data = array(
			'page_header' => 'Holiday Management',
			'holidays'    => $holidays,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/holiday-lists');
	}

	function add()
	{
		$company_id = $this->ion_auth->user()->row()->company_id;
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' 	=> 'Holiday Management',
			'companies'	  	=> $companies,
			'active_menu'   => $this->active_menu,
		);

		$holidays = $this->holiday_model->get_holiday_all();
		$data     = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_add'));
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('holiday_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_holiday',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$holiday_id = $this->holiday_model->insert($data);

			if ( ! $holiday_id) {
				$this->session->set_flashdata('failed', 'Failed to add new holiday.');
				redirect('holidays');
			} else {
				$this->session->set_flashdata('success', 'Successfully added ' .$data['name']);
				redirect('holidays');
			}
		}
		$this->load_view('forms/holiday-add');
	}

	function details($id)
	{
		$holiday = $this->holiday_model->get_holiday_by(['holidays.id' => $id]);

		$this->data = array(
			'page_header' => 'Holiday Details',
			'holiday'     => $holiday,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/holiday-detail');
	}

	public function edit($id)
	{
		$holiday = $this->holiday_model->get_details('get_by',['attendance_holidays.id' => $id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$branches = $this->branch_model->get_many_by(['active_status' => 1, 'company_id' => $holiday['company_id']]);
		$sites = $this->site_model->get_many_by([
			'active_status' => 1, 
			'company_id' => $holiday['company_id'], 
			'branch_id', $holiday['branch_id']
		]);
		$holiday_types = $this->holiday_type_model->get_many_by(['active_status' => 1, 'company_id' => $holiday['company_id']]);

		$this->data = array(
			'page_header' => 'Holiday Management',
			'holiday' 	  => $holiday,
			'companies'	  => $companies,
			'branches' => $branches,
			'sites' => $sites,
			'holiday_types' => $holiday_types,
			'active_menu' => $this->active_menu,
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('holiday_add'));
		$this->form_validation->set_data($data);
		
		if ($this->form_validation->run('holiday_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 1,
			// 	'perm_key'	  => 'edit_holiday_type',
			// 	'old_data'	  => $holiday,
			// 	'new_data'	  => $data
			// ]);

			$holiday_id = $this->holiday_model->update($id, $data);

			if ( ! $holiday_id) {
				$this->session->set_flashdata('failed', 'Failed to update holiday.');
				redirect('holidays');
			} else {
				$this->session->set_flashdata('success', 'Holiday successfully updated!');
				redirect('holidays');
			}
		}
		$this->load_view('forms/holiday-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_holiday = $this->holiday_model->get_by(['id' => $id]);
        $data['edit_holiday'] = $edit_holiday;
        $this->load->view('modals/modal-update-holiday', $data);
    }

    public function update_status($id)
    {
        $holiday_data = $this->holiday_model->get_by(['id' => $id]);
        $data['holiday_data'] = $holiday_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                $result = $this->holiday_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->holiday_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $holiday_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('holidays');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$holiday_data['name'].'!');
                redirect('holidays');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-holiday-status', $data);
        }
    }

	public function populate_branch()
	{
		$company_id = $this->input->post('company_id');
		$branches = $this->branch_model->get_many_by(['company_id' => $company_id, 'active_status' => 1]);

		$select_branch = '';
		$select_branch .= '<option value=""> -- Select Branch -- </option>';

		foreach ($branches as $branch) 
		{
			$select_branch .= "<option value='" . $branch['id'] . "'>" . $branch['name'] . "</option>";
		}

		echo json_encode($select_branch);
	}

	public function populate_site()
	{
		$company_id = $this->input->post('company_id');
		$branch_id = $this->input->post('branch_id');
		$sites = $this->site_model->get_many_by(['company_id' => $company_id, 'branch_id' => $branch_id, 'active_status' => 1]);

		$select_site = '';
		$select_site .= '<option value=""> -- Select Site -- </option>';

		foreach ($sites as $site) 
		{
			$select_site .= "<option value='" . $site['id'] . "'>" . $site['name'] . "</option>";
		}
		echo json_encode($select_site);
	}

	public function populate_holiday()
	{
		$company_id = $this->input->post('company_id');
		$holiday_types = $this->holiday_type_model->get_many_by(['company_id' => $company_id]);

		$select_holidayType = '';
		$select_holidayType .= '<option value=""> -- Select Holiday Type -- </option>';

		foreach ($holiday_types as $holiday_type) 
		{
			$select_holidayType .= "<option value='" . $holiday_type['id'] . "'>" . $holiday_type['name'] . "</option>";
		}
		echo json_encode($select_holidayType);
	}
}

//HOTFIX holiday-revision-0001; 2018-03-22
