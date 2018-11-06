<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      cristhiansagun@systemantech.com
 * @date        July 24, 2017
 */
class Relationship_model extends MY_Model
{
    protected $_table = 'relations';
    protected $primary_key = 'id';
    protected $return_type = 'array';
}

// End of file Relationship_model.php
// Location: ./application/models/Relationship_model.php
