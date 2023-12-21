<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pds extends Backend_Controller {
   var $userSessID;
   var $img_path;
   var $emp_qr_path;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'PDS';
      $this->load->model('Pds_model');
      $this->userSessID = $this->session->userdata('user_id');
      $this->img_path = realpath(APPPATH . '../employee_img');
      $this->emp_qr_path = realpath(APPPATH . '../emp_qrcode_img');
   }

   public function index(){
      redirect('dashboard');
   }

   public function pdf_id_card($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pds', 'id', $dataID)) { 
         show_404('pds - pdf_id_card - exitsts', TRUE);
      }
      
      // Generate QR Code
      $this->emp_qrcode_generator($dataID);

      // Scout Information      
      $this->data['info'] = $this->Pds_model->get_info($dataID);
      // echo $this->data['info']->created_on; exit;        

      //Generate HTML
      $html = $this->load->view('id/pdf_id_card_front', $this->data, true);
      $html2 = $this->load->view('id/pdf_id_card_back', $this->data, true);    

      $mpdf = new mPDF('', array(225, 349), 10, 'arial', 0, 0, 0, 0);
      $file_name ="pds-id-".$this->data['info']->pds_id.".pdf";
      
      $mpdf->showImageErrors = true;
      $mpdf->debug = true;
      //$mpdf->img_dpi = 72;

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);
      $mpdf->AddPage(); // Adds a new page in Landscape orientation
      $mpdf->WriteHTML($html2);

      //download it for 'D'. 
      $mpdf->Output($file_name, 'I');
   }

   public function details($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pds', 'id', $dataID)) { 
         show_404('pds - details - exitsts', TRUE);
      }

      //Results
      $results = $this->Pds_model->get_pds_details($dataID); 
      $this->data['info'] = $results['info'];
      $this->data['education'] = $results['education'];
      $this->data['work_station'] = $results['work_station'];

      // Load view
      $this->data['meta_title'] = 'PDS Details';
      $this->data['subview'] = 'details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function details_pdf($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pds', 'id', $dataID)) { 
         show_404('pds - details - exitsts', TRUE);
      }

      //Results
      $results = $this->Pds_model->get_pds_details($dataID); 
      $this->data['info'] = $results['info'];
      $this->data['education'] = $results['education'];
      $this->data['work_station'] = $results['work_station'];

      //...............................................................................
      $this->data['meta_title'] = "Natioanl Headquater PDS";
      $html = $this->load->view('details_pdf', $this->data, true);   
      $file_name = $results['info']->pds_id.".pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }


   public function pds_list($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }
      $limit = 25;

      //Results
      $results = $this->Pds_model->get_pds_list($limit, $offset); 

      //Result
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('pds/pds_list/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      // Load view
      $this->data['meta_title'] = 'PDS List';
      $this->data['subview'] = 'pds_list';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pds_report_pdf(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      //Results
      $this->data['results'] = $this->Pds_model->get_pds_report(); 

      // foreach ($this->data['results'] as $item) {
      //    $dataArr[$item->id] = $this->Pds_model->get_work_station_by_id($item->id); 
      // }
      // echo '<pre>';
      // print_r($dataArr); exit;

      //...............................................................................
      $this->data['meta_title'] = "PDS Report";
      $html = $this->load->view('pds_report_pdf', $this->data, true);   
      $file_name = "pds_report.pdf";

      //$mpdf = new mPDF('', array(349, 225), 10, '', 0, 0, 0, 0);
      $mpdf = new mPDF('', 'A4-L', 10, 'nikosh', 5, 5, 5, 5);

      //generate the PDF from the given html
      $mpdf->WriteHTML($html);

      //download it for 'D'. 
      $mpdf->Output($file_name, "I");
   }

   public function edit($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }      

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('pds', 'id', $dataID)) { 
         show_404('pds - edit - exitsts', TRUE);
      }

      //Results
      $results = $this->Pds_model->get_pds_details($dataID); 
      $this->data['info'] = $results['info'];
      $this->data['education'] = $results['education'];
      $this->data['work_station'] = $results['work_station'];


      // Validation
      $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      // Insert Data
      if ($this->form_validation->run() == true){

         $form_data = array(
            'name_en'      => $this->input->post('name_en'),                
            'name_bn'      => $this->input->post('name_bn'),                
            'father_name'  => $this->input->post('father_name'),                
            'mother_name'  => $this->input->post('mother_name'),                
            'dob'          => date_db_format($this->input->post('dob')),                
            'gender'       => $this->input->post('gender'), 
            'bg_id'        => $this->input->post('bg_id'), 
            'phone'        => $this->input->post('phone'),                
            'email'        => $this->input->post('email'), 
            'religion_id'  => $this->input->post('religion_id'), 
            'passport_no'  => $this->input->post('passport_no'), 
            'passport_issue'  => date_db_format($this->input->post('passport_issue')), 
            'passport_expire' => date_db_format($this->input->post('passport_expire')), 
            'ms_id'           => $this->input->post('ms_id'), 
            'spous_name'      => $this->input->post('spous_name'), 
            'child_no'        => $this->input->post('child_no'), 
            'present_address' => $this->input->post('present_address'), 
            'permanent_address' => $this->input->post('permanent_address'), 
            'join_date'       => date_db_format($this->input->post('join_date')), 
            'type'            => $this->input->post('type'), 
            'current_desig'   => $this->input->post('current_desig'), 
            'current_working_area'  => $this->input->post('current_working_area'),
            'scout_id'        => strtoupper($this->input->post('scout_id')), 
            'contirbutions'   => $this->input->post('contirbutions'), 
            'hobby'           => $this->input->post('hobby') 
            );
         // print_r($form_data); exit;

         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            //$new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $pdsID;
            $config['max_size']     = 600;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $config = array(
                  'source_image' => $uploadData['full_path'],
                  'new_image' => $this->img_path,
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

         if($_FILES['userfile']['size'] > 0){
            $form_data['image_file'] = $uploadedFile;
         }


         // print_r($form_data); exit;
         if($this->Common_model->edit('pds',  $dataID, 'id', $form_data)){
            /***********Activity Logs Start**********/
            //$insert_id = $this->db->insert_id();
            func_activity_log(2, 'Update pds data :'.$dataID); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
            /***********Activity Logs End**********/

            // Education 
            for ($i=0; $i<sizeof($_POST['exam_id']); $i++) { 
               //check exists data
               @$data_edu_exists = $this->Common_model->exists('pds_education', 'id', $_POST['hide_exam_id'][$i]);
               if($data_edu_exists){
                  $education_data = array(
                     'exam_id'         => $_POST['exam_id'][$i],
                     'institute_board' => $_POST['institute_board'][$i],
                     'result'          => $_POST['result'][$i],
                     'pass_year'       => $_POST['pass_year'][$i],
                     ); 
                  $this->Common_model->edit('pds_education', $_POST['hide_exam_id'][$i], 'id', $education_data);
               }else{
                  $education_data = array(
                     'data_id'         => $dataID,
                     'exam_id'         => $_POST['exam_id'][$i],
                     'institute_board' => $_POST['institute_board'][$i],
                     'result'          => $_POST['result'][$i],
                     'pass_year'       => $_POST['pass_year'][$i],
                     );
                  $this->Common_model->save('pds_education', $education_data);
               }
            }

            // Working Station
            for ($i=0; $i<sizeof($_POST['working_place']); $i++) { 
               //check exists data
               @$data_work_exists = $this->Common_model->exists('pds_education', 'id', $_POST['hide_work_station_id'][$i]);
               if($data_work_exists){
                  $work_station_data = array(
                     'working_place' => $_POST['working_place'][$i],
                     'designation'   => $_POST['designation'][$i],
                     'date_from'     => date_db_format($_POST['date_from'][$i]),
                     'date_to'       => date_db_format($_POST['date_to'][$i]),
                     ); 
                  $this->Common_model->edit('pds_work_station', $_POST['hide_work_station_id'][$i], 'id', $work_station_data);
               }else{
                  $work_station_data = array(
                     'data_id'       => $dataID,
                     'working_place' => $_POST['working_place'][$i],
                     'designation'   => $_POST['designation'][$i],
                     'date_from'     => date_db_format($_POST['date_from'][$i]),
                     'date_to'       => date_db_format($_POST['date_to'][$i]),
                     );
                  $this->Common_model->save('pds_work_station', $work_station_data);
               }
            }

            $this->session->set_flashdata('success', 'Update PDS data successfully.');
            redirect("pds/pds_list");
         }

      }

      // dropdown list
      $this->data['religions'] = $this->Common_model->set_religion(); 
      $this->data['days'] = $this->Common_model->get_days(); 
      $this->data['months'] = $this->Common_model->get_months(); 
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      $this->data['marital_status'] = $this->Common_model->get_marital_status(); 
      $this->data['exams'] = $this->Common_model->get_exam(); 

      // Load page
      $this->data['meta_title'] = 'PDS Update';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }




   public function add(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      // Validation
      $this->form_validation->set_rules('name_en', 'name english', 'required|trim');
      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      // Insert Data
      if ($this->form_validation->run() == true){
         // Generate employee ID
         $last_emp_id = $this->Pds_model->get_last_pds_id(); // exit;
         // $pdsID = 'NHQ1001';
         $exp = explode("BS", $last_emp_id);
         $newNunmber = $exp[1]+1;
         $pdsID = 'BS'.$newNunmber;

         $form_data = array(
            'pds_id'       => $pdsID,                
            'name_en'      => $this->input->post('name_en'),                
            'name_bn'      => $this->input->post('name_bn'),                
            'father_name'  => $this->input->post('father_name'),                
            'mother_name'  => $this->input->post('mother_name'),                
            'dob'          => date_db_format($this->input->post('dob')),                
            'gender'       => $this->input->post('gender'), 
            'bg_id'        => $this->input->post('bg_id'), 
            'phone'        => $this->input->post('phone'),                
            'email'        => $this->input->post('email'), 
            'religion_id'  => $this->input->post('religion_id'), 
            'passport_no'  => $this->input->post('passport_no'), 
            'passport_issue'  => date_db_format($this->input->post('passport_issue')), 
            'passport_expire' => date_db_format($this->input->post('passport_expire')), 
            'ms_id'           => $this->input->post('ms_id'), 
            'spous_name'      => $this->input->post('spous_name'), 
            'child_no'        => $this->input->post('child_no'), 
            'present_address' => $this->input->post('present_address'), 
            'permanent_address' => $this->input->post('permanent_address'), 
            'join_date'       => date_db_format($this->input->post('join_date')), 
            'type'            => $this->input->post('type'), 
            'current_desig'   => $this->input->post('current_desig'), 
            'current_working_area'  => $this->input->post('current_working_area'),
            'scout_id'        => strtoupper($this->input->post('scout_id')), 
            'contirbutions'   => $this->input->post('contirbutions'), 
            'hobby'           => $this->input->post('hobby'),
            'created_on'      => date('Y-m-d')
            );
         // print_r($form_data); exit;

         // Image Upload
         if($_FILES['userfile']['size'] > 0){
            //$new_file_name = time().'-'.$_FILES["userfile"]['name'];
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path;
            $config['file_name']    = $pdsID;
            $config['max_size']     = 600;

            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload()){
               $uploadData = $this->upload->data();
               $config = array(
                  'source_image' => $uploadData['full_path'],
                  'new_image' => $this->img_path,
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

         if($_FILES['userfile']['size'] > 0){
            $form_data['image_file'] = $uploadedFile;
         }


         if($this->Common_model->save('pds', $form_data)){   
            //last personal data id
            $lastID = $this->db->insert_id();

            // Education 
            for ($i=0; $i<sizeof($_POST['exam_id']); $i++) { 
               $education_data = array(
                  'data_id'         => $lastID,
                  'exam_id'         => $_POST['exam_id'][$i],
                  'institute_board' => $_POST['institute_board'][$i],
                  'result'          => $_POST['result'][$i],
                  'pass_year'       => $_POST['pass_year'][$i],
                  );
               $this->Common_model->save('pds_education', $education_data);
            }

            // Working Station 
            for ($i=0; $i<sizeof($_POST['working_place']); $i++) { 
               $work_station_data = array(
                  'data_id'       => $lastID,
                  'working_place' => $_POST['working_place'][$i],
                  'designation'   => $_POST['designation'][$i],
                  'date_from'     => date_db_format($_POST['date_from'][$i]),
                  'date_to'       => date_db_format($_POST['date_to'][$i]),
                  );
               $this->Common_model->save('pds_work_station', $work_station_data);
            }

            // Success Message
            $this->session->set_flashdata('success', 'PDS data insert successfully.');
            redirect("pds/pds_list");
         }
      }

      // dropdown list
      $this->data['religions'] = $this->Common_model->set_religion(); 
      $this->data['days'] = $this->Common_model->get_days(); 
      $this->data['months'] = $this->Common_model->get_months(); 
      $this->data['years'] = $this->Common_model->get_years();
      $this->data['blood_group'] = $this->Common_model->get_blood_group();
      $this->data['divisions'] = $this->Common_model->get_division(); 
      $this->data['districts'] = $this->Common_model->get_district(); 
      $this->data['upazilas'] = $this->Common_model->get_upazila_thana(); 
      $this->data['marital_status'] = $this->Common_model->get_marital_status(); 
      $this->data['exams'] = $this->Common_model->get_exam(); 

      // Load page
      $this->data['meta_title'] = 'PDS Add';
      $this->data['subview'] = 'add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   function ajax_pds_education_del($id){
      $this->Common_model->delete('pds_education', 'id', $id);
      echo 'This information remove from database.';
   }

   function ajax_pds_work_station_del($id){
      $this->Common_model->delete('pds_work_station', 'id', $id);
      echo 'This information remove from database.';
   }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 524288; 
      $size_kb = '512 KB';

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






   /************************ National Committee ********************
   /****************************************************************/

   public function ajax_get_scouts_member_info($id){
      header('Content-Type: application/x-json; charset=utf-8');
      echo (json_encode($this->Award_model->get_scouts_member_info($id)));
         // print_r($info);
   }

   public function recommendation_form(){
      //scout office
      $region = NULL;
      $district = NULL;
      $upazila = NULL;
      $group = NULL;

      //Check authentication
      if($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){ 
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
      $this->form_validation->set_rules('circular_id', 'select award circular', 'required|trim');
      $this->form_validation->set_rules('recom_award_id', 'select recommendation award', 'required|trim');
      $this->form_validation->set_rules('memberType', 'select member type', 'required|trim');      
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

      if($this->input->post('memberType')){
         $this->form_validation->set_rules('scout_member_id', 'select scout id', 'required|trim');         
      }


      if ($this->form_validation->run() == true){
         $form_data = array(            
            'sc_region_id'      => $region,
            'sc_district_id'    => $district,
            'sc_upzaila_id'     => $upazila,
            'sc_group_id'       => $group,
            'circular_id'       => $this->input->post('circular_id'),
            'recom_award_id'    => $this->input->post('recom_award_id'),
            'recom_member_type' => $this->input->post('memberType'),    
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
            'created'           => date('Y-m-d H:i:s')
            );          
         // print_r($form_data); exit;

         if($this->Common_model->save('award_recommendation', $form_data)){   
            //last personal data id
            $lastID = $this->db->insert_id();

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
            redirect("award/circular_list");
         }
      }

      //Dropdown
      
      $this->data['award_circular_dd'] = $this->Award_model->get_award_circular_current(); 
      $this->data['scouts_award'] = $this->Common_model->get_scouts_nhq_award(); 
      $this->data['office_type'] = $this->Common_model->get_all('*','office_type','1');
      $this->data['designation_type'] = $this->Common_model->get_all('*','committee_designation','1');
      $this->data['nhq_awards'] = $this->Common_model->get_all('*','scout_nhq_award','1');

      // Load page
      $this->data['meta_title'] = 'Scouts Group Recommendation Form';
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
      $this->data['scouter_respon'] = $results['scouter_respon'];
      $this->data['non_exe_respon'] = $results['non_exe_respon'];
      $this->data['award_achived']  = $results['award_achived'];

      
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
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
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


   

   public function recommendation_status($id){           
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - recommendation_status - exitsts', TRUE);
      }

      // Results
      $this->data['info'] = $this->Award_model->get_recommendation_status($dataID);
      // print_r($this->data['info']); exit;

      // Load view
      $this->data['meta_title'] = 'Recommendation Status';
      $this->data['subview'] = 'recommendation_status';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function approve_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - approve_status - exitsts', TRUE);
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
      if($this->Common_model->edit('award_recommendation', $dataID, 'id', $form_data)){
         $this->session->set_flashdata('success', 'Recommendation approved successfully.'); 
      }else{
         $this->session->set_flashdata('warning', 'Something is wrong.');
      }

      // Redirect
      redirect('award/recommendation_status/'.encrypt_url($dataID));
   }

   public function reject_status($id){           
      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('award_recommendation', 'id', $dataID)) { 
         show_404('award - reject_status - exitsts', TRUE);
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
      if($this->ion_auth->is_admin()){ 
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


   

   public function circular_create(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      //Validation
      $this->form_validation->set_rules('circular_title', 'circular title','required|trim|max_length[255]');
      // $this->form_validation->set_rules('session_start_date', 'committee session', 'required|trim');
      // $this->form_validation->set_rules('session_end_date', 'committee session', 'required|trim');

      //Validate and input data
      if ($this->form_validation->run() == true){
         $form_data = array(
            'circular_title' => $this->input->post('circular_title'),
            'group_end_date' => date_db_format($this->input->post('group_end_date')),
            'upazila_end_date' => date_db_format($this->input->post('upazila_end_date')),
            'district_end_date' => date_db_format($this->input->post('district_end_date')),
            'region_end_date' => date_db_format($this->input->post('region_end_date')),
            );

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
      // $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 

      //Load view
      $this->data['meta_title'] = 'Create Award Circular';
      $this->data['subview'] = 'circular_create';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function circular_update($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){      
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
            'circular_title' => $this->input->post('circular_title'),
            'group_end_date' => date_db_format($this->input->post('group_end_date')),
            'upazila_end_date' => date_db_format($this->input->post('upazila_end_date')),
            'district_end_date' => date_db_format($this->input->post('district_end_date')),
            'region_end_date' => date_db_format($this->input->post('region_end_date')),
            'status'   => $this->input->post('status')
            );

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
      // $this->data['committee_type_dd'] = $this->Common_model->get_comm_type_by_office('1'); 
      //Results
      $this->data['info'] = $this->Award_model->get_award_circular_info($circularID); 
      
      //Load view
      $this->data['meta_title'] = 'Update Award Circular';
      $this->data['subview'] = 'circular_update';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function recommendation_delete($id, $circularID){  
      // Check Authentication
      if(!$this->ion_auth->is_admin()){
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














   /*************national_pdf function pdf start**************/
   public function national_pdf(){
      //Results
      $this->data['results'] = $this->Award_model->get_national_committee();
      
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
      $results = $this->Award_model->get_national_committee_info($committeeID); 
      $this->data['info'] = $results['info'];
      $this->data['members'] = $results['members'];

      // Load page
      $this->data['meta_title'] = $this->data['info']->committee_name.' Details';
      $this->data['subview'] = 'national_details';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function national_manage_member($id){
      if(!$this->ion_auth->is_group_admin()){
         redirect('dashboard');
      }

      $committeeID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('committee_national', 'id', $committeeID)) { 
         show_404('committee - national_manage_member - exitsts', TRUE);
      }

      //Results
      $results = $this->Award_model->get_national_committee_info($committeeID); 
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

      $results = $this->Award_model->get_national_committee_info($committeeID); 
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
            $validate_insert = $this->Award_model->get_member_check_duplicate($form_data);
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

      $alldt = $this->Award_model->get_national_committee_member($form_data);
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


   /************************** Generate QR Code ******************************
   ***************************************************************************/

   public function emp_qrcode_generator($id){
      // echo FCPATH;
      $info = $this->Pds_model->get_info($id);
      //echo '<pre>';
      //print_r($info); exit;
      $pdsid   = $info->pds_id;
      $url     = base_url("official-id/").$pdsid;

      // $pdsid = $info->pds_id;
      // $blood_group = $info->bg_name_en;
      // $name = $info->name_en;
      // $designation = $info->current_desig;
      // $working_area = $info->current_working_area;
      // $father = $info->father_name;
      // $mother = $info->mother_name;
      // $phone = $info->phone;
      // $issue_date = date('d F, Y', strtotime($info->created_on));
      // $expire_date = date('d F, Y', strtotime("31-12-2020")); 
      // $scout_id = strtoupper($info->scout_id);
      // $email = $info->email;
      // $full_pre_add = $info->present_address;
      // $nid = '';
      // $occupation = '';
      // $scout_designation = '';
      // $emergency_no = '';
      // $dob = date('d F, Y', strtotime($info->dob));


      $codeContents = 'URL: '.$url;
      // $codeContents = 'Name: '.$name."\n"; 
      // $codeContents .= 'Father Name: '.$father."\n"; 
      // $codeContents .= 'Mother Name: '.$mother."\n"; 
      // $codeContents .= 'Birth Date: '.$dob."\n"; 
      // $codeContents .= 'Blood Group: '.$blood_group."\n"; 
      // $codeContents .= 'Email Address: '.$email."\n"; 
      // $codeContents .= 'Emergency No: '.$emergency_no."\n"; 
      // $codeContents .= 'Occupation: '.$occupation."\n"; 
      // $codeContents .= 'Date of Issue: '.$issue_date."\n"; 
      // $codeContents .= 'Date of Expiry: '.$expire_date."\n"; 
      // $codeContents .= 'NID No: '.$nid."\n"; 
      // $codeContents .= 'Scout ID: '.$scout_id."\n"; 
      // $codeContents .= 'Scouting Designation: '.$scout_designation."\n"; 
      // $codeContents .= 'Present Address: '.$full_pre_add."\n"; 

      $data['img_url']="";
      $this->load->library('ciqrcode');
      $qr_image=$id.'.png';
      // print_r($codeContents); exit();

      $params['data'] = $codeContents;
      $params['level'] = 'H';
      $params['size'] = 8;
      $params['savename'] = $this->emp_qr_path."/".$qr_image;

      if($this->ciqrcode->generate($params)){
         $this->Pds_model->set_emp_qrcode($id, $qr_image);
         $data['img_url']=$qr_image;
      }

      //$this->load->view('qrcode', $data);
      return true;
   }


}