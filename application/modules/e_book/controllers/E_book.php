<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
set_time_limit(0);
ini_set('post_max_size', '100000');
ini_set('upload_max_filesize', '100000');
ini_set('memory_limit', -1);
ini_set('max_input_time', -1);
*/
// echo phpinfo(); exit;


class E_book extends Backend_Controller {	

    var $img_path;
    var $pdf_path;

    public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->data['module_title'] = 'E-Book';
        $this->load->model('Common_model'); 
        $this->load->model('Ebook_model');     
        $this->img_path = realpath(APPPATH . '../uploads/ebook/thumbs');
        $this->pdf_path = realpath(APPPATH . '../uploads/ebook/pdf');
        
    }

    public function index($offset=0){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }
        $limit = 10;

        //Results
        $results = $this->Ebook_model->get_data($limit, $offset);
        // print_r($results); exit;
        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('e_book/index/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        //Dropdown
        $this->data['ebook_category'] = $this->Common_model->get_ebook_category();

        // Load page
        $this->data['meta_title'] = 'E-Book List';
        $this->data['subview'] = 'list';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function create(){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        // Validation        
        $this->form_validation->set_rules('category_id', 'Category', 'required|trim');
        $this->form_validation->set_rules('book_title', 'Book Title', 'required|trim');
        $this->form_validation->set_rules('userfile', 'Book thumb image', 'callback_file_check');
        $this->form_validation->set_rules('userfile_pdf', 'PDF file', 'callback_file_pdf_check');
        
        if ($this->form_validation->run() == true){      
            /*echo '<pre>';
            print_r($_FILES); exit;*/

            // File Upload
            if(isset($_FILES['userfile_pdf']['size']) > 0){
                $new_file_name = 'book_'.time(); //$_FILES["userfile_pdf"]['name'];
                $config['allowed_types']= 'pdf';
                $config['upload_path']  = $this->pdf_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 0; // 20 MB = 20480 KB
                $this->load->library('upload', $config);
                $this->upload->initialize($config, true);
                //upload file to directory
                if($this->upload->do_upload('userfile_pdf')){
                    $uploadData2 = $this->upload->data();
                    $uploadedFile_PDF = $uploadData2['file_name'];

                    // $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }

                // PDF File upload
                // $form_data2 = array('pdf_file' => $uploadedFile_PDF);  
            }

            // Image Upload
            if(isset($_FILES['userfile']['size']) > 0){
                $new_file_name = time(); //$_FILES["userfile"]['name']; 
                $config2['allowed_types']= 'jpg|png|jpeg';
                $config2['upload_path']  = $this->img_path;
                $config2['file_name']    = $new_file_name;
                $config2['max_size']     = 100; // KB

                $this->load->library('upload', $config);
                // print_r($_FILES); exit;
                $this->upload->initialize($config2, true);

                //upload file to directory
                if($this->upload->do_upload('userfile')){
                    $uploadData = $this->upload->data();
                    // Image 
                    $config2 = array(
                        'source_image' => $uploadData['full_path'],
                        'new_image' => $this->img_path,
                        'maintain_ratio' => FALSE,
                        'width' => 111,
                        'height' => 144
                        );
                    $this->load->library('image_lib',$config2);
                    $this->image_lib->initialize($config2);
                    $this->image_lib->resize();
                    $uploadedFile = $uploadData['file_name'];
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }            

            // print_r($uploadedFile); exit;
            // $form_data = array('pdf_file' => $uploadedFile);  

            /*if($_FILES['userfile_pdf']['size'] > 0){
                $form_data['attachment_file'] = $uploadedFile; 
            }*/

            $form_data = array(
                'category_id'   => $this->input->post('category_id'),
                'book_title'    => $this->input->post('book_title'),
                'description'   => $this->input->post('description'), 
                'total_page'    => $this->input->post('total_page'),               
                'image_file'    => $uploadedFile,
                'pdf_file'      => $uploadedFile_PDF
                );
            // print_r($form_data);exit();

            if($this->Common_model->save('ebook', $form_data)){  
                //last personal data id
                $lastID = $this->db->insert_id();

                // Dynamic Index 
                for ($i=0; $i<sizeof($_POST['index_title']); $i++) { 
                 $data = array(
                  'ebook_id'    => $lastID,
                  'index_title' => $_POST['index_title'][$i],
                  'page_no'     => $_POST['page_no'][$i],
                  );
                 $this->Common_model->save('ebook_index', $data);
             }

             $this->session->set_flashdata('success', 'New ebook create successfully.');
             redirect("e_book");
                // Last Insert ID
                // $lastID = $this->db->insert_id(); 


                // Save PDF
                /*if($this->Common_model->edit('ebook', $lastID, 'id', $form_data2)){
                    $this->session->set_flashdata('success', 'New ebook create successfully.');
                    redirect("e_book");
                } */               
            } 
        }

        // Dropdown
        $this->data['ebook_category'] = $this->Common_model->get_ebook_category();

        // Load page
        $this->data['meta_title'] = 'Add E-Book';
        $this->data['subview'] = 'create';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        // Validation
        $this->form_validation->set_rules('category_id', 'Category', 'required|trim');
        $this->form_validation->set_rules('book_title', 'Book Title', 'required|trim');
        if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', 'Book thumb image', 'callback_file_check');
        }
        if(@$_FILES['userfile_pdf']['size'] > 0){
            $this->form_validation->set_rules('userfile_pdf', 'pdf book', 'callback_file_pdf_check');
        }

        if ($this->form_validation->run() == true){
            $form_data = array(
                'category_id'   => $this->input->post('category_id'),
                'book_title'    => $this->input->post('book_title'),
                'description'   => $this->input->post('description'),
                'total_page'    => $this->input->post('total_page'),
                'status'        => $this->input->post('status')
                );

            // File Upload
            if(isset($_FILES['userfile_pdf']['size']) > 0){
                $new_file_name = 'book_'.time(); //$_FILES["userfile_pdf"]['name'];
                $config['allowed_types']= 'pdf';
                $config['upload_path']  = $this->pdf_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 0; // 20 MB = 20480 KB
                $this->load->library('upload', $config);
                $this->upload->initialize($config, true);
                //upload file to directory
                if($this->upload->do_upload('userfile_pdf')){
                    $uploadData2 = $this->upload->data();
                    $uploadedFile_PDF = $uploadData2['file_name'];

                    // $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }

                // PDF File upload
                // $form_data2 = array('pdf_file' => $uploadedFile_PDF);  
            }

            // Image Upload
            if($_FILES['userfile']['size'] > 0){
                $new_file_name = time(); //$_FILES["userfile"]['name'];
                $config2['allowed_types']= 'jpg|png|jpeg';
                $config2['upload_path']  = $this->img_path;
                $config2['file_name']    = $new_file_name;
                $config2['max_size']     = 100; // KB

                $this->load->library('upload', $config);
                // print_r($_FILES); exit;

                //upload file to directory
                if($this->upload->do_upload('userfile')){
                    $uploadData = $this->upload->data();
                    // Image 
                    $config2 = array(
                        'source_image' => $uploadData['full_path'],
                        'new_image' => $this->img_path,
                        'maintain_ratio' => FALSE,
                        'width' => 111,
                        'height' => 144
                        );
                    $this->load->library('image_lib',$config2);
                    $this->image_lib->initialize($config2);
                    $this->image_lib->resize();
                    $uploadedFile = $uploadData['file_name'];
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            // Save Image
            if($_FILES['userfile_pdf']['size'] > 0){
                $form_data['pdf_file'] = $uploadedFile_PDF;
            }

            // Save Image
            if($_FILES['userfile']['size'] > 0){
                $form_data['image_file'] = $uploadedFile;
            }

            // Dynamic Index
            for ($i=0; $i<sizeof($_POST['index_title']); $i++) { 
               //check exists data
                @$data_exists = $this->Common_model->exists('ebook_index', 'id', $_POST['hide_id'][$i]);
                if($data_exists){
                    $data = array(
                        'index_title'  => $_POST['index_title'][$i],
                        'page_no'      => $_POST['page_no'][$i],
                        ); 
                    $this->Common_model->edit('ebook_index', $_POST['hide_id'][$i], 'id', $data);
                }else{
                    $data = array(
                        'ebook_id'     => $id,
                        'index_title'  => $_POST['index_title'][$i],
                        'page_no'      => $_POST['page_no'][$i],
                        );
                    $this->Common_model->save('ebook_index', $data);
                }
            }
            //print_r($form_data);exit();

            if($this->Common_model->edit('ebook', $id, 'id', $form_data)){                
                $this->session->set_flashdata('success', 'Information Update successfully.');
                redirect("e_book");
            }
        }

        // Get Result
        $this->data['info'] = $this->Ebook_model->get_info($id);
        $this->data['ebook_index'] = $this->Ebook_model->get_book_indexs($id);

        // Dropdown
        $this->data['ebook_category'] = $this->Common_model->get_ebook_category();


        // Load page
        $this->data['meta_title'] = 'Edit';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }   

    public function upload_pdf($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        // Validation        
        $this->form_validation->set_rules('userfile', 'PDF file', 'callback_file_pdf_check');

        if ($this->form_validation->run() == true){      
            // File Upload
            if($_FILES['userfile']['size'] > 0){
                $new_file_name = $id.'_'.time(); 
                $config['allowed_types']= 'pdf';
                $config['upload_path']  = $this->pdf_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 0; // 20 MB = 20480 KB

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload()){
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];

                    // $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            // print_r($uploadedFile); exit;
            $form_data = array('pdf_file' => $uploadedFile);             
            // print_r($form_data);exit();

            if($this->Common_model->edit('ebook', $id, 'id', $form_data)){                
                $this->session->set_flashdata('success', 'E-Book file upload successfully');
                redirect("e_book");
            } 
        }

        // Load page
        $this->data['meta_title'] = 'Upload PDF E-Book';
        $this->data['subview'] = 'upload_pdf';
        $this->load->view('backend/_layout_main', $this->data);
    }

    /*public function details($id){
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        $this->data['info'] = $this->Ebook_model->get_info($id);

        $this->data['meta_title'] = 'Details Slider';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }*/


    function delete($id) {
        if(!($this->ion_auth->is_admin() || $this->ion_auth->is_scout_admin())){
            redirect('dashboard');
        }

        $data = $this->Common_model->get_single_data('ebook', $id);
        @unlink(FCPATH.'uploads/ebook/pdf/'.$data->pdf_file);
        @unlink(FCPATH.'uploads/ebook/thumbs/'.$data->image_file);

        if($this->Common_model->delete('ebook', 'id', $id)){
            $this->Common_model->delete('ebook_index', 'ebook_id', $id);
            $this->session->set_flashdata('success', 'Delete data from system successfully');
            redirect("e_book");
        }else{
            $this->session->set_flashdata('warning', 'Something is wrong!');
            redirect("e_book");
        }
    }


    function ajax_ebook_index_del($id){
        $this->Common_model->delete('ebook_index', 'id', $id);
        echo 'This information remove from database.';
    }

    function test(){
        echo phpinfo();
        /*set_time_limit(20);

        while ($i<=10)
        {
            echo "i=$i ";
            sleep(100);
            $i++;
        }*/


        // Output:
        // i=0 i=1 i=2 i=3 i=4 i=5 i=6 i=7 i=8 i=9 i=10
    }

    // Image Validation
    public function file_check($str){
        $this->load->helper('file');
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['userfile']['name']);
        $file_size = 102400; // Byte
        $size_kb = '100 KB';

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

    // PDF File Validation
    public function file_pdf_check($str){
        $this->load->helper('file');
        $allowed_mime_type_arr = array('application/pdf', 'application/x-download');
        $mime = get_mime_by_extension($_FILES['userfile_pdf']['name']);
        $file_size = 52428800; //20971520; // Bytes
        $size_kb = '50 MB'; //'20 MB'; // 

        if(isset($_FILES['userfile_pdf']['name']) && $_FILES['userfile_pdf']['name']!=""){
            if(!in_array($mime, $allowed_mime_type_arr)){                
                $this->form_validation->set_message('file_pdf_check', 'Please select only pdf file.');
                return false;
            }elseif($_FILES["userfile_pdf"]["size"] > $file_size){
                $this->form_validation->set_message('file_pdf_check', 'Maximum file size '.$size_kb);
                return false;
            }else{
                return true;
            }
        }else{
            $this->form_validation->set_message('file_pdf_check', 'Please choose a pdf file to upload.');
            return false;
        }
    }

}