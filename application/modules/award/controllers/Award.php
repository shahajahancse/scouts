<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Award extends Backend_Controller {
   // var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Award';
      $this->load->model('Award_model');
      $this->userSessID = $this->session->userdata('user_id');

      $this->file_path = realpath(APPPATH . '../uploads/award_file');
      $this->award_event_path = realpath(APPPATH . '../uploads/award_event');
   }

   public function index(){
      redirect('dashboard');
   }

   /****************** Community Development Award *****************/
   /****************************************************************/

   public function community_development_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')|| $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_award_circular($limit, $offset, 4); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/community_development_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Community Development Award Circular';
      $this->data['subview'] = 'community_development_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function community_development_recommendation_form($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - community_development_recommendation_form - exitsts', TRUE);
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         $this->data['scouts_member'] = '';
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);
      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      //Results
      //$results = $this->Award_model->get_national_committee_info($committeeID); 
      //$this->data['info'] = $results['info'];

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      // $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      // $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      // $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      // $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      // $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      // $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      // $this->form_validation->set_rules('age', 'age', 'required|trim');
      // $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      // $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      // $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      // $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      // $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      // if($this->input->post('memberType')){
      $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      // }


      if ($this->form_validation->run() == true){
         $form_data = array(            
            'circular_id'       => $dataID,
            'scout_id'          => $this->input->post('scout_member_id'),            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('award_cub_recommendation', $form_data)){               
            // Success Message
            $this->session->set_flashdata('success', 'Award recommendation successfully.');
            redirect("award/community_development_list");
         }
      }

      //Dropdown
      
      // $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      // $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');

      // Load page
      $this->data['meta_title'] = 'Community Development Award Recommendation Form';
      $this->data['subview'] = 'community_development_recommendation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function community_development_recommendation_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_recommended_list($dataID);

      //Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'Community Development Award Recommendation List';
      $this->data['subview'] = 'community_development_recommendation_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function community_development_recommendation_details_pdf($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_details_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_recommendation_details($dataID);

      $this->data['info'] = $results['info'];
      // $this->data['scouter_respon'] = $results['scouter_respon'];
      // $this->data['non_exe_respon'] = $results['non_exe_respon'];
      // $this->data['award_achived']  = $results['award_achived'];

      
      //...............................................................................
      $this->data['meta_title'] = "সমাজ উন্নয়ন অ্যাওয়ার্ড সুপারিশ ফরম";
      $html = $this->load->view('community_development_recommendation_details_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function community_development_evaluation($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - community_development_evaluation - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_cub_evaluation($dataID);
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'Community Development Award Evaluation';
      $this->data['subview'] = 'community_development_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function community_development_approve_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - community_development_approve_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
         $form_data = array('verify_nhq' => 'Approved');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Approved');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Approved');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Approved');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/community_development_evaluation/'.encrypt_url($dataID));
   }

   public function community_development_reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - community_development_reject_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
         $form_data = array('verify_nhq' => 'Reject');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Reject');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Reject');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Reject');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation reject.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/community_development_evaluation/'.encrypt_url($dataID));
   }

   public function community_development_approve_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - community_development_approve_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_approved_list($dataID);

      // Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'Community Development Award Approve List';
      $this->data['subview'] = 'community_development_approve_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function community_development_award_approval_list_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_award_approval_list_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_approved_list($dataID);
      // print_r($results); exit;

      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "Community Development Award Approved List";
      $html = $this->load->view('community_development_award_approval_list_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function community_development_certificate_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - community_development_certificate_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Award_model->get_cub_certificate($dataID);
      // print_r($this->data['info']); exit;
      
      
      //...............................................................................
      $this->data['meta_title'] = "Community Development Award Approved List";
      $html = $this->load->view('community_development_certificate_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function community_development_recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin() || $this->ion_auth->in_group('award')){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - community_development_recommendation_delete - exitsts', TRUE);
      }

      // Delete data
      if($this->Common_model->delete('award_cub_recommendation', 'id', $dataID)){
         $this->session->set_flashdata('success', 'Recommendation data delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/community_development_recommendation_list/'.$circularID);
   }





   /********************** President Rover Scout Award *********************/
   /******************************************************************/

   public function president_rover_scout_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_award_circular($limit, $offset, 3); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/president_rover_scout_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'President Rover Scout Award Circular';
      $this->data['subview'] = 'president_rover_scout_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_rover_scout_recommendation_form($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_rover_scout_recommendation_form - exitsts', TRUE);
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         $this->data['scouts_member'] = '';
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);
      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      //Results
      //$results = $this->Award_model->get_national_committee_info($committeeID); 
      //$this->data['info'] = $results['info'];

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      // $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      // $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      // $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      // $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      // $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      // $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      // $this->form_validation->set_rules('age', 'age', 'required|trim');
      // $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      // $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      // $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      // $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      // $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      // if($this->input->post('memberType')){
      $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      // }


      if ($this->form_validation->run() == true){
         $form_data = array(            
            'circular_id'       => $dataID,
            'scout_id'          => $this->input->post('scout_member_id'),            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('award_cub_recommendation', $form_data)){               
            // Success Message
            $this->session->set_flashdata('success', 'Award recommendation successfully.');
            redirect("award/president_rover_scout_list");
         }
      }

      //Dropdown      
      // $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      // $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      // $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      // $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      // $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');

      // Load page
      $this->data['meta_title'] = 'President Rover Scout Award Recommendation Form';
      $this->data['subview'] = 'president_rover_scout_recommendation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function president_rover_scout_recommendation_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_rover_scout_recommendation_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_recommended_list($dataID);

      //Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'President Rover Scout Award Recommendation List';
      $this->data['subview'] = 'president_rover_scout_recommendation_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_rover_scout_recommendation_details_pdf($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_recommendation_details_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_recommendation_details($dataID);

      $this->data['info'] = $results['info'];
      // $this->data['scouter_respon'] = $results['scouter_respon'];
      // $this->data['non_exe_respon'] = $results['non_exe_respon'];
      // $this->data['award_achived']  = $results['award_achived'];

      
      //...............................................................................
      $this->data['meta_title'] = "প্রেসিডেন্ট'স রোভার স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম";
      $html = $this->load->view('president_rover_scout_recommendation_details_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_rover_scout_evaluation($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_evaluation - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_cub_evaluation($dataID);
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'President Rover Scout Award Evaluation';
      $this->data['subview'] = 'president_rover_scout_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_rover_scout_approve_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_approve_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Approved');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Approved');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Approved');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Approved');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_rover_scout_evaluation/'.encrypt_url($dataID));
   }

   public function president_rover_scout_reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_reject_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Reject');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Reject');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Reject');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Reject');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation reject.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_rover_scout_evaluation/'.encrypt_url($dataID));
   }

   public function president_rover_scout_approve_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_scout_approve_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_approved_list($dataID);

      // Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'President Rover Scout Award Approve List';
      $this->data['subview'] = 'president_rover_scout_approve_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_rover_scout_award_approval_list_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_rover_scout_award_approval_list_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_approved_list($dataID);
      // print_r($results); exit;

      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "President Rover Scout Award Approved List";
      $html = $this->load->view('president_rover_scout_award_approval_list_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_rover_scout_certificate_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_certificate_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Award_model->get_cub_certificate($dataID);
      // print_r($this->data['info']); exit;
      
      
      //...............................................................................
      $this->data['meta_title'] = "President Rover Scout Award Approved List";
      $html = $this->load->view('president_rover_scout_certificate_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_rover_scout_recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin() || !$this->ion_auth->in_group('award')){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_rover_scout_recommendation_delete - exitsts', TRUE);
      }

      // Delete data
      if($this->Common_model->delete('award_cub_recommendation', 'id', $dataID)){
         $this->session->set_flashdata('success', 'Recommendation data delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_rover_scout_recommendation_list/'.$circularID);
   }






   /********************** President Scout Award *********************/
   /******************************************************************/

   public function president_scout_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_award_circular($limit, $offset, 2); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/president_scout_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'President Scout Award Circular';
      $this->data['subview'] = 'president_scout_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_scout_recommendation_form($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_scout_recommendation_form - exitsts', TRUE);
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         $this->data['scouts_member'] = '';
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);
      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      //Results
      //$results = $this->Award_model->get_national_committee_info($committeeID); 
      //$this->data['info'] = $results['info'];

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      // $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      // $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      // $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      // $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      // $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      // $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      // $this->form_validation->set_rules('age', 'age', 'required|trim');
      // $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      // $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      // $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      // $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      // $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      // if($this->input->post('memberType')){
      $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      // }


      if ($this->form_validation->run() == true){
         $form_data = array(            
            'circular_id'       => $dataID,
            'scout_id'          => $this->input->post('scout_member_id'),            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('award_cub_recommendation', $form_data)){               
            // Success Message
            $this->session->set_flashdata('success', 'Award recommendation successfully.');
            redirect("award/president_scout_list");
         }
      }

      //Dropdown      
      // $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      // $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      // $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      // $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      // $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');

      // Load page
      $this->data['meta_title'] = 'President Scout Award Recommendation Form';
      $this->data['subview'] = 'president_scout_recommendation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function president_scout_recommendation_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_scout_recommendation_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_recommended_list($dataID);

      //Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'President Scout Award Recommendation List';
      $this->data['subview'] = 'president_scout_recommendation_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_scout_recommendation_details_pdf($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_recommendation_details_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_recommendation_details($dataID);

      $this->data['info'] = $results['info'];
      // $this->data['scouter_respon'] = $results['scouter_respon'];
      // $this->data['non_exe_respon'] = $results['non_exe_respon'];
      // $this->data['award_achived']  = $results['award_achived'];

      
      //...............................................................................
      $this->data['meta_title'] = "প্রেসিডেন্ট'স স্কাউট অ্যাওয়ার্ড সুপারিশ ফরম";
      $html = $this->load->view('president_scout_recommendation_details_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_scout_evaluation($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_evaluation - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_cub_evaluation($dataID);
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'President Scout Award Evaluation';
      $this->data['subview'] = 'president_scout_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_scout_approve_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_approve_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Approved');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Approved');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Approved');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Approved');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_scout_evaluation/'.encrypt_url($dataID));
   }

   public function president_scout_reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_reject_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Reject');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Reject');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Reject');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Reject');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation reject.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_scout_evaluation/'.encrypt_url($dataID));
   }

   public function president_scout_approve_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_scout_approve_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_approved_list($dataID);

      // Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'President Scout Award Approve List';
      $this->data['subview'] = 'president_scout_approve_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function president_scout_award_approval_list_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - president_scout_award_approval_list_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_approved_list($dataID);
      // print_r($results); exit;

      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "President Scout Award Approved List";
      $html = $this->load->view('president_scout_award_approval_list_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_scout_certificate_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_certificate_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Award_model->get_cub_certificate($dataID);
      // print_r($this->data['info']); exit;
      
      
      //...............................................................................
      $this->data['meta_title'] = "President Scout Award Approved List";
      $html = $this->load->view('president_scout_certificate_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function president_scout_recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - president_scout_recommendation_delete - exitsts', TRUE);
      }

      // Delete data
      if($this->Common_model->delete('award_cub_recommendation', 'id', $dataID)){
         $this->session->set_flashdata('success', 'Recommendation data delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/president_scout_recommendation_list/'.$circularID);
   }





   /********************** Shapla Cub Award ************************/
   /****************************************************************/

   public function shapla_cub_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_award_circular($limit, $offset, 1); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/shapla_cub_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Shapla Cub Award Circular';
      $this->data['subview'] = 'shapla_cub_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function shapla_cub_recommendation_form($id){
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_form - exitsts', TRUE);
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         $this->data['scouts_member'] = '';
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);
      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      //Results
      //$results = $this->Award_model->get_national_committee_info($committeeID); 
      //$this->data['info'] = $results['info'];

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      // $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      // $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      // $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      // $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      // $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      // $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      // $this->form_validation->set_rules('age', 'age', 'required|trim');
      // $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      // $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      // $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      // $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      // $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      // if($this->input->post('memberType')){
      $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      // }


      if ($this->form_validation->run() == true){
         $form_data = array(            
            'circular_id'       => $dataID,
            'scout_id'          => $this->input->post('scout_member_id'),            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('award_cub_recommendation', $form_data)){               
            // Success Message
            $this->session->set_flashdata('success', 'Award recommendation successfully.');
            redirect("award/shapla_cub_list");
         }
      }

      //Dropdown
      
      // $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      // $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');

      // Load page
      $this->data['meta_title'] = 'Shapla Cub Award Recommendation Form';
      $this->data['subview'] = 'shapla_cub_recommendation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function shapla_cub_recommendation_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_recommended_list($dataID);

      //Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'Shapla Cub Award Recommendation List';
      $this->data['subview'] = 'shapla_cub_recommendation_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function shapla_cub_recommendation_details_pdf($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_details_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_recommendation_details($dataID);

      $this->data['info'] = $results['info'];
      // $this->data['scouter_respon'] = $results['scouter_respon'];
      // $this->data['non_exe_respon'] = $results['non_exe_respon'];
      // $this->data['award_achived']  = $results['award_achived'];

      
      //...............................................................................
      $this->data['meta_title'] = "শাপলা কাব অ্যাওয়ার্ড সুপারিশ ফরম";
      $html = $this->load->view('shapla_cub_recommendation_details_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function shapla_cub_evaluation($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_evaluation - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_cub_evaluation($dataID);
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'Shapla Cub Award Evaluation';
      $this->data['subview'] = 'shapla_cub_evaluation';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function shapla_cub_approve_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_approve_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Approved');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Approved');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Approved');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Approved');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/shapla_cub_evaluation/'.encrypt_url($dataID));
   }

   public function shapla_cub_reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_reject_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Reject');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Reject');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Reject');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Reject');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_cub_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation reject.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/shapla_cub_evaluation/'.encrypt_url($dataID));
   }

   public function shapla_cub_approve_list($id){     
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_approve_list - exitsts', TRUE);
      }

      // Results
      $results = $this->Award_model->get_cub_approved_list($dataID);

      // Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      // Load view
      $this->data['meta_title'] = 'Shapla Cub Award Approve List';
      $this->data['subview'] = 'shapla_cub_approve_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function shapla_cub_award_approval_list_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - shapla_cub_award_approval_list_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_cub_approved_list($dataID);
      // print_r($results); exit;

      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "Shapla Cab Award Approved List";
      $html = $this->load->view('shapla_cub_award_approval_list_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function shapla_cub_certificate_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_certificate_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Award_model->get_cub_certificate($dataID);
      // print_r($this->data['info']); exit;
      
      
      //...............................................................................
      $this->data['meta_title'] = "Shapla Cab Award Approved List";
      $html = $this->load->view('shapla_cub_certificate_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function shapla_cub_recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin() || !$this->ion_auth->in_group('award')){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_cub_recommendation', 'id', $dataID)) { 
         show_404('award - shapla_cub_recommendation_delete - exitsts', TRUE);
      }

      // Delete data
      if($this->Common_model->delete('award_cub_recommendation', 'id', $dataID)){
         $this->session->set_flashdata('success', 'Recommendation data delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/shapla_cub_recommendation_list/'.$circularID);
   }




   /**************************** NHQ Award  ************************/
   /****************************************************************/   

   public function nhq_list($offset=0){
      $limit = 25;

      if($this->ion_auth->is_admin()){
         //Results
         $results = $this->Award_model->get_award_circular($limit, $offset, 5);    
      }elseif($this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin() || $this->ion_auth->is_scout_member()){         
         //Results
         $results = $this->Award_model->get_award_circular($limit, $offset, 5, 1); 
      }else{
         redirect('dashboard');
      }
      
      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/nhq_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'NHQ Award Circular';
      $this->data['subview'] = 'nhq_list';
      $this->load->view('backend/_layout_main', $this->data);
   }  
   
   public function apply_nhq($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - apply_nhq - exitsts', TRUE);
      }

      // Cross match for already apply application or recommended

      // Result
      $this->data['info'] = $this->Award_model->get_award_circular_info($dataID);

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_scout_member()){
         $user = $this->ion_auth->user()->row(); 
         
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_info($user->sc_group_id);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id; //exit;

         // Dropdown
         // $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);
      }else{
         redirect('dashboard');
      }

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      $this->form_validation->set_rules('age', 'age', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      if($this->input->post('recom_award_id') == 1 || $this->input->post('recom_award_id') == 2 || $this->input->post('recom_award_id') == 3){

         if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
         }

         if(@$_FILES['userfile1']['size'] > 0){
            $this->form_validation->set_rules('userfile1', '', 'callback_file_check');
         }

         if(@$_FILES['userfile2']['size'] > 0){
            $this->form_validation->set_rules('userfile2', '', 'callback_file_check');
         }         
      }

      /*
      if($this->input->post('memberType')){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      }
      */
      
      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'circular_id'       => $dataID,
            'recom_award_id'    => $this->input->post('recom_award_id'),
            // 'recom_member_type' => $this->input->post('memberType'),    
            'scout_id'          => $user->id,
            'name_bn'           => $this->input->post('name_bn'),
            'name_en'           => $this->input->post('name_en'),
            'father_name'       => $this->input->post('father_name'),
            'mother_name'       => $this->input->post('mother_name'),
            'dob'               => date_db_format($this->input->post('dob')),
            'age'               => $this->input->post('age'),
            'leader_join'       => date_db_format($this->input->post('leader_join')),
            'present_desig'     => $this->input->post('present_desig'),
            'phone'             => $this->input->post('phone'),
            'email'             => $this->input->post('email'),
            'gender'            => $this->input->post('gender'),
            'working_desig'     => $this->input->post('working_desig'),
            'present_address'   => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'sc_group_name'     => $this->input->post('sc_group_name'),
            'sc_upazila_name'   => $this->input->post('sc_upazila_name'),
            'sc_district_name'  => $this->input->post('sc_district_name'),
            'sc_region_name'    => $this->input->post('sc_region_name'),
            'citation'          => $this->input->post('citation'),
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->input->post('recom_award_id') == 1 || $this->input->post('recom_award_id') == 2 || $this->input->post('recom_award_id') == 3){

            // Event Image 1
            if($_FILES['userfile']['size'] > 0){
               $new_file_name = time().'-img1-'.$_FILES["userfile"]['name'];
               $config['allowed_types']= 'jpg|png|jpeg';
               $config['upload_path']  = $this->award_event_path;
               $config['file_name']    = $new_file_name;
               $config['max_size']     = 600;

               $this->load->library('upload', $config);
               //upload file to directory
               if($this->upload->do_upload('userfile')){
                  $uploadData = $this->upload->data();
                  $config = array(
                     'source_image' => $uploadData['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config);
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();

                  $uploadedFile = $uploadData['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }

            // Event Image 2
            if($_FILES['userfile2']['size'] > 0){
               $new_file_name2 = time().'-img2-'.$_FILES["userfile2"]['name'];
               $config2['allowed_types']= 'jpg|png|jpeg';
               $config2['upload_path']  = $this->award_event_path;
               $config2['file_name']    = $new_file_name2;
               $config2['max_size']     = 600;

               $this->load->library('upload', $config2);
               //upload file to directory
               if($this->upload->do_upload('userfile2')){
                  $uploadData2 = $this->upload->data();
                  $config2 = array(
                     'source_image' => $uploadData2['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config2);
                  $this->image_lib->initialize($config2);
                  $this->image_lib->resize();

                  $uploadedFile2 = $uploadData2['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }    

            // Event Image 3
            if($_FILES['userfile3']['size'] > 0){
               $new_file_name3 = time().'-img3-'.$_FILES["userfile3"]['name'];
               $config3['allowed_types']= 'jpg|png|jpeg';
               $config3['upload_path']  = $this->award_event_path;
               $config3['file_name']    = $new_file_name3;
               $config3['max_size']     = 600;

               $this->load->library('upload', $config3);
               //upload file to directory
               if($this->upload->do_upload('userfile3')){
                  $uploadData3 = $this->upload->data();
                  $config3 = array(
                     'source_image' => $uploadData3['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config3);
                  $this->image_lib->initialize($config3);
                  $this->image_lib->resize();

                  $uploadedFile3 = $uploadData3['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }        

            // DB fields
            if($_FILES['userfile']['size'] > 0){
               $form_data['image1'] = $uploadedFile;
            }

            if($_FILES['userfile2']['size'] > 0){
               $form_data['image2'] = $uploadedFile2;
            }

            if($_FILES['userfile3']['size'] > 0){
               $form_data['image3'] = $uploadedFile3;
            }
         }


         if($this->Common_model->save('award_recommendation', $form_data)){   
            //last personal data id
            $lastID = $this->db->insert_id();

            // Events 
            for ($i=0; $i<sizeof($_POST['evt_office_id']); $i++) { 
               $event_data = array(
                  'data_id'         => $lastID,
                  'evt_office_id'   => $_POST['evt_office_id'][$i],
                  'evtent_id'       => $_POST['evtent_id'][$i],
                  'evt_date_from'   => date_db_format($_POST['evt_date_from'][$i]),
                  'evt_date_to'     => date_db_format($_POST['evt_date_to'][$i]),
                  'evt_comments'    => $_POST['evt_comments'][$i],
                  );
               $this->Common_model->save('award_recom_events', $event_data);
            }

            // Experiance 
            for ($i=0; $i<sizeof($_POST['res_office_id']); $i++) { 
               $experience_data = array(
                  'data_id'         => $lastID,
                  'res_office_id'   => $_POST['res_office_id'][$i],
                  'res_desig_id'    => $_POST['res_desig_id'][$i],
                  'res_date_from'   => date_db_format($_POST['res_date_from'][$i]),
                  'res_date_to'     => date_db_format($_POST['res_date_to'][$i]),
                  );
               $this->Common_model->save('award_recom_scouter_responsibility', $experience_data);
            }
            //Executive / Non Executive
            for ($i=0; $i<sizeof($_POST['noe_office_id']); $i++) { 
               $promotion_data = array(
                  'data_id'         => $lastID,                        
                  'noe_office_id'   => $_POST['noe_office_id'][$i],
                  'noe_desig_id'    => $_POST['noe_desig_id'][$i],
                  'noe_date_from'   => date_db_format($_POST['noe_date_from'][$i]),
                  'noe_date_to'     => date_db_format($_POST['noe_date_to'][$i]),
                  );
               $this->Common_model->save('award_recom_exe_non_exe_responsibility', $promotion_data);
            }
            // Award Archived
            for ($i=0; $i<sizeof($_POST['award_nhq_id']); $i++) { 
               $leave_data = array(
                  'data_id'      => $lastID,
                  'award_nhq_id' => $_POST['award_nhq_id'][$i],
                  'award_year'   => $_POST['award_year'][$i],                        
                  );
               $this->Common_model->save('award_recom_archived', $leave_data);
            }
            // Success Message
            $this->session->set_flashdata('success', 'NHQ award apply successfully.');
            redirect("award/nhq_list/");
         }
      }

      //Dropdown      
      $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      // $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      // $this->data['designation_type'] = $this->Common_model->get_comm_designation_by_office('3'); 
      $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');
      $this->data['event_category'] = $this->Common_model->get_all('*','event_category','1');

      // Load Page
      $this->data['meta_title'] = 'NHQ Award Applicaiton From';
      $this->data['subview'] = 'apply_nhq';
      $this->load->view('backend/_layout_main', $this->data);
   } 

   public function recommendation_form($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - recommendation_form - exitsts', TRUE);
      }

      // Result
      $this->data['info'] = $this->Award_model->get_award_circular_info($dataID);

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         $this->data['scouts_member'] = '';
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);
         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', $upazila);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);

      }elseif($this->ion_auth->is_scout_member()){
         $user = $this->ion_auth->user()->row(); 
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_info($user->sc_group_id);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id; //exit;

         // Dropdown
         $this->data['scouts_member'] = $this->Award_model->get_scout_member_by_group('', '', '', $group);

      }else{
         redirect('dashboard');
      }

      // $dataID = (int) decrypt_url($id); //exit;
      // if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
      //    show_404('committee - national_manage_member - exitsts', TRUE);
      // }

      //Results
      //$results = $this->Award_model->get_national_committee_info($committeeID); 
      //$this->data['info'] = $results['info'];

      // Validation
      // $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      // $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
      $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      $this->form_validation->set_rules('name_bn', 'name bangla', 'required|trim');
      $this->form_validation->set_rules('father_name', 'father name', 'required|trim');
      $this->form_validation->set_rules('mother_name', 'mother name', 'required|trim');      
      $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      $this->form_validation->set_rules('age', 'age', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      $this->form_validation->set_rules('present_address', 'present address', 'required|trim');
      $this->form_validation->set_rules('sc_group_name', 'sc_group_name', 'required|trim');
      $this->form_validation->set_rules('sc_district_name', 'sc_district_name', 'required|trim');
      $this->form_validation->set_rules('sc_region_name', 'sc_region_name', 'required|trim');

      if($this->input->post('recom_award_id') == 1 || $this->input->post('recom_award_id') == 2 || $this->input->post('recom_award_id') == 3){

         if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
         }

         if(@$_FILES['userfile1']['size'] > 0){
            $this->form_validation->set_rules('userfile1', '', 'callback_file_check');
         }

         if(@$_FILES['userfile2']['size'] > 0){
            $this->form_validation->set_rules('userfile2', '', 'callback_file_check');
         }         
      }

      // DB Insert
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'circular_id'       => $dataID,
            'recom_award_id'    => $this->input->post('recom_award_id'),
            // 'recom_member_type' => $this->input->post('memberType'),    
            'scout_id'          => $this->input->post('scout_member_id'),            
            'name_bn'           => $this->input->post('name_bn'),
            'name_en'           => $this->input->post('name_en'),
            'father_name'       => $this->input->post('father_name'),
            'mother_name'       => $this->input->post('mother_name'),
            'dob'               => date_db_format($this->input->post('dob')),
            'age'               => $this->input->post('age'),
            'leader_join'       => date_db_format($this->input->post('leader_join')),
            'present_desig'     => $this->input->post('present_desig'),
            'phone'             => $this->input->post('phone'),
            'email'             => $this->input->post('email'),
            'gender'            => $this->input->post('gender'),
            'working_desig'     => $this->input->post('working_desig'),
            'present_address'   => $this->input->post('present_address'),
            'permanent_address' => $this->input->post('permanent_address'),
            'sc_group_name'     => $this->input->post('sc_group_name'),
            'sc_upazila_name'   => $this->input->post('sc_upazila_name'),
            'sc_district_name'  => $this->input->post('sc_district_name'),
            'sc_region_name'    => $this->input->post('sc_region_name'),
            'citation'          => $this->input->post('citation'),
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->input->post('recom_award_id') == 1 || $this->input->post('recom_award_id') == 2 || $this->input->post('recom_award_id') == 3){

            // Event Image 1
            if($_FILES['userfile']['size'] > 0){
               $new_file_name = time().'-img1-'.$_FILES["userfile"]['name'];
               $config['allowed_types']= 'jpg|png|jpeg';
               $config['upload_path']  = $this->award_event_path;
               $config['file_name']    = $new_file_name;
               $config['max_size']     = 600;

               $this->load->library('upload', $config);
               //upload file to directory
               if($this->upload->do_upload('userfile')){
                  $uploadData = $this->upload->data();
                  $config = array(
                     'source_image' => $uploadData['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config);
                  $this->image_lib->initialize($config);
                  $this->image_lib->resize();

                  $form_data['image1'] = $uploadData['file_name'];
                  // $uploadedFile = $uploadData['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }

            // Event Image 2
            if($_FILES['userfile2']['size'] > 0){
               $new_file_name2 = time().'-img2-'.$_FILES["userfile2"]['name'];
               $config2['allowed_types']= 'jpg|png|jpeg';
               $config2['upload_path']  = $this->award_event_path;
               $config2['file_name']    = $new_file_name2;
               $config2['max_size']     = 600;

               $this->load->library('upload', $config2);
               //upload file to directory
               if($this->upload->do_upload('userfile2')){
                  $uploadData2 = $this->upload->data();
                  $config2 = array(
                     'source_image' => $uploadData2['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config2);
                  $this->image_lib->initialize($config2);
                  $this->image_lib->resize();

                  $form_data['image2'] = $uploadData2['file_name'];
                  // $uploadedFile2 = $uploadData2['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }    

            // Event Image 3
            if($_FILES['userfile3']['size'] > 0){
               $new_file_name3 = time().'-img3-'.$_FILES["userfile3"]['name'];
               $config3['allowed_types']= 'jpg|png|jpeg';
               $config3['upload_path']  = $this->award_event_path;
               $config3['file_name']    = $new_file_name3;
               $config3['max_size']     = 600;

               $this->load->library('upload', $config3);
               //upload file to directory
               if($this->upload->do_upload('userfile3')){
                  $uploadData3 = $this->upload->data();
                  $config3 = array(
                     'source_image' => $uploadData3['full_path'],
                     'new_image' => $this->award_event_path,
                     'maintain_ratio' => TRUE,
                     'width' => 300,
                     'height' => 300
                     );
                  $this->load->library('image_lib',$config3);
                  $this->image_lib->initialize($config3);
                  $this->image_lib->resize();

                  $form_data['image3'] = $uploadData3['file_name'];
                  // $uploadedFile3 = $uploadData3['file_name'];
                  // print_r($uploadedFile);
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }        

            // DB fields
            /*if($_FILES['userfile']['size'] > 0){
               $form_data['image1'] = $uploadedFile;
            }

            if($_FILES['userfile2']['size'] > 0){
               $form_data['image2'] = $uploadedFile2;
            }

            if($_FILES['userfile3']['size'] > 0){
               $form_data['image3'] = $uploadedFile3;
            }*/
         }

         if($this->Common_model->save('award_recommendation', $form_data)){   
            //last personal data id
            $lastID = $this->db->insert_id();

            // Events 
            for ($i=0; $i<sizeof($_POST['evt_office_id']); $i++) { 
               $event_data = array(
                  'data_id'         => $lastID,
                  'evt_office_id'   => $_POST['evt_office_id'][$i],
                  'evtent_id'       => $_POST['evtent_id'][$i],
                  'evt_date_from'   => date_db_format($_POST['evt_date_from'][$i]),
                  'evt_date_to'     => date_db_format($_POST['evt_date_to'][$i]),
                  'evt_comments'    => $_POST['evt_comments'][$i],
                  );
               $this->Common_model->save('award_recom_events', $event_data);
            }

            // Experiance 
            for ($i=0; $i<sizeof($_POST['res_office_id']); $i++) { 
               $experience_data = array(
                  'data_id'         => $lastID,
                  'res_office_id'   => $_POST['res_office_id'][$i],
                  'res_desig_id'    => $_POST['res_desig_id'][$i],
                  'res_date_from'   => date_db_format($_POST['res_date_from'][$i]),
                  'res_date_to'     => date_db_format($_POST['res_date_to'][$i]),
                  );
               $this->Common_model->save('award_recom_scouter_responsibility', $experience_data);
            }
            //Executive / Non Executive
            for ($i=0; $i<sizeof($_POST['noe_office_id']); $i++) { 
               $promotion_data = array(
                  'data_id'         => $lastID,                        
                  'noe_office_id'   => $_POST['noe_office_id'][$i],
                  'noe_desig_id'    => $_POST['noe_desig_id'][$i],
                  'noe_date_from'   => date_db_format($_POST['noe_date_from'][$i]),
                  'noe_date_to'     => date_db_format($_POST['noe_date_to'][$i]),
                  );
               $this->Common_model->save('award_recom_exe_non_exe_responsibility', $promotion_data);
            }
            // Award Archived
            for ($i=0; $i<sizeof($_POST['award_nhq_id']); $i++) { 
               $leave_data = array(
                  'data_id'      => $lastID,
                  'award_nhq_id' => $_POST['award_nhq_id'][$i],
                  'award_year'   => $_POST['award_year'][$i],                        
                  );
               $this->Common_model->save('award_recom_archived', $leave_data);
            }
            // Success Message
            $this->session->set_flashdata('success', 'Award recommendation successfully.');
            redirect("award/recommendation_list/".$id);
         }
      }

      //Dropdown      
      $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      // $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      // $this->data['designation_type'] = $this->Common_model->get_designation_by_office('2'); 
      // print_r($this->data['designation_type']); exit;
      $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');
      $this->data['event_category'] = $this->Common_model->get_all('*','event_category','1');

      // Load Page
      $this->data['meta_title'] = 'NHQ Award Recommendation Form';
      $this->data['subview'] = 'recommendation_form';
      $this->load->view('backend/_layout_main', $this->data);
   }
   
   public function recommendation_details_pdf($id){

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - recommendation_details_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_recommendation_details($dataID);

      $this->data['info'] = $results['info'];
      $this->data['event_list'] = $results['event_list'];
      $this->data['scouter_respon'] = $results['scouter_respon'];
      $this->data['non_exe_respon'] = $results['non_exe_respon'];
      $this->data['award_achived']  = $results['award_achived'];

      // print_r($this->data['event_list']); exit;

      
      //...............................................................................
      $this->data['meta_title'] = "Natioanl Headquater Award Recommendation Application";
      $html = $this->load->view('recommendation_details_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }


   public function recommendation_approve_list_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - recommendation_approve_list_pdf - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_award_approved_list_by_circular($dataID);

      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "Natioanl Headquater Award Approved List";
      $html = $this->load->view('recommendation_approve_list_pdf', $this->data, true);   
      $file_name = $dataID.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }


   public function recommendation_list($id){  
      // $limit = 2;   
      // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
      //    redirect('dashboard');
      // }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - recommendation_list - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         //Superadmin
         // Results
         $results = $this->Award_model->get_recommended_list_by_office($dataID, '', '', '', '');
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
         // Results
         $results = $this->Award_model->get_recommended_list_by_office($dataID, $region, '', '', '');
         $this->data['scouts_district'] = $this->Common_model->get_scout_districts($region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;

         // Results
         $results = $this->Award_model->get_recommended_list_by_office($dataID, '', $district, '', '');

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;

         // Results
         $results = $this->Award_model->get_recommended_list_by_office($dataID, '', '', $upazila, '');

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $office     = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);
         // print_r($office);
         $region     = $office->grp_region_id;
         $district   = $office->grp_scout_dis_id;
         $upazila    = $office->grp_scout_upa_id;
         $group      = $office->id;

         // Results
         $results = $this->Award_model->get_recommended_list_by_office($dataID, '', '', '', $group);

      }else{
         redirect('dashboard');
      }


      //Result
      $this->data['info'] = $results['info'];
      $this->data['results'] = $results['rows'];
      // $this->data['total_rows'] = $results['num_rows'];

      //pagination
      //$this->data['pagination'] = create_pagination('award/recommendation_list/'.encrypt_url($dataID), $this->data['total_rows'], $limit, 4, $full_tag_wrap = true);

      // Download URL
      $this->data['download_url'] = base_url('award/recommendation_list_pdf/'.encrypt_url($dataID))."?region=".$this->input->get('region')."&district=".$this->input->get('district');
      // Download Approve List
      $this->data['download_approve_url'] = base_url('award/recommendation_approve_list_pdf/'.encrypt_url($dataID));

      // Dropdown
      $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['regions'] = $this->Common_model->get_regions(); 


      // Load view
      $this->data['meta_title'] = 'Recommendation List';
      $this->data['subview'] = 'recommendation_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function recommendation_list_pdf($id){

      /*if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }*/

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $dataID)) { 
         show_404('award - recommendation_list - exitsts', TRUE);
      }

      // $limit = 25;

      //Results
       $results = $this->Award_model->get_recommended_list_by_office($dataID, '', '', '', '');
      // $results = $this->Award_model->get_archive_award($limit, $offset);

      //Result
      $this->data['results'] = $results['rows'];
      // $this->data['total_rows'] = $results['num_rows'];

      // PDF Generate
      $this->data['meta_title'] = 'Recommendation List PDF';
      // $html = $this->load->view('archive_list_pdf', $this->data, true);   
      $html = $this->load->view('recommendation_list_pdf', $this->data, true);   
      $file_name ="recommendation_list_pdf_".date('Y-m-d').".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      // $mpdf->Output($file_name, "D");
      $mpdf->Output($file_name, "I");

      // // Pagination
      // $this->data['pagination'] = create_pagination('award/archive_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // // Download URL
      // $this->data['download_url'] = base_url('award/archive_list_pdf')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&group=".$this->input->get('group')."&gender=".$this->input->get('gender')."&year=".$this->input->get('year');

      // // Dropdown
      // $this->data['regions'] = $this->Common_model->get_regions(); 
      // $this->data['years'] = $this->Common_model->get_archive_award_years(); 

      // // Load view
      // $this->data['meta_title'] = 'Award Archive List';
      // $this->data['subview'] = 'archive_list';
      // $this->load->view('backend/_layout_main', $this->data);
   }

   public function recommendation_status($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award') || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - recommendation_status - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_recommendation_status($dataID);
      // print_r($this->data['info']); exit;

      $this->form_validation->set_rules('status', 'select status', 'required|trim');

      if ($this->form_validation->run() == true){
         // Check authentication
         if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
            $form_data = array(            
               'verify_nhq'      => $this->input->post('status')
               /*'citation_nhq'    => $this->input->post('citation'),            
               'event_id_nhq'    => $this->input->post('event_id'),
               'date_from_nhq'   => date_db_format($this->input->post('date_from')),
               'date_to_nhq'     => date_db_format($this->input->post('date_to')),
               'activity_nhq'    => $this->input->post('activity_details')*/
               );  

         }elseif($this->ion_auth->is_region_admin()){
            $form_data = array(            
               'verify_region'      => $this->input->post('status')
               /*'citation_region'    => $this->input->post('citation'),            
               'event_id_region'    => $this->input->post('event_id'),
               'date_from_region'   => date_db_format($this->input->post('date_from')),
               'date_to_region'     => date_db_format($this->input->post('date_to')),
               'activity_region'    => $this->input->post('activity_details')*/
               );

         }elseif($this->ion_auth->is_district_admin()){    
            $form_data = array(            
               'verify_district'      => $this->input->post('status')
               /*'citation_district'    => $this->input->post('citation'),            
               'event_id_district'    => $this->input->post('event_id'),
               'date_from_district'   => date_db_format($this->input->post('date_from')),
               'date_to_district'     => date_db_format($this->input->post('date_to')),
               'activity_district'    => $this->input->post('activity_details')*/
               );

         }elseif($this->ion_auth->is_upazila_admin()){
            $form_data = array('verify_upazila' => 'Approved');
            $form_data = array(            
               'verify_upazila'      => $this->input->post('status')
               /*'citation_upazila'    => $this->input->post('citation'),            
               'event_id_upazila'    => $this->input->post('event_id'),
               'date_from_upazila'   => date_db_format($this->input->post('date_from')),
               'date_to_upazila'     => date_db_format($this->input->post('date_to')),
               'activity_upazila'    => $this->input->post('activity_details')*/
               );
         }

         // print_r($form_data); exit;

         // Update status
         if($this->Common_model->edit('award_recommendation', $dataID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Evaluation status update successfully.'); 
            // Redirect
            // redirect('award/recommendation_status/'.encrypt_url($dataID));
            redirect('award/recommendation_list/'.encrypt_url($this->data['info']->circular_id));
            
         }else{
            $this->session->set_flashdata('warning', 'Something is wrong.');
         }
      }

      $this->data['status_dd'] = array('' => '--Select One--', 'Approved' => 'Approved', 'Reject' => 'Reject');
      // $this->data['event_category'] = $this->Common_model->get_event_category();

      // Load view
      $this->data['meta_title'] = 'Recommendation Status';
      $this->data['subview'] = 'recommendation_status';
      $this->load->view('backend/_layout_main', $this->data);
   }

   // public function approve_status($id){           
   //    $dataID = (int) decrypt_url($id); //exit;
   //    if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
   //       show_404('award - approve_status - exitsts', TRUE);
   //    }

   //    //Check authentication
   //    if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
   //       $form_data = array('verify_nhq' => 'Approved');

   //    }elseif($this->ion_auth->is_region_admin()){
   //       $form_data = array('verify_region' => 'Approved');

   //    }elseif($this->ion_auth->is_district_admin()){    
   //       $form_data = array('verify_district' => 'Approved');

   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       $form_data = array('verify_upazila' => 'Approved');

   //    }else{
   //       redirect('dashboard');
   //    }

   //    // Update status
   //    if($this->Common_model->edit('award_recommendation', $dataID, 'id', $form_data)){
   //       $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
   //    }else{
   //       $this->session->set_flashdata('warning', 'Something is wrong.');
   //    }

   //    // Redirect
   //    redirect('award/recommendation_status/'.encrypt_url($dataID));
   // }

   public function reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - reject_status - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         $form_data = array('verify_nhq' => 'Reject');

      }elseif($this->ion_auth->is_region_admin()){
         $form_data = array('verify_region' => 'Reject');

      }elseif($this->ion_auth->is_district_admin()){    
         $form_data = array('verify_district' => 'Reject');

      }elseif($this->ion_auth->is_upazila_admin()){
         $form_data = array('verify_upazila' => 'Reject');

      }else{
         redirect('dashboard');
      }

      // Update status
      if($this->Common_model->edit('award_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation reject successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/recommendation_status/'.encrypt_url($dataID));
   }


   public function recommendation_circular_list($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award')){ 
         // Superadmin
         //Result
         // $results = $this->Committee_model->get_scout_group_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       
         $results = $this->Award_model->get_sc_gourp_recommended_circular_list($limit, $offset, '', '', '', '');

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Award_model->get_sc_gourp_recommended_circular_list($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Award_model->get_sc_gourp_recommended_circular_list($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results         
         $results = $this->Award_model->get_sc_gourp_recommended_circular_list($limit, $offset, '', '', $upazilaInfo->id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Award_model->get_sc_gourp_recommended_circular_list($limit, $offset, '', '', '', $groupInfo->id);

      }else{
         redirect('dashboard');
      }

      //Results
      // $results = $this->Award_model->get_award_circular($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = count($results['rows']);

      //pagination
      $this->data['pagination'] = create_pagination('award/recommendation_circular_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'Recommendation Circular List';
      $this->data['subview'] = 'recommendation_circular_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin() || !$this->ion_auth->in_group('award')){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - recommendation_delete - exitsts', TRUE);
      }

      // Delete data
      if($this->Award_model->recommendation_destroy($dataID)){
         $this->session->set_flashdata('success', 'Recommendation data delete successfully.');
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/recommendation_list/'.$circularID);
   }




   /***************************** Circular ********************************/
   /***********************************************************************/

   public function circular_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_award_circular($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('award/circular_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'All Award Circular';
      $this->data['subview'] = 'circular_list';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function circular_create(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('circular_title', 'circular title','required|trim|max_length[255]');
      $this->form_validation->set_rules('award_type_id', 'award type', 'required|trim');
      // $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'circular_title'     => $this->input->post('circular_title'),
            'award_type_id'      => $this->input->post('award_type_id'),
            'group_end_date'     => date_db_format($this->input->post('group_end_date')),
            'upazila_end_date'   => date_db_format($this->input->post('upazila_end_date')),
            'district_end_date'  => date_db_format($this->input->post('district_end_date')),
            'region_end_date'    => date_db_format($this->input->post('region_end_date')),
            );

         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
            $config['upload_path']  = $this->file_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 60000;

            $this->load->library('upload', $config);
                //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $uploadedFile = $uploadData['file_name'];

               $source_path = $this->file_path.'/'.$uploadedFile; 

              // $uploadedFile = $uploadData['file_name'];
              // print_r($uploadedFile);
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         if($_FILES['userfile']['size'] > 0){
            $form_data['attachment_file'] = $uploadedFile; 
         }

         // print_r($form_data); exit;
         if($this->Common_model->save('award_circular', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create award circular :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Award circular data update successfully.');
            redirect("award/circular_list");
         }
      }

      //Dropdown
      $this->data['award_type'] = $this->Common_model->get_award_type(); 

      //Load view
      $this->data['meta_title'] = 'Create Award Circular';
      $this->data['subview'] = 'circular_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function circular_update($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){      
         redirect('dashboard');
      }

      $circularID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_circular', 'id', $circularID)) { 
         show_404('award - circular_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('circular_title', 'circular title','required|trim|max_length[255]');
      // $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      // $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'circular_title'     => $this->input->post('circular_title'),
            'award_type_id'      => $this->input->post('award_type_id'),
            'group_end_date'     => date_db_format($this->input->post('group_end_date')),
            'upazila_end_date'   => date_db_format($this->input->post('upazila_end_date')),
            'district_end_date'  => date_db_format($this->input->post('district_end_date')),
            'region_end_date'    => date_db_format($this->input->post('region_end_date')),
            'status'             => $this->input->post('status')
            );

         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            $new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'gif|jpg|png|doc|docx|xls|xlsx|pdf';
            $config['upload_path']  = $this->file_path;
            $config['file_name']    = $new_file_name;
            $config['max_size']     = 60000;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $uploadedFile = $uploadData['file_name'];

               $source_path = $this->file_path.'/'.$uploadedFile; 

              // $uploadedFile = $uploadData['file_name'];
              // print_r($uploadedFile);
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         if($_FILES['userfile']['size'] > 0){
            $form_data['attachment_file'] = $uploadedFile; 
         }

         // print_r($form_data); exit;
         if($this->Common_model->edit('award_circular',  $circularID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update award circular :'.$circularID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Update award circular successfully.');
            redirect("award/circular_list");            
         }
      }

      //Dropdown
      $this->data['award_type'] = $this->Common_model->get_award_type(); 
      //Results
      $this->data['info'] = $this->Award_model->get_award_circular_info($circularID); 
      
      //Load view
      $this->data['meta_title'] = 'Update Award Circular';
      $this->data['subview'] = 'circular_update';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /************************** Award Archive ***********************/
   /****************************************************************/   

   public function archive_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_archive_award($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      // Pagination
      $this->data['pagination'] = create_pagination('award/archive_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Download URL
      $this->data['download_url'] = base_url('award/archive_list_pdf')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&group=".$this->input->get('group')."&gender=".$this->input->get('gender')."&year=".$this->input->get('year');

      // Dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      $this->data['years'] = $this->Common_model->get_archive_award_years(); 

      // Load view
      $this->data['meta_title'] = 'Award Archive List';
      $this->data['subview'] = 'archive_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function archive_list_pdf($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Award_model->get_archive_award($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      // $this->data['total_rows'] = $results['num_rows'];

      // PDF Generate
      $this->data['meta_title'] = 'Award Archive List';
      $html = $this->load->view('archive_list_pdf', $this->data, true);   
      $file_name ="archive_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");

      // // Pagination
      // $this->data['pagination'] = create_pagination('award/archive_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // // Download URL
      // $this->data['download_url'] = base_url('award/archive_list_pdf')."?region=".$this->input->get('region')."&district=".$this->input->get('district')."&upazila=".$this->input->get('upazila')."&group=".$this->input->get('group')."&gender=".$this->input->get('gender')."&year=".$this->input->get('year');

      // // Dropdown
      // $this->data['regions'] = $this->Common_model->get_regions(); 
      // $this->data['years'] = $this->Common_model->get_archive_award_years(); 

      // // Load view
      // $this->data['meta_title'] = 'Award Archive List';
      // $this->data['subview'] = 'archive_list';
      // $this->load->view('backend/_layout_main', $this->data);
   }

   public function archive_certificate_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('archive_award', 'id', $dataID)) { 
         show_404('award - archive_certificate_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Award_model->get_archive_certificate($dataID);
      // print_r($this->data['info']->award_id); exit;   

      $this->data['meta_title'] = "Award Certificate";
      //...............................................................................
      if($this->data['info']->award_id == 1){
         $html = $this->load->view('certificate/shapla_cub_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(1000, 761), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 2){
         $html = $this->load->view('certificate/president_scouts_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(870, 690), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 4){
         $html = $this->load->view('certificate/president_rover_scouts_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(870, 690), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 3 || $this->data['info']->award_id == 5){
         $html = $this->load->view('certificate/community_development_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(1010, 758), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 8){
         $html = $this->load->view('certificate/savapati_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(1000, 784), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 9){
         $html = $this->load->view('certificate/cnc_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(1000, 775), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 10){
         $html = $this->load->view('certificate/long_service_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 1065), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 11){
         $html = $this->load->view('certificate/long_service_decoration_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 1065), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 12){
         $html = $this->load->view('certificate/bar_to_the_medal_of_merit_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 1065), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 13){
         $html = $this->load->view('certificate/medal_of_merit_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 1065), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 14){
         $html = $this->load->view('certificate/national_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 1065), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 15){
         $html = $this->load->view('certificate/gallantry_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(820, 1060), 10, 'nikosh', 0, 0, 0, 0);

      }elseif($this->data['info']->award_id == 17){
         $html = $this->load->view('certificate/national_service_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(810, 997), 10, 'nikosh', 0, 0, 0, 0);

      }else{
         $html = $this->load->view('archive_certificate_pdf', $this->data, true);   
         $file_name = $dataID.".pdf";
         $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);
      }  
      
      // $html = $this->load->view('archive_certificate_pdf', $this->data, true);   
      // $file_name = $dataID.".pdf";
      // //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      // // $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
      // $mpdf = new mPDF('', array(864, 668), 10, 'nikosh', 0, 0, 0, 0);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function archive_add(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->in_group('award'))){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('member_type_id', 'name english', 'required|trim');
      $this->form_validation->set_rules('award_id', 'award name', 'required|trim');
      $this->form_validation->set_rules('archive_year', 'archive year', 'required|trim');
      $this->form_validation->set_rules('region_id', 'region', 'required|trim');
      $this->form_validation->set_rules('district_id', 'district', 'required|trim');
      $this->form_validation->set_rules('upazila_id', 'upazila', 'trim');
      $this->form_validation->set_rules('name_en[]', 'name english', 'required|trim');
      $this->form_validation->set_rules('issue_date[]', 'issue date', 'required|trim');
      $this->form_validation->set_rules('certificate_no[]', 'certificate no', 'required|trim');

      if($this->input->post('exists_group') == 1){
         $this->form_validation->set_rules('group_id', 'group name', 'required|trim');
      }else{
         $this->form_validation->set_rules('group_name_no_exists', 'group name not in list', 'required|trim');
      }

      // Insert Data
      if ($this->form_validation->run() == true){

         $member_type   = $this->input->post('member_type_id');
         $award         = $this->input->post('award_id');
         $year          = $this->input->post('archive_year');
         $region        = $this->input->post('region_id');
         $district      = $this->input->post('district_id');
         $upazila       = $this->input->post('upazila_id');
         $group         = $this->input->post('group_id');
         $group_name_no_exists = $this->input->post('group_name_no_exists');

         // Insert data
         for ($i=0; $i<sizeof($_POST['name_en']); $i++) { 
            $form_data = array(
               'member_type_id'  => $member_type,
               'award_id'        => $award,
               'archive_year'    => $year,
               'region_id'       => $region,
               'district_id'     => $district,
               'upazila_id'      => $upazila,
               'group_id'        => $group,
               'group_name_no_exists' => $group_name_no_exists,
               'name_en'         => $_POST['name_en'][$i],
               'name_bn'         => $_POST['name_bn'][$i],
               'father_name'     => $_POST['father_name'][$i],
               'mother_name'     => $_POST['mother_name'][$i],
               'gender'          => $_POST['gender'][$i],
               'scout_id'        => $_POST['scout_id'][$i],
               'issue_date'      => date_db_format($_POST['issue_date'][$i]),
               'certificate_no'  => $_POST['certificate_no'][$i]
               );
            // print_r($form_data); exit;               
            $this->Common_model->save('archive_award', $form_data);
         }           

         // Success Message
         $this->session->set_flashdata('success', 'Award archive data insert successfully.');
         redirect("award/archive_list");
      }

      // dropdown list
      $this->data['member_type'] = $this->Common_model->set_archive_member_type(); 
      $this->data['gender'] = $this->Common_model->set_gender(); 
      $this->data['years'] = $this->Common_model->get_archive_award_years(); 
      $this->data['regions'] = $this->Common_model->get_regions(); 

      // Load page
      $this->data['meta_title'] = 'Archive Award Add';
      $this->data['subview'] = 'archive_add';
      $this->load->view('backend/_layout_main', $this->data);
   }


   // Get member details using ajax
   public function ajax_get_scouts_member_info($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Award_model->get_scouts_member_info($id)));
      // print_r($info);
   }

   public function ajax_get_executive_designation_by_office($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Common_model->get_comm_designation_by_office($id)));
   }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 1050000; 
      $size_kb = '1 MB';

      if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!=""){
         if(!in_array($mime, $allowed_mime_type_arr)){                
            $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif file.');
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

}