<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function get() {
		var_dump($_GET);
	}

	public function post() {
		var_dump($_POST);
	}

	public function jsonResponse() {
		echo json_encode(['error' => true, 'error_message' => 'Like it did happen.']);
	}

	public function secret() {
		if ($_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'admin') {
			header('WWW-Authenticate: Basic realm="Secret"');
			return;
		}

		echo 'You are authenticated!';
	}

}
