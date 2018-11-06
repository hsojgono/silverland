<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Leave_confirmations extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model([
            'attendance_leave_model',
            'employee_leave_credit_model',
            'leave_type_model',
            'employee_model',
            'user_model'
        ]);
	}

	public function approve($attendance_leave_id)
    {
        $attendance_leave = $this->attendance_leave_model->get_by(['id' => $attendance_leave_id]);
        $withpay          = $attendance_leave['payment_status'];

        $leave_types = $this->employee_model->get_employee_leave_credit([
            'employee_leave_credits.employee_id' => $attendance_leave['employee_id'], 
            'position_leave_credits.attendance_leave_type_id' => $attendance_leave['attendance_leave_type_id']
        ]);

        $leave_balance   = $leave_types[0]['elc_balance'];
        $updated_balance = 0;
            
        $total_days_filed = daterange($attendance_leave['date_start'], $attendance_leave['date_end']);

        //Calculate days filed of Leave...
        $updated_balance  = calculate_leave_balance($leave_balance, $total_days_filed);


       if ($updated_balance != 0) {
        
            $employee_leave_credits_id = $leave_types[0]['elc_id'];

            $update_leave_credit    = $this->employee_leave_credit_model->update($employee_leave_credits_id, ['balance' => $updated_balance]);
            $update_approval_status = $this->attendance_leave_model->update($attendance_leave_id, ['approval_status' => 1]);

            $leave_data = $this->attendance_leave_model->get_employee_attendance_leave([
                'attendance_leaves.id' => $attendance_leave_id
            ]);

            $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
            $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

            $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
            $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

            $data = [
                'approver_data'   => $approver_data,
                'approver_email'  => $approver_email,
                'requester_data'  => $requester_data,
                'requester_email' => $requester_email,
                'leave_data'      => $leave_data
            ];

            $subject          = '[HRIS - Approval] Attendance: Leave Request'.' - '.$leave_data['id'];// TODO: let's make this dynamic
            $subject_approved = '[HRIS - Approved] Attendance: Leave Request'.' - '.$leave_data['id'];
            $email_template   = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
            $name             = $subject.' - '.$requester_data['full_name'];

            $message = $this->load->view($email_template, $data, TRUE);

            // $this->email->from('cristhiansagun@gmail.com');
            $this->email->from($requester_email, $name);
            $this->email->to($approver_email);
            $this->email->subject($subject);
            $this->email->message($message);

            $this->email->from('lohicasoft@gmail.com', 'KAWANI-HRIS');
            $this->email->to($approver_email);
            $this->email->subject($subject_approved);
            $this->email->message("You've successfully approved the Leave Request of".' '.$requester_data['full_name']);
            
            $this->email->send();
            
            $this->load->library('email');

            $this->session->set_flashdata('success', 'You have successfully approved the filed leave of'.' '.$requester_data['full_name']);
            redirect('attendance_leaves');     

        } else {

            $update_payment_status  = $this->attendance_leave_model->update($attendance_leave_id, ['payment_status' => 0]);   
            $update_approval_status = $this->attendance_leave_model->update($attendance_leave_id, ['approval_status' => 1]);  

            if ($update_approval_status) {

                $leave_data = $this->attendance_leave_model->get_employee_attendance_leave([
                    'attendance_leaves.id' => $attendance_leave_id
                ]);

                $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
                $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;

                $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
                $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

                $data = [
                    'approver_data'   => $approver_data,
                    'approver_email'  => $approver_email,
                    'requester_data'  => $requester_data,
                    'requester_email' => $requester_email,
                    'leave_data'      => $leave_data
                ];

                $subject          = '[HRIS - Approval] Attendance: Leave Request'.' - '.$leave_data['id'];// TODO: let's make this dynamic
                $subject_approved = '[HRIS - Approved] Attendance: Leave Request'.' - '.$leave_data['id'];
                $email_template   = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
                $name             = $subject.' - '.$requester_data['full_name'];

                $message = $this->load->view($email_template, $data, TRUE);

                // $this->email->from('cristhiansagun@gmail.com');
                $this->email->to($requester_email, $name);
                $this->email->from($approver_email);
                $this->email->subject($subject);
                $this->email->message($message);

                $this->email->from('lohicasoft@gmail.com', 'KAWANI-HRIS');
                $this->email->to($approver_email);
                $this->email->subject($subject_approved);
                $this->email->message("You've successfully approved the Leave Request of".' '.$requester_data['full_name']);

                $this->email->send();
                
                $this->load->library('email');

                // $message = $this->load->view('templates/email/leave_approve.tpl.php', [], true);

                // $this->email->from('joseph.gono@systemantech.com', 'OBR - Josh Gono');
                // $this->email->to('gono.josh@gmail.com');

                // $this->email->subject('Leave Request - Approved');
                // $this->email->message($message);

                // $this->email->send();

                // //an email notificaton will be sent to user that filed an OB
             
                // $this->email->from('gono.josh@gmail.com', 'OBR - Josh Gono');
                // $this->email->to('joseph.gono@systemantech.com');

                // $this->email->subject('Leave Request');
                // $this->email->message('Approval notification has been successfully sent to Josh Gono');

                // $this->email->send();

            } else {

            }
        } 
    }

    public function disapprove($attendance_leave_id)
    {
    	$attendance_leave 		= $this->attendance_leave_model->get_by(['id' => $attendance_leave_id]);
        $update_approval_status = $this->attendance_leave_model->update($attendance_leave_id, ['approval_status' => 0]);


        //Send a notification to both requester and approver
        $leave_data = $this->attendance_leave_model->get_employee_attendance_leave([
            'attendance_leaves.id' => $attendance_leave_id
        ]);

        $approver_data   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);
        $approver_email  = $this->ion_auth->user($approver_data['system_user_id'])->row()->email;
        $approver_name   = $this->employee_model->get_by(['id' => $leave_data['approver_id']]);

        $requester_data  = $this->employee_model->get_by(['id' => $leave_data['employee_id']]);
        $requester_email = $this->ion_auth->user($requester_data['system_user_id'])->row()->email;

        $data = [
            'approver_data'   => $approver_data,
            'approver_email'  => $approver_email,
            'approver_name'   => $approver_name,
            'requester_data'  => $requester_data,
            'requester_email' => $requester_email,
            'leave_data'      => $leave_data
        ];

        // dump($approver_name['full_name']);exit;
        $subject 		     = '[HRIS - Approval] Attendance: '.$leave_data['leave_type'].' Request'.' - '.$leave_data['id']; // TODO: let's make this dynamic
        $subject_disapproved = '[HRIS - Disapproved] Attendance: '.$leave_data['leave_type'].' Request'.' - '.$leave_data['id']; // TODO: let's make this dynamic
        $email_template      = 'templates/email/leave_confirmation.php'; // TODO: let's make this dynamic also
        $name 			     = $subject.' - '.$requester_data['full_name'];
        $approver_name 	     = $approver_name['full_name'];
        $message 		     = $this->load->view($email_template, $data, TRUE);

        // $this->email->from('cristhiansagun@gmail.com');
        $this->email->from($approver_email);
        $this->email->to($requester_email);
        $this->email->subject($subject_disapproved);
        $this->email->message('Your'.' '.$leave_data['leave_type'].' request has been disapproved by '.$approver_name.'.');

        $this->email->from('lohicasoft@gmail.com', 'KAWANI-HRIS');
        $this->email->to($approver_email);
        $this->email->subject($subject);
        $this->email->message("You've disapproved the Leave Request of".' '.$requester_data['full_name']);
        
        $this->email->send();
        
        $this->load->library('email');
    }
}