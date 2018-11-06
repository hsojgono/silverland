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
class Training_model extends MY_Model {

    protected $_table      = 'trainings';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    //protected $before_create = ['generate_date_created_status'];
   // protected $after_get     = ['set_default_data'];
    protected $after_create  = ['write_audit_trail'];
    protected $after_update  = ['write_audit_trail'];

    protected function generate_date_created_status($training)
    {   
        $user                      = $this->ion_auth->user()->row();
        $training['created']       = date('Y-m-d H:i:s');
        $training['created_by']    = $user->employee_id;
        $training['active_status'] = 1;
        return $training;
    }

    // protected function set_default_data($training)
    // {
    //     if ( ! isset($training)) return FALSE;
        
    //     $training['status_label']   = ($training['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
    //     $training['status_action']  = ($training['active_status'] == 1) ? 'Deactivate' : 'Activate';
    //     $training['status_icon']    = ($training['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
    //     $training['status_url']     = ($training['active_status'] == 1) ? 'deactivate' : 'activate';
    //     $training['active_status']  = ($training['active_status'] == 1) ? 'Active' : 'Inactive';
    //     $training['status_label']   = ($training['active_status'] == 'Active') ? 'Deactivate' : 'Activate';
    //     return $training;
    // }

    public function get_details($method, $where)
    {
        $this->db->select('
            trainings.*,
            trainings.id as training_id,
            companies.name as company_name
        ')
        ->join('companies', 'companies.id = trainings.company_id', 'left');
        return $this->{$method}($where);
    }
    public function get_training_all()
    {
        $query = $this->db;
        $query->select('trainings.*');
        return $this->get_all();
    }
}
