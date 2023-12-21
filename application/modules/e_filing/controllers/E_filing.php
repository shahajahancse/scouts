<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
defined('BASEPATH') OR exit('No direct script access allowed');

class E_filing extends Backend_Controller {
    var $img_path;
    public function __construct(){
        parent::__construct();
        $this->data['module_name'] = 'ই-চিঠি';
        
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('E_filing_model');
        $this->load->model('e_nathi/E_nathi_model');

        $this->img_path = realpath(APPPATH . '../efile_img');

        $this->data['user'] = $this->ion_auth->user()->row(); 
     
    }

    public function index(){
        redirect('E_filing/file_process');
    }

    public function file_process($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_filing_model->get_file_list('file_desk', $this->data['user']->emp_designation);

        $this->data['meta_title'] ='প্রক্রিয়াকরণ চিঠি তালিকা ';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function file_copy($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_filing_model->get_file_list1('file_copy', $this->data['user']->emp_designation);

        $this->data['meta_title'] ='অনুলিপি চিঠি তালিকা ';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function file_list($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_filing_model->get_file_list2('created_department', $this->data['user']->emp_department);

        $this->data['meta_title'] ='চলমান চিঠি তালিকা ';
        $this->data['subview'] = 'all2';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function file_done($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_filing_model->get_file_done_list();

        $this->data['meta_title'] ='অনুমোদিত চিঠি তালিকা ';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('file_memorandum', 'File Memorandum', 'required|trim');
        $this->form_validation->set_rules('date', 'date', 'required|trim');
        
        $this->form_validation->set_rules('file_from', 'File From', 'required|trim');
        $this->form_validation->set_rules('file_to', 'File To', 'required|trim');
        $this->form_validation->set_rules('file_subject', 'File Subject', 'required|trim');
        $this->form_validation->set_rules('file_message', 'File Message', 'required|trim');

        $this->form_validation->set_rules('nathi_id', 'Nathi No', 'trim');
       
        $this->form_validation->set_rules('file_copy[]', 'File Copy', 'trim');

        if ($this->form_validation->run() == true){

            // $this->db->trans_begin();

            $file_copy=implode(',', $this->input->post('file_copy'));


            $form_letter = array(
                'file_memorandum'               => $this->input->post('file_memorandum'),
                'date'                          => date_db_format($this->input->post('date')),
                'file_from'                     => $this->input->post('file_from'),
                'file_to'                       => $this->input->post('file_to'),
                'file_subject'                  => $this->input->post('file_subject'),
                'file_message'                  => $this->input->post('file_message'),
                'file_approval'                 => $this->input->post('nathi_id'),
                'file_copy'                     => $file_copy,
                'department'                    => $this->data['user']->emp_department,
                'created_by'                    => $this->data['user']->id,
                'created_department'            => $this->data['user']->emp_department,
                'created_designation'           => $this->data['user']->emp_designation,
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            ); 


            // Image Upload
             if($_FILES['userfile']['size'] > 0){

                $new_file_name = time().'-'.$_FILES["userfile"]['name'];
                $config['allowed_types']= 'jpg|png|jpeg';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload()){
                   $uploadData = $this->upload->data();
                   $uploadedFile = $uploadData['file_name'];
                   // print_r($uploadedFile);
                }else{
                   $this->data['message'] = $this->upload->display_errors();
                }
             }

             if($_FILES['userfile']['size'] > 0){
                $form_letter['file_name'] = $uploadedFile;
             }

            if($this->Common_model->save('e_filie', $form_letter)){
                $last_insert_letter_id = $this->db->insert_id();

                $form_log = array(
                    'file_id'                       => $last_insert_letter_id,
                    'from_department'               => $this->data['user']->emp_department,
                    'from_designation'              => $this->data['user']->emp_designation,
                    'to_department'                 => $this->data['user']->emp_department,
                    'to_designation'                => $this->data['user']->emp_department,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s'),
                    'status'                        => 1
                );

                $this->Common_model->save('e_file_log', $form_log);

                $this->session->set_flashdata('success', 'উক্ত চিঠি  সংরক্ষণ ও প্রেরণ করা হয়েছে।');
                // redirect(base_url('E_filing/create'));
            }
           
            // if ($this->db->trans_status() === FALSE){
            //     $this->db->trans_rollback();
            //     $this->session->set_flashdata('success', 'সংরক্ষণ করা সম্ভাব হয় নাই।');
            // }else{
            //     $this->db->trans_commit();
            //     $this->session->set_flashdata('success', 'উক্ত চিঠি  সংরক্ষণ ও প্রেরণ করা হয়েছে।');
            //     redirect(base_url('E_filing/create'));
            // }  

        }elseif($this->session->flashdata('success')) {
           redirect(base_url('E_filing/create'));
        }

        $this->data['nathi_list'] = $this->E_nathi_model->get_dropdown('e_nathi',  'nathi_no', 'id', $this->data['user']->emp_department);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');
        
        // Load page
        $this->data['meta_title'] = 'নতুন চিঠি তৈরি করুন';
        $this->data['subview'] = 'create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['file'] = $this->E_filing_model->get_file($id);

        $this->data['note'] = $this->E_filing_model->get_note($id);

        $this->data['log'] = $this->E_filing_model->get_log($id);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');
        // Load page
         $this->data['meta_title'] = 'বিস্তারিত';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function approved($id){

            $form_letter = array(
                'status' => 2
            ); 

            $this->Common_model->edit('e_filie', $id, 'id', $form_letter);

            $this->session->set_flashdata('success', 'উক্ত চিঠি অনুমোদন করা হয়েছে।');

            redirect(base_url('E_filing/details/'.$id));
    }

    public function forward($id){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('file_desk', 'File Desk', 'required|trim');
        $this->form_validation->set_rules('file_copy[]', 'File Copy', 'trim');

        if ($this->form_validation->run() == true){

            $file_copy=implode(',', $this->input->post('file_copy'));
            $form_letter = array(
                'file_desk'                     => $this->input->post('file_desk'),
                'file_copy'                     => $file_copy,
            ); 

            $this->Common_model->edit('e_filie', $id, 'id', $form_letter);


            $form_log = array(
                'file_id'                       => $id,
                'from_department'               => $this->data['user']->emp_department,
                'from_designation'              => $this->data['user']->emp_designation,
                'to_department'                 => $this->data['user']->emp_department,
                'to_designation'                => $this->input->post('file_desk'),
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            );

            $this->Common_model->save('e_file_log', $form_log);

            $this->session->set_flashdata('success', 'উক্ত চিঠি স্থানান্তরণ করা হয়েছে।');

            redirect(base_url('E_filing/details/'.$id));
        }

    }

    public function note($id){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('note', 'note', 'required|trim');

        if ($this->form_validation->run() == true){

            $file_copy=implode(',', $this->input->post('file_copy'));
            $form_letter = array(
                'note'                     => $this->input->post('note'),
                'file_id'                  => $id,
                'department_id'            => $this->data['user']->emp_department,
                'user_id'                  => $this->data['user']->id,
                'designation_id'           => $this->data['user']->emp_designation,
                'created_at'               => date('Y-m-d H:i:s'),
                'updated_at'               => date('Y-m-d H:i:s'),
                'status'                   => 1
            ); 

            $this->Common_model->save('e_file_note', $form_letter);

            $this->session->set_flashdata('success', 'উক্ত চিঠিে মন্তব্য প্রদান  করা হয়েছে।');

            redirect(base_url('E_filing/details/'.$id));
        }
    }

    public function getPreview(){
        
        $this->data['info'] = $this->input->post();

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['department'] = $this->Common_model->get_single_ingo('department','id',$this->data['user']->emp_department);
       $this->data['designation'] = $this->Common_model->get_single_ingo('designation','id',$this->data['user']->emp_designation);
         // Load page;
        $this->data['subview'] = 'get_preview';
        $this->load->view('backend/ajax_layout', $this->data);

    }

    public function file_check($str){
      $this->load->helper('file');
      $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
      $mime = get_mime_by_extension($_FILES['userfile']['name']);
      $file_size = 100000; 
      $size_kb = '1MB';

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

}