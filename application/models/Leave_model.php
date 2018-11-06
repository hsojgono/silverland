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

class Leave_model extends MY_Model {

    protected $_table      = 'attendance_leaves';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_menus'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($leave)
    {
        $user                     = $this->ion_auth->user()->row();
        $leave['created']         = date('Y-m-d H:i:s');
        $leave['created_by']      = $user->id;
        $leave['status']          = 1;
        $leave['approval_status'] = 2;
        $leave['company_id'] = $user->company_id;
        return $leave;
    }

    public function get_leave_by($param)
    {
        $query = $this->db;
        $query->select('attendance_leaves.*');
        return $this->get_by($param);
    }

    public function get_many_leave_by($param)
    {
        $query = $this->db;
        $query->select('attendance_leaves.*');
        return $this->get_many_by($param);
    }

    public function get_leave_all()
    {
        $query = $this->db;
        $query->select('*');
        return $this->get_all();
    }

    public function get_leave_requests($where)
    {
        $this->db->select('
                    attendance_leaves.*,
                    attendance_leave_types.name as leave_type,
                    employees.employee_code,
                    employees.middle_name,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                ')
                ->join('employees', 'attendance_leaves.employee_id = employees.id', 'left')
                ->join('attendance_leave_types', 'attendance_leaves.attendance_leave_type_id = attendance_leave_types.id', 'left');
        return $this->get_many_by($where);
    }

    protected function set_default_menus($leave)
    {
        $btn_settings = $this->config->item('btn_settings');

        if ( ! isset($leave)) {
            return FALSE;
        }

        $hashed_id = generateRandomString().'-'.md5($leave['id']);

        $leave['action_menus'] = [
            'approve' => [
                'url'               => site_url('leaves/approve_leave/'.$leave['id']),
                'icon'              => 'fa fa-thumbs-up',
                'label'             => 'Approve',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-approve-'.md5($leave['id']).'"',
                'modal_id'          => 'status-action-approve-'.md5($leave['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'reject' => [
                'url'               => site_url('leaves/reject_leave/'.$leave['id']),
                'icon'              => 'fa fa-thumbs-down',
                'label'             => 'Reject',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-reject-'.md5($leave['id']).'"',
                'modal_id'          => 'status-action-reject-'.md5($leave['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            // 'cancel' => [
            //     'url'               => site_url('leaves/cancel_leave/'.$leave['id']),
            //     'icon'              => 'fa fa-times',
            //     'label'             => 'Cancel',
            //     'modal_status'      => TRUE,
            //     'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-cancel-'.md5($leave['id']).'"',
            //     'modal_id'          => 'status-action-cancel-'.md5($leave['id']),
            //     'button_style'      => $btn_settings['btn_update']
            // ]
        ];

        if (isset($leave['approval_status'])) {

            switch ($leave['approval_status']) {

                case 0:
                    $leave['a_status'] = '<span class="label pull-center rejected_color">REJECTED</span>';
                    break;

                case 1:
                    $leave['a_status'] = '<span class="label pull-center approved_color">APPROVED</span>';
                    break;

                case 2:
                    $leave['a_status'] = '<span class="label pull-center pending_color">PENDING</span>';
                    break;

                case 3:
                    $leave['a_status'] = '<span class="label pull-center cancelled_color">CANCELLED</span>';
                    break;
            }
        }

        return $leave;
    }

    public function get_employee_attendance_leave($where = '')
    {
        $query = $this->db
                ->select('
                    attendance_leaves.id,
                    attendance_leaves.employee_id,
                    attendance_leaves.approver_id,
                    attendance_leaves.reason as leave_reason,
                    attendance_leave_types.name as leave_type,
                    attendance_leaves.date_start,
                    attendance_leaves.date_end,
                    attendance_leaves.approval_status as approval_status,
                    employees.employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as employee_full_name
                ')
                ->join('employees', $this->_table.'.employee_id = employees.id', 'left')
                ->join('attendance_leave_types', $this->_table.'.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $this->get_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
                attendance_leaves.id,
                attendance_leaves.employee_id,
                attendance_leaves.approver_id,
                attendance_leaves.reason as leave_reason,
                attendance_leave_types.name as leave_type,
                attendance_leaves.date_start,
                attendance_leaves.date_end,
                employees.employee_code,
                CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as employee_full_name
            ')
            ->join('employees', $this->_table.'.employee_id = employees.id', 'left')
            ->join('attendance_leave_types', $this->_table.'.attendance_leave_type_id = attendance_leave_types.id', 'left');  
            
        return $this->{$method}($where);
    }

    public function get_filed_leave($where='')
    {
        $this->db->select('*');
        return $this->get_many_by($where);
    }
}
