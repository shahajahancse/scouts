<?php defined('BASEPATH') OR exit('No direct script access allowed');

class edirectory extends Backend_Controller {
   // var $userSessID;   
   // var $img_path;
   // var $img_orginal_path;
   // var $img_thumb_path;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'E-Directory';
      $this->load->model('Edirectory_model');
      // $this->load->model('Scouts_member_model');
      $this->userSessID = $this->session->userdata('user_id');

      $this->img_path_profile = realpath(APPPATH . '../profile_img');
      $this->img_path = realpath(APPPATH . '../uploads/edirectory_img');
      $this->img_orginal_path = realpath(APPPATH . '../temp_dir/');
      $this->img_thumb_path = realpath(APPPATH . '../temp_dir/_thumb/');
   }

   public function index(){
      redirect('dashboard');
   }

   public function listing($offset=0){
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 1, 1); 

      }elseif($this->ion_auth->is_region_admin()){                  
         // Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 2, 1, $office); 

      }elseif($this->ion_auth->is_district_admin()){  
         // District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 3, 1, '', $office);

      }elseif($this->ion_auth->is_upazila_admin()){  
         // Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;       
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 4, 1, '', '', $office);

      }elseif($this->ion_auth->is_group_admin()){    
         // Group Admin
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;     
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1, '', '', '', $office);

      }else{
         redirect('dashboard');
      }
      
      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('edirectory/listing/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(1);

      // Load view
      $this->data['meta_title'] = 'E-Directory Contact';
      $this->data['subview'] = 'listing';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create(){

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('award - recommendation_form - exitsts', TRUE);
      // }

      // Result
      //$this->data['info'] = $this->Award_model->get_award_circular_info($dataID);

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
         $office_level = 1;
         //Dropdown      
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(1);

      }elseif($this->ion_auth->is_region_admin()){
         $office_level = 2;
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
         $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(2);

      }elseif($this->ion_auth->is_district_admin()){    
         // District Admin        
         $office_level = 3;
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         //Dropdown
         $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(3);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office_level = 4;
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;         
         $upazila    = $office->id;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         //Dropdown
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', '  grp_scout_upa_id', $upazila);
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(4);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office_level = 5;
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id; //exit;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);
         //Dropdown
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(5);

      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      // Validation
      $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
      $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name', 'name', 'required|trim');

      if($this->input->post('memberType') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
      }

      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'office_level'    => $office_level,
            'scout_desig_id'  => $this->input->post('scout_desig_id'),
            'other_desig_name'=> $this->input->post('other_desig_name'),
            'responsibility'  => $this->input->post('responsibility'),
            'scout_id'        => $this->input->post('scout_member_id'),    
            'name'            => $this->input->post('name'),
            'name_bn'         => $this->input->post('name_bn'),
            'phone'           => $this->input->post('phone'),
            'email'           => $this->input->post('email'),
            'phone_official'  => $this->input->post('phone_official'),
            'email_official'  => $this->input->post('email_official'),
            'address'         => $this->input->post('present_address'),            
            'profe_desig'     => $this->input->post('profe_desig'),
            'others_info'     => $this->input->post('others_info'),
            'gender'          => $this->input->post('gender'),
            'bg_id'           => $this->input->post('bg_id'),
            'sc_region_id'    => $region != NULL? $region:NULL,
            'sc_district_id'  => $district != NULL? $district:NULL,
            'sc_upzaila_id'   => $upazila != NULL? $upazila:NULL,
            'sc_group_id'     => $group != NULL? $group:NULL,
            'created'         => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('edirectory', $form_data)){   
            $insert_id = $this->db->insert_id();

            // If scouts ID update main user table
            if($this->input->post('scout_member_id')){
               $form_data2 = array(  
                  'first_name'      =>  $this->input->post('name'), 
                  'phone'           =>  $this->input->post('phone'),   
                  'email'           =>  $this->input->post('email')               
                  );   

               $this->Common_model->edit('users', $this->input->post('scout_member_id'), 'id', $form_data2);
            }
            
            //Copy image, rename and remove from temp directory
            if($this->input->post('hide_img') != NULL){
               if($this->input->post('scout_member_id')){
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                  if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                     $saveDir = $this->img_path_profile.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }else{
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                  if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                     $saveDir = $this->img_path.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }               
            }
            
            // Success Message
            $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
            redirect("edirectory/listing/");
         }
      }

      // Dropdown
      $this->data['blood_group'] = $this->Common_model->get_blood_group();

      // $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      // $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      // $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      // $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');      

      // Load Page
      $this->data['meta_title'] = 'Create E-Directory Contact';
      $this->data['subview'] = 'create';
      $this->load->view('backend/_layout_main', $this->data);
   }
   
   public function details($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('edirectory', 'id', $dataID)) { 
         show_404('edirectory - details - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Edirectory_model->get_contact_details($dataID);

      // Load Page
      $this->data['meta_title'] = 'Details E-Directory Contact';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function edit($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('edirectory', 'id', $dataID)) { 
         show_404('edirectory - details - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Edirectory_model->get_contact_details($dataID);

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
         $office_level = 1;
         //Dropdown      
         // $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(1);

      }elseif($this->ion_auth->is_region_admin()){
         $office_level = 2;
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
         $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(2);

      }elseif($this->ion_auth->is_district_admin()){    
         // District Admin        
         $office_level = 3;
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         //Dropdown
         $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);
         // $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(3);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office_level = 4;
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;         
         $upazila    = $office->id;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         //Dropdown
         $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', '  grp_scout_upa_id', $upazila);
         // $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(4);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office_level = 5;
         $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id; //exit;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);
         //Dropdown
         // $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(5);

      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      // Validation
      $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name', 'name', 'required|trim');

      // if($this->input->post('memberType') == 1){
      //    $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
      // }

      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'scout_desig_id'  => $this->input->post('scout_desig_id'),
            'other_desig_name'=> $this->input->post('other_desig_name'),
            'responsibility'  => $this->input->post('responsibility'),
            'name'            => $this->input->post('name'),
            'name_bn'         => $this->input->post('name_bn'),
            'phone'           => $this->input->post('phone'),
            'email'           => $this->input->post('email'),
            'phone_official'  => $this->input->post('phone_official'),
            'email_official'  => $this->input->post('email_official'),
            'address'         => $this->input->post('present_address'),            
            'profe_desig'     => $this->input->post('profe_desig'),
            'others_info'     => $this->input->post('others_info'),
            'gender'          => $this->input->post('gender'),
            'bg_id'           => $this->input->post('bg_id'),
            'modified'         => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;        

            // print_r($form_data); exit;
         if($this->Common_model->edit('edirectory', $dataID, 'id', $form_data)){
            /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'edirectory edit update ID :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/

                //Copy image, rename and remove from temp directory
                if($this->input->post('hide_img') != NULL){
                  if($this->input->post('scout_member_id')){
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                     if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                        $saveDir = $this->img_path_profile.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }else{
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $dataID.'.'.$file_extension;

                  //Update table image field
                     if($this->Edirectory_model->set_image_file($dataID, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }               
               }

               $this->session->set_flashdata('success', 'Informatioin update successfully.');
               
               if($this->data['info']->office_level == 1){
                  redirect('edirectory/listing');
               }elseif($this->data['info']->office_level == 2){
                  redirect('edirectory/listing_region');
               }elseif($this->data['info']->office_level == 3) {
                 redirect('edirectory/listing_district');
               }elseif($this->data['info']->office_level == 4) {
                 redirect('edirectory/listing_upazila');
               }elseif($this->data['info']->office_level == 5) {
                 redirect('edirectory/listing_scout_group');
               }
            }
         }

        //Dropdown
         $this->data['blood_group'] = $this->Common_model->get_blood_group();

         if($this->data['info']->office_level == 1){
            $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(1);
         }elseif($this->data['info']->office_level == 2){
            $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(2);
         }elseif($this->data['info']->office_level == 3) {
           $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(3);
         }elseif($this->data['info']->office_level == 4) {
           $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(4);
         }elseif($this->data['info']->office_level == 5) {
           $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(5);
         }

        // Load page$this->data['blood_group'] = $this->Common_model->get_blood_group();
         $this->data['meta_title'] = 'Edit E-Directory Contact';
         $this->data['subview'] = 'edit';
         $this->load->view('backend/_layout_main', $this->data);
      }

      /****************************** Region *******************************/
      /*********************************************************************/

      public function listing_region($offset=0){
         $limit = 25;

         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 2, 1); 

         }elseif($this->ion_auth->is_region_admin()){                  
         // Region Admin
            $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 2, 1, $office); 

         }else{
            redirect('dashboard');
         }

      //Result
         $this->data['results'] = $results['rows'];
         $this->data['total_rows'] = $results['num_rows'];

      //pagination
         $this->data['pagination'] = create_pagination('edirectory/listing_region/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(2);

      // Load view
         $this->data['meta_title'] = 'Region E-Directory Contact';
         $this->data['subview'] = 'listing_region';
         $this->load->view('backend/_layout_main', $this->data);
      }

      public function create_contact_region(){
         $office_level = 2;
      //scout office
         $region = NULL;
         $district = NULL;
         $upazila = NULL;
         $group = NULL;

      //Check authentication
         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 

            $this->data['regions'] = $this->Common_model->get_regions(); 

         }elseif($this->ion_auth->is_region_admin()){         
         //Region admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
            $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);

         }else{
            redirect('dashboard');
         }

      // Validation
         $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
         $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
         $this->form_validation->set_rules('name', 'name', 'required|trim');

         if($this->input->post('memberType') == 1){
            $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
         }

      // DB Insert
         if ($this->form_validation->run() == true){
            $form_data = array(            
               'office_level'    => $office_level,
               'scout_desig_id'  => $this->input->post('scout_desig_id'),
               'other_desig_name'=> $this->input->post('other_desig_name'),
               'responsibility'  => $this->input->post('responsibility'),
               'scout_id'        => $this->input->post('scout_member_id'),    
               'name'            => $this->input->post('name'),
               'name_bn'         => $this->input->post('name_bn'),
               'phone'           => $this->input->post('phone'),
               'email'           => $this->input->post('email'),
               'phone_official'  => $this->input->post('phone_official'),
               'email_official'  => $this->input->post('email_official'),
               'address'         => $this->input->post('present_address'),            
               'profe_desig'     => $this->input->post('profe_desig'),
               'others_info'     => $this->input->post('others_info'),
               'gender'          => $this->input->post('gender'),
               'sc_region_id'    => $region != NULL ? $region:$this->input->post('sc_region_id'),
               'sc_district_id'  => $district != NULL ? $district:$this->input->post('sc_district_id'),
               'sc_upzaila_id'   => $upazila != NULL ? $upazila:$this->input->post('sc_upa_tha_id'), 
               'sc_group_id'     => $group != NULL ? $group:$this->input->post('sc_group_id'),
               'created'         => date('Y-m-d H:i:s')
               );          
         // print_r($form_data); exit;

            if($this->Common_model->save('edirectory', $form_data)){   
               $insert_id = $this->db->insert_id();

            // If scouts ID update main user table
               if($this->input->post('scout_member_id')){
                  $form_data2 = array(  
                     'first_name'      =>  $this->input->post('name'), 
                     'phone'           =>  $this->input->post('phone'),   
                     'email'           =>  $this->input->post('email')               
                     );   

                  $this->Common_model->edit('users', $this->input->post('scout_member_id'), 'id', $form_data2);
               }

            //Copy image, rename and remove from temp directory
               if($this->input->post('hide_img') != NULL){
                  if($this->input->post('scout_member_id')){
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                     if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                        $saveDir = $this->img_path_profile.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }else{
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                     if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }               
               }

            // Success Message
               $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
               redirect("edirectory/listing_region");
            }
         }

      //Dropdown
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(2);

      // Load Page
         $this->data['meta_title'] = 'Create Region E-Directory Contact';
         $this->data['subview'] = 'create_contact_region';
         $this->load->view('backend/_layout_main', $this->data);
      }

      /***************************** District ******************************/
      /*********************************************************************/

      public function listing_district($offset=0){
         $limit = 25;

         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 3, 1); 

         }elseif($this->ion_auth->is_region_admin()){                  
         // Region Admin
            $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 3, 1, $office); 

         }elseif($this->ion_auth->is_district_admin()){  
         // District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 3, 1, '', $office);

         }else{
            redirect('dashboard');
         }

      //Result
         $this->data['results'] = $results['rows'];
         $this->data['total_rows'] = $results['num_rows'];

      //pagination
         $this->data['pagination'] = create_pagination('edirectory/listing_district/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(3);

      // Load view
         $this->data['meta_title'] = 'District E-Directory Contact';
         $this->data['subview'] = 'listing_district';
         $this->load->view('backend/_layout_main', $this->data);
      }

      public function create_contact_district(){
         $office_level = 3;
      //scout office
         $region = NULL;
         $district = NULL;
         $upazila = NULL;
         $group = NULL;

      //Check authentication
         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 

            $this->data['regions'] = $this->Common_model->get_regions(); 

         }elseif($this->ion_auth->is_region_admin()){         
         //Region admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
            $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);

         }elseif($this->ion_auth->is_district_admin()){    
         // District Admin                 
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         //Dropdown
            $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
            $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);

         }else{
            redirect('dashboard');
         }

      // Validation
         $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
         $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
         $this->form_validation->set_rules('name', 'name', 'required|trim');

         if($this->input->post('memberType') == 1){
            $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
         }

      // DB Insert
         if ($this->form_validation->run() == true){
            $form_data = array(            
               'office_level'    => $office_level,
               'scout_desig_id'  => $this->input->post('scout_desig_id'),
               'other_desig_name'=> $this->input->post('other_desig_name'),
               'responsibility'  => $this->input->post('responsibility'),
               'scout_id'        => $this->input->post('scout_member_id'),    
               'name'            => $this->input->post('name'),
               'name_bn'         => $this->input->post('name_bn'),
               'phone'           => $this->input->post('phone'),
               'email'           => $this->input->post('email'),
               'phone_official'  => $this->input->post('phone_official'),
               'email_official'  => $this->input->post('email_official'),
               'address'         => $this->input->post('present_address'),            
               'profe_desig'     => $this->input->post('profe_desig'),
               'others_info'     => $this->input->post('others_info'),
               'gender'          => $this->input->post('gender'),
               'sc_region_id'    => $region != NULL ? $region:$this->input->post('sc_region_id'),
               'sc_district_id'  => $district != NULL ? $district:$this->input->post('sc_district_id'),
               'sc_upzaila_id'   => $upazila != NULL ? $upazila:$this->input->post('sc_upa_tha_id'), 
               'sc_group_id'     => $group != NULL ? $group:$this->input->post('sc_group_id'),
               'created'         => date('Y-m-d H:i:s')
               );          
         // print_r($form_data); exit;

            if($this->Common_model->save('edirectory', $form_data)){   
               $insert_id = $this->db->insert_id();

            // If scouts ID update main user table
               if($this->input->post('scout_member_id')){
                  $form_data2 = array(  
                     'first_name'      =>  $this->input->post('name'), 
                     'phone'           =>  $this->input->post('phone'),   
                     'email'           =>  $this->input->post('email')               
                     );   

                  $this->Common_model->edit('users', $this->input->post('scout_member_id'), 'id', $form_data2);
               }

            //Copy image, rename and remove from temp directory
               if($this->input->post('hide_img') != NULL){
                  if($this->input->post('scout_member_id')){
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                     if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                        $saveDir = $this->img_path_profile.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }else{
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                     if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }               
               }

            // Success Message
               $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
               redirect("edirectory/listing_district");
            }
         }

      //Dropdown
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(3);

      // Load Page
         $this->data['meta_title'] = 'Create District E-Directory Contact';
         $this->data['subview'] = 'create_contact_district';
         $this->load->view('backend/_layout_main', $this->data);
      }

      /***************************** Upazila *******************************/
      /*********************************************************************/

      public function listing_upazila($offset=0){
         $limit = 25;

         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 4, 1); 

         }elseif($this->ion_auth->is_region_admin()){                  
         // Region Admin
            $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 4, 1, $office); 

         }elseif($this->ion_auth->is_district_admin()){  
         // District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 4, 1, '', $office);

         }elseif($this->ion_auth->is_upazila_admin()){  
         // Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;       
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 4, 1, '', '', $office);

         }else{
            redirect('dashboard');
         }

      //Result
         $this->data['results'] = $results['rows'];
         $this->data['total_rows'] = $results['num_rows'];

      //pagination
         $this->data['pagination'] = create_pagination('edirectory/listing_upazila/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(4);

      // Load view
         $this->data['meta_title'] = 'Upazila E-Directory Contact';
         $this->data['subview'] = 'listing_upazila';
         $this->load->view('backend/_layout_main', $this->data);
      }

      public function create_contact_upazila(){
         $office_level = 4;
      //scout office
         $region = NULL;
         $district = NULL;
         $upazila = NULL;
         $group = NULL;

      //Check authentication
         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 

            $this->data['regions'] = $this->Common_model->get_regions(); 

         }elseif($this->ion_auth->is_region_admin()){         
         //Region admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
            $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);

         }elseif($this->ion_auth->is_district_admin()){    
         // District Admin                 
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         //Dropdown
            $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
            $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);

         }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin         
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;         
            $upazila    = $office->id;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         //Dropdown
            $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', '  grp_scout_upa_id', $upazila);

      // }elseif($this->ion_auth->is_group_admin()){
      //    // Group Admin         
      //    $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
      //    $region     = $office->grp_region_id;
      //    $district   = $office->grp_scout_dis_id;
      //    $upazila    = $office->grp_scout_upa_id;
      //    $group      = $office->id; //exit;
      //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
      //    $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
      //    $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
      //    $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);

         }else{
            redirect('dashboard');
         }

      // Validation
         $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
         $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
         $this->form_validation->set_rules('name', 'name', 'required|trim');

         if($this->input->post('memberType') == 1){
            $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
         }

      // DB Insert
         if ($this->form_validation->run() == true){
            $form_data = array(            
               'office_level'    => $office_level,
               'scout_desig_id'  => $this->input->post('scout_desig_id'),
               'other_desig_name'=> $this->input->post('other_desig_name'),
               'responsibility'  => $this->input->post('responsibility'),
               'scout_id'        => $this->input->post('scout_member_id'),    
               'name'            => $this->input->post('name'),
               'name_bn'         => $this->input->post('name_bn'),
               'phone'           => $this->input->post('phone'),
               'email'           => $this->input->post('email'),
               'phone_official'  => $this->input->post('phone_official'),
               'email_official'  => $this->input->post('email_official'),
               'address'         => $this->input->post('present_address'),            
               'profe_desig'     => $this->input->post('profe_desig'),
               'others_info'     => $this->input->post('others_info'),
               'gender'          => $this->input->post('gender'),
               'sc_region_id'    => $region != NULL ? $region:$this->input->post('sc_region_id'),
               'sc_district_id'  => $district != NULL ? $district:$this->input->post('sc_district_id'),
               'sc_upzaila_id'   => $upazila != NULL ? $upazila:$this->input->post('sc_upa_tha_id'), 
               'sc_group_id'     => $group != NULL ? $group:$this->input->post('sc_group_id'),
               'created'         => date('Y-m-d H:i:s')
               );          
         // print_r($form_data); exit;

            if($this->Common_model->save('edirectory', $form_data)){   
               $insert_id = $this->db->insert_id();

            // If scouts ID update main user table
               if($this->input->post('scout_member_id')){
                  $form_data2 = array(  
                     'first_name'      =>  $this->input->post('name'), 
                     'phone'           =>  $this->input->post('phone'),   
                     'email'           =>  $this->input->post('email')               
                     );   

                  $this->Common_model->edit('users', $this->input->post('scout_member_id'), 'id', $form_data2);
               }

            //Copy image, rename and remove from temp directory
               if($this->input->post('hide_img') != NULL){
                  if($this->input->post('scout_member_id')){
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                     if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                        $saveDir = $this->img_path_profile.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }else{
                     $file_name = $this->input->post('hide_img');
                     $tmp = explode('.', $file_name);
                     $file_extension = end($tmp);                          

                  //Copy file and rename 
                     $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                     $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                     if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                        $saveDir = $this->img_path.'/'.$newfile;
                        if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                           @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                           @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                        }
                     }   
                  }               
               }

            // Success Message
               $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
               redirect("edirectory/listing_upazila");
            }
         }

      //Dropdown
         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(4);

      // Load Page
         $this->data['meta_title'] = 'Create Upazila E-Directory Contact';
         $this->data['subview'] = 'create_contact_upazila';
         $this->load->view('backend/_layout_main', $this->data);
      }

      /************************* Scouts Group ******************************/
      /*********************************************************************/

      public function listing_scout_group($offset=0){
         $limit = 25;

         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1); 

         }elseif($this->ion_auth->is_region_admin()){                  
         // Region Admin
            $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1, $office); 

         }elseif($this->ion_auth->is_district_admin()){  
         // District Admin
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1, '', $office);

         }elseif($this->ion_auth->is_upazila_admin()){  
         // Upazila Admin
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;       
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1, '', '', $office);

         }elseif($this->ion_auth->is_group_admin()){    
         // Group Admin
            $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;     
         //Results
            $results = $this->Edirectory_model->get_listing($limit, $offset, 5, 1, '', '', '', $office);

         }else{
            redirect('dashboard');
         }

      //Result
         $this->data['results'] = $results['rows'];
         $this->data['total_rows'] = $results['num_rows'];

      //pagination
         $this->data['pagination'] = create_pagination('edirectory/listing_scout_group/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

         $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(5);

      // Load view
         $this->data['meta_title'] = 'Scout Group E-Directory Contact';
         $this->data['subview'] = 'listing_scout_group';
         $this->load->view('backend/_layout_main', $this->data);
      }

      public function create_contact_scout_group(){
         $office_level = 5;
         //scout office
         $region = NULL;
         $district = NULL;
         $upazila = NULL;
         $group = NULL;

      //Check authentication
         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 

            $this->data['regions'] = $this->Common_model->get_regions(); 

         }elseif($this->ion_auth->is_region_admin()){         
         //Region admin
            $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         //Dropdown
            $this->data['scout_districts'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);

         }elseif($this->ion_auth->is_district_admin()){    
         // District Admin                 
            $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
            $region     = $office->dis_scout_region_id;
            $district   = $office->id;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         //Dropdown
            $this->data['scout_upazila'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);
            $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_dis_id', $district);

         }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin         
            $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
            $region     = $office->upa_region_id;
            $district   = $office->upa_scout_dis_id;         
            $upazila    = $office->id;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
            //Dropdown
            $this->data['scout_group'] = $this->Common_model->get_dropdown_office('office_groups', 'grp_name', 'grp_scout_upa_id', $upazila);

         }elseif($this->ion_auth->is_group_admin()){
         // Group Admin         
            $office = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
            $region     = $office->grp_region_id;
            $district   = $office->grp_scout_dis_id;
            $upazila    = $office->grp_scout_upa_id;
            $group      = $office->id; //exit;
            $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
            $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
            $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
            $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);            

      }else{
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('scout_desig_id', 'select designation', 'required|trim');
      $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name', 'name', 'required|trim');

      if($this->input->post('memberType') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
      }

      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'office_level'    => $office_level,
            'scout_desig_id'  => $this->input->post('scout_desig_id'),
            'other_desig_name'=> $this->input->post('other_desig_name'),
            'responsibility'  => $this->input->post('responsibility'),
            'scout_id'        => $this->input->post('scout_member_id'),    
            'name'            => $this->input->post('name'),
            'phone'           => $this->input->post('phone'),
            'name_bn'         => $this->input->post('name_bn'),
            'email'           => $this->input->post('email'),
            'phone_official'  => $this->input->post('phone_official'),
            'email_official'  => $this->input->post('email_official'),
            'address'         => $this->input->post('present_address'),            
            'profe_desig'     => $this->input->post('profe_desig'),
            'others_info'     => $this->input->post('others_info'),
            'gender'          => $this->input->post('gender'),
            'sc_region_id'    => $region != NULL ? $region:$this->input->post('sc_region_id'),
            'sc_district_id'  => $district != NULL ? $district:$this->input->post('sc_district_id'),
            'sc_upzaila_id'   => $upazila != NULL ? $upazila:$this->input->post('sc_upa_tha_id'), 
            'sc_group_id'     => $group != NULL ? $group:$this->input->post('sc_group_id'),
            'created'         => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('edirectory', $form_data)){   
            $insert_id = $this->db->insert_id();

            // If scouts ID update main user table
            if($this->input->post('scout_member_id')){
               $form_data2 = array(  
                  'first_name'      =>  $this->input->post('name'), 
                  'phone'           =>  $this->input->post('phone'),   
                  'email'           =>  $this->input->post('email')               
                  );   

               $this->Common_model->edit('users', $this->input->post('scout_member_id'), 'id', $form_data2);
            }
            
            //Copy image, rename and remove from temp directory
            if($this->input->post('hide_img') != NULL){
               if($this->input->post('scout_member_id')){
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                  if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                     $saveDir = $this->img_path_profile.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }else{
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                  if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                     $saveDir = $this->img_path.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }               
            }
            
            // Success Message
            $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
            redirect("edirectory/listing_scout_group");
         }
      }

      //Dropdown
      $this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(5);

      // Load Page
      $this->data['meta_title'] = 'Create Scouts Group E-Directory Contact';
      $this->data['subview'] = 'create_contact_scout_group';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function listing_training_center($offset=0){
      $limit = 25;

      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         //Results
         $results = $this->Edirectory_model->get_listing($limit, $offset, 6, 1); 
      }else{
         redirect('dashboard');
      }
      
      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('edirectory/listing_training_center/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Training Center E-Directory Contact';
      $this->data['subview'] = 'listing_training_center';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function create_tc(){
      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
         $office_level = 6;
         //Dropdown      
         //$this->data['designations'] = $this->Common_model->get_edirectory_designation_by_office(1);

      }else{
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('tc_id', 'select trainig center', 'required|trim');
      $this->form_validation->set_rules('tc_designation_name', 'designation', 'required|trim');
      $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name', 'name', 'required|trim');

      if($this->input->post('memberType') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');
      }

      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'office_level'    => $office_level,
            'tc_id'           => $this->input->post('tc_id'),
            'tc_designation_name'  => $this->input->post('tc_designation_name'),
            'scout_id'        => $this->input->post('scout_member_id'),    
            'name'            => $this->input->post('name'),
            'name_bn'         => $this->input->post('name_bn'),
            'phone'           => $this->input->post('phone'),
            'email'           => $this->input->post('email'),
            'address'         => $this->input->post('present_address'),            
            'profe_desig'     => $this->input->post('profe_desig'),
            'others_info'     => $this->input->post('others_info'),
            'gender'          => $this->input->post('gender'),
            'sc_region_id'    => $region != NULL? $region:NULL,
            'sc_district_id'  => $district != NULL? $district:NULL,
            'sc_upzaila_id'   => $upazila != NULL? $upazila:NULL,
            'sc_group_id'     => $group != NULL? $group:NULL,
            'created'         => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('edirectory', $form_data)){   
            $insert_id = $this->db->insert_id();

            //Copy image, rename and remove from temp directory
            if($this->input->post('hide_img') != NULL){
               if($this->input->post('scout_member_id')){
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $this->input->post('scout_member_id').'.'.$file_extension;

                  //Update table image field
                  if($this->Common_model->set_profile_image($this->input->post('scout_member_id'), $newfile)){
                     $saveDir = $this->img_path_profile.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }else{
                  $file_name = $this->input->post('hide_img');
                  $tmp = explode('.', $file_name);
                  $file_extension = end($tmp);                          

                  //Copy file and rename 
                  $file = $this->img_thumb_path.'/'.$this->input->post('hide_img');
                  // $file = 'temp_dir/_thumb/'.$this->input->post('hide_img');
                  $newfile = $insert_id.'.'.$file_extension;

                  //Update table image field
                  if($this->Edirectory_model->set_image_file($insert_id, $newfile)){
                     $saveDir = $this->img_path.'/'.$newfile;
                     if (copy($file, $saveDir)) {
                        // @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.'.$file_extension);
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.png');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpg');
                        @unlink($this->img_orginal_path.'\\'.$tmp[0].'-original.jpeg');
                        @unlink($this->img_thumb_path.'\\'.$file_name);

                        //$this->session->set_flashdata('success', 'Image update successfully.');
                        //redirect('my_profile');
                     }
                  }   
               }               
            }
            
            // Success Message
            $this->session->set_flashdata('success', 'e-Directory contact added successfully.');
            redirect("edirectory/listing_training_center/");
         }
      }

      //Dropdown      
      $this->data['training_centers'] = $this->Common_model->get_training_centers();    

      // Load Page
      $this->data['meta_title'] = 'Create E-Directory Training Center Contact';
      $this->data['subview'] = 'create_tc';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function delete_contact($id){  
      // Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('edirectory', 'id', $dataID)) { 
         show_404('edirectory - delete_contact - exitsts', TRUE);
      }

      // Delete data
      if($this->Edirectory_model->destroy_contact($dataID)){
         $this->session->set_flashdata('success', 'Contact delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect      
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         redirect('edirectory/listing');
      }elseif($this->ion_auth->is_region_admin()){                  
         redirect('edirectory/listing_region');
      }elseif($this->ion_auth->is_district_admin()){  
         redirect('edirectory/listing_district');
      }elseif($this->ion_auth->is_upazila_admin()){  
         redirect('edirectory/listing_upazila');
      }elseif($this->ion_auth->is_group_admin()){    
         redirect('edirectory/listing_scout_group');
      }
   }




   public function designation(){
     $this->data['results'] = $this->Edirectory_model->get_edirectory_designation(); 
        // print_r($this->data['results']); exit;
        // Load page
     $this->data['meta_title'] = 'All E-Directory Designation List';
     $this->data['subview'] = 'designation';
     $this->load->view('backend/_layout_main', $this->data);
  }

  public function designation_add(){
     $this->form_validation->set_rules('officeType', 'office type', 'trim');
     $this->form_validation->set_rules('committee_designation_name', 'Committee Designation Name', 'required|trim');

     if ($this->form_validation->run() == true){
      $form_data = array(
       'office_level'              => implode(',', $this->input->post('officeType')),
       'committee_designation_name_en'=> $this->input->post('committee_designation_name'),
       'department_id'=> $this->input->post('department_id')
       );           

            // print_r($form_data); exit;
      if($this->Common_model->save('edirectory_designation', $form_data)){
       /***********Activity Logs Start**********/
       $insert_id = $this->db->insert_id();
                func_activity_log(1, 'edirectory designation ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Occupation create successfully.');
                redirect('edirectory/designation');
             }
          }

        //Dropdown
          $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
          $this->data['departments'] = $this->Common_model->get_department();
        // $this->data['scouts_office_check'] = $this->Common_model->set_office_type_checkbox();

        // Load page
          $this->data['meta_title'] = 'Create E-Directory Designation';
          $this->data['subview'] = 'designation_add';
          $this->load->view('backend/_layout_main', $this->data);
       }

       public function designation_edit($id){
        $this->form_validation->set_rules('officeType', 'office type', 'trim');
        $this->form_validation->set_rules('committee_designation_name', 'E-Directory Designation Name', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
         $form_data = array(
          'office_level'              => implode(',', $this->input->post('officeType')),
          'committee_designation_name_en'=> $this->input->post('committee_designation_name'),
          'department_id'              => $this->input->post('department_id'),
          'status'                    => $this->input->post('status')
          );           

            // print_r($form_data); exit;
         if($this->Common_model->edit('edirectory_designation', $id, 'id', $form_data)){
          /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'edirectory designation update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Informatioin update successfully.');
                redirect('edirectory/designation');
             }
          }

        //Dropdown
          $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
          $this->data['departments'] = $this->Common_model->get_department();
          $this->data['info'] = $this->Edirectory_model->get_info('edirectory_designation', $id);

        // Load page
          $this->data['meta_title'] = 'Edit E-Directory Designation';
          $this->data['subview'] = 'designation_edit';
          $this->load->view('backend/_layout_main', $this->data);
       }

       function designation_delete($id) {
        $form_data = array(
         'is_delete' => 1        
         ); 
        $this->data['info'] = $this->Common_model->edit('edirectory_designation',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'eDirectory designation delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('edirectory/designation');
     }



   // Get member details using ajax
     public function ajax_get_scouts_member_info($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Edirectory_model->get_scouts_member_info($id)));
      // print_r($info);
   }


}