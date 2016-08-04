<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

	public function index() {
		$this->load->view('forms');
	}

	public function printSubmission() {
		echo json_encode([
			'post' => $_POST,
			'files' => $_FILES
		]);
	}

}
