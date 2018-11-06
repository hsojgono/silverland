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
class Account_contact_person_model extends MY_Model 
{
    protected $_table      = 'account_contact_persons';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($account_contact_person)
    {
        $account_contact_person['created'] = date('Y-m-d H:i:s');
        $account_contact_person['created_by'] = $this->ion_auth->user()->row()->id;
        $account_contact_person['active_status'] = 1;
        return $account_contact_person;
    }

    protected function set_default_data($account_contact_person)
    {   
        $account_contact_person['active_status']  = ($account_contact_person['active_status'] == 1) ? 'Active' : 'Inactive';
        return $account_contact_person;
    }

    public function get_details()
    {

    }
}