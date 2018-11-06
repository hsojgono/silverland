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

	function generate_users_password()
	{
		$this->load->model('user_model');
		$this->load->model('employee_model');
		
		$users = $this->user_model->get_all();

		$unset_ids = array(1,2,3,4,5,6,7,8,9);

		$array_elements = array_column($users, 'id');

		$error_handler = array();

		foreach ($array_elements as $key => $user_id) {
			$in_array = in_array($user_id, $unset_ids);

			if ( ! $in_array) {
				$user_details = $this->ion_auth->user($user_id)->row();
				$employee_details = $this->employee_model->get_by(array('system_user_id' => $user_id));
				$employee_code = $employee_details['employee_code'];
				$last_name = ucwords(strtolower($employee_details['last_name']));

				
				$identity = $user_details->username;
				$old_password = 'password';
				$new_password = implode(array($last_name, $employee_code));

				$change = $this->ion_auth->change_password($identity, $old_password, $new_password);

				$error_handler[]['message'] = ($change) ? 'Success updated password username ' . $identity : 'Failed to update password of usernamed ' . $identity;
			}
		}

		dump($error_handler);
	}
}
