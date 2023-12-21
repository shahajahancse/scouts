<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_calendar extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;		
        $this->data['module_title'] = 'Event Calendar';
        $this->load->model('Event_calendar_model');
        $this->load->model('events/Event_model'); 
    }

	public function index()
	{
		$limit = 25;

		if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ 
		   $results = $this->Event_model->get_data($limit, $offset, '1');

		}elseif($this->ion_auth->is_region_admin()){
		   $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
		   $results = $this->Event_model->get_data($limit, $offset, '2', $officeRegionID);
		   // $this->data['scout_district'] = $this->Common_model->get_scout_districts($officeRegionID);   
		}elseif($this->ion_auth->is_district_admin()){         
		   $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
		   $results = $this->Event_model->get_data($limit, $offset, '3', '', $officeDistrictID);

		}elseif($this->ion_auth->is_upazila_admin()){
		   //Upazila Admin
		   $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
		   // $upazila    = $office->id;
		   $results = $this->Event_model->get_data($limit, $offset, '4', '', '', $office);

		}else{
		   redirect('dashboard');
		}

		//Result
		$this->data['results'] = $results['rows'];
		$this->data['total_rows'] = $results['num_rows'];

		//pagination
		$this->data['pagination'] = create_pagination('event_calendar/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

       //Load page       
		$this->data['meta_title'] = 'Event Calendar';
		$this->data['subview'] = 'index';
    	$this->load->view('backend/_layout_main', $this->data);
	}

	public function nhq($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event'))){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Event_calendar_model->get_nhq_event($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('event_calendar/nhq/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'NHQ Event Calendar List';
      $this->data['subview'] = 'nhq';
      $this->load->view('backend/_layout_main', $this->data);
   }


	public function nhq_add(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event'))){
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('nhq_event_title', 'event title','required|trim|max_length[255]');
      $this->form_validation->set_rules('nhq_event_start', 'start date', 'required|trim');
      $this->form_validation->set_rules('nhq_event_end', 'start date', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'nhq_event_title' => $this->input->post('nhq_event_title'),
            'nhq_event_start' => date_db_format($this->input->post('nhq_event_start')),
            'nhq_event_end' => date_db_format($this->input->post('nhq_event_end'))
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('event_calendar_nhq', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create NHQ event :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Create NHQ event successfully.');
            redirect("event_calendar/nhq");
         }
      }

      //Dropdown
      // $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 

      //Load view
      $this->data['meta_title'] = 'Add To NHQ Event Calender';
      $this->data['subview'] = 'nhq_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function nstc($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event'))){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Event_calendar_model->get_nstc_event($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('event_calendar/nstc/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'NSTC Event Calendar List';
      $this->data['subview'] = 'nstc';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function nstc_add(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event'))){
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('nstc_event_title', 'event title','required|trim|max_length[255]');
      $this->form_validation->set_rules('nstc_event_start', 'start date', 'required|trim');
      $this->form_validation->set_rules('nstc_event_end', 'start date', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'nstc_event_title' => $this->input->post('nstc_event_title'),
            'nstc_event_start' => date_db_format($this->input->post('nstc_event_start')),
            'nstc_event_end' => date_db_format($this->input->post('nstc_event_end'))
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('event_calendar_nstc', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create NSTC event :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Create NSTC event successfully.');
            redirect("event_calendar/nstc");
         }
      }

      //Dropdown
      // $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 

      //Load view
      $this->data['meta_title'] = 'Add To NSTC Event Calender';
      $this->data['subview'] = 'nstc_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

}