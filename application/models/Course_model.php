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
class Course_model extends MY_Model {

    protected $_table      = 'education_courses';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $after_get     = ['set_default_data'];
    protected $before_create = ['prepare_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function prepare_data($education_course)
    {   
        $education_course['created']       = date('Y-m-d H:i:s');
        $education_course['created_by']    = $this->ion_auth->user()->row()->id;
        $education_course['active_status'] = 1;
        return $education_course;
    }

    protected function set_default_data($education_course)
    {
        $education_course['status_label']  = ($education_course['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$education_course['status_action'] = ($education_course['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$education_course['status_icon'] = ($education_course['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $education_course['status_url']  = ($education_course['active_status'] == 1) ? 'deactivate' : 'activate';
        return $education_course;
    }

    public function get_details($method, $where)
    {
        $this->db->select('
                education_courses.*,
                educational_attainments.name as degree
            ')
        ->join('educational_attainments', 'education_courses.educational_attainment_id = educational_attainments.id', 'left')
        ->order_by('description','asc');
        return $this->{$method}($where);
    }

}
