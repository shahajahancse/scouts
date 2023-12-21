<?php
// Create by: Mafizur
// Create Date: 07-06-2018
// Modify by: mafizur
// last modify date: 12-08-2018
defined('BASEPATH') OR exit('No direct script access allowed');

class E_attachment extends Backend_Controller {
    var $img_path;
    public function __construct(){
        parent::__construct();
        $this->data['module_name'] = 'সাধারণ সংযুক্তি';
        
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('E_attachment_model');
        $this->img_path = realpath(APPPATH . '../efile_img');
        $this->data['user'] = $this->ion_auth->user()->row(); 
     
    }

    public function index(){
        redirect('e_attachment/all');
    }

    public function all($offset=0){
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['e_nathi_department'] = $this->Common_model->e_nathi_department($this->data['user']->id);

        $this->data['results']=$this->E_attachment_model->get_data('e_nathi_attach',$this->data['e_nathi_department']->emp_department);

        $this->form_validation->set_rules('file_name[]', 'File Name', 'required|trim');

        if ($this->form_validation->run() == true){
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
                            
                            'department_id'      => $this->data['e_nathi_department']->emp_department,
                            'name'              => $_POST['file_name'][$s],
                            'userfile'          => $uploadedFile,
                        );

                        $this->Common_model->save('e_nathi_attach', $form_image_data);
                        $sl++;
                    }
                }

            }
            redirect(base_url('e_attachment/all'));
        }    
        $this->data['meta_title'] ='সংযুক্তি তালিকা';
        $this->data['subview'] = 'all';
        $this->load->view('backend/_layout_main', $this->data);
    }

}