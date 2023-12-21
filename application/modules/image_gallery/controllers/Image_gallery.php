<?php defined('BASEPATH') OR exit('No direct script access allowed');
   
class Image_gallery extends Backend_Controller {
   var $userSessID;
   var $img_path;

   public function __construct(){
      parent::__construct();
      $this->data['module_name'] = 'Image Gallery';

      if (!$this->ion_auth->logged_in()):
         redirect('login');
      endif;

      $this->load->model('Image_gallery_model');
      $this->load->model('committee/Committee_model');
      $this->img_path = realpath(APPPATH . '../image_gallery');
      $this->userSessID = $this->session->userdata('user_id');      
   }

   public function index(){
      $sc_group_id = NULL;
      $sc_upazila_id = NULL;
      $sc_district_id = NULL;
      $region_id = NULL;

      if($this->ion_auth->is_group_admin()){
         $sc_group_id = $this->Committee_model->get_current_scout_group_from_committee($this->session->userdata('user_id'))->office_sc_group_id;
      }elseif($this->ion_auth->is_upazila_admin()){
         $sc_upazila_id = $this->Committee_model->get_current_upazila_thana_from_committee($this->session->userdata('user_id'))->office_upa_tha_id;
      }elseif($this->ion_auth->is_district_admin()){
         $sc_district_id = $this->Committee_model->get_current_district_from_committee($this->session->userdata('user_id'))->office_district_id;
      }elseif($this->ion_auth->is_region_admin()){
         $region_id = $this->Committee_model->get_current_region_from_committee($this->session->userdata('user_id'))->office_region_id;
      }

      $uploadedFile='';
      $this->form_validation->set_rules('userfile', 'image', 'required|trim');

      if(@$_FILES['userfile']['size'] > 0){
         $this->form_validation->set_rules('userfile', '', 'callback_file_check');
      }

      if ($this->form_validation->run() == true){
         $new_file_name = $this->userSessID.'-'.time();
         $config['allowed_types']= 'jpg|png|jpeg|gif';
         $config['upload_path']  = $this->img_path;
         $config['file_name']    = $new_file_name;
         $config['max_size']     = 5120;

         $this->load->library('upload', $config);
         if($this->upload->do_upload()){
            $uploadData = $this->upload->data();
            $uploadedFile = $uploadData['file_name'];

            $config = array(
               'source_image' => $uploadData['full_path'],
               'new_image' => $this->img_path,
               'maintain_ratio' => TRUE,
               'width' => 800,
               'height' => 600
               );
            $this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $form_data = array(
               'ig_file_name'    => $uploadedFile,
               'ig_group_id'     => $sc_group_id,
               'ig_upazila_id'   => $sc_upazila_id,
               'ig_district_id'  => $sc_district_id,
               'ig_region_id'    => $region_id,
               'user_id'         => $this->userSessID
            );
            $this->Common_model->save('image_gallery', $form_data);
            $this->session->set_flashdata('message', 'File has been uploaded successfully.');
         }else{
            $this->session->set_flashdata('message', $this->upload->display_errors());
         }
      }      

      if($this->ion_auth->is_group_admin()){
         $this->data['images'] = $this->Image_gallery_model->get_image_gallery('','','',$sc_group_id);
      }elseif($this->ion_auth->is_upazila_admin()){
         $this->data['images'] = $this->Image_gallery_model->get_image_gallery('','',$sc_upazila_id,'');
      }elseif($this->ion_auth->is_district_admin()){
         $this->data['images'] = $this->Image_gallery_model->get_image_gallery('',$sc_district_id,'','');
      }elseif($this->ion_auth->is_region_admin()){
         $this->data['images'] = $this->Image_gallery_model->get_image_gallery($region_id,'','','');
      }else{
         $this->data['images'] = $this->Image_gallery_model->get_image_gallery();
      }

      $this->data['meta_title'] = 'Image Upload';
      $this->data['subview'] = 'upload_image';
      $this->load->view('backend/_layout_main', $this->data);
   }

   public function delete_img($id){      
      // echo $id; exit;
      $this->Image_gallery_model->delete($id);      
      $this->session->set_flashdata('message', 'Image delete successfully.');
      redirect('image_gallery/index');
   }

   // public function index(){      
   //    $this->data['meta_title'] = 'Image Gallery';
   //    $this->data['subview'] = 'index';
   //    $this->load->view('backend/_layout_main', $this->data);
   // }

   public function imageUploadPost()
   {
      $config['upload_path']   = $this->img_path_gallery; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $config['max_size']      = 1024;

      $this->load->library('upload', $config);
      $this->upload->do_upload('file');

      print_r('Image Uploaded Successfully.');
      exit;
   }

   public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 5242880; // 2097152, 1048576  
      $size_kb = '5 MB';

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