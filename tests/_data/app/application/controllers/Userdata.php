<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userdata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

	public function setUserdata() {
        $_SESSION['awsome_actor'] = $this->input->post('awsome_actor');
	}

    public function readUserdata() {
        echo json_encode($_SESSION);
    }

}
