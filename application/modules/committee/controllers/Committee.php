<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Committee extends Backend_Controller {
   var $userID;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Committee';
      $this->load->model('Committee_model');
      $this->userSessID = $this->session->userdata('user_id');
   }

   public function index(){
      redirect('dashboard');
   }

   /********************* Scouts Group Committee *******************
   /****************************************************************/

   public function scout_group($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', '', $upazilaInfo->id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', '', '', $groupInfo->id);
      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('committee/scout_group/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load page
      $this->data['meta_title'] = 'All Scouts Group Committee';
      $this->data['subview'] = 'scout_group';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************scout_group_pdf function pdf start**************/
   public function scout_group_pdf($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', '', $upazilaInfo->id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_scout_group_committee($limit, $offset, '', '', '', $groupInfo->id);
      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      
      //...............................................................................
      $this->data['meta_title'] = "All Scouts Group Committee";
      $html = $this->load->view('scout_group_pdf', $this->data, true);   
      $file_name ="scout_group_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************scout_group_pdf function pdf End**************/
   
   public function scout_group_details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_group', 'id', $committeeID)) { 
         show_404('committee - scout_group_details - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_scout_group_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = 'Scouts Group Committee Details';
      $this->data['subview'] = 'scout_group_details';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function scout_group_create(){     

      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }
      // Group Admin      
      $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID); 

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'region_id' => $groupInfo->grp_region_id,
            'district_id' => $groupInfo->grp_scout_dis_id,
            'upazila_id' => $groupInfo->grp_scout_upa_id,
            'group_id' => $groupInfo->id,
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            );
         
         // print_r($form_data); exit;
         if($this->Common_model->save('committee_group', $form_data)){
         /***********Activity Logs Start**********/
         $insert_id = $this->db->insert_id();
         func_activity_log(1, 'Create scouts group committee ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Create scouts group committee successfully.');
            redirect("committee/scout_group");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('5'); 

      //Load view
      $this->data['meta_title'] = 'Create Scouts Group Committee';
      $this->data['subview'] = 'scout_group_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_group_update($id){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_group', 'id', $committeeID)) { 
         show_404('committee - scout_group_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            'is_current'   => $this->input->post('status')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('committee_group',  $committeeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update scouts group committee ID :'.$committeeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Update scouts group committee successfully.');
            redirect("committee/scout_group");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('5'); 
      //Results
      $this->data['info'] = $this->Common_model->get_single_data('committee_group', $committeeID); 
      
      //Load page
      $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
      $this->data['subview'] = 'scout_group_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_scout_group_committee($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_group', 'id', $committeeID)) { 
         show_404('committee - pdf_scout_group_committee - exitsts', TRUE);
      }

      $results = $this->Committee_model->get_scout_group_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];
      // print_r($this->data['results']); exit;

      $this->data['committee'] = 'Scouts Group Committee <br>'.$results['info']->dis_name;
      $this->data['headding'] = $results['info']->committee_name;
      $html = $this->load->view('pdf_committee', $this->data, true);

      //PDF Generate
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 5, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }

   public function scout_group_manage_member($id){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_group', 'id', $committeeID)) { 
         show_404('committee - scout_group_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_scout_group_committee_info($committeeID); 
      $this->data['info'] = $results['info'];

      //Dropdown
      $this->data['designation_dd'] = $this->Common_model->get_comm_designation_by_office('5'); 

      // Load page
      $this->data['meta_title'] = 'Manage Committee Members';
      $this->data['subview'] = 'scout_group_manage_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function ajax_scout_group_member_list(){   
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      $form_data = array(
         'committee_id' => decrypt_url($this->input->get('commID')), 
         'member_comm_desig_id' => $this->input->get('commDesigID'),
         'member_scout_id' => $this->input->get('scoutID'),
         'sl_no' => $this->input->get('slNo'),
         'member_name' => $this->input->get('memberName'),
         'member_profession' => $this->input->get('memberProf'),
         'member_mobile' => $this->input->get('memberMobile'),
         'member_email' => $this->input->get('memberEmail'),
         'member_address' => $this->input->get('memberAdd')
         );
      // print_r($form_data); exit;
      $delete_id = $this->input->get('delete_id');

      if($delete_id > 0 ){
         if($this->Common_model->delete('committee_group_member', 'id', $delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';

      }elseif (($form_data['member_scout_id'] > 0 || $form_data['member_name'] != NULL) and $form_data['member_comm_desig_id'] > 0){

         if($form_data['member_scout_id'] > 0){
            $validate_insert = $this->Committee_model->get_scout_group_member_check_duplicate($form_data);
         }else{
            $validate_insert = FALSE;
         }

         if(empty($validate_insert)){
            if($this->Common_model->save('committee_group_member', $form_data)){
               echo 'inserted';
            }else{
               echo 'insert fail';
            }
         }else{
            echo 'duplicate';
         }
      }

      $alldt = $this->Committee_model->get_scout_group_committee_member($form_data);
      echo '23432sdfg324';
      echo '<table class="tg2">
      <tr>
         <th class="tg-71hr">SL</th>
         <th class="tg-71hr">Scout ID</th>
         <th class="tg-71hr">Name</th>
         <th class="tg-71hr">Commt. Designation</th>
         <th class="tg-71hr">Professional Designation</th>
         <th class="tg-71hr">Office Address </th>
         <th class="tg-71hr">Mobile No </th>
         <th class="tg-71hr">Email </th>
         <th class="tg-71hr" width="50">Action</th>
      </tr>';
      for($i=0; $i<sizeof($alldt); $i++){
         $name = $alldt[$i]->scout_id != NULL ? $alldt[$i]->first_name:$alldt[$i]->member_name;
         $mobile = $alldt[$i]->scout_id != NULL ? $alldt[$i]->phone:$alldt[$i]->member_mobile;
         $email = $alldt[$i]->scout_id != NULL ? $alldt[$i]->email:$alldt[$i]->member_email;
         echo '
         <tr>
            <td class="tg-031e" align="center">'.$alldt[$i]->sl_no.'.</td>
            <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
            <td class="tg-031e">'.$name.'</td>
            <td class="tg-031e">'.$alldt[$i]->committee_designation_name.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_profession.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_address.'</td>
            <td class="tg-031e">'.$mobile.'</td>
            <td class="tg-031e">'.$email.'</td>
            <td class="tg-031e">
               <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_committee_member('.$alldt[$i]->id.');">Delete</button>
            </td>
         </tr>';
      }
      echo '</table>';
      exit;
   }

   public function scout_group_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_group', 'id', $committeeID)) { 
         show_404('committee - scout_group_delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Committee_model->scout_group_destroy($committeeID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Committee delete successfully.');
         redirect("committee/scout_group");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("committee/scout_group");   
      }
   }


   /************************ Upazila Committee *********************
   /****************************************************************/

   public function upazila($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_upazila_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_upazila_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_upazila_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_upazila_committee($limit, $offset, '', $upazilaInfo->upa_scout_dis_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_upazila_committee($limit, $offset, '', $groupInfo->grp_scout_dis_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('committee/upazila/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load page
      $this->data['meta_title'] = 'All Scouts Upazila Committee';
      $this->data['subview'] = 'upazila';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************upazila_pdf function pdf start**************/
   public function upazila_pdf($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_district_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $upazilaInfo->upa_scout_dis_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $groupInfo->grp_scout_dis_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      
      //...............................................................................
      $this->data['meta_title'] = "All Scouts Upazila Committee";
      $html = $this->load->view('upazila_pdf', $this->data, true);   
      $file_name ="upazila_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************upazila_pdf function pdf End**************/

   public function upazila_details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_upazila', 'id', $committeeID)) { 
         show_404('committee - upazila_details - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_upazila_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = 'Scouts Upazila Committee Details';
      $this->data['subview'] = 'upazila_details';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function upazila_create(){      
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }
      // Upazila Admin      
      $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'region_id' => $upazilaInfo->upa_scout_dis_id,
            'district_id' => $upazilaInfo->upa_scout_dis_id,
            'upazila_id' => $upazilaInfo->id,
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            );
         
         // print_r($form_data); exit;
         if($this->Common_model->save('committee_upazila', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create upazila committee ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Create upazila committee successfully.');
            redirect("committee/upazila");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('4'); 

      //Load view
      $this->data['meta_title'] = 'Create Scouts Upazila Committee';
      $this->data['subview'] = 'upazila_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_update($id){
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_upazila', 'id', $committeeID)) { 
         show_404('committee - upazila_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            'is_current'   => $this->input->post('status')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('committee_upazila',  $committeeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update upazila committee ID :'.$committeeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Update upazila committee successfully.');
            redirect("committee/upazila");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('4'); 
      //Results
      $this->data['info'] = $this->Common_model->get_single_data('committee_upazila', $committeeID); 
      
      //Load page
      $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
      $this->data['subview'] = 'upazila_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_upazila_committee($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_upazila', 'id', $committeeID)) { 
         show_404('committee - pdf_upazila_committee - exitsts', TRUE);
      }

      $results = $this->Committee_model->get_upazila_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];
      // print_r($this->data['results']); exit;

      $this->data['committee'] = 'Scouts Upazila Committee, '.$results['info']->dis_name;
      $this->data['headding'] = $results['info']->committee_name;
      $html = $this->load->view('pdf_committee', $this->data, true);

      //PDF Generate
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }

   public function upazila_manage_member($id){
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_upazila', 'id', $committeeID)) { 
         show_404('committee - upazila_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_upazila_committee_info($committeeID); 
      $this->data['info'] = $results['info'];

      //Dropdown
      $this->data['designation_dd'] = $this->Common_model->get_comm_designation_by_office('4'); 

      // Load page
      $this->data['meta_title'] = 'Manage Committee Members';
      $this->data['subview'] = 'upazila_manage_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function ajax_upazila_member_list(){   
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }

      $form_data = array(
         'committee_id' => decrypt_url($this->input->get('commID')), 
         'member_comm_desig_id' => $this->input->get('commDesigID'),
         'member_scout_id' => $this->input->get('scoutID'),
         'sl_no' => $this->input->get('slNo'),
         'member_name' => $this->input->get('memberName'),
         'member_profession' => $this->input->get('memberProf'),
         'member_mobile' => $this->input->get('memberMobile'),
         'member_email' => $this->input->get('memberEmail'),
         'member_address' => $this->input->get('memberAdd')
         );
      // print_r($form_data); exit;
      $delete_id = $this->input->get('delete_id');

      if($delete_id > 0 ){
         if($this->Common_model->delete('committee_upazila_member', 'id', $delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';

      }elseif (($form_data['member_scout_id'] > 0 || $form_data['member_name'] != NULL) and $form_data['member_comm_desig_id'] > 0){

         if($form_data['member_scout_id'] > 0){
            $validate_insert = $this->Committee_model->get_upazila_member_check_duplicate($form_data);
         }else{
            $validate_insert = FALSE;
         }

         if(empty($validate_insert)){
            if($this->Common_model->save('committee_upazila_member', $form_data)){
               echo 'inserted';
            }else{
               echo 'insert fail';
            }
         }else{
            echo 'duplicate';
         }
      }

      $alldt = $this->Committee_model->get_upazila_committee_member($form_data);
      echo '23432sdfg324';
      echo '<table class="tg2">
      <tr>
         <th class="tg-71hr">SL</th>
         <th class="tg-71hr">Scout ID</th>
         <th class="tg-71hr">Name</th>
         <th class="tg-71hr">Commt. Designation</th>
         <th class="tg-71hr">Professional Designation</th>
         <th class="tg-71hr">Office Address </th>
         <th class="tg-71hr">Mobile No </th>
         <th class="tg-71hr">Email </th>
         <th class="tg-71hr" width="50">Action</th>
      </tr>';
      for($i=0; $i<sizeof($alldt); $i++){
         $name = $alldt[$i]->scout_id != NULL ? $alldt[$i]->first_name:$alldt[$i]->member_name;
         $mobile = $alldt[$i]->scout_id != NULL ? $alldt[$i]->phone:$alldt[$i]->member_mobile;
         $email = $alldt[$i]->scout_id != NULL ? $alldt[$i]->email:$alldt[$i]->member_email;
         echo '
         <tr>
            <td class="tg-031e" align="center">'.$alldt[$i]->sl_no.'.</td>
            <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
            <td class="tg-031e">'.$name.'</td>
            <td class="tg-031e">'.$alldt[$i]->committee_designation_name.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_profession.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_address.'</td>
            <td class="tg-031e">'.$mobile.'</td>
            <td class="tg-031e">'.$email.'</td>
            <td class="tg-031e">
               <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_committee_member('.$alldt[$i]->id.');">Delete</button>
            </td>
         </tr>';
      }
      echo '</table>';
      exit;
   }

   public function upazila_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_upazila_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_upazila', 'id', $committeeID)) { 
         show_404('committee - upazila_delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Committee_model->district_destroy($committeeID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Committee delete successfully.');
         redirect("committee/upazila");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("committee/upazila");   
      }
   }


   /*********************** District Committee *********************
   /****************************************************************/

   public function district($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_district_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $upazilaInfo->upa_scout_dis_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $groupInfo->grp_scout_dis_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('committee/district/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'All Scouts District Committee';
      $this->data['subview'] = 'district';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************district_pdf function pdf start**************/
   public function district_pdf($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_district_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $upazilaInfo->upa_scout_dis_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_district_committee($limit, $offset, '', $groupInfo->grp_scout_dis_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      
      //...............................................................................
      $this->data['meta_title'] = "All Scouts District Committee";
      $html = $this->load->view('district_pdf', $this->data, true);   
      $file_name ="district_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************district_pdf function pdf End**************/

   public function district_details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_district', 'id', $committeeID)) { 
         show_404('committee - district_details - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_district_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = 'Scouts District Committee Details';
      $this->data['subview'] = 'district_details';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function district_create(){      
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }
      // District Admin
      $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'region_id' => $districtInfo->dis_scout_region_id,
            'district_id' => $districtInfo->id,
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            );
         
         // print_r($form_data); exit;
         if($this->Common_model->save('committee_district', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create district committee ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Create district committee successfully.');
            redirect("committee/district");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('3'); 

      //Load view
      $this->data['meta_title'] = 'Create Scouts District Committee';
      $this->data['subview'] = 'district_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_update($id){
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_district', 'id', $committeeID)) { 
         show_404('committee - district_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            'is_current'   => $this->input->post('status')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('committee_district',  $committeeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update district committee :'.$committeeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Update district committee successfully.');
            redirect("committee/district");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('3'); 
      //Results
      $this->data['info'] = $this->Common_model->get_single_data('committee_district', $committeeID); 
      
      //Load page
      $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
      $this->data['subview'] = 'district_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_district_committee($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_district', 'id', $committeeID)) { 
         show_404('committee - pdf_district_committee - exitsts', TRUE);
      }

      $results = $this->Committee_model->get_district_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];
      // print_r($this->data['results']); exit;

      $this->data['committee'] = 'Scouts District Committee, '.$results['info']->dis_name;
      $this->data['headding'] = $results['info']->committee_name;
      $html = $this->load->view('pdf_committee', $this->data, true);

      //PDF Generate
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }

   public function district_manage_member($id){
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_district', 'id', $committeeID)) { 
         show_404('committee - district_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_district_committee_info($committeeID); 
      $this->data['info'] = $results['info'];

      //Dropdown
      $this->data['designation_dd'] = $this->Common_model->get_comm_designation_by_office('3'); 

      // Load page
      $this->data['meta_title'] = 'Manage Committee Members';
      $this->data['subview'] = 'district_manage_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function ajax_district_member_list(){   
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }

      $form_data = array(
         'committee_id' => decrypt_url($this->input->get('commID')), 
         'member_comm_desig_id' => $this->input->get('commDesigID'),
         'member_scout_id' => $this->input->get('scoutID'),
         'sl_no' => $this->input->get('slNo'),
         'member_name' => $this->input->get('memberName'),
         'member_profession' => $this->input->get('memberProf'),
         'member_mobile' => $this->input->get('memberMobile'),
         'member_email' => $this->input->get('memberEmail'),
         'member_address' => $this->input->get('memberAdd')
         );
      // print_r($form_data); exit;
      $delete_id = $this->input->get('delete_id');

      if($delete_id > 0 ){
         if($this->Common_model->delete('committee_district_member', 'id', $delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';

      }elseif (($form_data['member_scout_id'] > 0 || $form_data['member_name'] != NULL) and $form_data['member_comm_desig_id'] > 0){

         if($form_data['member_scout_id'] > 0){
            $validate_insert = $this->Committee_model->get_district_member_check_duplicate($form_data);
         }else{
            $validate_insert = FALSE;
         }

         if(empty($validate_insert)){
            if($this->Common_model->save('committee_district_member', $form_data)){
               echo 'inserted';
            }else{
               echo 'insert fail';
            }
         }else{
            echo 'duplicate';
         }
      }

      $alldt = $this->Committee_model->get_district_committee_member($form_data);
      echo '23432sdfg324';
      echo '<table class="tg2">
      <tr>
         <th class="tg-71hr">SL</th>
         <th class="tg-71hr">Scout ID</th>
         <th class="tg-71hr">Name</th>
         <th class="tg-71hr">Commt. Designation</th>
         <th class="tg-71hr">Professional Designation</th>
         <th class="tg-71hr">Office Address </th>
         <th class="tg-71hr">Mobile No </th>
         <th class="tg-71hr">Email </th>
         <th class="tg-71hr" width="50">Action</th>
      </tr>';
      for($i=0; $i<sizeof($alldt); $i++){
         $name = $alldt[$i]->scout_id != NULL ? $alldt[$i]->first_name:$alldt[$i]->member_name;
         $mobile = $alldt[$i]->scout_id != NULL ? $alldt[$i]->phone:$alldt[$i]->member_mobile;
         $email = $alldt[$i]->scout_id != NULL ? $alldt[$i]->email:$alldt[$i]->member_email;
         echo '
         <tr>
            <td class="tg-031e" align="center">'.$alldt[$i]->sl_no.'.</td>
            <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
            <td class="tg-031e">'.$name.'</td>
            <td class="tg-031e">'.$alldt[$i]->committee_designation_name.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_profession.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_address.'</td>
            <td class="tg-031e">'.$mobile.'</td>
            <td class="tg-031e">'.$email.'</td>
            <td class="tg-031e">
               <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_committee_member('.$alldt[$i]->id.');">Delete</button>
            </td>
         </tr>';
      }
      echo '</table>';
      exit;
   }

   public function district_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_district_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_district', 'id', $committeeID)) { 
         show_404('committee - district_delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Committee_model->district_destroy($committeeID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Committee delete successfully.');
         redirect("committee/district");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("committee/district");   
      }
   }


   /************************* Region Committee *********************
   /****************************************************************/

   public function region($offset=0){
      $limit = 100;
      // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
      //    redirect('dashboard');
      // } 

      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_region_committee($limit, $offset);
         //Dropdown
         // $this->data['regions'] = $this->Common_model->get_regions();       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  
         // $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id);   

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $districtInfo->dis_scout_region_id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $upazilaInfo->upa_region_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $groupInfo->grp_region_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('committee/region/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'All Scouts Region Committee';
      $this->data['subview'] = 'region';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************region_pdf function pdf start**************/
   public function region_pdf($offset=0){
      $limit = 100;
      // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
      //    redirect('dashboard');
      // } 

      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Committee_model->get_region_committee($limit, $offset);
         //Dropdown

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $regionInfo->id);  
         //Dropdown  

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $districtInfo->dis_scout_region_id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $upazilaInfo->upa_region_id);

      }elseif($this->ion_auth->is_group_admin()){
         // Group Admin
         $groupInfo = $this->Offices_model->get_scout_group_by_user_id($this->userSessID);         
         // Results
         $results = $this->Committee_model->get_region_committee($limit, $offset, $groupInfo->grp_region_id);

      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];
      
      //...............................................................................
      $this->data['meta_title'] = "All Scouts Region Committee";
      $html = $this->load->view('region_pdf', $this->data, true);   
      $file_name ="region_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************region_pdf function pdf End**************/

   public function region_details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_region', 'id', $committeeID)) { 
         show_404('committee - region_details - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_region_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = 'Scouts Region Committee Details';
      $this->data['subview'] = 'region_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_manage_member($id){
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_region', 'id', $committeeID)) { 
         show_404('committee - region_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_region_committee_info($committeeID); 
      $this->data['info'] = $results['info'];

      //Dropdown
      $this->data['designation_dd'] = $this->Common_model->get_comm_designation_by_office('2'); 

      // Load page
      $this->data['meta_title'] = 'Manage Committee Members';
      $this->data['subview'] = 'region_manage_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_create(){
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }
      // Region Admin
      $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'region_id' => $regionInfo->id,
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            );
         
         // print_r($form_data); exit;
         if($this->Common_model->save('committee_region', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create region committee :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Create region committee successfully.');
            redirect("committee/region");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('2'); 

      //Load view
      $this->data['meta_title'] = 'Create Region Committee';
      $this->data['subview'] = 'region_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_update($id){
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_region', 'id', $committeeID)) { 
         show_404('committee - region_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('comm_type_id', 'committee type','required|trim');
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            'is_current'   => $this->input->post('status')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('committee_region',  $committeeID, 'id', $form_data)){
            $this->session->set_flashdata('success', 'Update national committee successfully.');
            redirect("committee/region");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('2'); 
      //Results
      $this->data['info'] = $this->Common_model->get_single_data('committee_region', $committeeID); 
      
      //Load view
      $this->data['meta_title'] = 'Update Region Committee';
      $this->data['subview'] = 'region_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_region_committee($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_region', 'id', $committeeID)) { 
         show_404('committee - pdf_region_committee - exitsts', TRUE);
      }

      $results = $this->Committee_model->get_region_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];
      // print_r($this->data['results']); exit;

      $this->data['committee'] = 'Scouts Region Committee, '. $results['info']->region_name;
      $this->data['headding'] = $results['info']->committee_name;
      $html = $this->load->view('pdf_committee', $this->data, true);

      //PDF Generate
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }

   public function ajax_region_member_list(){   
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $form_data = array(
         'committee_id' => decrypt_url($this->input->get('commID')), 
         'member_comm_desig_id' => $this->input->get('commDesigID'),
         'member_scout_id' => $this->input->get('scoutID'),
         'sl_no' => $this->input->get('slNo'),
         'member_name' => $this->input->get('memberName'),
         'member_profession' => $this->input->get('memberProf'),
         'member_mobile' => $this->input->get('memberMobile'),
         'member_email' => $this->input->get('memberEmail'),
         'member_address' => $this->input->get('memberAdd')
         );
      // print_r($form_data); exit;
      $delete_id = $this->input->get('delete_id');

      if($delete_id > 0 ){
         if($this->Common_model->delete('committee_region_member', 'id', $delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';

      }elseif (($form_data['member_scout_id'] > 0 || $form_data['member_name'] != NULL) and $form_data['member_comm_desig_id'] > 0){

         if($form_data['member_scout_id'] > 0){
            $validate_insert = $this->Committee_model->get_region_member_check_duplicate($form_data);
         }else{
            $validate_insert = FALSE;
         }

         if(empty($validate_insert)){
            if($this->Common_model->save('committee_region_member', $form_data)){
               echo 'inserted';
            }else{
               echo 'insert fail';
            }
         }else{
            echo 'duplicate';
         }
      }

      $alldt = $this->Committee_model->get_region_committee_member($form_data);
      echo '23432sdfg324';
      echo '<table class="tg2">
      <tr>
         <th class="tg-71hr">SL</th>
         <th class="tg-71hr">Scout ID</th>
         <th class="tg-71hr">Name</th>
         <th class="tg-71hr">Commt. Designation</th>
         <th class="tg-71hr">Professional Designation</th>
         <th class="tg-71hr">Office Address </th>
         <th class="tg-71hr">Mobile No </th>
         <th class="tg-71hr">Email </th>
         <th class="tg-71hr" width="50">Action</th>
      </tr>';
      for($i=0; $i<sizeof($alldt); $i++){
         $name = $alldt[$i]->scout_id != NULL ? $alldt[$i]->first_name:$alldt[$i]->member_name;
         $mobile = $alldt[$i]->scout_id != NULL ? $alldt[$i]->phone:$alldt[$i]->member_mobile;
         $email = $alldt[$i]->scout_id != NULL ? $alldt[$i]->email:$alldt[$i]->member_email;
         echo '
         <tr>
            <td class="tg-031e" align="center">'.$alldt[$i]->sl_no.'.</td>
            <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
            <td class="tg-031e">'.$name.'</td>
            <td class="tg-031e">'.$alldt[$i]->committee_designation_name.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_profession.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_address.'</td>
            <td class="tg-031e">'.$mobile.'</td>
            <td class="tg-031e">'.$email.'</td>
            <td class="tg-031e">
               <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_committee_member('.$alldt[$i]->id.');">Delete</button>
            </td>
         </tr>';
      }
      echo '</table>';
      exit;
   }

   public function region_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_region', 'id', $committeeID)) { 
         show_404('committee - region_delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Committee_model->region_destroy($committeeID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Committee delete :'.$committeeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Committee delete successfully.');
         redirect("committee/region");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("committee/region");   
      }
   }


   /************************ National Committee ********************
   /****************************************************************/

   public function national(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $this->Committee_model->get_national_committee(); 

      // Load view
      $this->data['meta_title'] = 'All National Committee';
      $this->data['subview'] = 'national';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************national_pdf function pdf start**************/
   public function national_pdf(){
      //Results
      $this->data['results'] = $this->Committee_model->get_national_committee();
      
      //...............................................................................
      $this->data['meta_title'] = "All National Committee";
      $html = $this->load->view('national_pdf', $this->data, true);   
      $file_name ="national_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************national_pdf function pdf End**************/

   public function national_details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - national_details - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_national_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = $this->data['info']->committee_name.' Details';
      $this->data['subview'] = 'national_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function national_create(){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            );
         
         // print_r($form_data); exit;
         if($this->Common_model->save('committee_national', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Create national committee :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Create national committee successfully.');
            redirect("committee/national");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 

      //Load view
      $this->data['meta_title'] = 'Create National Committee';
      $this->data['subview'] = 'national_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function national_update($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - national_update - exitsts', TRUE);
      }

      //Validation
      $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
      $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'comm_type_id' => $this->input->post('comm_type_id'),
            'committee_name' => $this->input->post('committee_name'),
            'session_start_date' => date_db_format($this->input->post('session_start_date')),
            'session_end_date' => date_db_format($this->input->post('session_end_date')),
            'is_current'   => $this->input->post('status')
            );

         // print_r($form_data); exit;
         if($this->Common_model->edit('committee_national',  $committeeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update national committee :'.$committeeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Update national committee successfully.');
            redirect("committee/national");
         }
      }

      //Dropdown
      $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 
      //Results
      $this->data['info'] = $this->Common_model->get_single_data('committee_national', $committeeID); 
      
      //Load view
      $this->data['meta_title'] = 'Update National Committee';
      $this->data['subview'] = 'national_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function national_manage_member($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - national_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Committee_model->get_national_committee_info($committeeID); 
      $this->data['info'] = $results['info'];

      //Dropdown
      $this->data['designation_dd'] = $this->Common_model->get_comm_designation_by_office('1'); 

      // Load page
      $this->data['meta_title'] = 'Manage Committee Members';
      $this->data['subview'] = 'national_manage_member';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_national_committee($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - pdf_national_committee - exitsts', TRUE);
      }

      $results = $this->Committee_model->get_national_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];
      // print_r($this->data['results']); exit;

      $this->data['committee'] = 'Scouts National Committee';
      $this->data['headding'] = $results['info']->committee_name;
      $html = $this->load->view('pdf_committee', $this->data, true);

      //PDF Generate
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 5);
      $mpdf->WriteHtml($html);
      $mpdf->output();
   }

   public function ajax_national_member_list(){   
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $form_data = array(
         'committee_id' => decrypt_url($this->input->get('commID')), 
         'member_comm_desig_id' => $this->input->get('commDesigID'),
         'member_scout_id' => $this->input->get('scoutID'),
         'sl_no' => $this->input->get('slNo'),
         'member_name' => $this->input->get('memberName'),
         'member_profession' => $this->input->get('memberProf'),
         'member_mobile' => $this->input->get('memberMobile'),
         'member_email' => $this->input->get('memberEmail'),
         'member_address' => $this->input->get('memberAdd')
         );
      // print_r($form_data); exit;
      $delete_id = $this->input->get('delete_id');

      if($delete_id > 0 ){
         if($this->Common_model->delete('committee_national_member', 'id', $delete_id))
            echo 'Delete Success';
         else
            echo 'Delete Failed';

      }elseif (($form_data['member_scout_id'] > 0 || $form_data['member_name'] != NULL) and $form_data['member_comm_desig_id'] > 0){

         if($form_data['member_scout_id'] > 0){
            $validate_insert = $this->Committee_model->get_member_check_duplicate($form_data);
         }else{
            $validate_insert = FALSE;
         }

         if(empty($validate_insert)){
            if($this->Common_model->save('committee_national_member', $form_data)){
               echo 'inserted';
            }else{
               echo 'insert fail';
            }
         }else{
            echo 'duplicate';
         }
      }

      $alldt = $this->Committee_model->get_national_committee_member($form_data);
      echo '23432sdfg324';
      echo '<table class="tg2">
      <tr>
         <th class="tg-71hr">SL</th>
         <th class="tg-71hr">Scout ID</th>
         <th class="tg-71hr">Name</th>
         <th class="tg-71hr">Commt. Designation</th>
         <th class="tg-71hr">Profe. Designation</th>
         <th class="tg-71hr">Office Address </th>
         <th class="tg-71hr">Mobile No </th>
         <th class="tg-71hr">Email </th>
         <th class="tg-71hr" width="50">Action</th>
      </tr>';
      for($i=0; $i<sizeof($alldt); $i++){
         $name = $alldt[$i]->scout_id != NULL ? $alldt[$i]->first_name:$alldt[$i]->member_name;
         $mobile = $alldt[$i]->scout_id != NULL ? $alldt[$i]->phone:$alldt[$i]->member_mobile;
         $email = $alldt[$i]->scout_id != NULL ? $alldt[$i]->email:$alldt[$i]->member_email;
         echo '
         <tr>
            <td class="tg-031e" align="center">'.$alldt[$i]->sl_no.'.</td>
            <td class="tg-031e">'.$alldt[$i]->scout_id.'</td>
            <td class="tg-031e">'.$name.'</td>
            <td class="tg-031e">'.$alldt[$i]->committee_designation_name.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_profession.'</td>
            <td class="tg-031e">'.$alldt[$i]->member_address.'</td>
            <td class="tg-031e">'.$mobile.'</td>
            <td class="tg-031e">'.$email.'</td>
            <td class="tg-031e">
               <button type="button" class="btn btn-danger btn-mini" onclick="return func_delete_committee_member('.$alldt[$i]->id.');">Delete</button>
            </td>
         </tr>';
      }
      echo '</table>';
      exit;
   }

   
   public function national_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - national_delete - exitsts', TRUE);
      }

      //Delete data
      if($this->Committee_model->national_destroy($committeeID)){
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Committee delete successfully.');
         redirect("committee/national");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("committee/national");   
      }
   }











   

   


   // public function upazila(){
   //    if($this->ion_auth->is_admin()){
   //       $this->data['results'] = $this->Committee_model->get_upazila_thana_committee();  

   //    }elseif($this->ion_auth->is_region_admin()){
   //       // $region_id = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
   //       $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_upazila_thana_committee($officeID); 

   //    }elseif($this->ion_auth->is_district_admin()){
   //       // $sc_district_id = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
   //       $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_upazila_thana_committee('', $officeID);
   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       // $sc_upa_tha_id = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'))->office_upa_tha_id;
   //       $officeUpazilaID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_upazila_thana_committee('','',$officeUpazilaID);
   //       // print_r($this->data['results']); exit;
   //    }

   //    // $this->data['results'] = $this->Committee_model->get_upazila_committee();
   //    // Load page
   //    $this->data['meta_title'] = 'All Scout Upazila Executive Committee';
   //    $this->data['subview'] = 'upazila';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function upazila_create(){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('session_end_date', 'committee session', 'trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upa_tha_id', 'committee upazila/thana office', 'trim');

   //    if ($this->form_validation->run() == true){
   //       $form_data = array(
   //          'committee_name' => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),
   //          'session_end_date' => date_db_format($this->input->post('session_end_date')),
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id'   => $this->input->post('office_district_id'),
   //          'office_upa_tha_id'   => $this->input->post('office_upa_tha_id')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->save('committee_exe_upazila', $form_data)){
   //          //last personal data id
   //          $lastID = $this->db->insert_id();

   //          // Committee Members 
   //          //'member_name' => $_POST['member_name'][$i],
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             $member_data = array(
   //                'committee_id' => $lastID,
   //                'member_scout_id' => $_POST['member_scout_id'][$i],
   //                'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                'member_profession' => $_POST['member_profession'][$i],
   //                'member_address' => $_POST['member_address'][$i],
   //                );
   //             $this->Common_model->save('committee_member_upazila', $member_data);
   //          }

   //          $this->session->set_flashdata('success', 'Create upazila/thana committee successfully.');
   //          redirect("committee/upazila");
   //       }
   //    }

   //    $this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions(); 
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();

   //    //Load page
   //    $this->data['meta_title'] = 'Create Scout Upazila Committee';
   //    $this->data['subview'] = 'upazila_create';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function upazila_update($id){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('session_end_date', 'committee session', 'trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upa_tha_id', 'committee upazila/thana office', 'trim');

   //    if ($this->form_validation->run() == true){
   //       $form_data = array(
   //          'committee_name' => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),
   //          'session_end_date' => date_db_format($this->input->post('session_end_date')),
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id'   => $this->input->post('office_district_id'),
   //          'office_upa_tha_id'   => $this->input->post('office_upa_tha_id'),
   //          'is_current'   => $this->input->post('status')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->edit('committee_exe_upazila', $id, 'id', $form_data)){

   //          // Committee Members
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             //check exists data
   //             $data_exists = $this->Common_model->exists('committee_member_upazila', 'id', $_POST['hide_member_id'][$i]);
   //             if($data_exists){
   //                $member_data = array(
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   ); 
   //                $this->Common_model->edit('committee_member_upazila', $_POST['hide_member_id'][$i], 'id', $member_data);
   //             }else{
   //                $member_data = array(
   //                   'committee_id' => $id,
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   );
   //                $this->Common_model->save('committee_member_upazila', $member_data);
   //             }
   //          }

   //          $this->session->set_flashdata('success', 'Update scouts upazila/thana executive committee successfully.');
   //          redirect("committee/upazila");
   //       }
   //    }

   //    $results = $this->Committee_model->get_upazila_committee_info($id); 
   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    $this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions();
   //    $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
   //    $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();

   //    //Load page
   //    $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
   //    $this->data['subview'] = 'upazila_update';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function upazila_details($id){
   //    $results = $this->Committee_model->get_upazila_committee_info($id); 
   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    foreach ($results['members'] as $k => $members){
   //       $results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
   //    }

   //    // Load page
   //    $this->data['meta_title'] = 'Upazila Executive Committee Details';
   //    $this->data['subview'] = 'upazila_details';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_group(){
   //    if($this->ion_auth->is_admin()){
   //       $this->data['results'] = $this->Committee_model->get_scout_group_committee();  

   //    }elseif($this->ion_auth->is_region_admin()){
   //       // $region_id = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
   //       $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_group_committee($officeID); 

   //    }elseif($this->ion_auth->is_district_admin()){
   //       // $sc_district_id = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
   //       $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_group_committee('', $officeID);

   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       // $sc_upa_tha_id = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'))->office_upa_tha_id;
   //       $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_group_committee('', '', $officeID);
   //       // print_r($this->data['results']); exit;
   //    }elseif($this->ion_auth->is_group_admin()){
   //       // $sc_group_id = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'))->office_sc_group_id;
   //       $officeID = $this->Offices_model->get_scout_group_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_group_committee('', '', '', $officeID);
   //       // print_r($this->data['results']); exit;
   //    }

   //    // $this->data['results'] = $this->Committee_model->get_upazila_committee();
   //    // Load page
   //    $this->data['meta_title'] = 'All Scout Group Executive Committee';
   //    $this->data['subview'] = 'scout_group';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }   

   // public function scout_group_create(){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('session_end_date', 'committee session', 'trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upa_tha_id', 'committee upazila office', 'trim');
   //    $this->form_validation->set_rules('office_sc_group_id', 'committee group office', 'required|trim');

   //    if ($this->form_validation->run() == true){
   //       // $end_date = date('Y-m-d', strtotime('+5 years'));
   //       $end_date = date('Y-m-d', strtotime('+3 years', strtotime($this->input->post('session_start_date'))));

   //       $form_data = array(
   //          'committee_name' => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),            
   //          'session_end_date'   => $end_date,
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id' => $this->input->post('office_district_id'),
   //          'office_upa_tha_id'  => $this->input->post('office_upa_tha_id'),
   //          'office_sc_group_id' => $this->input->post('office_sc_group_id')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->save('committee_exe_scout_group', $form_data)){
   //          //last personal data id
   //          $lastID = $this->db->insert_id();

   //          // Committee Members 
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             $member_data = array(
   //                'committee_id' => $lastID,
   //                'member_scout_id' => $_POST['member_scout_id'][$i],
   //                'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                'member_profession' => $_POST['member_profession'][$i],
   //                'member_address' => $_POST['member_address'][$i],
   //                );
   //             $this->Common_model->save('committee_member_scout_group', $member_data);
   //          }

   //          $this->session->set_flashdata('success', 'Create scout group committee successfully.');
   //          redirect("committee/scout_group");
   //       }
   //    }

   //    //$this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions(); 
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();

   //    // Offices Access
   //    if($this->ion_auth->is_region_admin()){
   //       // $result = $this->Committee_model->get_current_region_from_committee($this->userSessID);
   //       $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
   //       $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $officeID);
   //       $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $result->office_region_id);

   //    }elseif($this->ion_auth->is_district_admin()){
   //       // $result = $this->Committee_model->get_current_district_from_committee($this->userSessID);

   //       $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
   //       // print_r($officeID); exit;   
   //       $region     = $officeID->dis_scout_region_id;
   //       $district   = $officeID->id;

   //       $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
   //       $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
   //       $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       // $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
   //       $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
   //       $region     = $officeID->upa_region_id;
   //       $district   = $officeID->upa_scout_dis_id;
   //       $upazila    = $officeID->id;

   //       $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
   //       $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
   //       $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
   //       $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_thana_id($upazila);
   //    }

   //    //Load page
   //    $this->data['meta_title'] = 'Create Scout Group Committee';
   //    $this->data['subview'] = 'scout_group_create';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_group_update($id){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upa_tha_id', 'committee upazila/thana office', 'trim');
   //    $this->form_validation->set_rules('office_sc_group_id', 'committee scout group office', 'required|trim');

   //    if ($this->form_validation->run() == true){
   //       $end_date = date('Y-m-d', strtotime('+3 years', strtotime($this->input->post('session_start_date'))));

   //       $form_data = array(
   //          'committee_name' => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),
   //          'session_end_date'   => date_db_format($this->input->post('session_end_date')),
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id' => $this->input->post('office_district_id'),
   //          'office_upa_tha_id'  => $this->input->post('office_upa_tha_id'),
   //          'office_sc_group_id' => $this->input->post('office_sc_group_id'),
   //          'is_current'   => $this->input->post('status')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->edit('committee_exe_scout_group', $id, 'id', $form_data)){

   //          // Committee Members
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             //check exists data
   //             $data_exists = $this->Common_model->exists('committee_member_scout_group', 'id', $_POST['hide_member_id'][$i]);
   //             if($data_exists){
   //                $member_data = array(
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   ); 
   //                $this->Common_model->edit('committee_member_scout_group', $_POST['hide_member_id'][$i], 'id', $member_data);
   //             }else{
   //                $member_data = array(
   //                   'committee_id' => $id,
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   );
   //                $this->Common_model->save('committee_member_scout_group', $member_data);
   //             }
   //          }

   //          $this->session->set_flashdata('success', 'Update scouts group executive committee successfully.');
   //          redirect("committee/scout_group");
   //       }
   //    }

   //    $results = $this->Committee_model->get_scout_group_committee_info($id); 
   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    // $this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions();
   //    $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
   //    $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
   //    $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();


   //    // Offices
   //    // if($this->ion_auth->is_region_admin()){
   //    //    $result = $this->Committee_model->get_current_region_from_committee($this->userSessID);
   //    //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $result->office_region_id);
   //    //    $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $result->office_region_id);

   //    // }elseif($this->ion_auth->is_district_admin()){
   //    //    $result = $this->Committee_model->get_current_district_from_committee($this->userSessID);
   //    //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $result->office_region_id);
   //    //    $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $result->office_district_id);
   //    //    $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $result->office_district_id);

   //    // }elseif($this->ion_auth->is_upazila_admin()){
   //    //    $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
   //    //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $result->office_region_id);
   //    //    $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $result->office_district_id);
   //    //    $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $result->office_upa_tha_id);
   //    //    $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_thana_id($result->office_upa_tha_id);
   //    // }

   //    //Load page
   //    $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
   //    $this->data['subview'] = 'scout_group_update';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_group_details($id){
   //    $results = $this->Committee_model->get_scout_group_committee_info($id); 
   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    // foreach ($results['members'] as $k => $members){
   //    //    $results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
   //    // }

   //    // Load page
   //    $this->data['meta_title'] = $this->data['info']->committee_name.' Details';
   //    $this->data['subview'] = 'scout_group_details';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }


   // public function scout_unit(){
   //    if($this->ion_auth->is_admin()){
   //       $this->data['results'] = $this->Committee_model->get_scout_unit_committee();  

   //    }elseif($this->ion_auth->is_region_admin()){
   //       // $region_id = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
   //       $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_unit_committee($officeID); 

   //    }elseif($this->ion_auth->is_district_admin()){
   //       // $sc_district_id = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
   //       $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID)->id; 
   //       $this->data['results'] = $this->Committee_model->get_scout_unit_committee('', $officeID);

   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       // $sc_upazila_id = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'))->office_upa_tha_id;
   //       $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Committee_model->get_scout_unit_committee('','',$officeID);

   //    }elseif($this->ion_auth->is_group_admin()){
   //       $sc_group_id = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'))->office_sc_group_id;
   //       $this->data['results'] = $this->Committee_model->get_scout_unit_committee('','','',$sc_group_id);
   //       // print_r($this->data['results']); exit;
   //    }

   //    // Load page
   //    $this->data['meta_title'] = 'All Scout Unit Executive Committee';
   //    $this->data['subview'] = 'scout_unit';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }


   // public function scout_unit_create(){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('session_end_date', 'committee session', 'trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upazila_id', 'committee upazila office', 'trim');
   //    $this->form_validation->set_rules('office_sc_group_id', 'committee scout group office', 'required|trim');
   //    $this->form_validation->set_rules('sc_unit_id', 'committee scout unit office', 'required|trim');

   //    if ($this->form_validation->run() == true){
   //       // $end_date = date('Y-m-d', strtotime('+5 years'));
   //       $end_date = date('Y-m-d', strtotime('+3 years', strtotime($this->input->post('session_start_date'))));

   //       $form_data = array(
   //          'committee_name'     => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),            
   //          'session_end_date'   => $end_date,
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id' => $this->input->post('office_district_id'),
   //          'office_upazila_id'  => $this->input->post('office_upazila_id'),
   //          'office_sc_group_id' => $this->input->post('office_sc_group_id'),
   //          'office_sc_unit_id'  => $this->input->post('sc_unit_id')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->save('committee_exe_scout_unit', $form_data)){
   //          //last personal data id
   //          $lastID = $this->db->insert_id();

   //          // Committee Members 
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             $member_data = array(
   //                'committee_id' => $lastID,
   //                'member_scout_id' => $_POST['member_scout_id'][$i],
   //                'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                'member_profession' => $_POST['member_profession'][$i],
   //                'member_address' => $_POST['member_address'][$i],
   //                );
   //             $this->Common_model->save('committee_member_scout_unit', $member_data);
   //          }

   //          $this->session->set_flashdata('success', 'Create scout unit committee successfully.');
   //          redirect("committee/scout_unit");
   //       }
   //    }

   //    //$this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions(); 
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();

   //    //Load page
   //    $this->data['meta_title'] = 'Create Scout Unit Committee';
   //    $this->data['subview'] = 'scout_unit_create';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_unit_update($id){
   //    $this->form_validation->set_rules('committee_name', 'committee name','required|trim|max_length[255]');
   //    $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
   //    $this->form_validation->set_rules('session_end_date', 'committee session', 'trim');
   //    $this->form_validation->set_rules('office_region_id', 'committee region office', 'required|trim');
   //    $this->form_validation->set_rules('office_district_id', 'committee district office', 'required|trim');
   //    $this->form_validation->set_rules('office_upazila_id', 'committee upazila office', 'trim');
   //    $this->form_validation->set_rules('office_sc_group_id', 'committee scout group office', 'required|trim');
   //    $this->form_validation->set_rules('sc_unit_id', 'committee scout unit office', 'required|trim');

   //    if ($this->form_validation->run() == true){
   //       $end_date = date('Y-m-d', strtotime('+3 years', strtotime($this->input->post('session_start_date'))));

   //       $form_data = array(
   //          'committee_name' => $this->input->post('committee_name'),
   //          'session_start_date' => date_db_format($this->input->post('session_start_date')),
   //          'session_end_date'   => date_db_format($this->input->post('session_end_date')),
   //          'office_region_id'   => $this->input->post('office_region_id'),
   //          'office_district_id' => $this->input->post('office_district_id'),
   //          'office_upazila_id'  => $this->input->post('office_upazila_id'),
   //          'office_sc_group_id' => $this->input->post('office_sc_group_id'),
   //          'office_sc_unit_id'  => $this->input->post('sc_unit_id'),
   //          'is_current'   => $this->input->post('status')
   //          );
   //       // print_r($form_data); exit;

   //       if($this->Common_model->edit('committee_exe_scout_unit', $id, 'id', $form_data)){

   //          // Committee Members
   //          for ($i=0; $i<sizeof($_POST['member_scout_id']); $i++) { 
   //             //check exists data
   //             $data_exists = $this->Common_model->exists('committee_member_scout_unit', 'id', $_POST['hide_member_id'][$i]);
   //             if($data_exists){
   //                $member_data = array(
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_scout_desig_id' => $_POST['member_scout_desig_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   ); 
   //                $this->Common_model->edit('committee_member_scout_unit', $_POST['hide_member_id'][$i], 'id', $member_data);
   //             }else{
   //                $member_data = array(
   //                   'committee_id' => $id,
   //                   'member_scout_id' => $_POST['member_scout_id'][$i],
   //                   'member_profession' => $_POST['member_profession'][$i],
   //                   'member_address' => $_POST['member_address'][$i],
   //                   );
   //                $this->Common_model->save('committee_member_scout_unit', $member_data);
   //             }
   //          }

   //          $this->session->set_flashdata('success', 'Update scout unit executive committee successfully.');
   //          redirect("committee/scout_unit");
   //       }
   //    }

   //    $results = $this->Committee_model->get_scout_unit_committee_info($id); 

   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    // $this->data['scout_sessions'] = $this->Common_model->get_committee_session_current();
   //    $this->data['committee_designation'] = $this->Common_model->get_dropdown('committee_designation','committee_designation_name','id');
   //    $this->data['scout_regions'] = $this->Common_model->get_regions();
   //    $this->data['scout_districts'] = $this->Common_model->get_scout_districts();
   //    $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana();
   //    $this->data['scout_group'] = $this->Common_model->get_scout_group_office();
   //    $this->data['scout_members'] = $this->Common_model->get_scout_id_with_designation();

   //    //Load page
   //    $this->data['meta_title'] = 'Update '.$this->data['info']->committee_name;
   //    $this->data['subview'] = 'scout_unit_update';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_unit_details($id){
   //    $results = $this->Committee_model->get_scout_unit_committee_info($id); 
   //    $this->data['info'] = $results['info'];
   //    $this->data['members'] = $results['members'];

   //    foreach ($results['members'] as $k => $members){
   //       $results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
   //    }

   //    // Load page
   //    $this->data['meta_title'] = $this->data['info']->committee_name.' Details';
   //    $this->data['subview'] = 'scout_unit_details';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }


   // function ajax_committee_member_del($id){
   //    $this->Common_model->delete('committee_national_member', 'id', $id);
   //    echo 'Remove this information from database completely.';
   // }

   // function ajax_region_committee_member_del($id){
   //    $this->Common_model->delete('committee_member_region', 'id', $id);
   //    echo 'Remove this information from database completely.';
   // }

   // function ajax_district_committee_member_del($id){
   //    $this->Common_model->delete('committee_member_district', 'id', $id);
   //    echo 'Remove this information from database completely.';
   // }

   // function ajax_upazila_thana_committee_member_del($id){
   //    $this->Common_model->delete('committee_member_upazila', 'id', $id);
   //    echo 'Remove this information from database completely.';
   // }

   // function ajax_scout_group_committee_member_del($id){
   //    $this->Common_model->delete('committee_member_scout_group', 'id', $id);
   //    echo 'Remove this information from database completely.';
   // }

}