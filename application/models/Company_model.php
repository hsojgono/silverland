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
class Company_model extends MY_Model {

    protected $_table = 'companies';
    protected $primary_key = 'id';
    protected $return_type = 'array';
    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected $after_create = ['write_audit_trail'];
    protected $after_update = ['write_audit_trail'];

    protected function generate_date_created_status($company)
    {
        $company['created'] = date('Y-m-d H:i:s');
        $company['active_status'] = 1;
        $company['created_by'] = '0';
        return $company;
    }


    protected function set_default_data($company)
    {
        $company['status_label']  = ($company['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$company['status_action'] = ($company['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$company['status_icon'] = ($company['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
        $company['status_url']  = ($company['active_status'] == 1) ? 'deactivate' : 'activate';
        return $company; 
    }

    public function get_company_by($param)
    {
        $query = $this->db;
        $query->select('companies.*');
        $query->join('branches', 'branches.company_id = companies.id', 'left');
        $query->order_by('companies.name', 'asc');

        return $this->get_by($param);
    }
    public function get_many_company_by($param)
    {
        $query = $this->db;
        $query->select('
            companies.*,
            id as company_id,
            short_name as company_short_name
        ');
        $query->order_by('name', 'asc');
        return $this->get_many_by($param);
    }
    public function get_company_all()
    {
        $this->db->select('
            companies.*,
            company_addresses.unit_number as unit_number,
            company_addresses.floor_number as floor_number,
            company_addresses.building_number as building_number,
            company_addresses.building_name as building_name,
            company_addresses.block_number as block_number,
            company_addresses.lot_number as lot_number,
            company_addresses.street,
            locations.barangay as barangay,
			locations.city as city,
			locations.province as province
        ')
        ->join('company_addresses', 'company_addresses.company_id = companies.id', 'LEFT')
        ->join('locations', 'locations.id = company_addresses.location_id', 'LEFT');
         return $this->get_all();
    }

    public function get_details($method, $where)
    {
        $this->db->select('
            companies.*,
            company_addresses.unit_number as unit_number,
            company_addresses.floor_number as floor_number,
            company_addresses.building_number as building_number,
            company_addresses.building_name as building_name,
            company_addresses.block_number as block_number,
            company_addresses.lot_number as lot_number,
            company_addresses.street,
            locations.barangay as barangay,
			locations.city as city,
			locations.province as province
        ')
        ->join('company_addresses', 'company_addresses.company_id = companies.id', 'LEFT')
        ->join('locations', 'locations.id = company_addresses.location_id', 'LEFT');

        return $this->{$method}($where);
    }
}
