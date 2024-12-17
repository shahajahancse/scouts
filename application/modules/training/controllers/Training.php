<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends Backend_Controller {	

    var $file_path;

    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->file_path = realpath(APPPATH . '../training_docs');

        $this->data['module_title'] = 'Training';
        $this->load->model('Common_model'); 
        $this->load->model('Training_model');     
    }

    public function index(){
        redirect('training/training_list');
    }


    public function training_list($offset=0){
        $limit = 25;

        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training')){ 
            $results = $this->Training_model->get_scout_training_data($limit, $offset, '1');
            // print_r($results); exit;

        }elseif($this->ion_auth->is_region_admin()){
            $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
            $results = $this->Training_model->get_scout_training_data($limit, $offset, '2', $officeRegionID);
            // $this->data['scout_district'] = $this->Common_model->get_scout_districts($officeRegionID);   
        }elseif($this->ion_auth->is_district_admin()){         
            $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
            $results = $this->Training_model->get_scout_training_data($limit, $offset, '3', '', $officeDistrictID);

        }elseif($this->ion_auth->is_upazila_admin()){
            //Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
            // $upazila    = $office->id;
            $results = $this->Training_model->get_scout_training_data($limit, $offset, '4', '', '', $office);

        }else{
            redirect('dashboard');
        }

        //Result
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('training/training_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
        $this->data['meta_title'] = 'Training List';
        $this->data['subview'] = 'training_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){        
        //$this->data['users'] = $this->ion_auth->user()->row();
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
            redirect('dashboard');
        }

        $id = (int) decrypt_url($id);

        $this->data['info'] = $this->Training_model->get_scout_training_info($id);
        $this->data['attachments'] = $this->Training_model->get_attachment($id);
        //$this->data['scout_member_list'] = $this->Event_model->get_scout_member_list($id);
        //$this->data['scout_member'] = $this->Event_model->get_scout_member($id, $this->data['users']->id);

        //Load View
        $this->data['meta_title'] = 'Training Details';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    public function create_training(){

        // Check Auth
        if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training')){
            $this->data['regions'] = $this->Common_model->get_regions_multi();  
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi(); 
            
            // Event type region, district, upazila
            $tt_region_ids = $this->input->post('tt_region')==1 ? implode(',', $this->input->post('tt_region_ids')):NULL;
            $tt_district_ids = $this->input->post('tt_district')==1 ? implode(',', $this->input->post('tt_district_ids')):NULL;
            $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;
            //Event Level
            $training_created_by = 1;            

        }elseif($this->ion_auth->is_region_admin()){
            $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $region = $officeID;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi($region);

            // Event type region, district, upazila
            $tt_region_ids = $this->input->post('tt_region')==1 ? $region:NULL;
            $tt_district_ids = $this->input->post('tt_district')==1 ? implode(',', $this->input->post('tt_district_ids')):NULL;
            $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;

            //Event Level           
            $training_created_by = 2;
            
        }elseif($this->ion_auth->is_district_admin()){
            $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $officeID->dis_scout_region_id;
            $district   = $officeID->id;
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', '', $district);

            // Event type region, district, upazila
            $tt_region_ids = $this->input->post('tt_region')==1 ? $region:NULL;
            $tt_district_ids = $this->input->post('tt_district')==1 ? $district:NULL;
            $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;

            //Event Level
            $training_created_by = 3;

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
            $tt_region_ids = $this->input->post('tt_region')==1 ? $region:NULL;
            $tt_district_ids = $this->input->post('tt_district')==1 ? $district:NULL;
            $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? $upazila:NULL;

            //Event Level
            $training_created_by = 4;

        }else{
            redirect('dashboard');
        }


        // Validation
        $this->form_validation->set_rules('progress_type', 'member type', 'required|trim');
        $this->form_validation->set_rules('section_id', 'section', 'required|trim');
        $this->form_validation->set_rules('course_id', 'course name', 'required|trim');
        $this->form_validation->set_rules('training_title', 'training title', 'required|trim');
        $this->form_validation->set_rules('details', 'training details', 'required|trim');
        $this->form_validation->set_rules('start_date', ' to date', 'required|trim');
        $this->form_validation->set_rules('end_date', 'from date', 'required|trim'); 
        $this->form_validation->set_rules('participant_no', 'participant no', 'required|trim'); 


        // Submit form
        if ($this->form_validation->run() == true){

            $form_data = array(
                'progress_type'     => $this->input->post('progress_type'),
                'section_id'        => $this->input->post('section_id'),
                'course_id'         => $this->input->post('course_id'),
                'other_course_name' => $this->input->post('other_course_name'),
                'course_number'     => $this->input->post('course_number'),
                'training_title'    => $this->input->post('training_title'),
                'place'             => $this->input->post('place'),
                'details'           => $this->input->post('details'),

                'tt_national'       => $this->input->post('tt_national'),
                'tt_international'  => $this->input->post('tt_international'),
                'tt_region'         => $this->input->post('tt_region'),
                'tt_district'       => $this->input->post('tt_district'),
                'tt_upazila'        => $this->input->post('tt_upazila'),                
                'tt_region_ids'     => $tt_region_ids,
                'tt_district_ids'   => $tt_district_ids,
                'tt_upazila_ids'    => $tt_upazila_ids,

                'start_date'        => date_db_format($this->input->post('start_date')),
                'end_date'          => date_db_format($this->input->post('end_date')),
                'reg_start'         => date_db_format($this->input->post('reg_start')),
                'reg_end'           => date_db_format($this->input->post('reg_end')),

                'participant_no'    => $this->input->post('participant_no'),
                'approve_role'      => $this->input->post('approve_role'),

                'created_office_by' => $training_created_by,                
                'sc_region_id'      => $region != NULL ? $region:NULL,
                'sc_district_id'    => $district != NULL ? $district:NULL,                
                'created'           => date('Y-m-d H:i:s'),
                'updated'           => date('Y-m-d H:i:s')
                );

            // print_r($form_data);exit();

            // if($this->input->post('start_date') >= $this->input->post('end_date')){
            if($this->Common_model->save('scout_training', $form_data)){
                $insert_id = $this->db->insert_id();

                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                    func_activity_log(1, 'Create training ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
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
                                    'training_id'=> $insert_id,
                                    'file_name'  => $uploadedFile
                                    );

                                $this->Common_model->save('training_attachment', $file_data);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', 'New training insert successfully.');
                    redirect("training/training_list");
                } 
            // }else{
            //     $this->session->set_flashdata('warning', 'End date less then start date');
            // }       
            }

        // Dropdown
            $this->data['progress'] = $this->Common_model->set_scout_progress();
            $this->data['section'] = $this->Common_model->set_scout_section();
            $this->data['appr_role'] = $this->Common_model->get_event_approve_role();
        // $this->data['courses'] = $this->Common_model->get_course_by_progress_section($this->data['progressType'], $sectionType);

        // $this->data['divisions'] = $this->Common_model->get_division(); 
        // $this->data['districts'] = $this->Common_model->get_district(); 
        // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
        // $this->data['regions'] = $this->Common_model->get_regions(); 
        // $this->data['scout_section'] = $this->Common_model->set_scout_section();
        // $this->data['training'] = $this->Common_model->get_dd_training_list();
        // $this->data['teacher'] = $this->Training_model->get_trainer('trainer');

        // Load page
            $this->data['meta_title'] = 'Create New Training';
            $this->data['subview'] = 'create_training';
            $this->load->view('backend/_layout_main', $this->data);
        }

        public function edit($id){
            $id = (int) decrypt_url($id);

            if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training')){
                $this->data['regions'] = $this->Common_model->get_regions_multi();  
                $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi(); 

            // Event type region, district, upazila
                $tt_region_ids = $this->input->post('tt_region')==1 ? implode(',', $this->input->post('tt_region_ids')):NULL;
                $tt_district_ids = $this->input->post('tt_district')==1 ? implode(',', $this->input->post('tt_district_ids')):NULL;
                $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;

            }elseif($this->ion_auth->is_region_admin()){
                $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
                $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $officeID);
                $this->data['sc_districts'] = $this->Common_model->get_sc_districts_multi($officeID);
                $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', $officeID);  

            // Event type region, district, upazila
                $tt_region_ids = $this->input->post('tt_region')==1 ? $officeID:NULL;
                $tt_district_ids = $this->input->post('tt_district')==1 ? implode(',', $this->input->post('tt_district_ids')):NULL;
                $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;

            }elseif($this->ion_auth->is_district_admin()){
                $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
                $region     = $officeID->dis_scout_region_id;
                $district   = $officeID->id;
            // $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
                $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
                $this->data['sc_upazilas'] = $this->Common_model->get_sc_upazila_multi('', '', $district);

            // Event type region, district, upazila
                $tt_region_ids = $this->input->post('tt_region')==1 ? $region:NULL;
                $tt_district_ids = $this->input->post('tt_district')==1 ? $district:NULL;
                $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? implode(',', $this->input->post('tt_upazila_ids')):NULL;

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
                $tt_region_ids = $this->input->post('tt_region')==1 ? $region:NULL;
                $tt_district_ids = $this->input->post('tt_district')==1 ? $district:NULL;
                $tt_upazila_ids = $this->input->post('tt_upazila')==1 ? $upazila:NULL;

            }else{
                redirect('dashboard');
            }        

        // Validation
            $this->form_validation->set_rules('progress_type', 'member type', 'required|trim');
            $this->form_validation->set_rules('section_id', 'section', 'required|trim');
            $this->form_validation->set_rules('training_title', 'training title', 'required|trim');
            $this->form_validation->set_rules('details', 'training details', 'required|trim');
            $this->form_validation->set_rules('start_date', ' to date', 'required|trim');
            $this->form_validation->set_rules('end_date', 'from date', 'required|trim');       

        // Form Validation
            if ($this->form_validation->run() == true){

                $form_data = array(
                    'progress_type'     => $this->input->post('progress_type'),
                    'section_id'        => $this->input->post('section_id'),
                    'course_id'         => $this->input->post('course_id'),
                    'other_course_name' => $this->input->post('other_course_name'),
                    'course_number'     => $this->input->post('course_number'),
                    'training_title'    => $this->input->post('training_title'),
                    'place'             => $this->input->post('place'),
                    'details'           => $this->input->post('details'),

                    'tt_national'       => $this->input->post('tt_national'),
                    'tt_international'  => $this->input->post('tt_international'),
                    'tt_region'         => $this->input->post('tt_region'),
                    'tt_district'       => $this->input->post('tt_district'),
                    'tt_upazila'        => $this->input->post('tt_upazila'),                
                    'tt_region_ids'     => $tt_region_ids != NULL ? $tt_region_ids:NULL,
                    'tt_district_ids'   => $tt_district_ids != NULL ? $tt_district_ids:NULL,
                    'tt_upazila_ids'    => $tt_upazila_ids != NULL ? $tt_upazila_ids:NULL,

                    'start_date'        => date_db_format($this->input->post('start_date')),
                    'end_date'          => date_db_format($this->input->post('end_date')),
                    'reg_start'         => date_db_format($this->input->post('reg_start')),
                    'reg_end'           => date_db_format($this->input->post('reg_end')),

                    'participant_no'    => $this->input->post('participant_no'),
                    'approve_role'      => $this->input->post('approve_role'),

                    'sc_region_id'      => $region != NULL ? $region:NULL,
                    'sc_district_id'    => $district != NULL ? $district:NULL,  

                    'published'         => $this->input->post('published'),
                    'updated'           => date('Y-m-d H:i:s')
                    );
            //print_r($form_data);exit();

            // if($this->input->post('end_date') >= $this->input->post('start_date')){
                if($this->Common_model->edit('scout_training', $id, 'id', $form_data)){

                    /***********Activity Logs Start**********/
                    // $insert_id = $this->db->insert_id();
                    func_activity_log(2, 'Update training Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
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
                                    'training_id'   => $id,
                                    'file_name'  => $uploadedFile
                                    );

                                $this->Common_model->save('training_attachment', $file_data);
                            }
                        }
                    }

                    $this->session->set_flashdata('success', 'Training update successfully.');
                    redirect("training/training_list");
                } 
            // }else{
            //     $this->session->set_flashdata('warning', 'End date Less then start date');
            // }       
            }

            $this->data['info'] = $this->Training_model->get_scout_training_info($id);
            $this->data['attachments'] = $this->Training_model->get_attachment($id);

        // Dropdown        
            $this->data['progress'] = $this->Common_model->set_scout_progress();
            $this->data['section'] = $this->Common_model->set_scout_section();
            $this->data['appr_role'] = $this->Common_model->get_event_approve_role();
            $this->data['courses'] = $this->Common_model->get_course_by_progress_section($this->data['info']->progress_type, $this->data['info']->section_id);


        // Load page
            $this->data['meta_title'] = 'Training Update';
            $this->data['subview'] = 'edit';
            $this->load->view('backend/_layout_main', $this->data);
        }

        public function attachment_del($id, $eventID) {
            if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin())){
                redirect('dashboard');
            }

            $id = (int) decrypt_url($id);

            $info = $this->Training_model->get_attachment_single($id);
        // print_r($info->file_name); exit;
        // echo $this->file_path.'\\'.$info->file_name; exit;

            if(unlink($this->file_path.'\\'.$info->file_name)){
                $this->Training_model->get_attachment_delete($info->id);
                $this->session->set_flashdata('success', 'Information delete successfully.');
            }
            redirect('training/edit/'.$eventID);
        }


        /************************* Scouts Member *************************/
        /*****************************************************************/

        public function upcomming_training(){   
            if(!$this->ion_auth->is_scout_member()){
                redirect('dashboard');
            }

            $this->data['info'] = $this->data['userDetails']['user_info'];
        // echo '<pre>';
        // print_r($this->data['info']); exit;

        // Matching result list
            $this->data['results'] = $this->Training_model->upcomming_training_search($this->data['info']);

        // Load page
            $this->data['meta_title'] = 'Upcomming Training List';
            $this->data['subview'] = 'upcoming_training';
            $this->load->view('backend/_layout_main', $this->data);
        }    

        public function join_training($id){
            $id = (int) decrypt_url($id);
            $info = $this->data['userDetails']['user_info'];
            if ($id != NULL){
                $form_data = array(
                    'training_id'       => $id,
                    'app_date'          => date('Y-m-d'), 
                    'scout_id'          => $info->id,
                    'curr_region_id'    => $info->sc_region_id,
                    'curr_district_id'  => $info->sc_district_id,
                    'curr_upazila_id'   => $info->sc_upa_tha_id,
                    'curr_group_id'     => $info->sc_group_id
                    );
            // print_r($form_data);exit();

                if($this->Common_model->save('training_participant', $form_data)){                 
                    $this->session->set_flashdata('success', 'Apply training successfully.');
                    redirect("training/my_application");
                } 
            }else{
                $this->session->set_flashdata('warning', 'Something is wrong.');
                redirect("training/upcomming_event");
            }
        }

        public function my_application(){   
        // $region = $this->data['userDetails']['user_info']->sc_region_id;
        // $district = $this->data['userDetails']['user_info']->sc_district_id;

            $this->data['results'] = $this->Training_model->get_my_application();
            // Load page
            $this->data['meta_title'] = 'My Application List';
            $this->data['subview'] = 'my_application';
            $this->load->view('backend/_layout_main', $this->data);
        }

        public function my_app_cancle($id) {
            $id = (int) decrypt_url($id);
            if($this->Training_model->application_delete($id)){
                $this->session->set_flashdata('success', 'Application cancle successfully.');
                redirect('training/my_application');
            }
        }


        /************* Application Verification By Office ****************/
        /*****************************************************************/

        public function application_list($offset=0){   
            if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
                redirect('dashboard');
            }
            $limit = 25;

            if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training')){ 
                $results = $this->Training_model->get_applicant_data($limit, $offset, '');

            }elseif($this->ion_auth->is_region_admin()){
                $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
                $results = $this->Training_model->get_applicant_data($limit, $offset, '', $officeRegionID); 

            }elseif($this->ion_auth->is_district_admin()){         
                $officeDistrictID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
                $results = $this->Training_model->get_applicant_data($limit, $offset, '', '', $officeDistrictID);

            }elseif($this->ion_auth->is_upazila_admin()){
                $officeUpazilaID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
                $results = $this->Training_model->get_applicant_data($limit, $offset, '', '', '', $officeUpazilaID);

            }elseif($this->ion_auth->is_group_admin()){
                $officeGroupID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
                $results = $this->Training_model->get_applicant_data($limit, $offset, '', '', '', $officeGroupID);
            }

        // Result
            $this->data['results'] = $results['rows'];
            $this->data['total_rows'] = $results['num_rows'];

        //pagination
            $this->data['pagination'] = create_pagination('training/application_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

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
            $this->form_validation->set_rules('status', 'select verify status ', 'required|trim');
        // $this->form_validation->set_rules('participant_type_app', 'select participant type ', 'required|trim');
            if ($this->form_validation->run() == true){
            //$form_data = array('participant_type_app' => $this->input->post('participant_type_app'));

                if($this->ion_auth->is_admin() || $this->ion_auth->in_group('training')){ 
                    $form_data['verify_nhq'] = $this->input->post('status');
                }elseif($this->ion_auth->is_region_admin()){
                    $form_data['verify_region'] = $this->input->post('status');
                }elseif($this->ion_auth->is_district_admin()){ 
                    $form_data['verify_district'] = $this->input->post('status');
                }elseif($this->ion_auth->is_upazila_admin()){
                    $form_data['verify_upazila'] = $this->input->post('status');
                }elseif($this->ion_auth->is_group_admin()){
                    $form_data['verify_group'] = $this->input->post('status');
                }
            // print_r($form_data);exit();

                if($this->Common_model->edit('training_participant', $id, 'id', $form_data)){

                    /***********Activity Logs Start**********/
                // $insert_id = $this->db->insert_id();
                func_activity_log(2, 'Participant Verify ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/  

                // echo $this->db->last_query(); exit;
                $this->session->set_flashdata('success', 'Applicant training participant verify successfully.');

                redirect("training/application_list");
            }
        }

        $this->data['info'] = $this->Training_model->get_application($id);
        // print_r($this->data['info']); exit;
        $this->data['status'] = $this->Common_model->set_event_status();
        // $this->data['participant_type'] = $this->Common_model->set_event_participant_type();

        //Load view
        $this->data['meta_title'] = 'Training Participant Verification';
        $this->data['subview'] = 'participant_verify';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function applicant_list($id){   
        $id = (int) decrypt_url($id);

        if(!$id){
            redirect('dashboard');
        }elseif(!$this->Common_model->exists('scout_training', 'id', $id)){
            redirect('dashboard');
        }

        $this->data['results'] = $this->Training_model->get_applicant_list($id);

        // Load page
        $this->data['meta_title'] = 'Training Applicant List';
        $this->data['subview'] = 'training_applicant_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function participant_list($id){   
       $id = (int) decrypt_url($id);

       if(!$id){
        redirect('dashboard');
    }elseif(!$this->Common_model->exists('scout_training', 'id', $id)){
        redirect('dashboard');
    }

    $this->data['results'] = $this->Training_model->get_participant_list($id);

        // Load page
    $this->data['meta_title'] = 'Training Participant List';
    $this->data['subview'] = 'training_participant_list';
    $this->load->view('backend/_layout_main', $this->data);
}

public function training_certificate_pdf($id){
  if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('training'))){
     redirect('dashboard');
 }

 $id = (int) decrypt_url($id);

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
      //    show_404('award - president_scout_certificate_pdf - exitsts', TRUE);
      // }

      //Results
 $this->data['info'] = $this->Training_model->get_trining_certificate($id);
      // print_r($this->data['info']); exit;


      //...............................................................................
 $this->data['meta_title'] = "Training Certificate";
 $html = $this->load->view('training_certificate_pdf', $this->data, true);   
 $file_name = $id.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
 $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
 $mpdf->WriteHTML($html);

      //download it for 'D'. 
 $mpdf->Output($file_name, "I");
}



/***************************** Trainer ***************************/
/*****************************************************************/

public function trainer_list(){
    if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
        redirect('dashboard');
    }
    $limit = 10;

        // $this->data['trainers'] = $this->Training_model->get_trainers();
    $results = $this->Training_model->get_trainers($limit, $offset);

        //Result
    $this->data['results'] = $results['rows'];
    $this->data['total_rows'] = $results['num_rows'];

        //pagination
    $this->data['pagination'] = create_pagination('training/trainer_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        // Load page
    $this->data['meta_title'] = 'Trainer List';
    $this->data['subview'] = 'trainer_list';
    $this->load->view('backend/_layout_main', $this->data);
}

public function create_trainer(){
    if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
        redirect('dashboard');
    }

        // Validation
    $this->form_validation->set_rules('trainer_type', 'select trainer type', 'required|trim');

        // Submit form
    if ($this->form_validation->run() == true){

        $form_data = array(
            'trainer_type'     => $this->input->post('trainer_type'),
            'trainer_scout_id' => $this->input->post('trainer_scout_id'),
            'trainer_name'     => $this->input->post('trainer_name'),
            'organization'     => $this->input->post('organization'),
            'designation'      => $this->input->post('designation'),
            'phone_no'         => $this->input->post('phone_no'),
            'email_address'    => $this->input->post('email_address'),
            'pre_address'      => $this->input->post('pre_address')
            );
            // print_r($form_data);exit();

        if($this->Common_model->save('trainers', $form_data)){
            $insert_id = $this->db->insert_id();

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
                    func_activity_log(1, 'Create trainer ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                    /***********Activity Logs End**********/                   

                    $this->session->set_flashdata('success', 'New trainer insert successfully.');
                    redirect("training/trainer_list");
                } 

            }

        // Dropdown
        // $this->data['progress'] = $this->Common_model->set_scout_progress();
        // $this->data['section'] = $this->Common_model->set_scout_section();
        // $this->data['appr_role'] = $this->Common_model->get_event_approve_role();

        // Load page
            $this->data['meta_title'] = 'Create New Trainer';
            $this->data['subview'] = 'create_trainer';
            $this->load->view('backend/_layout_main', $this->data);
        }


        public function edit_trainer($id){
            if(!($this->ion_auth->is_admin() || $this->ion_auth->in_group('training') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
                redirect('dashboard');
            }

        // Validation
            $this->form_validation->set_rules('trainer_type', 'select trainer type', 'required|trim');

        // Form Validation
            if ($this->form_validation->run() == true){

                $form_data = array(
                    'trainer_type'     => $this->input->post('trainer_type'),
                    'trainer_scout_id' => $this->input->post('trainer_scout_id'),
                    'trainer_name'     => $this->input->post('trainer_name'),
                    'organization'     => $this->input->post('organization'),
                    'designation'      => $this->input->post('designation'),
                    'phone_no'         => $this->input->post('phone_no'),
                    'email_address'    => $this->input->post('email_address'),
                    'pre_address'      => $this->input->post('pre_address')
                    );
            //print_r($form_data);exit();

                if($this->Common_model->edit('trainers', $id, 'id', $form_data)){

                    /***********Activity Logs Start**********/
                // $insert_id = $this->db->insert_id();
                func_activity_log(2, 'Update training Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/  

                $this->session->set_flashdata('success', 'Trainer information update successfully.');
                redirect("training/trainer_list");
            } 

        }

        $this->data['info'] = $this->Training_model->get_trainer_info($id);        

        // Load page
        $this->data['meta_title'] = 'Training Update';
        $this->data['subview'] = 'edit_trainer';
        $this->load->view('backend/_layout_main', $this->data);
    }






    // public function edit_trainer($id){

    //     $this->form_validation->set_rules('trainer_name', 'Trainer Name', 'required|trim');
    //     $this->form_validation->set_rules('specialist', 'Specialist', 'required|trim');


    //     if ($this->form_validation->run() == true){

    //         $form_data = array(
    //             'trainer_name'     => $this->input->post('trainer_name'),
    //             'specialist'       => $this->input->post('specialist'),
    //         );
    //         //print_r($form_data);exit();


    //         if($this->Common_model->edit('trainer', $id, 'id', $form_data)){
    //                 /***********Activity Logs Start**********/
    //                 $insert_id = $this->db->insert_id();
    //                 func_activity_log(2, 'Edit trainer Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
    //                 /***********Activity Logs End**********/

    //             $this->session->set_flashdata('success', 'training Update successfully.');
    //             redirect("training/trainers_list");
    //         } 

    //     }

    //     $this->data['trainer'] = $this->Training_model->get_trainers_info($id);


    //     // Load page
    //     $this->data['meta_title'] = 'Edit Trainer/ Trainee';
    //     $this->data['subview'] = 'edit_trainer';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // public function training_list(){
    //     $this->data['training'] = $this->Training_model->get_data();

    //     // Load page
    //     $this->data['meta_title'] = 'Training List';
    //     $this->data['subview'] = 'training_list';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    


    /*************training_list_pdf function pdf start**************/
    public function training_list_pdf(){

        $this->data['training'] = $this->Training_model->get_data();
        //...............................................................................
        $this->data['meta_title'] = 'Training List';
        $html = $this->load->view('training_list_pdf', $this->data, true);   
        $file_name ="training_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************training_list_pdf function pdf End**************/

    public function trainers_list(){
        $this->data['trainers'] = $this->Training_model->get_trainers();

        // Load page
        $this->data['meta_title'] = 'Trainer/Trainee List';
        $this->data['subview'] = 'trainers_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*************trainers_list_pdf function pdf start**************/
    public function trainers_list_pdf(){

        $this->data['trainers'] = $this->Training_model->get_trainers();
        //...............................................................................
        $this->data['meta_title'] = 'Trainer/Trainee List';
        $html = $this->load->view('trainers_list_pdf', $this->data, true);   
        $file_name ="trainers_list_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************trainers_list_pdf function pdf End**************/

    // public function upcomming_training_list(){
    //     $this->data['training'] = $this->Training_model->upcomming_training();
    //     // Load page
    //     $this->data['meta_title'] = 'Upcomming Training List';
    //     $this->data['subview'] = 'training_list';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    // public function upcomming_training(){       
    //     $this->data['training'] = $this->Training_model->scout_member_training();
    //     // Load page
    //     $this->data['meta_title'] = 'Upcomming Training';
    //     $this->data['subview'] = 'training_list';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    /*************upcomming_training_pdf function pdf start**************/
    // public function upcomming_training_pdf(){

    //     $this->data['training'] = $this->Training_model->scout_member_training();
    //     //...............................................................................
    //     $this->data['meta_title'] = 'Upcomming Training';
    //     $html = $this->load->view('upcomming_training_pdf', $this->data, true);   
    //     $file_name ="upcomming_training_pdf.pdf";

    //     //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
    //     $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

    //     //generate the PDF from the given html
    //     $mpdf->WriteHTML($html);

    //     //download it for 'D'. 
    //     $mpdf->Output($file_name, "D");
    // }

    /*************upcomming_training_pdf function pdf End**************/


    // public function my_training(){       
    //     $this->data['training'] = $this->Training_model->get_scout_member_approved();
    //     // Load page
    //     $this->data['meta_title'] = 'My Training List';
    //     $this->data['subview'] = 'my_training_list';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }


    // public function details($id){
    //     $this->data['users'] = $this->ion_auth->user()->row();
    //     $this->data['training'] = $this->Training_model->get_info($id);
    //     $this->data['scout_member_list'] = $this->Training_model->get_scout_member_list($id);
    //     $this->data['scout_member'] = $this->Training_model->get_scout_member($id, $this->data['users']->id);


    //     $this->data['meta_title'] = 'Details Training ';
    //     $this->data['subview'] = 'details';
    //     $this->load->view('backend/_layout_main', $this->data);
    // }

    public function comments($id){
        $this->data['users'] = $this->ion_auth->user()->row();
        $this->data['training_id'] = $id;
        $this->data['training'] = $this->Training_model->get_info($id);

        if($this->Training_model->get_training_valid($id)==false){
            redirect('training/my_training');
        }

        $this->form_validation->set_rules('comments', 'comments', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'comments' => $this->input->post('comments')
                );
            //print_r($form_data);exit();
            
            if($this->Training_model->edit('training_to_scouts', $this->data['users']->id, $id,  $form_data)){                
                $this->session->set_flashdata('success', 'Successfully send your comments.');
                redirect('training/my_training'); 
            } 
            redirect('training/my_training');     
        }

        $this->data['meta_title'] = 'Training Comments';
        $this->data['subview'] = 'comments';
        $this->load->view('backend/_layout_main', $this->data);
    }

   // public function edit($id){

   //      $this->data['users'] = $this->ion_auth->user()->row();

   //      $this->form_validation->set_rules('training_name', 'Training Name', 'required|trim');
   //      $this->form_validation->set_rules('training_center', 'Training Center', 'required|trim');
   //      $this->form_validation->set_rules('training_details', 'Training Details', 'required|trim');
   //      $this->form_validation->set_rules('training_start_date', ' To Date', 'required|trim');
   //      $this->form_validation->set_rules('training_end_date', 'From Date', 'required|trim');
   //      $this->form_validation->set_rules('training_duration', ' Training Duration', 'required|trim');
   //      $this->form_validation->set_rules('min_attendance', 'Minimum Attendance', 'required|trim');
   //      $this->form_validation->set_rules('trainer_id', 'Trainer Id', 'required|trim');
   //      $this->form_validation->set_rules('training_type', 'Training Type', 'required|trim');
   //      $this->form_validation->set_rules('training_notify[]', 'Training Notify', 'required|trim');
   //      $this->form_validation->set_rules('sc_region_id', 'Scout Region', 'trim');
   //      $this->form_validation->set_rules('sc_district_id', 'Scout District', 'trim');
   //      $this->form_validation->set_rules('sc_upa_tha_id', 'Scout Upazila/thana', 'trim');
   //      $this->form_validation->set_rules('sc_group_id', 'Scout Group', 'trim');

   //      if(count($this->input->post('training_notify'))>0){
   //          $this->data['training_notify_data']=$this->input->post('training_notify');
   //      }else{
   //          $this->data['training_notify_data']=array();
   //      }

   //      if ($this->form_validation->run() == true){

   //          $this->data['training_notify']=implode(',', $this->input->post('training_notify'));

   //          $form_data = array(
   //              'training_name'         => $this->input->post('training_name'),
   //              'training_center'       => $this->input->post('training_center'),
   //              'training_details'      => $this->input->post('training_details'),
   //              'training_start_date'   => date_db_format($this->input->post('training_start_date')),
   //              'training_end_date'     => date_db_format($this->input->post('training_end_date')),
   //              'training_type'         => $this->input->post('training_type'),
   //              'training_duration'     => $this->input->post('training_duration'),
   //              'min_attendance'        => $this->input->post('min_attendance'),
   //              'trainer_id'            => $this->input->post('trainer_id'),
   //              'training_notify'       => $this->data['training_notify'],
   //              'sc_region_id'          => $this->input->post('sc_region_id') !=NULL? $this->input->post('sc_region_id'):Null,
   //              'sc_district_id'        => $this->input->post('sc_district_id') !=NULL? $this->input->post('sc_district_id'):Null,
   //              'sc_upa_tha_id'         => $this->input->post('sc_upa_tha_id') !=NULL? $this->input->post('sc_upa_tha_id'):Null,
   //              'sc_group_id'           => $this->input->post('sc_group_id') !=NULL? $this->input->post('sc_group_id'):Null,
   //              'created_by'            => $this->data['users']->id,
   //          );
   //          //print_r($form_data);exit();

   //          if($this->input->post('training_end_date')>=$this->input->post('training_start_date')){
   //             if($this->Common_model->edit('training', $id, 'id', $form_data)){                
   //                  $this->session->set_flashdata('success', 'training Update successfully.');
   //                  redirect("training/training_list");
   //              } 
   //          }else{
   //              $this->session->set_flashdata('warning', 'End Date Lessthen Start Date');
   //          }       
   //      }

   //      $this->data['training'] = $this->Training_model->get_info($id);
   //      //dropdown

   //      $this->data['divisions'] = $this->Common_model->get_division(); 
   //      $this->data['districts'] = $this->Common_model->get_district(); 
   //      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
   //      $this->data['regions'] = $this->Common_model->get_regions(); 
   //      $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
   //      $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
   //      $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
   //      $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office();
   //      $this->data['scout_section'] = $this->Common_model->set_scout_section();
   //      $this->data['training_list'] = $this->Common_model->get_dd_training_list();
   //      $this->data['teacher'] = $this->Training_model->get_trainer('trainer');

   //      // Load page
   //      $this->data['meta_title'] = 'Edit Training';
   //      $this->data['subview'] = 'edit_training';
   //      $this->load->view('backend/_layout_main', $this->data);
   //  }

    function status($scout_id, $training_id, $status) {
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
            'training_id'     => $training_id,
            'status'       => $status_data
            );

        if(empty($this->Training_model->get_scout_member($training_id, $scout_id))){

            if($this->Common_model->save('training_to_scouts', $form_data2)){
                $this->session->set_flashdata('success', 'Information update successfully.'); 
            }else{
                $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
            }
        }else{
            if($this->Training_model->edit('training_to_scouts', $scout_id, $training_id, $form_data)){
                $this->session->set_flashdata('success', 'Information update successfully.'); 
            }else{
                $this->session->set_flashdata('warning', 'Information update unsuccessfully.');
            }
        }

        redirect('training/details/'.$training_id);
    }

    // function delete($id) {
    //     echo $id = (int) decrypt_url($id); exit;
    //     $this->data['info'] = $this->Training_model->delete($id);
    //     /***********Activity Logs Start**********/
    //     //$insert_id = $this->db->insert_id();
    //     func_activity_log(3, 'Delete training Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
    //     /***********Activity Logs End**********/
    //     $this->session->set_flashdata('success', 'Information delete successfully.');
    //     redirect('training/training_list');
    // }

    function delete($id) {
        $id = (int) decrypt_url($id);

        $this->data['info'] = $this->Training_model->delete($id);
        /***********Activity Logs Start**********/
        $insert_id = $this->db->insert_id();
        func_activity_log(3, 'Delete training data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('training/training_list');
    }



    function trainer_delete($id) {
        $this->data['info'] = $this->Training_model->trainer_delete($id);
        /***********Activity Logs Start**********/
        //$insert_id = $this->db->insert_id();
        func_activity_log(3, 'Delete Trainer Data ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/

        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('training/trainers_list');
    }

}