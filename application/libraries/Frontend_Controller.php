<?php 
class Frontend_Controller extends MY_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->ci_minifier->init('0');

		// $this->session->sess_destroy();
		if($this->session->userdata('site_lang')) {
			$this->lang->load('scouts', $this->session->userdata('site_lang'));
		} else {
			$this->session->set_userdata('site_lang', 'bangla');
			$this->lang->load('scouts', 'bangla'); 
		}
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning"> <i class="fa fa-warning"></i> ', '</div>');   
		$this->load->model('Site_model');
		$this->load->model('Common_model');
		$this->data['service_list'] = $this->Common_model->get_data('service_list');
		$this->data['region'] = $this->Common_model->get_count('office_region');
		$this->data['district1'] = $this->Common_model->get_count('office_district');
		$this->data['upazila'] = $this->Common_model->get_count('office_upazila');
		$this->data['groups'] = $this->Common_model->get_count('office_groups');
		$this->data['unit'] = $this->Common_model->get_count('office_unit');

		// $this->data['regions'] = array('' => lang('site_select_scout_region'));
		$this->data['regions'] = $this->Common_model->get_site_regions();

		$this->data['latest_news'] = $this->Common_model->get_latest_news(5);
		
		$this->data['meta_title'] = 'Scout BD';
		$this->data['meta_keywords'] = 'bangladesh scouts, bd scouts, scout, scout registration, scout portal, scout login';
		$this->data['meta_description'] = 'Online Digital Record & Scout Service System for Bangladesh scouts. ';

		$this->data['contact_email'] = '';
		$this->data['contact_phone'] = '';
		$this->data['domain_title'] = '';
	}
}