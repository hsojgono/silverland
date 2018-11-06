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
class Attendance_daily_time_record_model extends MY_Model {

    public $expected_fields = array();

    protected $_table = 'attendance_daily_time_records';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    
    public function get_timelogs($method, $where)
    {
        $this->db->select('
            attendance_daily_time_records.*
        ');

        return $this->{$method}($where);
    }

    public function get_works_entered($method, $where)
    {
        $this->db->select('
            attendance_daily_time_records.*
        ');

        return $this->{$method}($where);
    }
}