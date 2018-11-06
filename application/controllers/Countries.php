<?php 

class Countries extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function show_list()
	{
		$this->load->model('country_model');
		$countries = $this->country_model->get_all();

		$this->load->view('pages/country-list', array('countries' => $countries));
	}

	public function save_data()
	{
		$data = $this->input->post();
		$this->load->model('country_model');
		$last_id = $this->country_model->insert($data);
		print_r($last_id);
	}
}