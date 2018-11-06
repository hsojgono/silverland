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
class Overtimes extends MY_Controller {

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
            'overtime_model',
            'employee_model',
            'employee_information_model'    
        ]);
    }

    function index()
    {
        $status = $this->uri->segment(3);
        $user   = $this->ion_auth->user()->row();

        if ( ! isset($status)) {
            $selected = '';
            $status = '';
        }

        $total_rejected  = $this->overtime_model->count_by(['approval_status' => 0, 'approver_id' => $user->employee_id]); 
        $total_approved  = $this->overtime_model->count_by(['approval_status' => 1, 'approver_id' => $user->employee_id]); 
        $total_pending   = $this->overtime_model->count_by(['approval_status' => 2, 'approver_id' => $user->employee_id]); 
        $total_cancelled = $this->overtime_model->count_by(['approval_status' => 3, 'approver_id' => $user->employee_id]);

        $my_overtimes = $this->overtime_model->get_overtimes([
            'attendance_overtimes.employee_id' => $user->employee_id]);

        $approval_overtimes = $this->overtime_model->get_overtimes([
            'attendance_overtimes.approver_id' => $user->employee_id]);

        $this->data = array(
            'page_header'        => 'Overtime Management',
            'my_overtimes'       => $my_overtimes,
            'approval_overtimes' => $approval_overtimes,
            'total_rejected'     => $total_rejected,
            'total_approved'     => $total_approved,
            'total_pending'      => $total_pending,
            'total_cancelled'    => $total_cancelled,
            'active_menu'        => $this->active_menu,
        );
        $this->load_view('pages/attendance_overtime-lists');
    }

    function add()
    {

        $this->data = array(
            'page_header' => 'Overtime Management',
            'active_menu' => $this->active_menu,
        );

        $user_id = $this->ion_auth->user()->row()->id;
        $user_data = $this->user_model->get_by(['id' => $user_id]);
        $approver_id = $this->employee_info_model->get_by(['employee_id' => $user_data['employee_id']]);

        $employee_id = $this->ion_auth->user()->row()->employee_id;
        $employee_information = $this->employee_model->get_employee_information(['employee_id' => $employee_id]);
        $employee_data = $this->employee_model->get_by(['id' => $employee_id]);

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('overtime_add'));
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('overtime_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'file_overtime',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);
            if (isset($data['date'])) {
            // convert date format from mm/dd/yyyy to yyyy-mm-dd
                $data['date'] = date('Y-m-d', strtotime($data['date']));
            }

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

            $data['employee_id'] = $employee_id;
            $data['approver_id'] = $employee_information[0]['reports_to'];

            $overtime_id = $this->overtime_model->insert($data);

            if ( ! $overtime_id) {
                $this->session->set_flashdata('failed', 'Failed to file an overtime.');
                redirect('overtimes');
            } else {

                $this->session->set_flashdata('success', 'Overtime successfully filed.');
                redirect('overtimes');
            }
        }

        $this->load_view('forms/attendance_overtime-add');
    }

    function edit($id)
    {
        // get specific overtime based on the id
        $overtime = $this->overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);

        $this->data = array(
            'page_header' => 'Overtime Management',
            'overtime'    => $overtime,
            'active_menu' => $this->active_menu,
        );

        // $overtimes = $this->overtime_model->get_overtime_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('overtime_add'));
        $this->form_validation->set_data($data);

        if ($this->form_validation->run('overtime_add') == TRUE)
        {
            $overtime_id = $this->overtime_model->update($id, $data);

            if ( ! $overtime_id) {
                $this->session->set_flashdata('failed', 'Failed to update overtime.');
                redirect('overtimes');
            } else {
                $this->session->set_flashdata('success', 'Overtime successfully updated!');
                redirect('overtimes');
            }
        }
        $this->load_view('forms/attendance_overtime-edit');
    }

    function details($id)
    {
        $overtime = $this->overtime_model->get_overtime_by(['attendance_overtimes.id' => $id]);
        $employee_infos = $this->employee_info_model->get_employee_info_data(['attendance_overtimes.id' => $id]);

        $this->data = array(
            'page_header'    => 'Overtime Details',
            'overtime'       => $overtime,
            'employee_infos' => $employee_infos,
            'active_menu'    => $this->active_menu,
        );
        $this->load_view('pages/attendance_overtime-details');
    }

    public function edit_confirmation($id)
    {
        $edit_overtime = $this->overtime_model->get_by(['id' => $id]);
        $data['edit_overtime'] = $edit_overtime;
        $this->load->view('modals/modal-update-overtime', $data);
    }

    public function update_status($id)
    {
        $overtime_data = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                $result = $this->overtime_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->overtime_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $overtime_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('overtimes');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$overtime_data['name'].'!');
                redirect('overtimes');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-overtime-status', $data);
        }
    }

    public function approve($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['approval_status' => 1]);

        if ($update) {

            $this->session->set_flashdata('message', 'Overtime successfully approved');
            redirect('overtimes');

        } else {

            $this->session->set_flashdata('message', 'Overtime unable to approve');
            redirect('overtimes');

        }
    }

    public function reject($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['approval_status' => 0]);

        if ($update) {

             $this->session->set_flashdata('message', 'Overtime successfully approved');
             redirect('overtimes');

        } else {

             $this->session->set_flashdata('message', 'Overtime unable to approve');
             redirect('overtimes');

        }
    }

    public function cancel($ot_id)
    {
        $this->load->model('overtime_model');
        $update = $this->overtime_model->update($ot_id, ['status' => 0]);

        if ($update) {

             $this->session->set_flashdata('message', 'Overtime successfully approved');
             redirect('overtimes');

        } else {

             $this->session->set_flashdata('message', 'Overtime unable to approve');
             redirect('overtimes');

        }
    }

    public function view_overtime()
    {

    }

    public function approve_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        $requester = $this->employee_model->get_by(['id' => $overtime_data['employee_id']]);
        $ot_data['modal_title']    = 'Approve Overtime?';
        $ot_data['modal_message']  = sprintf(lang('approve_overtime_message'), $requester['full_name']);
        $ot_data['url']            = 'overtimes/approve_overtime/' . $id;
        $ot_data['mode']           = 'approve';

        if (isset($post['mode']) && $post['mode'] == 'approve') {
            $result = $this->overtime_model->update($id, ['approval_status' => 1]);

            if ($result){
                
                $this->session->set_flashdata('message', 'Overtime successfully approved');
                redirect('overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to approve overtime');
                redirect('overtimes');
            }
        }
        $this->load->view('modals/modal-confirmation', $ot_data);
    }

    public function reject_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $post = $this->input->post();

        $requester = $this->employee_model->get_by(['id' => $overtime_data['employee_id']]);
        $ot_data['modal_title']    = 'Reject Overtime?';
        $ot_data['modal_message']  = sprintf(lang('reject_overtime_message'), $requester['full_name']);
        $ot_data['url'] = 'overtimes/reject_overtime/' . $id;
        $ot_data['mode'] = 'reject';

        if (isset($post['mode']) && $post['mode'] == 'reject') {
            $result = $this->overtime_model->update($id, ['approval_status' => 0]);

            if ($result){

                $this->session->set_flashdata('message', 'Undertime successfully rejected');
                redirect('overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to reject overtime');
                redirect('overtimes');
            }
        }
        $this->load->view('modals/modal-confirmation', $ot_data);
    }


    public function cancel_overtime($id)
    {
        $overtime_data         = $this->overtime_model->get_by(['id' => $id]);
        $data['overtime_data'] = $overtime_data;

        $employee_id = $overtime_data['employee_id'];
        $requester = $this->employee_model->get_by(['id' => $employee_id]);

        $data['modal_title']   = 'Cancel Overtime';
        $data['modal_message'] = sprintf(lang('cancel_overtime_message'), $requester['full_name']);
        $data['url']  = 'overtimes/cancel_overtime/' . $overtime_data['id'];
        $data['mode'] = 'cancel';

        $post = $this->input->post();

        if (isset($post['mode']) && $post['mode'] == 'cancel') {
            $result = $this->overtime_model->update($id, ['status' => 0]);

            if ($result){
                $this->session->set_flashdata('message', 'Undertime successfully cancelled');
                redirect('overtimes');
            }
            else{
                $this->session->set_flashdata('failed', 'Unable to cancel overtime');
                redirect('overtimes');
            }
        }
        $this->load->view('modals/modal-overtime-confirmation', $data);
    }

    /**
     * Ajax calls
     *
     */

    public function ajax_my_overtime()
    {
        $data = ['status' => 'success', 'message' => 'test message ajax_my_overtime!'];
         $my_employee_id           = $this->ion_auth->user()->row()->employee_id;

        $data['summary'] = [
            'total_denied' => $this->overtime_model->count_by([
                'approval_status' => 0,
                'employee_id' => $my_employee_id
            ]),
            'total_approved' => $this->overtime_model->count_by([
                'approval_status' => 1,
                'employee_id' => $my_employee_id
            ]),
            'total_pending' => $this->overtime_model->count_by([
                'approval_status' => 2,
                'employee_id' => $my_employee_id
            ]),
            'total_cancelled' => $this->overtime_model->count_by([
                'status' => 0,
                'employee_id' => $my_employee_id
            ]),
        ];

        echo json_encode($data);
    }

    public function ajax_approval()
    {
        $data = ['status' => 'success', 'message' => 'test message ajax_approval!'];

        $data['summary'] = [
            'total_denied'    => $this->overtime_model->count_by(['approval_status' => 0]),
            'total_approved'  => $this->overtime_model->count_by(['approval_status' => 1]),
            'total_pending'   => $this->overtime_model->count_by(['approval_status' => 2]),
            'total_cancelled' => $this->overtime_model->count_by(['approval_status' => 3]),
        ];

        echo json_encode($data);
    }
}
