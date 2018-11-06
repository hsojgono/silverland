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

class Daily_time_log_model extends MY_Model {

    protected $_table 	   = 'attendance_time_logs';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];
    protected $after_get 	 = array('set_default_data');

    protected function generate_date_created_status($daily_time_log)
    {
    	$user_id                     		= $this->ion_auth->user()->row(); //user id
        // $daily_time_log['created']       = date('Y-m-d H:i:s');
        // $daily_time_log['active_status'] = 1;
        // $daily_time_log['created_by']    = $user_id;
        return $daily_time_log;
    }

    protected function set_default_data($daily_time_log)
    {
    	if ( ! isset($daily_time_log)) return FALSE;

		$middle_initial = (strlen($daily_time_log['middle_name']) > 1) ? substr($daily_time_log['middle_name'], 0, 1) : $daily_time_log['middle_name'];

		$full_name = array(
			$daily_time_log['last_name'].', ',
			$daily_time_log['first_name'].' ',
			$middle_initial
		);

		$daily_time_log['full_name']     = strtoupper(implode('', $full_name));
        $daily_time_log['time_log']    = ($daily_time_log['date_time'] == '0000-00-00 00:00:00') ? '-' : date('h:i A', strtotime($daily_time_log['date_time']));
        $daily_time_log['timeout']   = ($daily_time_log['date_time'] == '0000-00-00 00:00:00') ? '-' : date('h:i A', strtotime($daily_time_log['date_time']));
        $daily_time_log['status_action'] = ($daily_time_log['approval_status'] == 1) ? 'Approved' : 'Pending';
        $daily_time_log['log_type'] = ($daily_time_log['log_type'] == 1) ? 'IN' : 'OUT';
        return $daily_time_log;
    }

    public function get_details($method, $where)
    {
    	$this->db->select('
    		attendance_time_logs.*,
			employee.first_name,
			employee.middle_name,
            employee.last_name, 
            employee.employee_code
    	')
    	->join('employees as employee', 'attendance_time_logs.employee_id = employee.id', 'left')
        ->order_by('date_time', 'DESC');        
    	return $this->{$method}($where);

    }

    public function check_existence($method, $where)
    {
        $this->db->select();
        return $this->{$method}($where);
    }
}