<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function index() {
		$this->load->helper('url');
		echo anchor('history/next', 'Next');
	}

	public function next() {
		echo 'This is next.';
	}

}
