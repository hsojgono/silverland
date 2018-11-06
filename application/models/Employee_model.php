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
class Employee_model extends MY_Model {

    protected $_table = 'employees';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    protected $before_create = ['generate_date_created_status'];
    protected $after_get     = ['set_default_data'];

    protected function generate_date_created_status($employee)
    {
        $employee['created'] = date('Y-m-d H:i:s');
        $employee['active_status'] = 1;
        $employee['created_by'] = $this->ion_auth->users()->row()->id;
        return $employee;
    }

    protected function set_default_data($employee)
    {
        if ( ! isset($employee)) {
            return FALSE;
        }
        $middle_name              = ( ! empty($employee['middle_name'])) ? $employee['middle_name'] : '';
        $full_name                = $employee['last_name'].', '.$employee['first_name'].' '.$middle_name;
        $employee['full_name']    = strtoupper($full_name);
        $employee['label_status'] = ($employee['active_status'] == 1) ? 'Active' : 'Inactive';

        return $employee;
    }

    public function get_employees($where = '')
    {
        $query = $this->db->select('
            employees.*,
            companies.name as company_name,
            employee_information.site_id as site_id,
            employee_information.reports_to as reports_to,
            employee_information.shift_schedule_id as shift_schedule_id
            ')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'left')
        ->join('companies', 'companies.id = employee_information.company_id', 'left')
        ->order_by('last_name', 'asc');

        return $this->get_many_by($where);
    }

    public function get_employee_by($param)
    {
        $query = $this->db->select('
            employees.*,
            companies.name as company_name
            ')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'left')
        ->join('companies', 'companies.id = employee_information.company_id', 'left');

        return $this->get_by($param);
    }

    public function get_many_employee_by($param)
    {
        $query = $this->db;
        $query->select('*');
        $query->order_by('last_name', 'asc');

        return $this->get_many_by($param);
    }

    public function get_employee_all()
    {
        $query = $this->db;

        $query->select('
            employees.id as employee_id,
            employees.employee_code,
            employees.first_name,
            employees.middle_name,
            employees.last_name,
            employees.active_status,
            companies.name as company_name
        ');
        $query->join('companies', 'employees.company_id = companies.id', 'left');

        $query->order_by('last_name', 'asc');

        return $this->get_all();
    }

    public function get_employee_data($from = 'employees', $where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->select('*')->from($from)->get();

        return $query->result_array();
    }

    /**
     * NOTE: This functions below is usjt temporary
     */

    public function get_employee_information($where)
    {
        if ( ! empty($where)) $this->db->where($where);

        $query = $this->db->select('*')->from('employee_information')->get();

        return $query->result_array();
    }

    public function get_employee_leave_credit($where = '')
    {
        if ( ! empty($where)) $this->db->where($where);

        $query = $this->db
                ->select('
                        employee_leave_credits.*,
                        employee_leave_credits.id AS elc_id,
                        employee_leave_credits.position_leave_credit_id AS elc_plc_id,
                        position_leave_credits.attendance_leave_type_id AS plc_alt_id,
                        position_leave_credits.credits AS elc_credit,
                        employee_leave_credits.balance AS elc_balance,
                        attendance_leave_types.name AS leave_type,
                        attendance_leave_types.*
                    ')
                ->from('employee_leave_credits')
                ->join('position_leave_credits', 'employee_leave_credits.position_leave_credit_id = position_leave_credits.id', 'left')
                ->join('attendance_leave_types', 'position_leave_credits.attendance_leave_type_id = attendance_leave_types.id', 'left');

        return $query->get()->result_array();
    }

    public function check_leave_balance($employee_id, $leave_type_id, $leave_request_days)
    {
        $leave_credit = $this->get_employee_leave_credit([
            'employee_leave_credits.employee_id'              => $employee_id,
            'position_leave_credits.attendance_leave_type_id' => $leave_type_id,
        ]);

        if ( ! isset($leave_credit)) return FALSE;

        $leave_credit = (isset($leave_credit[0]['elc_balance'])) ? $leave_credit[0]['elc_balance'] : 0;

        $balance_checker = $leave_request_days <= $leave_credit;

        return $balance_checker;
    }

    public function get_civil_status()
    {
        $query = $this->db
                    ->select('*')
                    ->from('civil_status')
                    ->where('active_status', 1)
                    ->get()
                    ->result_array();

        return $query;
    }

    public function create_account()
    {
        $post_data = $this->input->post();
        $system_message = array();

        // check if employee name is multiple then splice it and make it as one word
        $exploded_name = explode(' ', strtolower($post_data['first_name']));
        $first_name    = implode('', $exploded_name);

        // User account parameters
        $last_name = $post_data['last_name'];
        $identity  = $first_name.'.'.$last_name;
        $password  = $this->_generate_password();
        $email     = strtolower($this->input->post('email'));

        $additional_data = array(
            'first_name' => strtoupper($post_data['first_name']),
            'last_name'  => strtoupper($post_data['last_name']),
        );

        $group = array('7');

        $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $group);
        $this->db->set('default_status', 1)->where('system_user_id', $user_id)->update('system_users_groups');

        if ( ! $user_id) {
            $system_message[] = $this->ion_auth->errors();
        } 

        if ($user_id) {

            $employee_id = $this->employee_model->insert([
                'system_user_id' => $user_id,
                'first_name'     => strtoupper($post_data['first_name']),
                'last_name'      => strtoupper($post_data['last_name']),
            ]);
            
            $this->load->model('employee_information_model');

            $employee = $this->employee_information_model->insert([
                'employee_id' => $employee_id,
                'company_id' => $post_data['company_id']
            ]);

            $new_employee = $this->employee_model->get_latest_employee_code('get_by', [
           
                'employee_information.company_id' => $post_data['company_id']
            ]);
            
            $employee_code = $new_employee['employee_code'] + 1;

            $old_password = $password;
            $new_password = ucwords(strtolower($last_name)) . $employee_code;

            $change = $this->ion_auth->change_password($identity, $old_password, $new_password);

            $this->employee_model->update($employee_id, ['employees.employee_code' => $employee_code]);

            $system_message[] = $employee_id ? 'Success inserting data on Employee table.' : 'Unable to create employee data.';

            if ( ! $employee_id) {
                $this->session->set_flashdata('message', implode(' ', $system_message));
                redirect('employees');
            }

            if ( ! $this->user_account_update($user_id, $employee_id)) {
                $system_message[] = lang('unable_to_create_employee_account');
                $this->session->set_flashdata('message', implode(' ', $system_message));
                redirect('employees');
            }

            $this->load->model('benefit_model');
            $this->load->model('employee_salaries_model');
            $this->load->model('employee_benefits_model');
            $this->load->model('employee_positions_model');
     
            /*
                `kawani`.`employee_13th_month`,
                `kawani`.`employee_addresses`,
                `kawani`.`employee_attachments`,
                `kawani`.`employee_awards`,
                `kawani`.`employee_benefits`,
                `kawani`.`employee_certifications`,
                `kawani`.`employee_contacts`,
                `kawani`.`employee_deductions`,
                `kawani`.`employee_dependents`,
                `kawani`.`employee_educational_attainments`,
                `kawani`.`employee_emergency_contacts`,
                `kawani`.`employee_examinations`,
                `kawani`.`employee_government_id_numbers`,
                `kawani`.`employee_incentives`,
                `kawani`.`employee_information`,
                `kawani`.`employee_languages`,
                `kawani`.`employee_leave_credits`,
                `kawani`.`employee_parents`,
                `kawani`.`employee_positions`,
                `kawani`.`employee_salaries`,
                `kawani`.`employee_skills`,
                `kawani`.`employee_spouses`,
                `kawani`.`employee_trainings`,
                `kawani`.`employee_work_experiences`
            */

            $employee_position = array(
                'employee_id' => $employee_id,
                'position_id' => $post_data['position_id'],
                // TODO: 'company_id' => '',
                // TODO: 'branch_id' => '',
                // TODO: 'department_id' => '',
                // TODO: 'team_id' => '',
                // TODO: 'cost_center_id' => '',
                // TODO: 'site_id' => '',
                // TODO: 'date_started' => '',
                // TODO: 'date_ended' => '',
                // TODO: 'remarks' => '',
                'created'         => date('Y-m-d H:i:s'), 
                'created_by'      => $this->ion_auth->user()->row()->id, 
                'active_status'   => 1, 
            );

            if ($this->employee_positions_model->insert($employee_position)) {
                $system_message[] = 'New employee position record has been inserted in database.';
            } else {
                $system_message[] = 'Error creating record employee position on database.';
            }
            
            $employee_salary = array(
                // TODO: 'company_id' => '',
                // TODO: 'salary_matrix_id' => '',
                // TODO: 'salary_grade_id'  => '',
                'employee_id'      => $employee_id,
                'position_id'      => $post_data['position_id'],
                'monthly_salary'   => $post_data['monthly_salary'],
                'created'          => date('Y-m-d H:i:s'),
                'created_by'       => $this->ion_auth->user()->row()->id,
                'active_status'    => 1
            );

            if ($this->employee_salaries_model->insert($employee_salary)) {
                $system_message[] = 'New employee salary record has been inserted in database.';
            } else {
                $system_message[] = 'Error creating record employee salary on database.';
            }

            $employee_benefits = array();
            
            if ($post_data['benefit_ids'] > 0) {
                foreach ($post_data['benefit_ids'] as $benefit_id) {

                    // $benefit_detail = $this->benefit_model->get_by(array('id' => $benefit_id));

                    $employee_benefits[] = array(
                        // TODO: 'company_id'    => '', 
                        'employee_id'   => $employee_id,
                        'benefit_id'    => $benefit_id,
                        'position_id'   => $post_data['position_id'],
                        // 'amount'        => $benefit_detail['amount'],
                        'created_by'    => $this->ion_auth->user()->row()->id,
                        'created'       => date('Y-m-d H:i:s'),
                        'active_status' => 1
                    );
                }
            }
            
            //$employee_benefits = $this->employee_benefits_model->insert_many($employee_benefits);

            // $employee_info = $this->employee_information_model->insert([
            //     'company_id' => $post_data['company_id'],
            //     'employee_id' => $employee_id
            // ]);

            // $employee = $this->_get_latest_employee_code([
            //     'employees.id' => $employee_id,
            //     'employee_information.company_id' => $post_data['company_id']
            // ]);
            
            // $employee_code = int($employee['employee_code']) + 1;
            // $this->employee_model->update($employee_id, ['employee_code' => $employee_code]);        
   

            // if ( ! $employee_benefits) {
            //     $system_message[] = 'Error creating employee benefit with ID No.: ' . $benefit_id;
            // }

            $system_message[] = lang('successfully_created_employee_account');

        }

        $message = implode(' ', $system_message);

        return array('message' => $message, 'employee_id' => $employee_id);
        
    }

    protected function user_account_update($user_id, $employee_id)
    {
        return $this->db->where('id', $user_id)->update('system_users', ['employee_id' => $employee_id]);
    }

    private function _generate_password()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		for ($i = 0; $i < 15; $i++)
		{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}

		return implode($pass);
    }
    
    public function get_with_government_id_numbers($where = '')
    {
        if ( ! empty($where)) $this->db->where($where);

        $query = $this->db->select('
                employees.*,
                employee_government_id_numbers.tin as tin_number,
                employee_government_id_numbers.sss as sss_number,
                employee_government_id_numbers.hdmf as hdmf_number,
                employee_government_id_numbers.phic as phic_number
        ')
        // ->join('tax_exemption_status', 'employees.tax_exemption_status_id=tax_exemption_status.id', 'left')
        ->join('employee_government_id_numbers', 'employee_government_id_numbers.employee_id = employees.id', 'left');
        return $query->get()->result_array();
    }

    //     public function get_with_tax_exemption_status($where = '')
    // {
    //     if ( ! empty($where)) $this->db->where($where);

    //     $query = $this->db->select('
    //             employees.*,
    //             tax_exemption_status.tax_code as tax code
    //     ')
    //     ->join('tax_exemption_status', 'tax_exemption_status.id = employees.tax_exemption_status_id', 'left');
    //     return $query->get()->result_array();
    // }
    

    public function get_details_empployee($method, $where)
    {
        $this->db->select('
            employees.*,
            employees.id as employee_id,
            employees.employee_code as employee_code,
            positions.name as position_name,
            departments.name as department_name,
            companies.short_name as company_name,
            employee_information.company_id as company_id
        ')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'left')
        ->join('positions', 'employee_information.position_id = positions.id', 'left')
        ->join('departments', 'employee_information.department_id = departments.id', 'left')
        ->join('companies', 'employee_information.company_id = companies.id', 'left');
        return $this->{$method}($where);
    }

    public function get_latest_employee_code($method, $where)
    {
        $this->db->select('
                employees.*,
                employees.employee_code as employee_code,
                employee_information.company_id
        ')
        ->join('employee_information', 'employee_information.employee_id=employees.id', 'LEFT')
        ->order_by('employee_code', 'DESC');
        return $this->{$method}($where);
    }

    public function get_details($method, $where)
    {
        $this->db->select('*')
        ->order_by('last_name', 'asc');
        return $this->{$method}($where);
    }
}   
