<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_office extends Backend_Controller {
	
   // var $userID;
   var $img_path;

   public function __construct(){
      parent::__construct();
      // print_r($this->session->all_userdata());

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;
      $this->data['module_name'] = 'My Office';
      $this->load->model('Common_model');
      $this->load->model('offices/Offices_model');
      $this->img_path = realpath(APPPATH . '../offices_img');
      //$this->userID = $this->session->userdata('user_id');
   }

   public function index(){	

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         $officeInfo = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;  
         if($officeInfo){
            //Office Info
            $this->data['office_info'] = $this->Offices_model->get_nhq_user_info($officeInfo);    
            // print_r($this->data['office_info']); exit;
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'nhq_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->in_group('award')){
         $officeInfo = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;  
         if($officeInfo){
            //Office Info
            $this->data['office_info'] = $this->Offices_model->get_nhq_user_info($officeInfo);    
            // print_r($this->data['office_info']); exit;
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'nhq_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->in_group('event')){
         $officeInfo = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;  
         if($officeInfo){
            //Office Info
            $this->data['office_info'] = $this->Offices_model->get_nhq_user_info($officeInfo);    
            // print_r($this->data['office_info']); exit;
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'nhq_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->in_group('training')){
         $officeInfo = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;  
         if($officeInfo){
            //Office Info
            $this->data['office_info'] = $this->Offices_model->get_nhq_user_info($officeInfo);    
            // print_r($this->data['office_info']); exit;
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'nhq_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->is_region_admin()){
         $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;  
         if($officeID){
            //Office Info
            $this->data['office_info'] = $this->Offices_model->get_region_info($officeID);    
            // print_r($this->data['office_info']); exit;
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'region_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->is_district_admin()){         
         $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;  
         if($officeID){
            $this->data['office_info'] = $this->Offices_model->get_scout_district_info($officeID);    
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'district_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->is_upazila_admin()){         
         $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;  
         if($officeID){
            $this->data['office_info'] = $this->Offices_model->get_scout_upazila_info($officeID);    
         }else{
            $this->data['office_info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'upazila_index';
         $this->load->view('backend/_layout_main', $this->data);

      }elseif($this->ion_auth->is_group_admin()){         
         $officeInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
         if($officeInfo){
            //Basic Info
            $this->data['info'] = $this->Offices_model->get_scout_group_info($officeInfo);
            $this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($officeInfo); 
            //Committee
            //$this->data['committees'] = $this->Offices_model->get_committee_by_scout_group_office_id($officeID);
            // if($this->data['committees']){
            //    $results = $this->Committee_model->get_scout_group_committee_info($this->data['committees'][0]->id); 
            //    // $this->data['committee_info'] = $results['info'];
            //    $this->data['committee_members'] = $results['members'];
            //    foreach ($results['members'] as $k => $members){
            //       $results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
            //    }
            // }   
            // Unit        
            
         }else{
            $this->data['info'] = (object) ['id' => 0];
         }

         //Load page       
         $this->data['meta_title'] = 'My Office';
         $this->data['subview'] = 'group_index';
         $this->load->view('backend/_layout_main', $this->data);
      
      }elseif($this->ion_auth->is_vendor()){  
                   
            $officeInfo = $this->Offices_model->get_nhq_office_by_user_id($this->userSessID)->id;  
            if($officeInfo){
               //Office Info
               $this->data['office_info'] = $this->Offices_model->get_nhq_user_info($officeInfo);    
               // print_r($this->data['office_info']); exit;
            }else{
               $this->data['office_info'] = (object) ['id' => 0];
            }

            //Load page       
            $this->data['meta_title'] = 'My Office';
            $this->data['subview'] = 'vendor_index';
            $this->load->view('backend/_layout_main', $this->data); 

      }else{
         redirect('dashboard');
      }
   }

   

   public function scout_group_update(){
      //Check Authentication
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }      

      // $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;      
      // print_r($this->data['info']); exit;
      $officeInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
      $region     = $officeInfo->grp_region_id;
      $district   = $officeInfo->grp_scout_dis_id;
      $upazila    = $officeInfo->grp_scout_upa_id;
      $groupID    = $officeInfo->id;      

      //Validation
      $this->form_validation->set_rules('grp_type', 'group type', 'required|trim'); 
      $this->form_validation->set_rules('grp_name', 'group name', 'required|trim|max_length[255]');      
      $this->form_validation->set_rules('grp_remarks', 'scout region', 'trim');
      // $this->form_validation->set_rules('grp_region_id', 'scout region', 'required|trim');
      // $this->form_validation->set_rules('grp_scout_dis_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('grp_charter', 'charter number', 'trim');
      $this->form_validation->set_rules('grp_created', 'created date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_dis', 'district registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_dis_date', 'district registration no date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_upa', 'upazila registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_upa_date', 'upazila registration date', 'trim');

      if($this->form_validation->run() == true){
         $form_data = array(
            'grp_type'        => $this->input->post('grp_type'),
            'grp_leader'      => $this->input->post('grp_leader'),
            'grp_institute_id'=> $this->input->post('grp_institute_id'),
            'grp_name'        => $this->input->post('grp_name'),   
            'grp_name_bn'     => $this->input->post('grp_name_bn'),         
            'grp_remarks'     => $this->input->post('grp_remarks'),            
            'grp_mobile'      => $this->input->post('grp_mobile')?$this->input->post('grp_mobile'):NULL,
            'grp_email'       => $this->input->post('grp_email')?$this->input->post('grp_email'):NULL,
            'grp_address'     => $this->input->post('grp_address')?$this->input->post('grp_address'):NULL,
            'grp_address_en'     => $this->input->post('grp_address_en')?$this->input->post('grp_address_en'):NULL,
            'grp_created'     => date_db_format($this->input->post('grp_created')),
            'grp_charter'     => $this->input->post('grp_charter'),
            'grp_reg_num_dis' => $this->input->post('grp_reg_num_dis'),
            'grp_reg_dis_date'=> date_db_format($this->input->post('grp_reg_dis_date')),
            'grp_reg_num_upa' => $this->input->post('grp_reg_num_upa'),
            'grp_reg_upa_date'=> date_db_format($this->input->post('grp_reg_upa_date'))
            );

         if($this->Common_model->edit('office_groups', $groupID, 'id', $form_data)){

            for ($i=0; $i<sizeof($_POST['unit_name']); $i++) { 
               //check exists data
               $data_exists = $this->Common_model->exists('office_unit', 'id', decrypt_url($_POST['hide_unit_id'][$i]));
               if($data_exists){
                  $form_data2 = array(
                     'unit_name'          => $_POST['unit_name'][$i],
                     'unit_name_bn'       => $_POST['unit_name_bn'][$i],
                     'unit_type'          => $_POST['unit_type'][$i]
                     ); 
                  $this->Common_model->edit('office_unit', decrypt_url($_POST['hide_unit_id'][$i]), 'id', $form_data2);
               }else{
                  $form_data2 = array(
                     'unit_name'          => $_POST['unit_name'][$i],
                     'unit_name_bn'       => $_POST['unit_name_bn'][$i],
                     'unit_type'          => $_POST['unit_type'][$i],           
                     'unit_region_id'     => $region,
                     'unit_scout_dis_id'  => $district,
                     'unit_scout_upa_id'  => $upazila,
                     'unit_sc_grp_id'     => $groupID
                     );
                  $this->Common_model->save('office_unit', $form_data2);
               }
            }

            $this->session->set_flashdata('success', 'Update scouts group and unit successfully.');
            redirect("my_office");
         }
      }
      
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID); 
      $this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($groupID);

      $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
      $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
      $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
      $this->data['sc_unit_types'] = $this->Common_model->set_scout_unit_type(); 

      // $this->data['divisions'] = $this->Common_model->get_division(); 
      // $this->data['districts'] = $this->Common_model->get_district(); 
      // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      // $this->data['regions'] = $this->Common_model->get_regions(); 
      // $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 

      // Load page
      $this->data['meta_title'] = 'My Scouts Group Update';
      $this->data['subview'] = 'scout_group_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_update(){
      //Check Authentication
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }

      $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($office); 
      // print_r($this->data['info']); exit;

      //Validation
      $this->form_validation->set_rules('upa_name', 'upazila name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('upa_name_en', 'upazila name english', 'required|trim|max_length[255]');

      //Input data
      if($this->form_validation->run() == true){
         $form_data = array(            
            'upa_name' => $this->input->post('upa_name'),
            'upa_name_en' => $this->input->post('upa_name_en'),
            'upa_description' => $this->input->post('upa_description'),
            'upa_description_en' => $this->input->post('upa_description_en'),
            'upa_phone'  => $this->input->post('upa_phone')?$this->input->post('upa_phone'):NULL,
            'upa_fax'    => $this->input->post('upa_fax')?$this->input->post('upa_fax'):NULL,
            'upa_email'  => $this->input->post('upa_email')?$this->input->post('upa_email'):NULL,
            'upa_address'=> $this->input->post('upa_address')?$this->input->post('upa_address'):NULL,
            'upa_address_en'=> $this->input->post('upa_address')?$this->input->post('upa_address_en'):NULL
            );

         if($this->Common_model->edit('office_upazila', $office, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Upazila scouts information update successfully.');
            redirect("my_office");
         }
      }      

      // Load page
      $this->data['meta_title'] = 'Update Scouts Upazila Office';
      $this->data['subview'] = 'upazila_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_update(){
      //Check Authentication
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }

      $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
      $this->data['info'] = $this->Offices_model->get_scout_district_info($office); 

      //Validation
      $this->form_validation->set_rules('dis_name', 'district name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('dis_name_en', 'district name english', 'required|trim|max_length[255]');
      
      //Input data
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'dis_name'   => $this->input->post('dis_name'),
            'dis_name_en'   => $this->input->post('dis_name_en'),
            'dis_description'   => $this->input->post('dis_description'),
            'dis_description_en'   => $this->input->post('dis_description_en'),
            'dis_phone'  => $this->input->post('dis_phone')?$this->input->post('dis_phone'):NULL,
            'dis_fax'    => $this->input->post('dis_fax')?$this->input->post('dis_fax'):NULL,
            'dis_email'  => $this->input->post('dis_email')?$this->input->post('dis_email'):NULL,
            'dis_address'=> $this->input->post('dis_address')?$this->input->post('dis_address'):NULL,
            'dis_address_en'=> $this->input->post('dis_address')?$this->input->post('dis_address_en'):NULL
            );

         if($this->Common_model->edit('office_district', $office, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Scouts district office information update successfully.');
            redirect("my_office");
         }
      }

      //Load View
      $this->data['meta_title'] = 'Update Scouts District Office';
      $this->data['subview'] = 'district_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_update(){
      //Check Authentication
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
      $this->data['info'] = $this->Offices_model->get_region_info($office); 

      //Validation       
      $this->form_validation->set_rules('region_name', 'region name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('region_name_en', 'region name english', 'required|trim|max_length[255]');

      $uploadedFile='';
      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      //Input data
      if ($this->form_validation->run() == true){
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg|gif';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 1024;

            $this->load->library('upload', $config);
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $uploadedFile = $uploadData['file_name'];
                // print_r($uploadedFile);
               $this->data['message'] = 'File has been uploaded successfully.';
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         $form_data = array(
            'region_name'   => $this->input->post('region_name'),
            'region_name_en'=> $this->input->post('region_name_en'),
            'region_description' => $this->input->post('region_description'),
            'region_description_bn' => $this->input->post('region_description_bn'),
            'region_phone'  => $this->input->post('region_phone')?$this->input->post('region_phone'):NULL,
            // 'region_phone_bn'  => $this->input->post('region_phone_bn')?$this->input->post('region_phone_bn'):NULL,
            'region_fax'    => $this->input->post('region_fax')?$this->input->post('region_fax'):NULL,
            // 'region_fax_bn'    => $this->input->post('region_fax_bn')?$this->input->post('region_fax_bn'):NULL,
            // 'region_email_bn'  => $this->input->post('region_email_bn')?$this->input->post('region_email_bn'):NULL,
            'region_address'=> $this->input->post('region_address')?$this->input->post('region_address'):NULL,
            'region_address_bn'=> $this->input->post('region_address_bn')?$this->input->post('region_address_bn'):NULL
            );

         if($_FILES['userfile']['size'] > 0){
            $form_data['region_logo'] = $uploadedFile;
         }
         // print_r($form_data); exit;

         if($this->Common_model->edit('office_region', $office, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Scouts region office information update successfully.');
            redirect("my_office");
         }
      }

      //Load view
      $this->data['meta_title'] = 'Update Scouts Region Office';
      $this->data['subview'] = 'region_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function change_password(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
      $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

      $user = $this->ion_auth->user()->row();

      if ($this->form_validation->run() == true){
         $identity = $this->session->userdata('identity');
         $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
         if ($change){
            //if the password was successfully changed
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect('my_office'); // $this->logout();
         } else {
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            // redirect('my_profile');
         }
      }
      // display the form
      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
      $this->data['old_password'] = array(
         'name' => 'old',
         'id'   => 'old',
         'type' => 'password',
         'class' => 'form-control input-sm',
         'autocomplete' => 'off',
         'placeholder' => '',
         );
      $this->data['new_password'] = array(
         'name'    => 'new',
         'id'      => 'new',
         'type'    => 'password',
         'class' => 'form-control input-sm',
         'placeholder' => '',
         'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
         );
      $this->data['new_password_confirm'] = array(
         'name'    => 'new_confirm',
         'id'      => 'new_confirm',
         'type'    => 'password',
         'class' => 'form-control input-sm',
         'placeholder' => '',
         'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
         );
      $this->data['user_id'] = array(
         'name'  => 'user_id',
         'id'    => 'user_id',
         'type'  => 'hidden',
         'value' => $user->id,
         );

      if($this->ion_auth->is_region_admin()){
         $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;      
         $this->data['info'] = $this->Offices_model->get_region_info($officeID);
      }elseif($this->ion_auth->is_district_admin()){         
         $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;  
         $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID);  
      }elseif($this->ion_auth->is_upazila_admin()){
         $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;            
         $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID);
      }elseif($this->ion_auth->is_group_admin()){
         $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
         $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID);
      }

      //Load page       
      $this->data['meta_title'] = 'Change Password';
      $this->data['subview'] = 'change_password';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 1050000; 
      $size_kb = '1 MB';

      if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
         if(!in_array($mime, $allowed_mime_type_arr)){                
            $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png file.');
            return false;
         }elseif($_FILES["userfile"]["size"] > $file_size){
            $this->form_validation->set_message('file_check', 'Maximum file size '.$size_kb);
            return false;
         }else{
            return true;
         }
      }else{
         $this->form_validation->set_message('file_check', 'Please choose a image file to upload.');
         return false;
      }
   }


   // public function scout_unit_create(){
   //    $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;

   //    $this->form_validation->set_rules('unit_type', 'unit type', 'required|trim'); 
   //    // $this->form_validation->set_rules('unit_div_id', 'division', 'required|trim'); 
   //    // $this->form_validation->set_rules('unit_dis_id', 'district', 'required|trim');     
   //    // $this->form_validation->set_rules('unit_upa_id', 'upazila/thana', 'trim'); 
   //    // $this->form_validation->set_rules('unit_region_id', 'scout region', 'required|trim');
   //    // $this->form_validation->set_rules('unit_scout_dis_id', 'scout district', 'required|trim');
   //    // $this->form_validation->set_rules('unit_scout_upa_id', 'scout upazila', 'trim');
   //    // $this->form_validation->set_rules('unit_sc_grp_id', 'scout group', 'required|trim');
   //    $this->form_validation->set_rules('unit_name', 'group name', 'required|trim|max_length[255]');
   //    $this->form_validation->set_rules('unit_number', 'number', 'numeric|trim');
   //    // $this->form_validation->set_rules('unit_section', 'scout section', 'required|trim');

   //    $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID);      
   //    $region     = $this->data['info']->grp_region_id;
   //    $district   = $this->data['info']->grp_scout_dis_id;
   //    $upazila    = $this->data['info']->grp_scout_upa_id;
   //    $group      = $this->data['info']->id;

   //    if ($this->form_validation->run() == true){
   //       $form_data = array(
   //          'unit_leader'     => $this->input->post('unit_leader'),  
   //          'unit_type'       => $this->input->post('unit_type'),           
   //          'unit_region_id'  => $region,
   //          'unit_scout_dis_id' => $district,
   //          'unit_scout_upa_id' => $upazila,
   //          'unit_sc_grp_id'  => $group,
   //          'unit_name'       => $this->input->post('unit_name'),
   //          'unit_created'    => date_db_format($this->input->post('unit_created')),
   //          'unit_number'     => $this->input->post('unit_number'),
   //          'unit_mobile'     => $this->input->post('unit_mobile')?$this->input->post('unit_mobile'):NULL,
   //          'unit_email'      => $this->input->post('unit_email')?$this->input->post('unit_email'):NULL,
   //          'unit_address'    => $this->input->post('unit_address')?$this->input->post('unit_address'):NULL
   //          );

   //       if($this->Common_model->save('office_unit', $form_data)){
   //          $this->session->set_flashdata('success', 'Create scouts unit successfully.');
   //          redirect("my_office");
   //       }
   //    }

   //    // $this->data['divisions'] = $this->Common_model->get_division(); 
   //    // $this->data['districts'] = $this->Common_model->get_district(); 
   //    // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
   //    // $this->data['regions'] = $this->Common_model->get_regions(); 
   //    // $this->data['scout_section'] = $this->Common_model->set_scout_section(); 
   //    $this->data['sc_unit_types'] = $this->Common_model->set_scout_unit_type(); 
      
   //    // Office Info
   //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
   //    $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
   //    $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
   //    $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);

   //    // Load page
   //    $this->data['meta_title'] = 'Create Scout Unit Office';
   //    $this->data['subview'] = 'scout_unit_create';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }
}