<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 *
 */
class Template extends AnotherClass
{

    function __construct()
    {
        # code...
    }

    public function load_main_content()
    {
        if ($this->ion_auth->logged_in()) {
            # code...
        }
    }

    public function load_login_template()
    {

    }

    public function load_signup_template()
    {

    }

    public function load_forgot_password_template()
    {

    }
}
