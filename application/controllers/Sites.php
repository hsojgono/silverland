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
class Sites extends MY_Controller {

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
        $this->load->model([
            'employee_info_model',
            'location_model'
        ]);
    }

    function index()
    {
        $sites = $this->site_model->get_site_all();

        $this->data = array(
            'page_header' => 'Site Management',
            'sites'    => $sites,
            'active_menu' => $this->active_menu,
        );
        $this->load_view('pages/site-lists');
    }

    function add()
    {
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches = $this->branch_model->get_many_by(['active_status' => 1]);

        $this->data = array(
            'page_header' => 'Sites Management',
            'companies'   => $companies,
            'branches'   => $branches,
            'active_menu' => $this->active_menu,
        );

        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('site_add'));

        $this->form_validation->set_data($data);

        if ($this->form_validation->run('site_add') == TRUE)
        {
            $site_id = $this->site_model->insert($data);

            if ( ! $site_id) {

                $this->session->set_flashdata('failed', 'Failed to add new site.');
                redirect('sites');
            } else {
                $this->session->set_flashdata('success', 'Successfully added new site.');
                redirect('sites');
            }
        }

        $this->load_view('forms/site-add');
    }

    function edit($id)
    {
        // get specific site based on the id
        $site      = $this->site_model->get_site_by(['sites.id' => $id]);
        $companies = $this->company_model->get_many_by(['active_status' => 1]);
        $branches  = $this->branch_model->get_many_by(['active_status' => 1]);
        // dump($site);exit;
        // get all company records where status is equal to active
        //$companies = $this->company_model->get_many_by(['active_status' => 1]);
        // dump($this->db->last_query());exit;

        if ( ! $this->ion_auth_acl->has_permission('edit_department'))
		{
			$this->session->set_flashdata('failed', 'You have no permission to access this module');
			redirect('/', 'refresh');
		}

        $this->data = array(
            'page_header' => 'Site Management',
            'site'        => $site,
            'companies'   => $companies,
            'branches'    => $branches,
            'active_menu' => $this->active_menu,
        );

        // $sites = $this->site_model->get_site_all();
        $data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('site_add'));

        $this->form_validation->set_data($data);
        // dump($data);exit();

        if ($this->form_validation->run('site_add') == TRUE)
        {
            //update to audti trail
            $this->session->set_flashdata('old_data', $site);

            //update to site table
            $site_id = $this->site_model->update($id, $data);

            if ( ! $site_id) {
                $this->session->set_flashdata('failed', 'Failed to update site.');
                redirect('sites');
            } else {
                $this->session->set_flashdata('success', 'Site successfully updated!');
                redirect('sites');
            }
        }
        $this->load_view('forms/site-edit');
    }

    public function details($id)
    {
        $site  = $this->site_model->get_site_by(['sites.id' => $id]);
        $sites = $this->site_model->get_site_employees();
        // $locations  = $this->location_model->get_locations();

        // dump($site);exit;

        $this->data = array(
            'page_header' => 'Site Details',
            'site'        => $site,
            'sites'       => $sites,
            'active_menu' => $this->active_menu,
        );
        // dump($sites);exit;
        $this->load_view('pages/site-details');
    }

    public function edit_confirmation($id)
    {
        $edit_site = $this->site_model->get_by(['id' => $id]);
        $data['edit_site'] = $edit_site;

        $this->load->view('modals/modal-update-site', $data);
    }

    public function update_status($id)
    {
        $site_data = $this->site_model->get_by(['id' => $id]);
        $data['site_data'] = $site_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
                dump('De-activating...');
                $result = $this->site_model->update($id, ['active_status' => 0]);
                dump($this->db->last_query());
            }
            if ($post['mode'] == 'Activate')
            {
                dump('Activating...');
                $result = $this->site_model->update($id, ['active_status' => 1]);
                dump($this->db->last_query());
            }

            if ($result)
            {
                 $this->session->set_flashdata('message', $site_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('sites');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$site_data['name'].'!');
                redirect('sites');
            }

        }
        else
        {
            $this->load->view('modals/modal-update-site-status', $data);
        }
    }
}
