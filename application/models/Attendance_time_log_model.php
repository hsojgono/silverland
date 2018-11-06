<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      SMTI-JBGono
 * @link        http://systemantech.com
 */
class Attendance_time_log_model extends MY_Model {

    protected $_table = 'attendance_time_logs';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];

    protected function generate_date_created_status($time_log)
    {
        $time_log['approval_status'] = 1;
        $time_log['status'] = 1;
        return $time_log;
    }

    public function get_timein_by($id, $date)
    {
        $date = date('Y-m-d', strtotime($date));

        $where = array(
            'employee_id' => $id,
            'DATE(date_time)' => $date,
            'log_type' => 1,
            'dtr_reflected' => 0
        );

        $this->db->select('
            attendance_time_logs.*
        ')
        ->order_by('date_time', 'asc');

        return $this->get_by($where);
    }

    public function get_timeout_by($id, $date)
    {
        $date = date('Y-m-d', strtotime($date));

        $where = array(
            'employee_id' => $id,
            'DATE(date_time)' => $date,
            'log_type' => 0,
            'dtr_reflected' => 0
        );

        $this->db->select('
            attendance_time_logs.*
        ')
        ->order_by('date_time', 'desc');

        return $this->get_by($where);
    }
}