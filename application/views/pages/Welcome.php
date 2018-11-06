<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		$this->load->view('welcome_message');
	}

	public function sendOB()
	{
		$this->load->library('email');

		$employee_id = 1;

		$this->load->model('employee_model');
		$employee_data = $this->employee_model->get_by(['id' => $employee_id]);

		$data = [
			'employee_data' => $employee_data,
			'ob_id' 		=> 1
		];

		$message = $this->load->view('layouts/ob.tpl.php', $data, true);

		$this->email->from('saguncristhiankevin@yahoo.com', 'Official Business Request - Kevin Sagun');
		$this->email->to('gono.josh@gmail.com');

		$this->email->subject('Official Business Request');
		$this->email->message($message);

		$this->email->send();
	}

	public function approve($ob_id)
	{
		var_dump('approve request');
		var_dump($ob_id);
	}

	public function disapprove($ob_id)
	{
		var_dump('disapprove request');
		var_dump($ob_id);
	}
}
