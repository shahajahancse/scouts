<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends Backend_Controller {

	public function __construct(){
		parent::__construct();	
	}

    
	public function index(){

        $this->data['meta_title'] = 'Regions';
        $this->data['subview'] = 'index';
        $this->load->view('login/_layout_main', $this->data);
    }


}
