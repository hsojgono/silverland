<?php


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        August 2, 2017
 */
class Country_model extends MY_Model
{
    protected $_table = 'countries';
    protected $primary_key = 'id';
    protected $return_type = 'array';
}

// End of file Country_model.php
// Location: ./application/models/Country_model.php
