<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
defined('BASEPATH') OR exit('No direct script access allowed');

class E_nathi extends Backend_Controller {
    var $img_path;
    public function __construct(){
        parent::__construct();
        $this->data['module_name'] = 'ই-নথি';
        
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('E_nathi_model');

        $this->img_path = realpath(APPPATH . '../efile_img');

        $this->data['user'] = $this->ion_auth->user()->row(); 

        $this->data['e_nathi_department'] = $this->Common_model->e_nathi_department($this->data['user']->id);
     
    }

    public function index(){
        redirect('e_nathi/nathi_process');
    }

    public function users(){
        $this->db->select('id,emp_department,emp_designation, status');
        $this->db->from('users');
        $this->db->where('is_employee', 1);
        $query = $this->db->get()->result();
        foreach ($query as $key => $value) {
             $form_data = array(
                'emp_id'                     => $value->id,
                'emp_department'             => $value->emp_department,
                'emp_designation'            => $value->emp_designation,
                'status'                     => 1
            );
            $this->Common_model->save('e_nathi_department', $form_data);
        }
    }

    public function nathi_process($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_nathi_model->get_file_list3('nathi_desk', $this->data['e_nathi_department']->emp_designation);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id'); 
        $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

        $this->data['meta_title'] ='প্রক্রিয়াধীন  নথির প্রস্তাবনা তালিকা';
        $this->data['subview'] = 'all3';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function suggestion_list($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_nathi_model->get_file_list3('department', $this->data['e_nathi_department']->emp_department);

        $this->data['meta_title'] ='নথির প্রস্তাবনা তালিকা';
        $this->data['subview'] = 'all3';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nathi_archive($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_nathi_model->get_file_list2('department', $this->data['e_nathi_department']->emp_department, $id, 0);

        $this->data['meta_title'] ='আর্কাইভ নথির তালিকা ';
        $this->data['subview'] = 'archive';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nathi_list($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['folder']=$this->E_nathi_model->get_folder('e_folder', $this->data['e_nathi_department']->emp_department);

        $this->data['results']=$this->E_nathi_model->get_file_list2('department', $this->data['e_nathi_department']->emp_department);

        $this->data['meta_title'] =' ফোল্ডার আকারে নথি তালিকা';
        $this->data['subview'] = 'all2';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nathi_list2($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        
        $this->form_validation->set_rules('date[]', 'Date', 'required|trim');
        $this->form_validation->set_rules('folder_id[]', 'folder id', 'trim');
        $this->form_validation->set_rules('title[]', 'Titel', 'required|trim');
        $this->form_validation->set_rules('details[]', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){
            $success=0;
            for ($i=0; $i<sizeof($_POST['title']); $i++) {

                $results=$this->E_nathi_model->get_file_list('department', $this->data['e_nathi_department']->emp_department);
                $nathi_number = '00.'.str_pad($this->data['e_nathi_department']->emp_department, 2, '0', STR_PAD_LEFT).'.'.str_pad(count($results)+1, 4, '0', STR_PAD_LEFT);

                $form_data = array(
                    'nathi_no'                     => $nathi_number,
                    'date'                         => date_db_format($_POST['date'][$i]),
                    'folder_id'                    => $_POST['folder_id'][$i],
                    'title'                        => $_POST['title'][$i],
                    'details'                      => $_POST['details'][$i],
                    
                    'department'                   => $this->data['e_nathi_department']->emp_department,
                    'created_by'                   => $this->data['user']->id,
                    'created_at'                   => date('Y-m-d H:i:s'),
                    'updated_at'                   => date('Y-m-d H:i:s'),
                    'status'                       => 1
                );
                if($this->Common_model->save('e_nathi', $form_data)){
                        $last_insert_letter_id = $this->db->insert_id();

                        $form_letter = array(
                        
                        'nathi_id'                      => $last_insert_letter_id,
                        'date'                          => date('Y-m-d'),
                        'nathi_desk'                    => $this->data['e_nathi_department']->emp_designation,
                        'nathi_desk_department'         => $this->data['e_nathi_department']->emp_department,
                        'department'                    => $this->data['e_nathi_department']->emp_department,
                        'created_by'                    => $this->data['user']->id,
                        'created_department'            => $this->data['e_nathi_department']->emp_department,
                        'created_designation'           => $this->data['e_nathi_department']->emp_designation,
                        'created_at'                    => date('Y-m-d H:i:s'),
                        'updated_at'                    => date('Y-m-d H:i:s'),
                        'status'                        => 1
                    ); 

                    $this->Common_model->save('e_nathi_suggestion', $form_letter);
                    $success=1;
                }else{
                    $success=1;
                }
            }

            if($success==1){

                $this->session->set_flashdata('success', 'উক্ত নথি  সমূহ সংরক্ষণ  করা হয়েছে।');
                
                redirect(base_url('e_nathi/nathi_list2'));
            }

        }

        $this->data['results']=$this->E_nathi_model->get_file_list2('department', $this->data['e_nathi_department']->emp_department);

        $this->data['folder'] = $this->E_nathi_model->get_dropdown('e_folder',  'name', 'id', $this->data['e_nathi_department']->emp_department);

        $this->data['meta_title'] ='সকল নথি তালিকা';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nathi_edit($id){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('folder_id', 'folder id', 'trim');
        $this->form_validation->set_rules('title', 'Titel', 'required|trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){
            

            $form_data = array(
                'date'                         => date_db_format($this->input->post('date')),
                'folder_id'                    => $this->input->post('folder_id'),
                'title'                        => $this->input->post('title'),
                'details'                      => $this->input->post('details'),
                'updated_at'                   => date('Y-m-d H:i:s'),
            );

            if($this->Common_model->edit('e_nathi', $id, 'id', $form_data)){

                $this->session->set_flashdata('success', 'উক্ত নথি  সম্পাদন  করা হয়েছে।');
                
                redirect(base_url('e_nathi/nathi_list2'));
            }
                
        } 
        redirect(base_url('e_nathi/nathi_list2'));
    }

    public function e_folder($id){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['results']=$this->E_nathi_model->get_file_list2('department', $this->data['e_nathi_department']->emp_department, $id);

        $this->data['folder_name']=$this->E_nathi_model->get_info('e_folder', $id)->name;

        $this->data['meta_title'] =' নথি তালিকা';
        $this->data['subview'] = 'all4';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function nathi(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('nathi_no', 'Nathi No', 'required|trim');
        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('folder_id', 'folder id', 'trim');
        $this->form_validation->set_rules('title', 'Titel', 'required|trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){


            $form_data = array(
                'nathi_no'                     => $this->input->post('nathi_no'),
                'date'                         => date_db_format($this->input->post('date')),
                'folder_id'                    => $this->input->post('folder_id'),
                'title'                        => $this->input->post('title'),
                'details'                      => $this->input->post('details'),
                
                'department'                   => $this->data['e_nathi_department']->emp_department,
                'created_by'                   => $this->data['user']->id,
                'created_at'                   => date('Y-m-d H:i:s'),
                'updated_at'                   => date('Y-m-d H:i:s'),
                'status'                       => 1
            ); 


            if($this->Common_model->save('e_nathi', $form_data)){
                $last_insert_letter_id = $this->db->insert_id();

                $this->session->set_flashdata('success', 'উক্ত নথি  সংরক্ষণ  করা হয়েছে।');
                if(!empty($this->input->post('folder_id'))){
                    redirect(base_url('e_nathi/e_folder/'.$this->input->post('folder_id')));
                }else{
                    redirect(base_url('e_nathi/nathi_list'));
                }
            }
           

        }
        
        $this->data['folder'] = $this->E_nathi_model->get_dropdown('e_folder',  'name', 'id', $this->data['e_nathi_department']->emp_department);

        $results=$this->E_nathi_model->get_file_list('department', $this->data['e_nathi_department']->emp_department);

        $this->data['nathi_number'] = '00.'.str_pad($this->data['e_nathi_department']->emp_department, 2, '0', STR_PAD_LEFT).'.'.str_pad(count($results)+1, 4, '0', STR_PAD_LEFT);
        
        // Load page
        $this->data['meta_title'] = 'নতুন নথি তৈরি করুন';
        $this->data['subview'] = 'nathi';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function paragraph2(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('nathi_id', 'Nathi id', 'trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){


            $results=$this->E_nathi_model->get_file_list1('nathi_id', $this->input->post('nathi_id'));

            $paragraph_no= str_pad(count($results)+1, 2, '0', STR_PAD_LEFT);

            $page_id = $this->input->post('page');

            $form_data = array(
                
                'date'                         => date_db_format($this->input->post('date')),
                'nathi_id'                     => $this->input->post('nathi_id'),
                'page_id'                     => $page_id,
                'details'                      => $this->input->post('details'),
                'department'                   => $this->data['e_nathi_department']->emp_department,
                'created_by'                   => $this->data['user']->id,
                'created_at'                   => date('Y-m-d H:i:s'),
                'updated_at'                   => date('Y-m-d H:i:s'),
                'paragraph_no'                 => $paragraph_no,
                'status'                       => 1
            ); 


            if($this->Common_model->save('e_nathi_paragraph', $form_data)){
                $last_insert_id = $this->db->insert_id();

                $sl=1;
                $count = count($_FILES['userfile']['size']);
                foreach($_FILES as $key=>$value){
                    for($s=0; $s<=$count-1; $s++) {
                        $_FILES['userfile']['name']     =$value['name'][$s];
                        $_FILES['userfile']['type']     = $value['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['userfile']['error']    = $value['error'][$s];
                        $_FILES['userfile']['size']     = $value['size'][$s];   
                        
                        $config['upload_path']      = $this->img_path;
                        $config['allowed_types']    = 'jpg|jpeg|png|JPEG|JPG|PNG|PDF|DOC|pdf|doc|docx|DOCX';
                        $config['max_size']         = '0';
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload()){
                            $uploadData = $this->upload->data();
                            $uploadedFile = $uploadData['file_name'];


                            $form_image_data = array(
                                'nathi_id'          => $this->input->post('nathi_id'),
                                'paragraph_id'      => $last_insert_id,
                                'name'              => $_POST['file_name'][$s],
                                'userfile'          => $uploadedFile,
                                'created_at'        => date('Y-m-d H:i:s'),
                            );

                            $this->Common_model->save('paragraph_attachment', $form_image_data);
                            $sl++;
                        }
                    }

                }

                foreach ($this->input->post('general_attach')  as $item) {
                    $data=explode('-', $item);
                    $form_image_data = array(
                        'nathi_id'          => $this->input->post('nathi_id'),
                        'paragraph_id'      => $last_insert_id,
                        'name'              => $data[0],
                        'userfile'          => $data[1],
                        'created_at'        => date('Y-m-d H:i:s'),
                    );

                    $this->Common_model->save('paragraph_attachment', $form_image_data);
                }

                $this->session->set_flashdata('success', 'উক্ত নথির অনুচ্ছেদ সংরক্ষণ  করা হয়েছে।');
                redirect(base_url('e_nathi/details2/'.$this->input->post('page')));
            }
           

        }
        
        $this->data['nathi_list'] = $this->E_nathi_model->get_dropdown('e_nathi',  'nathi_no', 'id', $this->data['e_nathi_department']->emp_department);

        
        // Load page
        $this->data['meta_title'] = 'নতুন নথির অনুচ্ছেদ তৈরি করুন';
        $this->data['subview'] = 'paragraph';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function paragraph(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('date', 'Date', 'required|trim');
        $this->form_validation->set_rules('nathi_id', 'Nathi id', 'trim');
        $this->form_validation->set_rules('details', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){


            $results=$this->E_nathi_model->get_file_list1('nathi_id', $this->input->post('nathi_id'));

            $paragraph_no= str_pad(count($results)+1, 2, '0', STR_PAD_LEFT);

            $page_id = $this->E_nathi_model->last_page($this->input->post('nathi_id'));

            $form_data = array(
                
                'date'                         => date_db_format($this->input->post('date')),
                'nathi_id'                     => $this->input->post('nathi_id'),
                'page_id'                      => $page_id,
                'details'                      => $this->input->post('details'),
                'department'                   => $this->data['e_nathi_department']->emp_department,
                'created_by'                   => $this->data['user']->id,
                'created_at'                   => date('Y-m-d H:i:s'),
                'updated_at'                   => date('Y-m-d H:i:s'),
                'paragraph_no'                 => $paragraph_no,
                'status'                       => 1
            ); 


            if($this->Common_model->save('e_nathi_paragraph', $form_data)){
                $last_insert_id = $this->db->insert_id();

                $sl=1;
                $count = count($_FILES['userfile']['size']);
                foreach($_FILES as $key=>$value){
                    for($s=0; $s<=$count-1; $s++) {
                        $_FILES['userfile']['name']     =$value['name'][$s];
                        $_FILES['userfile']['type']     = $value['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['userfile']['error']    = $value['error'][$s];
                        $_FILES['userfile']['size']     = $value['size'][$s];   
                        
                        $config['upload_path']      = $this->img_path;
                        $config['allowed_types']    = 'jpg|jpeg|png|JPEG|JPG|PNG|PDF|DOC|pdf|doc|docx|DOCX';
                        $config['max_size']         = '0';
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload()){
                            $uploadData = $this->upload->data();
                            $uploadedFile = $uploadData['file_name'];


                            $form_image_data = array(
                                'nathi_id'          => $this->input->post('nathi_id'),
                                'paragraph_id'      => $last_insert_id,
                                'name'              => $_POST['file_name'][$s],
                                'userfile'          => $uploadedFile,
                                'created_at'        => date('Y-m-d H:i:s'),
                            );

                            $this->Common_model->save('paragraph_attachment', $form_image_data);
                            $sl++;
                        }
                    }

                }

                foreach ($this->input->post('general_attach')  as $item) {
                    $data=explode('-', $item);
                    $form_image_data = array(
                        'nathi_id'          => $this->input->post('nathi_id'),
                        'paragraph_id'      => $last_insert_id,
                        'name'              => $data[0],
                        'userfile'          => $data[1],
                        'created_at'        => date('Y-m-d H:i:s'),
                    );

                    $this->Common_model->save('paragraph_attachment', $form_image_data);
                }


                $btnsubmit = $this->input->post('btnsubmit');
                if( $btnsubmit == 'send2'){

                    $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($this->input->post('sug_id'));


                    $file_copy=implode(',', $this->input->post('file_copy'));
                    
                    $form_letter = array(
                        'note'                     => NULL,
                        'file_id'                  => $this->input->post('sug_id'),
                        'paragraph_no'             => $last_insert_id,
                        'department_id'            => $this->data['e_nathi_department']->emp_department,
                        'user_id'                  => $this->data['user']->id,
                        'designation_id'           => $this->data['e_nathi_department']->emp_designation,
                        'signature'                => $this->data['user']->emp_singature,
                        'created_at'               => date('Y-m-d H:i:s'),
                        'updated_at'               => date('Y-m-d H:i:s'),
                        'status'                   => 1
                    ); 

                    $this->Common_model->save('e_nathi_note', $form_letter);

                    $form_letter = array(
                        'nathi_desk'                     => $this->input->post('file_desk'),
                        'nathi_desk_department'          => $this->input->post('nathi_desk_department'),
                    ); 

                    $this->Common_model->edit('e_nathi_suggestion', $this->input->post('sug_id'), 'id', $form_letter);

                    
                    if($this->input->post('file_desk')==5 OR $this->input->post('file_desk')==6){
                       $to_department_data=$this->input->post('nathi_desk_department');
                    }elseif($this->input->post('file_desk')<=10){
                        $to_department_data=1;
                    }else{
                        $to_department_data=$this->input->post('nathi_desk_department');
                    }
                      

                    $form_log = array(
                        'file_id'                       => $this->input->post('sug_id'),
                        'from_department'               => $this->data['e_nathi_department']->emp_department,
                        'from_designation'              => $this->data['e_nathi_department']->emp_designation,
                        'to_department'                 => $to_department_data,
                        'to_designation'                => $this->input->post('file_desk'),
                        'created_at'                    => date('Y-m-d H:i:s'),
                        'updated_at'                    => date('Y-m-d H:i:s'),
                        'status'                        => 1
                    );

                    $this->Common_model->save('e_nathi_log', $form_log);
                    $this->session->set_flashdata('success', 'উক্ত নথির অনুচ্ছেদ সংরক্ষণ এবং প্রেরণ  করা হয়েছে।');
                    redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));  

                }


                $this->session->set_flashdata('success', 'উক্ত নথির অনুচ্ছেদ সংরক্ষণ  করা হয়েছে।');
                redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));
            }
           
        }else{

            $btnsubmit = $this->input->post('btnsubmit');
            if( $btnsubmit == 'send2'){

                $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($this->input->post('sug_id'));

                $paragraph_no=$this->E_nathi_model->last_paragraph('nathi_id', $this->data['suggestion']->nathi_id);
                

                $file_copy=implode(',', $this->input->post('file_copy'));
                
                $form_letter = array(
                    'note'                     => NULL,
                    'file_id'                  => $this->input->post('sug_id'),
                    'paragraph_no'             => $paragraph_no,
                    'department_id'            => $this->data['e_nathi_department']->emp_department,
                    'user_id'                  => $this->data['user']->id,
                    'designation_id'           => $this->data['e_nathi_department']->emp_designation,
                    'signature'                => $this->data['user']->emp_singature,
                    'created_at'               => date('Y-m-d H:i:s'),
                    'updated_at'               => date('Y-m-d H:i:s'),
                    'status'                   => 1
                ); 

                $this->Common_model->save('e_nathi_note', $form_letter);

                $form_letter = array(
                    
                    'nathi_desk'                     => $this->input->post('file_desk'),
                    'nathi_desk_department'          => $this->input->post('nathi_desk_department'),
                    
                ); 

                $this->Common_model->edit('e_nathi_suggestion', $this->input->post('sug_id'), 'id', $form_letter);

                if($this->input->post('file_desk')==5 OR $this->input->post('file_desk')==6){
                   $to_department_data=$this->input->post('nathi_desk_department');
                }elseif($this->input->post('file_desk')<=10){
                    $to_department_data=1;
                }else{
                    $to_department_data=$this->input->post('nathi_desk_department');
                }
                      

                $form_log = array(
                    'file_id'                       => $this->input->post('sug_id'),
                    'from_department'               => $this->data['e_nathi_department']->emp_department,
                    'from_designation'              => $this->data['e_nathi_department']->emp_designation,
                    'to_department'                 =>$to_department_data,
                    'to_designation'                => $this->input->post('file_desk'),
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s'),
                    'status'                        => 1
                );

                $this->Common_model->save('e_nathi_log', $form_log);
                $this->session->set_flashdata('success', 'উক্ত নথির অনুচ্ছেদ সংরক্ষণ এবং প্রেরণ  করা হয়েছে।');
                redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));  

            }

        }

        
        $this->data['nathi_list'] = $this->E_nathi_model->get_dropdown('e_nathi',  'nathi_no', 'id', $this->data['e_nathi_department']->emp_department);

        redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));
        // Load page
        $this->data['meta_title'] = 'নতুন নথির অনুচ্ছেদ তৈরি করুন';
        $this->data['subview'] = 'paragraph';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function paragraph_edit($id){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('details', 'Details', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                
                'details'                      => $this->input->post('details'),
                
            ); 


            if($this->Common_model->edit('e_nathi_paragraph', $id, 'id', $form_data)){
                $last_insert_id = $id;

                $sl=1;
                $count = count($_FILES['userfile']['size']);
                foreach($_FILES as $key=>$value){
                    for($s=0; $s<=$count-1; $s++) {
                        $_FILES['userfile']['name']     =$value['name'][$s];
                        $_FILES['userfile']['type']     = $value['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['userfile']['error']    = $value['error'][$s];
                        $_FILES['userfile']['size']     = $value['size'][$s];   
                        
                        $config['upload_path']      = $this->img_path;
                        $config['allowed_types']    = 'jpg|jpeg|png|JPEG|JPG|PNG|PDF|DOC|pdf|doc|docx|DOCX';
                        $config['max_size']         = '0';
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload()){
                            $uploadData = $this->upload->data();
                            $uploadedFile = $uploadData['file_name'];


                            $form_image_data = array(
                                'nathi_id'          => $this->input->post('nathi_id'),
                                'paragraph_id'      => $last_insert_id,
                                'name'              => $_POST['file_name'][$s],
                                'userfile'          => $uploadedFile,
                                'created_at'        => date('Y-m-d H:i:s'),
                            );

                            $this->Common_model->save('paragraph_attachment', $form_image_data);
                            $sl++;
                        }
                    }

                }

                foreach ($this->input->post('general_attach')  as $item) {
                    $data=explode('-', $item);
                    $form_image_data = array(
                        'nathi_id'          => $this->input->post('nathi_id'),
                        'paragraph_id'      => $last_insert_id,
                        'name'              => $data[0],
                        'userfile'          => $data[1],
                        'created_at'        => date('Y-m-d H:i:s'),
                    );

                    $this->Common_model->save('paragraph_attachment', $form_image_data);
                }

                $this->session->set_flashdata('success', 'উক্ত নথির অনুচ্ছেদ সম্পাদন করা হয়েছে।');
                redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));
            }
           

        }
        
    }

    public function suggestion(){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('nathi_id', 'Nathi Id', 'required|trim');
        $this->form_validation->set_rules('date', 'date', 'required|trim');

        $this->form_validation->set_rules('paragraph_list[]', 'Paragraph List', 'required|trim');


        if ($this->form_validation->run() == true){


            $paragraph_list=implode(',', $this->input->post('paragraph_list'));

            if($this->input->post('btnsubmit')=='save'){
                $desk=9;
            }else{
                $desk=7;
            }
            // echo $desk; exit();

            $form_letter = array(
                
                'nathi_id'                      => $this->input->post('nathi_id'),
                'date'                          => date_db_format($this->input->post('date')),
                'nathi_message'                  => $paragraph_list,
                'nathi_desk'                     => $desk,

                'department'                    => $this->data['e_nathi_department']->emp_department,
                'created_by'                    => $this->data['user']->id,
                'created_department'            => $this->data['e_nathi_department']->emp_department,
                'created_designation'           => $this->data['e_nathi_department']->emp_designation,
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

            if($this->Common_model->save('e_nathi_suggestion', $form_letter)){
                $last_insert_letter_id = $this->db->insert_id();

                $form_log = array(
                    'file_id'                       => $last_insert_letter_id,
                    'from_department'               => $this->data['e_nathi_department']->emp_department,
                    'from_designation'              => $this->data['e_nathi_department']->emp_designation,
                    'to_department'                 => $this->data['e_nathi_department']->emp_department,
                    'to_designation'                => $desk,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s'),
                    'status'                        => 1
                );

                if($this->input->post('btnsubmit')=='send'){
                    $this->Common_model->save('e_nathi_log', $form_log);
                }

                $api_key = "C20019945dde54c4697d80.43761214";
                $contacts = '+8801717265749';
                $senderid = '8804445629106';
                $sms = 'Respected Sir, A file is waiting in e-nothi of Bangladesh Scouts for your kind necessary action. please login(service.scouts.vov.bd/login) for details System Admin';

                $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$URL);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_POST, 0);
                try{
                $output = $content=curl_exec($ch);
                // print_r($output);

                }catch(Exception $ex){
                    $output = "-100";
                }


                $from_email = "admin@scouts.gov.bd";
                $to_email   = 'bdscoutsict@gmail.com';
                $subject    = 'E-Nothi Process';
                

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
                $this->email->message($sms);
                $this->email->send();

                $this->session->set_flashdata('success', 'উক্ত নথির প্রস্তাবনা  সংরক্ষণ ও প্রেরণ করা হয়েছে।');
                redirect(base_url('e_nathi/details/'.$this->input->post('nathi_id')));
            } 

        }

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');

        $this->data['nathi_list'] = $this->E_nathi_model->get_dropdown('e_nathi',  'nathi_no', 'id', $this->data['e_nathi_department']->emp_department);

        $this->data['paragraph_list'] = $this->E_nathi_model->get_dropdown('e_nathi_paragraph',  'paragraph_no', 'id', $this->data['e_nathi_department']->emp_department);
        
        // Load page
        $this->data['meta_title'] = 'নতুন প্রস্তাবনা তৈরি করুন';
        $this->data['subview'] = 'create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id, $id2=NULL){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['nathi'] = $this->E_nathi_model->get_file($id);
        if($id2==NULL){
            $page_id = $this->E_nathi_model->last_page($id);
        }else{
            $page_id = $id2;
        }
        
        $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($page_id);

        $this->data['paragraph'] = $this->E_nathi_model->get_file_list1('page_id', $page_id);

        $this->data['note'] = $this->E_nathi_model->get_note($id);

        $this->data['log'] = $this->E_nathi_model->get_log($page_id);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');
        $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

        $this->data['paragraph_list'] = $this->E_nathi_model->get_dropdown('e_nathi_paragraph',  'paragraph_no', 'id', $this->data['e_nathi_department']->emp_department);

        $this->data['results']=$this->E_nathi_model->get_file_list10('nathi_id', $id);

        $this->data['general_attachment']=$this->E_nathi_model->get_data('e_nathi_attach',$this->data['e_nathi_department']->emp_department);

        // Load page
         $this->data['meta_title'] = 'বিস্তারিত';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function pdf($id, $id2=NULL){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['nathi'] = $this->E_nathi_model->get_file($id);
        if($id2==NULL){
            $page_id = $this->E_nathi_model->last_page($id);
        }else{
            $page_id = $id2;
        }
        
        $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($page_id);

        $this->data['paragraph'] = $this->E_nathi_model->get_file_list1('page_id', $page_id);

        $this->data['note'] = $this->E_nathi_model->get_note($id);

        $this->data['log'] = $this->E_nathi_model->get_log($page_id);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');
        $this->data['department'] = $this->Common_model->get_dropdown('department',  'department_name', 'id');

        $this->data['paragraph_list'] = $this->E_nathi_model->get_dropdown('e_nathi_paragraph',  'paragraph_no', 'id', $this->data['e_nathi_department']->emp_department);

        $this->data['results']=$this->E_nathi_model->get_file_list10('nathi_id', $id);

        $this->data['general_attachment']=$this->E_nathi_model->get_data('e_nathi_attach',$this->data['e_nathi_department']->emp_department);

        //Generate HTML
        $html = $this->load->view('pdf', $this->data, true);    

        $mpdf = new mPDF('', 'A4', 10, 'nikosh', 10, 10, 10, 10);
        $file_name ="nathi-no-".$page_id.".pdf";

        $mpdf->showImageErrors = true;
        $mpdf->debug = true;

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it for 'D'. 
        $mpdf->Output($file_name, 'I');
    }

    public function details2($id){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($id);

        $this->data['nathi'] = $this->E_nathi_model->get_file($this->data['suggestion']->nathi_id);

        $this->data['paragraph2'] = $this->E_nathi_model->get_paragraph($id);

        $this->data['paragraph'] = $this->E_nathi_model->get_file_list1('nathi_id', $this->data['suggestion']->nathi_id);

        $this->data['note'] = $this->E_nathi_model->get_note($id);

        $this->data['log'] = $this->E_nathi_model->get_log($id);

        $this->data['designation'] = $this->Common_model->get_dropdown('designation',  'designation_name', 'id');

        $this->data['general_attachment']=$this->E_nathi_model->get_data('e_nathi_attach',$this->data['e_nathi_department']->emp_department);
        // Load page
         $this->data['meta_title'] = 'বিস্তারিত';
        $this->data['subview'] = 'details2';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function approved($id){

            $form_letter = array(
                'nathi_approval' => 1
            ); 

            $this->Common_model->edit('e_nathi_suggestion', $id, 'id', $form_letter);

            $form_letter = array(
                'nathi_desk'                     => 7,
            ); 

            $this->Common_model->edit('e_nathi_suggestion', $id, 'id', $form_letter);


            $form_log = array(
                'file_id'                       => $id,
                'from_department'               => $this->data['e_nathi_department']->emp_department,
                'from_designation'              => $this->data['e_nathi_department']->emp_designation,
                'to_department'                 => $this->data['e_nathi_department']->emp_department,
                'to_designation'                => 7,
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            );

            $this->Common_model->save('e_nathi_log', $form_log);

            $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($id);

                $paragraph_no=$this->E_nathi_model->last_paragraph('nathi_id', $this->data['suggestion']->nathi_id);

                // $file_copy=implode(',', $this->input->post('file_copy'));
                $form_letter = array(
                    'note'                     => 'অনুমোদন প্রদান করা হইল। ',
                    'file_id'                  => $id,
                    'paragraph_no'             => $paragraph_no,
                    'department_id'            => $this->data['e_nathi_department']->emp_department,
                    'user_id'                  => $this->data['user']->id,
                    'designation_id'           => $this->data['e_nathi_department']->emp_designation,
                    'signature'                => $this->data['user']->emp_singature,
                    'created_at'               => date('Y-m-d H:i:s'),
                    'updated_at'               => date('Y-m-d H:i:s'),
                    'status'                   => 1
                ); 

                $this->Common_model->save('e_nathi_note', $form_letter);

            $api_key = "C20019945dde54c4697d80.43761214";
                $contacts = '+8801717265749';
                $senderid = '8804445629106';
                $sms = 'Respected Sir, A file is waiting in e-nothi of Bangladesh Scouts for your kind necessary action. please login(service.scouts.vov.bd/login) for details System Admin';

                $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$URL);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_POST, 0);
                try{
                $output = $content=curl_exec($ch);
                // print_r($output);

                }catch(Exception $ex){
                    $output = "-100";
                }


                $from_email = "admin@scouts.gov.bd";
                $to_email   = 'bdscoutsict@gmail.com';
                $subject    = 'E-Nothi Process';
                

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
                $this->email->message($sms);
                $this->email->send();

            $this->session->set_flashdata('success', 'উক্ত নথি অনুমোদন করা হয়েছে।');

            redirect(base_url('e_nathi/details/'.$this->data['suggestion']->nathi_id.'/'.$id));
    }

    public function closing($id){
            $this->data['user'] = $this->ion_auth->user()->row();
            $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($id);
            $form_letter = array(
                'status' => 2
            ); 

            $this->Common_model->edit('e_nathi_suggestion', $id, 'id', $form_letter);


            $form_letter2 = array(
                
                'nathi_id'                      => $this->data['suggestion']->nathi_id,
                'date'                          => date('Y-m-d'),
                'nathi_desk'                    => $this->data['e_nathi_department']->emp_designation,
                'nathi_desk_department'         => $this->data['e_nathi_department']->emp_department,
                'department'                    => $this->data['e_nathi_department']->emp_department,
                'created_by'                    => $this->data['user']->id,
                'created_department'            => $this->data['e_nathi_department']->emp_department,
                'created_designation'           => $this->data['e_nathi_department']->emp_designation,
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            ); 

            $this->Common_model->save('e_nathi_suggestion', $form_letter2);

            $this->session->set_flashdata('success', 'উক্ত নথি সম্পন্ন করা হয়েছে।');

            redirect(base_url('e_nathi/details/'.$this->data['suggestion']->nathi_id.'/'.$id));
    }

    public function status($value,$id){

            $form_data = array(
                'status' => $value
            ); 

            $this->Common_model->edit('e_nathi', $id, 'id', $form_data);

            if($value==0){
                $this->session->set_flashdata('success', 'উক্ত নথি আর্কাইভ করা হয়েছে।');

                redirect(base_url('E_nathi/nathi_list2'));
            }else{
                $this->session->set_flashdata('success', 'উক্ত নথি পুনরুদ্ধার করা হয়েছে।');

                redirect(base_url('e_nathi/nathi_archive'));
            }

            
    }

    public function forward($id){

        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('file_desk', 'File Desk', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_letter = array(
                'nathi_desk'                     => $this->input->post('file_desk'),
            ); 

            $this->Common_model->edit('e_nathi_suggestion', $id, 'id', $form_letter);


            $form_log = array(
                'file_id'                       => $id,
                'from_department'               => $this->data['e_nathi_department']->emp_department,
                'from_designation'              => $this->data['e_nathi_department']->emp_designation,
                'to_department'                 => $this->data['e_nathi_department']->emp_department,
                'to_designation'                => $this->input->post('file_desk'),
                'created_at'                    => date('Y-m-d H:i:s'),
                'updated_at'                    => date('Y-m-d H:i:s'),
                'status'                        => 1
            );

            $this->Common_model->save('e_nathi_log', $form_log);

            $api_key = "C20019945dde54c4697d80.43761214";
                $contacts = '+8801717265749';
                $senderid = '8804445629106';
                $sms = 'Respected Sir, A file is waiting in e-nothi of Bangladesh Scouts for your kind necessary action. please login(service.scouts.vov.bd/login) for details System Admin';

                $URL = "http://sms.nanoitworld.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($senderid)."&msg=".urlencode($sms);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$URL);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_POST, 0);
                try{
                $output = $content=curl_exec($ch);
                // print_r($output);

                }catch(Exception $ex){
                    $output = "-100";
                }


                $from_email = "admin@scouts.gov.bd";
                $to_email   = 'bdscoutsict@gmail.com';
                $subject    = 'E-Nothi Process';
                

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
                $this->email->message($sms);
                $this->email->send();

            $this->session->set_flashdata('success', 'উক্ত নথি স্থানান্তরণ করা হয়েছে।');

            redirect(base_url('e_nathi/details2/'.$id));
        }

    }

    public function note($id){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->form_validation->set_rules('note', 'note', 'trim');

        if ($this->form_validation->run() == true){

            $this->data['suggestion'] = $this->E_nathi_model->get_suggestion($id);

            $paragraph_no=$this->E_nathi_model->last_paragraph('nathi_id', $this->data['suggestion']->nathi_id);

            $file_copy=implode(',', $this->input->post('file_copy'));
            $form_letter = array(
                'note'                     => $this->input->post('note'),
                'file_id'                  => $id,
                'paragraph_no'             => $paragraph_no,
                'department_id'            => $this->data['e_nathi_department']->emp_department,
                'user_id'                  => $this->data['user']->id,
                'designation_id'           => $this->data['e_nathi_department']->emp_designation,
                'signature'                => $this->data['user']->emp_singature,
                'created_at'               => date('Y-m-d H:i:s'),
                'updated_at'               => date('Y-m-d H:i:s'),
                'status'                   => 1
            ); 

            $this->Common_model->save('e_nathi_note', $form_letter);

            $this->session->set_flashdata('success', 'উক্ত নথি মন্তব্য প্রদান  করা হয়েছে।');

            redirect(base_url('e_nathi/details2/'.$id));
        }
    }

    public function getPreview(){
        
        $this->data['info'] = $this->input->post();

        $this->data['user'] = $this->ion_auth->user()->row();
        $this->data['department'] = $this->Common_model->get_single_ingo('department','id',$this->data['e_nathi_department']->emp_department);
       $this->data['designation'] = $this->Common_model->get_single_ingo('designation','id',$this->data['e_nathi_department']->emp_designation);
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