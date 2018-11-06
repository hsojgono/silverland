<?php

/**
 *
 */
class Audit_trails extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('system_audit_trail_model');
    }

    public function index()
    {
        // if ( ! $this->ion_auth_acl->has_permission('audit_trails'))
        // {
        //     $this->session->set_flashdata('failed', 'Sorry you have no permission to access this page.');
        //     redirect('/', 'refresh');
        // }
        // dump(date('Y-m-d H:i:s'));exit;
        $audit_trails = $this->system_audit_trail_model->get_all();

        $this->data['page_header']  = 'Audit Trails';
        $this->data['audit_trails'] = $audit_trails;

        $this->load_view('pages/audit-trails-list');
    }
}
