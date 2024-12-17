<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Backend_Controller {	

    var $img_path;

    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Slider';
        $this->load->model('Common_model'); 
        $this->load->model('Slider_model');     
        $this->img_path = realpath(APPPATH . '../slider_img');
    }

    public function index(){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        $this->data['results'] = $this->Slider_model->get_data();

        // Load page
        $this->data['meta_title'] = 'Slider List';
        $this->data['subview'] = 'list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create(){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
        }

        $uploadedFile = '';
        if ($this->form_validation->run() == true){                        

            // Image Upload
            if($_FILES['userfile']['size'] > 0){
                $new_file_name = $_FILES["userfile"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1050000;

                $this->load->library('upload', $config);

                // print_r($_FILES); exit;
                //upload file to directory

                if($this->upload->do_upload('userfile')){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            // if($_FILES['userfile']['size'] > 0){
            //     $form_data['image_file'] = $uploadedFile;
            // }
            $form_data = array(
                'title'       => $this->input->post('title'),
                'image_file'       => $uploadedFile
                );
            // print_r($form_data);exit();

            if($this->Common_model->save('slider', $form_data)){                
                $this->session->set_flashdata('success', 'New slider insert successfully.');
                redirect("slider");
            } 
        }

        // Load page
        $this->data['meta_title'] = 'Add Slider';
        $this->data['subview'] = 'create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Slider_model->get_info($id);

        $this->data['meta_title'] = 'Details Slider';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){
            $form_data = array(
                'title'       => $this->input->post('title'),
                'status'        => $this->input->post('status')
                );

            if($_FILES['userfile']['size'] > 0){
                $new_file_name = $_FILES["userfile"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
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
                $form_data['image_file'] = $uploadedFile;
            }

            //print_r($form_data);exit();

            if($this->Common_model->edit('slider', $id, 'id', $form_data)){                
                $this->session->set_flashdata('success', 'Slider Update successfully.');
                redirect("slider");
            }
        }

        $this->data['info'] = $this->Slider_model->get_info($id);    

        // Load page
        $this->data['meta_title'] = 'Edit Slider';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }    

    function delete($id) {
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Slider_model->delete($id);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('slider');
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