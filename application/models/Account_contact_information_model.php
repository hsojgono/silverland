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
class Account_contact_information_model extends MY_Model 
{
    protected $_table      = 'account_contact_information';
    protected $primary_key = 'id';
    protected $return_type = 'array';

    /**
     * Callbacks or Observers
     */
    // protected $before_create = ['generate_date_created_status'];
    // protected $after_get     = ['set_default_data'];

    
}