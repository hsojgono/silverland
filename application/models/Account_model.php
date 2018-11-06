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
class Account_model extends MY_Model {

    protected $_table = 'accounts';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get = ['set_default_data'];

    protected function generate_date_created_status($account)
    {
        $account['created'] = date('Y-m-d H:i:s');
        $account['active_status'] = 1;
        $account['created_by'] = '0';
        return $account;
    }

    protected function set_default_data($account)
    {   
        $account['active_status']  = ($account['active_status'] == 1) ? 'Active' : 'Inactive';
        return $account;
    }
    
    public function get_account_by($param)
    {
        $query = $this->db;
        $query->select('accounts.*, accounts.name as account_name');
        $query->join('attendance_official_businesses', 'attendance_official_businesses.account_id = accounts.id ', 'left');
        $query->order_by('account_name', 'asc');

        return $this->get_by($param);
    }

    public function get_many_account_by($param)
    {
        $query = $this->db;
        $query->select('accounts.*');
        $query->order_by('name', 'asc');
        // $query->join('companies', 'accounts.company_id = companies.id', 'left');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_account_all()
    {
        $query = $this->db;
        $query->select('accounts.*');
        $query->order_by('name', 'asc');

        return $this->get_all();
    }
}
