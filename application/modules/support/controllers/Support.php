<?php defined('BASEPATH') OR exit('No direct script access allowed');
include 'classes/SMSClient.php';

class Support extends Backend_Controller {
	var $smsUser;
	public function __construct(){
		parent::__construct();
		$this->load->helper('string');
	}

	public function index(){
		if($this->config->item('identity', 'ion_auth') != 'email'){
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}else{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() == true){
			// $identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->input->post('identity');
			$where = "username='$identity' OR scout_id='$identity'";
			$userinfo = $this->ion_auth->where($where)->users()->row();
			$code  = random_string('numeric', 6);

			if(!empty($userinfo)){
				$newdata = array(
					'forget_id'  => encrypt_url($userinfo->id),
					'verify_code'=> encrypt_url($code)
				);
				$this->session->set_userdata($newdata);
				redirect("forgot_password/get_verification_code");
			}else{
				if($this->config->item('identity', 'ion_auth') != 'email'){
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}else{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			}
		}

		//view
		$this->data['meta_title'] = 'Forgot Password';
		$this->data['subview'] = 'index';
		$this->load->view('login/_layout_main', $this->data);
	}
	
	public function cbox($offset=0){
		$user_id = $this->session->userdata('user_id');
		$limit = 25;
		//Results
		if($this->ion_auth->is_admin()){
			$results = $this->Employee_model->get_complain_list($limit, $offset, null);
		} else {
			$results = $this->Employee_model->get_complain_list($limit, $offset, $user_id);
		}
		$this->data['results'] = $results['rows'];
		$this->data['total_rows'] = $results['num_rows'];

		//pagination
		$this->data['pagination'] = create_pagination('scouts_member/complain_box/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

		//Load page
		$this->data['meta_title'] = 'Complain or Feadback List';
		$this->data['subview'] = 'cbox';
		$this->load->view('backend/_layout_main', $this->data);
	}

	public function add_cbox(){
		$user_id = $this->session->userdata('user_id');
		//Validation
		$this->form_validation->set_rules('complain', 'Add complain or feadback', 'required|trim');

		//Input data
		if($this->form_validation->run() == true){
			$form_data = array(
				'user_id'  => $user_id,
				'complain' => $this->input->post('complain'),
				'status'   => 1
			);

			if($this->db->insert('user_complains', $form_data)){
				$this->session->set_flashdata('success', 'Information update successfully.');
				redirect("my_profile/cbox");
			}
		}

		// Load page
		$this->data['meta_title'] = 'Add Complain Or Feadback';
		$this->data['subview'] = 'add_cbox';
		$this->load->view('backend/_layout_main', $this->data);
	}

    function ajax_exists_scout_id(){
        $item = $_POST['inputData'];
        $result = $this->Common_model->exists('users', 'scout_id', $item);
		dd($result);
        if ($result <= 0) {
			echo 'false';
        }else{
            echo 'true';
        }
    }
}
