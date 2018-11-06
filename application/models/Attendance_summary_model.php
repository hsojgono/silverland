<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Attendance_summary_model extends MY_Model
{
	protected $_table = 'attendance_summaries';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

	protected function prepare_data($attendance_summary)
	{
		if ( ! isset($attendance_summary)) return FALSE;
		
		$attendance_summary['status_label']  = (isset($attendance_summary['active_status']) && $attendance_summary['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$attendance_summary['status_action'] = (isset($attendance_summary['active_status']) && $attendance_summary['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$attendance_summary['status_icon'] 	 = (isset($attendance_summary['active_status']) && $attendance_summary['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$attendance_summary['status_url'] 	 = (isset($attendance_summary['active_status']) && $attendance_summary['active_status'] == 1) ? 'deactivate' : 'activate';
		return $attendance_summary;
	}
    
    public function get_details($method, $where)
    {
        $this->db->select('
            attendance_summaries.*,
            employees.first_name as first_name,
            employees.middle_name as middle_name,
            employees.last_name as last_name,
            employees.employee_code
        ')
        ->join('employees', 'employees.id = attendance_summaries.employee_id', 'left');
        return $this->{$method}($where);
    }
}

// End of file Attendance_attendance_summary_model.php
// Location: ./application/models/Attendance_attendance_summary_model.php