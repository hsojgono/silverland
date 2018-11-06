<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_employee_model extends MY_Model
{
	protected $_table = 'payroll_employees';
	protected $primary_key = 'id';
	protected $return_type = 'array';
	
    protected $after_get = ['set_default_data'];

    protected $before_create = array('prep_data_before_create');

    protected function prep_data_before_create($payroll_employee)
    {
        $payroll_employee['created'] = date('Y-m-d H:i:s');
        $payroll_employee['created_by'] = $this->ion_auth->user()->row()->id;
        return $payroll_employee;
    }

    protected function set_default_data($payroll)
    {   
		if ( ! isset($payroll)) {
            return FALSE;
        }

        if (isset($payroll['first_name']) && isset($payroll['middle_name']) && $payroll['last_name']) {
            $middle_name              = ( ! empty($payroll['middle_name'])) ? $payroll['middle_name'] : '';
            $full_name                = $payroll['last_name'].', '.$payroll['first_name'].' '.$middle_name;
            $payroll['full_name']    = strtoupper($full_name);
        }

        if (isset($payroll['cutoff'])) {

            switch ($payroll['cutoff']) {

                case 1:
                    $payroll['cut_off'] = 'First Period';
                    break;

                case 2:
                    $payroll['cut_off'] = 'Second Period';
                    break;

                case 3:
                    $payroll['cut_off'] = '13th Month Pay';
                    break;

                case 4:
                    $payroll['cut_off'] = 'Leave Conversion';
                    break;

                case 5:
                    $payroll['cut_off'] = 'Daily Workers';
                    break;

                case 6:
                    $payroll['cut_off'] = 'Other Pay Out';
                    break;

                case 7:
                    $payroll['cut_off'] = 'Annualization';
                    break;
            }
        }
        return $payroll;

    }

	public function get_details($method, $where)
    {
        $this->db->select('
            payroll_employees.*, 
            payroll_employees.salary as current_salary,
            payroll_employees.salary_ytd as salary_ytd,
            payroll_employees.sss as current_sss,
            payroll_employees.sss_ytd as sss_ytd,
            payroll_employees.phic as current_phic,
            payroll_employees.phic_ytd as phic_ytd,
            payroll_employees.hdmf as current_hdmf,
            payroll_employees.hdmf_ytd as hdmf_ytd,
            payroll_employees.tax as current_tax,
            payroll_employees.tax_ytd as tax_ytd,
            payroll_employees.deductions as current_deductions,
            payroll_employees.deductions_ytd as deductions_ytd,
            payroll_employees.net_pay as current_net_pay,
            payroll_employees.net_pay_ytd as net_pay_ytd,
            payroll_employees.gross as current_gross,
            payroll_employees.gross_ytd as gross_ytd,
            payroll_employees.tardy_hours as tardy_hours,
            payroll_employees.tardy_deduction as tardy_deduction,
            payroll_employees.tardy_deductions_ytd as tardy_deductions_ytd,
            payroll_employees.unpaid_leave_days as unpaid_leave_days,
            payroll_employees.unpaid_leave_deduction as unpaid_leave_deduction,
            payroll_employees.unpaid_leave_deduction_ytd as unpaid_leave_deduction_ytd,
            companies.name as company_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            payroll.id as payroll_id,
            payroll.start_date as start_date,
            payroll.end_date as end_date,
            employees.employee_code as employee_code,
            payroll.cutoff as cutoff
        ')
            
        ->join('companies', 'payroll_employees.company_id=companies.id', 'left')
        ->join('employees', 'payroll_employees.employee_id=employees.id','left')
        ->join('payroll', 'payroll.id=payroll_employees.payroll_id','left');
        return $this->{$method}($where);
    }

    public function get_payslips()
    {
        $payslip_data = array();

        $company_id = $this->ion_auth->user()->row()->company_id;

        if ($company_id) {
            $this->db->where('company_id', $company_id);
        }

        $employee_query = $this->db->select('*')->from('employees')->get();

        $employees = $employee_query->result_array();

        foreach ($employees as $key => $employee) {
            
            $payslips = $this->get_details('get_many_by', [
                'payroll_employees.employee_id' => $employee['id']
            ]);

            $payslip_data[] = array(
                'details'  => $employee,
                'payslips' => $payslips
            );
        }
        return $payslip_data;
    }


    public function update_payroll_parameters($primary_id, $data)
    {
        $expected_input = array(
            'payroll_id'                                                => $data['payroll_id'],
            'employee_id'                                               => $data['employee_id'],
            'overtime_pay'                                              => $data['overtime_pay'],
            'overtime_night_differential_pay'                           => $data['overtime_night_differential_pay'],
            'night_differential_pay'                                    => $data['night_differential_pay'],
            'holiday_regular_pay'                                       => $data['holiday_regular_pay'],
            'holiday_regular_night_differential_pay'                    => $data['holiday_regular_night_differential_pay'],
            'holiday_regular_overtime_pay'                              => $data['holiday_regular_overtime_pay'],
            'holiday_regular_overtime_night_differential_pay'           => $data['holiday_regular_overtime_night_differential_pay'],
            'holiday_special_pay'                                       => $data['holiday_special_pay'],
            'holiday_special_night_differential_pay'                    => $data['holiday_special_night_differential_pay'],
            'holiday_special_overtime_pay'                              => $data['holiday_special_overtime_pay'],
            'holiday_special_overtime_night_differential_pay'           => $data['holiday_special_overtime_night_differential_pay'],
            'rest_day_pay'                                              => $data['rest_day_pay'],
            'rest_day_overtime_pay'                                     => $data['rest_day_overtime_pay'],
            'rest_day_overtime_night_differential_pay'                  => $data['rest_day_overtime_night_differential_pay'],
            'rest_day_holiday_regular_pay'                              => $data['rest_day_holiday_regular_pay'],
            'rest_day_holiday_regular_night_differential_pay'           => $data['rest_day_holiday_regular_night_differential_pay'],
            'rest_day_holiday_regular_overtime_night_differential_pay'  => $data['rest_day_holiday_regular_overtime_night_differential_pay'],
            'rest_day_holiday_regular_overtime_pay'                     => $data['rest_day_holiday_regular_overtime_pay'],
            'rest_day_night_differential_pay'                           => $data['rest_day_night_differential_pay'],
            'undertime_deduction'                                       => $data['undertime_deduction'],
            'tardy_deduction'                                           => $data['tardy_deduction'],
            'gross'                                                     => $data['employee_gross_salary'],
            'hdmf'                                                      => $data['employee_shares']['hdmf'],
            'phic'                                                      => $data['employee_shares']['phic'],
            'sss'                                                       => $data['employee_shares']['sss'],
            'tax'                                                       => $data['payroll_employee_tax'],
            'unpaid_leave_deduction'                                    => $data['unpaid_leave_deduction'],
            'taxable_benefits'                                          => $data['payroll_employee_taxable_benefits'],
            'benefits'                                                  => $data['payroll_employee_benefits_amount'],
            'salary'                                                    => $data['salary'],
            'gross_taxable_income'                                      => $data['gross_taxable_income'],
            'net_pay'                                                   => $data['net_pay'],
            'deductions'                                                => $data['deductions']
        );

        return $this->update($primary_id, $expected_input);
    }

    public function get_employee_govt_contribution($method, $where)
    {
        $this->db->select('
            payroll_employees.*,
            companies.name as company_name,
            companies.short_name as short_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_government_id_numbers.tin as tin,
            payroll_employees.tax as tax,
            payroll_employees.tax_ytd as tax_ytd,
            payroll.start_date as start_date,
            payroll.end_date as end_date,
            employee_government_id_numbers.sss as sss,
            employee_government_id_numbers.hdmf as hdmf,
            employee_government_id_numbers.phic as phic,
            payroll_employee_sss.amount_employee as sss_employee_share,
            payroll_employee_sss.amount_employer as sss_employer_share,
            payroll_employee_sss.amount_total as sss_total_contribution,
            payroll_employee_phics.amount_employee as phics_employee_share,
            payroll_employee_phics.amount_employer as phics_employer_share,
            payroll_employee_phics.amount_total as phics_total_contribution,
            payroll_employee_hdmfs.amount_employee as hdmf_employee_share,
            payroll_employee_hdmfs.amount_employer as hdmf_employer_share,
            payroll_employee_hdmfs.amount_total as hdmf_total_contribution,
        ')
        ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'LEFT')
        ->join('companies', 'companies.id = payroll_employees.company_id', 'LEFT')
        ->join('employees', 'employees.id = payroll_employees.employee_id', 'LEFT')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'LEFT')
        ->join('employee_government_id_numbers', 'employee_government_id_numbers.employee_id = employees.id', 'LEFT')
        ->join('payroll_employee_sss', 'payroll_employee_sss.payroll_employee_id = payroll_employees.id', 'LEFT')
        ->join('payroll_employee_phics', 'payroll_employee_phics.payroll_employee_id = payroll_employees.id', 'LEFT')
        ->join('payroll_employee_hdmfs', 'payroll_employee_hdmfs.payroll_employee_id = payroll_employees.id', 'LEFT')
        ->order_by('last_name', 'ASC');

        return $this->{$method}($where);
    }

    public function get_employee_phics($method, $where)
    {
         $this->db->select('
            payroll_employees.*,
            companies.name as company_name,
            companies.id as company_id,
            companies.short_name as short_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_government_id_numbers.phic as phic,
            payroll_employee_phics.amount_employee as phic_employee,
            payroll_employee_phics.amount_employer as phic_employer,
            payroll_employee_phics.amount_total as phic_amount,
            payroll.start_date as start_date,
            payroll.end_date as end_date
        ')
        ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'LEFT')
        ->join('companies', 'companies.id = payroll_employees.company_id', 'LEFT')
        ->join('employees', 'employees.id = payroll_employees.employee_id', 'LEFT')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'LEFT')
        ->join('employee_government_id_numbers', 'employee_government_id_numbers.id = employee_information.govt_numbers_id', 'LEFT')
        ->join('payroll_employee_phics', 'payroll_employee_phics.employee_id = payroll_employees.id', 'LEFT')
        ->order_by('last_name', 'ASC');
        
        return $this->{$method}($where);
    }

    public function get_employee_hdmfs($method, $where)
    {
         $this->db->select('
            payroll_employees.*,
            companies.name as company_name,
            companies.short_name as short_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_government_id_numbers.hdmf as hdmf,
            payroll_employee_hdmfs.amount_employee as hdmf_employee,
            payroll_employee_hdmfs.amount_employer as hdmf_employer,
            payroll_employee_hdmfs.amount_total as hdmf_amount,
            payroll.start_date as start_date,
            payroll.end_date as end_date
        ')
        ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'LEFT')
        ->join('companies', 'companies.id = payroll_employees.company_id', 'LEFT')
        ->join('employees', 'employees.id = payroll_employees.employee_id', 'LEFT')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'LEFT')
        ->join('employee_government_id_numbers', 'employee_government_id_numbers.id = employee_information.govt_numbers_id', 'LEFT')
        ->join('payroll_employee_hdmfs', 'payroll_employee_hdmfs.employee_id = payroll_employees.id', 'LEFT')
        ->order_by('last_name', 'ASC');
        
        return $this->{$method}($where);
    }
    public function get_payroll_employee_data($where = '')
    {
        if ( ! empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->select('
                    payroll_employees.*,
                    payroll_employees.id as payroll_employee_id,
                    employees.employee_code as employee_code,
                    CONCAT_WS(' . '" "' . ', employees.last_name,", " ,employees.first_name) as full_name,
                    payroll_employees.salary as basic_pay,
                    payroll_employees.holiday_regular_pay as holiday_regular_pay,
                    payroll_employees.holiday_special_pay as holiday_special_pay,
                    payroll_employees.undertime_deduction as undertime_deduction,
                    payroll_employees.sss as sss,
                    payroll_employees.phic as phic,
                    payroll_employees.hdmf as hdmf,
                    payroll_employees.tax as tax,
                    payroll_employees.deductions as deductions
                ')
                    
                ->from($this->_table)
                ->join('employees', 'employees.id = payroll_employees.employee_id', 'left')
                ->order_by('employees.employee_code', 'asc')
                ->get();

        return $query->result_array();
    }

    public function get_employee_sss($method, $where)
    {
         $this->db->select('
            payroll_employees.*,
            companies.name as company_name,
            companies.short_name as short_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_government_id_numbers.sss as sss,
            payroll_employee_sss.amount_employee as sss_employee,
            payroll_employee_sss.amount_employer as sss_employer,
            payroll_employee_sss.amount_total as sss_amount,
            payroll.start_date as start_date,
            payroll.end_date as end_date
        ')
        ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'LEFT')
        ->join('companies', 'companies.id = payroll_employees.company_id', 'LEFT')
        ->join('employees', 'employees.id = payroll_employees.employee_id', 'LEFT')
        ->join('employee_information', 'employee_information.employee_id = employees.id', 'LEFT')
        ->join('employee_government_id_numbers', 'employee_government_id_numbers.id = employee_information.govt_numbers_id', 'LEFT')
        ->join('payroll_employee_sss', 'payroll_employee_sss.employee_id = payroll_employees.id', 'LEFT')
        ->order_by('last_name', 'ASC');
        
        return $this->{$method}($where);
    }

    public function get_employee_taxes($method, $where)
    {
        $this->db->select('
            payroll_employees.*,
            companies.name as company_name,
            companies.short_name as short_name,
			employees.first_name as first_name,
			employees.middle_name as middle_name,
            employees.last_name as last_name,
            employee_government_id_numbers.tin as tin,
            payroll_employees.tax as tax,
            payroll_employees.tax_ytd as tax_ytd,
            payroll.start_date as start_date,
            payroll.end_date as end_date
        ')
            ->join('payroll', 'payroll.id = payroll_employees.payroll_id', 'LEFT')
            ->join('companies', 'companies.id = payroll_employees.company_id', 'LEFT')
            ->join('employees', 'employees.id = payroll_employees.employee_id', 'LEFT')
            ->join('employee_information', 'employee_information.employee_id = employees.id', 'LEFT')
            ->join('employee_government_id_numbers', 'employee_government_id_numbers.id = employee_information.govt_numbers_id', 'LEFT')
            ->order_by('last_name', 'ASC');

        return $this->{$method}($where);
    }
}

   

// End of file Payroll_employee_model.php
// Location: ./applicaiton/model/Payroll_employee_model.php