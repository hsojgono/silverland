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

class Employee_hdmfs extends MY_Controller {

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
			'page_header' => 'HDMF Contributions',
            'active_menu' => $this->active_menu,
            'companies' => $companies,
            'year' => $year
		);
		$this->load_view('pages/employee-hdmf-lists');
    }

    public function view()
    {   
        $user = $this->ion_auth->user()->row();
        $post = $this->input->post();

        $year = $post['year'];
        $month = $post['month'];
        $company_id = $post['company_id'];

        $companies = $this->company_model->get_many_company_by(['active_status' => 1]);
        $hdmfs = $this->payroll_employee_model->get_employee_hdmfs('get_many_by', [
            'YEAR(end_date) =' => $year,
            'MONTH(end_date) =' => $month,
            'payroll_employees.company_id' => $company_id
        ]); 

        $this->data = array(
            'page_header' => 'HDMF Contributions',
            'hdmfs' => $hdmfs,
            'companies' => $companies,
            'year' => $year,
			'active_menu' => $this->active_menu
        );
        
        $this->load_view('pages/employee-hdmf-lists');
    }

    public function export()
    {
        $user = $this->ion_auth->user()->row();
        $post = $this->input->post();

        $year = $post['year'];
        $month = $post['month'];
        $company_id = $post['company_id'];
        $m = date('F', mktime(0, 0, 0, $month, 10));
        
        $hdmfs = $this->payroll_employee_model->get_employee_hdmfs('get_many_by', [
            'YEAR(end_date) =' => $year,
            'MONTH(end_date) =' => $month,
            'payroll_employees.company_id' => $company_id
        ]); 

        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

        $data_php = new PHPExcel();
        $data_php->setActiveSheetIndex(0);
        $data_php->getActiveSheet()->setTitle('Employee HDMFs; ' . $m. ' ' .$year)->mergeCells('A1:E1');
        $data_php->getActiveSheet()->setTitle('Employee HDMFs; ' . $m. ' ' .$year)->mergeCells('A2:E2');
        
        $data_php->getActiveSheet()->getCell('A1')->setValue($hdmfs[0]['company_name']);
        $data_php->getActiveSheet()->getCell('A2')->setValue('LIST OF EMPLOYEE HDMF CONTRIBUTION AS OF '.strtoupper($m). ' '.$year);
        
        $data_php->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $data_php->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        // $data_php->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        
        $data_php->getActiveSheet()->getStyle("A1:E1")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A1:E1")->getFont()->setSize(12);

        $data_php->getActiveSheet()->getStyle("A2:E2")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A2:E2")->getFont()->setSize(12);
        
        $data_php->getActiveSheet()->getStyle("A4:E4")->applyFromArray(array("font" => array("bold" => true)));
        $data_php->getActiveSheet()->getStyle("A4:E4")->getFont()->getColor()->setRGB('ffffff');
        $data_php->getActiveSheet()->getStyle("A4:E4")->getFont()->setSize(12);

        //this is for title
        $data_php->getActiveSheet()->getStyle('A1:E1')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );        
        $data_php->getActiveSheet()->getStyle('A2:E2')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            )
        );

        $data_php->getActiveSheet()->getStyle('A4:E4')->applyFromArray(
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
        $data_php->getActiveSheet()->setCellValue('B4', 'HDMF NUMBER');
        $data_php->getActiveSheet()->setCellValue('C4', 'EMPLOYEE SHARE');
        $data_php->getActiveSheet()->setCellValue('D4', 'EMPLOYER SHARE');
        $data_php->getActiveSheet()->setCellValue('E4', 'TOTAL CONTRIBUTION');

        $row = 5;
        $total_hdmf_employee = 0;
        $total_hdmf_employer = 0;
        $total_hdmf_amount = 0;

        foreach ($hdmfs as $key => $hdmf) 
        {
            $data_php->getActiveSheet()->setCellValue('A'.$row, $hdmf['full_name']);
            $data_php->getActiveSheet()->setCellValue('B'.$row, $hdmf['hdmf']);
            $data_php->getActiveSheet()->setCellValue('C'.$row, $hdmf['hdmf_employee']);
            $data_php->getActiveSheet()->setCellValue('D'.$row, $hdmf['hdmf_employer']);
            $data_php->getActiveSheet()->setCellValue('E'.$row, $hdmf['hdmf_amount']);

            $row++;

            $data_php->getActiveSheet()->setCellValue('B'.$row, 'GRAND TOTAL: ');
            $data_php->getActiveSheet()->setCellValue('C'.$row, $total_hdmf_employee+=$hdmf['hdmf_employee']);
            $data_php->getActiveSheet()->setCellValue('D'.$row, $total_hdmf_employer+=$hdmf['hdmf_employer']);
            $data_php->getActiveSheet()->setCellValue('E'.$row, $total_hdmf_amount+=$hdmf['hdmf_amount']);
        }

        $date_exported = $m.'_'.$year;

        $filename = $hdmfs[0]['short_name'] .'_Employee_HDMFs_' .$date_exported.'.xlsx';
              
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
