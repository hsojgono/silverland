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
class Contact_person_model extends MY_Model {

    protected $_table = 'account_contact_persons';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($contact_person)
    {
        $user                            = $this->ion_auth->user()->row();;
        $contact_person['created']       = date('Y-m-d H:i:s');
        $contact_person['created_by']    = $user->employee_id;
        $contact_person['active_status'] = 1;
        return $contact_person;
    }

    protected function set_default_data($contact_person)
    {
        $contact_person['active_status']  = ($contact_person['active_status'] == 1) ? 'Active' : 'Inactive';
        $contact_person['full_name'] = $contact_person['first_name'].' '.
                                       $contact_person['middle_name'].' '.
                                       $contact_person['last_name'];
        return $contact_person;
    }

    public function get_contact_person_by($param)
    {
        $query = $this->db;
        $query->select('account_contact_persons.*');
        $query->join('attendance_official_businesses', 'attendance_official_businesses.contact_person_id = contact_persons.id', 'left');
        //$query->join('companies', 'account_contact_persons.company_id = companies.id', 'left');

        return $this->get_by($param);
    }

    public function get_many_contact_person_by($param)
    {
        $query = $this->db;
        $query->select('account_contact_persons.*');
        $query->join('attendance_official_businesses', 'attendance_official_businesses.contact_person_id = contact_persons.id', 'left');
        // $query->order_by('name', 'asc');
        // $query->order_by('companies.id', 'asc');

        return $this->get_many_by($param);
    }

    public function get_contact_person_all()
    {
        $query = $this->db;
        $query->select('account_contact_persons.*');
        $query->order_by('last_name', 'asc');

        return $this->get_all();
    }
}
