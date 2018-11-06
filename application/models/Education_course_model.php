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
class Education_course_model extends MY_Model {

    protected $_table = 'education_course';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($education_course)
    {
        // $education_course['created']       = date('Y-m-d H:i:s');
        // $education_course['created_by']    = $this->ion_auth->user()->row()->id;
        $education_course['active_status'] = 1;
        return $education_course;
    }

    protected function set_default_data($education_course)
    {
        if ( ! isset($education_course)) {
            return FALSE;
        }  


        return $education_course;
    }

    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}
