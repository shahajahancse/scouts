<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends Backend_Controller {

   var $userID;
   var $img_path;
   var $status;

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      // redirect('dashboard'); 

      $this->data['module_title'] = 'Program';
      $this->userID = $this->session->userdata('user_id');

      $this->load->model('Common_model');
      $this->load->model('Program_model');
      $this->load->model('committee/Committee_model');

      if($this->ion_auth->is_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_region_admin()){  
         $this->status =1;
      }elseif($this->ion_auth->is_district_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_upazila_admin()){
         $this->status =1;
      }elseif($this->ion_auth->is_group_admin()){
         $this->status =1;
      }else{
         $this->status =0;
      }
   }

   public function index(){
      redirect('dashboard');
   }  

   /******************************** Leader Program *******************************
   ********************************************************************************/

   public function leader_progress($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }
      
      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      //print_r($this->data['info']);  exit;

      // Search
      $search_data = array(
         'scout_id' => $this->data['info']->id, 
         'section_id' => $this->data['info']->sc_section_id, 
         );      

      // Results
      $this->data['trainings'] = $this->Program_model->get_trainings($search_data);
      $this->data['achievements'] = $this->Program_model->get_badge_details_achievement($search_data);
      $this->data['awards'] = $this->Program_model->get_progress_award($search_data);
      $this->data['promotions'] = $this->Program_model->get_promotions($search_data);
      $this->data['activities'] = $this->Program_model->get_activities($search_data);
      // $this->data['proficiency_badges'] = $this->Program_model->get_proficiency_badge($search_data);
      // $this->data['group_change'] = $this->Program_model->get_group_change($search_data);

      // Load page
      $this->data['meta_title'] = 'Leader Progress';
      $this->data['subview'] = 'leader_progress';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /********************************** Cub Program ********************************
   ********************************************************************************/

   public function cub_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }
      // echo $scoutID
      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      //print_r($this->data['info']);  exit;

      // Search
      $search_data = array(
         'scout_id' => $this->data['info']->id, 
         'section_id' => $this->data['info']->sc_section_id, 
         );      

      // Results
      $this->data['achievements'] = $this->Program_model->get_badge_details_achievement($search_data);
      $this->data['awards'] = $this->Program_model->get_progress_award($search_data);
      $this->data['proficiency_badges'] = $this->Program_model->get_proficiency_badge($search_data);
      $this->data['promotions'] = $this->Program_model->get_promotions($search_data);
      $this->data['trainings'] = $this->Program_model->get_trainings($search_data);
      $this->data['activities'] = $this->Program_model->get_activities($search_data);
      $this->data['group_change'] = $this->Program_model->get_group_change($search_data);

      // Load page
      $this->data['meta_title'] = 'Cub Scout Program';
      $this->data['subview'] = 'cub_program';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /********************************* Scout Program *******************************
   ********************************************************************************/

   public function scout_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      // Search
      $search_data = array(
         'scout_id' => $this->data['info']->id, 
         'section_id' => $this->data['info']->sc_section_id, 
         );      

      // Results
      $this->data['achievements'] = $this->Program_model->get_badge_details_achievement($search_data);
      $this->data['awards'] = $this->Program_model->get_progress_award($search_data);
      $this->data['proficiency_badges'] = $this->Program_model->get_proficiency_badge($search_data);
      $this->data['promotions'] = $this->Program_model->get_promotions($search_data);
      $this->data['trainings'] = $this->Program_model->get_trainings($search_data);
      $this->data['activities'] = $this->Program_model->get_activities($search_data);
      $this->data['group_change'] = $this->Program_model->get_group_change($search_data);

      // Load page
      $this->data['meta_title'] = 'Scout Program';
      $this->data['subview'] = 'scout_program';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /********************************* Rover Program ********************************
   ********************************************************************************/

   public function rover_program($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id; //exit;

      // Search
      $search_data = array(
         'scout_id' => $this->data['info']->id, 
         'section_id' => $this->data['info']->sc_section_id, 
         );      

      // Results
      $this->data['achievements'] = $this->Program_model->get_badge_details_achievement($search_data);
      $this->data['awards'] = $this->Program_model->get_progress_award($search_data);
      $this->data['proficiency_badges'] = $this->Program_model->get_proficiency_badge($search_data);
      $this->data['promotions'] = $this->Program_model->get_promotions($search_data);
      $this->data['trainings'] = $this->Program_model->get_trainings($search_data);
      $this->data['activities'] = $this->Program_model->get_activities($search_data);
      $this->data['group_change'] = $this->Program_model->get_group_change($search_data);

      // Load page
      $this->data['meta_title'] = 'Rover Scout Program';
      $this->data['subview'] = 'rover_program';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function achievement_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      // Validation
      $this->form_validation->set_rules('badge_id', 'badge/stage', 'required|trim'); 
      $this->form_validation->set_rules('achive_date', 'achievement data', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'        => $scoutID,
            'section_id'      => $sectionType,
            'badge_id'        => $this->input->post('badge_id'),
            'achive_date'     => date_db_format($this->input->post('achive_date')),
            'examiner_id'     => $this->input->post('examiner_id')
            );

         // print_r($form_data); exit;
         if($this->Common_model->save('prog_badge_achievement', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Progress Achievement Add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Progress achievement added successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);

      // Load page
      $this->data['meta_title'] = 'Progress Achievement Add';
      $this->data['subview'] = 'achievement_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function achievement_edit($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 
      $this->data['infoAchiev'] = $this->Program_model->get_achievement_by_id($rowID);
      // print_r($this->data['infoAchiev']); exit;

      // Validation
      $this->form_validation->set_rules('badge_id', 'badge/stage', 'required|trim'); 
      $this->form_validation->set_rules('achive_date', 'achievement data', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'badge_id'        => $this->input->post('badge_id'),
            'achive_date'     => date_db_format($this->input->post('achive_date')),
            'examiner_id'     => $this->input->post('examiner_id')
            );

         // if($this->Common_model->save('prog_badge_achievement', $form_data)){
         if($this->Common_model->edit('prog_badge_achievement', $rowID, 'id', $form_data)){

            /***********Activity Logs Start**********/
            func_activity_log(2, 'progress achievement update data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Progress achievement update successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);

      // Load page
      $this->data['meta_title'] = 'Progress Achievement Edit';
      $this->data['subview'] = 'achievement_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function achievement_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_badge_achievement', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'progress achievement delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Progress achievement delete successfully.');
         if($memberType == 8){
            redirect("program/leader_progress");
         }

         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }

   public function award_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      // Validation
      $this->form_validation->set_rules('award_name', 'award name', 'required|trim'); 
      $this->form_validation->set_rules('certificate_no', 'certificate no', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'        => $scoutID,
            'award_name'      => $this->input->post('award_name'),
            'certificate_no'  => $this->input->post('certificate_no'),
            'issue_date'      => date_db_format($this->input->post('issue_date')),
            'issue_authority' => $this->input->post('issue_authority')
            );

         if($this->Common_model->save('prog_award', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Award Add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Progress award added successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      // $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      //$this->data['roles'] = $this->Program_model->get_scout_role_by_member_section_type($memberType, $sectionType);

      // Load page
      $this->data['meta_title'] = 'Award Add';
      $this->data['subview'] = 'award_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function award_edit($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 
      $this->data['infoAward'] = $this->Program_model->get_progress_award_by_id($rowID);
      // print_r($this->data['infoAchiev']); exit;

      // Validation
      $this->form_validation->set_rules('award_name', 'award name', 'required|trim'); 
      $this->form_validation->set_rules('certificate_no', 'certificate no', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'award_name'      => $this->input->post('award_name'),
            'certificate_no'  => $this->input->post('certificate_no'),
            'issue_date'      => date_db_format($this->input->post('issue_date')),
            'issue_authority' => $this->input->post('issue_authority')
            );

         // if($this->Common_model->save('prog_badge_achievement', $form_data)){
         if($this->Common_model->edit('prog_award', $rowID, 'id', $form_data)){

            /***********Activity Logs Start**********/
            func_activity_log(2, 'progress award update data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Progress award update successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Load page
      $this->data['meta_title'] = 'Progress Award Edit';
      $this->data['subview'] = 'award_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function award_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_award', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'progress award delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Progress award delete successfully.');
         if($memberType == 8){
            redirect("program/leader_progress");
         }

         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }


   public function proficiency_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      // Validation
      $this->form_validation->set_rules('badge_id', 'badge/stage', 'required|trim'); 
      $this->form_validation->set_rules('prof_badge_group_id', 'proficiency badge group', 'required|trim');
      $this->form_validation->set_rules('prof_badge_id', 'proficiency badge name', 'required|trim');
      $this->form_validation->set_rules('achieved_date', 'achieved data', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'        => $scoutID,
            'section_id'      => $sectionType,
            'badge_id'        => $this->input->post('badge_id'),
            'prof_badge_group_id' => $this->input->post('prof_badge_group_id'),
            'prof_badge_id'   => $this->input->post('prof_badge_id'),
            'achieved_date'   => date_db_format($this->input->post('achieved_date')),
            'extra_badge'     => $this->input->post('extra_badge'),
            'evaluated_by'    => $this->input->post('evaluated_by')
            );

         if($this->Common_model->save('prog_proficiency_badge', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'proficiency badge Add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Proficiency badge added successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      $this->data['prof_badge_group'] = $this->Program_model->get_prof_badge_group_section($sectionType);
      $this->data['extra_badge'] = array('No' => 'No', 'Yes' => 'Yes');

      // Load page
      $this->data['meta_title'] = 'Proficiency Badge/Stage Add';
      $this->data['subview'] = 'proficiency_add';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function proficiency_edit($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 
      $this->data['infoProficiency'] = $this->Program_model->get_proficiency_badge_by_id($rowID);
      // print_r($this->data['infoProficiency']); exit;

      // Validation
      $this->form_validation->set_rules('badge_id', 'badge/stage', 'required|trim'); 
      $this->form_validation->set_rules('prof_badge_group_id', 'proficiency badge group', 'required|trim');
      $this->form_validation->set_rules('prof_badge_id', 'proficiency badge name', 'required|trim');
      $this->form_validation->set_rules('achieved_date', 'achieved data', 'required|trim');  

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'badge_id'        => $this->input->post('badge_id'),
            'prof_badge_group_id' => $this->input->post('prof_badge_group_id'),
            'prof_badge_id'   => $this->input->post('prof_badge_id'),
            'achieved_date'   => date_db_format($this->input->post('achieved_date')),
            'extra_badge'     => $this->input->post('extra_badge'),
            'evaluated_by'    => $this->input->post('evaluated_by')
            );

         // if($this->Common_model->save('prog_badge_achievement', $form_data)){
         if($this->Common_model->edit('prog_proficiency_badge', $rowID, 'id', $form_data)){

            /***********Activity Logs Start**********/
            func_activity_log(2, 'proficiency badge update data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Proficiency badge update successfully.');
            if($memberType == 8 || $memberType == 9 || $memberType == 10 || $memberType == 12){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      $this->data['badges'] = $this->Program_model->get_scout_badge_by_member_section_type($memberType, $sectionType);
      // print_r($this->data['badges']); exit;
      $this->data['prof_badge_group'] = $this->Program_model->get_prof_badge_group_section($sectionType);
      $this->data['prof_badge_name_list'] = $this->Program_model->get_prof_badge_by_section($sectionType);
      $this->data['extra_badge'] = array('No' => 'No', 'Yes' => 'Yes');

      // Load page
      $this->data['meta_title'] = 'Proficiency Badge/Stage Edit';
      $this->data['subview'] = 'proficiency_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function proficiency_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_proficiency_badge', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'proficiency badge delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Proficiency badge delete successfully.');
         if($memberType == 8 || $memberType == 9 || $memberType == 10 || $memberType == 12){
            redirect("program/leader_progress");
         }

         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }



   public function promotion_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;

      // Validation
      $this->form_validation->set_rules('promo_member_id', 'member type', 'required|trim'); 
      $this->form_validation->set_rules('promo_section_id', 'scouts section', 'required|trim');
      $this->form_validation->set_rules('promo_role_id', 'scouts role', 'required|trim');
      $this->form_validation->set_rules('promo_start_date', 'start date', 'required|trim');      
      if($memberType == 2){
         $this->form_validation->set_rules('promo_gorup_id', 'scouts gorup name', 'required|trim');  
      }

      //Scout Office type NHQ=1, Other=2
      $officeType = $this->input->post('promo_office_type') != NULL ? $this->input->post('promo_office_type'):2;
      $department_id = !empty($this->input->post('promo_department_id')) ? implode(',', $this->input->post('promo_department_id')):NULL;
      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'           => $scoutID,
            'section_id'         => $sectionType,
            'promo_office_type'  => $officeType,
            'promo_region_id'    => $this->input->post('promo_region_id'),
            'promo_district_id'  => $this->input->post('promo_district_id'),
            'promo_upazila_id'   => $this->input->post('promo_upazila_id'),
            'promo_gorup_id'     => $this->input->post('promo_gorup_id'),
            'promo_unit_id'      => $this->input->post('promo_unit_id'),
            'promo_member_id'    => $this->input->post('promo_member_id'),
            'promo_section_id'   => $this->input->post('promo_section_id'),
            'promo_role_id'      => $this->input->post('promo_role_id'),
            'promo_department_id'=> $department_id,
            'promo_start_date'   => date_db_format($this->input->post('promo_start_date')),
            'promo_end_date'     => date_db_format($this->input->post('promo_end_date'))
            );
         // print_r($form_data); exit;

         if($this->Common_model->save('prog_promotions', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'promotion add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Promotion added successfully.');
            if($memberType == 8 || $memberType == 9 || $memberType == 10 || $memberType == 12){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown 
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();  
      $this->data['departments'] = $this->Common_model->get_department();

      // Load page
      $this->data['meta_title'] = 'Promotion Add';
      $this->data['subview'] = 'promotion_add';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function promotion_edit($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 
      $this->data['infoPromo'] = $this->Program_model->get_promotion_by_id($rowID);
      // print_r($this->data['infoAchiev']); exit;

      // Validation
      $this->form_validation->set_rules('promo_member_id', 'member type', 'required|trim'); 
      $this->form_validation->set_rules('promo_section_id', 'scouts section', 'required|trim');
      $this->form_validation->set_rules('promo_role_id', 'scouts role', 'required|trim');
      $this->form_validation->set_rules('promo_start_date', 'start date', 'required|trim');
      if($memberType == 2){
         $this->form_validation->set_rules('promo_gorup_id', 'scouts gorup name', 'required|trim');  
      }

      //Scout Office type NHQ=1, Other=2
      $officeType = $this->input->post('promo_office_type') != NULL ? $this->input->post('promo_office_type'):2;

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'promo_office_type'  => $officeType,
            'promo_region_id'    => $this->input->post('promo_region_id'),
            'promo_district_id'  => $this->input->post('promo_district_id'),
            'promo_upazila_id'   => $this->input->post('promo_upazila_id'),
            'promo_gorup_id'     => $this->input->post('promo_gorup_id'),
            'promo_unit_id'      => $this->input->post('promo_unit_id'),
            'promo_member_id'    => $this->input->post('promo_member_id'),
            'promo_section_id'   => $this->input->post('promo_section_id'),
            'promo_role_id'      => $this->input->post('promo_role_id'),
            'promo_department_id'=> $this->input->post('promo_department_id'),
            'promo_start_date'   => date_db_format($this->input->post('promo_start_date')),
            'promo_end_date'     => date_db_format($this->input->post('promo_end_date'))
            );

         // if($this->Common_model->save('prog_badge_achievement', $form_data)){
         if($this->Common_model->edit('prog_promotions', $rowID, 'id', $form_data)){

            /***********Activity Logs Start**********/
            func_activity_log(2, 'promotion update data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Promotions update successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Promotion Data
      $region_id = $this->data['infoPromo']->promo_region_id;
      $district_id = $this->data['infoPromo']->promo_district_id;
      $upazila_id = $this->data['infoPromo']->promo_upazila_id;
      $group_id = $this->data['infoPromo']->promo_gorup_id;
      $member_id = $this->data['infoPromo']->promo_member_id;
      $section_id = $this->data['infoPromo']->promo_section_id;


      // Dropdown 
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['scout_districts'] = $this->Common_model->get_scout_districts($region_id); 
      $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($district_id); 
      $this->data['scout_group'] = $this->Common_model->get_scout_group_office($district_id, $upazila_id); 
      $this->data['scout_units'] = $this->Common_model->get_sc_unit_list_by_group_id($group_id);

      $this->data['member_type'] = $this->Common_model->get_member_type();
      $this->data['scout_section'] = $this->Common_model->set_scout_section();  
      $this->data['departments'] = $this->Common_model->get_department();
      $this->data['scout_roles'] = $this->Common_model->get_roles($member_id, $section_id);

      // Load page
      $this->data['meta_title'] = 'Promotion Edit';
      $this->data['subview'] = 'promotion_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function promotion_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_promotions', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'promotion delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Promotion data delete successfully.');
         if($memberType == 8){
            redirect("program/leader_progress");
         }


         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }


   /********************************* Training Record ******************************/

   public function training_record_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id; //exit;

      // Progress type
      if($memberType == 2 AND $sectionType == 1){
         $this->data['progressType'] = 1;
      }elseif($memberType == 2 AND $sectionType == 2){
         $this->data['progressType'] = 2;
      }elseif($memberType == 2 AND $sectionType == 3){
         $this->data['progressType'] = 3;
      }elseif($memberType == 8){
         $this->data['progressType'] = 4;
      }


      // Validation
      $this->form_validation->set_rules('course_id', 'course name', 'required|trim'); 
      $this->form_validation->set_rules('start_date', 'start date', 'required|trim');
      $this->form_validation->set_rules('end_date', 'end date', 'required|trim');
      $this->form_validation->set_rules('training_name', 'training name', 'required|trim');
      $this->form_validation->set_rules('place', 'place', 'required|trim');  
      $this->form_validation->set_rules('certificate_no', 'certificate no', 'trim');  

      //Scout Office type NHQ=1, Other=2
      $officeType = $this->input->post('org_office_type') != NULL ? $this->input->post('org_office_type'):2;

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'           => $scoutID,
            'section_id'         => $sectionType,
            'course_section_id'  => $this->input->post('course_section_id'),
            'course_id'          => $this->input->post('course_id'),
            'other_course_name'  => $this->input->post('other_course_name'),
            'course_number'      => $this->input->post('course_number'),   
            'training_name'      => $this->input->post('training_name'),
            'place'              => $this->input->post('place'),
            'certificate_no'     => $this->input->post('certificate_no'),
            'start_date'         => date_db_format($this->input->post('start_date')),
            'end_date'           => date_db_format($this->input->post('end_date')),
            'issue_date'         => date_db_format($this->input->post('issue_date')),
            'course_leader'      => $this->input->post('course_leader'),
            'org_office_type'    => $this->input->post('org_office_type'),
            'org_region_id'      => $this->input->post('org_region_id'),
            'org_district_id'    => $this->input->post('org_district_id'),
            'org_upazila_id'     => $this->input->post('org_upazila_id'),
            'mng_office_type'    => $this->input->post('mng_office_type'),
            'mng_region_id'      => $this->input->post('mng_region_id'),
            'mng_district_id'    => $this->input->post('mng_district_id'),
            'mng_upazila_id'     => $this->input->post('mng_upazila_id')
            );

         // print_r($form_data); exit;

         if($this->Common_model->save('prog_training', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'training add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Training record added successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['section'] = $this->Common_model->set_scout_section();
      $this->data['courses'] = $this->Common_model->get_course_by_progress_section($this->data['progressType'], $sectionType);

      // Load page
      $this->data['meta_title'] = 'Training Record';
      $this->data['subview'] = 'training_record_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function training_record_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_training', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'training record delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Traning record delete successfully.');
         if($memberType == 8){
            redirect("program/leader_progress");
         }

         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }


   /********************************* Activities ******************************/

   public function activities_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id; //exit;


      // Validation
      $this->form_validation->set_rules('activity_name', 'course name', 'required|trim'); 
      $this->form_validation->set_rules('activity_type_id', 'training name', 'required|trim');
      $this->form_validation->set_rules('venue1', 'place', 'required|trim');  
      $this->form_validation->set_rules('certificate_no', 'certificate no', 'trim');  
      $this->form_validation->set_rules('start_date', 'start date', 'required|trim');
      $this->form_validation->set_rules('end_date', 'end date', 'required|trim');

      //Scout Office type NHQ=1, Other=2
      $officeType = $this->input->post('org_office_type') != NULL ? $this->input->post('org_office_type'):2;

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'           => $scoutID,
            'section_id'         => $sectionType,
            'activity_name'      => $this->input->post('activity_name'),
            'activity_type_id'   => $this->input->post('activity_type_id'),
            'activity_other'     => $this->input->post('activity_other'),
            'venue1'             => $this->input->post('venue1'),
            'venue2'             => $this->input->post('venue2'),
            'role_id'            => $this->input->post('role_id'),
            'certificate_no'     => $this->input->post('certificate_no'),
            'start_date'         => date_db_format($this->input->post('start_date')),
            'end_date'           => date_db_format($this->input->post('end_date')),
            'issue_date'         => date_db_format($this->input->post('issue_date')),
            'org_nhq_office'     => $this->input->post('org_nhq_office'),
            'org_other_office'   => $this->input->post('org_other_office'),
            'org_nhq_office'     => $this->input->post('org_nhq_office'),
            'org_office_type'    => $this->input->post('org_office_type'),
            'org_region_id'      => $this->input->post('org_region_id'),
            'org_district_id'    => $this->input->post('org_district_id'),
            'org_upazila_id'     => $this->input->post('org_upazila_id'),
            'org_group_id'       => $this->input->post('org_group_id'),
            'org_unit_id'        => $this->input->post('org_unit_id')
            );

         if($this->Common_model->save('prog_activities', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'activities add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Activities data added successfully.');
            if($memberType == 8){
               redirect("program/leader_progress");
            }

            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown
      $this->data['activities_dd'] = $this->Common_model->get_event_category();
      $this->data['scout_roles'] = $this->Common_model->get_roles($memberType, $sectionType);
      $this->data['regions'] = $this->Common_model->get_regions(); 

      // Load page
      $this->data['meta_title'] = 'Activities Add';
      $this->data['subview'] = 'activities_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function activities_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_activities', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'activities delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Activities data delete successfully.');
         if($memberType == 8){
            redirect("program/leader_progress");
         }

         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }


   public function group_change_add($id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id; //exit;

      // Validation
      $this->form_validation->set_rules('resign_gorup_name', 'Name Of Previous Group ', 'required|trim'); 
      $this->form_validation->set_rules('resign_date', 'Date of leving', 'required|trim');
      $this->form_validation->set_rules('resign_reason', 'Reason for leving old Group', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $form_data = array(
            'scout_id'           => $scoutID,
            'section_id'         => $sectionType,
            'resign_gorup_name'  => $this->input->post('resign_gorup_name'),
            'resign_date'        => date_db_format($this->input->post('resign_date')),
            'resign_reason'      => $this->input->post('resign_reason'),
            'resign_section_id'  => $this->input->post('resign_section_id'),
            'resign_evaluated_by'=> $this->input->post('resign_evaluated_by'),
            'new_group_name'     => $this->input->post('new_group_name'),
            'new_join_date'      => date_db_format($this->input->post('new_join_date')),
            'new_section_id'     => $this->input->post('new_section_id'),
            'new_evaluated_by'   => $this->input->post('new_evaluated_by')
            );

         if($this->Common_model->save('prog_group_resign', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'group change add ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Group change record added successfully.');
            if($id != ''){
               if($sectionType == 1){
                  redirect("program/cub_program/".$id);         
               }elseif($sectionType == 2){
                  redirect("program/scout_program/".$id);         
               }elseif($sectionType == 3){
                  redirect("program/rover_program/".$id);              
               }
            }else{
               if($sectionType == 1){
                  redirect("program/cub_program");         
               }elseif($sectionType == 2){
                  redirect("program/scout_program");         
               }elseif($sectionType == 3){
                  redirect("program/rover_program");              
               }
            }
         }
      }

      // Dropdown
      $this->data['section'] = $this->Common_model->set_scout_section();

      // Load page
      $this->data['meta_title'] = 'Group Change Add';
      $this->data['subview'] = 'group_change_add';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function group_change_delete($rowID, $id=NULL){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member())){
         redirect('dashboard');
      }

      $scoutID = $id != NULL ? (int) decrypt_url($id) : $this->userID; //exit;      
      $this->data['info'] = $this->Program_model->get_info($scoutID);
      // $memberType = $this->data['info']->member_id;
      $sectionType = $this->data['info']->sc_section_id;
      
      $rowID = (int) decrypt_url($rowID); //exit; 

      if($this->Common_model->delete('prog_group_resign', 'id', $rowID)){

         /***********Activity Logs Start**********/
         func_activity_log(3, 'group change delete data ID :'.$rowID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Group change data delete successfully.');
         if($id != ''){
            if($sectionType == 1){
               redirect("program/cub_program/".$id);         
            }elseif($sectionType == 2){
               redirect("program/scout_program/".$id);         
            }elseif($sectionType == 3){
               redirect("program/rover_program/".$id);              
            }
         }else{
            if($sectionType == 1){
               redirect("program/cub_program");         
            }elseif($sectionType == 2){
               redirect("program/scout_program");         
            }elseif($sectionType == 3){
               redirect("program/rover_program");              
            }
         }
      }
   }


   function ajax_get_proficiency_badge_by_prof_group($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Program_model->get_proficiency_badge_group_by_id($id)));
    }















   








   




   public function program_badge($scout_id){

        /*$this->form_validation->set_rules('scout_badge', 'badge', 'trim|required');        
        $this->form_validation->set_rules('question_id', 'biboron', 'trim|required');        
        $this->form_validation->set_rules('achive_date', 'achive date', 'trim|required');  */      

        $updateid=$this->input->get('hide_id');
        $form_data = array(
         'scout_id'      => $scout_id,
         'section_id'    => $this->input->get('section_id'),
         'badge_id'      => $this->input->get('scout_badge'),
         'question_id'   => $this->input->get('question_id'),
         'achive_date'   => date_db_format($this->input->get('achive_date')),
         'user_id'       => $this->input->get('hide_user_id'),
         'examiner_id'   => $this->input->get('examiner_id'),
         'status'        => $this->status
         );
        $delete_id = $this->input->get('delete_id');

        if($delete_id > 0 ) 
        {
         if($this->Program_model->delete_prgram('prog_badge_question_value',$delete_id))
           echo 'Delete Success';
        else
           echo 'Delete Failed';
     }
     else if ($updateid=='' and $this->input->get('scout_badge') >0){

        $validate_insert=$this->Program_model->checkduplicate($form_data);
        if(empty($validate_insert))
        {
          if($this->Common_model->save('prog_badge_question_value', $form_data)){
            echo 'inserted';
         }else {
            echo 'insert fail';
         }
      }
      else
         echo 'duplicate';

   }
   else if($updateid>0 and $this->input->get('scout_badge') >0){
      if($this->Common_model->edit('prog_badge_question_value', $updateid, 'id', $form_data)) {
        echo 'updated';
     }else {
        echo 'update fail';
     }
  }

  $alldt=$this->Program_model->get_badge_details($form_data);
  echo '23432sdfg324';
  echo '<table class="tg">
  <tr>
    <th class="tg-71hr">ক্রম</th>
    <th class="tg-71hr">ব্যাজ</th>
    <th class="tg-71hr">বিবরণ</th>
    <th class="tg-71hr">অর্জনের তারিখ</th>
    <th class="tg-71hr">মূল্যায়নকারী</th>
    <th class="tg-71hr">যাচাইকারী</th>
    <th class="tg-71hr" width="120">পদক্ষেপ</th>
 </tr>';
 for($i=0;$i<sizeof($alldt);$i++)
 {
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
    <td class="tg-031e">'.$alldt[$i]->questions.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.','.$alldt[$i]->question_id.',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_badge_question_value';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',1);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_expertness($scout_id){

        /*$this->form_validation->set_rules('scout_badge', 'badge', 'trim|required');        
        $this->form_validation->set_rules('question_id', 'biboron', 'trim|required');        
        $this->form_validation->set_rules('achive_date', 'achive date', 'trim|required');  */      
        
        $updateid=$this->input->get('hide_id');
        $form_data = array(
         'scout_id'        => $scout_id,
         'section_id'      => $this->input->get('section_id'),
         'badge_id'        => $this->input->get('scout_badge'),
         'expert_group_id' => $this->input->get('expert_group_id'),
         'extra_badge'     => $this->input->get('extra_badge'),
         'achive_date'     => date_db_format($this->input->get('achive_date')),
         'user_id'         => $this->input->get('hide_user_id'),
         'examiner_id'     => $this->input->get('examiner_id'),
         'status'          => $this->status
         );
        $delete_id = $this->input->get('delete_id');
        
        if($delete_id > 0 ) 
        {
         if($this->Program_model->delete_prgram('prog_badge_expertness',$delete_id))
           echo 'Delete Success';
        else
           echo 'Delete Failed';
     }
     else if ($updateid=='' and $this->input->get('scout_badge') >0){

       $validate_insert=$this->Program_model->expertness_checkduplicate($form_data);
       if(empty($validate_insert))
       {
         if($this->Common_model->save('prog_badge_expertness', $form_data)){
           echo 'inserted';
        }else {
           echo 'insert fail';
        }
     }
     else
       echo 'duplicate';

 }
 else if($updateid>0 and $this->input->get('scout_badge') >0){



    if($this->Common_model->edit('prog_badge_expertness', $updateid, 'id', $form_data)) {
      echo 'updated';
   }else {
      echo 'update fail';
   }
}

$alldt=$this->Program_model->get_badge_details_expertness($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
   <th class="tg-71hr">ক্রম</th>
   <th class="tg-71hr">ব্যাজ</th>
   <th class="tg-71hr">গ্রউপ</th>
   <th class="tg-71hr">অর্জনের তারিখ</th>
   <th class="tg-71hr">অতিরিক্ত ব্যাজ </th>
   <th class="tg-71hr">মূল্যায়নকারী</th>
   <th class="tg-71hr">যাচাইকারী</th>
   <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
 echo '
 <tr>
   <td class="tg-031e">'.($i+1).'</td>
   <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
   <td class="tg-031e">'.$alldt[$i]->expert_group_name.'</td>
   <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
   <td class="tg-031e">'.$alldt[$i]->extra_badge.'</td>
   <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
   <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
   <td class="tg-031e">
     <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_expertness('.$alldt[$i]->id.');">Delete</button>
     <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram__expertness('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.','.$alldt[$i]->expert_group_id.',\''.$alldt[$i]->extra_badge.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
     '; 
     if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
       $table='prog_badge_expertness';
       if($alldt[$i]->status==0){
         echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',2);">Verify</button>';
      }
   }
   echo' 
</td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_achievemen($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'badge_id'        => $this->input->get('scout_badge'),
    'achive_date'     => date_db_format($this->input->get('achive_date')),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );
  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_badge_achievement',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

 $validate_insert=$this->Program_model->achievement_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_badge_achievement', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



 if($this->Common_model->edit('prog_badge_achievement', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_achievement($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">ব্যাজ</th>
  <th class="tg-71hr">গ্রহণের তারিখ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->achive_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_achievemen('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_achievemen('.$alldt[$i]->id.',\''.$alldt[$i]->achive_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_badge_achievement';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',3);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_camping($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'area'            => $this->input->get('area'),
    'camp_name'       => $this->input->get('camp_name'),
    'certificate_no'  => $this->input->get('camp_certificate_no'),
    'camp_date'       => date_db_format($this->input->get('achive_date')),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );
  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_camping',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('area'))){

 $validate_insert=$this->Program_model->camping_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_camping', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('area'))){



 if($this->Common_model->edit('prog_camping', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_camping($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">ক্যাম্পের নাম</th>
  <th class="tg-71hr">স্থান</th>
  <th class="tg-71hr">সনদ নং</th>
  <th class="tg-71hr">ক্যাম্প তারিখ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->camp_name.'</td>
    <td class="tg-031e">'.$alldt[$i]->area.'</td>
    <td class="tg-031e">'.$alldt[$i]->certificate_no.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->camp_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_camping('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_camping('.$alldt[$i]->id.',\''.$alldt[$i]->camp_date.'\',\''.$alldt[$i]->area.'\',\''.$alldt[$i]->camp_name.'\',\''.$alldt[$i]->certificate_no.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_camping';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',4);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_training($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'badge_id'        => $this->input->get('scout_badge'),
    'training_name'   => $this->input->get('train_name'),
    'certificate_no'  => $this->input->get('train_certificate_no'),
    'training_date'   => date_db_format($this->input->get('achive_date')),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );
  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_training',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

 $validate_insert=$this->Program_model->training_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_training', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



 if($this->Common_model->edit('prog_training', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_training($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">ব্যাজ</th>
  <th class="tg-71hr">প্রশিক্ষণের নাম</th>
  <th class="tg-71hr">সনদ নং</th>
  <th class="tg-71hr">প্রশিক্ষণের তারিখ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
    <td class="tg-031e">'.$alldt[$i]->training_name.'</td>
    <td class="tg-031e">'.$alldt[$i]->certificate_no.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->training_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_training('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_training('.$alldt[$i]->id.',\''.$alldt[$i]->training_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->training_name.'\',\''.$alldt[$i]->certificate_no.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_training';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',5);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_health($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'years'           => $this->input->get('health_years'),
    'height'          => $this->input->get('health_height'),
    'weight'          => $this->input->get('health_weight'),
    'chest_size'      => $this->input->get('health_chest_size'),
    'span'            => $this->input->get('health_span'),
    'hand_size'       => $this->input->get('health_hand_size'),
    'heartbeat'       => $this->input->get('health_heartbeat'),
    'temperature'     => $this->input->get('health_temperature'),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );

  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_physical_health',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('health_years'))){

 $validate_insert=$this->Program_model->health_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_physical_health', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('health_years'))){



 if($this->Common_model->edit('prog_physical_health', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_health($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">বর্ষ</th>
  <th class="tg-71hr">উচ্চতা</th>
  <th class="tg-71hr">ওজন</th>
  <th class="tg-71hr">বুকের মাপ</th>
  <th class="tg-71hr">বিঘত</th>
  <th class="tg-71hr">হাতের মাপ</th>
  <th class="tg-71hr">হৃদ স্পন্দন</th>
  <th class="tg-71hr">তাপমাত্রা</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->years.'</td>
    <td class="tg-031e">'.$alldt[$i]->height.'</td>
    <td class="tg-031e">'.$alldt[$i]->weight.'</td>
    <td class="tg-031e">'.$alldt[$i]->chest_size.'</td>
    <td class="tg-031e">'.$alldt[$i]->span.'</td>
    <td class="tg-031e">'.$alldt[$i]->hand_size.'</td>
    <td class="tg-031e">'.$alldt[$i]->heartbeat.'</td>
    <td class="tg-031e">'.$alldt[$i]->temperature.'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id2.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_health('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_health('.$alldt[$i]->id.',\''.$alldt[$i]->years.'\',\''.$alldt[$i]->height.'\',\''.$alldt[$i]->weight.'\',\''.$alldt[$i]->chest_size.'\',\''.$alldt[$i]->span.'\',\''.$alldt[$i]->hand_size.'\',\''.$alldt[$i]->heartbeat.'\',\''.$alldt[$i]->temperature.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_physical_health';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',6);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_institute($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'years'           => $this->input->get('institute_years'),
    'class_name'      => $this->input->get('institute_class_name'),
    'roll_no'         => $this->input->get('institute_roll_no'),
    'total_unmber'    => $this->input->get('institute_total_unmber'),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );

  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_institute_promotion',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('institute_years'))){

 $validate_insert=$this->Program_model->institute_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_institute_promotion', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('institute_years'))){



 if($this->Common_model->edit('prog_institute_promotion', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_institute($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">বর্ষ</th>
  <th class="tg-71hr">শ্রেণী</th>
  <th class="tg-71hr">রোল নং</th>
  <th class="tg-71hr">প্রাপ্ত নম্বর</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->years.'</td>
    <td class="tg-031e">'.$alldt[$i]->class_name.'</td>
    <td class="tg-031e">'.$alldt[$i]->roll_no.'</td>
    <td class="tg-031e">'.$alldt[$i]->total_unmber.'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id2.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_institute('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_institute('.$alldt[$i]->id.',\''.$alldt[$i]->years.'\',\''.$alldt[$i]->class_name.'\',\''.$alldt[$i]->roll_no.'\',\''.$alldt[$i]->total_unmber.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_institute_promotion';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',7);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_promotion($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'badge_id'        => $this->input->get('scout_badge'),
    'role_id'         => $this->input->get('scout_role'),
    'from_date'       => date_db_format($this->input->get('from_date')),
    'to_date'         => date_db_format($this->input->get('to_date')),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );
  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0 ) 
  {
    if($this->Program_model->delete_prgram('prog_section_promotion',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and $this->input->get('scout_badge') >0){

 $validate_insert=$this->Program_model->promotion_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_section_promotion', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and $this->input->get('scout_badge') >0){



 if($this->Common_model->edit('prog_section_promotion', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_promotion($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">রোল</th>
  <th class="tg-71hr">পদোন্নতির শুরুর তারিখ</th>
  <th class="tg-71hr">পদোন্নতির শেষ তারিখ</th>
  <th class="tg-71hr">ব্যাজ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.$alldt[$i]->role_type_name_bn.'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->from_date).'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->to_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->badge_type_name_bn.'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_promotion('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_promotion('.$alldt[$i]->id.',\''.$alldt[$i]->from_date.'\',\''.$alldt[$i]->to_date.'\','.$alldt[$i]->badge_id.',\''.$alldt[$i]->role_id.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_section_promotion';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',8);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function program_badge_resign($scout_id){


  $updateid=$this->input->get('hide_id');
  $form_data = array(
    'scout_id'        => $scout_id,
    'section_id'      => $this->input->get('section_id'),
    'resign_reason'   => $this->input->get('resign_reason'),
    'resign_date'     => date_db_format($this->input->get('resign_date')),
    'user_id'         => $this->input->get('hide_user_id'),
    'examiner_id'     => $this->input->get('examiner_id'),
    'status'          => $this->status
    );
  $delete_id = $this->input->get('delete_id');

  if($delete_id > 0) 
  {
    if($this->Program_model->delete_prgram('prog_group_resign',$delete_id))
      echo 'Delete Success';
   else
      echo 'Delete Failed';
}
else if ($updateid=='' and !empty($this->input->get('resign_reason'))){

 $validate_insert=$this->Program_model->resign_checkduplicate($form_data);
 if(empty($validate_insert))
 {
   if($this->Common_model->save('prog_group_resign', $form_data)){
     echo 'inserted';
  }else {
     echo 'insert fail';
  }
}
else
  echo 'duplicate';

}
else if($updateid>0 and !empty($this->input->get('resign_reason'))){



 if($this->Common_model->edit('prog_group_resign', $updateid, 'id', $form_data)) {
   echo 'updated';
}else {
   echo 'update fail';
}
}

$alldt=$this->Program_model->get_badge_details_resign($form_data);
echo '23432sdfg324';
echo '<table class="tg">
<tr>
  <th class="tg-71hr">ক্রম</th>
  <th class="tg-71hr">গ্রুপ ত্যাগের তারিখ</th>
  <th class="tg-71hr">গ্রুপ ত্যাগের কারণ</th>
  <th class="tg-71hr">মূল্যায়নকারী</th>
  <th class="tg-71hr">যাচাইকারী</th>
  <th class="tg-71hr" width="120">পদক্ষেপ</th>
</tr>';
for($i=0;$i<sizeof($alldt);$i++)
{
  echo '
  <tr>
    <td class="tg-031e">'.($i+1).'</td>
    <td class="tg-031e">'.date_bangla_format($alldt[$i]->resign_date).'</td>
    <td class="tg-031e">'.$alldt[$i]->resign_reason.'</td>
    <td class="tg-031e">'.$alldt[$i]->examiner_id.'</td>
    <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
    <td class="tg-031e">
      <button type="button" class="btn btn-danger btn-mini" onclick="return delete_scoutprogram_resign('.$alldt[$i]->id.');">Delete</button>
      <button type="button" class="btn btn-success btn-mini" onclick="return edit_scoutprogram_resign('.$alldt[$i]->id.',\''.$alldt[$i]->resign_date.'\',\''.$alldt[$i]->resign_reason.'\',\''.$alldt[$i]->ex_id.'\');">Edit</button>
      '; 
      if($this->ion_auth->is_admin() OR $this->ion_auth->is_region_admin() OR $this->ion_auth->is_district_admin() OR $this->ion_auth->is_upazila_admin() OR $this->ion_auth->is_group_admin()){
        $table='prog_group_resign';
        if($alldt[$i]->status==0){
          echo '<button type="button" class="btn btn-info btn-mini" onclick="return verify_scoutprogram('.$alldt[$i]->id.',\''.$table.'\',9);">Verify</button>';
       }
    }
    echo' 
 </td>
</tr>
';
}
echo '</table>';
exit;
}

public function verify_program($scout_id){

  $form_data = array(
   'user_id'         => $this->input->get('hide_user_id'),
   'status'          => $this->status
   );
  $updateid = $this->input->get('verifyid');
  $table    = $this->input->get('verifytable');

  if($this->Common_model->edit($table, $updateid, 'id', $form_data)) {
    echo 'updated';
 }else {
    echo 'update fail';
 }
 exit;
}

}