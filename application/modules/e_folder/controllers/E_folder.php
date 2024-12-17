<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
defined('BASEPATH') OR exit('No direct script access allowed');

class E_folder extends Backend_Controller {
    var $img_path;
    public function __construct(){
        parent::__construct();
        $this->data['module_name'] = 'ই-ফোল্ডার';
        
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('E_folder_model');

        $this->data['user'] = $this->ion_auth->user()->row(); 
     
    }

    public function index(){
        redirect('E_folder/all');
    }

    public function all($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_folder_model->get_data('e_folder',$this->data['user']->emp_department);

        $this->data['meta_title'] ='ফোল্ডার তালিকা';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function create(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('name', 'Folder Name', 'required|trim');
        

        if ($this->form_validation->run() == true){

            $file_copy=implode(',', $this->input->post('file_copy'));


            $form_data = array(
                'name'                          => $this->input->post('name'),
                'department'                    => $this->data['user']->emp_department,
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            ); 


            if($this->Common_model->save('e_folder', $form_data)){

                $this->session->set_flashdata('success', 'উক্ত ফোল্ডার  সংরক্ষণ করা হয়েছে।');
                redirect(base_url('e_nathi/nathi_list'));
            }

        }
        
        // Load page
        $this->data['meta_title'] = 'নতুন ফোল্ডার তৈরি করুন';
        $this->data['subview'] = 'add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['info']=$this->E_folder_model->get_info('e_folder', $id);

        $this->form_validation->set_rules('name', 'Folder Name', 'required|trim');
        

        if ($this->form_validation->run() == true){

            $file_copy=implode(',', $this->input->post('file_copy'));


            $form_data = array(
                'name'               => $this->input->post('name'),
                // 'status'             => $this->input->post('status'),
            ); 


            if($this->Common_model->edit('e_folder',$id, 'id', $form_data)){

                $this->session->set_flashdata('success', 'উক্ত ফোল্ডার  সম্পাদন করা হয়েছে।');
                redirect(base_url('e_nathi/nathi_list'));
            }

        }
        
        // Load page
        $this->data['meta_title'] = 'ফোল্ডার সম্পাদন করুন';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

}