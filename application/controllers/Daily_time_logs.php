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
class Daily_time_logs extends MY_Controller {

    private $active_menu = 'System';

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
            'daily_time_logs_model',
            'employee_schedule_model',
            'shift_schedule_model',
            'employee_model'
        ]);
    }

    public function index()
    {
        // todo: get all companies records from database order by name ascending
            // todo: load daily_time_logs model
            // todo: load view & past the retrieved data from model
        $daily_time_logs = $this->daily_time_logs_model->get_daily_time_logs_all();
        $this->data = array(
            'page_header'     => 'Daily Time Logs Management',
            'daily_time_logs' => $daily_time_logs,
            'active_menu'     => $this->active_menu,
        );
        $this->load_view('pages/daily_time_log-lists');
    }

    public function time_in()
    {
        $this->data = array(
            'page_header' => 'Daily Time Log Management',
            'active_menu' => $this->active_menu,
        );
        $log_type = 'I';
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_logs_add'));
        $data['log_type'] = $log_type;

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_logs_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_logs',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $daily_time_logs_id = $this->daily_time_logs_model->insert($data);

            if ( ! $daily_time_logs_id) {
                $this->session->set_flashdata('failed', 'Failed to Time In');
                redirect('daily_time_logs');
            } else {
                $this->session->set_flashdata('success', 'Successfully Timed In.');
                redirect('daily_time_logs');
            }
        }
        $this->load_view('forms/daily_time_log-page');
    }

    public function time_out()
    {
        $this->data = array(
            'page_header' => 'Daily Time Log Management',
            'active_menu' => $this->active_menu,
        );

        $log_type = 'O';
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_logs_add'));
        $data['log_type'] = $log_type;

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_logs_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key'    => 'add_daily_time_logs',
            //     'old_data'    => NULL,
            //     'new_data'    => $data
            // ]);

            $daily_time_logs_id = $this->daily_time_logs_model->insert($data);

            if ( ! $daily_time_logs_id) {
                $this->session->set_flashdata('failed', 'Failed to Time Out.');
                redirect('daily_time_logs');
            } else {
                $this->session->set_flashdata('success', 'Successfully Timed Out.');
                redirect('daily_time_logs');
            }
        }
        $this->load_view('forms/daily_time_logs-page');
    }


    public function edit($daily_time_logs_id)
    {
        if ( ! $this->ion_auth_acl->has_permission('edit_daily_time_logs'))
        {
            $this->session->set_flashdata('failed', 'You have no permission to access this module');
            redirect('/', 'refresh');
        }

        $daily_time_logs = $this->daily_time_logs_model->get_daily_time_logs_by(['attendance_daily_time_logs.id' => $daily_time_logs_id]);

        $this->data = array(
            'page_header' => 'Daily Time Log Management',
            'daily_time_logs'     => $daily_time_logs,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('daily_time_logs_edit'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('daily_time_logs_edit') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 1,
            //     'perm_key'    => 'edit_daily_time_logs',
            //     'old_data'    => $daily_time_logs,
            //     'new_data'    => $data
            // ]);

            $daily_time_logs_id = $this->daily_time_logs_model->update($daily_time_logs_id, $data);

            if ( ! $daily_time_logs_id) {
                $this->session->set_flashdata('failed', 'Failed to update daily_time_logs.');
                redirect('daily_time_logs');
            } else {
                $this->session->set_flashdata('success', 'Daily Time Log successfully updated!');
                redirect('daily_time_logs');
            }
        }
        $this->load_view('forms/daily_time_logs-edit');
    }

    public function details($id)
    {
        $daily_time_logs = $this->daily_time_logs_model->get_daily_time_logs_by(['attendance_daily_time_logs.id' => $id]);
        $employees         = $this->employee_model->get_many_employee_by(['daily_time_logs_id' => $id]);


        $this->data = array(
            'page_header'       => 'Daily Time Log Details',
            'daily_time_logs' => $daily_time_logs,
            'branches'          => $branches,
            'employees'         => $employees,
            'active_menu'       => $this->active_menu,
        );
        $this->load_view('pages/daily_time_logs-details');
    }

    public function edit_confirmation($id)
    {
        $daily_time_logs_data = $this->daily_time_logs_model->get_by(['id' => $id]);
        $data['daily_time_logs_data'] = $daily_time_logs_data;

        $this->load->view('modals/modal-update-daily_time_logs', $data);
    }

    public function update_status($id)
    {
        $daily_time_logs_data         = $this->daily_time_logs_model->get_by(['id' => $id]);
        $data['daily_time_logs_data'] = $daily_time_logs_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'De-activate')
            {
                dump('De-activating...');
                $result = $this->daily_time_logs_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->daily_time_logs_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $daily_time_logs_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('daily_time_logs');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$daily_time_logs_data['name'].'!');
                redirect('daily_time_logs');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-daily_time_logs-status', $data);
        }
    }
}
