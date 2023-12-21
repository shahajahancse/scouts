<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Backend_Controller {

	public function __construct(){
		parent::__construct();
        // print_r($this->session->all_userdata());
		$this->data['module_name'] = 'Group';
		if (!$this->ion_auth->logged_in()){
			redirect('login');
		}

		$this->load->model('Group_model');
	}

	public function index()
	{
		if($this->ion_auth->is_guest()){
			redirect('group/find');			
		}        
	}

	public function find(){
		$this->data['division'] = $this->Common_model->get_data('division'); 
        $this->data['district'] = $this->Common_model->get_data('district');

		//Load page       
		$this->data['meta_title'] = 'Find your scout group or unit';
		$this->data['subview'] = 'find';
		$this->load->view('backend/_layout_main', $this->data);
	}	

	public function my_group(){
		
		//Load page       
		$this->data['meta_title'] = 'My Scout Group';
		$this->data['subview'] = 'my_group';
		$this->load->view('backend/_layout_main', $this->data);
	}

	//Name 		: 	create
	//Created 	: 	4-10-17
	public function create(){
		// $this->form_validation->set_rules('dis_div_id', 'scout district division', 'trim'); 
  //       $this->form_validation->set_rules('dis_dis_id', 'scout district district', 'trim');     
  //       $this->form_validation->set_rules('dis_scout_region_id', 'scout region', 'required|trim');  
  //       $this->form_validation->set_rules('dis_type', 'district type', 'required|trim');          
  //       $this->form_validation->set_rules('dis_name', 'district name', 'required|trim|max_length[255]');

  //       if ($this->form_validation->run() == true){

  //           $form_data = array(
  //               'dis_div_id' => $this->input->post('dis_div_id'),
  //               'dis_dis_id' => $this->input->post('dis_dis_id'),
  //               'dis_scout_region_id' => $this->input->post('dis_scout_region_id'),
  //               'dis_type'   => $this->input->post('dis_type'),
  //               'dis_name'   => $this->input->post('dis_name'),
  //               'dis_description'   => $this->input->post('dis_description'),
  //               'dis_phone'  => $this->input->post('dis_phone')?$this->input->post('dis_phone'):NULL,
  //               'dis_fax'    => $this->input->post('dis_fax')?$this->input->post('dis_fax'):NULL,
  //               'dis_email'  => $this->input->post('dis_email')?$this->input->post('dis_email'):NULL,
  //               'dis_address'=> $this->input->post('dis_address')?$this->input->post('dis_address'):NULL
  //               );

  //           if($this->Common_model->save('office_district', $form_data)){
  //               $this->session->set_flashdata('success', 'Create scouts district successfully.');
  //               redirect("offices/district");
  //           }
  //       }
        
        $this->data['divisions'] = $this->Common_model->get_division(); 
        $this->data['districts'] = $this->Common_model->get_district(); 
        $this->data['upazilas'] = $this->Common_model->get_upazila_thana();
        $this->data['group_types'] = array('' => 'Select Type', '1' => 'Close', '2' => 'Open');

        $this->data['meta_title'] = 'Create Group';
        $this->data['subview'] = 'group_create';
        $this->load->view('backend/_layout_main', $this->data);
	}

}