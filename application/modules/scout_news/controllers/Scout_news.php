<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Scout_news extends Backend_Controller {	

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'Scout News';
        $this->file_path = realpath(APPPATH . '../uploads/news_file');

        $this->load->model('Common_model'); 
        $this->load->model('Scout_news_model');     
    }

    public function index(){
        redirect('scout_news/news_list');
    }

    public function create_news(){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->form_validation->set_rules('news_title', 'News Title', 'required|trim');
        $this->form_validation->set_rules('news_details', 'News Details', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'news_title'       => $this->input->post('news_title'),
                'news_details'     => $this->input->post('news_details'),
                'created_by'        => $this->session->userdata('user_id'),
                'created'           => date('Y-m-d')
                );
            //print_r($form_data);exit();

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

            if($this->Common_model->save('scout_news', $form_data)){                
                $this->session->set_flashdata('success', 'New news insert successfully.');
                redirect("scout_news/news_list");
            } 
        }

        // Load page
        $this->data['meta_title'] = 'Create News';
        $this->data['subview'] = 'create_news';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function news_list(){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->data['results'] = $this->Scout_news_model->get_data();

        // Load page
        $this->data['meta_title'] = 'News List';
        $this->data['subview'] = 'news_list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Scout_news_model->get_info($id);

        $this->data['meta_title'] = 'Details News';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->form_validation->set_rules('news_title', 'News Title', 'required|trim');
        $this->form_validation->set_rules('news_details', 'News Details', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'news_title'    => $this->input->post('news_title'),
                'news_details'  => $this->input->post('news_details'),
                'status'        => $this->input->post('status')
                );
            //print_r($form_data);exit();

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


            if($this->Common_model->edit('scout_news', $id, 'id', $form_data)){                
                $this->session->set_flashdata('success', 'News Update successfully.');
                redirect("scout_news/news_list");
            }
        }

        $this->data['info'] = $this->Scout_news_model->get_info($id);    

        // Load page
        $this->data['meta_title'] = 'Edit News';
        $this->data['subview'] = 'edit_news';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function delete($id) {
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_region_admin() || $this->ion_auth->is_district_admin() || $this->ion_auth->is_upazila_admin() || $this->ion_auth->is_group_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Scout_news_model->delete($id);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('scout_news/news_list');
    }

}