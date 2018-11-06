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
class Educational_attainment_model extends MY_Model {

    protected $_table = 'educational_attainments';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($educational_attainment)
    {
        $educational_attainment['created']       = date('Y-m-d H:i:s');
        $educational_attainment['created_by']    = $this->ion_auth->user()->row()->id;
        $educational_attainment['active_status'] = 1;
        return $educational_attainment;
    }

    protected function set_default_data($educational_attainment)
    {
        if ( ! isset($educational_attainment)) {
            return FALSE;
        }
        

        return $educational_attainment;
    }

    public function get_details($method, $where)
    {
        $this->db->select('*');
        return $this->{$method}($where);
    }
}
