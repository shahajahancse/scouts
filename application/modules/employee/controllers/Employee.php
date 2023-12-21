<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends Backend_Controller {
   var $userSessID;
   var $img_path;
   var $emp_qr_path;

   public function __construct(){
      parent::__construct();

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->data['module_name'] = 'Employee / PDS';
      $this->load->model('Employee_model');
      $this->load->model('pds/Pds_model');
      $this->userSessID = $this->session->userdata('user_id');
      $this->img_path_emp = realpath(APPPATH . '../employee_img');
      $this->img_path_pro = realpath(APPPATH . '../profile_img');
      $this->emp_qr_path = realpath(APPPATH . '../emp_qrcode_img');
   }

   public function index(){
      redirect('dashboard');
   }

   public function all($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $limit = 25;

      // Superadmin
      $results = $this->Employee_model->get_employee($limit, $offset, '', '', '', '', 1);

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('employee/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
      $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

      // Load page
      $this->data['meta_title'] = 'All Employee / PDS';
      $this->data['subview'] = 'all';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function all2($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $limit = 25;

      // Superadmin
      $results = $this->Employee_model->get_employee2($limit, $offset, '', '', '', '', 1);

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('employee/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
      $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

      // Load page
      $this->data['meta_title'] = 'Professional Employee / PDS';
      $this->data['subview'] = 'all';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function deactive($offset=0){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }
      
      $limit = 25;

      // Superadmin
      $results = $this->Employee_model->get_employee($limit, $offset, '', '', '', '', 0);

      //Results
      $this->data['results'] = $results['rows'];
      $this->data['total_rows'] = $results['num_rows'];

      //pagination
      $this->data['pagination'] = create_pagination('employee/all/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

      $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
      $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

      // Load page
      $this->data['meta_title'] = 'Deactive Employee / PDS';
      $this->data['subview'] = 'all';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function pdf_id_card($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $dataID = (int) decrypt_url($id); //exit;
      if (!$this->Common_model->exists('users', 'id', $dataID)) { 
         show_404('pds - pdf_id_card - exitsts', TRUE);
      }
      
      // Generate QR Code
      $this->emp_qrcode_generator($dataID);

      // Scout Information      
      $this->data['info'] = $this->Employee_model->get_single_employee($dataID);  
      $this->data['expiry'] = $this->Common_model->get_single_ingo('emp_id_card_expiry','id',1);
      // print_r($this->data['info']); exit();     

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

   public function emp_qrcode_generator($id){
      // echo FCPATH;
      $info = $this->Common_model->get_single_ingo('users','id',$id);
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

      $params['data'] = $codeContents;
      $params['level'] = 'H';
      $params['size'] = 8;
      $params['savename'] = $this->emp_qr_path."/".$qr_image;

      // print_r($params); exit();
      if($this->ciqrcode->generate($params)){
         $this->Employee_model->set_emp_qrcode($id, $qr_image);
         $data['img_url']=$qr_image;
      }

      //$this->load->view('qrcode', $data);
      return true;
   }

   public function create(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $tables = $this->config->item('tables','ion_auth');
      $identity_column = $this->config->item('identity','ion_auth');
      $this->data['identity_column'] = $identity_column;

      $this->form_validation->set_rules('full_name', 'full name english', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name bangla', 'required|trim');
      // $this->form_validation->set_rules('emp_identity', 'Employee identity', 'required');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim');
      $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
      $this->form_validation->set_rules('department', 'Department', 'required|trim');
      $this->form_validation->set_rules('designation', 'Designation', 'required|trim');
      $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');
      $this->form_validation->set_rules('office_id_type', 'office id type', 'required|trim');
      $this->form_validation->set_rules('service_area_id', 'service area', 'required|trim');

      // $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
      // $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

      // Insert Data
      if ($this->form_validation->run() == true){

         if($this->input->post('office_id_type')==1){
            $pdsIDType=1;
         }else{
            if($this->input->post('service_area_id')<=3){
               $pdsIDType=2;
            }else{
               $pdsIDType=3;
            }
         }

         $last_emp_id = $this->Employee_model->get_last_pds_id($pdsIDType); // exit;
         if(!empty($last_emp_id)){
            $exp = explode("BSO", $last_emp_id);
            $newNunmber = str_pad($exp[1]+1, 4, '0', STR_PAD_LEFT);
            $pdsID = 'BSO'.$newNunmber;
         }else{
            if($pdsIDType==1){
               $pdsID = 'BSO0001';
            }
            if($pdsIDType==2){
               $pdsID = 'BSO1001';
            }
            if($pdsIDType==3){
               $pdsID = 'BSO3001';
            }
         }
         

         $email    = strtolower($this->input->post('email'));
         // $identity = $this->input->post('identity');
         // $password = $this->input->post('password');
         $identity = $pdsID;
         $password = 'BSO@2468';

         $form_data = array(         
            'is_employee'        => 1,                
            'first_name'         => $this->input->post('full_name'),                
            'full_name_bn'       => $this->input->post('full_name_bn'),                
            'pds_id'             => $pdsID,                
            'pds_id_type'        => $pdsIDType,                
            'office_id_type'     => $this->input->post('office_id_type'),                
            'service_area_id'    => $this->input->post('service_area_id'),                
            'dob'                => $this->input->post('dob'),                
            'gender'             => $this->input->post('gender'),                
            // 'emp_identity'       => $this->input->post('emp_identity'),
            'active'             => $this->input->post('active'),                
            'desk_officer'       => $this->input->post('desk_officer'),                
            'phone'              => $this->input->post('phone'),                 
            'emp_department'     => $this->input->post('department'), 
            'emp_designation'    => $this->input->post('designation'), 
            );

            if($_FILES['userfile']['size'] > 0){

               $config['allowed_types']= 'jpg|png|jpeg';
               $config['upload_path']  = $this->img_path_pro;
               $config['max_size']     = 400;

               $this->load->library('upload', $config);

               if($this->upload->do_upload('userfile')){
                  $uploadData = $this->upload->data();
                  $uploadedFile = $uploadData['file_name'];
                  $form_data['profile_img'] = $uploadedFile;
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }



            if($_FILES['userfile1']['size'] > 0){

               $config['allowed_types']= 'jpg|png|jpeg';
               $config['upload_path']  = $this->img_path_emp;
               $config['max_size']     = 400;

               $this->load->library('upload', $config);

               if($this->upload->do_upload('userfile1')){
                  $uploadData1 = $this->upload->data();
                  $uploadedFile1 = $uploadData1['file_name'];
                  $form_data['emp_singature'] = $uploadedFile1;
               }else{
                  $this->data['message'] = $this->upload->display_errors();
               }
            }
         // print_r($form_data); exit;

         $user_group = array('12');
         
         if($insert_id = $this->ion_auth->register($identity, $password, $email, $form_data, $user_group)){
            $form_data = array(
                'emp_id'                     => $insert_id,
                'emp_department'             => $this->input->post('department'),
                'emp_designation'            => $this->input->post('designation'),
                'status'                     => 1
            );
            $this->Common_model->save('e_nathi_department', $form_data);

            $from_email = "admin@scouts.gov.bd";
            $to_email   = $email;
            $subject    =  'User Information of '. $this->input->post('full_name');
            
            $message    =  'Congrats! <br>'. $this->input->post('full_name').'<br>';
            $message   .=  'Your login credentials of Bangladesh Scouts.<br><br>';
            $message   .=  '<b>Username: '.$identity.'</b><br>';
            $message   .=  '<b>Password: '.$password.'</b><br><br><br>';
            $message   .=  'Thanks & Regards<br><br>';
            $message   .=  'Department of Human Resources<br>';
            $message   .=  'Bangladesh Scouts<br>';
            $message   .=  'National Headquarters<br>';
            $message   .=  '60, Anjuman Mufidul Islam Road, Kakrail<br>';
            $message   .=  'Dhaka – 1000';

           //Load email library
            $this->load->library('email');
            $config = array();
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = 'mail.mysoftheaven.com';
            $config['smtp_user']    = 'mafizur@mysoftheaven.com';
            $config['smtp_pass']    = 'mafizur@420';
            $config['smtp_port']    =  587;
            $config['smtp_crypto']  = 'tls';
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            $this->email->from($from_email, 'Bangladesh Scouts');
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            // Success Message
            $this->session->set_flashdata('success', 'Employee data insert successfully.');
            redirect("employee/all");
         }
      }

      $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
      $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id'); 

      $this->data['service_area']=array(0=>'---Select one---', 1=>'General', 2=> 'National Headquarters');

      // , 3=>'Nation Training Center', 4=>'Region', 5=>'District', 6=>'Upazila'
      // Load page
      $this->data['meta_title'] = 'Employee / PDS Add';
      $this->data['subview'] = 'add';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function activation($id, $staus){
      $form_data = array(                
            'active'                => $staus,                 
      );
      if($insert_id = $this->Common_model->edit('users', $id, 'id', $form_data)){

         // Success Message
         $this->session->set_flashdata('success', 'Employee data update successfully.');
         redirect("employee/all");
      }
   }


   public function edit($id){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $this->data['info'] = $this->Common_model->get_single_ingo('users','id',$id);
      $this->data['e_nathi_department'] = $this->Common_model->e_nathi_department_list($id);

      // print_r($this->data['e_nathi_department']); exit();

      $this->form_validation->set_rules('full_name', 'full name english', 'required|trim');
      $this->form_validation->set_rules('full_name_bn', 'full name bangla', 'required|trim');
      $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim');
      $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
      // $this->form_validation->set_rules('department', 'Department', 'required|trim');
      // $this->form_validation->set_rules('designation', 'Designation', 'required|trim');
      $this->form_validation->set_rules('dob', 'date of birth', 'required|trim');
      $this->form_validation->set_rules('gender', 'gender', 'required|trim');

      // Insert Data
      if ($this->form_validation->run() == true){

         $form_data = array(         
                        
            'first_name'         => $this->input->post('full_name'),                
            'full_name_bn'       => $this->input->post('full_name_bn'),                
            'dob'                => $this->input->post('dob'),                
            'gender'             => $this->input->post('gender'),                                
            'phone'              => $this->input->post('phone'),                 
            'email'              => strtolower($this->input->post('email')),                 
            'blood_group'        => $this->input->post('blood_group'),                 
            'religion_id'        => $this->input->post('religion_id'),                 
            'nid'                => $this->input->post('nid'),                 
            'active'             => $this->input->post('active'),  
            'desk_officer'       => $this->input->post('desk_officer'),                
            'sl_no'              => $this->input->post('sl_no'),                

            // 'emp_department'     => $this->input->post('department'), 
            // 'emp_designation'    => $this->input->post('designation'), 

         );

         if($_FILES['userfile']['size'] > 0){

            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path_pro;
            $config['max_size']     = 400;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('userfile')){
               $uploadData = $this->upload->data();
               $uploadedFile = $uploadData['file_name'];
               $form_data['profile_img'] = $uploadedFile;
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }



         if($_FILES['userfile1']['size'] > 0){

            $config['allowed_types']= 'jpg|png|jpeg';
            $config['upload_path']  = $this->img_path_emp;
            $config['max_size']     = 400;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('userfile1')){
               $uploadData1 = $this->upload->data();
               $uploadedFile1 = $uploadData1['file_name'];
               $form_data['emp_singature'] = $uploadedFile1;
            }else{
               $this->data['message'] = $this->upload->display_errors();
            }
         }

         
         if($insert_id = $this->Common_model->edit('users', $id, 'id', $form_data)){
            $this->Common_model->delete('e_nathi_department', 'emp_id', $id);
            for($i=0; $i<sizeof($_POST['department']); $i++) {
               $form_data = array(
                   'emp_id'                     => $id,
                   'emp_department'             => $_POST['department'][$i],
                   'emp_designation'            => $_POST['designation'][$i],
                   'status'                     => $i==0?1:0
               );
            $this->Common_model->save('e_nathi_department', $form_data);

            }

            // Success Message
            $this->session->set_flashdata('success', 'Employee data update successfully.');
            redirect("employee/all");
         }
      }

      $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
      $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id'); 
      $this->data['religions'] = $this->Common_model->set_religion(); 
      $this->data['blood_group'] = $this->Common_model->get_blood_group();

      $this->data['service_area']=array(0=>'---Select one---', 1=>'General', 2=> 'National Headquarters');

      // , 3=>'Nation Training Center', 4=>'Region', 5=>'District', 6=>'Upazila'
      // Load page
      $this->data['meta_title'] = 'Edit Employee / PDS Add';
      $this->data['subview'] = 'edit';
      $this->load->view('backend/_layout_main', $this->data);
   }


   public function emp_id_card_expiry(){
      if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
         redirect('dashboard');
      }

      $this->data['info'] = $this->Common_model->get_single_ingo('emp_id_card_expiry','id',1);

      $this->form_validation->set_rules('professional', 'professional', 'required|trim');
      $this->form_validation->set_rules('volunteer', 'volunteer', 'required|trim');

      // Insert Data
      if ($this->form_validation->run() == true){

         $form_data = array(                                
            'professional'     => $this->input->post('professional'), 
            'volunteer'        => $this->input->post('volunteer'), 
         );

         if($insert_id = $this->Common_model->edit('emp_id_card_expiry', 1, 'id', $form_data)){
            // Success Message
            $this->session->set_flashdata('success', 'Employee ID Card Expiry Date update successfully.');
            redirect("employee/emp_id_card_expiry");
         }
      }

      $this->data['meta_title'] = 'Employee ID Card Expiry Date';
      $this->data['subview'] = 'id_expiry';
      $this->load->view('backend/_layout_main', $this->data);
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

   public function change_password($id){
      
      if(!$this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin()){
         redirect('dashboard');
      }

      $officeID = (int) decrypt_url($id);
      
      //Result
      $this->data['info'] = $this->Employee_model->get_single_employee($officeID); 
      //validation
      $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

      if ($this->form_validation->run() === TRUE){
         // finally change the password
         $identity = $this->data['info']->{$this->config->item('identity', 'ion_auth')}; //exit;

         $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
         if ($change){

            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("employee/all");
         }else{
            $this->session->set_flashdata('success', $this->ion_auth->errors());
            redirect("employee/all");
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
      $this->data['meta_title'] = 'Change Password';
      $this->data['subview'] = 'change_password';
      $this->load->view('backend/_layout_main', $this->data);
   }


}