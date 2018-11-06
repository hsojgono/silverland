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
class Overtime_model extends MY_Model {

    protected $_table      = 'attendance_overtimes';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_menus'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($overtime)
    {
        $user                        = $this->ion_auth->user()->row();
        $overtime['created']         = date('Y-m-d H:i:s');
        $overtime['created_by']      = $user->id;
        $overtime['status']          = 1;
        $overtime['approval_status'] = 2;
        $overtime['company_id'] = $user->company_id;
        return $overtime;
    }

    public function get_overtime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_by($param);
    }
    public function get_many_overtime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_many_by($param);
    }
    public function get_overtime_all()
    {
        $query = $this->db;
        $query->select('attendance_overtimes.*');
        return $this->get_all();
    }

    protected function set_default_menus($overtime)
    {
        $btn_settings = $this->config->item('btn_settings');

        if ( ! isset($overtime)) {
            return FALSE;
        }

        $hashed_id = generateRandomString().'-'.md5($overtime['id']);

        $overtime['action_menus'] = [
            'approve' => [
                'url'               => site_url('overtimes/approve_overtime/'.$overtime['id']),
                'icon'              => 'fa fa-thumbs-up',
                'label'             => 'Approve',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-approve-'.md5($overtime['id']).'"',
                'modal_id'          => 'status-action-approve-'.md5($overtime['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'reject' => [
                'url'               => site_url('overtimes/reject_overtime/'.$overtime['id']),
                'icon'              => 'fa fa-thumbs-down',
                'label'             => 'Reject',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-reject-'.md5($overtime['id']).'"',
                'modal_id'          => 'status-action-reject-'.md5($overtime['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            // 'cancel' => [
            //     'url'               => site_url('overtimes/cancel_overtime/'.$overtime['id']),
            //     'icon'              => 'fa fa-times',
            //     'label'             => 'Cancel',
            //     'modal_status'      => TRUE,
            //     'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-cancel-'.md5($overtime['id']).'"',
            //     'modal_id'          => 'status-action-cancel-'.md5($overtime['id']),
            //     'button_style'      => $btn_settings['btn_update']
            // ]
        ];

        if (isset($overtime['approval_status'])) {

            switch ($overtime['approval_status']) {

                case 0:
                    $overtime['a_status'] = '<span class="label pull-center rejected_color">REJECTED</span>';
                    break;

                case 1:
                    $overtime['a_status'] = '<span class="label pull-center approved_color">APPROVED</span>';
                    break;

                case 2:
                    $overtime['a_status'] = '<span class="label pull-center pending_color">PENDING</span>';
                    break;

                case 3:
                    $overtime['a_status'] = '<span class="label pull-center cancelled_color">CANCELLED</span>';
                    break;
            }

        }
        return $overtime;
    }

    public function get_overtimes($where = '')
    {
        $query = $this->db;
        $query->select('
                    attendance_overtimes.*,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                ')
              ->join('employees', 'employees.id = attendance_overtimes.employee_id', 'left')
              ->order_by('employees.last_name', 'asc')
              ->order_by('attendance_overtimes.date', 'desc');

        return $this->get_many_by($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('
                attendance_overtimes.*,
                employees.employee_code as employee_code,
                CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
            ')
        ->join('employees', 'employees.id = attendance_overtimes.employee_id', 'left')
        ->order_by('employees.last_name', 'asc')
        ->order_by('attendance_overtimes.date', 'desc');

        return $this->{$method}($where);
    }

    public function get_filed_overtime($where = '')
    {
        $this->db->select('*');
        return $this->get_many_by($where);
    }
}
