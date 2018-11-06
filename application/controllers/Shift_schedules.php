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


 class Shift_schedules extends MY_Controller {

     private $active_menu = 'Administration';

     function __construct()
     {
         parent::__construct();
         $this->load->library('audit_trail');
         $this->load->model('shift_schedule_model');
     }

     public function index()
     {
         $shift_schedules = $this->shift_schedule_model->get_shift_schedule_all();

         $this->data = array(
            'page_header'     => 'Shift Schedule Management',
            'shift_schedules' => $shift_schedules,
            'active_menu'     => $this->active_menu
         );
         $this->load_view('pages/shift_schedule-lists');
     }

     public function add()
     {
        $user  = $this->ion_auth->user()->row();
        $where = [];

        $where['active_status'] = 1;

        if ($user->company_id != 0) {
            $where['id'] = $user->company_id;
        }

        $companies = $this->company_model->get_many_by($where);

        $this->data = array(
            'page_header'  => 'Shift Schedule Mangement',
            'companies'    => $companies,
            'active_menu'  => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('shift_schedule_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('shift_schedule_add') == TRUE)
        {
            // $this->session->set_flashdata('log_parameters', [
            //     'action_mode' => 0,
            //     'perm_key' 	  => 'add_shift_schedule',
            //     'old_data'	  => NULL,
            //     'new_data'    => $data
            // ]);

            $shift_schedule_id = $this->shift_schedule_model->insert($data);

            if ( ! $shift_schedule_id) {
                $this->session->set_flashdata('failed', 'Failed to add new shift_schedule.');
                redirect('shift_schedules');
            } else {
            $this->session->set_flashdata('success', 'Successfully added ' .$data['']);
                redirect('shift_schedules');
            }
        }

        $this->load_view('forms/shift_schedule-add');
    }

     function details($id)
     {
         $shift_schedule = $this->shift_schedule_model->get_shift_schedule_by(['attendance_shift_schedules.id' => $id]);

         $this->data = array(
             'page_header'    => 'Shift Schedule Details',
             'shift_schedule' => $shift_schedule,
             'active_menu'    => $this->active_menu,
         );
         $this->load_view('pages/shift_schedule-detail');
     }

     public function edit($id)
     {
         // get specific shift_schedule based on the id
         $shift_schedule = $this->shift_schedule_model->get_shift_schedule_by(['attendance_shift_schedules.id' => $id]);
        //  dump($shift_schedule);exit;
         // get all company records where status is equal to active
         $companies = $this->company_model->get_many_by(['active_status' => 1]);
        //  dump($this->db->last_query());exit;
         $this->data = array(
             'page_header'    => 'Shift Schedule Management',
             'shift_schedule' => $shift_schedule,
             'companies'	  => $companies,
             'active_menu'    => $this->active_menu,
         );

         $shift_schedules = $this->shift_schedule_model->get_shift_schedule_all();
         $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('shift_schedule_add'));

         $this->form_validation->set_data($data);

         if ($this->form_validation->run('shift_schedule_add') == TRUE)
         {
             $this->session->set_flashdata('log_parameters', [
                 'action_mode' => 1,
                 'perm_key'	  => 'edit_shift_schedule_type',
                 'old_data'	  => $shift_schedule,
                 'new_data'	  => $data
             ]);

             $shift_schedule_id = $this->shift_schedule_model->update($id, $data);

             if ( ! $shift_schedule_id) {
                 $this->session->set_flashdata('failed', 'Failed to update shift_schedule.');
                 redirect('shift_schedules');
             } else {
                 $this->session->set_flashdata('success', 'Shift Schedule successfully updated!');
                 redirect('shift_schedules');
             }
         }
         $this->load_view('forms/shift_schedule-edit');
     }

     public function edit_confirmation()
     {
         $id = $this->uri->segment(3);
         $edit_shift_schedule         = $this->shift_schedule_model->get_by(['id' => $id]);
         $data['edit_shift_schedule'] = $edit_shift_schedule;

         $this->load->view('modals/modal-update-shift_schedule', $data);
     }

     public function update_status($id)
     {
         $shift_schedule_data         = $this->shift_schedule_model->get_by(['id' => $id]);
         $data['shift_schedule_data'] = $shift_schedule_data;

         $post = $this->input->post();

         if (isset($post['mode']))
         {
             $result = FALSE;

             if ($post['mode'] == 'De-activate')
             {
                 dump('De-activating...');
                 $result = $this->shift_schedule_model->update($id, ['active_status' => 0]);
                 dump($this->db->last_query());
             }
             if ($post['mode'] == 'Activate')
             {
                 dump('Activating...');
                 $result = $this->shift_schedule_model->update($id, ['active_status' => 1]);
                 dump($this->db->last_query());
             }

             if ($result)
             {
                  $this->session->set_flashdata('message', $shift_schedule_data['code'].' successfully '.$post['mode'].'d!');
                  redirect('shift_schedules');
             }
             else
             {
                 $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$shift_schedule_data['code'].'!');
                 redirect('shift_schedules');
             }

         }
         else
         {
             $this->load->view('modals/modal-update-shift_schedule-status', $data);
         }
     }
 }
