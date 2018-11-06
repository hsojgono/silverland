<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @author	SMTI-CKSagun
 */
class Thirteenth_month extends MY_Controller {
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function index()
    {
        // code here...
        
        $this->data = array();

        $this->data['page_header'] = '13th Month';

        $this->load_view('pages/thirteenth-month-index');
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function list()
    {
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function details()
    {
        $object_id = $this->uri->segment(3);
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function add()
    {
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function confirmation()
    {
        $object_id = $this->uri->segment(3);
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function edit()
    {
        $object_id = $this->uri->segment(3);
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function activate()
    {
        $object_id = $this->uri->segment(3);
        // code here...
    }
 
    /**
     * Some description here
     * 
     * @author	SMTI-CKSagun
     * @param
     * @return
     */
    function deactivate()
    {
        $object_id = $this->uri->segment(3);
        // code here...
    }
}
// End of file Thirteenth_month.php
// Location: ./application/controller/Thirteenth_month.php