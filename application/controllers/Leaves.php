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
class Leaves extends MY_Controller {

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
        $this->load->library('audit_trail');
        $this->load->model([
            'leave_model',
            'leave_type_model',
            'user_model',
            'employee_information_model',
            'employee_leave_credit_model',
            'attendance_daily_time_record_model',
            'shift_schedule_model'
        ]);
    }

    public function index()
    {
        // todo: get all leaves records from database order by name ascending
            // todo: load leave model
            // todo: load view & past the retrieved data from model

        $status = $this->uri->segment(3);
        $user = $this->ion_auth->user()->row();

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->leave_model->count_by(['approval_status' => 0, 'approver_id' => $user->employee_id]); 
        $total_approved  = $this->leave_model->count_by(['approval_status' => 1, 'approver_id' => $user->employee_id]); 
        $total_pending   = $this->leave_model->count_by(['approval_status' => 2, 'approver_id' => $user->employee_id]); 
        $total_cancelled = $this->leave_model->count_by(['approval_status' => 3, 'approver_id' => $user->employee_id]);          

        $leave_requests  = $this->leave_model->get_leave_requests(['attendance_leaves.approver_id' => $user->employee_id]);
        $my_leaves       = $this->leave_model->get_leave_requests(['attendance_leaves.employee_id' => $user->employee_id]);
        $leave_balances  = $this->employee_leave_credit_model->get_leave_credits_by(['
            employee_leave_credits.employee_id' => $user->employee_id,
            'attendance_leave_types.company_id' => $user->company_id
        ]);

        $this->data = array(
            'page_header'     => 'Leave Management',
            'leave_requests'  => $leave_requests,
            'my_leaves'       => $my_leaves,
            'leave_balances'  => $leave_balances,
            'total_rejected'  => $total_rejected,
            'total_approved'  => $total_approved,
            'total_pending'   => $total_pending,
            'total_cancelled' => $total_cancelled,
            'active_menu'     => $this->active_menu,
        );
        $this->load_view('pages/attendance_leave-lists');
    }

    public function add()
    {
        $employee_id = $this->ion_auth->user()->row()->employee_id;
        $user   = $this->ion_auth->user()->row();       

        $leave_types = $this->leave_type_model->get_leaves('get_many_by', [
            'active_status' => 1,
            'company_id' => $user->company_id
        ]);

        $employee_information = $this->employee_information_model->get_details('get_by', ['employee_information.employee_id' => $employee_id]);
        $employee_data = $this->employee_model->get_by(['id' => $employee_id]);

        $without_pay = FALSE;

        if (count($leave_types) < 1) {
            $leave_types = $this->leave_type_model->get_all();
            $without_pay = TRUE;
        }

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));

        if (isset($data['date_start']) && isset($data['date_end'])) {

            $data['date_start'] = date('Y-m-d', strtotime($data['date_start']));
            $data['date_end']   = date('Y-m-d', strtotime($data['date_end']));
        }

        if (isset($data['attendance_leave_type_id']))
        {
            $data['employee_id'] = $employee_id;
            $data['approver_id'] = $employee_information['reports_to'];
        }

        $isset_radio = FALSE;

        if (isset($data['payment_status']) && $data['payment_status'] == 1) {
            $isset_radio = TRUE;
        }

        $leave_balances  = $this->employee_leave_credit_model->get_leave_credits_by([
            'employee_leave_credits.employee_id' => $employee_id,
            'attendance_leave_types.company_id' => $user->company_id
        ]);

        $this->data = array(
            'page_header' => 'Leave Management',
            'leave_types' => $leave_types,
            'without_pay' => $without_pay,
            'isset_radio' => $isset_radio,
            'leave_balances' => $leave_balances,
            'active_menu' => $this->active_menu,
        );

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'file_leave',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);
            $leave_id = $this->leave_model->insert($data);

            if ( ! $leave_id)
            {
                $this->session->set_flashdata('failed', 'Failed to file new leave.');
                redirect('leaves');
            }
            else
            {
                $this->session->set_flashdata('success', 'Successfully filed a leave.');
                redirect('leaves');
            }
        }

        $this->load_view('forms/attendance_leave-add');
    }

    public function approve($attendance_leave_id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $attendance_leave_id]);
        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'employee_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;

        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);

        //Calculate days filed of Leave...
        $updated_balance  = calculate_leave_balance($leave_balance, $total_days_filed);


       if ($updated_balance != 0) {

            $employee_leave_credits_id = $leave_types[0]['elc_id'];

            $this->session->set_flashdata('old_data', $attendance_leave);

            $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, [
                'attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id'],
                'balance' => $updated_balance
            ]);

            $update_approval_status = $this->leave_model->update($attendance_leave_id, ['approval_status' => 1]);

            $this->session->set_flashdata('success', 'You have successfully approved the filed leave.');
            redirect('leaves');

        } else {

            $update_approval_status = $this->leave_model->update($attendance_leave_id, ['payment_status' => 0]);

            if ($update_approval_status) {

                redirect('leaves');
                

            } else {

            }
        }
    }

    public function disapprove($leave_id)
    {
         
    }

    public function edit($id)
    {
        // get specific leave based on the id
        $leave = $this->leave_model->get_leave_by(['attendance_leaves.id' => $id]);

        $this->data = array(
            'page_header' => 'Leave Management',
            'leave' => $leave,
            'active_menu' => $this->active_menu,
        );

        // $leaves = $this->leave_model->get_leave_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('leave_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('leave_add') == TRUE)
        {
            $leave_id = $this->leave_model->update($id, $data);

            if ( ! $leave_id) {
                $this->session->set_flashdata('failed', 'Failed to update leave.');
                redirect('leaves');
            } else {
                $this->session->set_flashdata('success', 'Leave successfully updated!');
                redirect('leaves');
            }
        }
        $this->load_view('forms/attendance_leave-edit');
    }

    public function details($id)
    {
        $leave = $this->leave_model->get_leave_by(['attendance_leaves.id' => $id]);

        $this->data = array(
            'page_header' => 'Leave Details',
            'leave'       => $leave,
            'active_menu' => $this->active_menu,
        );

        $this->load_view('pages/attendance_leave-details');
    }

    public function approve_leave($id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $id]);
        $withpay = $attendance_leave['payment_status'];

        $leave_types = $this->employee_leave_credit_model->get_leave_balance('get_by', [
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'employee_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types['elc_balance'];
        $updated_balance = 0;
        
        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);  //Number of days filed...
        $updated_balance  = calculate_leave_balance($leave_balance, $total_days_filed);  
            
        $requester = $this->employee_model->get_by(['id' => $attendance_leave['employee_id']]);
        $data['modal_title']    = 'Approve Leave';
        $data['modal_message']  = sprintf(lang('approve_leave_message'), $requester['full_name']);
        $data['url'] = 'leaves/approve_leave/' . $id;
        $data['mode'] = 'approve';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            if ($updated_balance != 0) {

                $employee_leave_credits_id = $leave_types['elc_id'];

                //insert to daily time records
                $employee = $this->employee_information_model->get_by(['employee_id' => $attendance_leave['employee_id']]);
                $shift_schedule = $this->shift_schedule_model->get_by(['id' => $employee['shift_schedule_id']]);
                
                foreach ($total_days_filed as $key => $day) {

                    $leaveToDtr = array(
                        'date' => date('Y-m-d', strtotime($attendance_leave['date']), '+'.$day),
                        'time_in' => $attendance_leave['date'] . $shift_schedule['time_start'],
                        'time_out' => $attendance_leave['date'] . $shift_schedule['time_end'],
                        'employee_id' => $attendance_leave['employee_id'],
                        'reports_to' => $attendance_leave['approver_id'],
                        'approval_status' => 1,
                        'remarks' => 'Official Business; ' . $attendance_leave['date'],
                        'shift_schedule_id' => $employee['shift_schedule_id'],
                        'company_id' => $employee['company_id'],
                        'site_id' => $employee['site_id']
                    );

                    $test = $this->attendance_daily_time_record_model->insert($leaveToDtr);

                }

                $update_leave_credit = $this->employee_leave_credit_model->update($employee_leave_credits_id, ['balance' => $updated_balance]);
                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 1]);

                $this->session->set_flashdata('success', 'You have successfully approved the filed leave.');
                redirect('leaves');

            } else {

                $update_payment_status = $this->leave_model->update($id, ['payment_status' => 0]);
                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 1]);

                if ($update_approval_status) {

                    redirect('leaves');
                    
                }
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }


    public function reject_leave($id)
    {
        $leave_data = $this->leave_model->get_by(['id' => $id]);
        $data['leave_data'] = $leave_data;

        $employee_id = $leave_data['employee_id'];

        if ( ! isset($employee_id) ) {

            $this->session->set_flashdata('failed', '');
            redirect('leaves');

        }

        $requester = $this->employee_model->get_by(['id' => $employee_id]);
        $data['modal_title']   = 'Reject Leave';
        $data['modal_message'] = sprintf(lang('reject_leave_message'), $requester['full_name']);
        $data['url']  = 'leaves/reject_leave/' . $leave_data['id'];
        $data['mode'] = 'reject';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'reject') {

            // $test_data = $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 3,
            //     'perm_key'    => 'reject_ob',
            //     'old_data'    => [
            //         'id' => $leave_data['id'],
            //         'approval_status' => $leave_data['approval_status']
            //     ],
            //     'new_data'    => ['approval_status' => 0],
            // ]);

            $result = $this->leave_model->update($id, ['approval_status' => 0]);

            if ($result){

                $this->session->set_flashdata('message', 'Leave successfully rejected');
                redirect('leaves');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject Leave');
                redirect('leaves');
            }
        }
        $this->load->view('modals/modal-confirmation', $data);
    }

    public function cancel_leave($id)
    {
        $attendance_leave = $this->leave_model->get_by(['id' => $id]);
        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'],
            'employee_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;

        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);

        //Calculate days filed of Leave...
        $updated_balance  = add_leave_balance($leave_balance, $total_days_filed);

        $requester              = $this->employee_model->get_by(['id' => $attendance_leave['employee_id']]);
        $data['modal_title']    = 'Cancel Leave';
        $data['modal_message']  = sprintf(lang('cancel_leave_message'), $requester['full_name']);
        $data['url']            = 'leaves/cancel_leave/' . $id;
        $data['mode']           = 'cancel';
        // dump($data);

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            if ($updated_balance != 0) {

                $employee_leave_credits_id = $leave_types[0]['elc_id'];

                $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, [
                    'balance' => $updated_balance
                ]);

                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 3]);

                $this->session->set_flashdata('success', 'You have cancelled your filed leave.');
                redirect('leaves');

            } else {

                $update_payment_status  = $this->leave_model->update($id, ['payment_status' => 0]);
                $update_approval_status = $this->leave_model->update($id, ['approval_status' => 3]);

                if ($update_approval_status) {

                     $this->session->set_flashdata('success', 'You have cancelled your filed leave.');
                     redirect('leaves');
                } else {

                     $this->session->set_flashdata('success', 'Unable to cancel your filed leave.');
                    redirect('leaves');

                }
            }
        }

        $this->load->view('modals/modal-confirmation', $data);
    }

    public function ajax_check_leave_balance()
    {
        $response_data = [];

        $posted_data = $this->input->post();

        $employee_id = $this->ion_auth->user()->row()->employee_id;

        $leave_request_days = daterange($posted_data['date_start'], $posted_data['date_end']);
        $leave_type_id      = $posted_data['leave_type'];

        $have_balance = $this->employee_model->check_leave_balance($employee_id, $leave_type_id, $leave_request_days);

        $message = ($have_balance) ? 'Have enough balance.':'Not enough balance.';

        // exit;
        $response_data['message'] = $message;
        $response_data['leave_request_days'] = $leave_request_days;
        $response_data['have_balance'] = $have_balance;
        $response_data['posted_data'] = $posted_data;

        echo json_encode($response_data);
    }

    public function cancel_my_leave()
    {
        $this->load->library('email');

            $this->email->from('gono.josh@gmail.com');
            $this->email->to('cristhiansagun@gmail.com', 'kevin');
            $this->email->subject('subject');
            $this->email->message('body of message');
            $this->email->send();
    }

}
