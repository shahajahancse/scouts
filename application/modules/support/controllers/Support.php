<?php defined('BASEPATH') OR exit('No direct script access allowed');
include 'classes/SMSClient.php';

class Support extends Backend_Controller {
	var $smsUser;
	public function __construct(){
		parent::__construct();
		$this->load->model('Support_model');
	}

	public function index(){
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
		$this->form_validation->set_rules('unit_name', 'Unit Name', 'required');
		$this->form_validation->set_rules('complain', 'Complain', 'required');

		if ($this->form_validation->run() == true){
			$data = array(
				'name'       => $this->input->post('name'),
				'scout_id'   => $this->input->post('scout_id'),
				'mobile'     => $this->input->post('mobile'),
				'email'      => $this->input->post('email'),
				'unit_name'  => $this->input->post('unit_name'),
				'complain'   => $this->input->post('complain'),
				'status'     => 1,
			);

			if ($this->db->insert('user_complains', $data)) {
				$this->session->set_flashdata('success', 'The complaint was recorded successfully.');
				redirect('login/index');
			};
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
		$results = $this->Support_model->get_complain_list($limit, $offset);
		$this->data['results'] = $results['rows'];
		$this->data['total_rows'] = $results['num_rows'];

		//pagination
		$this->data['pagination'] = create_pagination('support/cbox/', $this->data['total_rows'], $limit, 3, $full_tag_wrap = true);

		//Load page
		$this->data['meta_title'] = 'Complain or Feadback List';
		$this->data['subview'] = 'cbox';
		$this->load->view('backend/_layout_main', $this->data);
	}
}
