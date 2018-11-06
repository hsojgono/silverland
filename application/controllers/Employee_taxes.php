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

class Employee_taxes extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
            'payroll_employee_model',
            'company_model'
        ]);
	}

	function index()
	{
        $companies = $this->company_model->get_many_company_by(['active_status' => 1]);
        $year = date('Y', strtotime(date('Ymd')));     

		$this->data = array(
            'page_header' => 'Employee Tax Management',
			'active_menu' => $this->active_menu,
            'companies' => $companies,
            'year' => $year
		);
		$this->load_view('pages/employee-tax-lists');
    }

    public function view()
    {   
        $user = $this->ion_auth->user()->row();
        $post = $this->input->post();

        $year = $post['year'];
        $month = $post['month'];
        $company_id = $post['company_id'];

        $companies = $this->company_model->get_many_company_by(['active_status' => 1]);
        $taxes = $this->payroll_employee_model->get_employee_taxes('get_many_by', [
            'YEAR(end_date) =' => $year,
            'MONTH(end_date) =' => $month,
            'payroll_employees.company_id' => $company_id
        ]); 

        $this->data = array(
            'page_header' => 'Employee Tax Management',
			'active_menu' => $this->active_menu,
            'taxes' => $taxes,
            'companies' => $companies,
            'year' => $year
        );

        $this->load_view('pages/employee-tax-lists');
    }

    public function export()
    {
        $user = $this->ion_auth->user()->row();
        $post = $this->input->post();

        $year = $post['year'];
        $month = $post['month'];
        $company_id = $post['company_id'];
        $m = date('F', mktime(0, 0, 0, $month, 10));
        
        $taxes = $this->payroll_employee_model->get_employee_govt_contribution('get_many_by', [ 
            'YEAR(end_date) =' => $year,
            'MONTH(end_date) =' => $month,
            'payroll_employees.company_id' => $company_id       
        ]); 

        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

        $data_php = new PHPExcel();
        $data_php->setActiveSheetIndex(0);
        $data_php->getActiveSheet()->setTitle('Employee Taxes; ' . $m. ' ' .$year)->mergeCells('A1:D1');
        $data_php->getActiveSheet()->setTitle('Employee Taxes; ' . $m. ' ' .$year)->mergeCells('A2:D2');

        $data_php->getActiveSheet()->getCell('A1')->setValue($taxes[0]['company_name']);
        $data_php->getActiveSheet()->getCell('A2')->setValue('LIST OF EMPLOYEE TAXES AS OF '.strtoupper($m). ' '.$year);
        
        $data_php->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        
        $data_php->getActiveSheet()->getStyle("A1:D1")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A1:D1")->getFont()->setSize(12);

        $data_php->getActiveSheet()->getStyle("A2:D2")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A2:D2")->getFont()->setSize(12);
        
        $data_php->getActiveSheet()->getStyle("A4:D4")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A4:D4")->getFont()->getColor()->setRGB('ffffff');
        $data_php->getActiveSheet()->getStyle("A4:D4")->getFont()->setSize(12);

        //this is for title
        $data_php->getActiveSheet()->getStyle('A1:D1')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );        
        $data_php->getActiveSheet()->getStyle('A2:D2')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );

        $data_php->getActiveSheet()->getStyle('A4:D4')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '83b32f')
                ),

                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );


        $data_php->getActiveSheet()->setCellValue('A4', 'EMPLOYEE');
        $data_php->getActiveSheet()->setCellValue('B4', 'TIN');
        $data_php->getActiveSheet()->setCellValue('C4', 'TAX');
        $data_php->getActiveSheet()->setCellValue('D4', 'TAX YTD');

        $row = 5;
        $total_tax = 0;
        $total_tax_ytd = 0;

        foreach ($taxes as $key => $tax) 
        {
            $data_php->getActiveSheet()->setCellValue('A'.$row, $tax['full_name']);
            $data_php->getActiveSheet()->setCellValue('B'.$row, $tax['tin']);
            $data_php->getActiveSheet()->setCellValue('C'.$row, $tax['tax']);
            $data_php->getActiveSheet()->setCellValue('D'.$row, $tax['tax_ytd']);

            $row++;

            $data_php->getActiveSheet()->setCellValue('B'.$row, 'GRAND TOTAL: ');
            $data_php->getActiveSheet()->setCellValue('C'.$row, $total_tax+=$tax['tax']);
            $data_php->getActiveSheet()->setCellValue('D'.$row, $total_sum+=$tax['tax_ytd']);
        }

        $date_exported = $m.'_'.$year;

        $filename = $taxes[0]['short_name'] . '_Employee_Taxes_' .$date_exported.'.xlsx';
              
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($data_php, 'Excel2007');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function load()
    {
        $post = $this->input->post();

        if ($post['myButton'] == 'View') {
            $this->view($post);
        }

        if ($post['myButton'] == 'Export') {
            $this->export($post);
        }
    }
}
