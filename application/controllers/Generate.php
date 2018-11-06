<?php
// this is a dummy controller so please don't use it if you don't know the use of this controller
class Generate extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->data['page_header'] = 'Employee Hierarchy';
        $this->load_view('pages/employee-hierarchy');
    }

    public function ajax_sample()
    {
        $this->load->model('employee_information_model');
        
        $new_data = $this->employee_information_model->get_employee_hierarchy_data();

        echo json_encode(array('data' => $new_data, 'message' => 'The quick brown fox jumps over the lazy dog.'));
    }
}