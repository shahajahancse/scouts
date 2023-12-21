<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',16000);
set_time_limit(100);
ini_set('memory_limit', '2048M');

class Offices extends Backend_Controller {
   var $userID;
   var $img_path;
   var $img_path_gallery;
   var $userSessID;
   var $qr_path;

   public function __construct(){
      parent::__construct();
      $this->data['module_name'] = 'Offices';

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->load->model('Offices_model');
      $this->load->model('committee/Committee_model');
      $this->load->model('my_profile/My_profile_model');
      $this->img_path = realpath(APPPATH . '../offices_img');
      $this->qr_path = realpath(APPPATH . '../qrcode_img');
      $this->userSessID = $this->session->userdata('user_id');
      $this->img_path_gallery = realpath(APPPATH . '../uploads');
   }

   public function index(){      
      redirect('deshboard');
   }   


   /********************** Scout Group Office *********************
   ****************************************************************/
   public function scout_group($offset=0){
      $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Offices_model->get_scout_group($limit, $offset);
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();

         if(isset($_GET['region'])){
            $this->data['scout_district'] = $this->Common_model->get_scout_districts($_GET['region']);   
            
         } 
         if(isset($_GET['district'])){
            $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($_GET['district']);
         } 

      }elseif($this->ion_auth->is_vendor()){ 
         // Superadmin
         //Result
         $results = $this->Offices_model->get_scout_group($limit, $offset);
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();

         if(isset($_GET['region'])){
            $this->data['scout_district'] = $this->Common_model->get_scout_districts($_GET['region']);   
            
         } 
         if(isset($_GET['district'])){
            $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($_GET['district']);
         }       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         
                 
         // Results
         $results = $this->Offices_model->get_scout_group($limit, $offset, $regionInfo->id);  
         //Dropdown  
         $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id); 

         if(isset($_GET['district'])){
            $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($_GET['district']);
         }  

      }elseif($this->ion_auth->is_district_admin()){ 
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Offices_model->get_scout_group($limit, $offset, '', $districtInfo->id);
         //Dropdown
         $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Offices_model->get_scout_group($limit, $offset, '', '', $upazilaInfo->id);
         
      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('offices/scout_group/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'All Scout Group Office';
      $this->data['subview'] = 'scout_group';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************scout_group_pdf function pdf start**************/
   public function scout_group_pdf($offset=0){
      // $limit = 100;
      if($this->ion_auth->is_admin()){ 
         // Superadmin
         //Result
         $results = $this->Offices_model->get_scout_group_pdf();
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions();

         if(isset($_GET['region'])){
            $this->data['scout_district'] = $this->Common_model->get_scout_districts($_GET['region']);   
            
         } 
         if(isset($_GET['district'])){
            $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($_GET['district']);
         }       

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);
         
                 
         // Results
         $results = $this->Offices_model->get_scout_group_pdf($regionInfo->id);  
         //Dropdown  
         $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id); 

         if(isset($_GET['district'])){
            $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($_GET['district']);
         }  

      }elseif($this->ion_auth->is_district_admin()){ 
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);        
         // Results
         $results = $this->Offices_model->get_scout_group_pdf('', $districtInfo->id);
         //Dropdown
         $this->data['scout_upazila'] = $this->Common_model->get_scout_upazila_thana($districtInfo->id);

      }elseif($this->ion_auth->is_upazila_admin()){
         // Upazila Admin
         $upazilaInfo = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         // Results
         $results = $this->Offices_model->get_scout_group_pdf('', '', $upazilaInfo->id);
         
      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      
      //...............................................................................
      $this->data['meta_title'] = "Scout Group List";
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

   function scout_group_change_username($id){  
      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_change_username - exitsts', TRUE);
      }  

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //go to next  
      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region)){
            show_404('office - scout_group_change_username - RA', TRUE);
         } 

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_change_username - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_change_username - UA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Results
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID); 
      // print_r($this->data['info']);

      // Validation
      if($this->input->post('identity') != $this->data['info']->username) {
         $is_unique =  '|is_unique[users.username]';
      } else {
         $is_unique =  '';
      }
      $this->form_validation->set_rules('identity', 'Username', 'required|callback_username_valid|trim'.$is_unique);

      //validate and input data
      if($this->form_validation->run() === TRUE){
         $data = array('username' => strtolower($this->input->post('identity')));
         //Update username
         $change = $this->Offices_model->update_username($data, $this->data['info']->user_id);
         if ($change){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'scout group change username ID :'.$this->data['info']->user_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Username change successfully.');
            redirect("offices/scout_group");
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            redirect("offices/scout_group");
         }
      }

      // Load view
      $this->data['meta_title'] = 'Scout Group Change Username';
      $this->data['subview'] = 'scout_group_change_username';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function scout_group_change_password($id){
      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_change_password - exitsts', TRUE);
      }  

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //go to next  
      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region)){
            show_404('office - scout_group_change_password - RA', TRUE);
         } 

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_change_password - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_change_password - UA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID); 

      //validation
      $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

      if ($this->form_validation->run() === TRUE){
         // finally change the password
         $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

         $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
         if ($change){
            // if the password was successfully changed

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'scout group change password ID :'.$groupID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("offices/scout_group");
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            redirect("offices/scout_group");
         }
      }

      // view
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
      $this->data['new_password'] = array(
         'name' => 'new',
         'id' => 'new',
         'type' => 'text',
         'class' => 'form-control input-sm',
         'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
         );
      $this->data['new_password_confirm'] = array(
         'name' => 'new_confirm',
         'id' => 'new_confirm',
         'type' => 'text',
         'class' => 'form-control input-sm',
         'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
         );
      $this->data['user_id'] = array(
         'name' => 'user_id',
         'id' => 'user_id',
         'type' => 'hidden',
         'value' => $this->data['info']->user_id,
         );

      //Load page       
      $this->data['meta_title'] = 'Scout Group Change Password';
      $this->data['subview'] = 'scout_group_change_password';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function scout_group_create(){
      //Check authentication
      if($this->ion_auth->is_admin()){ 
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){
         //Region admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $region);

      }elseif($this->ion_auth->is_district_admin()){    
         //District Admin     
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);           
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

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
      }else{
         redirect('dashboard');
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

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
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');      

      $this->form_validation->set_rules('grp_type', 'group type', 'required|trim'); 
      // if($this->input->post('grp_type') == '1'){
      //    $this->form_validation->set_rules('grp_institute_id', 'institute ', 'required|trim');          
      // }
      $this->form_validation->set_rules('grp_name', 'group name', 'required|trim|max_length[255]');      
      $this->form_validation->set_rules('grp_remarks', 'scout region', 'trim');
      $this->form_validation->set_rules('grp_region_id', 'scout region', 'required|trim');
      $this->form_validation->set_rules('grp_scout_dis_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('grp_charter', 'charter number', 'required|trim');
      $this->form_validation->set_rules('grp_created', 'created date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_dis', 'district registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_dis_date', 'district registration no date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_upa', 'upazila registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_upa_date', 'upazila registration date', 'trim');      

      $email    = strtolower($this->input->post('email'));
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
            'grp_type'        => $this->input->post('grp_type'),
            'grp_leader'      => $this->input->post('grp_leader'),
            'grp_institute_id'=> $this->input->post('grp_institute_id'),
            'grp_name'        => $this->input->post('grp_name'),   
            'grp_name_bn'     => $this->input->post('grp_name_bn'),   
            'grp_remarks'     => $this->input->post('grp_remarks'),            
            'grp_mobile'      => $this->input->post('grp_mobile')?$this->input->post('grp_mobile'):NULL,
            'grp_email'       => $this->input->post('grp_email')?$this->input->post('grp_email'):NULL,
            'grp_address'     => $this->input->post('grp_address')?$this->input->post('grp_address'):NULL,
            'grp_region_id'   => $region != NULL ? $region:$this->input->post('grp_region_id'),
            'grp_scout_dis_id'=> $district != NULL ? $district:$this->input->post('grp_scout_dis_id'),
            'grp_scout_upa_id'=> $upazila != NULL ? $upazila:$this->input->post('grp_scout_upa_id'),
            'grp_created'     => date_db_format($this->input->post('grp_created')),
            'grp_charter'     => $this->input->post('grp_charter'),
            'grp_reg_num_dis' => $this->input->post('grp_reg_num_dis'),
            'grp_reg_dis_date'=> date_db_format($this->input->post('grp_reg_dis_date')),
            'grp_reg_num_upa' => $this->input->post('grp_reg_num_upa'),
            'grp_reg_upa_date'=> date_db_format($this->input->post('grp_reg_upa_date'))
            );
         // echo '<pre>';
         // print_r($form_data); exit;
         if($this->Common_model->save('office_groups', $form_data)){
            $insert_id = $this->db->insert_id();

            // Insert Scout Unit under a group
            for ($i=0; $i<sizeof($_POST['unit_name']); $i++) { 
               $form_data2 = array(
                  'unit_name'          => $_POST['unit_name'][$i],
                  'unit_name_bn'       => $_POST['unit_name_bn'][$i],
                  'unit_type'          => $_POST['unit_type'][$i],           
                  'unit_region_id'     => $region != NULL ? $region:$this->input->post('grp_region_id'),
                  'unit_scout_dis_id'  => $district != NULL ? $district:$this->input->post('grp_scout_dis_id'),
                  'unit_scout_upa_id'  => $upazila != NULL ? $upazila:$this->input->post('grp_scout_upa_id'),
                  'unit_sc_grp_id'     => $insert_id
                  );
               $this->Common_model->save('office_unit', $form_data2);
            }

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Scout group and unit create ID :'.$groupID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Scout group and unit create successfully.');
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
      $this->data['meta_title'] = 'Create Scout Group Office';
      $this->data['subview'] = 'scout_group_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_group_update($id){
      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_update - exists', TRUE);
      } 

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID);
      $this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($groupID);      

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $this->data['info']->grp_region_id);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $this->data['info']->grp_region_id);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $this->data['info']->grp_scout_dis_id);

      }elseif($this->ion_auth->is_region_admin()){         
         //Region Admin
         $office = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $office)){
            show_404('office - scout_group_update - RA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $office);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $office);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $this->data['info']->grp_scout_dis_id);         

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_update - DA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_update - UA', TRUE);
         }
         //Dropdown
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         // $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_id($upazila);
      }else{
         redirect('dashboard');
      }

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      // $group = NULL;

      //validation
      $this->form_validation->set_rules('grp_type', 'group type', 'required|trim');       
      $this->form_validation->set_rules('grp_name', 'group name', 'required|trim|max_length[255]');      
      $this->form_validation->set_rules('grp_remarks', 'scout region', 'trim');
      $this->form_validation->set_rules('grp_region_id', 'scout region', 'required|trim');
      $this->form_validation->set_rules('grp_scout_dis_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('grp_charter', 'charter number', 'required|trim');
      $this->form_validation->set_rules('grp_created', 'created date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_dis', 'district registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_dis_date', 'district registration no date', 'trim');
      $this->form_validation->set_rules('grp_reg_num_upa', 'upazila registration no', 'trim');
      $this->form_validation->set_rules('grp_reg_upa_date', 'upazila registration date', 'trim');

      //Validate and input data
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
            'grp_region_id'   => $this->input->post('grp_region_id'),
            'grp_scout_dis_id'=> $this->input->post('grp_scout_dis_id'),
            'grp_scout_upa_id'=> $this->input->post('grp_scout_upa_id'),
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
                     'unit_region_id'     => $region != NULL ? $region:$this->input->post('grp_region_id'),
                     'unit_scout_dis_id'  => $district != NULL ? $district:$this->input->post('grp_scout_dis_id'),
                     'unit_scout_upa_id'  => $upazila != NULL ? $upazila:$this->input->post('grp_scout_upa_id'),
                     'unit_sc_grp_id'     => $groupID
                     );
                  // print_r($form_data2); exit;
                  $this->Common_model->save('office_unit', $form_data2);
               }
            }

            $this->session->set_flashdata('success', 'Update scouts group and unit successfully.');
            func_activity_log(2, 'Update scout group and unit information'.$groupID); //1=C, 2=U, 3=D, 4=V, 5=G
            redirect("offices/scout_group");
            // redirect("offices/scout_group_details/".encrypt_url($groupID));
         }
                  
      }      

      //Dropdown
      $this->data['regions'] = $this->Common_model->get_regions(); 
      // $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
      // $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
      $this->data['sc_unit_types'] = $this->Common_model->set_scout_unit_type(); 

      // Load view
      $this->data['meta_title'] = 'Edit Scout Group Office';
      $this->data['subview'] = 'scout_group_update';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function scout_group_details($id){
      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_details - exists', TRUE);
      }           

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_vendor()){
         //Superadmin
         //Go to next

      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region)){
            show_404('office - scout_group_details - RA', TRUE);
         } 

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_details - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_details - UA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      // Results
      $this->data['groupID'] = $groupID; 
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID); 
      $this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($groupID);

      // $this->data['committees'] = $this->Offices_model->get_committee_by_scout_group_office_id($id);      
      // if($this->data['committees']){
      //    $results = $this->Committee_model->get_scout_group_committee_info($this->data['committees'][0]->id); 
      //    // $this->data['committee_info'] = $results['info'];
      //    $this->data['committee_members'] = $results['members'];
      //    foreach ($results['members'] as $k => $members){
      //       $results['members'][$k]->groups = $this->ion_auth->get_users_groups($members->user_id)->result();
      //    }
      // }

      // Load view
      $this->data['meta_title'] = 'Scout Group: ';
      $this->data['subview'] = 'scout_group_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************scout_group_details_pdf function pdf start**************/
   public function scout_group_details_pdf($id=0){
      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_details - exists', TRUE);
      }           

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Go to next

      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region)){
            show_404('office - scout_group_details - RA', TRUE);
         } 

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_details - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_details - UA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID); 
      $this->data['scout_units'] = $this->Offices_model->get_scout_unit_by_group_office_id($groupID);
      
      //...............................................................................
      $this->data['meta_title'] = "Scout Group Details";
      $html = $this->load->view('scout_group_details_pdf', $this->data, true);   
      $file_name ="scout_group_details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************scout_group_details_pdf function pdf End**************/

   public function scout_group_delete($id){  
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('office - scout_group_delete - exists', TRUE);
      }

      //Count Scouts Member
      if($this->Offices_model->get_count_scouts_members($groupID)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(3, 'scout group delete ID :'.$groupID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

         $this->session->set_flashdata('warning', 'Scout group could not be deleted because scouts member existed under this group.');
         redirect("offices/scout_group");   
      }else{
         // Delete Scouts Group, Unit and User from database
         $this->Offices_model->scout_group_destroy($groupID); 
         $this->session->set_flashdata('success', 'Scout group and all related information delete successfully.');
         redirect("offices/scout_group");   
      }
   }   

   public function scout_unit_delete($groupID, $unitID){
      if($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin()){
         $this->Offices_model->scout_unit_destroy($unitID);
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(3, 'scout unit delete ID :'.$unitID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Delete scout unit successfully.');
         redirect("offices/scout_group_details/".$groupID.'#tab_scout_unit');
      }else{
         redirect('dashboard');
      }
   }

   function ajax_office_unit_del($id){
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $unitID = (int) decrypt_url($id); //exit;

      $this->Common_model->delete('office_unit', 'id', $unitID);
      echo 'Remove this unit information from the database successfully.';
   }


   public function scout_unit_details($id){
      $unitID = (int) decrypt_url($id); //exit;
      if(!$unitID){
         redirect('dashboard');
      }elseif(!$this->Common_model->exists('office_unit', 'id', $unitID)){
         //echo 'office not exists'; exit;
         redirect('dashboard');
      }

      $this->data['info'] = $this->Offices_model->get_scout_unit_info($unitID); 
      $this->data['results'] = $this->Scouts_member_model->get_scout_member_by_unit($unitID);
      // foreach ($this->data['results'] as $k => $user){
      //    $this->data['results'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
      // }

      // ZIP file Root Directory
      $rootPath = realpath(APPPATH . '../temp_dir/zip_file/'.$this->data['info']->id);

      // Delete Files and Folder 
      //@$this->delete_directory($rootPath);
      //@unlink($rootPath.'.zip');

      // Load page
      $this->data['meta_title'] = 'Scout Unit: ';
      $this->data['subview'] = 'scout_unit_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************scout_unit_idcard_pdf function pdf start**************/
   public function scout_unit_idcard_pdf($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $unitID = (int) decrypt_url($id); //exit;
      // $unitID = $id; //exit;
      if (!$this->Common_model->exists('office_unit', 'id', $unitID)) { 
         show_404('office - scout_unit_idcard_pdf - exists', TRUE);
      }           

      // Unit information
      $unitInfo = $this->Offices_model->get_scout_unit_info($unitID); 
      // print_r($this->data['info']); exit;
      $this->data['results'] = $this->Scouts_member_model->get_scout_member_by_unit($unitID);

      // ZIP file Root Directory
      $rootPath = realpath(APPPATH . '../temp_dir/zip_file/'.$unitInfo->id);      

      // Create Dirrectory
      if (!file_exists($rootPath)) {
          mkdir('temp_dir/zip_file/'.$unitInfo->id, 0777, true);
      }

      // Generate PDF into Created Directory
      for ($i=0; $i < count($this->data['results']); $i++) { 
         $this->data['info'] = $this->My_profile_model->get_info($this->data['results'][$i]->id);
         $scoutID = $this->data['info']->scout_id;

         // Generate QR Code
         $this->qrcode_generator($this->data['info']->id);

         // Generate ID Card
         $html = $this->load->view('my_profile/pdf_id_card_front', $this->data, true);
         $html2 = $this->load->view('my_profile/pdf_id_card_back', $this->data, true);    

         $mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
         $file_name = $scoutID.".pdf";

         // Generate the PDF from the given html
         $mpdf->WriteHTML($html);
         $mpdf->AddPage(); // Adds a new page in Landscape orientation
         $mpdf->WriteHTML($html2);

         // Output
         $mpdf->Output('temp_dir/zip_file/'.$unitInfo->id.'/'.$file_name, 'F');         
      }

      
      // Initialize archive object
      $zip = new ZipArchive();
      $zip->open($rootPath.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

      // Create recursive directory iterator
      /** @var SplFileInfo[] $files */
      $files = new RecursiveIteratorIterator(
          new RecursiveDirectoryIterator($rootPath),
          RecursiveIteratorIterator::LEAVES_ONLY
      );

      foreach ($files as $name => $file)
      {
          // Skip directories (they would be added automatically)
          if (!$file->isDir())
          {
               // Get real and relative path for current file
               $filePath = $file->getRealPath();
               $relativePath = substr($filePath, strlen($rootPath) + 1);// exit;

               // Add current file to archive
               $zip->addFile($filePath, $relativePath);
          }
      }

      // Zip archive will be created only after closing object
      $zip->close();

      // Delete Files and Folder 
      $this->delete_directory($rootPath);

      // Auto download by browser
      $downloadFileName = $unitInfo->unit_name != NULL ? $unitInfo->unit_name : $unitInfo->id;
      $archfilename = $downloadFileName.'.zip';
      header("Content-type: application/zip"); 
      header("Content-Disposition: attachment; filename = $archfilename"); 
      header("Pragma: no-cache"); 
      header("Expires: 0"); 
      readfile($rootPath.".zip");

      // Delete ZIP file
      @unlink($rootPath.'.zip');
      exit;     
   }
   /*************scout_group_details_pdf function pdf End**************/


   public function delete_directory($dirname) {
      //echo $dirname; exit;
      if (is_dir($dirname))
         $dir_handle = opendir($dirname);
      if (!$dir_handle)
         return false;
      while($file = readdir($dir_handle)) {
         if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
         }
      }
      closedir($dir_handle);
      rmdir($dirname);
      return true;
   }

   /* 
   * php delete function that deals with directories recursively
   */
   // function delete_files($target) {
   //    // echo $target; exit;
   //    if(is_dir($target)){
   //       $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
   //       // print_r($files); exit;
   //       foreach( $files as $file ){
   //          // echo $file; exit;
   //          delete_files( $file );
   //       }
   //       rmdir( $target );

   //    } elseif(is_file($target)) {
   //       unlink( $target );  
   //    }
   // }

   public function qrcode_generator($id){
      // echo FCPATH;
      $info = $this->Scouts_member_model->get_info($id);
      //echo '<pre>';
      //print_r($info); exit;
      $scout_id   = $info->scout_id;
      $url        = base_url("user/").$scout_id;
 
      $codeContents = 'URL: '.$url."\n"; 

      $data['img_url']="";
      $this->load->library('ciqrcode');
      $qr_image=$id.'.png';
      // print_r($codeContents); exit();

      $params['data'] = $codeContents;
      $params['level'] = 'H';
      $params['size'] = 8;
      $params['savename'] = $this->qr_path."/".$qr_image;

      if($this->ciqrcode->generate($params)){

         $this->Scouts_member_model->set_scout_qrcode($id, $qr_image);
         $data['img_url']=$qr_image;
      }

      //$this->load->view('qrcode', $data);
      return true;
   }












   public function scout_group_set_username($id){
      // if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){         
      //    redirect('dashboard');
      // }

     $groupID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_groups', 'id', $groupID)) { 
         show_404('offices - scout_group_set_username - exitsts', TRUE);
      }

      //Check authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Go to next

      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region)){
            show_404('office - scout_group_details - RA', TRUE);
         } 

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district)){
            show_404('office - scout_group_details - DA', TRUE);
         }

      }elseif($this->ion_auth->is_upazila_admin()){
         //Upazila Admin
         $office = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $office->upa_region_id;
         $district   = $office->upa_scout_dis_id;
         $upazila    = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_access_scouts_group($groupID, $region, $district, $upazila)){
            show_404('office - scout_group_details - UA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID); 

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validate field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      }else{
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('7');
      $additional_data = array(
         'is_office'    => 1,    
         'phone'        => $this->input->post('phone')
         );      

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);

         $form_data = array( 'user_id' => $lastID );

         // print_r($form_data); exit;
         if($this->Common_model->edit('office_groups', $officeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Set Scout username and password :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Set Scout username and password successfully.');
            redirect("offices/scout_group");
         }
      }

      //Load view
      $this->data['meta_title'] = 'Set Scouts Group Username';
      $this->data['subview'] = 'scout_group_set_username';
      $this->load->view('backend/_layout_main', $this->data);
   }


   /******************** Scouts Upazila Office ********************
   ****************************************************************/
   public function upazila(){
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions(); 
         //Result 
         $this->data['results'] = $this->Offices_model->get_scout_upazila();
         if(isset($_GET['region'])){
            $this->data['scout_district'] = $this->Common_model->get_scout_districts($_GET['region']);
         }

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);         
         //Dropdown
         $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id); 
         // Result
         $this->data['results'] = $this->Offices_model->get_scout_upazila($regionInfo->id); 

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);         
         //Result         
         $this->data['results'] = $this->Offices_model->get_scout_upazila('', $districtInfo->id);

      }else{
         redirect('dashboard');
      }

      // Load view
      $this->data['meta_title'] = 'All Scouts Upazila Office';
      $this->data['subview'] = 'upazila';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************upazila_pdf function pdf start**************/
   public function upazila_pdf(){
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Dropdown
         $this->data['regions'] = $this->Common_model->get_regions(); 
         //Result 
         $this->data['results'] = $this->Offices_model->get_scout_upazila();
         if(isset($_GET['region'])){
            $this->data['scout_district'] = $this->Common_model->get_scout_districts($_GET['region']);
         }

      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);         
         //Dropdown
         $this->data['scout_district'] = $this->Common_model->get_scout_districts($regionInfo->id); 
         // Result
         $this->data['results'] = $this->Offices_model->get_scout_upazila($regionInfo->id); 

      }elseif($this->ion_auth->is_district_admin()){
         // District Admin        
         $districtInfo = $this->Offices_model->get_district_office_by_user_id($this->userSessID);         
         //Result         
         $this->data['results'] = $this->Offices_model->get_scout_upazila('', $districtInfo->id);

      }else{
         redirect('dashboard');
      }

      //...............................................................................
      $this->data['meta_title'] = "All Scouts Upazila Office";
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

   public function upazila_set_username($id){
      $officeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_upazila', 'id', $officeID)) { 
         show_404('offices - upazila_set_username - exitsts', TRUE);
      }

      if($this->ion_auth->is_admin()){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){         
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;             
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region)){
            show_404('offices - upazila_set_username - RA', TRUE);
         }         

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region, $district)){
            show_404('offices - upazila_set_username - DA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validation
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      }else{
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('6');
      $additional_data = array(
         'is_office'    => 1
         );      

      //Validate and input data
      if ($this->form_validation->run() == true) {
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
         // $lastID = $this->db->insert_id();
         $form_data = array(
            'user_id' => $lastID
            );
         // print_r($form_data); exit;
         if($this->Common_model->edit('office_upazila', $officeID, 'id', $form_data)){

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Set Scout username and password for upazila :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Set username and password successfully.');
            redirect("offices/upazila");
         }
      }

      //Load view
      $this->data['meta_title'] = 'Set Scouts Upazila Username';
      $this->data['subview'] = 'upazila_set_username';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_change_password($id){
      $officeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_upazila', 'id', $officeID)) { 
         show_404('offices - upazila_change_password - exitsts', TRUE);
      }

      if($this->ion_auth->is_admin()){
         //Superadmin
         //Goto next
      }elseif($this->ion_auth->is_region_admin()){         
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;             
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region)){
            show_404('offices - upazila_change_password - RA', TRUE);
         }         

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region, $district)){
            show_404('offices - upazila_change_password - DA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 

      if($this->data['info']->user_id){
         //validation
         $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
         $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

         if ($this->form_validation->run() === TRUE){
            // finally change the password
            $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
            if ($change){
               // if the password was successfully changed
               $this->session->set_flashdata('success', $this->ion_auth->messages());
               redirect("offices/upazila");
            }else{
               $this->session->set_flashdata('success', $this->ion_auth->errors());
               redirect("offices/upazila");
            }
         }

         // view
         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
         $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
         $this->data['new_password'] = array(
            'name' => 'new',
            'id' => 'new',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['new_password_confirm'] = array(
            'name' => 'new_confirm',
            'id' => 'new_confirm',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['user_id'] = array(
            'name' => 'user_id',
            'id' => 'user_id',
            'type' => 'hidden',
            'value' => $this->data['info']->user_id,
            );

         //Load view       
         $this->data['meta_title'] = 'Change Scouts Upazila Password';
         $this->data['subview'] = 'upazila_change_password';
         $this->load->view('backend/_layout_main', $this->data);
      }else{
         redirect('dashboard');
      }
   }

   public function upazila_create(){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validation
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      }else{
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

      $this->form_validation->set_rules('upa_div_id', 'division', 'trim'); 
      $this->form_validation->set_rules('upa_dis_id', 'district', 'trim');     
      $this->form_validation->set_rules('upa_upa_id', 'upazila/thana', 'trim');     
      $this->form_validation->set_rules('upa_scout_dis_id', 'scout district', 'required|trim');  
      $this->form_validation->set_rules('upa_name', 'upazila name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('upa_name_en', 'upazila name english', 'required|trim|max_length[255]');

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('6');
      $additional_data = array(
         'is_office'    => 1
         ); 

      //Validate and input data
      if ($this->form_validation->run() == true){
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);

         $form_data = array(
            'user_id' => $lastID,
            'upa_div_id' => $this->input->post('upa_div_id'),
            'upa_dis_id' => $this->input->post('upa_dis_id'),
            'upa_upa_id' => $this->input->post('upa_upa_id'),
            'upa_region_id' => $this->input->post('upa_region_id'),
            'upa_scout_dis_id' => $this->input->post('upa_scout_dis_id'),
            'upa_name'   => $this->input->post('upa_name'),
            'upa_name_en'=> $this->input->post('upa_name_en'),
            'upa_description'   => $this->input->post('upa_description'),
            'upa_phone'  => $this->input->post('upa_phone')?$this->input->post('upa_phone'):NULL,
            'upa_fax'    => $this->input->post('upa_fax')?$this->input->post('upa_fax'):NULL,
            'upa_email'  => $this->input->post('upa_email')?$this->input->post('upa_email'):NULL,
            'upa_address'=> $this->input->post('upa_address')?$this->input->post('upa_address'):NULL
            );

         if($this->Common_model->save('office_upazila', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'create upazila office information data ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Create scouts upazila successfully.');
            redirect("offices/upazila");
         }
      }

      //Dropdown
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      $this->data['regions'] = $this->Common_model->get_regions(); 

      // Load view
      $this->data['meta_title'] = 'Create Scouts Upazila Office';
      $this->data['subview'] = 'upazila_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_update($id){
      $officeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_upazila', 'id', $officeID)) { 
         show_404('offices - upazila_update - exitsts', TRUE);
      }      

      if($this->ion_auth->is_admin()){
         //Superadmin
         //Validation
         $this->form_validation->set_rules('upa_scout_dis_id', 'scout district', 'required|trim');  
         //Dropdown         
         $this->data['divisions'] = $this->Common_model->get_division(); 
         $this->data['districts'] = $this->Common_model->get_district(); 
         $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
         $this->data['regions'] = $this->Common_model->get_regions(); 
         $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 

      }elseif($this->ion_auth->is_region_admin()){         
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;             
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region)){
           show_404('offices - upazila_update - RA', TRUE);
         }         

      }elseif($this->ion_auth->is_district_admin()){
         //District Admin
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region, $district)){
            show_404('offices - upazila_update - DA', TRUE);
         }
      }else{
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('upa_div_id', 'division', 'trim'); 
      $this->form_validation->set_rules('upa_dis_id', 'district', 'trim');     
      $this->form_validation->set_rules('upa_upa_id', 'upazila', 'trim');           
      $this->form_validation->set_rules('upa_name', 'upazila name', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('upa_name_en', 'upazila name english', 'required|trim|max_length[255]');      

      //Validation and input data
      if($this->form_validation->run() == true){
         $form_data = array(            
            'upa_name' => $this->input->post('upa_name'),
            'upa_name_en' => $this->input->post('upa_name_en'),
            'upa_description' => $this->input->post('upa_description'),
            'upa_phone'  => $this->input->post('upa_phone')?$this->input->post('upa_phone'):NULL,
            'upa_fax'    => $this->input->post('upa_fax')?$this->input->post('upa_fax'):NULL,
            'upa_email'  => $this->input->post('upa_email')?$this->input->post('upa_email'):NULL,
            'upa_address'=> $this->input->post('upa_address')?$this->input->post('upa_address'):NULL
            );

         if($this->ion_auth->is_admin()){
            $form_data['upa_div_id']     = $this->input->post('upa_div_id');
            $form_data['upa_dis_id']     = $this->input->post('upa_dis_id');
            $form_data['upa_upa_id']     = $this->input->post('upa_upa_id');
            $form_data['upa_region_id']  = $this->input->post('upa_region_id');
            $form_data['upa_scout_dis_id'] = $this->input->post('upa_scout_dis_id');
         }

         if($this->Common_model->edit('office_upazila', $officeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'update upazila office information data ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Update scouts upazila successfully.');
            redirect("offices/upazila");
         }
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 
      
      // Load view
      $this->data['meta_title'] = 'Update Scouts Upazila Office';
      $this->data['subview'] = 'upazila_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_details($id){
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_upazila', 'id', $officeID)){
         show_404('offices - upazila_details - exitsts', TRUE);
      }

      //Check Authentication
      if($this->ion_auth->is_admin()){
         //Go to next
      }elseif($this->ion_auth->is_region_admin()){
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region)){
            show_404('offices - upazila_details - RA', TRUE); 
         } 

      }elseif($this->ion_auth->is_district_admin()){
         $office = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         $region     = $office->dis_scout_region_id;
         $district   = $office->id;
         //Cross Check
         if(!$this->Offices_model->check_office_access_upazila($officeID, $region, $district)){
            show_404('offices - upazila_details - DA', TRUE);
         }

      }else{
         redirect('dashboard');
      }

      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 

      // Load view
      $this->data['meta_title'] = 'Details Scouts Upazila Office';
      $this->data['subview'] = 'upazila_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_upazila', 'id', $officeID)) { 
         show_404('office - upazila_delete - exitsts', TRUE);
      }

      //Count Scouts District
      if($this->Offices_model->get_count_scouts_group_by_district($officeID)){
         $this->session->set_flashdata('warning', 'Scouts upazila could not be deleted because scouts group exists under this upazila.');
         redirect("offices/upazila");   
      }

      if($this->Offices_model->upazila_destroy($officeID)){
         //$insert_id = $this->db->insert_id();
            func_activity_log(3, 'delete upazila office information data ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Scouts upazila delete successfully.');
         redirect("offices/upazila");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("offices/upazila");   
      }
   }


   /******************* Scouts District Office *********************
   ****************************************************************/

   public function district(){
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Result         
         $this->data['results'] = $this->Offices_model->get_scout_district(); 
         // Dropdown
         $this->data['regions'] = $this->Common_model->get_regions(); 
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);                  
         // Result
         $this->data['results'] = $this->Offices_model->get_scout_district($regionInfo->id); 
      }else{
         redirect('dashboard');
      }      

      // Load page
      $this->data['meta_title'] = 'All Scouts District Office';
      $this->data['subview'] = 'district';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   /*************district_pdf function pdf start**************/
   public function district_pdf(){
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Result         
         $this->data['results'] = $this->Offices_model->get_scout_district(); 
         // Dropdown
         $this->data['regions'] = $this->Common_model->get_regions(); 
      }elseif($this->ion_auth->is_region_admin()){
         // Region Admin
         $regionInfo = $this->Offices_model->get_region_office_by_user_id($this->userSessID);                  
         // Result
         $this->data['results'] = $this->Offices_model->get_scout_district($regionInfo->id); 
      }else{
         redirect('dashboard');
      }

      //...............................................................................
      $this->data['meta_title'] = "All Scouts District Office";
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

   public function district_change_password($id){
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_change_password - exists', TRUE);
      }

      //Check Authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Go to next
      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_office_access_district($officeID, $region)){
            show_404('office - district_change_password - RA', TRUE);
         } 
      }else{
         redirect('dashboard');
      }

      //Result 
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 

      if($this->data['info']->user_id){
         //validation
         $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
         $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

         //Validation 
         if ($this->form_validation->run() === TRUE){
            // finally change the password
            $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
            if ($change){
               // if the password was successfully changed
               $this->session->set_flashdata('success', $this->ion_auth->messages());
               //$insert_id = $this->db->insert_id();
               func_activity_log(2, 'district change password ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
               /***********Activity Logs End**********/

               redirect("offices/district");
            }else{
               $this->session->set_flashdata('success', $this->ion_auth->errors());
               redirect("offices/district");
            }
         }

         // view
         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
         $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
         $this->data['new_password'] = array(
            'name' => 'new',
            'id' => 'new',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['new_password_confirm'] = array(
            'name' => 'new_confirm',
            'id' => 'new_confirm',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['user_id'] = array(
            'name' => 'user_id',
            'id' => 'user_id',
            'type' => 'hidden',
            'value' => $this->data['info']->user_id,
            );

         //Load View       
         $this->data['meta_title'] = 'District Change Password';
         $this->data['subview'] = 'district_change_password';
         $this->load->view('backend/_layout_main', $this->data);
      }else{
         redirect('dashboard');
      }
   }

   public function district_create(){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validate field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');


      //Validation
      $this->form_validation->set_rules('dis_div_id', 'scout district division', 'trim'); 
      $this->form_validation->set_rules('dis_dis_id', 'scout district district', 'trim');
      $this->form_validation->set_rules('dis_scout_region_id', 'scout region', 'required|trim');
      $this->form_validation->set_rules('dis_type', 'district type', 'required|trim');          
      $this->form_validation->set_rules('dis_name', 'district name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('dis_name_en', 'district name english', 'required|trim|max_length[255]');

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('5');
      $additional_data = array(
         'is_office'    => 1
         );

      //Validate, create user and insert data
      if ($this->form_validation->run() == true){
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
         $form_data = array(
            'user_id' => $lastID,
            'dis_div_id' => $this->input->post('dis_div_id'),
            'dis_dis_id' => $this->input->post('dis_dis_id'),
            'dis_scout_region_id' => $this->input->post('dis_scout_region_id'),
            'dis_type'   => $this->input->post('dis_type'),
            'dis_name'   => $this->input->post('dis_name'),
            'dis_name_en'=> $this->input->post('dis_name_en'),
            'dis_description'   => $this->input->post('dis_description'),
            'dis_phone'  => $this->input->post('dis_phone')?$this->input->post('dis_phone'):NULL,
            'dis_fax'    => $this->input->post('dis_fax')?$this->input->post('dis_fax'):NULL,
            'dis_email'  => $this->input->post('dis_email')?$this->input->post('dis_email'):NULL,
            'dis_address'=> $this->input->post('dis_address')?$this->input->post('dis_address'):NULL
            );

         if($this->Common_model->save('office_district', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'district create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Create scouts district successfully.');
            redirect("offices/district");
         }
      }

      //Dropdown
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['dis_type'] = $this->Common_model->get_scout_district_type();
      $this->data['regions'] = $this->Common_model->get_regions();       

      //Load View
      $this->data['meta_title'] = 'Create Scouts District Office';
      $this->data['subview'] = 'district_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_update($id){
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_update - exitsts', TRUE);
      }

      //Check Authentication
      if($this->ion_auth->is_admin()){
         //Go to next
         //Validation
         $this->form_validation->set_rules('dis_div_id', 'district division', 'trim'); 
         $this->form_validation->set_rules('dis_dis_id', 'district district', 'trim');
         $this->form_validation->set_rules('dis_scout_region_id', 'scout region', 'required|trim');
         $this->form_validation->set_rules('dis_type', 'district type', 'required|trim');

         //Dropdown
         $this->data['divisions'] = $this->Common_model->get_division(); 
         $this->data['districts'] = $this->Common_model->get_district();
         $this->data['dis_type'] = $this->Common_model->get_scout_district_type();
         $this->data['regions'] = $this->Common_model->get_regions(); 

      }elseif($this->ion_auth->is_region_admin()){
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_office_access_district($officeID, $region)){
            show_404('office - district_update - RA', TRUE);
         } 
      }else{
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('dis_name', 'district name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('dis_name_en', 'district name english', 'required|trim|max_length[255]');      

      //Validate and update data
      if ($this->form_validation->run() == true){
         $form_data = array(            
            'dis_name'   => $this->input->post('dis_name'),
            'dis_name_en'=> $this->input->post('dis_name_en'),
            'dis_description'   => $this->input->post('dis_description'),
            'dis_phone'  => $this->input->post('dis_phone')?$this->input->post('dis_phone'):NULL,
            'dis_fax'    => $this->input->post('dis_fax')?$this->input->post('dis_fax'):NULL,
            'dis_email'  => $this->input->post('dis_email')?$this->input->post('dis_email'):NULL,
            'dis_address'=> $this->input->post('dis_address')?$this->input->post('dis_address'):NULL
            );

         if($this->ion_auth->is_admin()){
            $form_data['dis_div_id'] = $this->input->post('dis_div_id');
            $form_data['dis_dis_id'] = $this->input->post('dis_dis_id');
            $form_data['dis_scout_region_id'] = $this->input->post('dis_scout_region_id');
            $form_data['dis_type']   = $this->input->post('dis_type');
            $form_data['dis_status'] = $this->input->post('dis_status');
         }

         if($this->Common_model->edit('office_district', $officeID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'district Update ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/
            $this->session->set_flashdata('success', 'Update scouts district successfully.');
            redirect("offices/district");
         }
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 
      // print_r($this->data['info']); exit;

      //Load View
      $this->data['meta_title'] = 'Update Scouts District Office';
      $this->data['subview'] = 'district_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_details($id){
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_details - exitsts', TRUE);
      }

      //Check Authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Go to next
      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_office_access_district($officeID, $region)){
            show_404('office - district_details - RA', TRUE);
         } 
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 

      // Load view
      $this->data['meta_title'] = 'Scouts District Details';
      $this->data['subview'] = 'district_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************district_details_pdf function pdf start**************/
   public function district_details_pdf($id){
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_details - exitsts', TRUE);
      }

      //Check Authentication
      if($this->ion_auth->is_admin()){
         //Superadmin
         //Go to next
      }elseif($this->ion_auth->is_region_admin()){
         //Region Admin
         $region = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id; 
         //Cross Check
         if(!$this->Offices_model->check_office_access_district($officeID, $region)){
            show_404('office - district_details - RA', TRUE);
         } 
      }else{
         redirect('dashboard');
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID);
      
      //...............................................................................
      $this->data['meta_title'] = "Scouts District Details";
      $html = $this->load->view('district_details_pdf', $this->data, true);   
      $file_name ="district_details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }
   /*************district_details_pdf function pdf End**************/

   public function district_delete($id){  
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('office_district', 'id', $officeID)) { 
         show_404('office - district_delete - exitsts', TRUE);
      }

      //Count Scouts District
      if($this->Offices_model->get_count_scouts_group_by_district($officeID)){
         $this->session->set_flashdata('warning', 'Scouts district could not be deleted because scouts group exists under this district.');
         redirect("offices/district");   
      }

      //Delete
      if($this->Offices_model->district_destroy($officeID)){
         // Delete Scouts Region from database 

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Scouts district delete ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

         $this->session->set_flashdata('success', 'Scouts district delete successfully.');
         redirect("offices/district");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("offices/district");   
      }
   }


   /*********************** Scouts Region Office *******************
   ****************************************************************/

   public function region(){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      //Result
      $this->data['results'] = $this->Offices_model->get_region(); 

      // Load view
      $this->data['meta_title'] = 'All Scouts Region ';
      $this->data['subview'] = 'region';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_pdf(){
      //Result
      $this->data['results'] = $this->Offices_model->get_region();

      //...............................................................................
      $this->data['meta_title'] = "All Scouts Region ";
      $html = $this->load->view('region_pdf', $this->data, true);   
      $file_name ="region_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }

   public function region_change_password($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_change_password - exists', TRUE);
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      //$this->data['info']->region_user_id;

      if($this->data['info']->region_user_id){
         //validation
         $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
         $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

         if ($this->form_validation->run() === TRUE){
            // finally change the password
            $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
            if ($change){

               /***********Activity Logs Start**********/
               //$insert_id = $this->db->insert_id();
               func_activity_log(2, 'region change password ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
               /***********Activity Logs End**********/

               // if the password was successfully changed
               $this->session->set_flashdata('success', $this->ion_auth->messages());
               redirect("offices/region");
            }else{
               $this->session->set_flashdata('success', $this->ion_auth->errors());
               redirect("offices/region");
            }
         }

         // view
         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
         $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
         $this->data['new_password'] = array(
            'name' => 'new',
            'id' => 'new',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['new_password_confirm'] = array(
            'name' => 'new_confirm',
            'id' => 'new_confirm',
            'type' => 'text',
            'class' => 'form-control input-sm',
            'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
         $this->data['user_id'] = array(
            'name' => 'user_id',
            'id' => 'user_id',
            'type' => 'hidden',
            'value' => $this->data['info']->region_user_id,
            );

         //Load page       
         $this->data['meta_title'] = 'Scouts Region Change Password';
         $this->data['subview'] = 'region_change_password';
         $this->load->view('backend/_layout_main', $this->data);
      }else{
         redirect('dashboard');
      }
   }

   public function region_create(){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validate field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
      
      $this->form_validation->set_rules('region_div_id', 'region division', 'trim'); 
      $this->form_validation->set_rules('region_type', 'region type', 'required|trim');          
      $this->form_validation->set_rules('region_name', 'region name', 'required|trim|max_length[255]');
      $uploadedFile='';
      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
      $password = $this->input->post('password');
      $groups = array('4');
      $additional_data = array(
         'is_office'    => 1,    
         'phone'         => $this->input->post('phone')
         );      
      
      //Validate and input data
      if ($this->form_validation->run() == true) {
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);   

         $form_data = array(
            'region_div_id' => $this->input->post('region_div_id'),
            'region_type'   => $this->input->post('region_type'),
            'region_name'   => $this->input->post('region_name'),
            'region_name_en'=> $this->input->post('region_name_en'),
            'region_description'   => $this->input->post('region_description'),
            'region_phone'  => $this->input->post('region_phone')?$this->input->post('region_phone'):NULL,
            'region_fax'    => $this->input->post('region_fax')?$this->input->post('region_fax'):NULL,
            'region_email'  => $this->input->post('region_email')?$this->input->post('region_email'):NULL,
            'region_address'=> $this->input->post('region_address')?$this->input->post('region_address'):NULL,
            'region_user_id'=> $lastID
            );

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

         if($_FILES['userfile']['size'] > 0){
            $form_data['region_logo'] = $uploadedFile;
         }

         if($this->Common_model->save('office_region', $form_data)){

            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'Scout region create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Scout region create successfully.');
            redirect("offices/region");
         }
      }

      //Dropdown
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['region_type'] = $this->Common_model->get_region_type();

      //Load View
      $this->data['meta_title'] = 'Create Scouts Region Office';
      $this->data['subview'] = 'region_create';
      $this->load->view('backend/_layout_main', $this->data);
   }   

   public function region_update($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_update - exists', TRUE);
      }

      //validation
      $this->form_validation->set_rules('region_div_id', 'region division', 'trim'); 
      $this->form_validation->set_rules('region_type', 'region type', 'required|trim');          
      $this->form_validation->set_rules('region_name', 'region name bangla', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('region_name_en', 'region name english', 'required|trim|max_length[255]');

      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      // print_r($this->data['info']); exit;

      $uploadedFile='';
      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      //validata and input data
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
            'region_div_id' => $this->input->post('region_div_id'),
            'region_type'   => $this->input->post('region_type'),
            'region_name'   => $this->input->post('region_name'),
            'region_name_en'=> $this->input->post('region_name_en'),
            'region_description' => $this->input->post('region_description'),
            'region_phone'  => $this->input->post('region_phone')?$this->input->post('region_phone'):NULL,
            'region_fax'    => $this->input->post('region_fax')?$this->input->post('region_fax'):NULL,
            'region_email'  => $this->input->post('region_email')?$this->input->post('region_email'):NULL,
            'region_address'=> $this->input->post('region_address')?$this->input->post('region_address'):NULL
            );

         if($_FILES['userfile']['size'] > 0){
            $form_data['region_logo'] = $uploadedFile;
         }
         // print_r($form_data); exit;

         if($this->Common_model->edit('office_region', $officeID, 'id', $form_data)){
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update scouts region ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Update scouts region successfully.');
            redirect("offices/region");
         }
      }

      //Dropdown
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['region_type'] = $this->Common_model->get_region_type();

      //Load View
      $this->data['meta_title'] = 'Update Region Scouts';
      $this->data['subview'] = 'region_update';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_details($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_details - exists', TRUE);
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'Details Scouts Region Office';
      $this->data['subview'] = 'region_details';
      $this->load->view('backend/_layout_main', $this->data);
   }
   
   public function region_details_pdf($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_details - exists', TRUE);
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_region_info($officeID);

      //...............................................................................
      $this->data['meta_title'] = "Details Scouts Region Office";
      $html = $this->load->view('region_details_pdf', $this->data, true);   
      $file_name ="region_details_pdf.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "D");
   }   

   public function region_delete($id){
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if (!$this->Common_model->exists('office_region', 'id', $officeID)) { 
         show_404('office - region_delete - exists', TRUE);
      }

      //Count Scouts District
      if($this->Offices_model->get_count_scouts_district_by_region($officeID)){
         $this->session->set_flashdata('warning', 'Scouts region could not be deleted because scouts district exists under this region.');
         redirect("offices/region");   
      }

      //Delete
      if($this->Offices_model->region_destroy($officeID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Scouts region delete ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Scouts region delete successfully.');
         redirect("offices/region");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("offices/region");   
      }
   }   


   /*********************** Scouts NHQ Office *********************
   ****************************************************************/

   public function nhq(){
      if($this->ion_auth->is_admin()){
         $this->data['results'] = $this->Offices_model->get_nhq();          
         foreach ($this->data['results'] as $k => $user){
            $this->data['results'][$k]->groups = $this->ion_auth->get_users_groups($user->userid)->result();
         }
      }else{
         redirect('dashboard');
      }

      // Load view
      $this->data['meta_title'] = 'Scouts NHQ Office Users ';
      $this->data['subview'] = 'nhq';
      $this->load->view('backend/_layout_main', $this->data);
   }

   /*************nhq_pdf function pdf start**************/
    public function nhq_pdf(){
        
         if($this->ion_auth->is_admin()){
         $this->data['results'] = $this->Offices_model->get_nhq();          
         foreach ($this->data['results'] as $k => $user){
            $this->data['results'][$k]->groups = $this->ion_auth->get_users_groups($user->userid)->result();
         }
         }else{
            redirect('dashboard');
         }

        //...............................................................................
        $this->data['meta_title'] = "Scouts NHQ Office Users";
        $html = $this->load->view('nhq_pdf', $this->data, true);   
        $file_name ="nhq_pdf.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "D");
    }

    /*************nhq_pdf function pdf End**************/

   function nhq_change_username($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_nhq', 'id', $officeID)){
         show_404('office - nhq_change_username - exists', TRUE);
      }

      //Result
      $this->data['info'] = $this->Offices_model->get_nhq_user_info($officeID); 

      // Validate field
      if($this->input->post('identity') != $this->data['info']->username) {
         $is_unique =  '|is_unique[users.username]';
      } else {
         $is_unique =  '';
      }
      $this->form_validation->set_rules('identity', 'Username', 'required|callback_username_valid|trim'.$is_unique);

      //Validate and input data
      if($this->form_validation->run() === TRUE){
         $data = array('username' => strtolower($this->input->post('identity')));
         //Update username
         $change = $this->Offices_model->update_username($data, $this->data['info']->nhq_user_id);
         if ($change){

            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Username change ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Username change successfully.');
            redirect("offices/nhq");
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            redirect("offices/nhq");
         }
      }

      // Load view
      $this->data['meta_title'] = 'Scouts NHQ Change Username';
      $this->data['subview'] = 'nhq_change_username';
      $this->load->view('backend/_layout_main', $this->data);
   }



   public function nhq_create(){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      //$groups=$this->ion_auth->groups()->result_array();
      //$currentGroups = $this->ion_auth->get_users_groups($id)->result();

      // Validate field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

      $this->form_validation->set_rules('nhq_office_name', 'nhq office name', 'required|trim|max_length[255]');

      $email    = strtolower($this->input->post('email'));
      $identity = ($identity_column==='email') ? $email : strtolower($this->input->post('identity'));
      $password = $this->input->post('password');
      // $groups = array('4');
      $additional_data = array(
         'is_office'    => 1,    
         'first_name'   => $this->input->post('nhq_office_name')
         );      
      
      //Validata and input data
      if ($this->form_validation->run() == true) {
         // print_r($this->input->post('groups')); exit;
         $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $this->input->post('groups'));   

         $form_data = array(
            'nhq_office_name' => $this->input->post('nhq_office_name'),
            'nhq_user_id'     => $lastID
            );

         if($this->Common_model->save('office_nhq', $form_data)){
            /***********Activity Logs Start**********/
            $insert_id = $this->db->insert_id();
            func_activity_log(1, 'nhq create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Scouts NHQ user create successfully.');
            redirect("offices/nhq");
         }
      }
      
      //$groups;
      $gIDs = array('1','2','3','11', '13', '14', '15');
      $this->data['groups'] = $this->Offices_model->get_user_group($gIDs)->result_array();
      // print_r($this->data['groups']); exit;

      $this->data['nhq_office_name'] = array(
         'name'        => 'nhq_office_name',
         'type'        => 'text',
         'id'          => 'nhq_office_name',
         'class'       => 'form-control input-sm',
         'value'       => set_value('nhq_office_name'),
         'placeholder' => ''
         );
      $this->data['identity'] = array(
         'name'        => 'identity',
         'type'        => 'text',
         'id'          => 'identity',
         'class'       => 'form-control input-sm',
         'value'       => set_value('identity'),
         'placeholder' => '',
         'style'       => 'text-transform: lowercase;'
         );
      $this->data['password'] = array(
         'name' => 'password',
         'type' => 'password',
         'class' => 'form-control input-sm',
         'placeholder' => 'Mininum 8 character'
         );

      //Load view
      $this->data['meta_title'] = 'Create NHQ Office User';
      $this->data['subview'] = 'nhq_create';
      $this->load->view('backend/_layout_main', $this->data);
   }


   // edit a user
   public function nhq_user_update($id){
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_nhq', 'id', $officeID)){
         show_404('office - nhq_user_update - exists', TRUE);
      }

      $userID = $this->Offices_model->get_nhq_office_user_id($officeID)->nhq_user_id;
      // print_r($userID); exit;

      $user = $this->ion_auth->user($userID)->row();
      //$groups=$this->ion_auth->groups()->result_array();         
      
      $currentGroups = $this->ion_auth->get_users_groups($userID)->result();

      // validate form input
      $this->form_validation->set_rules('nhq_office_name', 'NHQ office name', 'required');

      if (isset($_POST) && !empty($_POST)){
         // do we have a valid request?
         // if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')){
         //     show_error($this->lang->line('error_csrf'));
         // }

         // update the password if it was posted
         if ($this->input->post('password')){
            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
         }

         if ($this->form_validation->run() === TRUE){
            $form_data = array( 'nhq_office_name' => $this->input->post('nhq_office_name') );
            $this->Common_model->edit('office_nhq', $officeID, 'id', $form_data);

            $data = array(
               'first_name' => $this->input->post('nhq_office_name'),
               'active'     => $this->input->post('active')
               );

            // update the password if it was posted
            if ($this->input->post('password')){
               $data['password'] = $this->input->post('password');
            }

            // Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin()){
               //Update the groups user belongs to
               $groupData = $this->input->post('groups');
               if (isset($groupData) && !empty($groupData)) {
                  $this->ion_auth->remove_from_group('', $userID);
                  foreach ($groupData as $grp) {
                     $this->ion_auth->add_to_group($grp, $userID);
                  }
               }
            }

            // check to see if we are updating the user
            if($this->ion_auth->update($user->id, $data)){
               // redirect them back to the admin page if admin, or to the base url if non admin
               /***********Activity Logs Start**********/
               //$insert_id = $this->db->insert_id();
               func_activity_log(2, 'nhq user update ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
               /***********Activity Logs End**********/

               $this->session->set_flashdata('success', $this->ion_auth->messages() );
               if ($this->ion_auth->is_admin()){
                  redirect('offices/nhq');
               }else{
                  redirect('dashboard');
               }
            }else{
               // redirect them back to the admin page if admin, or to the base url if non admin
               $this->session->set_flashdata('warning', $this->ion_auth->errors() );
               if ($this->ion_auth->is_admin()){
                  redirect('offices/nhq');
               }else{
                  redirect('dashboard');
               }
            }
         }
      }

      // display the edit user form
      //$this->data['csrf'] = $this->_get_csrf_nonce();

      // set the flash data error message if there is one
      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      // pass the user to the view
      $this->data['user'] = $user;
      
      //$this->data['groups'] = $groups;
      $gIDs = array('1','2','3','11');
      $this->data['groups'] = $this->Offices_model->get_user_group($gIDs)->result_array();
      $this->data['currentGroups'] = $currentGroups;

      $this->data['nhq_office_name'] = array(
         'name'   => 'nhq_office_name',
         'type'   => 'text',
         'id'     => 'nhq_office_name',
         'class'  => 'form-control input-sm',
         'value'  => $this->form_validation->set_value('nhq_office_name', $user->first_name),
         'placeholder' => ''
         );
      $this->data['password'] = array(
         'name'   => 'password',
         'id'     => 'password',
         'class'  => 'form-control input-sm',
         'type'   => 'password'
         );
      $this->data['password_confirm'] = array(
         'name'   => 'password_confirm',
         'id'     => 'password_confirm',
         'class'  => 'form-control input-sm',
         'type'   => 'password'
         );

      //Load view
      $this->data['meta_title'] = 'NHQ User Update';
      $this->data['subview'] = 'nhq_user_update';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function nhq_delete_user($id){
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_nhq', 'id', $officeID)){
         show_404('office - nhq_delete_user - exists', TRUE);
      }

      // Delete from user and nhq nhq user from database
      if($this->Offices_model->nhq_user_destroy($officeID)){

         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'nhq delete user ID :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Delete NHQ user successfully.');
         redirect("offices/nhq");   
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
         redirect("offices/nhq");   
      }
   }



   /*********************** Office Admin User *********************
   ****************************************************************/

   /************************ Region Office ************************/

   public function region_user_pdf($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_user_pdf - exists', TRUE);
      }      

      // Results
      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(2, $officeID);
      
      //...............................................................................
      $this->data['meta_title'] = "Region Admin User List";
      $html = $this->load->view('admin_user/region_user_pdf', $this->data, true);   
      $file_name = $this->data['info']->region_name_en."_user_list.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function region_user($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_user - exists', TRUE);
      }      

      // Results
      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(2, $officeID); 
      // print_r($this->data['info']); exit;

      //Load View
      $this->data['meta_title'] = 'Region Admin User';
      $this->data['subview'] = 'admin_user/region_user';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_user_add($id){
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_region', 'id', $officeID)){
         show_404('office - region_user_add - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }
      

      $this->data['info'] = $this->Offices_model->get_region_info($officeID); 
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(
            'office_type_id'  => 2,
            'member_type'     => $this->input->post('member_type'),
            'sc_region_id'    => $this->data['info']->id, 
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;

         if($this->Common_model->save('office_users', $form_data)){ 
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Add admin user :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Office admin user added successfully.');
            redirect("offices/region_user/".encrypt_url($officeID));
         }
      }

      // Dropdown
      // $this->data['scouts_member'] = $this->Offices_model->get_scout_member_by_group($officeID);
      // echo count($this->data['scouts_member']);

      //Load View
      $this->data['meta_title'] = 'Region Admin User';
      $this->data['subview'] = 'admin_user/region_user_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_user_edit($id){      
      if(!$this->ion_auth->is_admin()){         
         redirect('dashboard');
      }
      $dataID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_users', 'id', $dataID)){
         show_404('office - region_user_edit - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }

      $this->data['info'] = $this->Offices_model->get_office_user_info($dataID); 
      // $this->data['user_info'] = $this->Offices_model->get_region_user_info($officeID); 
      // echo '<pre>';
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(            
            'member_type'     => $this->input->post('member_type'),
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;
         
         if($this->Common_model->edit('office_users', $dataID, 'id', $form_data)){
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update system user :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'System user data update successfully.');
            redirect("offices/region_user/".encrypt_url($this->data['info']->sc_region_id));
         }
      }

      //Load View
      $this->data['meta_title'] = 'Region Admin User';
      $this->data['subview'] = 'admin_user/region_user_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function region_user_delete($id, $officeID){
      //Check Authentication
      if(!$this->ion_auth->is_admin()){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);
      if (!$this->Common_model->exists('office_users', 'id', $dataID)) { 
         show_404('office - region_user_delete - exists', TRUE);
      }

      //Delete
      if($this->Offices_model->office_user_destroy($dataID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Office admin user delete ID :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Admin user delete successfully.');         
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      redirect("offices/region_user/".$officeID);
   }


   /************************ District Office Admin User ************************/

   public function district_user_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_user_pdf - exists', TRUE);
      }      

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(3, $officeID);
      
      //...............................................................................
      $this->data['meta_title'] = "District Admin User List";
      $html = $this->load->view('admin_user/district_user_pdf', $this->data, true);   
      $file_name = $this->data['info']->dis_name_en."_user_list.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function district_user($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_user - exists', TRUE);
      }   

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(3, $officeID); 
      // print_r($this->data['info']); exit;

      //Load View
      $this->data['meta_title'] = 'District Admin User';
      $this->data['subview'] = 'admin_user/district_user';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_user_add($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_district', 'id', $officeID)){
         show_404('office - district_user_add - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }
      

      $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(
            'office_type_id'  => 3,
            'member_type'     => $this->input->post('member_type'),
            'sc_district_id'  => $this->data['info']->id, 
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;

         if($this->Common_model->save('office_users', $form_data)){ 
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Add admin user :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Office admin user added successfully.');
            redirect("offices/district_user/".encrypt_url($officeID));
         }
      }

      // Dropdown
      // $this->data['scouts_member'] = $this->Offices_model->get_scout_member_by_group($officeID);
      // echo count($this->data['scouts_member']);

      //Load View
      $this->data['meta_title'] = 'District Admin User';
      $this->data['subview'] = 'admin_user/district_user_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_user_edit($id){      
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
         redirect('dashboard');
      }
      $dataID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_users', 'id', $dataID)){
         show_404('office - district_user_edit - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }

      $this->data['info'] = $this->Offices_model->get_office_user_info($dataID); 
      // $this->data['user_info'] = $this->Offices_model->get_region_user_info($officeID); 
      // echo '<pre>';
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(            
            'member_type'     => $this->input->post('member_type'),
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;
         
         if($this->Common_model->edit('office_users', $dataID, 'id', $form_data)){
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update admin user :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Admin user data update successfully.');
            redirect("offices/district_user/".encrypt_url($this->data['info']->sc_district_id));
         }
      }

      //Load View
      $this->data['meta_title'] = 'District Admin User';
      $this->data['subview'] = 'admin_user/district_user_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function district_user_delete($id, $officeID){
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);
      if (!$this->Common_model->exists('office_users', 'id', $dataID)) { 
         show_404('office - district_user_delete - exists', TRUE);
      }

      //Delete
      if($this->Offices_model->office_user_destroy($dataID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Office admin user delete ID :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Admin user delete successfully.');         
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      redirect("offices/district_user/".$officeID);
   }


   /************************ Upazila Office Admin User ************************/

   public function upazila_user_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_upazila', 'id', $officeID)){
         show_404('office - district_user_pdf - exists', TRUE);
      }      

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(4, $officeID);
      
      //...............................................................................
      $this->data['meta_title'] = "Upazila Admin User List";
      $html = $this->load->view('admin_user/upazila_user_pdf', $this->data, true);   
      $file_name = $this->data['info']->upa_name_en."_user_list.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function upazila_user($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_upazila', 'id', $officeID)){
         show_404('office - upazila_user - exists', TRUE);
      }   

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(4, $officeID); 
      // print_r($this->data['info']); exit;

      //Load View
      $this->data['meta_title'] = 'Upazila Admin User';
      $this->data['subview'] = 'admin_user/upazila_user';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_user_add($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }
      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_upazila', 'id', $officeID)){
         show_404('office - upazila_user_add - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }
      

      $this->data['info'] = $this->Offices_model->get_scout_upazila_info($officeID); 
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(
            'office_type_id'  => 4,
            'member_type'     => $this->input->post('member_type'),
            'sc_upazila_id'  => $this->data['info']->id, 
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;

         if($this->Common_model->save('office_users', $form_data)){ 
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Add admin user :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Office admin user added successfully.');
            redirect("offices/upazila_user/".encrypt_url($officeID));
         }
      }

      // Dropdown
      // $this->data['scouts_member'] = $this->Offices_model->get_scout_member_by_group($officeID);
      // echo count($this->data['scouts_member']);

      //Load View
      $this->data['meta_title'] = 'Upazila Admin User';
      $this->data['subview'] = 'admin_user/upazila_user_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_user_edit($id){      
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }
      $dataID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_users', 'id', $dataID)){
         show_404('office - upazila_user_edit - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }

      $this->data['info'] = $this->Offices_model->get_office_user_info($dataID); 
      // $this->data['user_info'] = $this->Offices_model->get_region_user_info($officeID); 
      // echo '<pre>';
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(            
            'member_type'     => $this->input->post('member_type'),
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;
         
         if($this->Common_model->edit('office_users', $dataID, 'id', $form_data)){
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update admin user :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Admin user data update successfully.');
            redirect("offices/upazila_user/".encrypt_url($this->data['info']->sc_upazila_id));
         }
      }

      //Load View
      $this->data['meta_title'] = 'Upazila Admin User';
      $this->data['subview'] = 'admin_user/upazila_user_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function upazila_user_delete($id, $officeID){
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);
      if (!$this->Common_model->exists('office_users', 'id', $dataID)) { 
         show_404('office - upazila_user_delete - exists', TRUE);
      }

      //Delete
      if($this->Offices_model->office_user_destroy($dataID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Office admin user delete ID :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Admin user delete successfully.');         
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      redirect("offices/upazila_user/".$officeID);
   }


   /************************ Scout Group Office Admin User ************************/

   public function scout_group_user_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_groups', 'id', $officeID)){
         show_404('office - scout_group_user_pdf - exists', TRUE);
      }      

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(5, $officeID);
      
      //...............................................................................
      $this->data['meta_title'] = "Scout Group Admin User List";
      $html = $this->load->view('admin_user/scout_group_user_pdf', $this->data, true);   
      $file_name = $this->data['info']->upa_name_en."_user_list.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function scout_group_user($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_groups', 'id', $officeID)){
         show_404('office - scout_group_user - exists', TRUE);
      }   

      // Results
      $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID); 
      $this->data['user_list'] = $this->Offices_model->get_office_users(5, $officeID); 
      // print_r($this->data['info']); exit;

      //Load View
      $this->data['meta_title'] = 'Scout Group Admin User';
      $this->data['subview'] = 'admin_user/scout_group_user';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_group_user_add($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_groups', 'id', $officeID)){
         show_404('office - scout_group_user_add - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }
      

      $this->data['info'] = $this->Offices_model->get_scout_group_info($officeID); 
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(
            'office_type_id'  => 5,
            'member_type'     => $this->input->post('member_type'),
            'sc_group_id'     => $this->data['info']->id,
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;

         if($this->Common_model->save('office_users', $form_data)){ 
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(1, 'Add admin user :'.$officeID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Office admin user added successfully.');
            redirect("offices/scout_group_user/".encrypt_url($officeID));
         }
      }

      // Dropdown
      // $this->data['scouts_member'] = $this->Offices_model->get_scout_member_by_group($officeID);
      // echo count($this->data['scouts_member']);

      //Load View
      $this->data['meta_title'] = 'Scout Group Admin User';
      $this->data['subview'] = 'admin_user/scout_group_user_add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_group_user_edit($id){      
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);
      if(!$this->Common_model->exists('office_users', 'id', $dataID)){
         show_404('office - upazila_user_edit - exists', TRUE);
      }

      //validation
      if($this->input->post('member_type') == 1){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim'); 
      }else{
         $this->form_validation->set_rules('user_name', 'name', 'required|trim');          
         $this->form_validation->set_rules('user_phone', 'phone', 'required|trim');          
         $this->form_validation->set_rules('user_designation', 'designation', 'trim');   
      }

      $this->data['info'] = $this->Offices_model->get_office_user_info($dataID); 
      // $this->data['user_info'] = $this->Offices_model->get_region_user_info($officeID); 
      // echo '<pre>';
      // print_r($this->data['info']); exit;

      //validata and input data
      if ($this->form_validation->run() == true){
  
         $form_data = array(            
            'member_type'     => $this->input->post('member_type'),
            'scout_member_id' => $this->input->post('scout_member_id')!= NULL?$this->input->post('scout_member_id'):NULL, 
            'user_name'       => $this->input->post('user_name'),
            'user_phone'      => $this->input->post('user_phone'),
            'user_email'      => $this->input->post('user_email'),
            'user_designation'=> $this->input->post('user_designation'),
            'user_remarks'    => $this->input->post('user_remarks')
            );
         // print_r($form_data); exit;
         
         if($this->Common_model->edit('office_users', $dataID, 'id', $form_data)){
            
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update admin user :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            $this->session->set_flashdata('success', 'Admin user data update successfully.');
            redirect("offices/scout_group_user/".encrypt_url($this->data['info']->sc_group_id));
         }
      }

      //Load View
      $this->data['meta_title'] = 'Scout Group Admin User';
      $this->data['subview'] = 'admin_user/scout_group_user_edit';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_group_user_delete($id, $officeID){
      //Check Authentication
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id);
      if (!$this->Common_model->exists('office_users', 'id', $dataID)) { 
         show_404('office - scout_group_user_delete - exists', TRUE);
      }

      //Delete
      if($this->Offices_model->office_user_destroy($dataID)){
         /***********Activity Logs Start**********/
         //$insert_id = $this->db->insert_id();
         func_activity_log(3, 'Office admin user delete ID :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
         /***********Activity Logs End**********/

         // Delete Scouts Region from database         
         $this->session->set_flashdata('success', 'Admin user delete successfully.');         
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      redirect("offices/scout_group_user/".$officeID);
   }

   public function registration_charter_pdf($id){ 

        $dataID = (int) decrypt_url($id); //exit;
        if (!$this->Common_model->exists('office_groups', 'id', $dataID)) { 
            show_404('offices - registration_charter_pdf - exitsts', TRUE);
        }

        //Results
        $this->data['info'] = $this->Offices_model->get_scout_group_info($dataID); 
        // $this->data['info'] = $this->Site_model->get_scout_application($dataID);
        // echo '<pre>';
        // print_r($this->data['info']); exit;
        $this->data['meta_title'] = "স্কাউটস গ্রুপের আবেদন";
        $html = $this->load->view('registration_charter_pdf', $this->data, true);   
        $file_name = $dataID."-registration_charter.pdf";

        //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 0, 0, 0, 0);

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, "I");
    }







   /*********************** General Functions *********************
   ****************************************************************/

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

   function ajax_exists_scout_group_charter_number(){
      // echo 'true';
      $id = $_POST['charterNo'];
      echo $this->Offices_model->exists_scout_group_charter_no($id);
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

   function ajax_exists_identity(){
      // echo 'true';
      $item = $_POST['inputData'];
      $result = $this->Common_model->exists('users', 'username', $item);

      if ($result == 0) {
         echo 'true';
      }else{
         echo 'false';
      }
   }

   function ajax_exists_usernanemn(){
      // echo 'true';
      $item = $_POST['inputData'];
      $result = $this->Common_model->exists_like('users', 'username', $item);
      if ($result == 0) {
         echo 0;
      }else{
         echo 1;
      }
   }

   //custom validation function for user primary email address
   function primay_email_exists($str){
      if ($this->My_account_model->pri_email_exists($str)){
         $this->form_validation->set_message('primay_email_exists', 'The %s already exists!!! you must be set an unique email address');
         return FALSE;
      }else{
         return TRUE;
      }
   }

   public function imageUploadPost(){
      $config['upload_path']   = $this->img_path_gallery; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $config['max_size']      = 1024;

      $this->load->library('upload', $config);
      $this->upload->do_upload('file');

      print_r('Image Uploaded Successfully.');
      exit;
   }

   public function access_denied(){
      // Load page
      $this->data['meta_title'] = 'Access Denied';
      $this->data['subview'] = 'access_denied';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_bulk_group_create_test(){
      // Load page
      $this->data['meta_title'] = 'Test';
      $this->data['subview'] = 'scout_bulk_group_create_test';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function scout_bulk_group_create(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
         redirect('dashboard');
      }      

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      // Validate field
      if($identity_column!=='email') {
         $this->form_validation->set_rules('identity[]','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
      } else {
         $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
      }
      $this->form_validation->set_rules('password[]', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');      

      $this->form_validation->set_rules('grp_type[]', 'group type'); 
      // if($this->input->post('grp_type') == '1'){
      //    $this->form_validation->set_rules('grp_institute_id', 'institute ', 'required|trim');          
      // }
      $this->form_validation->set_rules('grp_name[]', 'group name', 'required|max_length[255]');      
      // $this->form_validation->set_rules('grp_div_id', 'division', 'required|trim'); 
      // $this->form_validation->set_rules('grp_dis_id', 'district', 'required|trim');     
      // $this->form_validation->set_rules('grp_upa_id', 'upazila/thana', 'trim');       
      // $this->form_validation->set_rules('grp_remarks', 'scout region', 'trim');
      // $this->form_validation->set_rules('grp_region_id', 'scout region', 'required|trim');
      // $this->form_validation->set_rules('grp_scout_dis_id', 'scout district', 'required|trim');
      $this->form_validation->set_rules('grp_charter[]', 'charter number');
      // $this->form_validation->set_rules('grp_created', 'created date', 'trim');
      // $this->form_validation->set_rules('grp_reg_num_dis', 'district registration no', 'trim');
      // $this->form_validation->set_rules('grp_reg_dis_date', 'district registration no date', 'trim');
      // $this->form_validation->set_rules('grp_reg_num_upa', 'upazila registration no', 'trim');
      // $this->form_validation->set_rules('grp_reg_upa_date', 'upazila registration date', 'trim');

      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL; 

      $region = $region != NULL ? $region:$this->input->post('grp_region_id');
      $district = $district != NULL ? $district:$this->input->post('grp_scout_dis_id');
      $upazila = $upazila != NULL ? $upazila:$this->input->post('grp_scout_upa_id');
      $group = NULL;


      // Offices Access
      if($this->ion_auth->is_region_admin()){
         // $result = $this->Committee_model->get_current_region_from_committee($this->userSessID);         
         $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
         $region = $officeID;
         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $officeID);
         $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $officeID);

      }elseif($this->ion_auth->is_district_admin()){
         // $result = $this->Committee_model->get_current_district_from_committee($this->userSessID);
         $officeID = $this->Offices_model->get_district_office_by_user_id($this->userSessID);  
         // print_r($officeID); exit;   
         $region     = $officeID->dis_scout_region_id;
         $district   = $officeID->id;

         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_dd'] = $this->Common_model->get_dropdown_office('office_upazila', 'upa_name', 'upa_scout_dis_id', $district);

      }elseif($this->ion_auth->is_upazila_admin()){
         //$result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
         $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
         $region     = $officeID->upa_region_id;
         $district   = $officeID->upa_scout_dis_id;
         $upazila    = $officeID->id;

         $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
         $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
         $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
         // $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_id($upazila);
      }


      if ($this->form_validation->run() == true){

         for ($i=0; $i<sizeof($_POST['identity']); $i++) { 
            $email    = strtolower($this->input->post('email'));
            $identity = $_POST['identity'][$i];
            $password = $_POST['password'][$i];
            $groups = array('7');
            $additional_data = array(
               'is_office'    => 1
               ); 

            $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups); 
            // $lastID = $this->db->insert_id();            

            $form_data = array(
               'user_id' => $lastID,
               'grp_type' => $_POST['grp_type'][$i],
               'grp_name' => $_POST['grp_name'][$i],
               'grp_name_bn' => $_POST['grp_name_bn'][$i],
               'grp_region_id' => $region,
               'grp_scout_dis_id' => $district,
               'grp_scout_upa_id' => $upazila
               );
            // echo '<pre>';
            // print_r($form_data); exit;
            $this->Common_model->save('office_groups', $form_data);
         }

         $this->session->set_flashdata('success', 'Scouts group create successfully.');
         redirect("offices/scout_group");
      }            

      // $this->data['divisions'] = $this->Common_model->get_division(); 
      // $this->data['districts'] = $this->Common_model->get_district(); 
      // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      $this->data['regions'] = $this->Common_model->get_regions();      
      // $this->data['institute'] = $this->Common_model->get_scout_institute();

      // Load page
      $this->data['meta_title'] = 'Create Bulk Scout Group Office';
      $this->data['subview'] = 'scout_bulk_group_create';
      $this->load->view('backend/_layout_main', $this->data);
   }














   

   // function security_test($param){

   //    // echo ci_encrypt_url($param);
   //    // echo '<br>--encode<br>';

   //    // echo ci_decrypt_url($param).'ddddddd';
   //    // echo '<br>----decode';


   //    echo $encId = encrypt_url($param);
   //    echo '<br>'; 
   //    echo decrypt_url($encId);
   // }

   // function sha1_test($param){      
   //    echo sha1($param);
   // }

   // function sha1_test2($param){
   //    $this->load->library('encrypt');
   //    // echo $this->encrypt->sha1($param);
   //    echo $key = hash('sha256', $param);
   // }

   // function encode_with_key($key){
   //    $message = 'This is secret message.';
   //    $this->load->library('encrypt');

   //    echo $this->encrypt->encode($message, $key);
   // }

   // function decode_with_key($key){
   //    $this->load->library('encrypt');
   //    $message = 'yElUf45w3a4d+quOagwNlsqEOk4EEdBnAfxYb6dvfH2ZS0X36F1U93E/423T84nfTmPBvknn7+5LH5E3Qs1xcQ==';

   //    echo $this->encrypt->decode($message, $key);
   // }

    // public function scout_bulk_group_create(){
   //    if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin())){
   //       redirect('dashboard');
   //    }      

   //    $tables = $this->config->item('tables','ion_auth');
   //    $identity_column = $this->config->item('identity','ion_auth');
   //    $this->data['identity_column'] = $identity_column;

   //    // Validate field
   //    if($identity_column!=='email') {
   //       $this->form_validation->set_rules('identity[]','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
   //          // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
   //    } else {
   //       $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
   //    }
   //    $this->form_validation->set_rules('password[]', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
   //    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');      

   //    $this->form_validation->set_rules('grp_type[]', 'group type'); 
   //    // if($this->input->post('grp_type') == '1'){
   //    //    $this->form_validation->set_rules('grp_institute_id', 'institute ', 'required|trim');          
   //    // }
   //    $this->form_validation->set_rules('grp_name[]', 'group name', 'required|max_length[255]');      
   //    // $this->form_validation->set_rules('grp_div_id', 'division', 'required|trim'); 
   //    // $this->form_validation->set_rules('grp_dis_id', 'district', 'required|trim');     
   //    // $this->form_validation->set_rules('grp_upa_id', 'upazila/thana', 'trim');       
   //    // $this->form_validation->set_rules('grp_remarks', 'scout region', 'trim');
   //    // $this->form_validation->set_rules('grp_region_id', 'scout region', 'required|trim');
   //    // $this->form_validation->set_rules('grp_scout_dis_id', 'scout district', 'required|trim');
   //    $this->form_validation->set_rules('grp_charter[]', 'charter number');
   //    // $this->form_validation->set_rules('grp_created', 'created date', 'trim');
   //    // $this->form_validation->set_rules('grp_reg_num_dis', 'district registration no', 'trim');
   //    // $this->form_validation->set_rules('grp_reg_dis_date', 'district registration no date', 'trim');
   //    // $this->form_validation->set_rules('grp_reg_num_upa', 'upazila registration no', 'trim');
   //    // $this->form_validation->set_rules('grp_reg_upa_date', 'upazila registration date', 'trim');

   //    //scout office
   //    $region = NULL;
   //    $district = NULL;
   //    $upazila = NULL; 

   //    $region = $region != NULL ? $region:$this->input->post('grp_region_id');
   //    $district = $district != NULL ? $district:$this->input->post('grp_scout_dis_id');
   //    $upazila = $upazila != NULL ? $upazila:$this->input->post('grp_scout_upa_id');
   //    $group = NULL;


   //    // Offices Access
   //    if($this->ion_auth->is_region_admin()){
   //       // $result = $this->Committee_model->get_current_region_from_committee($this->userSessID);         
   //       $officeID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;    
   //       $region = $officeID;
   //       $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $officeID);
   //       $this->data['district_dd'] = $this->Common_model->get_dropdown_office('office_district', 'dis_name', 'dis_scout_region_id', $officeID);

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
   //       //$result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
   //       $officeID = $this->Offices_model->get_upazila_office_by_user_id($this->userSessID);
   //       $region     = $officeID->upa_region_id;
   //       $district   = $officeID->upa_scout_dis_id;
   //       $upazila    = $officeID->id;

   //       $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
   //       $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
   //       $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
   //       // $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_id($upazila);
   //    }


   //    if ($this->form_validation->run() == true){

   //       for ($i=0; $i<sizeof($_POST['identity']); $i++) { 
   //          $email    = strtolower($this->input->post('email'));
   //          $identity = $_POST['identity'][$i];
   //          $password = $_POST['password'][$i];
   //          $groups = array('7');
   //          $additional_data = array(
   //             'is_office'    => 1
   //             ); 

   //          $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups); 
   //          // $lastID = $this->db->insert_id();            

   //          $form_data = array(
   //             'user_id' => $lastID,
   //             'grp_type' => $_POST['grp_type'][$i],
   //             'grp_name' => $_POST['grp_name'][$i],
   //             'grp_region_id' => $region,
   //             'grp_scout_dis_id' => $district,
   //             'grp_scout_upa_id' => $upazila,
   //             'grp_charter' => $_POST['grp_charter'][$i]
   //             );
   //          // echo '<pre>';
   //          // print_r($form_data); exit;
   //          $this->Common_model->save('office_groups', $form_data);
   //       }

   //       $this->session->set_flashdata('success', 'Scouts group create successfully.');
   //       redirect("offices/scout_group");
   //    }            

   //    // $this->data['divisions'] = $this->Common_model->get_division(); 
   //    // $this->data['districts'] = $this->Common_model->get_district(); 
   //    // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
   //    $this->data['regions'] = $this->Common_model->get_regions();      
   //    // $this->data['institute'] = $this->Common_model->get_scout_institute();

   //    // Load page
   //    $this->data['meta_title'] = 'Create Bulk Scout Group Office';
   //    $this->data['subview'] = 'scout_bulk_group_create';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }   






   /********************** Scout Unit Office *********************
   ****************************************************************/
   // public function scout_unit(){
   //    if($this->ion_auth->is_admin()){         
   //       $this->data['results'] = $this->Offices_model->get_scout_unit();

   //    }elseif($this->ion_auth->is_region_admin()){
   //       $result = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'));
   //       $officeRegionID = $this->Offices_model->get_region_office_by_user_id($this->userSessID)->id;
   //       $this->data['results'] = $this->Offices_model->get_scout_unit($officeRegionID);      

   //    }elseif($this->ion_auth->is_district_admin()){
   //       $result = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'));
   //       $this->data['results'] = $this->Offices_model->get_scout_unit('',$result->office_district_id);

   //    }elseif($this->ion_auth->is_upazila_admin()){
   //       $result = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'));
   //       $this->data['results'] = $this->Offices_model->get_scout_unit('', '', $result->office_upa_tha_id);

   //    }elseif($this->ion_auth->is_group_admin()){
   //       $result = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'));         
   //       if($result){
   //          $this->data['results'] = $this->Offices_model->get_scout_unit('', '', '', $result->office_sc_group_id);
   //       }else{
   //          redirect('dashboard/no_assign');
   //       }
   //    }

   //    // Load page
   //    $this->data['meta_title'] = 'All Scout Unit Office';
   //    $this->data['subview'] = 'scout_unit';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_unit_create($groupID){
   //    $groupID = (int) $groupID;
   //    if(!$groupID){
   //       redirect('dashboard');
   //    }elseif(!$this->Common_model->exists('office_groups', 'id', $groupID)){
   //       //echo 'office not exists'; exit;
   //       redirect('dashboard');
   //    }

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

   //    $this->data['info'] = $this->Offices_model->get_scout_group_info($groupID);      
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
   //          redirect("offices/scout_group_details/".$groupID);
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

   // public function scout_unit_update($unitID){
   //    $unitID = (int) $unitID;
   //    if(!$unitID){
   //       redirect('dashboard');
   //    }elseif(!$this->Common_model->exists('office_unit', 'id', $unitID)){
   //       //echo 'office not exists'; exit;
   //       redirect('dashboard');
   //    }

   //    $this->data['info'] = $this->Offices_model->get_scout_unit_info($unitID);

   //    $this->form_validation->set_rules('unit_type', 'unit type', 'required|trim'); 
   //    // $this->form_validation->set_rules('unit_div_id', 'division', 'required|trim'); 
   //    // $this->form_validation->set_rules('unit_dis_id', 'district', 'required|trim');     
   //    // $this->form_validation->set_rules('unit_upa_id', 'upazila/thana', 'required|trim'); 
   //    // $this->form_validation->set_rules('unit_region_id', 'scout region', 'required|trim');
   //    // $this->form_validation->set_rules('unit_scout_dis_id', 'scout district', 'required|trim');
   //    // $this->form_validation->set_rules('unit_scout_upa_id', 'scout upazila/thana', 'required|trim');
   //    // $this->form_validation->set_rules('unit_sc_grp_id', 'scout group', 'required|trim');
   //    // $this->form_validation->set_rules('unit_section', 'scout section', 'required|trim');
   //    $this->form_validation->set_rules('unit_name', 'group name', 'required|trim|max_length[255]');
   //    $this->form_validation->set_rules('unit_number', 'number', 'numeric|trim');

   //    if($this->form_validation->run() == true){
   //       $form_data = array(
   //          'unit_leader'        => $this->input->post('unit_leader'),             
   //          'unit_type'          => $this->input->post('unit_type'),            
   //          'unit_name'          => $this->input->post('unit_name'),
   //          'unit_created'       => date_db_format($this->input->post('unit_created')),
   //          'unit_number'        => $this->input->post('unit_number'),
   //          'unit_mobile'        => $this->input->post('unit_mobile')?$this->input->post('unit_mobile'):NULL,
   //          'unit_email'         => $this->input->post('unit_email')?$this->input->post('unit_email'):NULL,
   //          'unit_address'       => $this->input->post('unit_address')?$this->input->post('unit_address'):NULL
   //          );

   //       if($this->Common_model->edit('office_unit', $unitID, 'id', $form_data)){
   //          $this->session->set_flashdata('success', 'Scout unit update successfully.');
   //          redirect("offices/scout_unit_details/".$unitID);
   //       }
   //    }

   //    // $this->data['divisions'] = $this->Common_model->get_division(); 
   //    // $this->data['districts'] = $this->Common_model->get_district(); 
   //    // $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
   //    // $this->data['regions'] = $this->Common_model->get_regions(); 
   //    // $this->data['scout_districts'] = $this->Common_model->get_scout_districts(); 
   //    // $this->data['scout_upazila_thana'] = $this->Common_model->get_scout_upazila_thana(); 
   //    // $this->data['scout_group'] = $this->Common_model->get_scout_group_office(); 
   //    // $this->data['scout_unit'] = $this->Common_model->get_scout_unit_office(); 
   //    //should be change get_scout_group_office to set_scout_section
   //    // $this->data['scout_section'] = $this->Common_model->set_scout_section(); 
   //    $this->data['sc_unit_types'] = $this->Common_model->set_scout_unit_type(); 

   //    // $this->data['info'] = $this->Offices_model->get_scout_unit_info($id);      
   //    $region     = $this->data['info']->unit_region_id;
   //    $district   = $this->data['info']->unit_scout_dis_id;
   //    $upazila    = $this->data['info']->unit_scout_upa_id;
   //    $group      = $this->data['info']->unit_sc_grp_id;

   //    $this->data['region_info'] = $this->Common_model->get_office_info('office_region', $region);
   //    $this->data['district_info'] = $this->Common_model->get_office_info('office_district', $district);
   //    $this->data['upazila_info'] = $this->Common_model->get_office_info('office_upazila', $upazila);
   //    $this->data['group_info'] = $this->Common_model->get_office_info('office_groups', $group);
   //    // $this->data['group_dd'] = $this->Common_model->get_sc_group_by_upazila_id($upazila);

   //    // Load page
   //    $this->data['meta_title'] = 'Update Scouts Unit Office';
   //    $this->data['subview'] = 'scout_unit_update';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   // public function scout_unit_details($unitID){
   //    $unitID = (int) $unitID;
   //    if(!$unitID){
   //       redirect('dashboard');
   //    }elseif(!$this->Common_model->exists('office_unit', 'id', $unitID)){
   //       //echo 'office not exists'; exit;
   //       redirect('dashboard');
   //    }

   //    $this->data['info'] = $this->Offices_model->get_scout_unit_info($unitID); 
   //    $this->data['results'] = $this->Scouts_member_model->get_scout_member_by_unit($unitID);
   //    foreach ($this->data['results'] as $k => $user){
   //       $this->data['results'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
   //    }

   //    // Load page
   //    $this->data['meta_title'] = 'Scout Unit: ';
   //    $this->data['subview'] = 'scout_unit_details';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }



   // public function district_set_username($officeID){
   //    if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin())){         
   //       redirect('dashboard');
   //    }

   //    $this->data['info'] = $this->Offices_model->get_scout_district_info($officeID); 

   //    $tables = $this->config->item('tables','ion_auth');
   //    $identity_column = $this->config->item('identity','ion_auth');
   //    $this->data['identity_column'] = $identity_column;

   //    // Validate field
   //    if($identity_column!=='email') {
   //       $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
   //          // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
   //    }else{
   //       $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
   //    }
   //    $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
   //    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

   //    $email    = strtolower($this->input->post('email'));
   //    $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
   //    $password = $this->input->post('password');
   //    $groups = array('5');
   //    $additional_data = array(
   //       'is_office'    => 1,    
   //       'phone'        => $this->input->post('phone')
   //       );      

   //    if ($this->form_validation->run() == true) {
   //       $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
   //       // $lastID = $this->db->insert_id();

   //       $form_data = array(
   //          'user_id' => $lastID
   //          );

   //       // print_r($form_data); exit;
   //       if($this->Common_model->edit('office_district', $officeID, 'id', $form_data)){
   //          $this->session->set_flashdata('success', 'Set username and password successfully.');
   //          redirect("offices/district");
   //       }
   //    }

   //    $this->data['meta_title'] = 'Set Scout District Username';
   //    $this->data['subview'] = 'district_set_username';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }


   // public function district_reset($id){
   //    if($this->ion_auth->is_admin()){
   //       $this->Offices_model->district_reset_username($id); 
   //       $this->session->set_flashdata('success', 'Reset district username successfully.');
   //       redirect("offices/district");
   //    }else{
   //       redirect('dashboard');
   //    }
   // }




   //   public function region_set_username($officeID){
   //    if(!$this->ion_auth->is_admin()){         
   //       redirect('dashboard');
   //    }

   //    $this->data['info'] = $this->Offices_model->get_region_info($officeID); 

   //    $tables = $this->config->item('tables','ion_auth');
   //    $identity_column = $this->config->item('identity','ion_auth');
   //    $this->data['identity_column'] = $identity_column;

   //       // Validate field
   //    if($identity_column!=='email') {
   //       $this->form_validation->set_rules('identity','username','required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
   //             // $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
   //    }else{
   //       $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
   //    }
   //    $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
   //    $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');

   //    $email    = strtolower($this->input->post('email'));
   //    $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
   //    $password = $this->input->post('password');
   //    $groups = array('4');
   //    $additional_data = array(
   //       'is_office'    => 1,    
   //       'phone'         => $this->input->post('phone')
   //       );      

   //    if ($this->form_validation->run() == true) {
   //       $lastID = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
   //          // $lastID = $this->db->insert_id();

   //       $form_data = array(
   //          'region_user_id' => $lastID
   //          );

   //          // print_r($form_data); exit;
   //       if($this->Common_model->edit('office_region', $officeID, 'id', $form_data)){
   //          $this->session->set_flashdata('success', 'Set username and password successfully.');
   //          redirect("offices/region");
   //       }
   //    }

   //    $this->data['meta_title'] = 'Set Region Scouts Username';
   //    $this->data['subview'] = 'region_set_username';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }
   

   // public function region_reset($id){
   //    if($this->ion_auth->is_admin()){
   //       $this->Offices_model->region_reset_username($id); 
   //       $this->session->set_flashdata('success', 'Reset region username successfully.');
   //       redirect("offices/region");
   //    }else{
   //       redirect('dashboard');
   //    }
   // }

   // public function upazila_reset($id){
   //    if($this->ion_auth->is_admin()){
   //       $this->Offices_model->upazila_reset_username($id); 
   //       $this->session->set_flashdata('success', 'Reset upazila username successfully.');
   //       redirect("offices/upazila");
   //    }else{
   //       redirect('dashboard');
   //    }
   // }



    // Cross Check Upazila Office Access 
   // if($districtInfo->dis_type == 1) {
   //    if(!$this->Offices_model->check_office_access_upazila($districtInfo->dis_scout_region_id, $districtInfo->id, $this->input->get('upazila'))){
   //       $this->access_denied();
   //    }
   // }elseif(!$this->Offices_model->check_office_access_district($districtInfo->dis_scout_region_id, $districtInfo->id)){
   //    $this->access_denied();
   // }


}