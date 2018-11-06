<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Some class description here
 * 
 * @package	    package
 * @category	category
 * @author	    SMTI-CKSagun
 */
class Navigation {

    private $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    public function render_menu()
    {
        $this->ci->load->model('system_module_model');
        $this->ci->load->model('system_function_model');
        
        $module_items = $this->ci->system_module_model->get_all();
        dump($this->ci->db->last_query());
        // $menu_with_parent = $this->ci->system_function_model->get_with_parent();
        $function_items = $this->ci->system_function_model->get_many_by(['function_level' => 0]);

        $temp_array = array();
        $subs = array();

        foreach ($module_items as $module_item) {

            foreach ($function_items as $function_item) {
                if ($module_item['id'] === $function_item['system_module_id']) {
                    $subs[] = $function_item['name'];

                    $temp_array[] = array(
                        'parent_id' => $module_item['id'],
                        'subs' => $subs
                    );
                }
                
            }

            
        }
        dump($temp_array);exit;
        // dump($module_items);
        // dump($menu_items);

		// return bootstrap_menu($menu_items);
    }
}
// End of file Navigation.php
// Location: ./application/libraries/Navigation.php