<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scouts_setting extends Backend_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in()):
            redirect('login');
        endif;

        $this->load->model('Common_model');
        $this->load->model('Scouts_setting_model');
    }

	public function index(){
        redirect('scouts_setting/unit_office');
	}

    public function unit_office(){
        // $this->data['results'] = $this->Scouts_member_model->get_data('courses'); 
        // print_r($this->data['results']); exit;
        // Load page
        $this->data['meta_title'] = 'All Unit Office';
        $this->data['subview'] = 'unit_office';
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
                $this->session->set_flashdata('success', 'New scouts member insert successfully.');
               redirect("all");
            }
        }

		$this->data['meta_title'] = 'Add Scouts Member';
		$this->data['subview'] = 'unit_office_add';
    	$this->load->view('backend/_layout_main', $this->data);
	}

    function delete($id) {
        $this->data['info'] = $this->Scouts_member_model->delete($id);
        $this->session->set_flashdata('success', 'Information delete successfully.');
        redirect('all');
    }

}