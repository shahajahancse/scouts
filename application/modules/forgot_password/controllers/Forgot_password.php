<?php defined('BASEPATH') OR exit('No direct script access allowed');
include 'classes/SMSClient.php';

class Forgot_password extends CI_Controller {
	var $smsUser;
	public function __construct(){
		parent::__construct();
		if ($this->ion_auth->logged_in()){
			redirect('dashboard');
		}
		$this->load->library(['form_validation', 'email']);
		$this->load->model('Common_model');

		// $this->smsUser = new SMSClient('1587652994', '^Rl:_w=[', 'http://www.sms4bd.net');
		$this->load->helper('string');
	}

	public function index(){
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email'){
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}else{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() == true){
			$identity = $this->input->post('identity');
			$where = "username='$identity' OR scout_id='$identity'";
			$userinfo = $this->ion_auth->where($where)->users()->row();

			$code  = random_string('numeric', 6);
			if (empty($userinfo)) {
				$this->ion_auth->set_error('forgot password user not found');
			} else if(!empty($userinfo) && !empty($userinfo->email)){
				$newdata = array(
					'forget_id'   => encrypt_url($userinfo->id),
					'verify_code' => encrypt_url($code)
				);
				$this->session->set_userdata($newdata);
				if ($this->sendCodeEmail($userinfo->email, $code)) {
					$update_data = array('verify_code' => $code, 'forgotten_password_time' => time());
					$this->db->where('id', $userinfo->id)->update('users', $update_data);
					redirect("forgot_password/verify_change_password/".$newdata['forget_id']);
				}
			} else {
				$this->ion_auth->set_error('forgot password email not found');
			}
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->data['identity'] = array(
			'name' => 'identity',
			'id' => 'identity',
			'class' => 'form-control',
			'placeholder' => '',
		);

		//view
		$this->data['meta_title'] = 'Forgot Password';
		$this->data['subview'] = 'index';
		$this->load->view('login/_layout_main', $this->data);
	}

	public function verify_change_password($id = NULL){
		$this->form_validation->set_rules('verify_code', 'Verify Code', 'required|trim');
		$this->form_validation->set_rules('new', 'New Password', 'required|trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
		$this->form_validation->set_rules('new_confirm', 'Confirm Password', 'required|trim|matches[new]');

		//validate form input
		if ($this->form_validation->run() == TRUE){
			// $forget_id 		= decrypt_url($this->session->userdata('forget_id'));
			// $verify_code 	= decrypt_url($this->session->userdata('verify_code'));
			$forget_id 		= decrypt_url($id);
			$info = $this->db->where('id', $forget_id)->get('users')->row();
			if($info->verify_code == $this->input->post('verify_code')){
				$change = $this->ion_auth->forget_change_password($forget_id, $this->input->post('new'));
				if ($change){
					$this->session->set_flashdata('success', $this->ion_auth->messages());
					redirect("login");
				} else {
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning"> <i class="fa fa-warning"></i> Your verify code no match.</div>');
			}
		}

		$this->data['message'] = (validation_errors()) ? '<div class="alert alert-warning"> <i class="fa fa-warning"></i> ' . validation_errors() . '</div>' : $this->session->flashdata('message');

		//view
		$this->data['meta_title'] = 'Verify Code and Change Password';
		$this->data['subview'] = 'verify';
		$this->load->view('login/_layout_main', $this->data);
	}

	function sendCodeEmail($email, $code) {
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'membershipr34@gmail.com';
		$config['smtp_pass'] = 'mcbz asas vkzx cjyz';
		// $config['mailtype']  = 'html';
		// $config['smtp_timeout'] = '7';
		$config['mailtype']  = 'text';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";
		$config['crlf']      = "\r\n";
		//$config['validation'] = TRUE; // bool whether to validate email or not

		$mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: ".$code."\r\n\r\n Thanky You!";

        $this->load->library('email');
		$this->email->initialize($config);
        $this->email->from('membershipr34@gmail.com', 'Bangladesh Scouts');
        $this->email->to($email);
		$this->email->subject('Forgot password verify code.');
		$this->email->message($mailBody);
		return $this->email->send() ? TRUE : FALSE;
	}


	//    old code
	public function get_verification_code(){
		$user_id = (int) decrypt_url($this->session->userdata('forget_id'));
		// Check Exists
		if(!$this->Common_model->exists('users', 'id', $user_id)){
			show_404('forgot_password - get_verification_code - exists', TRUE);
		}

		$where = "id='$user_id'";
		$userinfo = $this->ion_auth->where($where)->users()->row();

		//Display email or mobile number for send code
		if(filter_var($userinfo->username, FILTER_VALIDATE_EMAIL) && filter_var($userinfo->email, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(
				encrypt_url($userinfo->username) => func_imp_email($userinfo->username),
				encrypt_url($userinfo->email) => func_imp_email($userinfo->email)
			);
			$this->form_validation->set_rules('email', 'Select at least one email address.', 'required');
		}elseif(filter_var($userinfo->username, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(encrypt_url($userinfo->username) => func_imp_email($userinfo->username));
			$this->form_validation->set_rules('email', 'Select email address.', 'required');

		}elseif(filter_var($userinfo->email, FILTER_VALIDATE_EMAIL)){
			$this->data['emails'] = array(encrypt_url($userinfo->email) => func_imp_email($userinfo->email));
			$this->form_validation->set_rules('email', 'Select email address.', 'required');
		}

		//validate and send code
		if ($this->form_validation->run() == true){
			//Run
			if($user_id != $userinfo->id){
				redirect('forget-password');
			}

			//echo decrypt_url($this->input->post('email')); exit;
			if($this->sendForgotCode($this->session->userdata('forget_id'), $this->input->post('email'), $this->session->userdata('verify_code'))){
				redirect("forgot_password/verify_change_password");
			}
		}

		//view
		$this->data['meta_title'] = 'Get a verification code';
		$this->data['subview'] = 'get_verification_code';
		$this->load->view('login/_layout_main', $this->data);
	}

	public function sendForgotCode($userID, $email, $code){
		//Decrypt userid
		$userID = (int) decrypt_url($userID);
		// Check Exists
		if(!$this->Common_model->exists('users', 'id', $userID)){
			show_404('forgot_password - sendForgotCode - exists', TRUE);
		}
		//Decrypt method
		$email = decrypt_url($email);
		$code  = decrypt_url($code);

		$mailBody = "Hello, \r\n\r\n We received a request to reset your scouts password. \r\n Your verify code: ".$code."\r\n\r\n Thanky You!";

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'bdscouts.noreply@gmail.com'; //testingemail9400@gmail.com > te12345678
		$config['smtp_pass']    = 'bdScouts*7';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'text'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$this->email->initialize($config);

		$this->email->from('bdscouts.noreply@gmail.com', 'Bangladesh Scouts');
		$this->email->to($email);

		$this->email->subject('Forgot password verify code.');
		$this->email->message($mailBody);

		//send mail
		$this->email->send();

		//Insert db
		$form_data = array( 'verify_code' => $code);

		if($this->Common_model->edit('users', $userID, 'id', $form_data)){
			return TRUE;
			// redirect("forgot_password/verify_change_password");
		}
	}
}
