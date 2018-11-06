<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Compensation_packages extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			'incentive_model',
			'benefit_model',
            'company_model',
            'position_model',
            'salary_model',
			'compensation_package_model',
			'compensation_package_benefit_model',
			'compensation_package_incentive_model'
		]);
	}

	public function index()
	{
        $company_id            = $this->ion_auth->user()->row()->company_id;
		$compensation_packages = $this->compensation_package_model->get_details('get_all', ['cp_active_status' => 1]);

        $this->data = array(
			'page_header' => 'Compensation Packages Management',
			'compensation_packages' => $compensation_packages,
			'show_modal' => FALSE
		);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$this->data['show_modal'] = TRUE;
		}

		$this->load_view('pages/compensation_package-lists');
	}

	public function details()
	{
		$compensation_package_id = $this->uri->segment(3);
		$compensation_package = $this->compensation_package_model->get_details('get_by', ['compensation_packages.id' => $compensation_package_id]);
		$compensation_package_benefits = $this->compensation_package_benefit_model->get_details('get_by', 
			['compensation_package_benefits.compensation_package_id' => $compensation_package_id]);
		$compensation_package_incentives = $this->compensation_package_incentive_model->get_details('get_by', 
			['compensation_package_incentives.compensation_package_id' => $compensation_package_id]);

		// dump($compensation_package, 'compensation package');
		// dump($compensation_package_benefits, 'benefits');
		// dump($compensation_package_incentives, 'incentives');exit;

		$data = array(
			'modal_title'                     => 'Compensation Packages Management',
			'compensation_package'            => $compensation_package,
			'compensation_package_benefits'   => $compensation_package_benefits,
			'compensation_package_incentives' => $compensation_package_incentives
		);

		$this->load->view('pages/compensation_package-details', $data);
	}

	public function activate()
	{
		$compensation_package_id = $this->uri->segment(3);
		$compensation_package    = $this->compensation_package_model->get_details('get_by', ['compensation_packages.id' => $compensation_package_id]);
		$update = $this->compensation_package_model->update($compensation_package_id, ['active_status' => 1]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully Activated compensation package');
			redirect('compensation_packages');
		} else {
			$this->session->set_flashdata('failed', 'Unable to Activate compensation package');
			redirect('compensation_packages');
		}
	}

	public function deactivate()
	{
		$compensation_package_id = $this->uri->segment(3);
		$compensation_package    = $this->compensation_package_model->get_details('get_by', ['compensation_packages.id' => $compensation_package_id]);
		$update    = $this->compensation_package_model->update($compensation_package_id, ['active_status' => 0]);

		if ($update) {
			$this->session->set_flashdata('success', 'Successfully deactivated compensation package ');
			redirect('compensation_packages');
		} else {
			$this->session->set_flashdata('failed', 'Unable to deactivate compensation package ' . $compensation_package['monthly_compensation_package']);
			redirect('compensation_packages');
		}
	}

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$compensation_package_id = $this->uri->segment(4);
		$compensation_package    = $this->compensation_package_model->get_details('get_by', ['compensation_packages.id' => $compensation_package_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong> compensation package of " . $compensation_package['position_name']; 

		$data = array(
			'url' 			=> 'Compensation Packages/' . $mode . '/' . $compensation_package_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function load_form()
	{
        $positions = $this->position_model->get_all(['active_status' => 1]);
        $salaries  = $this->salary_model->get_all(['active_status' => 1]);
        
		$data = array(
			'modal_title' => 'Add Compensation Package',
            'positions'   => $positions,
            'salaries'    => $salaries
        );

		$this->load->view('modals/modal-add-compensation_package', $data);
	}

	public function add()
	{
		$result = array();

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('compensation_package_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('compensation_package_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_compensation_package',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$position_id = $data['position_id'];
			$salary_id = $data['salary_id'];

			$check_records = $this->compensation_package_model->get_details('get_by', [
				'compensation_packages.position_id' => $position_id, 
				'compensation_packages.salary_id' => $salary_id
			]);

			// dump($check_records);exit; 

			if ($check_records) {
				$this->session->set_flashdata('failed', 'Record already exists');
			}

			$last_id = $this->compensation_package_model->insert($post);
			$benefits = $this->benefit_model->get_many_by(['active_status' => 1]);
			$incentives = $this->incentive_model->get_many_by(['active_status' => 1]);
			
			//benefits..
			foreach ($benefits as $index => $benefit) {
				
				$data = array(
					'compensation_package_id' => $last_id,
					'benefit_id' => $benefit['id'],
					'amount' => $benefit['amount'],
					'company_id' => 1
				);

				$benefit_result = $this->compensation_package_benefit_model->insert($data);
			}

			//incentives..
			foreach ($incentives as $index => $incentive) {

				$data = array(
					'compensation_package_id' => $last_id,
					'incentive_id' => $incentive['id'],
					'amount' => $incentive['amount'],
					'company_id'   => 1
				);

				$incentive_result = $this->compensation_package_incentive_model->insert($data);
			}
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added compensation package.');
				redirect('compensation_packages');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add compensation package.');
				redirect('compensation_packages');
			}
		}
	}

	public function edit()
	{
		$compensation_package_id = $this->uri->segment(3);
		$compensation_package    = $this->compensation_package_model->get_details('get_by', ['compensation_packages.id' => $compensation_package_id]);
		$compensation_package_matrix = $this->compensation_package_matrix_model->get_by(['id' => $compensation_package['compensation_package_matrix_id']]);
		$compensation_packages = $this->compensation_package_matrix_model->get_all();
		$compensation_packages  = $this->compensation_package_model->get_details('get_many_by', ['compensation_packages.active_status' => 1]);

		$this->data = array(
			'page_header'     => 'compensation_package Management',
			'compensation_package_matrix' => $compensation_package_matrix,
			'compensation_packages' => $compensation_packages,
			
			// show modal 
			'show_modal'      => TRUE,
			'modal_title'  	  => 'Edit compensation_package',
			'modal_file_path' => 'modals/modal-edit-compensation_package',
			'compensation_package'    => $compensation_package,
			'compensation_packages'   => $compensation_packages,
			'compensation_package_id' => $compensation_package_id
		);

		$post = $this->input->post();
		$data = $post;

		if (isset($post['save'])) {

			unset($data['save']);

			$update = $this->compensation_package_model->update($compensation_package_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated compensation_package ' . $compensation_package['monthly_compensation_package']);
				redirect('compensation_packages');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update compensation_package ' . $compensation_package['monthly_compensation_package']);
				redirect('compensation_packages');
			}
		}

		 $this->load_view('pages/compensation_package-lists');
	}

	public function cancel()
	{
		redirect('compensation_packages');
	}
}

// End of file compensation_packages.php
// Location: ./application/controllers/compensation_packages.php