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
class Official_businesses extends MY_Controller {

    private $active_menu = 'Administration';

    /**
     * Some description here
     *
     * @param   param
     * @return  return
     */

    function __construct()
    {
        parent::__construct();
        $this->load->library([
            'audit_trail',
        ]);

        $this->load->model([
            'official_business_model',
            'account_model',
            'contact_person_model',
            'user_model',
            'employee_model',
            'employee_info_model',
            'account_contact_person_model',
            'account_contact_information_model',
            'daily_time_log_model',
            'attendance_daily_time_record_model',
            'employee_information_model'
        ]);
    }
    
    public function view_official_business()
    {
        $this->ion_auth_acl->has_permission('my_official_business');
    }

    public function index()
    {
        // todo: get all official_businesses records from database order by name ascending
            // todo: load official_business model
            // todo: load view & past the retrieved data from model
        $status = $this->uri->segment(3);
        $user   = $this->ion_auth->user()->row();

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->official_business_model->count_by(['approval_status' => 0, 'approver_id' => $user->employee_id]); 
        $total_approved  = $this->official_business_model->count_by(['approval_status' => 1, 'approver_id' => $user->employee_id]); 
        $total_pending   = $this->official_business_model->count_by(['approval_status' => 2, 'approver_id' => $user->employee_id]); 
        $total_cancelled = $this->official_business_model->count_by(['approval_status' => 3, 'approver_id' => $user->employee_id]); 

        $official_businesses = $this->official_business_model->get_ob_all();

        $my_official_business = $this->official_business_model->get_ob_requests_by([
            'attendance_official_businesses.employee_id' => $user->employee_id]);

        $approval_official_business = $this->official_business_model->get_ob_requests_by([
            'attendance_official_businesses.approver_id' => $user->employee_id]);

        $this->data = array(
            'page_header'                  => 'Official Business Management',
            'official_businesses'          => $official_businesses,
            'my_official_businesses'       => $my_official_business,
            'approval_official_businesses' => $approval_official_business,
            'total_rejected'               => $total_rejected,
            'total_approved'               => $total_approved,
            'total_pending'                => $total_pending,
            'total_cancelled'              => $total_cancelled,
            'active_menu'                  => $this->active_menu
        );

        $this->load_view('pages/attendance_official_business-lists');
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $accounts = $this->account_model->get_account_all();
        $contact_persons = $this->contact_person_model->get_contact_person_all();

        $user_id = $this->ion_auth->user()->row()->id;
        $user_data = $this->user_model->get_by(['id' => $user_id]);
        $approver_id = $this->employee_info_model->get_by(['employee_id' => $user_data['employee_id']]);

        $employee_id = $this->ion_auth->user()->row()->employee_id;
        $employee_information = $this->employee_model->get_employee_information(['employee_id' => $employee_id]);
        $employee_data = $this->employee_model->get_by(['id' => $employee_id]);

        $this->data = array(
            'page_header'     => 'Official Business Management',
            'accounts'        => $accounts,
            'contact_persons' => $contact_persons,
            'user_data'       => $user_data,
            'approver_id'     => $approver_id,
            'active_menu'     => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('ob_add'));

    

        $this->form_validation->set_data($data);
        
        if ($this->form_validation->run('ob_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'file_ob',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
                $data['date'] = date('Y-m-d', strtotime($data['date']));
            }

            if (isset($data['time_start'])) {
                $data['time_start'] = date('Y-m-d', strtotime($data['date'])) . ' ' . date('G:i', strtotime($data['time_start']));
            }

            if (isset($data['time_end'])) {
                $data['time_end'] = date('Y-m-d', strtotime($data['date'])) . ' ' . date('G:i', strtotime($data['time_end']));
            }

            if (isset($data['account_id'])) {
                $data['employee_id'] = $employee_id;
                $data['approver_id'] = $employee_information[0]['reports_to'];
            }

            $data['employee_id'] = $employee_id;
            $data['approver_id'] = $approver_id['approver_id'];
            $data['company_id'] = $user->company_id;
            $official_business_id = $this->official_business_model->insert($data);

            if ( ! $official_business_id) {
                $this->session->set_flashdata('failed', 'Failed to file an Official Business.');
                redirect('official_businesses');
            } else {

                $this->session->set_flashdata('success', 'You have successfully filed an official business.');
                redirect('official_businesses');

            }
        }
        $this->load_view('forms/attendance_official_business-add');
    }

    public function approve($ob_id)
    {
        $this->load->model('official_business_model');
        $update = $this->official_business_model->update($ob_id, ['approval_status' => 1]);

        if ($update) {

            redirect('official_businesses');


        } else {

        }
    }

    public function disapprove($ob_id)
    {
        $this->load->model('official_business_model');
        $update = $this->official_business_model->update($ob_id, ['approval_status' => 0]);

        if ($update) {

            redirect('official_businesses');


        } else {

        }
    }

    public function cancel($ob_id)
    {
        $this->load->model('official_business_model');
        $update = $this->official_business_model->update($ob_id, ['status' => 0]);

        if ($update) {

            redirect('official_businesses');
        } else {

        }
    }

    public function edit($id)
    {
        // get specific official_business based on the id
        $official_business = $this->official_business_model->get_ob_by(['attendance_official_businesses.id' => $id]);
        $account           = $this->account_model->get_account_by(['attendance_official_businesses.id' => $id]);
        $contact_person    = $this->contact_person_model->get_contact_person_by(['attendance_official_businesses.id' => $id]);

        $this->data = array(
            'page_header'       => 'Official Business Management',
            'official_business' => $official_business,
            'account'           => $account,
            'contact_person'    => $contact_person,
            'active_menu'       => $this->active_menu,
        );

        // $official_businesses = $this->official_business_model->get_ob_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('ob_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('ob_add') == TRUE)
        {
            $official_business_id = $this->official_business_model->update($id, $data);

            if ( ! $official_business_id) {
                $this->session->set_flashdata('failed', 'Failed to update official business.');
                redirect('official_businesses');
            } else {
                $this->session->set_flashdata('success', 'Official Business successfully updated!');
                redirect('official_businesses');
            }
        }
        $this->load_view('forms/attendance_official_business-edit');
    }

    public function details($id)
    {
        $official_business = $this->official_business_model->get_ob_by(['attendance_official_businesses.id' => $id]);

        $this->data = array(
            'page_header'       => 'Official Business Details',
            'official_business' => $official_business,
            'active_menu'       => $this->active_menu,
        );

        $this->load_view('pages/attendance_official_business-details');
    }

    public function view_ob($id)
    {
        $view_ob        = $this->official_business_model->get_by(['id' => $id]);
        $account_name   = $this->account_model->get_by(['id' => $view_ob['account_id']]);
        $contact_person = $this->contact_person_model->get_by(['id' => $view_ob['contact_person_id']]);

        $data = array(
            'view_ob'           => $view_ob,
            'account_name'      => $account_name,
            'contact_person'    => $contact_person,
        );

        $this->load->view('modals/modal-ob', $data);
    }

    public function approve_official_business($id)
    {
        $official_business_data = $this->official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('official_businesses');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);
        $data['modal_title']   = 'Approve Official Business';
        $data['modal_message'] = sprintf(lang('approve_official_business_message'), $requester['full_name']);
        $data['url'] = 'official_businesses/approve_official_business/' . $official_business_data['id'];
        $data['mode'] = 'approve';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {

            // $test_data = $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 2,
            //     'perm_key'    => 'approve_ob',
            //     'old_data'    => [
            //         'id'      => $official_business_data['id'],
            //         'approval_status' => $official_business_data['approval_status']
            //     ],
            //     'new_data'    => ['approval_status' => 1],
            // ]);

            $employee = $this->employee_information_model->get_by(['employee_id' => $official_business_data['employee_id']]);

            $ObToDtr = array(
                'date' => $official_business_data['date'],
                'time_in' => $official_business_data['time_start'],
                'time_out' => $official_business_data['time_end'],
                'employee_id' => $official_business_data['employee_id'],
                'reports_to' => $official_business_data['approver_id'],
                'approval_status' => 1,
                'remarks' => 'Official Business; ' . $official_business_data['date'],
                'shift_schedule_id' => $employee['shift_schedule_id'],
                'company_id' => $employee['company_id'],
                'site_id' => $employee['site_id']
            );

            $result = $this->official_business_model->update($id, ['approval_status' => 1]);
            $insertToDtr = $this->attendance_daily_time_record_model->insert($ObToDtr);

            if ($result){

                // $this->load->library('email');
                $this->session->set_flashdata('message', 'Official Business successfully approved');
                redirect('official_businesses');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to approve official business');
                redirect('official_businesses');
            }
        }
        $this->load->view('modals/modal-undertime-confirmation', $data);
    }

    public function reject_official_business($id)
    {
        $official_business_data         = $this->official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('official_businesses');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);
        $data['modal_title']   = 'Reject Official Business';
        $data['modal_message'] = sprintf(lang('reject_official_business_message'), $requester['full_name']);
        $data['url']  = 'official_businesses/reject_official_business/' . $official_business_data['id'];
        $data['mode'] = 'reject';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'reject') {

            // $test_data = $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 3,
            //     'perm_key'    => 'reject_ob',
            //     'old_data'    => [
            //         'id' => $official_business_data['id'],
            //         'approval_status' => $official_business_data['approval_status']
            //     ],
            //     'new_data'    => ['approval_status' => 0],
            // ]);

            $result = $this->official_business_model->update($id, ['approval_status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Official Business rejected');
                redirect('official_businesses');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject official business');
                redirect('official_businesses');
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }


    public function cancel_official_business($id)
    {
        $official_business_data         = $this->official_business_model->get_by(['id' => $id]);
        $data['official_business_data'] = $official_business_data;

        $employee_id = $official_business_data['employee_id'];

        if ( ! isset($employee_id) ) {
            $this->session->set_flashdata('failed', '');
            redirect('official_businesses');
        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Cancel Official Business';
        $data['modal_message'] = sprintf(lang('cancel_official_business_message'), $requester['full_name']);
        $data['url']  = 'official_businesses/cancel_official_business/' . $official_business_data['id'];
        $data['mode'] = 'cancel';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {

            // $test_data = $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 4,
            //     'perm_key'    => 'cancel_ob',
            //     'old_data'    => [
            //         'id' => $official_business_data['id'],
            //         'status' => $official_business_data['status']
            //     ],
            //     'new_data'    => ['status' => 0],
            // ]);

            $result = $this->official_business_model->update($id, ['approval_status' => 3]);

            if ($result){
                $this->session->set_flashdata('message', 'Official Business was cancelled');
                redirect('official_businesses');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to cancel official business');
                redirect('official_businesses');
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }

    public function add_client()
    {
        $post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('client_add')); // <<< TODO: this should be check if data is valid
		
		$this->form_validation->set_data($data);

		if ($this->form_validation->run('client_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'training',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$last_id = $this->account_contact_person_model->insert($post);
			
			if ($last_id) {
				$this->session->set_flashdata('success', 'Successfully added Contact Person.');
				redirect('official_businesses/add');
			} else {
				$this->session->set_flashdata('failed', 'Unable to add Contact Person.');
				redirect('official_businesses/add');
			}
		}
    }

    public function load_form()
	{
		$accounts = $this->account_model->get_all(['active_status' => 1]);

		$data = array(
			'modal_title' => 'Add Client',
			'accounts' => $accounts
		);
		
		$this->load->view('modals/modal-add-client', $data);
	}
}
