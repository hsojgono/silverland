<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH.'/libraries/REST_Controller.php';

/**
 * Some class description here...
 *
 * @package     KAWANI
 * @subpackage  subpackage
 * @category    category
 * @author      joseph.gono@systemantech.com
 * @link        http://systemantech.com
 */
class Acl extends REST_Controller {

    /**
    * Some description here
    *
    * @param       param
    * @return      return
    */

    function __construct()
    {
        parent::__construct();
        $this->load->library('ACL');
    }

    public function index_get()
    {
		// $http_code = REST_Controller::HTTP_OK;
		// $response  = [
		// 	[
		// 		'name'	=> '',
		// 		'icon'	=> '',
		// 		'state'	=> '',
		// 		'menus'	=> []
		// 	]
		// ];
		// $this->response($response, $http_code);

		$this->acl->generate();
    }
}
