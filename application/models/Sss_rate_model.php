<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Sss_rate_model extends MY_Model
{
	protected $_table = 'sss_rates';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');

	protected function prepare_data($tax_rate)
	{
		if ( ! isset($tax_rate)) return FALSE;
		
		$tax_rate['sr_status_label']  = ($tax_rate['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$tax_rate['sr_status_action'] = ($tax_rate['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$tax_rate['sr_status_icon']   = ($tax_rate['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$tax_rate['sr_status_url']    = ($tax_rate['active_status'] == 1) ? 'deactivate' : 'activate';

		return $tax_rate;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					sss_rates.id as sss_rate_id,
					sss_rates.sss_matrix_id as sr_sss_matrix_id,
					sss_rates.minimum_range as sr_minimum_range,
					sss_rates.maximum_range as sr_maximum_range,
					sss_rates.monthly_salary_base as sr_monthly_salary_base,
					sss_rates.employer_share as sr_employer_share,
					sss_rates.employee_share as sr_employee_share,
					sss_rates.total as sr_total,
					sss_rates.active_status
				')
				->join('sss_matrix', 'sss_rates.sss_matrix_id = sss_matrix.id', 'left');

		return $this->{$method}($where);
	}

}

// End of file Sss_rate_model.php
// Location: ./application/models/Sss_rate_model.php