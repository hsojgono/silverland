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
class Attachment_type_model extends MY_Model {

    protected $_table      = 'attachment_types';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */

    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($device)
    {
        $user_id                 = $this->ion_auth->user()->row();;

        $device['created']       = date('Y-m-d H:i:s');
        $device['created_by']    = $user_id->employee_id;
        $device['active_status'] = 1;
        return $device;
    }

    protected function set_default_data($device)
    {
        $device['active_status']  = ($device['active_status'] == 1) ? 'Active' : 'Inactive';
        $device['status_label']   = ($device['active_status'] == 'Active') ? 'De-activate' : 'Activate';
        return $device;
    }

    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}
