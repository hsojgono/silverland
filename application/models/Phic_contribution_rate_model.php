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
class Phic_contribution_rate_model extends MY_Model
{
	protected $_table = 'phic_rates';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $before_create = array('set_date_before_create');
	protected $before_update = array('set_date_before_update');
	protected $after_get = array('prepare_data');

	protected function set_date_before_create($phic_rate)
	{
		$phic_rate['active_status'] = 1;
		$phic_rate['created'] = date('Y-m-d H:i:s');
		$phic_rate['created_by'] = $this->ion_auth->user()->row()->id;
		return $phic_rate;
	}

	protected function set_date_before_update($phic_rate)
	{
		$phic_rate['modified'] 	  = date('Y-m-d H:i:s');
		$phic_rate['modified_by'] = $this->ion_auth->user()->row()->id;
		return $phic_rate;
	}

	protected function prepare_data($phic_rate)
	{
		if ( ! isset($phic_rate)) return FALSE;
		
		$phic_rate['pr_status_label']  = ($phic_rate['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$phic_rate['pr_status_action'] = ($phic_rate['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$phic_rate['pr_status_icon']   = ($phic_rate['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$phic_rate['pr_status_url']    = ($phic_rate['active_status'] == 1) ? 'deactivate' : 'activate';

		return $phic_rate;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					phic_rates.id as phic_rate_id,
					phic_rates.phic_matrix_id as pr_phic_matrix_id,
					phic_rates.minimum_range as pr_minimum_range,
					phic_rates.maximum_range as pr_maximum_range,
					phic_rates.monthly_salary_base as pr_monthly_salary_base,
					phic_rates.employee_share as pr_employee_share,
					phic_rates.employer_share as pr_employer_share,
					phic_rates.total_monthly_premium as pr_total_monthly_premium,
					phic_rates.active_status
				')
				->join('phic_matrices', 'phic_rates.phic_matrix_id = phic_matrices.id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Phic_contribution_rate_model.php
// Location: ./application/models/Phic_contribution_rate_model.php