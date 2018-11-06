<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Employees extends MY_Controller {

	private $active_menu = 'Employee';

	function __construct()
	{
		parent::__construct();
		$this->config->load('employee', TRUE);
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->model([
			'employee_personal_information_model',
			'employee_parent_information_model',
			'employee_spouse_information_model',
			'employee_dependent_model',
			'employee_address_model',
			'employee_contact_model',
			'employee_positions_model',
			'employee_salaries_model',
			'employee_benefits_model',
			'employee_information_model',
			'employee_emergency_contact_model',
			'employee_employment_information_model',
			'civil_status_model',
			'relationship_model',
			'location_model',
			'country_model',
			'position_model',
			'compensation_package_model',
			'employee_government_id_number_model',
			'employee_educational_attainment_model',
			'employee_work_experience_model',
			'employment_type_model',
			'employee_certification_model',
			'employee_skill_model',
			'skill_model',
			'proficiency_level_model',
			'employee_training_model',
			'training_model',
			'company_model',
			'employee_award_model',
			'employee_violation_model',
			'violation_model',
			'violation_level_model',
			'violation_type_model',
			'sanction_model',
			'employee_sanction_model',
			'daily_time_record_model',
			'payroll_employee_model',
			'loan_model',
			'loan_type_model',
			'payroll_employee_model',
			'payroll_model',
		]);
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();

		if ( ! $this->ion_auth_acl->has_permission('view_employees'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('employees/informations/' . $user->employee_id);
		}

		$company_id = 1;
		$method  = ($company_id == 0) ? 'get_all' : 'get_many_by';

		$employees = $this->employee_model->get_details_empployee($method, [
			'employees.active_status' => 1,
			'employee_information.company_id' => 1,
			'employee_information.active_status' => 1
		]);

		$companies = $this->company_model->get_all();

		$this->data = array(
			'page_header' => 'Employee Management',
			// 'employees'   => $employees,
			'companies' => $companies,
			'active_menu' => $this->active_menu,
		);

		$this->load_view('pages/employee-lists'); 
	}

	public function load()
	{
		$post = $this->input->post();
		$companies = $this->company_model->get_all();

		dump($post['company_id']);exit;

		$employees = $this->employee_model->get_details_empployee('get_many_by', [
			'employees.active_status' => 1,
			'employee_information.company_id' => 2,
			'employee_information.active_status' => 1
		]);

		$this->data = array(
			'page_header' => 'Employee Management',
			'employees'  => $employees,
			'companies' => $companies, 
			'active_menu' => $this->active_menu,
		);

		$this->load_view('pages/employee-lists');
	}
	public function add()
	{
		if ( ! $this->ion_auth_acl->has_permission('add_employee'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('employees/informations/' . $user->employee_id);
		}

		$positions = $this->position_model->get_many_by(array('active_status' => 1));
		$employees = $this->employee_model->get_employee_all();
		$companies = $this->company_model->get_details('get_many_by', ['companies.active_status' => 1]);
		$post = $this->input->post();

		if (isset($post['save']) && $post['save'] === 'add') {
			if ($this->form_validation->run('add_employee') == TRUE)
			{
				$response = $this->employee_model->create_account();
				// dump($response);exit;
				$this->session->set_flashdata('message', $response['message']);
				redirect('employees/informations/' . $response['employee_id']);
			}
		}

		$this->data = array(
			'page_header' => 'Add New Employee',
			'positions' => $positions,
			'employees' => $employees,
			'companies' => $companies
		);
		$this->load_view('forms/add-employee');
	}

    public function informations($employee_id)
    {
    	$this->data['page_header'] = 'Employee Informations';

		$post = $this->input->post();
		$spouse_id = $this->session->flashdata('spouse_id');
		$this->data['spouse_id'] = $spouse_id;

		$spouse_record_many = $this->employee_spouse_information_model->get_many_by(['employee_id' => $employee_id]);
		$spouse_record_specific = $this->employee_spouse_information_model->get_by(['employee_id' => $employee_id, 'id' => $spouse_id]);
		$spouse_record = ( ! isset($spouse_id)) ? $spouse_record_many : $spouse_record_specific;

		$this->data['employee_id']            = $employee_id;
		$this->data['spouse_information']     = $spouse_record;
		$this->data['personal_information']   = $this->employee_model->get_by(['id' => $employee_id]);
		$this->data['government_id_number']   = $this->employee_government_id_number_model->get_details('get_many_by', ['employee_government_id_numbers.employee_id' => $employee_id]);
		$this->data['parents_information']    = $this->employee_parent_information_model->get_many_by(['employee_id' => $employee_id, 'relationship_id' => [2,3]]);
		$this->data['employee_dependents']    = $this->employee_dependent_model->get_details('get_many_by', ['employee_dependents.employee_id' => $employee_id]);
		$this->data['employee_adresses']	  = $this->employee_address_model->get_details('get_many_by', ['employee_addresses.employee_id' => $employee_id]);
		$this->data['employee_contacts']	  = $this->employee_contact_model->get_details('get_many_by', ['employee_contacts.employee_id' => $employee_id]);
		$this->data['employee_benefits']	  = $this->employee_benefits_model->get_details('get_many_by', ['employee_benefits.employee_id' => $employee_id]);
		$this->data['employee_positions']	  = $this->employee_positions_model->get_details('get_many_by', ['employee_positions.employee_id' => $employee_id]);
		$this->data['employee_salaries']	  = $this->employee_salaries_model->get_details('get_many_by', ['employee_salaries.employee_id' => $employee_id]);
		$this->data['emergency_contacts']	  = $this->employee_emergency_contact_model->get_details('get_many_by', ['employee_emergency_contacts.employee_id' => $employee_id]);
		$this->data['employment_information'] = $this->employee_employment_information_model->get_details('get_many_by', ['employee_information.employee_id' => $employee_id]);
		$this->data['civil_status']           = $this->civil_status_model->get_many_by(['active_status' => 1]);
		$this->data['positions']			  = $this->position_model->get_many_by(['active_status' => 1]);
		$this->data['employment_types']		  = $this->employment_type_model->get_many_by(['active_status' => 1]);
		$this->data['locations']			  = $this->location_model->get_many_by(['active_status' => 1]);		
		$this->data['companies']			  = $this->company_model->get_many_by(['active_status' => 1]);
		$this->data['skills']			  	  = $this->skill_model->get_many_by(['active_status' => 1]);
		$this->data['proficiency_levels']	  = $this->proficiency_level_model->get_many_by(['active_status' => 1]);		
		$this->data['relationships']          = $this->relationship_model->get_all();
		$this->data['education'] 			  = $this->employee_educational_attainment_model->get_details('get_by', ['employee_educational_attainments.employee_id' => $employee_id]);
		$this->data['employee_education'] 	  = $this->employee_educational_attainment_model->get_details('get_many_by', ['employee_educational_attainments.employee_id' => $employee_id]);
		$this->data['employee_work_experiences'] = $this->employee_work_experience_model->get_details('get_many_by', ['employee_work_experiences.employee_id' => $employee_id]);
		$this->data['employee_certifications']= $this->employee_certification_model->get_details('get_many_by', ['employee_certifications.employee_id' => $employee_id]);
		$this->data['employee_skills']	  	  = $this->employee_skill_model->get_details('get_many_by', ['employee_skills.employee_id' => $employee_id]);
		$this->data['companies']			  = $this->company_model->get_many_by(['active_status' => 1]);
		$this->data['trainings']			  = $this->training_model->get_all();
		$this->data['relationships']          = $this->relationship_model->get_all();
		$this->data['education'] 			  = $this->employee_educational_attainment_model->get_details('get_by', ['employee_educational_attainments.employee_id' => $employee_id]);
		$this->data['employee_education']     = $this->employee_educational_attainment_model->get_details('get_many_by', ['employee_educational_attainments.employee_id' => $employee_id]);
		$this->data['employee_trainings']	  = $this->employee_training_model->get_details('get_many_by', ['employee_trainings.employee_id' => $employee_id]);
		$this->data['employee_awards']		  = $this->employee_award_model->get_details('get_many_by', ['employee_awards.employee_id' => $employee_id]);
		$this->data['employee_violations']	  = $this->employee_violation_model->get_details('get_many_by', ['employee_violations.employee_id' => $employee_id]);		
		$this->data['violations']			  = $this->violation_model->get_many_by(['active_status' => 1]);
		$this->data['violation_levels']	 	  = $this->violation_level_model->get_many_by(['active_status' => 1]);		
		$this->data['violation_types']	 	  = $this->violation_type_model->get_many_by(['active_status' => 1]);		
		$this->data['employee_sanctions']	  = $this->employee_sanction_model->get_details('get_many_by', ['employee_sanctions.employee_id' => $employee_id]);		
		$this->data['sanctions']			  = $this->sanction_model->get_many_by(['active_status' => 1]);
		$this->data['daily_time_records'] 	  = $this->daily_time_record_model->get_details('get_many_by', ['attendance_daily_time_records.employee_id' => $employee_id]);
		$this->data['employee_payslips'] 	  = $this->payroll_employee_model->get_details('get_many_by', ['payroll_employees.employee_id' => $employee_id]);
		
		$this->data['employee_loans'] 		= $this->loan_model->get_details('get_by', ['employee_loans.employee_id' => $employee_id]);
		$this->data['employee_payslips'] 	= $this->payroll_employee_model->get_details('get_many_by', ['payroll_employees.employee_id' => $employee_id]);
	
		$this->data['employee_information'] = $this->employee_information_model->get_by([
			'employee_id'   => $employee_id,
			'active_status' => 1
		]);

		$this->data['current_position']	 = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.employee_id'   => $employee_id,
			'employee_positions.active_status' => 1
		]);

		// employee's current ids per records
		$current_position_id = $this->data['current_position']['position_id'];
		$civil_status_id 	 = $this->data['personal_information']['civil_status_id'];

		$current_civil_status = $this->civil_status_model->get_by(['id' => $civil_status_id]);
		$compensation_package = $this->compensation_package_model->get_details('get_by', [
			'compensation_packages.position_id'   => $current_position_id,
			'compensation_packages.active_status' => 1
		]);

		// get employee's active salary
		$current_salary = $this->employee_salaries_model->get_details('get_by', [
			'employee_salaries.employee_id'   => $employee_id,
			'employee_salaries.position_id'	  => $current_position_id,
			'employee_salaries.active_status' => 1
		]);

		$this->data['current_civil_status'] = $current_civil_status;
		$this->data['compensation_package'] = $compensation_package;
		$this->data['current_salary']  = $current_salary;
		$this->data['show_edit_modal'] = FALSE;

		if (isset($post['mode']))
		{
			$form = array(
				'edit' => 'modals/employee/forms/edit/modal-'.$post['information_type'],
				'add'  => 'modals/employee/forms/add/modal-'.$post['information_type'],
			);
			$explode = explode('-', $post['information_type']);
			$modal_title = $post['mode'].' '.implode(' ', $explode);

			$this->data['show_edit_modal'] = TRUE;
			$this->data['modal_content']   = $form[$post['mode']];
			$this->data['modal_title']     = ucwords($modal_title);
			// dump($this->data['modal_content']);exit;
		}

		if (isset($post['test_mode']) && $post['test_mode'] == 'test')
		{
			// file path of the modal will called
			$modal_file_path = 'modals/employee/forms/' . $post['modal_file'];

			// $this->data['message'] = 'The quick brown fox jumps over the lazy dog.';
			$this->data['message'] = '';
			$this->data['show_edit_modal'] 	= TRUE;
			$this->data['modal_content'] = $modal_file_path;
			$this->data['modal_title']	 = ucwords($post['modal_title']);
		}

		$this->load_view('pages/employee-informations');
    }

	public function test_confirm()
	{
		$redirect	 = $this->uri->segment(3);
		$employee_id = $this->uri->segment(4);

		$employee = $this->employee_model->get_by('id', $employee_id);
		$exploded = explode('_', $redirect); 
		$action   = implode(' ', $exploded);
		$confirm_message = sprintf(lang('confirmation_message'), $action, ucwords(strtolower($employee['full_name'])));

		$data = array(
			'modal_title' 	=> ucwords($action),
			'modal_message' => $confirm_message,
			'modal_file'	=> 'modal-' . implode('-', $exploded),
			'test_mode'		=> 'test',
			'url'		 	=> 'employees/informations/' . $employee_id
		);

		// dump($data);exit;

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function add_salary()
	{
		$employee_id = $this->uri->segment(3);
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function set_salary()
	{
		$employee_id = $this->uri->segment(3);
		$this->load->view('modals/modal-confirmation', $data);
	}

    public function confirmation()
    {
		$mode 		 = $this->uri->segment(3);
		$information = $this->uri->segment(4);
		$employee_id = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : NULL;

		$employee 			= $this->employee_model->get_by('id', $employee_id);
		$exploded			= explode('_', $information);
		$information_type	= implode(' ', $exploded);
		$confirm_message 	= sprintf(lang('confirmation_message'), $mode.' '.$information_type, ucwords(strtolower($employee['full_name'])));

		$this->session->set_flashdata('spouse_id', $this->uri->segment(6));

		$data = array(
			'modal_title'		=> ucwords($information_type),
			'modal_message'		=> $confirm_message,
			'mode'				=> $mode,
			'url'				=> 'employees/informations/'.$employee_id,
			'information_type'	=> implode('-', $exploded),
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function edit()
	{
		$method = $this->uri->segment(2);
		$param = array(
			'data_model'  => $this->uri->segment(3),
			'employee_id' => $this->uri->segment(4),
			'posted_data' => $this->input->post()
		);

		$this->{$param['data_model'].'_model'}->{$method}($param['employee_id'], $param['posted_data']);
	}

    public function save()
    {
		$param = array(
			'data_model'  => $this->uri->segment(3),
			'employee_id' => $this->uri->segment(4),
			'posted_data' => $this->input->post()
		);

		$this->{$param['data_model'].'_model'}->save($param['employee_id'], $param['posted_data']);
	}

	public function cancel_edit($employee_id)
	{
		redirect('employees/informations/'.$employee_id, 'refresh');
	}

	public function cancel_add($employee_id)
	{
		redirect('employees/informations/'.$employee_id, 'refresh');
	}

	public function view_employment_information($employee_information_id)
	{
		$data['employment_information'] = $this->employee_employment_information_model->get_details('get_by', [
			'employee_information.id' => $employee_information_id
		]);
		
		$this->load->view('modals/employee/details/employment-information', $data);
	}

	public function view_dependent_information($employee_dependent_id)
	{
		$data['employee_dependent'] = $this->employee_dependent_model->get_details('get_by', [
			'employee_dependents.id' => $employee_dependent_id
		]);
		$this->load->view('modals/employee/details/employee-dependent', $data);
	}

	public function view_position_information($employee_positions_id)
	{
		$data['employee_position'] = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.id' => $employee_positions_id
		]);
		$this->load->view('modals/employee/details/employee-positions', $data);
	}

	public function view_benefit_information($employee_benefits_id)
	{
		$data['employee_benefit'] = $this->employee_benefits_model->get_details('get_by', [
			'employee_benefits.id' => $employee_benefits_id
		]);
		$this->load->view('modals/employee/details/employee-benefits', $data);
	}

	public function view_salary_information($employee_salaries_id)
	{
		$$data['employee_salary'] = $this->employee_salaries_model->get_details('get_by', [
			'employee_salaries.id' => $employee_salaries_id
		]);
		$this->load->view('modals/employee/details/employee-salaries', $data);
	}

	public function view_address_information($employee_address_id)
	{
		$data['employee_address'] = $this->employee_address_model->get_details('get_by', [
			'employee_addresses.id' => $employee_address_id
		]);
		$this->load->view('modals/employee/details/employee-address', $data);
	}

	public function view_educational_background($employee_educational_bg_id)
	{
		$data['employee_educational_background'] = $this->employee_educational_attainment_model->get_details('get_by', [
			'employees.id' => $employee_educational_bg_id
		]);
		$this->load->view('modals/employee/details/employee-address', $data);
	}

	public function view_contact_information($employee_contact_id)
	{
		$data['employee_contact'] = $this->employee_contact_model->get_details('get_by', [
			'employee_contacts.id' => $employee_contact_id
		]);
		$this->load->view('modals/employee/details/employee-contact', $data);
	}

	public function view_emergency_contact($emergency_contact_id)
	{
		$data['emergency_contact'] = $this->employee_emergency_contact_model->get_details('get_by', [
			'employee_emergency_contacts.id' => $emergency_contact_id
		]);
		$this->load->view('modals/employee/details/emergency-contact', $data);
	}

	public function view_work_experience($employee_work_experience_id)
	{
		$data['employee_work_experience'] = $this->employee_work_experience_model->get_details('get_by', [
			'employee_work_experiences.id' => $employee_work_experience_id
		]);
		$this->load->view('modals/employee/details/employee-work-experience', $data);
	}

	public function save_salary_changes()
	{
		$post = $this->input->post();
		$mode = $post['mode'];

		// TODO: remove the unknown fields from the posted data
		// TODO: check if there is a active salary then deactivate it

		$result = $this->employee_salaries_model->update($post['employee_salary_id'], array(
			'monthly_salary' => $post['monthly_salary'],
			// TODO: 'modified' => date('Y-m-d H:i:s'),
			// TODO: 'modified_by' => $this->ion_auth->user()->row()->id
		));
		
		$message = array();

		if ( ! $result) {
			$message[] = '<span class="text-red">Unable to set employee salary.</span>';
		} else {
			$message[] = 'Successfully set employee salary.';
		}

		$this->session->set_flashdata('success', implode(' ', $message));
		redirect('employees/informations/' . $post['employee_id']);
	}

	public function change_designation()
	{
		$employee_id = $this->uri->segment(3);

		$post = $this->input->post();

		$current_position = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.employee_id'   => $employee_id,
			'employee_positions.active_status' => 1
		]);

		$current_salary = $this->employee_salaries_model->get_details('get_by', [
			'employee_salaries.employee_id'   => $employee_id,
			'employee_salaries.position_id'   => $current_position['position_id'],
			'employee_salaries.active_status' => 1
		]);

		$positions = $this->position_model->get_many_by(['active_status' => 1]);

		if (isset($post['save']) && $post['save'] == 'true') {

			// update current or previous position status set to inactive
			$update_previous_position = $this->employee_positions_model->update($current_position['employee_positions_id'], [
				'active_status' => 0,
				'date_ended'	=> date('Y-m-d H:i:s')
			]);

			$message[] = ( ! $update_previous_position) ? 'UNABLE TO DEACTIVATE PREVIOUS EMPLOYEE POSITION.' : 'SUCCESSFULLY DEACTIVATED PREVIOUS EMPLOYEE POSITION.';

			$insert_data = array(
				// TODO: 'company_id' 	  => $employee_information['company_id'],
				// TODO: 'branch_id' 	  => $employee_information['branch_id'],
				// TODO: 'department_id'  => $employee_information['department_id'],
				// TODO: 'team_id' 		  => $employee_information['team_id'],
				// TODO: 'cost_center_id' => $employee_information['cost_center_id'],
				// TODO: 'site_id' 		  => $employee_information['site_id'],
				'employee_id' 	=> $post['employee_id'],
				'position_id' 	=> $post['position_id'],
				'date_started'	=> $post['date_started'],
				'remarks'		=> $post['remarks'],
				'created'		=> date('Y-m-d H:i:s'),
				'created_by'	=> $this->ion_auth->user()->row()->id,
				'active_status' => 1
			);

			$last_id = $this->employee_positions_model->insert($insert_data);

			$message[] = ( ! $last_id) ? 'UNABLE TO ASSIGN NEW POSITION.' : 'SUCCESSFULLY ASSIGN EMPLOYEE POSITION.';

			$test_data = array(
				// TODO: 'company_id' => '',
				// TODO: 'salary_matrix_id' => '',
				// TODO: 'salary_grade_id'  => '',
				'employee_id' 	 => $post['employee_id'],
				'position_id'    => $post['position_id'],
				'monthly_salary' => $post['test_salary'],
				'created'        => date('Y-m-d H:i:s'),
				'created_by' 	 => $this->ion_auth->user()->row()->id
			);

			$employee_salary_id = $this->employee_salaries_model->insert($test_data);

			if ($current_salary) {
				$updated_employee_salary = $this->employee_salaries_model->update($current_salary['employee_salaries_id'], array(
					'active_status' => 0
				));

				$message[] = $updated_employee_salary ? 'SUCCESS UPDATED EMPLOYEE SALARY' : 'UNABLE TO UPDATE EMPLOYEE SALARY';
			}

			$this->session->set_flashdata('success', strtoupper(implode(' ', $message)));
			redirect('employees/informations/' . $employee_id);
		}

		$this->data = array(
			'page_header' => 'Employee Position',
			'employee_id' => $employee_id,
			'positions'   => $positions,
			'current_position' => $current_position,
			'hidden_elements' => array(
				array('name' => 'employee_id', 'value' => $employee_id),
				array('name' => 'save', 'value' => 'true')
			)
		);

		$this->load_view('forms/update-employee-position');
	}

	// AJAX calls
	public function check_employee_compensation_package()
	{
		$this->load->model(array(
			'compensation_package_model',
			'position_model'
		));

		$data = array();
		$message = array();

		$post = $this->input->post();

		$employee_id = $post['employee_id'];

		$employee_information = $this->employee_information_model->get_by([
			'employee_id'   => $employee_id,
			'active_status' => 1
		]);

		$data['employee_information'] = $employee_information;

		// if ($employee_information == NULL) {
		// 	$message[] = 'Employee Information is NOT been set. Please try again.';
		// 	$this->session->set_flashdata('error', implode(' ', $message));
		// 	redirect('employees/informations/' . $employee_id);
		// }

		$new_position = $this->position_model->get_by(array('id' => $post['position_id']));
		
		// get employee current position
		$current_position = $this->employee_positions_model->get_details('get_by', [
			'employee_positions.employee_id'   => $employee_id,
			'employee_positions.active_status' => 1
		]);
		$current_position_id = $current_position['position_id'];

		$compensation_package = $this->compensation_package_model->get_compensation_package_history($current_position_id, $new_position['id']);
		
		$data['position']['compensation']['old'] = $compensation_package['for_old_position'];
		$data['position']['compensation']['new'] = $compensation_package['for_new_position'];

		$old_monthly_salary = $compensation_package['for_old_position']['monthly_salary'];
		$new_monthly_salary = $compensation_package['for_new_position']['monthly_salary'];

		$greater_than_current_salary = $new_monthly_salary > $old_monthly_salary;
		$less_than_current_salary    = $new_monthly_salary < $old_monthly_salary;

		$data['confirmation_message'] = $greater_than_current_salary || $less_than_current_salary ? TRUE : FALSE;
		
		$message[] = $greater_than_current_salary ? sprintf(lang('greater_than_current_salary_message'), $new_monthly_salary, $old_monthly_salary) : '';
		$message[] = $less_than_current_salary ? sprintf(lang('less_than_current_salary_message'), $new_monthly_salary, $old_monthly_salary):'';

		$data['message'] = ucwords(implode('', $message));

		echo json_encode($data);
	}

	// AJAX calls
	public function position_compensation_package()
	{
		$this->load->model(array(
			'position_model',
			'compensation_package_model',
			'compensation_package_benefits_model'
		));

		$data 	 = array();
		$message = array();

		$post = $this->input->post();

		$compensation_package_details = $this->compensation_package_model->get_by(array(
			'position_id' => $post['position_id']
		));

		$compensation_package_id = $compensation_package_details['id'];

		$salary = $this->compensation_package_model->get_with_salary('get_by', array(
			'compensation_packages.position_id' => $post['position_id']
		));

		$message[] = ( ! $salary) ? 'No salary found on the position you selected.' : '';
		
		$benefits = $this->compensation_package_benefits_model->get_with_benefit_details('get_many_by', array(
			'compensation_package_benefits.compensation_package_id' => $compensation_package_id
		));

		$message[] = (count($benefits) < 1) ? 'No benefits found on the position you selected.' : '';

		$data['compensation_package'] = array(
			'salary'   => $salary,
			'benefits' => $benefits
		);

		$data['message'] = ucwords(implode('', $message));

		echo json_encode($data);
	}

	public function add_employee_parent()
	{
		$employee_id = $this->uri->segment(3);

		$this->load->model('relationship_model');

		// get relationships only where father mother
		$relationships = $this->relationship_model->get_many_by(array('id' => array(2,3)));

		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_parents_information');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			// insert new record to table
			$parent_id = $this->employee_parent_information_model->insert($new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE

			$message[] = ($parent_id) ? 'Successfully added new parent to employee.' : 'Unable to add parent to employee.';
			$status = ($parent_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;
		$data['relationships'] = $relationships;
		$this->load->view('modals/modal-add-employee-parent', $data);
	}

	public function add_employee_educational_background()
	{
		$employee_id = $this->uri->segment(3);
		
		$this->load->model([
			'employee_educational_attainment_model',
			'educational_attainment_model',
			'education_course_model'
		]);

		$educational_attainments = $this->educational_attainment_model->get_all();
		$educational_background = $this->employee_educational_attainment_model->get_details('get_many_by', ['employees.id' => $employee_id]);
		$courses = $this->education_course_model->get_details('get_many_by', ['education_courses.active_status' => 1]);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_educational_background_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			// insert new record to table
			$education_id = $this->employee_educational_attainment_model->insert($new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE

			$message[] = ($education_id) ? 'Successfully added educational attainment.' : 'Unable to add educational attainment.';
			$status = ($education_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;
		$data['educational_attainments'] = $educational_attainments;
		$this->load->view('modals/modal-add-employee-parent', $data);
	}

	public function add_employee_certification($employee_id)
	{
			$employee_id = $this->uri->segment(3);

			// dump($employee_id);exit;
		
		$this->load->model([
			'employee_certification_model',
			'company_model'
		]);

		$employee_certifications = $this->employee_certification_model->get_all();

		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_certifications_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;
			// dump($new_data);exit;

			// insert new record to table
			$employee_certification_id = $this->employee_certification_model->insert($new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE

			$message[] = ($employee_certification_id) ? 'Successfully added certification.' : 'Unable to add certification.';
			$status = ($employee_certification_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;
		$data['employee_certifications'] = $employee_certifications;
		$this->load->view('modals/modal-add-employee-parent', $data);
	}

	public function add_employee_skill($employee_id)
	{
		$employee_id = $this->uri->segment(3);

		// dump($employee_id);exit;
		
		$this->load->model([
			'employee_skill_model',
			'skill_model',
			'proficiency_level_model',
			'company_model'
		]);

		$employee_skills = $this->employee_skill_model->get_all();
		$skills = $this->skill_model->get_many_by(['active_status' => 1]);
		$proficiency_levels = $this->proficiency_level_model->get_many_by(['active_status' => 1]);

		
		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_skills_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;

			// dump($new_data);exit;

			// insert new record to table
			$employee_skill_id = $this->employee_skill_model->insert($new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE

			$message[] = ($employee_skill_id) ? 'Successfully added skill.' : 'Unable to add skill.';
			$status = ($employee_skill_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;
		$data['employee_skills'] = $employee_skills;
		$data['skills'] = $skills;
		$data['proficiency_levels'] = $proficiency_levels;
		$this->load->view('modals/modal-add-employee-parent', $data);
	}

	public function add_employee_training($employee_id)
	{
		$employee_id = $this->uri->segment(3);
			 
		$this->load->model([
			'employee_training_model',
			'training_model'
		]);

		$employee_trainings = $this->employee_training_model->get_all();
		$trainings = $this->training_model->get_all();

		
		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_trainings_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;

			// insert new record to table
			$employee_training_id = $this->employee_training_model->insert($new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE

			$message[] = ($employee_training_id) ? 'Successfully added training.' : 'Unable to add training.';
			$status = ($employee_training_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;
		$data['employee_trainings'] = $employee_trainings;
		$data['trainings'] = $trainings;

		$this->load->view('modals/modal-add-training', $data);
	}

	public function update_employee_training($employee_skill_id)
	{
		$employee_skill_id = $this->uri->segment(3);
		$employee_skills = $this->employee_skill_model->get_all();
		$employee_skill = $this->employee_skill_model->get_by(['employee.id' => $employee_skill_id]);

		$this->data = array(
			'page_header'     => 'Employee Skills Management',
			'employee_skill'           => $employee_skill,
			'employee_skills'          => $employee_skills,
			'employee_skill_id'        => $employee_skill_id,
			'show_modal'      => TRUE,
			'modal_title'     => 'Update Employee Skill',
			'modal_file_path' => 'modals/edit/modal-employee-skills',
		);

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('employee_skill_edit'));

		if (isset($post['save'])) {
			$update = $this->skemployee_skill_model->update($employee_skill_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated ' . $employee_skill['skill_name']);
			redirect('employees/informations/' . $employee_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update ' . $employee_skill['skill_name']);
			redirect('employees/informations/' . $employee_id);
			}
		}
		$this->load_view('employees/informations/' . $employee_id);
	}

	public function test_confirmation()
	{
		$method = $this->uri->segment(3);
		$param  = $this->uri->segment(4);

		$employee = $this->employee_model->get_by('id', $employee_id);
		$exploded = explode('_', $information);
		$information_type = implode(' ', $exploded);
		$confirm_message = sprintf(lang('confirmation_message'), $mode . ' ' . $information_type, ucwords(strtolower($employee['full_name'])));

		$this->session->set_flashdata('spouse_id', $this->uri->segment(6));

		$data = array(
			'modal_title' => ucwords($information_type),
			'modal_message' => $confirm_message,
			'mode' => $mode,
			'url' => 'employees/informations/' . $employee_id,
			'information_type' => implode('-', $exploded),
		);

		$this->load->view('modals/modal-confirmation', $data);
	}

	public function edit_employee_parent()
	{
		$parent_id = $this->uri->segment(3);
		$this->load->model('relationship_model');

		$parent_record = $this->employee_parent_information_model->get_by(array('id' => $parent_id));

		// get relationships only where father mother
		$relationships = $this->relationship_model->get_many_by(array('id' => array(2, 3)));

		$post = $this->input->post();

		if (isset($post['mode'])) {

			$employee_id = $post['employee_id'];
			$parent_id   = $post['parent_id'];

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_parents_information');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			// insert new record to table
			$updated = $this->employee_parent_information_model->update($parent_id, $new_data);

			// TODO: CHECK IF THERE'S AN EXISTING PARENT IF THEN RETURN FALSE
			

			$message[] = ($updated) ? 'Successfully updated parent record of employee.' : 'Unable to update parent record of employee.';
			$status = ($updated) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $parent_record['employee_id'];
		$data['relationships'] = $relationships;
		$data['parent_record'] = $parent_record;

		$this->load->view('modals/modal-edit-employee-parent', $data);
	}

	public function rest_api($function = '')
	{
		switch ($function) {
			case 'get-parent-information':
				$parent_id = $this->uri->segment(4);
				$this->load->model('employee_parent_information_model');
				$parent = $this->employee_parent_information_model->get_by(array('id' => $parent_id));
				$response['data'] = $parent;
				print json_encode($response);
			break;
			
			default:
				# code...
				break;
		}
	}

	public function do_upload()
	{
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = 0;
		// $config['max_width']     = 1024;
		// $config['max_height']    = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_form', $error);
		}
		else
		{
				$data = array('upload_data' => $this->upload->data());

				$this->load->view('upload_success', $data);
		}
	}
	// public function edit_employee_work_experience($employee_work_experience_id)
	// {
	// 	$employee_work_experience_id = $this->uri->segment(3);
	// 	dump($employee_work_experience_id);exit;
	// 	$this->load->model('employment_type_model');

	// 	$employee_work_experiences = $this->employee_work_experience_model->get_employee_work_experience(['employee_work_experiences.id' => $employee_work_experience_id]);
	// 	dump($employee_work_experiences);exit;
	// 	$post = $this->input->post();

	// 	if (isset($post['mode'])) {

	// 		$employee_id = $post['employee_id'];
	// 		$employee_work_experience_id   = $post['employee_work_experience_id'];

	// 		// get expected fields to be inserted
	// 		$expected_fields = $this->form_validation->get_field_names('employee_work_experience_edit');

	// 		// remove unknown fields from input data
	// 		$new_data = remove_unknown_field($post, $expected_fields);
	// 		$new_data['employee_id'] = $employee_id;
	// 		// insert new record to table
	// 		$updated = $this->employee_work_experience_model->update($employee_work_experience_id, $new_data);
		
	// 		$message[] = ($updated) ? 'Successfully updated work experience of employee.' : 'Unable to update work experience of employee.';
	// 		$status = ($updated) ? 'success' : 'error';

	// 		$this->session->set_flashdata($status, implode('. ', $message));
	// 		redirect('employees/informations/' . $employee_id);
	// 	}

	// 	$data['employee_id'] = $employee_work_experience['employee_id'];
	// 	$data['employee_work_experiences'] = $employee_work_experiences;
	// 	// dump($data);exit;

	// 	$this->load->view('modals/modal-work-experience', $data);
	// 	redirect('employees/informations/' . $employee_id);
	// }

	public function add_employee_work_experience($employee_id)
	{
			$employee_id = $this->uri->segment(3);

			$this->load->model([
				'employee_work_experience_model',
				'employment_type_model'
			]);

			$employee_work_experiences = $this->employee_work_experience_model->get_all();
			$employment_types		  = $this->employment_type_model->get_many_by(['active_status' => 1]);	

			$post = $this->input->post();

			if (isset($post['mode'])) {
				// get expected fields to be inserted
				$expected_fields = $this->form_validation->get_field_names('employee_work_experiences_add');
			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);
				$new_data['employee_id'] = $employee_id;

				// insert new record to table
				$employee_work_experience_id = $this->employee_work_experience_model->insert($new_data);

				$message[] = ($employee_work_experience_id) ? 'Successfully added work experience.' : 'Unable to add work experience.';
				$status = ($employee_work_experience_id) ? 'success' : 'error';

				$this->session->set_flashdata($status, implode('. ', $message));
				redirect('employees/informations/' . $employee_id);
			}

		$data['employee_id'] = $employee_id;
		$data['employee_work_experiences'] = $employee_work_experiences;
		$data['employee_work_experience'] = $employee_work_experience;
		$data['employment_types'] = $employment_types;

		$this->load->view('modals/modal-add-employee-parent', $data);
	}
	
	public function add_employee_award($employee_id)
	{
		$employee_id = $this->uri->segment(3);

		$this->load->model([
			'employee_award_model',
			'company_model'

		]);

		$employee_awards = $this->employee_award_model->get_all();

		
		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted

			$expected_fields = $this->form_validation->get_field_names('employee_awards_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;

			// insert new record to table
			$employee_award_id = $this->employee_award_model->insert($new_data);

			$message[] = ($employee_award_id) ? 'Successfully added award.' : 'Unable to add award.';
			$status = ($employee_award_id) ? 'success' : 'error';


			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_id'] = $employee_id;

		$data['employee_awards'] = $employee_awards;
		$data['awards'] = $awards;
		$this->load->view('modals/modal-add-employee-parent', $data);
	}

	public function add_employee_violation($employee_id)
	{
		$employee_id = $this->uri->segment(3);

		$this->load->model([
			'employee_violation_model',
			'violation_model',
			'violation_level_model',
			'violation_type_model'

		]);

		$employee_violations = $this->employee_violation_model->get_all();
		$violations = $this->violation_model->get_many_by(['active_status' => 1]);
		$violation_levels = $this->violation_level_model->get_many_by(['active_status' => 1]);
		$violation_types = $this->violation_type_model->get_many_by(['active_status' => 1]);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {
			$expected_fields = $this->form_validation->get_field_names('employee_violations_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;

			// insert new record to table
			$employee_violation_id = $this->employee_violation_model->insert($new_data);

			$message[] = ($employee_violation_id) ? 'Successfully added violation.' : 'Unable to add violation.';
			$status = ($employee_violation_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);

		}

		$data['employee_violations'] = $employee_violations;
		$data['violations'] = $violations;
		$data['violation_types'] = $violation_types;
		$data['violation_levels'] = $violation_levels;

		$this->load->view('modals/modal-add-employee-parent', $data);
	}


	public function add_employee_sanction($employee_id)
	{
		$employee_id = $this->uri->segment(3);
		
		$this->load->model([
			'employee_sanction_model',
			'sanction_model',

		]);

		$employee_sanctions = $this->employee_sanction_model->get_all();
		$sanctions = $this->sanction_model->get_many_by(['active_status' => 1]);

		$post = $this->input->post();
		
		if (isset($post['mode'])) {

			// get expected fields to be inserted
			$expected_fields = $this->form_validation->get_field_names('employee_sanctions_add');

			// remove unknown fields from input data
			$new_data = remove_unknown_field($post, $expected_fields);

			$new_data['employee_id'] = $employee_id;

			// insert new record to table
			$employee_sanction_id = $this->employee_sanction_model->insert($new_data);

			$message[] = ($employee_sanction_id) ? 'Successfully added sanction.' : 'Unable to add sanction.';
			$status = ($employee_sanction_id) ? 'success' : 'error';

			$this->session->set_flashdata($status, implode('. ', $message));
			redirect('employees/informations/' . $employee_id);
		}

		$data['employee_sanctions'] = $employee_sanctions;
		$data['sanctions'] = $sanctions;

		$this->load->view('modals/modal-add-employee-parent', $data);
	}
		
	public function edit_employee_work_experience($employee_id)
	{
		$employee_work_experience_id = $this->uri->segment(3);
		$employee_work_experience = $this->employee_work_experience_model->get_details('get_by', ['employee_work_experiences.id' => $employee_work_experience_id]);
		$employment_types = $this->employment_type_model->get_many_by(['active_status' => 1]);	

		$data = array(
			'show_modal' => TRUE,
			'employee_work_experience' => $employee_work_experience,
			'employee_work_experience_id' => $employee_work_experience_id,
			'employment_types' => $employment_types
		);

		$post = $this->input->post();

		if (isset($post['save'])) {

			unset($post['save']);

			$update = $this->employee_work_experience_model->update($employee_work_experience_id, $post);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated work experience ');
				redirect('employees/informations/' . $employee_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update work experience ');
				redirect('employees/informations/' . $employee_id);
			}
		}
		$this->load->view('modals/employee/forms/edit/modal-work-experience', $data);
	}
	public function edit_employee_work_experience_confirmation()
	{
		$work_experience_id = $this->uri->segment(3);
		$work_experience = $this->employee_work_experience_model->get_details('get_by', ['employee_work_experiences.id' => $work_experience_id]);

		$modal_title = 'Update Work Experience';

		$data = array([
			'work_experience' => $work_experience,
			'modal_title' => $modal_title
		]);

		// $mode = $this->uri->segment(3);
		// $employee_work_experience_id = $this->uri->segment(4);
		// $employee_work_experience    = $this->employee_work_experience_model->get_details('get_by', ['employee_work_experiences.id' => $employee_work_experience_id]);

		// $modal_message = "You're about to <strong>" . $mode . "</strong> work experience " . $employee_work_experience['company_name']; 

		

		$this->load->view('modals/modal-edit-work-experience', $data);
	}

	public function edit_confirmation()
	{
		$this->load->view('modals/modal-confirmation', $data);
	}

	public function edit_employee_training($employee_id)
	{
		$training_id = $this->uri->segment(3);
		$training = $this->employee_training_model->get_details('get_by', ['employee_trainings.id' => $training_id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);
		$trainings = $this->training_model->get_all();

		$data = array(
			'show_modal' => TRUE,
			'training' => $training,
			'training_id' => $training_id,
			'companies' => $companies,
			'trainings' => $trainings,
		);

		$post = $this->input->post();

		if (isset($post['save'])) {

			unset($post['save']);

			$update = $this->employee_training_model->update($training_id, $post);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated training ');
				redirect('employees/informations/' . $employee_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update work training ');
				redirect('employees/informations/' . $employee_id);
			}
		}
		$this->load->view('modals/employee/forms/edit/modal-training', $data);
	}

	public function edit_employee_certifications($employee_id)
	{
		$employee_certification_id = $this->uri->segment(3);
		$certification = $this->employee_certification_model->get_details('get_by', ['employee_certifications.id' => $employee_certification_id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		// dump($certification);exit;
		$data = array(
			'show_modal' => TRUE,
			'certification' => $certification,
			'employee_certification_id' => $employee_certification_id,
			'companies' => $companies
		);

		$post = $this->input->post();

		if (isset($post['save'])) {

			unset($post['save']);

			$update = $this->employee_certification_model->update($employee_certification_id, $post);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated certification ');
				redirect('employees/informations/' . $employee_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update certification ');
				redirect('employees/informations/' . $employee_id);
			}
		}	
		$this->load->view('modals/employee/forms/edit/modal-certification', $data);
	}

	public function edit_employee_awards($employee_id)
	{
		$award_id = $this->uri->segment(3);
		$award = $this->employee_award_model->get_details('get_by', ['employee_awards.id' => $award_id]);
		$companies = $this->company_model->get_many_by(['active_status' => 1]);

		$data = array(
			'show_modal' => TRUE,
			'award' => $award,
			'award_id' => $award_id,
			'companies' => $companies
		);

		$post = $this->input->post();

		if (isset($post['save'])) {

			unset($post['save']);

			$update = $this->employee_award_model->update($award_id, $post);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated award ');
				redirect('employees/informations/' . $employee_id);
			} else {
				$this->session->set_flashdata('failed', 'Unable to update award ');
				redirect('employees/informations/' . $employee_id);
			}
		}
		$this->load->view('modals/employee/forms/edit/modal-award', $data);
	}
	public function view_daily_time_record($employee_dtr_id)
	{
		$data['daily_time_records'] = $this->daily_time_record_model->get_details('get_by', [
			'attendance_daily_time_records.id' => $employee_dtr_id
		]);
		
		$this->load->view('modals/employee/details/employee-daily-time-records', $data);
	}

}
