<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;		
        $this->data['module_title'] = 'Calendar';
        $this->load->model('Calendar_model');
    }

	public function index()
	{
        //Load page       
		$this->data['meta_title'] = 'Calendar';
		$this->data['subview'] = 'calendar';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	public function blank(){
		$this->data['page_heading'] = 'Blank Page';
		$this->data['subview'] = 'dashboard/blank';
    	$this->load->view('backend/_layout_main', $this->data);
	}	

}