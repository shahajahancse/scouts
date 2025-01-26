<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends Backend_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        if($identity_column!=='email'){
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']|callback_username_valid');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }else{
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('day', 'day', 'required|trim');
        $this->form_validation->set_rules('month', 'month', 'required|trim');
        $this->form_validation->set_rules('year', 'year', 'required|trim');
        $this->form_validation->set_rules('gender', 'gender', 'required|trim');
        $this->form_validation->set_rules('nid', 'NID or DOB Number', 'required|trim');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

        $dob = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');

        if ($this->form_validation->run() == true){
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : strtolower($this->input->post('identity'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name'    => $this->input->post('full_name'),
                'dob'           => $dob,
                'gender'        => $this->input->post('gender'),
                'nid_dob_type'  => $this->input->post('nid_dob_type'),
                'nid'           => $this->input->post('nid'),
                'phone'         => $this->input->post('phone')
            );
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)){


            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("login");
        }else{
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            //Form Fields
            $this->data['full_name'] = array('name' => 'full_name',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Full Name',
                'value' => $this->form_validation->set_value('full_name'),
            );
            $this->data['identity'] = array('name' => 'identity',
                'type'  => 'text',
                'class' => 'form-control',
                'id'    => 'identity',
                'placeholder' => 'Email address or username',
                'value' => $this->form_validation->set_value('identity'),
                'style' => 'text-transform: lowercase;'
            );
            $this->data['nid'] = array('name' => 'nid',
                'type'  => 'text',
                'class' => 'form-control',
                'id'    => 'nid',
                'placeholder' => 'NID or DOB Number',
                'value' => $this->form_validation->set_value('nid'),
            );
            $this->data['phone'] = array('name' => 'phone',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Mobile Number',
                'value' => $this->form_validation->set_value('phone'),
            );

            $this->data['password'] = array('name' => 'password',
                'type' => 'password',
                'id'   => 'password-field',
                'class' => 'form-control',
                'placeholder' => 'Password',
            );
            $this->data['password_confirm'] = array('name' => 'password_confirm',
                'type'  => 'password',
                'id'    => 'password-field-conf',
                'class' => 'form-control',
                'placeholder' => 'Confirm Password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->data['days'] = $this->Common_model->get_days();
            $this->data['months'] = $this->Common_model->get_months();
            $this->data['years'] = $this->Common_model->get_years();

            $this->data['meta_title'] = 'Registration';
            $this->data['subview'] = 'index';
            $this->load->view('login/_layout_main', $this->data);
        }
    }

    public function username_valid($str){
        // alpha_dash_space
        // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
        if (! preg_match('/^\S*$/', $str)) {
            $this->form_validation->set_message('username_valid', 'The %s field may only contain alpha characters & no white spaces.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function ajax_exists_nid(){
        $item = $_POST['inputData'];
        $result = $this->Common_model->exists('users', 'nid', $item);

        if ($result == 0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }

    function ajax_exists_identity(){
        // echo 'true';
        $item = $_POST['inputData'];
        $result = $this->Common_model->exists('users', 'username', $item);

        if ($result == 0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }


}
