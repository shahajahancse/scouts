<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Scout_group_application extends Backend_Controller {	
   var $userSessID;

   public function __construct(){
      parent::__construct();
      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_title'] = 'Scout Group Application';
      $this->userSessID = $this->session->userdata('user_id');

      $this->load->model('Common_model'); 
      $this->load->model('Scout_group_application_model');     
      $this->load->model('offices/Offices_model');
   }

   public function index(){    
      redirect('scout_group_application/application_list');
   }

   public function application_list(){
      // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
      //    redirect('dashboard');
      // }

      // if (extension_loaded('gd2')) {
      //   print 'gd loaded';
      // } else {
      //   print 'gd NOT loaded';
      // }

      // phpinfo(); 
      // exit();


      if($this->ion_auth->is_admin()){ 
         // Superadmin
         $results = $this->Offices_model->get_scout_group($limit, $offset);
         // Results
         $this->data['results'] = $this->Scout_group_application_model->get_data();

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         // Results
         $this->data['results'] = $this->Scout_group_application_model->get_data($regionInfo->id); 

      }elseif($this->ion_auth->is_district_admin()){ 
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);
         // Results
         $this->data['results'] = $this->Scout_group_application_model->get_data('', $districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $this->data['results'] = $this->Scout_group_application_model->get_data('', '', $upazilaInfo->id);
         
      }else{
         redirect('dashboard');
      }

      // Load page
      $this->data['meta_title'] = 'Application List';
      $this->data['subview'] = 'application_list';
      $this->load->view('backend/_layout_main', $this->data);
   } 

   public function verify($id){
      if(!($this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);      
      // $this->data['users'] = $this->ion_auth->user()->row();

      // Validation
      $this->form_validation->set_rules('reg_num', 'charter number/registration number ', 'required|trim');
      $this->form_validation->set_rules('status', 'status ', 'required|trim');

      // Validate and Submit Data
      if ($this->form_validation->run() == true){
            //$form_data = array('participant_type_app' => $this->input->post('participant_type_app'));

         if($this->ion_auth->is_region_admin()){
            $form_data = array(
               'reg_region_charter_number' => $this->input->post('reg_num'), 
               'reg_region_date' => date('Y-m-d'), 
               'verify_region'   => $this->input->post('status'), 
               'comment_region'  => $this->input->post('comments')
               );

         }elseif($this->ion_auth->is_district_admin()){ 
            $form_data = array(
               'reg_dis_num'     => $this->input->post('reg_num'), 
               'reg_dis_date'    => date('Y-m-d'), 
               'verify_district' => $this->input->post('status'),
               'comment_district'=> $this->input->post('comments')
               );

         }elseif($this->ion_auth->is_upazila_admin()){
            $form_data = array(
               'reg_upa_num'     => $this->input->post('reg_num'), 
               'reg_upa_date'    => date('Y-m-d'), 
               'verify_upazila'  => $this->input->post('status'),
               'comment_upazila' => $this->input->post('comments')
               );
         }
         // print_r($form_data);exit();

         if($this->Common_model->edit('scout_group_application', $dataID, 'id', $form_data)){
            // echo $this->db->last_query(); exit;
            //Activity Log 1=C, 2=U, 3=D, 4=V, 5=G
            func_activity_log(2, 'Scouts group application change status :'.$dataID); 
            $this->session->set_flashdata('success', 'Applicant status change successfully.');

            // Redirect
            redirect("scout_group_application/application_list");
         }
      }

      $this->data['status'] = $this->Common_model->get_application_verify_satus();
      $this->data['info'] = $this->Scout_group_application_model->get_scout_application($dataID);

      // Load View
      $this->data['meta_title'] = 'Scout Group Application Verify';
      $this->data['subview'] = 'verify';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function scout_group_create($id){

      if(!$this->ion_auth->is_region_admin()){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); 

      // Info
      $info = $this->Scout_group_application_model->get_scout_application($dataID);
      $this->data['info'] = $info;

      // Create User
      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validation
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
         // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');  

      // $email    = strtolower($this->input->post('email'));
      $email    = strtolower($info->contact_email);      
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('7');
      $additional_data = array(
         'is_office'    => 1
         );  

      //Validate and input fiekds
      if ($this->form_validation->run() == true){
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups); 

         $form_data = array(
            'user_id'         => $lastID,
            'grp_type'        => $info->grp_type,
            'grp_name'        => $info->grp_name_en,   
            'grp_name_bn'     => $info->grp_name_bn,   
            'grp_remarks'     => $this->input->post('grp_remarks'),            
            'grp_mobile'      => $info->contact_mobile,
            'grp_email'       => $info->contact_email,
            'grp_address'     => $info->grp_address,
            'grp_region_id'   => $info->region_id,
            'grp_scout_dis_id'=> $info->district_id,
            'grp_scout_upa_id'=> $info->upazila_id,
            'grp_created'     => date_db_format($info->grp_open_date),
            'grp_charter'     => $info->reg_region_charter_number,
            'grp_reg_num_dis' => $info->reg_dis_num,
            'grp_reg_dis_date'=> date_db_format($info->reg_dis_date),
            'grp_reg_num_upa' => $info->reg_upa_num,
            'grp_reg_upa_date'=> date_db_format($info->reg_upa_date)
            );
         // echo '<pre>';
         // print_r($form_data); exit;
         if($this->Common_model->save('office_groups', $form_data)){
            $insert_id = $this->db->insert_id();

            // Scout Group Application Update
            $this->Common_model->edit('scout_group_application', $dataID, 'id', array('create_group' => 1));

            // Insert Scout Unit under a group
            for ($i=0; $i<sizeof($_POST['unit_name']); $i++) { 
               $form_data2 = array(
                  'unit_name'          => $_POST['unit_name'][$i],
                  'unit_name_bn'       => $_POST['unit_name_bn'][$i],
                  'unit_type'          => $_POST['unit_type'][$i],           
                  'unit_region_id'     => $info->region_id,
                  'unit_scout_dis_id'  => $info->district_id,
                  'unit_scout_upa_id'  => $info->upazila_id,
                  'unit_sc_grp_id'     => $insert_id
                  );
               $this->Common_model->save('office_unit', $form_data2);
            }

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Scouts group and unit create ID :'.$groupID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Scouts group and unit create successfully.');
            redirect("offices/scout_group");
         }
      }                  

      //Input fields
      $this->data['identity'] = array(
         'name'        => 'identity',
         'type'        => 'text',
         'id'          => 'identity',
         'class'       => 'form-control input-sm',
         'value'       => set_value('identity', 'ga_'.$this->input->post('identity')),
         'placeholder' => 'Example: ga_username',
         'style'       => 'text-transform: lowercase;'
         );
      $this->data['password'] = array(
         'name' => 'password',
         'type' => 'text',
         'class' => 'form-control input-sm',
         'placeholder' => 'Mininum 8 character'
         );

      
      //Dropdown
      $this->data['regions'] = $this->Common_model->get_regions();      
      $this->data['sc_unit_types'] = $this->Common_model->set_scout_unit_type(); 

      // Load view
      $this->data['meta_title'] = 'Create Scouts Group Office';
      $this->data['subview'] = 'scout_group_create';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);

      // $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['info'] = $this->Scout_group_application_model->get_scout_application($dataID);
        // $this->data['scout_member_list'] = $this->Scout_group_application_model->get_scout_member_list($id);
        // $this->data['scout_member'] = $this->Scout_group_application_model->get_scout_member($id, $this->data['users']->id);

      $this->data['meta_title'] = 'Scout Group Application Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_application_pdf($id){   
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('scout_group_application', 'id', $dataID)) { 
         show_404('site - scout_application_pdf - exitsts', TRUE);
      }

      //Results
      $this->data['info'] = $this->Scout_group_application_model->get_scout_application($dataID);
      // echo '<pre>';
      // print_r($this->data['info']); exit;
      $this->data['meta_title'] = "স্কাউটস গ্রুপের আবেদন";
      $html = $this->load->view('scout_application_pdf', $this->data, true);   
      $file_name = $dataID."-scout-group-application.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   /*************complain_list_pdf function pdf start**************/
   public function complain_list_pdf($offset=0){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $this->data['complain'] = $this->Scout_group_application_model->get_data();

      //...............................................................................
      $this->data['meta_title'] = "Complain List";
      $html = $this->load->view('complain_list_pdf', $this->data, true);   
      $file_name ="complain_list_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************complain_list_pdf function pdf End**************/




   /*************details_pdf function pdf start**************/
   public function details_pdf($id=0){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $encriptID = (int) decrypt_url($id);
      $this->data['users'] = $this->ion_auth->user()->row();

      $this->data['complain'] = $this->Scout_group_application_model->get_info($encriptID);

      //...............................................................................
      $this->data['meta_title'] = "Details Feedback on Complain";
      $html = $this->load->view('details_pdf', $this->data, true);   
      $file_name ="details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************details_pdf function pdf End**************/

   function delete($id) {
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $this->data['info'] = $this->Scout_group_application_model->delete($id);
      /***********Activity Logs Start**********/
      //$insert_id = $this->db->insert_id();
      func_activity_log(3, 'Delete complain ID :'.$serviceID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
      /***********Activity Logs End**********/
      $this->session->set_flashdata('success', 'Information delete successfully.');
      redirect('complain/complain_list');
   }

   public function username_valid($str){
      // alpha_dash_space
      // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
      if (! preg_match('/^\S*$/', $str)) {
         $this->form_validation->set_message('username_valid', 'The %s field may only contain alpha characters & no white spaces.');
         return FALSE;
      } else {
         return TRUE;
      }
   }

}