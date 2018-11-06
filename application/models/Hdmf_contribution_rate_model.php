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
class Hdmf_contribution_rate_model extends MY_Model
{
	protected $_table = 'hdmf_rates';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	protected $after_get = array('prepare_data');

	protected function prepare_data($hdmf_rate)
	{
		if ( ! isset($hdmf_rate)) return FALSE;
		
		$hdmf_rate['hr_status_label']  = ($hdmf_rate['active_status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
		$hdmf_rate['hr_status_action'] = ($hdmf_rate['active_status'] == 1) ? 'Deactivate' : 'Activate';
		$hdmf_rate['hr_status_icon']   = ($hdmf_rate['active_status'] == 1) ? 'fa-times text-red' : 'fa-check text-green';
		$hdmf_rate['hr_status_url']    = ($hdmf_rate['active_status'] == 1) ? 'deactivate' : 'activate';

		return $hdmf_rate;
	}

	public function get_details($method, $where)
	{
		$this->db->select('
					hdmf_rates.id as hdmf_rate_id,
					hdmf_rates.hdmf_matrix_id as hr_hdmf_matrix_id,
					hdmf_rates.minimum_range as hr_minimum_range,
					hdmf_rates.maximum_range as hr_maximum_range,
					hdmf_rates.employee_share as hr_employee_share,
					hdmf_rates.employer_share as hr_employer_share,
					hdmf_rates.ceiling,
					hdmf_rates.active_status
				')
				->join('hdmf_matrices', 'hdmf_rates.hdmf_matrix_id = hdmf_matrices.id', 'left');

		return $this->{$method}($where);
	}
}

// End of file Hdmf_contribution_rate_model.php
// Location: ./application/models/Hdmf_contribution_rate_model.php