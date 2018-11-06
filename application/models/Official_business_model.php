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

class Official_business_model extends MY_Model {

    protected $_table      = 'attendance_official_businesses';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data', 'set_default_menus'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($official_business)
    {
        $user = $this->ion_auth->user()->row();
        $official_business['created']         = date('Y-m-d H:i:s');
        $official_business['created_by']      = $user->id;
        $official_business['status']          = 1; //OB filed
        $official_business['approval_status'] = 2; //pending
        return $official_business;
    }

    protected function set_default_data($official_business)
    {
        $official_business['active_status']  = ($official_business['status'] == 1) ? 'Active' : 'Inactive';
        
        return $official_business;
    }

    public function get_ob_by($param)
    {
        $query = $this->db;
        $query->select('attendance_official_businesses.*,
                        CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name');
        $query->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left');
        $query->order_by('full_name', 'asc');
        //$query->join('companies', 'attendance_official_businesses.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_ob_by($param)
    {
        $query = $this->db;
        $query->select('attendance_official_businesses.*,
                        CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name');
        $query->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left');
        $query->order_by('full_name', 'asc');
        // $query->join('companies', 'attendance_official_businesses.company_id = companies.id', 'left');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_ob_all()
    {
        $query = $this->db;
        $query->select('attendance_official_businesses.*,
                       CONCAT_WS(' . '" "' . ', employees.first_name," " ,employees.last_name) as full_name,
                       CONCAT_WS(' . '" "' . ', account_contact_persons.first_name," " ,account_contact_persons.last_name) as contact_person,
                       CONCAT_WS(' . '" "' . ', attendance_official_businesses.time_start," - " ,attendance_official_businesses.time_end) as ob_time,
                       accounts.name as account_name');
        $query->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left');
        $query->join('accounts', 'accounts.id = attendance_official_businesses.account_id', 'left');
        $query->join('account_contact_persons', 'account_contact_persons.id = attendance_official_businesses.contact_person_id', 'left');

        return $this->get_all();
    }

    public function get_ob($where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->select('
                    attendance_official_businesses.*,
                    teams.name as team,
                    departments.name as department,
                    employees.employee_code as employee_code,
                    accounts.name as account_name,
                    CONCAT_WS(' . '" "' . ', account_contact_persons.first_name,", " ,account_contact_persons.last_name) as contact_person,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                    CONCAT_WS(' . '" "' . ', attendance_official_businesses.time_start," - " ,attendance_official_businesses.time_end) as ob_time,
                    ')
                ->from($this->_table)
                ->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left')
                ->join('teams', 'teams.id = attendance_official_businesses.team_id', 'left')
                ->join('departments', 'departments.id = attendance_official_businesses.department_id', 'left')
                ->join('accounts', 'accounts.id = attendance_official_businesses.account_id', 'left')
                ->join('account_contact_persons', 'account_contact_persons.id = attendance_official_businesses.contact_person_id', 'left')
                ->order_by('employees.last_name', 'asc')
                ->order_by('attendance_official_businesses.date', 'desc')
                ->get();

        return $query->result_array();
    }

    public function get_ob_requests_by($where = '')
    {
        $this->db->select('
            attendance_official_businesses.*,
            teams.name as team,
            departments.name as department,
            employees.employee_code as employee_code,
            accounts.name as account_name, accounts.id as account_id, account_contact_persons.id as contact_person_id,
            CONCAT_WS(' . '" "' . ', account_contact_persons.first_name,", " ,account_contact_persons.last_name) as contact_person,
            CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
            CONCAT_WS(' . '" "' . ', attendance_official_businesses.time_start," - " ,attendance_official_businesses.time_end) as ob_time,
            ')
        ->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left')
        ->join('teams', 'teams.id = attendance_official_businesses.team_id', 'left')
        ->join('departments', 'departments.id = attendance_official_businesses.department_id', 'left')
        ->join('accounts', 'accounts.id = attendance_official_businesses.account_id', 'left')
        ->join('account_contact_persons', 'account_contact_persons.id = attendance_official_businesses.contact_person_id', 'left')
        ->order_by('employees.last_name', 'asc')
        ->order_by('attendance_official_businesses.date', 'desc');

        return $this->get_many_by($where);
    }

    protected function set_default_menus($official_business)
    {
        $btn_settings = $this->config->item('btn_settings');

        if ( ! isset($official_business)) {
            return FALSE;
        }

        $hashed_id = generateRandomString().'-'.md5($official_business['id']);

        $official_business['action_menus'] = [
            'approve' => [
                'url'               => site_url('official_businesses/approve_official_business/'.$official_business['id']),
                'icon'              => 'fa fa-thumbs-up',
                'label'             => 'Approve',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-approve-'.md5($official_business['id']).'"',
                'modal_id'          => 'status-action-approve-'.md5($official_business['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            'reject' => [
                'url'               => site_url('official_businesses/reject_official_business/'.$official_business['id']),
                'icon'              => 'fa fa-thumbs-down',
                'label'             => 'Reject',
                'modal_status'      => TRUE,
                'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-reject-'.md5($official_business['id']).'"',
                'modal_id'          => 'status-action-reject-'.md5($official_business['id']),
                'button_style'      => $btn_settings['btn_update']
            ],
            // 'cancel' => [
            //     'url'               => site_url('official_businesses/cancel_official_business/'.$official_business['id']),
            //     'icon'              => 'fa fa-times',
            //     'label'             => 'Cancel',
            //     'modal_status'      => TRUE,
            //     'modal_attributes'  => 'data-toggle="modal" data-target="#status-action-cancel-'.md5($official_business['id']).'"',
            //     'modal_id'          => 'status-action-cancel-'.md5($official_business['id']),
            //     'button_style'      => $btn_settings['btn_update']
            // ]
        ];

        if (isset($official_business['approval_status'])) {

            switch($official_business['approval_status']){

                case 0:
                    $official_business['a_status'] = '<span class="label pull-center rejected_color">REJECTED</span>';
                    break;

                case 1:
                    $official_business['a_status'] = '<span class="label pull-center approved_color">APPROVED</span>';
                    break;

                case 2:
                    $official_business['a_status'] = '<span class="label pull-center pending_color">PENDING</span>';
                    break;

                case 3:
                    $official_business['a_status'] = '<span class="label pull-center cancelled_color">CANCELLED</span>';
                    break;
            }

        }

        return $official_business;
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            attendance_official_businesses.*,
            teams.name as team,
            departments.name as department,
            employees.employee_code as employee_code,
            accounts.name as account_name, accounts.id as account_id, account_contact_persons.id as contact_person_id,
            CONCAT_WS(' . '" "' . ', account_contact_persons.first_name,", " ,account_contact_persons.last_name) as contact_person,
            CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
            CONCAT_WS(' . '" "' . ', attendance_official_businesses.time_start," - " ,attendance_official_businesses.time_end) as ob_time,
            ')
        ->join('employees', 'employees.id = attendance_official_businesses.employee_id', 'left')
        ->join('teams', 'teams.id = attendance_official_businesses.team_id', 'left')
        ->join('departments', 'departments.id = attendance_official_businesses.department_id', 'left')
        ->join('accounts', 'accounts.id = attendance_official_businesses.account_id', 'left')
        ->join('account_contact_persons', 'account_contact_persons.id = attendance_official_businesses.contact_person_id', 'left');

        return $this->{$method}($where);
    }

    public function get_filed_officialbussines($where = '')
    {
        $this->db->select('*');
        return $this->get_many_by($where);
    }
}
