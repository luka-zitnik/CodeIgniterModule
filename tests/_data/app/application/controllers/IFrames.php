<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IFrames extends CI_Controller {

	public function index() {
		$this->load->helper('url');
		echo '<iframe name="iframe" src="' . base_url('iframes/client') . '">';
	}

	public function client() {
		echo 'Client';
	}

}
