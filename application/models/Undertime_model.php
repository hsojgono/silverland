<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.kevin@systemantech.com
 * @link        http://systemantech.com
 */
class Undertime_model extends MY_Model {

    protected $_table      = 'attendance_undertimes';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_menus'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($undertime)
    {
        $user                         = $this->ion_auth->user()->row();
        $undertime['created']         = date('Y-m-d H:i:s');
        $undertime['created_by']      = $user->employee_id;
        $undertime['status']          = 1;
        $undertime['approval_status'] = 2;
        $undertime['company_id'] = $user->company_id;
        return $undertime;
    }

    protected function set_default_menus($undertime)
    {
        $btn_settings = $this->config->item('btn_settings');

        if ( ! isset($undertime)) {
            return FALSE;
        }

        $hashed_id = generateRandomString().'-'.md5($undertime['id']);

        $undertime['action_menus'] = [
            'approve' => [
                'url'               => site_url('undertimes/approve_undertime/'.$undertime['id']),
                'icon'              => 'fa fa-thumbs-up',
                'label'             => 'Approve',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-approve-'.md5($undertime['id']).'"',
                'modal_id'          => 'status-action-approve-'.md5($undertime['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'reject' => [
                'url'               => site_url('undertimes/reject_undertime/'.$undertime['id']),
                'icon'              => 'fa fa-thumbs-down',
                'label'             => 'Reject',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-reject-'.md5($undertime['id']).'"',
                'modal_id'          => 'status-action-reject-'.md5($undertime['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            // 'cancel' => [
            //     'url'               => site_url('undertimes/cancel_undertime/'.$undertime['id']),
            //     'icon'              => 'fa fa-times',
            //     'label'             => 'Cancel',
            //     'modal_status'      => TRUE,
            //     'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-cancel-'.md5($undertime['id']).'"',
            //     'modal_id'          => 'status-action-cancel-'.md5($undertime['id']),
            //     'button_style'      => $btn_settings['btn_update']
            // ]
        ];

        if (isset($undertime['approval_status'])) {

            switch ($undertime['approval_status']) {

                case 0:
                    $undertime['a_status'] = '<span class="label pull-center rejected_color">REJECTED</span>';
                    break;

                case 1:
                    $undertime['a_status'] = '<span class="label pull-center approved_color">APPROVED</span>';
                    break;

                case 2:
                    $undertime['a_status'] = '<span class="label pull-center pending_color">PENDING</span>';
                    break;

                case 3:
                    $undertime['a_status'] = '<span class="label pull-center cancelled_color">CANCELLED</span>';
                    break;
            }
        }
        return $undertime;
    }

    public function get_undertime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_by($param);
    }
    public function get_many_undertime_by($param)
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_many_by($param);
    }
    public function get_undertime_all()
    {
        $query = $this->db;
        $query->select('attendance_undertimes.*');
        return $this->get_all();
    }

    public function get_undertimes($where = '')
    {
        $query = $this->db;
        $query->select('
                    attendance_undertimes.*,
                    teams.name as team,
                    departments.name as department,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                ')
              ->join('employees', 'employees.id = attendance_undertimes.employee_id', 'left')
              ->join('teams', 'teams.id = attendance_undertimes.team_id', 'left')
              ->join('departments', 'departments.id = attendance_undertimes.department_id', 'left')
              ->order_by('employees.last_name', 'asc')
              ->order_by('attendance_undertimes.date', 'desc');
                                                             
        return $this->get_many_by($where);

    }

    public function get_details($method, $where)
    {
        $this->db->select('
                attendance_undertimes.*,
                teams.name as team,
                departments.name as department,
                employees.employee_code as employee_code,
                CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
            ')
        ->join('employees', 'employees.id = attendance_undertimes.employee_id', 'left')
        ->join('teams', 'teams.id = attendance_undertimes.team_id', 'left')
        ->join('departments', 'departments.id = attendance_undertimes.department_id', 'left')
        ->order_by('employees.last_name', 'asc')
        ->order_by('attendance_undertimes.date', 'desc');

        return $this->{$method}($where);
    }

    public function get_filed_undertime($where = '')
    {
        $this->db->select('*');
        $this->db->order_by('date', 'desc');
        return $this->get_many_by($where);
    }
}
