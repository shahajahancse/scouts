<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('Common_model');
		// $this->load->model('Shop_model');

		// print_r($this->session->all_userdata());
	}


	public function index(){
		//Load page
		$this->data['meta_title'] = 'Welcome to Scouts';
		$this->data['subview'] = 'index';
		$this->load->view('backend/_layout_main', $this->data);
	}

}
