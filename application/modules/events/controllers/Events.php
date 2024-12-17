<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Backend_Controller {	
    var $userSessID;
    var $file_path;

    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;        

        $this->data['module_title'] = 'Events';
        $this->userSessID = $this->session->userdata('user_id');
        $this->file_path = realpath(APPPATH . '../event_docs/');

        $this->load->model('Common_model'); 
        $this->load->model('Event_model');     
    }

    public function index(){
        redirect('events/event_list');
    }

    public function event_list($offset=0){
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
        $this->data['pagination'] = create_pagination('events/event_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = 'Event List';
        $this->data['subview'] = 'event_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************event_list_pdf function pdf start**************/
    public function event_list_pdf(){
        $limit = 25;

        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ 
            $results = $this->Event_model->get_data($limit, $offset, '1');
        }elseif($this->ion_auth->is_region_admin()){
            $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_data($limit, $offset, 'region', $officeRegionID);
        }elseif($this->ion_auth->is_district_admin()){         
            $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_data($limit, $offset, 'district', '', $officeDistrictID);
        }

        $this->data['results'] = $results['rows'];


        //...............................................................................
        $this->data['meta_title'] = 'Event List';
        $html = $this->load->view('event_list_pdf', $this->data, true);   
        $file_name ="event_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************event_list_pdf function pdf End**************/


    public function create_event(){
        // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin())){
        //     redirect('dashboard');
        // }
        // $region = NULL;
        // $district = NULL;
        // $event_type = NULL;
        // $event_level = NULL;
        //$et_region_ids = NULL;
        //$et_district_ids = NULL;
        //$et_upazila_ids = NULL;

        // Check Auth
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){
            $this->data['regions'] = $this->Common_model->get_regions_multi();  
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi(); 
            
            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? implode(',', $this->input->post('et_region_ids')):NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? implode(',', $this->input->post('et_district_ids')):NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;
            //Event Level
            $event_created_by = 1;            

        }elseif($this->ion_auth->is_region_admin()){
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $region = $officeID;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi($region);

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $region:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? implode(',', $this->input->post('et_district_ids')):NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;

            //Event Level           
            $event_created_by = 2;
            
        }elseif($this->ion_auth->is_district_admin()){
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $officeID->dis_scout_region_id;
            $district   = $officeID->id;
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', '', $district);

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $region:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? $district:NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;

            //Event Level
            $event_created_by = 3;

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            //Dropdown
            //$this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            //$this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $region:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? $district:NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? $upazila:NULL;

            //Event Level
            $event_created_by = 4;

        }else{
            redirect('dashboard');
        }


        // Validation
        $this->form_validation->set_rules('event_title', 'Event Title', 'required|trim');
        $this->form_validation->set_rules('event_venue', 'Event Venue', 'required|trim');
        $this->form_validation->set_rules('event_details', 'Event Details', 'required|trim');
        $this->form_validation->set_rules('event_start_date', ' To Date', 'required|trim');
        $this->form_validation->set_rules('event_end_date', 'From Date', 'required|trim');    
        // $this->form_validation->set_rules('event_end_date', 'From Date', 'required|trim');       
        // $this->form_validation->set_rules('event_notify[]', 'Event Notify', 'required|trim');

        // Submit form
        if ($this->form_validation->run() == true){
            // $this->data['event_notify'] = implode(',', $this->input->post('event_notify'));
            // $et_district_ids = implode(',', $this->input->post('et_district_ids'));
            // $et_upazila_ids = implode(',', $this->input->post('et_upazila_ids'));

            $form_data = array(
                'event_title'       => $this->input->post('event_title'),
                'event_venue'        => $this->input->post('event_venue'),
                'event_organizer'   => $this->input->post('event_organizer'),
                'event_details'     => $this->input->post('event_details'),

                'et_national'       => $this->input->post('et_national'),
                'et_international'  => $this->input->post('et_international'),
                'et_region'         => $this->input->post('et_region'),
                'et_district'       => $this->input->post('et_district'),
                'et_upazila'        => $this->input->post('et_upazila'),                
                'et_region_ids'     => $et_region_ids,
                'et_district_ids'   => $et_district_ids,
                'et_upazila_ids'    => $et_upazila_ids,

                'ept_cub'           => $this->input->post('ept_cub'),
                'ept_scout'         => $this->input->post('ept_scout'),
                'ept_rover'         => $this->input->post('ept_rover'),
                'ept_leader'        => $this->input->post('ept_leader'),
                'cub_stage_id'      => $this->input->post('cub_stage_id'),
                'scout_stage_id'    => $this->input->post('scout_stage_id'),
                'rover_stage_id'    => $this->input->post('rover_stage_id'),
                'leader_stage_id'   => $this->input->post('leader_stage_id'),

                'need_office'       => $this->input->post('need_office'),
                'need_office_qty'   => $this->input->post('need_office_qty'),
                'need_office_stage' => $this->input->post('need_office_stage'),
                'need_rover'        => $this->input->post('need_rover'),
                'need_rover_qty'    => $this->input->post('need_rover_qty'),
                'need_rover_stage'  => $this->input->post('need_rover_stage'),

                'event_start_date'  => date_db_format($this->input->post('event_start_date')),
                'event_end_date'    => date_db_format($this->input->post('event_end_date')),
                'event_reg_start'   => date_db_format($this->input->post('event_reg_start')),
                'event_reg_end'     => date_db_format($this->input->post('event_reg_end')),

                'ept_category'      => $this->input->post('ept_category'),
                'event_category'    => $this->input->post('event_category'),
                'ep_qty'            => $this->input->post('ep_qty'),
                'approve_role'      => $this->input->post('approve_role'),

                'created_office_by' => $event_created_by,                
                'sc_region_id'      => $region != NULL ? $region:NULL,
                'sc_district_id'    => $district != NULL ? $district:NULL,                
                'created'           => date('Y-m-d H:i:s')
                );
            // print_r($form_data);exit();

            // if($this->input->post('event_end_date') >= $this->input->post('event_start_date')){
                if($this->Common_model->save('events', $form_data)){
                    $insert_id = $this->db->insert_id();

                    /***********Activity Logs Start**********/
                    $insert_id = $this->db->insert_id();
                    func_activity_log(1, 'Create event create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/

                    $count = count($_FILES['userfile']['size']);
                    foreach($_FILES as $key=>$value){
                        for($s=0; $s<=$count-1; $s++) {
                            $new_file_name = $id.time();  

                            $_FILES['userfile']['name']     = $value['name'][$s];
                            $_FILES['userfile']['type']     = $value['type'][$s];
                            $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                            $_FILES['userfile']['error']    = $value['error'][$s];
                            $_FILES['userfile']['size']     = $value['size'][$s]; 

                            
                            $config['upload_path']      = $this->file_path;
                            $config['allowed_types']    = 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
                            $config['max_size']         = '60000';
                            $config['file_name']        = $new_file_name;
                            //$config['max_width']        = '3000';
                            //$config['max_height']       = '3000';
                            $this->load->library('upload', $config);
                            if($this->upload->do_upload()){
                                $uploadData = $this->upload->data();
                                $uploadedFile = $uploadData['file_name'];

                                $source_path = $this->file_path.'/'.$uploadedFile; 
                                // $target_path = $this->img_path.'/thumb_'. $uploadedFile;
                                //$this->resize($source_path, $target_path);

                                $file_data = array(
                                    'event_id'   => $insert_id,
                                    'file_name'  => $uploadedFile
                                    );

                                $this->Common_model->save('event_attachment', $file_data);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', 'New event insert successfully.');
                    redirect("events/event_list");
                } 
            // }else{
            //     $this->session->set_flashdata('warning', 'End date less then start date');
            // }       
        }

        // Dropdown
        // $this->data['event_notify'] = $this->Common_model->set_scout_section_checkbox(); 

        $this->data['cub_stage'] = $this->Common_model->get_badges(2,1);
        $this->data['scout_stage'] = $this->Common_model->get_badges(2,2);
        $this->data['rover_stage'] = $this->Common_model->get_badges(2,3);
        $this->data['adult_leader_stage'] = $this->Common_model->get_adult_leader_badges();
        // $this->data['adult_stage'] = $this->Common_model->get_custom_adult_badge();
        $this->data['event_participant_type'] = $this->Common_model->event_participant_type();
        $this->data['event_category'] = $this->Common_model->get_event_category();
        $this->data['event_appr_role'] = $this->Common_model->get_event_approve_role();
        
        // Load page
        $this->data['meta_title'] = 'Create New Event';
        $this->data['subview'] = 'create_event';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        $id = (int) decrypt_url($id);

        // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin())){
        //     redirect('dashboard');
        // }
        // $et_region_ids = NULL;
        // $et_district_ids = NULL;

        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){
            $this->data['regions'] = $this->Common_model->get_regions_multi();  
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi(); 

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? implode(',', $this->input->post('et_region_ids')):NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? implode(',', $this->input->post('et_district_ids')):NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;

        }elseif($this->ion_auth->is_region_admin()){
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $officeID);
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi($officeID);
            $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', $officeID);  

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $officeID:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? implode(',', $this->input->post('et_district_ids')):NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;

        }elseif($this->ion_auth->is_district_admin()){
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $officeID->dis_scout_region_id;
            $district   = $officeID->id;
            // $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', '', $district);

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $region:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? $district:NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? implode(',', $this->input->post('et_upazila_ids')):NULL;

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;
            $upazila    = $office->id;
            //Dropdown
            //$this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            //$this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

            // Event type region, district, upazila
            $et_region_ids = $this->input->post('et_region')==1 ? $region:NULL;
            $et_district_ids = $this->input->post('et_district')==1 ? $district:NULL;
            $et_upazila_ids = $this->input->post('et_upazila')==1 ? $upazila:NULL;

        }else{
            redirect('dashboard');
        }        

        // Validation
        $this->form_validation->set_rules('event_title', 'Event Title', 'required|trim');
        $this->form_validation->set_rules('event_venue', 'Event Venue', 'required|trim');
        $this->form_validation->set_rules('event_details', 'Event Details', 'required|trim');
        $this->form_validation->set_rules('event_start_date', ' To Date', 'required|trim');
        $this->form_validation->set_rules('event_end_date', 'From Date', 'required|trim');   

        // Form Validation
        if ($this->form_validation->run() == true){
            // $this->data['event_notify']=implode(',', $this->input->post('event_notify'));
            // 'event_notify'      => $this->data['event_notify'],
            // $et_region_ids = implode(',', $this->input->post('et_region_ids'));
            // $et_district_ids = implode(',', $this->input->post('et_district_ids'));
            // $et_upazila_ids = implode(',', $this->input->post('et_upazila_ids'));

            $form_data = array(
                'event_title'       => $this->input->post('event_title'),
                'event_venue'       => $this->input->post('event_venue'),
                'event_organizer'   => $this->input->post('event_organizer'),
                'event_details'     => $this->input->post('event_details'),

                'et_national'       => $this->input->post('et_national'),
                'et_international'  => $this->input->post('et_international'),
                'et_region'         => $this->input->post('et_region'),
                'et_district'       => $this->input->post('et_district'),
                'et_upazila'        => $this->input->post('et_upazila'),                
                'et_region_ids'     => $et_region_ids != NULL ? $et_region_ids:NULL,
                'et_district_ids'   => $et_district_ids !=NULL ? $et_district_ids:NULL,
                'et_upazila_ids'    => $et_upazila_ids != NULL ? $et_upazila_ids:NULL,

                'ept_cub'           => $this->input->post('ept_cub'),
                'ept_scout'         => $this->input->post('ept_scout'),
                'ept_rover'         => $this->input->post('ept_rover'),
                'ept_leader'        => $this->input->post('ept_leader'),
                'cub_stage_id'      => $this->input->post('cub_stage_id'),
                'scout_stage_id'    => $this->input->post('scout_stage_id'),
                'rover_stage_id'    => $this->input->post('rover_stage_id'),
                'leader_stage_id'   => $this->input->post('leader_stage_id'),

                'need_office'       => $this->input->post('need_office'),
                'need_office_qty'   => $this->input->post('need_office_qty'),
                'need_office_stage' => $this->input->post('need_office_stage'),
                'need_rover'        => $this->input->post('need_rover'),
                'need_rover_qty'    => $this->input->post('need_rover_qty'),
                'need_rover_stage'  => $this->input->post('need_rover_stage'),

                'event_start_date'  => date_db_format($this->input->post('event_start_date')),
                'event_end_date'    => date_db_format($this->input->post('event_end_date')),
                'event_reg_start'   => date_db_format($this->input->post('event_reg_start')),
                'event_reg_end'     => date_db_format($this->input->post('event_reg_end')),

                'ept_category'      => $this->input->post('ept_category'),
                'event_category'    => $this->input->post('event_category'),
                'ep_qty'            => $this->input->post('ep_qty'),
                'approve_role'      => $this->input->post('approve_role'),

                'published'         => $this->input->post('published'),
                'updated'           => date('Y-m-d H:i:s')
                );
            //print_r($form_data);exit();

            // if($this->input->post('event_end_date') >= $this->input->post('event_start_date')){
                if($this->Common_model->edit('events', $id, 'id', $form_data)){

                    /***********Activity Logs Start**********/
                    $insert_id = $this->db->insert_id();
                    func_activity_log(2, 'Update event Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/  

                    $count = count($_FILES['userfile']['size']);
                    foreach($_FILES as $key=>$value){
                        for($s=0; $s<=$count-1; $s++) {
                            $new_file_name = $id.time();  

                            $_FILES['userfile']['name']     = $value['name'][$s];
                            $_FILES['userfile']['type']     = $value['type'][$s];
                            $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                            $_FILES['userfile']['error']    = $value['error'][$s];
                            $_FILES['userfile']['size']     = $value['size'][$s]; 

                            
                            $config['upload_path']      = $this->file_path;
                            $config['allowed_types']    = 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
                            $config['max_size']         = '6000';
                            $config['file_name']        = $new_file_name;
                            //$config['max_width']        = '3000';
                            //$config['max_height']       = '3000';
                            $this->load->library('upload', $config);
                            if($this->upload->do_upload()){
                                $uploadData = $this->upload->data();
                                $uploadedFile = $uploadData['file_name'];

                                $source_path = $this->file_path.'/'.$uploadedFile; 
                                // $target_path = $this->img_path.'/thumb_'. $uploadedFile;
                                //$this->resize($source_path, $target_path);

                                $file_data = array(
                                    'event_id'   => $id,
                                    'file_name'  => $uploadedFile
                                    );

                                $this->Common_model->save('event_attachment', $file_data);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', 'Event update successfully.');
                    redirect("events/event_list");
                } 
            // }else{
            //     $this->session->set_flashdata('warning', 'End date Less then start date');
            // }       
        }

        $this->data['info'] = $this->Event_model->get_info($id);
        $this->data['attachments'] = $this->Event_model->get_attachment($id);
        $this->data['cub_stage'] = $this->Common_model->get_badges(2,1);
        $this->data['scout_stage'] = $this->Common_model->get_badges(2,2);
        $this->data['rover_stage'] = $this->Common_model->get_badges(2,3);
        $this->data['adult_leader_stage'] = $this->Common_model->get_adult_leader_badges();
        // $this->data['adult_stage'] = $this->Common_model->get_custom_adult_badge();
        $this->data['event_participant_type'] = $this->Common_model->event_participant_type();
        $this->data['event_category'] = $this->Common_model->get_event_category();
        $this->data['event_appr_role'] = $this->Common_model->get_event_approve_role();

        // Load page
        $this->data['meta_title'] = 'Event Update';
        $this->data['subview'] = 'edit_event';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){
        $id = (int) decrypt_url($id);

        //$this->data['users'] = $this->ion_auth->user()->row();
        if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Event_model->get_info($id);
        $this->data['attachments'] = $this->Event_model->get_attachment($id);
        //$this->data['scout_member_list'] = $this->Event_model->get_scout_member_list($id);
        //$this->data['scout_member'] = $this->Event_model->get_scout_member($id, $this->data['users']->id);

        //Load View
        $this->data['meta_title'] = 'Event Details';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function attachment_del($id, $eventID) {
        // echo $id; exit;
        if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin())){
            redirect('dashboard');
        }

        // echo $id = (int) decrypt_url($id); exit;

        $info = $this->Event_model->get_attachment_single($id);
        // print_r($info->file_name); exit;
        // echo $this->file_path.'\\'.$info->file_name; exit;

        if(unlink($this->file_path.'\\'.$info->file_name)){
            $this->Event_model->get_attachment_delete($info->id);
            $this->session->set_flashdata('success', 'Information delete successfully.');
        }

        redirect('events/edit/'.encrypt_url($eventID));
    }


    /************************* Scouts Group **************************/
    /*****************************************************************/
    public function upcomming_group_event(){   
        if($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            // Results
            $this->data['results'] = $this->Event_model->upcomming_event_group_unit($groupInfo);
        }else{
            redirect('dashboard');
        }

        // echo '<pre>';
        // print_r($results); exit;

        // Matching result list
        // $this->data['results'] = $this->Event_model->upcomming_event_search($this->data['info']);

        // Load page
        $this->data['meta_title'] = 'Upcomming Group Event List';
        $this->data['subview'] = 'upcomming_group_event';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function join_event_as_group($id){
        $id = (int) decrypt_url($id);

        if(!$this->ion_auth->is_group_admin()){
            redirect('dashboard');
        }
        $eventID = $id;

        $this->data['info'] =  $this->Event_model->get_info($eventID);
        $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
        $this->data['scouts_unit'] =  $this->Common_model->get_scout_unit_office($groupInfo->id);
        // echo $groupInfo->id;

        $this->form_validation->set_rules('scouts_unit', ' select unit', 'required|trim');

        // Form Validation
        if ($this->form_validation->run() == true){
            $unitID = $this->input->post('scouts_unit');
            redirect("events/join_event_unit_application/".$eventID.'/'.$unitID);
        }

        // Load page
        $this->data['meta_title'] = 'Join Event as Scout Group';
        $this->data['subview'] = 'join_event_as_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function join_event_unit_application($event_id, $unit_id){
        if(!$this->ion_auth->is_group_admin()){
            redirect('dashboard');
        }

        $eventID = $event_id;
        $unitID = $unit_id;

        $this->data['info'] =  $this->Event_model->get_info($eventID);
        $this->data['unit_info'] = $this->Offices_model->get_scout_unit_info($unitID);
        $this->data['scouts_member'] = $this->Event_model->get_scout_member_by_group($this->data['unit_info']->unit_sc_grp_id);

        // Validation
        $this->form_validation->set_rules('leader_id', ' leader ID', 'required|trim');

        // Form Validation
        if ($this->form_validation->run() == true){

            $form_data = array(
                'app_data' => date('Y-m-d'),
                'event_id' => $eventID,
                'group_id' => $this->data['unit_info']->unit_sc_grp_id,
                'unit_id' => $unitID,
                'unit_type_id' => $this->data['unit_info']->unit_type,
                'leader_id' => $this->input->post('leader_id'),
                'p1'   => $this->input->post('p1'),
                'p2'   => $this->input->post('p2'),
                'p3'   => $this->input->post('p3'),
                'p4'   => $this->input->post('p4'),
                'p5'   => $this->input->post('p5'),
                'p6'   => $this->input->post('p6')
            );

            if($this->data['unit_info']->unit_type != 1 || $this->data['unit_info']->unit_type != 4){
                 $form_data['p7'] = $this->input->post('p7') != NULL?$this->input->post('p7'):NULL;
                 $form_data['p8'] = $this->input->post('p8') != NULL?$this->input->post('p8'):NULL;
            }

            // print_r($form_data); exit;

            if($this->Common_model->save('event_join_group', $form_data)){
                $insert_id = $this->db->insert_id();

                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Join event group :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Apply event successfully.');
                redirect("events/upcomming_group_event");
            }
        }

        // Load page
        $this->data['meta_title'] = 'Join Event Unit Application';
        $this->data['subview'] = 'join_event_unit_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function my_group_application(){   
        if($this->ion_auth->is_group_admin()){
            // Group Admin
            $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
            // Results
            $this->data['results'] = $this->Event_model->get_my_group_application($groupInfo->id);
            // print_r($this->data['results']); 
            //echo $this->data['results']->id; 
            // exit;
        }else{
            redirect('dashboard');
        }

        // $this->data['results'] = $this->Event_model->my_application();
        // Load page
        $this->data['meta_title'] = 'My Application List';
        $this->data['subview'] = 'my_group_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function group_application($id){   
        $id = (int) decrypt_url($id);

        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
            redirect('dashboard');
        }

        // Get result
        $this->data['results'] = $this->Event_model->get_group_application($id);


        // $this->data['results'] = $this->Event_model->my_application();
        // Load page
        $this->data['meta_title'] = 'Group Application List';
        $this->data['subview'] = 'group_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function group_application_details($id){   
        // if(!$this->ion_auth->is_group_admin()){            
        //     redirect('dashboard');
        // }
        $id = (int) decrypt_url($id);


        //$this->data['users'] = $this->ion_auth->user()->row();
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Event_model->get_application_details($id);

        // $this->data['info'] = $this->Event_model->my_application();
        // Load page
        $this->data['meta_title'] = 'Group Application Details';
        $this->data['subview'] = 'group_application_details';
        $this->load->view('backend/_layout_main', $this->data);
    }




    /************************* Scouts Member *************************/
    /*****************************************************************/

    public function upcomming_event(){   
        if(!$this->ion_auth->is_scout_member()){
            redirect('dashboard');
        }

        $this->data['info'] = $this->data['userDetails']['user_info'];
        // echo '<pre>';
        // print_r($this->data['info']); exit;

        // Matching result list
        $this->data['results'] = $this->Event_model->upcomming_event_search($this->data['info']);

        // Load page
        $this->data['meta_title'] = 'Upcomming Event List';
        $this->data['subview'] = 'upcoming_events';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function join_event($id, $type){
        // $this->data['users'] = $this->ion_auth->user()->row();
        // $this->data['scout_member_list'] = $this->Event_model->get_scout_member_list($id);
        // $this->data['scout_member'] = $this->Event_model->get_scout_member($id, $this->data['users']->id);
        // $user = $this->ion_auth->user()->row();    

        $info = $this->data['userDetails']['user_info'];
        if (($type == 1) || ($type == 2) || ($type == 3)){
            $form_data = array(
                'event_id'          => $id,
                'app_date'          => date('Y-m-d'), 
                'participant_type_id' => $type,
                'scout_id'          => $info->id,
                'curr_region_id'    => $info->sc_region_id,
                'curr_district_id'  => $info->sc_district_id,
                'curr_upazila_id'   => $info->sc_upa_tha_id,
                'curr_group_id'     => $info->sc_group_id
                );
            // print_r($form_data);exit();

            if($this->Common_model->save('event_participant', $form_data)){                 
                $this->session->set_flashdata('success', 'Apply event successfully.');
                redirect("events/my_application");
            } 
        }else{
            $this->session->set_flashdata('warning', 'Something is wrong.');
            redirect("events/upcomming_event");
        }

    }

    public function my_application(){   
        // $region = $this->data['userDetails']['user_info']->sc_region_id;
        // $district = $this->data['userDetails']['user_info']->sc_district_id;

        $this->data['results'] = $this->Event_model->my_application();
            // Load page
        $this->data['meta_title'] = 'My Application List';
        $this->data['subview'] = 'my_application';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function my_app_cancle($id) {
        if($this->Event_model->application_delete($id)){
            $this->session->set_flashdata('success', 'Application cancle successfully.');
            redirect('events/my_application');
        }
    }



    /************* Application Verification By Office ****************/
    /*****************************************************************/

    public function application_list($offset=0){  

        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }
        $limit = 25;

        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ 
            $results = $this->Event_model->get_applicant_data($limit, $offset, '');

        }elseif($this->ion_auth->is_region_admin()){
            $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_applicant_data($limit, $offset, '', $officeRegionID); 

        }elseif($this->ion_auth->is_district_admin()){         
            $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', $officeDistrictID);

        }elseif($this->ion_auth->is_upazila_admin()){
            $officeUpazilaID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', '', $officeUpazilaID);

        }elseif($this->ion_auth->is_group_admin()){
            $officeGroupID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
            $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', '', $officeGroupID);
        }

        // Result
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('events/application_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // $region = $this->data['userDetails']['user_info']->sc_region_id;
        // $district = $this->data['userDetails']['user_info']->sc_district_id;
        // $this->data['results'] = $this->Event_model->upcomming_events($region, $district);

        // Load page
        $this->data['meta_title'] = 'Application List';
        $this->data['subview'] = 'application_list';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function participant_verify($id){
        $id = (int) decrypt_url($id);
        
        //$user = $this->ion_auth->user()->row();       
        // $id = $this->input->post('event_status');
        $this->form_validation->set_rules('event_status', 'select verify status ', 'required|trim');
        // $this->form_validation->set_rules('participant_type_app', 'select participant type ', 'required|trim');
        if ($this->form_validation->run() == true){
            //$form_data = array('participant_type_app' => $this->input->post('participant_type_app'));

            if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ 
                $form_data['verify_nhq'] = $this->input->post('event_status');
            }elseif($this->ion_auth->is_region_admin()){
                $form_data['verify_region'] = $this->input->post('event_status');
            }elseif($this->ion_auth->is_district_admin()){ 
                $form_data['verify_district'] = $this->input->post('event_status');
            }elseif($this->ion_auth->is_upazila_admin()){
                $form_data['verify_upazila'] = $this->input->post('event_status');
            }elseif($this->ion_auth->is_group_admin()){
                $form_data['verify_group'] = $this->input->post('event_status');
            }
            // print_r($form_data);exit();

            if($this->Common_model->edit('event_participant', $id, 'id', $form_data)){
                // echo $this->db->last_query(); exit;
                $this->session->set_flashdata('success', 'Applicant event verify successfully.');

                /***********Activity Logs Start**********/
                $activity_data['user_id'] = $this->userSessID; 
                $activity_data['message'] = 'Participant Verify ID: '.$id; 
                $activity_data['activity_type_id'] = 2; //For Update Activity log
                $activity_data['ip_address'] = $this->Common_model->get_client_ip();
                $activity_data['created'] = date('Y-m-d H:i:s');
                $this->Common_model->save('activity_logs',$activity_data);
                /***********Activity Logs End**********/

                redirect("events/application_list");
            }
        }

        $this->data['info'] = $this->Event_model->get_application($id);
        // print_r($this->data['info']); exit;
        $this->data['event_status'] = $this->Common_model->set_event_status();
        // $this->data['participant_type'] = $this->Common_model->set_event_participant_type();

        //Load view
        $this->data['meta_title'] = 'Event Participant Verification';
        $this->data['subview'] = 'participant_verify';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function event_applicant_list($id){   
        $id = (int) decrypt_url($id);
        if(!$id){
            redirect('dashboard');
        }elseif(!$this->Common_model->exists('events', 'id', $id)){
            redirect('dashboard');
        }

        $this->data['results'] = $this->Event_model->get_event_applicant_list($id);

        // Load page
        $this->data['meta_title'] = 'Event Applicant List';
        $this->data['subview'] = 'event_applicant_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function event_participant_list($id){ 
        $id = (int) decrypt_url($id);

        if(!$id){
            redirect('dashboard');
        }elseif(!$this->Common_model->exists('events', 'id', $id)){
            redirect('dashboard');
        }

        $this->data['results'] = $this->Event_model->get_event_participant_list($id);

        // Load page
        $this->data['meta_title'] = 'Event Participant List';
        $this->data['subview'] = 'event_participant_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function event_certificate_pdf($id){
        $id = (int) decrypt_url($id);

      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('event'))){
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
      //    show_404('award - president_scout_certificate_pdf - exitsts', TRUE);
      // }

      //Results
      $this->data['info'] = $this->Event_model->get_event_certificate($id);
      // print_r($this->data['info']); exit;
      
      
      //...............................................................................
      $this->data['meta_title'] = "Event Certificate";
      $html = $this->load->view('event_certificate_pdf', $this->data, true);   
      $file_name = $id.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }











    public function upcomming_event_list(){
        $this->data['event'] = $this->Event_model->upcomming_event();
        // Load page
        $this->data['meta_title'] = 'Upcomming Event List';
        $this->data['subview'] = 'event_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************upcomming_event_pdf function pdf start**************/
    public function upcomming_event_pdf(){
        $region = $this->data['userDetails']['user_info']->sc_region_id;
        $district = $this->data['userDetails']['user_info']->sc_district_id;

        $this->data['results'] = $this->Event_model->upcomming_events($region, $district);

        //...............................................................................
        $this->data['meta_title'] = 'Upcomming Event List';
        $html = $this->load->view('upcomming_event_pdf', $this->data, true);   
        $file_name ="upcomming_event_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************upcomming_event_pdf function pdf End**************/    


    /*************application_list function pdf start**************/
    public function application_list_pdf(){
     if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->in_group('event') || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
        redirect('dashboard');
    }
    $limit = 25;

    if($this->ion_auth->is_admin() || $this->ion_auth->in_group('event')){ 
        $results = $this->Event_model->get_applicant_data($limit, $offset, '');
    }elseif($this->ion_auth->is_region_admin()){
        $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
        $results = $this->Event_model->get_applicant_data($limit, $offset, '', $officeRegionID); 
    }elseif($this->ion_auth->is_district_admin()){         
        $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
        $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', $officeDistrictID);
    }elseif($this->ion_auth->is_upazila_admin()){
       $officeUpazilaID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
       $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', '', $officeUpazilaID);
   }elseif($this->ion_auth->is_group_admin()){
       $officeGroupID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
       $results = $this->Event_model->get_applicant_data($limit, $offset, '', '', '', $officeGroupID);
   }


   $this->data['results'] = $results['rows'];
   $this->data['total_rows'] = $results['num_rows'];

        //...............................................................................
   $this->data['meta_title'] = 'UApplication List';
   $html = $this->load->view('application_list_pdf', $this->data, true);   
   $file_name ="application_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
   $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
   $mpdf->WriteHTML($html);

        //download it for 'D'. 
   $mpdf->Output($file_name, "D");
}

/*************application_list function pdf End**************/














public function my_event(){       
    $this->data['event'] = $this->Event_model->get_scout_member_approved();
        // Load page
    $this->data['meta_title'] = 'My Event List';
    $this->data['subview'] = 'my_event_list';
    $this->load->view('backend/_layout_main', $this->data);
}




public function comments($id){
    $this->data['users'] = $this->ion_auth->user()->row();
    $this->data['event_id'] = $id;

    $this->data['training'] = $this->Event_model->get_info($id);

    if($this->Event_model->get_event_valid($id)==false){
        redirect('events/my_event');
    }

    $this->form_validation->set_rules('comments', 'comments', 'required|trim');

    if ($this->form_validation->run() == true){

        $form_data = array(
            'comments' => $this->input->post('comments')
            );
            //print_r($form_data);exit();

        if($this->Event_model->edit('event_to_scouts', $this->data['users']->id, $id,  $form_data)){                
            $this->session->set_flashdata('success', 'Successfully send your comments.');
            redirect('events/my_event'); 
        } 
        redirect('events/my_event');     
    }

    $this->data['meta_title'] = 'Event Comments';
    $this->data['subview'] = 'comments';
    $this->load->view('backend/_layout_main', $this->data);
}



function status($scout_id, $event_id, $status) {
    $this->data['users'] = $this->ion_auth->user()->row();

    if($status==1){
        $status_data='Interested';
        $form_data = array(
            'status'       => $status_data,
            );
    }
    if($status==2){
        $status_data='Not Interested';
        $form_data = array(
            'status'       => $status_data,
            );
    }
    if($status==3){
        $status_data='Approved';
        $form_data = array(
            'status'       => $status_data,
            'approved_by'  => $this->data['users']->id
            );
    }
    if($status==4){
        $status_data='Not Approved';

        $form_data = array(
            'status'       => $status_data,
            'approved_by'  => $this->data['users']->id
            );
    }

    $form_data2 = array(
        'scout_id'     => $this->data['users']->id,
        'event_id'     => $event_id,
        'status'       => $status_data
        );

    if(empty($this->Event_model->get_scout_member($event_id, $scout_id))){

        if($this->Common_model->save('event_to_scouts', $form_data2)){
            $this->session->set_flashdata('success', 'Information update successfully.'); 
        }else{
            $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
        }
    }else{
        if($this->Event_model->edit('event_to_scouts', $scout_id, $event_id, $form_data)){
            $this->session->set_flashdata('success', 'Information update successfully.'); 
        }else{
            $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
        }
    }

    redirect('events/details/'.$event_id);
}

function delete($id) {
    $id = (int) decrypt_url($id);

    $this->data['info'] = $this->Event_model->delete($id);
    /***********Activity Logs Start**********/
    $insert_id = $this->db->insert_id();
        func_activity_log(3, 'Delete event Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('events/event_list');
    }

}