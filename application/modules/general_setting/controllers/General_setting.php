<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_setting extends Backend_Controller {
    var $img_path;
	public function __construct(){
        parent::__construct();
        $this->data['module_name'] = 'General Setting';
        
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        // if(!$this->ion_auth->is_admin()):
        //     redirect('dashboard');
        // endif;

        // $this->load->model('Common_model');
        $this->load->model('General_setting_model');
        $this->img_path = realpath(APPPATH . '../scout_badge_img');       
    }

	public function index(){
        redirect('general_setting/upazila_thana');
	}    

   public function designation(){
        $this->data['results'] = $this->General_setting_model->get_designation(); 
        
        $this->data['meta_title'] = 'All Designation List';
        $this->data['subview'] = 'designation';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function designation_add(){
        $this->form_validation->set_rules('officeType', 'office type', 'trim');
        $this->form_validation->set_rules('designation_name', 'Designation Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_level'              => implode(',', $this->input->post('officeType')),
                'designation_name'=> $this->input->post('designation_name')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('designation', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'designation ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Designation create successfully.');
                redirect('general_setting/designation');
            }
        }

        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
        // $this->data['scouts_office_check'] = $this->Common_model->set_office_type_checkbox();

        // Load page
        $this->data['meta_title'] = 'Create Designation';
        $this->data['subview'] = 'designation_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

     public function designation_edit($id){
        $this->form_validation->set_rules('officeType', 'office type', 'trim');
        $this->form_validation->set_rules('designation_name', 'Designation Name', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_level'              => implode(',', $this->input->post('officeType')),
                'designation_name'=> $this->input->post('designation_name'),
                'status'                    => $this->input->post('status')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('designation', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'designation update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Informatioin update successfully.');
                redirect('general_setting/designation');
            }
        }
        
        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
        // $this->data['scouts_office_check'] = $this->Common_model->set_office_type_checkbox();
        $this->data['info'] = $this->General_setting_model->get_info('designation', $id);

        // Load page
        $this->data['meta_title'] = 'Edit Designation';
        $this->data['subview'] = 'designation_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }
    
    public function upazila_thana($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_upazila_thana($limit, $offset);
        // print_r($results); exit;

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/upazila_thana/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');
        $this->data['district'] = $this->Common_model->get_dropdown('district', 'district_name', 'id');

        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Upazila Thana';
        $this->data['subview'] = 'upazila_thana';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function post_office(){
        $this->data['results'] = $this->General_setting_model->get_post_office(); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Post Office';
        $this->data['subview'] = 'post_office';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function district($offset=0){
        //Manage list the users
        $limit = 20;
        $results = $this->General_setting_model->get_district($limit, $offset);
        // print_r($results); exit;

        $this->data['results'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];


        //pagination
        $this->data['pagination'] = create_pagination('general_setting/district/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');

        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All District';
        $this->data['subview'] = 'district';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function district_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district_name', 'District Name', 'required|trim');
        $this->form_validation->set_rules('district_name_bn', 'District Name Bangla', 'trim');
        $this->form_validation->set_rules('district_geo', 'GEO Code', 'min_length[2]|max_length[2]|trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_id'             => $this->input->post('division'),
                'district_name'      => $this->input->post('district_name'),
                'district_name_bn'   => $this->input->post('district_name_bn'),
                'district_geo'       => $this->input->post('district_geo')?$this->input->post('district_geo'):NULL
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('district', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'District create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'District create successfully.');
                redirect('general_setting/district');
            }
        }

        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');
        

        // Load page
        $this->data['meta_title'] = 'Create District';
        $this->data['subview'] = 'district_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function district_edit($id){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district_name', 'District Name', 'required|trim');
        $this->form_validation->set_rules('district_name_bn', 'District Name Bangla', 'trim');
        $this->form_validation->set_rules('district_geo', 'GEO Code', 'min_length[2]|max_length[2]|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_id'             => $this->input->post('division'),
                'district_name'      => $this->input->post('district_name'),
                'district_name_bn'   => $this->input->post('district_name_bn'),
                'district_geo'       => $this->input->post('district_geo')?$this->input->post('district_geo'):NULL,
                'status'             => $this->input->post('status'),
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('district',$id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'District Information update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/district');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('district',$id);
        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');

        // Load page
        $this->data['meta_title'] = 'Edit District';
        $this->data['subview'] = 'district_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    public function division(){
        $this->data['results'] = $this->General_setting_model->get_division(); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Division';
        $this->data['subview'] = 'division';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function division_add(){
        $this->form_validation->set_rules('div_name', 'Division Name', 'required|trim');
        $this->form_validation->set_rules('div_name_bn', 'Division Name Bangla', 'trim');
        $this->form_validation->set_rules('div_geo_code', 'GEO Code', 'min_length[2]|max_length[2]|trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_name'      => $this->input->post('div_name'),
                'div_name_bn'   => $this->input->post('div_name_bn'),
                'div_geo'       =>  $this->input->post('div_geo_code')?$this->input->post('div_geo_code'):NULL
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('division', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Division create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/

                $this->session->set_flashdata('success', 'Division create successfully.');
                redirect('general_setting/division');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Division';
        $this->data['subview'] = 'division_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function division_edit($id){
        $this->form_validation->set_rules('div_name', 'Division Name', 'required|trim');
        $this->form_validation->set_rules('div_name_bn', 'Division Name Bangla', 'trim');
         $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('div_geo_code', 'GEO Code', 'max_length[2]|min_length[2]|trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_name'      => $this->input->post('div_name'),
                'div_name_bn'   => $this->input->post('div_name_bn'),
                'div_geo'       => $this->input->post('div_geo_code')?$this->input->post('div_geo_code'):NULL,
                'status'        => $this->input->post('status'),
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('division',$id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Division Information Update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/division');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('division',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Division';
        $this->data['subview'] = 'division_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function details($id){
        // $this->data['info'] = $this->Scouts_member_model->get_info($id);

        $this->data['meta_title'] = 'Details Scouts Member';
        $this->data['subview'] = 'details';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function edit($id){

        $this->form_validation->set_rules('title', 'course title', 'required|trim');
        $this->form_validation->set_rules('slug', 'course slug', 'required|trim');
        $this->form_validation->set_rules('short_desc', 'course short description', 'required|max_length[1000]|trim');

        $this->data['info'] = $this->Scouts_setting_model->get_info($id);
        // print_r($this->data['info']); exit;

        if ($this->form_validation->run() == true){

            $form_data = array(
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'short_desc' => $this->input->post('short_desc'),
                'meta_keys' => $this->input->post('meta_keys')?$this->input->post('meta_keys'):NULL
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('users', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Information Update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('all');
            }
        }

        $this->data['meta_title'] = 'Edit Scouts Member';
        $this->data['subview'] = 'edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


	public function unit_office_add(){
		$this->form_validation->set_rules('title', 'course title', 'required|trim'); 
        $this->form_validation->set_rules('slug', 'course slug', 'required|trim');          
        $this->form_validation->set_rules('short_desc', 'course short description', 'required|max_length[1000]|trim');
       
        if ($this->form_validation->run() == true){

            $form_data = array(
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'short_desc' => $this->input->post('short_desc'),
                'meta_keys' => $this->input->post('meta_keys')?$this->input->post('meta_keys'):NULL           
            );          

            // print_r($form_data); exit;

            if($this->Common_model->save('users', $form_data)){  
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'scouts member insert ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/     
                $this->session->set_flashdata('success', 'New scouts member insert successfully.');
               redirect("all");
            }
        }

		$this->data['meta_title'] = 'Add Scouts Member';
		$this->data['subview'] = 'unit_office_add';
    	$this->load->view('backend/_layout_main', $this->data);
	}

    public function upazila_thana_add(){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('up_th_name', 'Upazila/Thana Name', 'required|trim');
        $this->form_validation->set_rules('up_th_name_bn', 'Upazila/Thana Name Bangla', 'trim');
        $this->form_validation->set_rules('up_th_geo', 'Upazila/Thana  GEO Code', 'min_length[2]|max_length[2]|trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_id'             => $this->input->post('division'),
                'dis_id'             => $this->input->post('district'),
                'up_th_name'         => $this->input->post('up_th_name'),
                'up_th_name_bn'      => $this->input->post('up_th_name_bn'),
                'up_th_geo'          => $this->input->post('up_th_geo')?$this->input->post('up_th_geo'):NULL
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('upazila_thana', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Upazila/Thana  create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Upazila/Thana  create successfully.');
                redirect('general_setting/district');
            }
        }

        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');
        $this->data['district'] = $this->Common_model->get_dropdown('district', 'district_name', 'id');

        $this->data['meta_title'] = 'Add Upazila/Thana';
        $this->data['subview'] = 'upazila_thana_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function upazila_thana_edit($id){
        $this->form_validation->set_rules('division', 'Division', 'required|trim');
        $this->form_validation->set_rules('district', 'District', 'required|trim');
        $this->form_validation->set_rules('up_th_name', 'Upazila/Thana Name', 'required|trim');
        $this->form_validation->set_rules('up_th_name_bn', 'Upazila/Thana Name Bangla', 'trim');
        $this->form_validation->set_rules('up_th_geo', 'Upazila/Thana  GEO Code', 'min_length[2]|max_length[2]|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'div_id'             => $this->input->post('division'),
                'dis_id'             => $this->input->post('district'),
                'up_th_name'         => $this->input->post('up_th_name'),
                'up_th_name_bn'      => $this->input->post('up_th_name_bn'),
                'status'             => $this->input->post('status'),
                'up_th_geo'          => $this->input->post('up_th_geo')?$this->input->post('up_th_geo'):NULL
            );           

            // print_r($form_data); exit;
             if($this->Common_model->edit('upazila_thana',$id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Upazila/Thana  update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/upazila_thana');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('upazila_thana',$id);

        $this->data['division'] = $this->Common_model->get_dropdown('division', 'div_name', 'id');
        $this->data['district'] = $this->Common_model->get_dropdown('district', 'district_name', 'id');

        $this->data['meta_title'] = 'Add Upazila/Thana';
        $this->data['subview'] = 'upazila_thana_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function occupation(){
        $this->data['results'] = $this->General_setting_model->get_occupation(); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Occupation List';
        $this->data['subview'] = 'occupation';
        $this->load->view('backend/_layout_main', $this->data);
    }


     public function occupation_add(){
        $this->form_validation->set_rules('occupation_name', 'Occupation Name', 'required|trim');
        $this->form_validation->set_rules('occupation_name_bn', 'Occupation Name Bangla', 'trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'occupation_name'      => $this->input->post('occupation_name'),
                'occupation_name_bn'   => $this->input->post('occupation_name_bn'),
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('occupation', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Occupation create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Occupation create successfully.');
                redirect('general_setting/occupation');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Occupation';
        $this->data['subview'] = 'occupation_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function occupation_edit($id){
        $this->form_validation->set_rules('occupation_name', 'Occupation Name', 'required|trim');
        $this->form_validation->set_rules('occupation_name_bn', 'Occupation Name Bangla', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'occupation_name'      => $this->input->post('occupation_name'),
                'occupation_name_bn'   => $this->input->post('occupation_name_bn'),
                'status'               => $this->input->post('status')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('occupation', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Occupation update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Informatioin update successfully.');
                redirect('general_setting/occupation');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('occupation',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Occupation';
        $this->data['subview'] = 'occupation_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function committee_type(){
        $this->data['results'] = $this->General_setting_model->get_committee_type(); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Committee Type';
        $this->data['subview'] = 'committee_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function committee_type_add(){
        //Validation
        $this->form_validation->set_rules('office_type_id', 'office type', 'required|trim');
        $this->form_validation->set_rules('committee_type_name', 'committee type name', 'required|trim');

        //Validate and input data
        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type_id'        => $this->input->post('office_type_id'),
                'committee_type_name'   => $this->input->post('committee_type_name')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('committee_type', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Committee type create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Committee type create successfully.');
                redirect('general_setting/committee_type');
            }
        }

        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_office_type();
        
        // Load page
        $this->data['meta_title'] = 'Create Committee Type';
        $this->data['subview'] = 'committee_type_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function committee_type_edit($id){
        //Validation
        $this->form_validation->set_rules('office_type_id', 'office type', 'required|trim');
        $this->form_validation->set_rules('committee_type_name', 'committee type name', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_type_id'        => $this->input->post('office_type_id'),
                'committee_type_name'   => $this->input->post('committee_type_name'),
                'status'                => $this->input->post('status')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('committee_type', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Committee type update ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Informatioin update successfully.');
                redirect('general_setting/committee_type');
            }
        }

        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_office_type();
        $this->data['info'] = $this->General_setting_model->get_info('committee_type', $id);

        // Load page
        $this->data['meta_title'] = 'Edit Committee Type';
        $this->data['subview'] = 'committee_type_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function committee_designation(){
        $this->data['results'] = $this->General_setting_model->get_committee_designation(); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Committee Designation List';
        $this->data['subview'] = 'committee_designation';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function committee_designation_add(){
        $this->form_validation->set_rules('officeType', 'office type', 'trim');
        $this->form_validation->set_rules('committee_designation_name', 'Committee Designation Name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_level'              => implode(',', $this->input->post('officeType')),
                'committee_designation_name'=> $this->input->post('committee_designation_name')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->save('committee_designation', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'committee designation ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Occupation create successfully.');
                redirect('general_setting/committee_designation');
            }
        }

        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
        // $this->data['scouts_office_check'] = $this->Common_model->set_office_type_checkbox();

        // Load page
        $this->data['meta_title'] = 'Create Committee Designation';
        $this->data['subview'] = 'committee_designation_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

     public function committee_designation_edit($id){
        $this->form_validation->set_rules('officeType', 'office type', 'trim');
        $this->form_validation->set_rules('committee_designation_name', 'Committee Designation Name', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'office_level'              => implode(',', $this->input->post('officeType')),
                'committee_designation_name'=> $this->input->post('committee_designation_name'),
                'status'                    => $this->input->post('status')
            );           

            // print_r($form_data); exit;
            if($this->Common_model->edit('committee_designation', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'committee designation update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Informatioin update successfully.');
                redirect('general_setting/committee_designation');
            }
        }
        
        //Dropdown
        $this->data['scouts_office'] = $this->Common_model->get_data_array('office_type');
        // $this->data['scouts_office_check'] = $this->Common_model->set_office_type_checkbox();
        $this->data['info'] = $this->General_setting_model->get_info('committee_designation', $id);

        // Load page
        $this->data['meta_title'] = 'Edit Committee Designation';
        $this->data['subview'] = 'committee_designation_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function department(){
        $this->data['results'] = $this->General_setting_model->get_department(); 
        $this->data['meta_title'] = 'All Department List';
        $this->data['subview'] = 'department';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function department_add(){
        $this->form_validation->set_rules('department_name', 'Department Name', 'required|trim');

        if ($this->form_validation->run() == true){


            $form_data = array(
                'department_name'      => $this->input->post('department_name'),
            ); 

            if($this->Common_model->save('department', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Department create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Department create successfully.');
                redirect('general_setting/department');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Department';
        $this->data['subview'] = 'department_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function department_edit($id){
       $this->form_validation->set_rules('department_name', 'Department Name', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'department_name'       => $this->input->post('department_name'),
                'status'                => $this->input->post('status'),
            );        


            if($this->Common_model->edit('department', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Department update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/department');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('department',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Department';
        $this->data['subview'] = 'department_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function badge_type(){
        $this->data['results'] = $this->General_setting_model->get_badge_type(); 
        $this->data['meta_title'] = 'All Badge Type List';
        $this->data['subview'] = 'badge_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function badge_type_add(){
        $this->form_validation->set_rules('badge_type_name_bn', 'Badge Type Name BN', 'required|trim');
        $this->form_validation->set_rules('badge_type_name_en', 'Badge Type Name EN', 'trim');

        if(@$_FILES['badge_logo']['size'] > 0){
            $this->form_validation->set_rules('badge_logo', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){

            if($_FILES['badge_logo']['size'] > 0){
                $new_file_name = $_FILES["badge_logo"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('badge_logo')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            $form_data = array(
                'badge_type_name_bn'      => $this->input->post('badge_type_name_bn'),
                'badge_type_name_en'      => $this->input->post('badge_type_name_en'),
            ); 

            if($_FILES['badge_logo']['size'] > 0){
                $form_data['badge_logo'] = $uploadedFile;
            }          


            // print_r($form_data); exit;
            if($this->Common_model->save('badge_type', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Badge type create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Badge type create successfully.');
                redirect('general_setting/badge_type');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Badge Type';
        $this->data['subview'] = 'badge_type_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function badge_type_edit($id){
        $this->form_validation->set_rules('badge_type_name_bn', 'Badge Type Name BN', 'required|trim');
        $this->form_validation->set_rules('badge_type_name_en', 'Badge Type Name EN', 'trim');

        if(@$_FILES['badge_logo']['size'] > 0){
            $this->form_validation->set_rules('badge_logo', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){

            if($_FILES['badge_logo']['size'] > 0){
                $new_file_name = $_FILES["badge_logo"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('badge_logo')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            $form_data = array(
                'badge_type_name_bn'      => $this->input->post('badge_type_name_bn'),
                'badge_type_name_en'      => $this->input->post('badge_type_name_en'),
            ); 

            if($_FILES['badge_logo']['size'] > 0){
                $form_data['badge_logo'] = $uploadedFile;
            }          


            // print_r($form_data); exit;
            if($this->Common_model->edit('badge_type', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Badge type update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/badge_type');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('badge_type',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Badge Type';
        $this->data['subview'] = 'badge_type_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function role_type(){
        $this->data['results'] = $this->General_setting_model->get_role_type(); 
        $this->data['meta_title'] = 'All Role Type List';
        $this->data['subview'] = 'role_type';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function role_type_add(){
        $this->form_validation->set_rules('role_type_name_bn', 'Role Type Name BN', 'required|trim');
        $this->form_validation->set_rules('role_type_name_en', 'Role Type Name EN', 'trim');


        if ($this->form_validation->run() == true){


            $form_data = array(
                'role_type_name_bn'      => $this->input->post('role_type_name_bn'),
                'role_type_name_en'      => $this->input->post('role_type_name_en'),
            );         


            // print_r($form_data); exit;
            if($this->Common_model->save('role_type', $form_data)){

                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Role type create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Role type create successfully.');
                redirect('general_setting/role_type');
            }
        }

        // Load page
        $this->data['meta_title'] = 'Create Role Type';
        $this->data['subview'] = 'role_type_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function role_type_edit($id){
        $this->form_validation->set_rules('role_type_name_bn', 'Role Type Name BN', 'required|trim');
        $this->form_validation->set_rules('role_type_name_en', 'Role Type Name EN', 'trim');


        if ($this->form_validation->run() == true){

            $form_data = array(
                'role_type_name_bn'      => $this->input->post('role_type_name_bn'),
                'role_type_name_en'      => $this->input->post('role_type_name_en'),
            );         


            // print_r($form_data); exit;
            if($this->Common_model->edit('role_type', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Role type update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/role_type');
            }
        }

        $this->data['info'] = $this->General_setting_model->get_info('role_type',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Role Type';
        $this->data['subview'] = 'role_type_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge(){
        $this->data['results'] = $this->General_setting_model->get_scout_badge(); 
        // print_r($this->data['results']); exit;
        // $this->data['section'] = $this->Common_model->set_scout_section_basic();
        // Load page
        $this->data['meta_title'] = 'All Scout Badge List';
        $this->data['subview'] = 'scout_badge';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge_add(){
        $this->form_validation->set_rules('member_id', 'Member', 'required|trim');
        $this->form_validation->set_rules('section_id', 'Section', 'required|trim');
        $this->form_validation->set_rules('badge_type_id', 'Badge Type', 'required|trim');

        if(@$_FILES['badge_logo']['size'] > 0){
            $this->form_validation->set_rules('badge_logo', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){

            if($_FILES['badge_logo']['size'] > 0){
                $new_file_name = $_FILES["badge_logo"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('badge_logo')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            $form_data = array(
                'member_id'       => $this->input->post('member_id'),
                'section_id'      => $this->input->post('section_id'),
                'badge_type_id'   => $this->input->post('badge_type_id'),
            ); 

            if($_FILES['badge_logo']['size'] > 0){
                $form_data['badge_logo'] = $uploadedFile;
            }          


            // print_r($form_data); exit;
            if($this->Common_model->save('scout_badge', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Scout badge creat ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Scout badge create successfully.');
                redirect('general_setting/scout_badge');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section();
        $this->data['member_type'] = $this->Common_model->get_member_type();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Scout Badge';
        $this->data['subview'] = 'scout_badge_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge_edit($id){
        $this->form_validation->set_rules('member_id', 'Member', 'required|trim');
        $this->form_validation->set_rules('section_id', 'Section', 'required|trim');
        $this->form_validation->set_rules('badge_type_id', 'Badge Type', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if(@$_FILES['badge_logo']['size'] > 0){
            $this->form_validation->set_rules('badge_logo', '', 'callback_file_check');
        }

        if ($this->form_validation->run() == true){

            if($_FILES['badge_logo']['size'] > 0){
                $new_file_name = $_FILES["badge_logo"]['name'];

                $config['allowed_types']= 'jpg|png|jpeg|gif';
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 1000;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('badge_logo')){

                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                    $this->data['message'] = 'File has been uploaded successfully.';
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            $form_data = array(
                'member_id'       => $this->input->post('member_id'),
                'section_id'      => $this->input->post('section_id'),
                'badge_type_id'   => $this->input->post('badge_type_id'),
                'status'          => $this->input->post('status'),
            ); 

            if($_FILES['badge_logo']['size'] > 0){
                $form_data['badge_logo'] = $uploadedFile;
            }          


            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_badge', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Scout badge creat ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/scout_badge');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section();
        $this->data['member_type'] = $this->Common_model->get_member_type();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_badge',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Scout Badge';
        $this->data['subview'] = 'scout_badge_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_role(){
        $this->data['results'] = $this->General_setting_model->get_scout_role(); 
        // print_r($this->data['results']); exit;

        // $this->data['section'] = $this->Common_model->set_scout_section_basic();
        // Load page
        $this->data['meta_title'] = 'All Scout Role List';
        $this->data['subview'] = 'scout_role';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_role_add(){
        $this->form_validation->set_rules('member_id', 'Member', 'required|trim');
        $this->form_validation->set_rules('section_id', 'Section', 'required|trim');
        $this->form_validation->set_rules('role_type_id', 'Role Type', 'required|trim');

        if ($this->form_validation->run() == true){

            $form_data = array(
                'member_id'       => $this->input->post('member_id'),
                'section_id'      => $this->input->post('section_id'),
                'role_type_id'       => $this->input->post('role_type_id'),
            ); 
      
            // print_r($form_data); exit;
            if($this->Common_model->save('scout_role', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Scout role create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Scout role create successfully.');
                redirect('general_setting/scout_role');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section();
        $this->data['member_type'] = $this->Common_model->get_member_type();
        $this->data['role_type'] = $this->Common_model->get_role_type();

        // Load page
        $this->data['meta_title'] = 'Create Scout Role';
        $this->data['subview'] = 'scout_role_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_role_edit($id){
        $this->form_validation->set_rules('member_id', 'Member', 'required|trim');
        $this->form_validation->set_rules('section_id', 'Section', 'required|trim');
        $this->form_validation->set_rules('role_type_id', 'Role Type', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');


        if ($this->form_validation->run() == true){
            $form_data = array(
                'member_id'       => $this->input->post('member_id'),
                'section_id'      => $this->input->post('section_id'),
                'role_type_id'    => $this->input->post('role_type_id'),
                'status'          => $this->input->post('status'),
            ); 
     
            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_role', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Scout role update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/scout_role');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section();        
        $this->data['member_type'] = $this->Common_model->get_member_type();
        $this->data['role_type'] = $this->Common_model->get_role_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_role',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Scout Role';
        $this->data['subview'] = 'scout_role_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge_question(){
        $this->data['results'] = $this->General_setting_model->get_scout_badge_question(); 
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All Scout Badge Question List';
        $this->data['subview'] = 'scout_badge_question';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge_question_add(){
        $this->form_validation->set_rules('section_id', 'Section name', 'required|trim');
        $this->form_validation->set_rules('badge_type_id', 'Badge Type', 'required|trim');
        $this->form_validation->set_rules('questions', 'Questions', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'      => $this->input->post('section_id'),
                'badge_type_id'      => $this->input->post('badge_type_id'),
                'questions'     => $this->input->post('questions'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->save('scout_badge_question', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Scout badge Question create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Scout badge Question create successfully.');
                redirect('general_setting/scout_badge_question');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Scout Badge Question';
        $this->data['subview'] = 'scout_badge_question_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_badge_question_edit($id){
        $this->form_validation->set_rules('section_id', 'Section name', 'required|trim');
        $this->form_validation->set_rules('badge_type_id', 'Badge Type', 'required|trim');
        $this->form_validation->set_rules('questions', 'Questions', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'      => $this->input->post('section_id'),
                'badge_type_id'   => $this->input->post('badge_type_id'),
                'questions'       => $this->input->post('questions'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_badge_question', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(2, 'Scout badge Question update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/scout_badge_question');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_badge_question',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Scout Badge Question';
        $this->data['subview'] = 'scout_badge_question_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


//proficiency Group

    public function proficiency_badge(){
        $this->data['results'] = $this->General_setting_model->proficiency_badge(); 
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All Proficiency Badge List';
        $this->data['subview'] = 'proficiency_badge';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function proficiency_badge_add(){
        $this->form_validation->set_rules('section_id', 'section id', 'required|trim');
        $this->form_validation->set_rules('prof_badge_id', 'prof badge id', 'required|trim');
        $this->form_validation->set_rules('prof_badge_name', 'proficiency badge name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'prof_badge_id'     => $this->input->post('prof_badge_id'),
                'prof_badge_name'     => $this->input->post('prof_badge_name'),

            ); 

            // print_r($form_data); exit;
            if($this->Common_model->save('scout_prof_badge', $form_data)){
               
                $this->session->set_flashdata('success', 'Proficiency Badge create successfully.');
                redirect('general_setting/proficiency_badge');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        // $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Proficiency Badge';
        $this->data['subview'] = 'proficiency_badge_add';
        $this->load->view('backend/_layout_main', $this->data);
    }



    public function proficiency_badge_edit($id){
        // $this->form_validation->set_rules('badge_type_id', 'Badge', 'required|trim');
        $this->form_validation->set_rules('prof_badge_name', 'prof badge name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                'prof_badge_id'            => $this->input->post('prof_badge_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'prof_badge_name'     => $this->input->post('prof_badge_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_prof_badge', $id, 'id', $form_data)){
                
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/proficiency_badge');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();
        $this->data['prof_badge_group'] = $this->General_setting_model->get_proficiency_badge_group_by_id();

        $this->data['info'] = $this->General_setting_model->get_info('scout_prof_badge',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Proficiency Badge';
        $this->data['subview'] = 'proficiency_badge_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    function proficiency_badge_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_prof_badge',$id,'id',$form_data);
        
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/proficiency_badge');
    }

   


// --------------------------------------close-------------------------


// Proficiency Badge Group

    public function proficiency_badge_group(){
        $this->data['results'] = $this->General_setting_model->proficiency_badge_group(); 
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All Proficiency Badge Group List';
        $this->data['subview'] = 'proficiency_badge_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function proficiency_badge_group_add(){
        $this->form_validation->set_rules('section_id', 'section id', 'required|trim');
        $this->form_validation->set_rules('prof_badge_group_name', 'proficiency badge group name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'prof_badge_group_name'     => $this->input->post('prof_badge_group_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->save('scout_prof_badge_group', $form_data)){
               
                $this->session->set_flashdata('success', 'Proficiency Badge Group create successfully.');
                redirect('general_setting/proficiency_badge_group');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        // $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Proficiency Badge Group';
        $this->data['subview'] = 'proficiency_badge_group_add';
        $this->load->view('backend/_layout_main', $this->data);
    }



    public function proficiency_badge_group_edit($id){
        // $this->form_validation->set_rules('badge_type_id', 'Badge', 'required|trim');
        $this->form_validation->set_rules('prof_badge_group_name', 'prof badge group name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'prof_badge_group_name'     => $this->input->post('prof_badge_group_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_prof_badge_group', $id, 'id', $form_data)){
                
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/proficiency_badge_group');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_prof_badge_group',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Proficiency Badge Group';
        $this->data['subview'] = 'proficiency_badge_group_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function proficiency_badge_group_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_prof_badge_group',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'scouts Expertness group delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/proficiency_badge_group');
    }


// --------------------------------------close-------------------------

    // My Progress Course

    public function progress_course(){
        $this->data['results'] = $this->General_setting_model->progress_course(); 
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All Progress Course List';
        $this->data['subview'] = 'progress_course';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function progress_course_add(){
      $this->form_validation->set_rules('progress_id', 'Progress id', 'required|trim');
      $this->form_validation->set_rules('section_id', 'section id', 'required|trim');
      $this->form_validation->set_rules('course_name', 'course name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                'progress_id'            => $this->input->post('progress_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'course_name'     => $this->input->post('course_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->save('scout_progress_course', $form_data)){
               
                $this->session->set_flashdata('success', 'Progress Course create successfully.');
                redirect('general_setting/progress_course');
            }
        }

        $this->data['progress'] = $this->Common_model->set_scout_progress();
        $this->data['section'] = $this->Common_model->set_scout_section();
        // $this->data['section'] = $this->Common_model->set_scout_section_basic();
        // $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Progress Course';
        $this->data['subview'] = 'progress_course_add';
        $this->load->view('backend/_layout_main', $this->data);
    }



    public function progress_course_edit($id){
        // $this->form_validation->set_rules('badge_type_id', 'Badge', 'required|trim');
        $this->form_validation->set_rules('progress_id', 'Progress Id', 'required|trim');
        $this->form_validation->set_rules('course_name', 'course name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                'progress_id'            => $this->input->post('progress_id'),
                // 'badge_type_id'         => $this->input->post('badge_type_id'),
                'course_name'     => $this->input->post('course_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_progress_course', $id, 'id', $form_data)){
                
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/progress_course');
            }
        }

        $this->data['progress'] = $this->Common_model->set_scout_progress();
        $this->data['section'] = $this->Common_model->set_scout_section();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_progress_course',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Progress Course';
        $this->data['subview'] = 'progress_course_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }

    function progress_course_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_progress_course',$id,'id',$form_data);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/progress_course');
    }


// --------------------------------------close-------------------------


    public function scout_expertness_group(){
        $this->data['results'] = $this->General_setting_model->scout_expertness_group(); 
        // print_r($this->data['results']); exit;

        // Load page
        $this->data['meta_title'] = 'All Scout Expertness Group List';
        $this->data['subview'] = 'scout_expertness_group';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_expertness_group_add(){
        $this->form_validation->set_rules('badge_type_id', 'Badge', 'required|trim');
        $this->form_validation->set_rules('expert_group_name', 'expert group name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                'badge_type_id'         => $this->input->post('badge_type_id'),
                'expert_group_name'     => $this->input->post('expert_group_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->save('scout_expertness_group', $form_data)){
                /***********Activity Logs Start**********/
                $insert_id = $this->db->insert_id();
                func_activity_log(1, 'Scout badge Question create ID :'.$insert_id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Scout badge Question create successfully.');
                redirect('general_setting/scout_expertness_group');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        // Load page
        $this->data['meta_title'] = 'Create Scout Expertness Group';
        $this->data['subview'] = 'scout_expertness_group_add';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function scout_expertness_group_edit($id){
        $this->form_validation->set_rules('badge_type_id', 'Badge', 'required|trim');
        $this->form_validation->set_rules('expert_group_name', 'expert group name', 'required|trim');

        if ($this->form_validation->run() == true){
            $form_data = array(
                'section_id'            => $this->input->post('section_id'),
                'badge_type_id'         => $this->input->post('badge_type_id'),
                'expert_group_name'     => $this->input->post('expert_group_name'),
            ); 

            // print_r($form_data); exit;
            if($this->Common_model->edit('scout_expertness_group', $id, 'id', $form_data)){
                /***********Activity Logs Start**********/
                //$insert_id = $this->db->insert_id();
                func_activity_log(1, 'Scout badge Question update ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
                /***********Activity Logs End**********/
                $this->session->set_flashdata('success', 'Information update successfully.');
                redirect('general_setting/scout_expertness_group');
            }
        }

        $this->data['section'] = $this->Common_model->set_scout_section_basic();
        $this->data['badge_type'] = $this->Common_model->get_badge_type();

        $this->data['info'] = $this->General_setting_model->get_info('scout_expertness_group',$id);

        // Load page
        $this->data['meta_title'] = 'Edit Scout Expertness Group';
        $this->data['subview'] = 'scout_expertness_group_edit';
        $this->load->view('backend/_layout_main', $this->data);
    }


    // public function ajax_district_by_division($div_id){
    //     header('Content-Type: application/x-json; charset=utf-8');
    //     echo (json_encode($this->Common_model->get_dis_by_div_id($div_id)));
    // }

    //Name      :       ajax_upazila_by_district
    //Created   :       4-10-17
    // public function ajax_upazila_by_district($dis_id){
    //     header('Content-Type: application/x-json; charset=utf-8');
    //     echo (json_encode($this->Common_model->get_upa_by_dis_id($dis_id)));
    // }

    function division_delete($id) {

        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('division',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'division delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/division');
    }

    function district_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('district',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'district delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/district');
    }


    function upazila_thana_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('upazila_thana',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'upazila thana delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/upazila_thana');
    }

    function occupation_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('occupation',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'occupation delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/occupation');
    }

    function committee_designation_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('committee_designation',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'committee designation delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/committee_designation');
    }

    function designation_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('designation',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'designation delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/designation');
    }

    function scout_badge_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_badge',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'scouts badge delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/scout_badge');
    }

    function role_type_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('role_type',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'role type delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/role_type');
    }

    function badge_type_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('badge_type',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'badge type delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/badge_type');
    }

    function department_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('department',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'department delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/department');
    }

    function scout_badge_question_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_badge_question',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'scouts badge questions delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/scout_badge_question');
    }
    function scout_expertness_group_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_expertness_group',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'scouts Expertness group delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/scout_expertness_group');
    }

    function scout_role_delete($id) {
        $form_data = array(
            'is_delete' => 1        
        ); 
        $this->data['info'] = $this->Common_model->edit('scout_role',$id,'id',$form_data);
        /***********Activity Logs Start**********/
        func_activity_log(3, 'scout role delete ID :'.$id); //1=C, 2=U, 3=D, 4=V, 5=G ,A = 6
        /***********Activity Logs End**********/
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('general_setting/scout_role');
    }

    function ajax_get_district_by_div($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_district_by_div_id($id)));
    }

    function ajax_get_upa_tha_by_dis($dis_id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_upa_tha_by_dis_id($dis_id)));
    }

    function ajax_get_badge_question_by_badge($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_question_by_badge_id($id)));
    }

    function ajax_get_expert_group_by_badge($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_expert_group_by_badge($id)));
    }
    
    function ajax_get_scout_dis_by_region($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_dis_by_region_id($id)));
    }

    function ajax_get_scout_upazila_thana_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_upazila_by_district_id($id)));
    }

    function ajax_get_scout_dis_data_by_region($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_dis_data_by_region_id($id)));
    }

    function ajax_get_scout_upazila_thana_data_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_upazila_data_by_district_id($id)));
    }

    function ajax_get_scout_group_by_district($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_group_by_district_id($id)));
    }

    function ajax_get_scout_group_by_upazila_thana($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_group_by_upazila_thana_id($id)));
    }

    function ajax_get_scout_unit_list_by_scout_group($id=NULL, $sele=NULL){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_unit_list_by_group_id($id, $sele)));
    }

    function ajax_get_scout_unit_by_scout_group($id=NULL, $sele=NULL){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_unit_by_scout_group_id($id, $sele)));
    }

    function ajax_get_scout_badge_by_section($memberID, $sectionID){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_badge_by_member_section($memberID, $sectionID)));
    }

    function ajax_get_scout_role_by_section($memberID, $sectionID){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_role_by_member_section($memberID, $sectionID)));
    }

    //Multi select dropdown
    function ajax_get_scout_dis_by_region_multi(){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_dis_by_region_id_multi()));
    }

    function ajax_get_scout_upazila_by_district_multi(){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_sc_upazila_by_district_id_multi()));
    }


    function ajax_get_proficiency_badge_group_by_section($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->General_setting_model->get_proficiency_badge_group_by_id($id)));
    }

    function ajax_get_progress_course_by_section($progressID, $sectionID){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_course_by_progress_section($progressID, $sectionID)));
    }

    function ajax_get_designation_by_service($id){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_get_designation_by_service($id)));
    }

    function ajax_get_scout_section(){
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Common_model->get_set_scout_section()));
    }


    // function ajax_get_scout_badge_by_section($id, $id2=NULL){
    //     header('Content-Type: application/x-json; charset=utf-8');
    //     echo (json_encode($this->Common_model->get_badge_by_section($id, $id2)));
    // }

    // function ajax_get_scout_role_by_badge($id){
    //     header('Content-Type: application/x-json; charset=utf-8');
    //     echo (json_encode($this->Common_model->get_role_by_badge($id)));
    // }

    public function institute($offset=0){
        //Manage list the users
        $limit = 50;
        $results = $this->General_setting_model->get_institute($limit, $offset);
        // print_r($results); exit;

        $this->data['institute'] = $results['rows'];
        $this->data['total_rows'] = $results['num_rows'];        

        //pagination
        $this->data['pagination'] = create_pagination('general_setting/institute/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        //Load page
        $this->data['meta_title'] = 'All Institute';
        $this->data['subview'] = 'institute';
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function institute_select2_search(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('name', $this->input->get("q"), 'after');
            $this->db->or_like('eiin', $this->input->get("q"), 'after'); 
            $query = $this->db->select('id, CONCAT(name, " (", eiin, ")") AS text')
                        ->limit(30)
                        ->get("institute");
            $json = $query->result();
        }

        echo json_encode($json);
    }

    public function sc_group_select2_search(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('grp_name', $this->input->get("q"), 'after');
            $this->db->or_like('grp_name_bn', $this->input->get("q"), 'after'); 
            $query = $this->db->select('id, CONCAT(grp_name, " (", grp_name_bn, ")") AS text')
                        ->limit(30)
                        ->get("office_groups");
            $json = $query->result();
        }

        echo json_encode($json);
    }

    public function file_check($str){
        $this->load->helper('file');
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['badge_logo']['name']);
        $file_size = 1050000; 
        $size_kb = '1 MB';

        if(isset($_FILES['badge_logo']['name']) && $_FILES['badge_logo']['name']!=""){
            if(!in_array($mime, $allowed_mime_type_arr)){                
                $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png, gif file.');
                return false;
            }elseif($_FILES["badge_logo"]["size"] > $file_size){
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