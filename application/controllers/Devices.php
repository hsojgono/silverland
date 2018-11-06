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
class Devices extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model(['device_model']);
	}

	function index()
	{
		$devices = $this->device_model->get_details('get_many_by', ['devices.active_status' => 1]);

		$this->data = array(
			'page_header' => 'Devices Management',
			'devices'     => $devices,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/device-lists');
	}

	function add()
	{
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$sites     = $this->site_model->get_many_by(['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Devices Management',
			'companies'	  => $companies,
			'sites'	  	  => $sites,
			'active_menu' => $this->active_menu,
		);

		$devices = $this->device_model->get_details('get_all', ['devices.active_status' => 1]);
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('device_add'));
		// dump($data);exit;
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('device_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_device',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$device_id = $this->device_model->insert($data);

			if ( ! $device_id) {
				$this->session->set_flashdata('failed', 'Failed to add new device.');
				redirect('devices');
			} else {
				$this->session->set_flashdata('success', 'Successfully added new device.');
				redirect('devices');
			}
		}
		$this->load_view('forms/device-add');
	}

	function details($id)
	{
		$device 		= $this->device_model->get_device_by(['devices.id' => $id]);
		$site 			= $this->site_model->get_many_site_by(['sites.device_id' => $id]);
		$sites 			= $this->site_model->get_many_site_by(['sites.device_id' => $id]);
		$employee_infos = $this->employee_info_model->get_employee_info_data(['departments.id' => $id]);

		$this->data = array(
			'page_header'    => 'Devices Details',
			'device'         => $device,
			'sites' 		 => $site,
			'sites' 		 => $sites,
			'employee_infos' => $employee_infos,
			'active_menu' 	 => $this->active_menu,
		);
		$this->load_view('pages/device-detail');
	}

	function edit($id)
	{
		// get specific device based on the id
		$device = $this->device_model->get_device_by(['devices.id' => $id]);
		// get all company records where status is equal to active
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		if ( ! $this->ion_auth_acl->has_permission('edit_device'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
		}

        $device_data = $this->device_model->get_device_by(['devices.id' => $id]);

		$this->data = array(
			'page_header' => 'Devices Management',
			'device' 	  => $device,
			'device_data' => $device_data,
			'companies'	  => $companies,
			'active_menu' => $this->active_menu,
		);

		$devices = $this->device_model->get_device_all();
		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('device_edit'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('device_edit') == TRUE)
		{
			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 1,
				'perm_key'    => 'edit_device',
				'old_data'    => $device_data,
				'new_data'    => $data
			]);

			$device_id = $this->device_model->update($id, $data);

			if ( ! $device_id) {
				$this->session->set_flashdata('failed', 'Failed to update device.');
				redirect('devices');
			} else {
				$this->session->set_flashdata('success', 'Devices successfully updated!');
				redirect('devices');
			}
		}
		$this->load_view('forms/device-edit');
	}

    public function edit_confirmation($id)
    {
        $edit_device = $this->device_model->get_by(['id' => $id]);
        $data['edit_device'] = $edit_device;

        $this->load->view('modals/modal-update-device', $data);
    }

    public function update_status($id)
    {
        $device_data = $this->device_model->get_by(['id' => $id]);
        $data['device_data'] = $device_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
				$old_data = 1;
				$new_data = 0;
                $result = $this->device_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
				$old_data = 0;
				$new_data = 1;
                $result = $this->device_model->update($id, ['active_status' => 1]);
            }

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 6,
				'perm_key'    => 'update_device_status',
				'old_data'    => $old_data,
				'new_data'    => $new_data
			]);

            if ($result)
            {
                 $this->session->set_flashdata('message', $device_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('devices');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$device_data['name'].'!');
                redirect('devices');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-device-status', $data);
        }
    }
}
