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
class Departments extends MY_Controller {

    private $active_menu = 'Administration';

    /**
     * Some description here
     *
     * @param   param
     * @return  return
     */

    function __construct()
    {
        parent::__construct();
        $this->load->library('audit_trail');
        // $this->load->model(['employee_info_model']);
    }

    function index()
    {
        $departments = $this->department_model->get_department_all();

        $this->data = array(
            'page_header' => 'Department Management',
            'departments' => $departments,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/department-lists');
    }

    function add()
    {
        $user = $this->ion_auth->user()->row();
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches = $this->branch_model->get_many_by(['active_status' => 1]);
        $sites = $this->site_model->get_many_by(['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Departments Management',
            'active_menu' => $this->active_menu,
            'companies' => $companies,
            'branches' => $branches,
            'sites' => $sites
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('department_add') == TRUE)
        {
            $this->session->set_flashdata('log_parameters', [
                'action_mode' => 0,
                'perm_key' 	  => 'add_department',
                'old_data'	  => NULL,
                'new_data'    => $data
            ]);

            $department_id = $this->department_model->insert($data);

            if ( ! $department_id) {
                $this->session->set_flashdata('failed', 'Failed to add new department.');
                redirect('departments');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new department.');
                redirect('departments');
            }
        }


        $this->load_view('forms/department-add');
    }

    function edit($id)
    {
        // get specific department based on the id
        $department = $this->department_model->get_details('get_by', ['departments.id' => $id]);
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches = $this->branch_model->get_many_by(['active_status' => 1]);
        $sites = $this->site_model->get_many_by(['active_status' => 1]);

        // if ( ! $this->ion_auth_acl->has_permission('edit_department'))
		// {
		// 	$this->session->set_flashdata('failed', 'You have no permission to access this module');
		// 	redirect('/', 'refresh');
		// }

        $this->data = array(
            'page_header' => 'Department Management',
            'department' => $department,
            'companies' => $companies,
            'branches' => $branches,
            'sites' => $sites,
            'active_menu' => $this->active_menu,
        );

        // $departments = $this->department_model->get_department_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('department_add') == TRUE)
        {
            $this->session->set_flashdata('old_data', $department);

            $department_id = $this->department_model->update($id, $data);

            if ( ! $department_id) {
                $this->session->set_flashdata('failed', 'Failed to update department.');
                redirect('departments');
            } else {
                $this->session->set_flashdata('success', 'Department successfully updated!');
                redirect('departments');
            }
        }
        $this->load_view('forms/department-edit');
    }

    function details($id)
    {
        $department = $this->department_model->get_department_by(['departments.id' => $id]);
        $employee_infos = $this->employee_info_model->get_employee_info_data(['employee_information.department_id' => $id]);

        $this->data = array(
            'page_header' => 'Department Details',
            'department'      => $department,
            'employee_infos' => $employee_infos,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/department-details');
    }

    public function edit_confirmation($id)
    {
        $edit_department = $this->department_model->get_by(['id' => $id]);
        $data['edit_department'] = $edit_department;

        $this->load->view('modals/modal-update-department', $data);
    }

    public function update_status($id)
    {
        $department_data = $this->department_model->get_by(['id' => $id]);
        $data['department_data'] = $department_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                $result = $this->department_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
                $result = $this->department_model->update($id, ['active_status' => 1]);
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $department_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('departments');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$department_data['name'].'!');
                redirect('departments');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-department-status', $data);
        }
    }

    public function confirmation()
    {
        // $mode = $this->uri->segment(3);
        $mode = 'update';
		$department_id = $this->uri->segment(4);
		$department = $this->department_model->get_details('get_by', ['departments.id' => $department_id]);

		$modal_message = "You're about to <strong>" . $mode . "</strong>  " . $department['name']; 

		$data = array(
			'url' 			=> 'departments/update/' . $department_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message . '. Proceed?'
		);

		$this->load->view('modals/modal-confirmation', $data);
    }

    public function update($id)
    {
        $department = $this->department_model->get_details('get_by', ['departments.id' => $id]);
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches = $this->branch_model->get_many_by(['active_status' => 1]);
        $sites = $this->site_model->get_many_by(['active_status' => 1]);

        // if ( ! $this->ion_auth_acl->has_permission('edit_department'))
		// {
		// 	$this->session->set_flashdata('failed', 'You have no permission to access this module');
		// 	redirect('/', 'refresh');
		// }

        $this->data = array(
            'page_header' => 'Department Management',
            'department' => $department,
            'companies' => $companies,
            'branches' => $branches,
            'sites' => $sites,
            'active_menu' => $this->active_menu,
        );
         // $departments = $this->department_model->get_department_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('department_add'));

        dump($data);exit;

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('department_add') == TRUE)
        {
            $this->session->set_flashdata('old_data', $department);

            $department_id = $this->department_model->update($id, $data);

            if ( ! $department_id) {
                $this->session->set_flashdata('failed', 'Failed to update department.');
                redirect('departments');
            } else {
                $this->session->set_flashdata('success', 'Department successfully updated!');
                redirect('departments');
            }
        }
    }
}
