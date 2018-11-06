<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      cristhian.sagun@systemantech.com
 * @link        http://systemantech.com
 */
class Home extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->data = array(
			'page_header' => 'Home',
			'active_menu' => 'home',
		);

		$menu = array(
			'dashboard' => array(
				'label' => 'Dashboard',
				'link' => 'admin/dashboard',
				'iconclass' => 'fa fa-home',
				'attributes' => 'class="hellow-atts"',
				'access' => array('ADMINISTRATOR','COMPANY ADMINISTRATOR', 'BRANCH ADMINISTRATOR')
			),
			'employee' => array(
				'label' => 'Employee',
				'link' => 'admin/hr',        
				'iconclass' => false,
				'access' => array('ADMINISTRATOR','COMPANY ADMINISTRATOR'),
				'sub' => array(
					'manage' => array('label' => 'Manage All'),
					'add_new' => array('label' => 'Add New'),
					'access' => array('ADMINISTRATOR','COMPANY ADMINISTRATOR'),
				),
			),
			'links' => array(
				'label' => 'Recommended Links',
				'iconclass' => 'fa fa-th',
				'access' => array('ADMINISTRATOR'),
			),    
			'contact' => array(
				'label' => 'Contact Us',
				'access' => array('ADMINISTRATOR'),
			),
			'part' => array('label' => '', 'divider' => true, 'link' => '#'),
		);

		$this->data['menu'] = $menu;

		$this->load_view('pages/home');
	}

}
