<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cookies extends CI_Controller {

    public function index() {
        session_start();
    }

    public function multipleCookies() {
        $this->load->helper('cookie');
        set_cookie('cookie_1', '1', 60);
        set_cookie('cookie_2', '2', 60);
    }

}
