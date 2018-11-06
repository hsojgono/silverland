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
class Courses extends MY_Controller {

	private $active_menu = 'Administration';

	function __construct()
	{
		parent::__construct();
		$this->load->library('audit_trail');
		$this->load->model([
			'course_model',
			'educational_attainment_model'
		]);
	}

	function index()
	{
		$courses = $this->course_model->get_details('get_all', '');
		$educational_attainments = $this->educational_attainment_model->get_details('get_many_by', ['active_status' => 1]);

		$this->data = array(
			'page_header'             => 'Courses Management',
			'courses'                 => $courses,
			'educational_attainments' => $educational_attainments,
			'show_modal'              => FALSE,
			'active_menu'             => $this->active_menu
		);

		$this->load_view('pages/course-lists');
	}

	function add()
	{
		$courses = $this->course_model->get_details('get_all', ['active_status' => 1]);
		$educational_attainments = $this->educational_attainment_model->get_details('get_many_by', ['active_status' => 1]);

		$this->data = array(
			'page_header' => 'Courses Management',
			'educational_attainments' => $educational_attainments,
			'active_menu' => $this->active_menu,
		);

		$data = remove_unknown_field($this->input->post(), $this->form_validation->get_field_names('course_add'));

		$this->form_validation->set_data($data);

		if ($this->form_validation->run('course_add') == TRUE)
		{
			// $this->session->set_flashdata('log_parameters', [
			// 	'action_mode' => 0,
			// 	'perm_key' 	  => 'add_course',
			// 	'old_data'	  => NULL,
			// 	'new_data'    => $data
			// ]);

			$course_id = $this->course_model->insert($data);

			if ( ! $course_id) {
				$this->session->set_flashdata('failed', 'Failed to add new course.');
				redirect('courses');
			} else {
				$this->session->set_flashdata('success', 'Successfully added ' . $data['course']);
				redirect('courses');
			}
		}
		$this->load_view('forms/course-add');
	}

	function details($id)
	{
		$course = $this->course_model->get_by(['id' => $id]);

		$this->data = array(
			'page_header' => 'Courses Details',
			'course'      => $course,
			'active_menu' => $this->active_menu,
		);
		$this->load_view('pages/course-details');
	}

	function edit($id)
	{
		$course_id = $this->uri->segment(3);
		
		$course = $this->course_model->get_by(['id' => $course_id]);
		$courses = $this->course_model->get_details('get_all', ['education_courses.active_status' => 1]);
		$educational_attainments = $this->educational_attainment_model->get_details('get_many_by', ['active_status' => 1]);
		
		$this->data = array(
			'page_header'             => 'Courses Management',
			'course'                  => $course,
			'courses'                 => $courses,
			'course_id'               => $course_id,
			'educational_attainments' => $educational_attainments,
			'show_modal'              => TRUE,
			'modal_title'             => 'Update Course',
			'modal_file_path'         => 'modals/modal-edit-courses',
		);

		$post = $this->input->post();
		$data = remove_unknown_field($post, $this->form_validation->get_field_names('course_edit'));

		if (isset($post['save'])) {
			$update = $this->course_model->update($course_id, $data);

			if ($update) {
				$this->session->set_flashdata('success', 'Successfully updated ' . $course['course']);
				redirect('courses');
			} else {
				$this->session->set_flashdata('failed', 'Unable to update ' . $course['course']);
				redirect('courses');
			}
		}
		$this->load_view('pages/course-lists');
	}

    public function edit_confirmation($id)
    {
        $edit_course = $this->course_model->get_by(['id' => $id]);
        $data['edit_course'] = $edit_course;

        $this->load->view('modals/modal-update-course', $data);
    }

	public function confirmation()
	{
		$mode = $this->uri->segment(3);
		$course_id = $this->uri->segment(4);

        $edit_course = $this->course_model->get_by(['id' => $course_id]);
        $data['edit_course'] = $edit_course;
		
		$course = $this->course_model->get_by(['id' => $course_id]);

		$modal_message = "You're about to " . $mode . "<strong> " . $edit_course['course'] . "</strong>"; 

		$data = array(
			'url' 			=> 'courses/' . $mode . '/' . $course_id,
			'modal_title' 	=> ucfirst($mode),
			'modal_message' => $modal_message
		);
		$this->load->view('modals/modal-confirmation', $data);
	}  

	public function cancel()
	{
		redirect('courses');
	}  

    public function update_status($id)
    {
        $course_data = $this->course_model->get_by(['id' => $id]);
        $data['course_data'] = $course_data;

        $post = $this->input->post();

        if (isset($post['mode']))
        {
            $result = FALSE;

            if ($post['mode'] == 'Deactivate')
            {
				$old_data = 1;
				$new_data = 0;
                $result = $this->course_model->update($id, ['active_status' => 0]);
            }
            if ($post['mode'] == 'Activate')
            {
				$old_data = 0;
				$new_data = 1;
                $result = $this->course_model->update($id, ['active_status' => 1]);
            }

			$this->session->set_flashdata('log_parameters', [
				'action_mode' => 6,
				'perm_key'    => 'update_course_status',
				'old_data'    => $old_data,
				'new_data'    => $new_data
			]);

            if ($result)
            {
                 $this->session->set_flashdata('message', $course_data['name'].' successfully '.$post['mode'].'d!');
                 redirect('courses');
            }
            else
            {
                $this->session->set_flashdata('failed', 'Unable to '.$post['mode'].' '.$course_data['name'].'!');
                redirect('courses');
            }
        }
        else
        {
            $this->load->view('modals/modal-update-course-status', $data);
        }
    }
}
